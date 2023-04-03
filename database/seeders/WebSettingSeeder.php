<?php

namespace Database\Seeders;

use App\Models\WebSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        WebSetting::create([
            'email' => 'bsstore@gmail.com',
            'phone' => '042-8978456',
            'phone2' => '0307-8978456',
            'address' => 'Shaheen Complex, 38 Abbott Road, Garhi Shahu, Lahore, Punjab 54000',
            'map' => 'dummy',
            'twitter' => 'bsstwitter',
            'facebook' => 'bssfacebook',
            'pinterest' => 'bsspinterest',
            'instagram' => 'bssinstagram',
            'youtube' => 'bssyoutube'
        ]);
    }
}
