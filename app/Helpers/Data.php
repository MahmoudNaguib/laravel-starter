<?php
function insertDefaultConfigs() {
    $logo = resizeImage(resource_path() . '/images/logo.png', ['large' => 'resize,500x500', 'small' => 'resize,200x200']);
    $rows = [];
    ///////////////// Logo
    $rows = [
        [
            'field' => 'app_name',
            'value' => env('APP_NAME'),
            'created_by' => 1
        ],
        [
            'field' => 'contact_email',
            'value' => env('CONTACT_EMAIL'),
            'created_by' => 1
        ],
        [
            'field' => 'facebook',
            'value' => env('FACEBOOK'),
            'created_by' => 1
        ],
        [
            'field' => 'twitter',
            'value' => env('TWITTER'),
            'created_by' => 1
        ],
        [
            'field' => 'linkedin',
            'value' => env('LINKEDIN'),
            'created_by' => 1
        ],
        [
            'field' => 'instagram',
            'value' => env('INSTAGRAM'),
            'created_by' => 1
        ],
        [
            'field' => 'youtube',
            'value' => env('YOUTUBE'),
            'created_by' => 1
        ],
        [
            'field' => 'about',
            'value' => @file_get_contents(resource_path() . '/pages/about.txt'),
            'created_by' => 1
        ],
        [
            'field' => 'terms_and_conditions',
            'value' => @file_get_contents(resource_path() . '/pages/terms.txt'),
            'created_by' => 1
        ],
        [
            'field' => 'privacy_policy',
            'value' => @file_get_contents(resource_path() . '/pages/privacy.txt'),
            'created_by' => 1
        ],
        [
            'field' => 'logo',
            'value' => $logo,
            'created_by' => 1
        ],
    ];
    \DB::table('configs')->insert($rows);
}

function insertDefaultUsers() {
    $adminUserUsers = [
        [
            'type' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'token' => generateToken('admin@demo.com'),
            'mobile' => '0122' . rand(1000000, 9999999),
            'password' => bcrypt('demo@12345'),
            'confirmed' => 1,
            'is_active' => 1,
            'image' => resizeImage(resource_path() . '/images/users/admin.png', \App\Models\User::$attachFields['image']['sizes']),
        ]
    ];
    \DB::table('users')->insert($adminUserUsers);
    $guestUsers[] = guestUser('user1');
    if (app()->environment() != 'production' && app()->environment() != 'testing') {
        for ($i = 2; $i < 6; $i++) {
            $guestUsers[] = guestUser('user' . $i);
        }
    }
    \DB::table('users')->insert($guestUsers);
}





