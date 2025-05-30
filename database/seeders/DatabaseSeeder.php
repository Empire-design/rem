<?php

namespace Database\Seeders;

use App\Models\User;
use \Spatie\Permission\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $permissions  = [
            'Category List',
            'Category Create',
            'Category Update',
            'Category Delete',
            'Subcategory List',
            'Subcategory Create',
            'SubCategory Update',
            'SubCategory Delelte',
            'Product List',
            'Product Create',
            'Product Update',
            'Product Delete',
            'Blog List',
            'Blog Create',
            'Blog Update',
            'Blog Delete',
            'Role List',
            'Role Create',
            'Role Update',
            'Role View',
            'Permission List',
            'Permission Create',
            'Permission Update',
            'Permission View',
            'User List',
            'User Create',
            'User Update',
            'User View',
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $user = User::find(1);
        if ($user) {
            $user->syncPermissions($permissions);
        }
    }
}
