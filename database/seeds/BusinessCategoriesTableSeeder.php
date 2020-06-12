<?php

use Illuminate\Database\Seeder;
use App\Models\BusinessCategory;
use Carbon\Carbon;

class BusinessCategoriesTableSeeder extends Seeder
{
    private $category;

    public function __construct(BusinessCategory $category)
    {
        $this->category = $category;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new Carbon();
        $this->category->insert([
            [ 'name' => '原料供給（原料サプライヤー）', 'created_at' => $now, 'updated_at' => $now ],
            [ 'name' => '受託製造・加工（OEMなど）', 'created_at' => $now, 'updated_at' => $now ],
            [ 'name' => '製品メーカー、販社', 'created_at' => $now, 'updated_at' => $now ],
            [ 'name' => 'その他', 'created_at' => $now, 'updated_at' => $now ],
        ]);
    }
}
