<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 100; $i++) {
            $seriNo = $this->generateRandomString();
            DB::table('devices')->insert([
                'agency_id' => '0',
                'device_name' => 'device_' . $seriNo,
                "device_img" => 'assets/images/51BbzkxcseL.jpg',
                'serial_no' => $seriNo,
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }


        //
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}
