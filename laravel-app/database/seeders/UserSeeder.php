<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create first user
        $user = User::create([
            "name" => "demo",
            "email" => "demo@example.com",
            "password" => Hash::make("demo123"),
            "profile_photo_path" => "https://laser360clinic.com/wp-content/uploads/2020/08/user-image.jpg",
            'user_url' => "demouser"
        ]);
        $user->assignRole("user");

        // Create second user
        $user = User::create([
            "name" => "thaw",
            "email" => "thawzinsoe.dev@outlook.com",
            "password" => Hash::make("demo123"),
            "profile_photo_path" => "https://static.vecteezy.com/system/resources/previews/052/350/290/non_2x/cartoon-lucky-cat-with-a-raised-paw-holding-a-dollar-coin-featuring-a-red-collar-and-sakura-flower-details-japanese-and-chinese-style-for-fortune-prosperity-good-luck-and-wealth-symbol-vector.jpg",
            "user_url" => "thawzinsoe"
        ]);
        $user->assignRole("user");
    }
}
