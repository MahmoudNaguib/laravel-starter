<?php
function getRandomIndustry() {
    $row = \App\Models\Post::inRandomOrder()->first();
    return $row->id;
}
function guestUser($name){
    $faker = \Faker\Factory::create('en_EN');
    $row=[
        'type' => 'guest',
        'name' => $name,
        'email' => $name.'@demo.com',
        'token' => generateToken($name.'@demo.com'),
        'mobile' => '0122' . rand(1000000, 9999999),
        'password' => bcrypt('demo@12345'),
        'confirmed' => 1,
        'is_active' => 1,
        'image' => resizeImage(resource_path() . '/images/users/'.rand(1,10).'.png', \App\Models\User::$attachFields['image']['sizes']),
    ];
    return $row;
}
?>
