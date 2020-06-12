<?php

use Illuminate\Database\Seeder;
use App\Models\Plan;
use Carbon\Carbon;

class PlansTableSeeder extends Seeder
{
    private $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new Carbon();
        $this->plan->insert([
            [
                'slug' => 'free',
                'name' => '無料',
                'monthly_price' => 0,
                'display_monthly_price' => '無料',
                'yearly_price' => 0,
                'display_yearly_price' => '無料',
                'description_json' => json_encode([
                    'ニュース投稿',
                    '製品登録（無制限）',
                    '資料投稿（AP50によって1点追加権付与。50以下でこれまでの資料が非掲載になる。翌月50超えると全資料再掲載して1点追加権付与）',
                    '広告（AP50でテキスト広告1箇所掲載できる）（広告のLPは製品ページや会社業態ページに飛ばす）',
                ]),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'slug' => 'rakuraku',
                'name' => 'らくらく',
                'monthly_price' => 2000,
                'display_monthly_price' => '２千円',
                'yearly_price' => 20000,
                'display_yearly_price' => '２万円', 
                'description_json' => json_encode([
                    'ニュース投稿',
                    '製品登録（無制限）',
                    '資料登録（1原料1点まで。ただし「旧ライト」のクライアントは10点までOK）',
                    '広告（テキスト広告1箇所掲載）',
                ]),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'slug' => 'lite',
                'name' => 'ライト',
                'monthly_price' => 10000,
                'display_monthly_price' => '１万円',
                'yearly_price' => 100000,
                'display_yearly_price' => '１０万円',
                'description_json' => json_encode([
                    'ニュース投稿',
                    '製品登録（無制限）',
                    '資料登録（無制限）',
                    'ページ作成（CMS無制限）',
                    '広告（テキスト広告3つ出せる）',
                ]),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'slug' => 'basic',
                'name' => 'ベーシック',
                'monthly_price' => 50000,
                'display_monthly_price' => '５万円',
                'yearly_price' => 500000,
                'display_yearly_price' => '５０万円',
                'description_json' => json_encode([
                    'ニュース投稿',
                    '製品登録（無制限）',
                    '資料登録（無制限）',
                    '広告（テキスト広告30箇所）',
                    'コンサルティング（徐々に1対nのグループへの参加型に移行する）',
                    'ページ作成（CMS無制限、インデックスページ可、KBに依頼する場合1ページまで）',
                ]),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'slug' => 'premium',
                'name' => 'プレミアム',
                'monthly_price' => 100000,
                'display_monthly_price' => '１０万円',
                'yearly_price' => 1000000,
                'display_yearly_price' => '１００万円',
                'description_json' => json_encode([
                    'ニュース投稿',
                    '製品登録（無制限）',
                    '資料登録（無制限）',
                    '広告（テキスト広告無制限、バナー広告1つ/月）',
                    'コンサルティング（面談可）',
                    'ページ作成（CMS無制限、インデックスページ可、KBに依頼する場合2ページまで）',
                ]),
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
