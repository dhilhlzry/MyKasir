<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nip' => '102107192',
			'name' => 'Fadhil Halyzari',
            // 'alamat' => 'Cihampelas',
            // 'jenis_kel' => 'L',
			'email' => env('DEFAULT_EMAIL', 'fhalyzari@gmail.com'),
			'password' => Hash::make(env('DEFAULT_PASSWORD', 12345678)),
            'status' => 'Active',
            'level' => 'Super Admin',
			// 'role_id' => 1,
            
        ]);

        $user->assignRole(1);
    }
}
