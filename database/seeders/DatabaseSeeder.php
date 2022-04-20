<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            addDaPermissions::class,
            addGenerateQrPermission::class,
            amenItemTableNewIdColumnSeeder::class,
            approvalStatusSeeder::class,
            buyersellerseeder::class,
            CreateAdminUserSeeder::class,
            daseeder::class,
            itemRequestPermissionSeeder::class,
            ItemSizeSeeder::class,
            itemStatusSeeder::class,
            locationSeeder::class,
            locationTownCodeSeeder::class,
            paidStatusSeeder::class,
            request_catergory_seeder::class,
            transactionFeeSeeder::class,
        ]);
    }
}
//class DatabaseSeeder extends Seeder
//{
//
//    public function run(){
//        $files_arr = scandir( dirname(__FILE__) ); //store filenames into $files_array
//        foreach ($files_arr as $key => $file){
//            if ($file !== 'DatabaseSeeder.php' && $file[0] !== "." ){
//                $this->call( explode('.', $file)[0] );
//            }
//        }
//    }
//
//}
