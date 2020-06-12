<?php

use App\Enums\Models\Admin\Role;
use App\Enums\Models\UserProfile\Gender as UserProfileGender;
use App\Enums\Models\UserProfile\Status as UserProfileStatus;
use App\Enums\Models\UserProfileSite\Providor as UserProfileSiteProvidor;

return [
    'models' => [
        'admin' => [
            'role' => [
                Role::Administrator => '管理者',
                Role::Normal => '一般ユーザー',

                'color' => [
                    Role::Administrator => 'red',
                    Role::Normal => 'gray',
                ],
            ],
        ],
        'user' => [
            'profile' => [
                'gender' => [
                    UserProfileGender::NotKnown => '',
                    UserProfileGender::Male => '男性',
                    UserProfileGender::Female => '女性',
                    UserProfileGender::Other => 'その他',
                ],
                'status' => [
                    UserProfileStatus::Open => '公開',
                    UserProfileStatus::CompanyOpen => '社内公開',
                    UserProfileStatus::Close => '非公開',
                ],

                'site' => [
                    'providor' => [
                        UserProfileSiteProvidor::Facebook => 'Facebook URL',
                        UserProfileSiteProvidor::Twitter => 'Twitter URL',
                        UserProfileSiteProvidor::Instagram => 'Instagram URL',
                        UserProfileSiteProvidor::Eight => 'Eight URL',
                        UserProfileSiteProvidor::Personal => 'Website URL',

                        'icon' => [
                            UserProfileSiteProvidor::Facebook   => ['fab', 'facebook'],
                            UserProfileSiteProvidor::Twitter    => ['fab', 'twitter'],
                            UserProfileSiteProvidor::Instagram  => ['fab', 'instagram'],
                            UserProfileSiteProvidor::Eight      => ['fas', 'infinity'],
                            UserProfileSiteProvidor::Personal   => ['fas', 'link']
                        ],

                        'order_by' => [
                            UserProfileSiteProvidor::Facebook   => 1,
                            UserProfileSiteProvidor::Twitter    => 2,
                            UserProfileSiteProvidor::Instagram  => 3,
                            UserProfileSiteProvidor::Eight      => 4,
                            UserProfileSiteProvidor::Personal   => 5
                        ]
                    ]
                ]
            ]
        ]
    ],
];
