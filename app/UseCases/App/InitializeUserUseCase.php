<?php

namespace App\UseCases\App;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use App\Enums\Models\Company\PlanSlug;
use App\Enums\Models\Employee\Role as EmployeeRole;
use App\Enums\Models\Employee\Status as EmployeeStatus;
use App\Enums\Models\UserProfile\Status as UserProfileStatus;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;

class InitializeUserUseCase
{
    public function __invoke(int $userId, array $attributes): User
    {
        return DB::transaction(function () use ($userId, $attributes) {
            $user = User::findOrFail($userId);
            $user
                ->fill([ 'initialized' => true ])
                ->save()
            ;
            $user->profile()->create($attributes['profile'] + [ 'status' => UserProfileStatus::Close ]);

            $company = Company::firstOrNew([ 'name' => $attributes['company']['name'] ]);
            $existsCompany = $company->exists;
            if (!$existsCompany) {
                $company
                    ->fill($attributes['company'] + [ 'plan_slug' => PlanSlug::Free ])
                    ->save()
                ;
                if (isset($attributes['company']['businessCategoryIds'])) {
                    $company->businessCategories()->sync($attributes['company']['businessCategoryIds']);
                }
            }

            $company->employees()->updateOrcreate(
                ['user_id' => $userId],
                [
                    'role' => $existsCompany ? EmployeeRole::Normal : EmployeeRole::Administrator,
                    'status' => $existsCompany ? EmployeeStatus::Appling : EmployeeStatus::Approved,
                    'main' => true,
                ] + $attributes['employee']
            );

            $user->load('profile');
            $user->load('mainEmployee');
            $user->load('mainEmployee.company');
            $user->load('employees');
            $user->load('employees.company');

            return $user;
        });
    }
}
