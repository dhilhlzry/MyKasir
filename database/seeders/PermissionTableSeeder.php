<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'users-index',
            'users-create',
            'users-edit',
            'users-delete'
        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
       
    }
}