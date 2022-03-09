<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class locationTownCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = Location::all();
        foreach ($location as $town){
            if(in_array($town->area,['San Fernando','San Gabriel','San Juan'])){
                $str = preg_replace('~[^A-Z]~', '', $town->area);
                Location::where('id',$town->id)->update(['code'=> $str]);
            }else{
                Location::where('id',$town->id)->update(['code'=> strtoupper(substr($town->area,0,3))]);
            }

        }
    }
}
