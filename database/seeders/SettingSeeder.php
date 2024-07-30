<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = Setting::create([
            'logo' => 'Portal.jpg',
			'nama' => 'Website Kasir Portal',
            'alamat' => 'Jalan Ahmad Yani Utara No. 44 Bandung',
            'no_telp' => '087860985777',
        ]);
    }
}
