<?php

namespace App\UseCases\App;

use App\Enums\Models\UserProfile\Gender as UserProfileGender;
use App\Enums\Models\UserProfile\Status as UserProfileStatus;
use App\Enums\Models\UserProfileSite\Providor as UserProfileSiteProvidor;
use App\Models\BusinessCategory;

class GetConfigUseCase
{
    private $businessCategory;

    public function __construct(
        BusinessCategory $businessCategory
    ) {
        $this->businessCategory = $businessCategory;
    }

    public function __invoke(): array
    {
        return [
            'businessCategories' => $this->businessCategory->all(),
            'userProfileGenders' => UserProfileGender::toSelectArray(),
            'userProfileStatuses' => UserProfileStatus::toSelectArray(),
            'userProfileSiteProvidors' => UserProfileSiteProvidor::getInstances()
        ];
    }
}
