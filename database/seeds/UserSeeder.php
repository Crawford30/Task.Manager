<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(
            ["id" => 1],
            [
                "name" => "ADMIN",
                "email" => "info@taskmanager.com",
                "password" => bcrypt("@root#123"),
                'api_token' => Str::random(60),
            ]
        );
    }
}
