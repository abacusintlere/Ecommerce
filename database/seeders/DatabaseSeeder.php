<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $role = Role::create(['name' => 'User']);
        // User::factory(15)->create();
        $this->call(SaleSeeder::class);
        $this->call(HomeCategorySeeder::class);
        $this->call(WebSettingSeeder::class);
        Category::factory(10)->create();
        Product::factory(100)->create();
    }
}
