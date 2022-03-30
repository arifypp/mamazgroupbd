<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Backend\BonusSettings;
class BonusSetting extends Seeder
{
    protected $settings_data = [
        ['name'=>'assetbonus', 'value'=> '20'],
        ['name'=>'cashbonus', 'value'=> '20'],
        ['name'=>'charitybouns', 'value'=> '30'],
        ['name'=>'vatandtax', 'value'=> '10'],
        ['name'=>'mamazpoisha', 'value'=> '30'],
        ['name'=>'foundershipbonus', 'value'=> '10'],
        ['name'=>'nonsponsorbonus', 'value'=> '20'],
        ['name'=>'landcoverage', 'value'=> '10'],
        ['name'=>'clubbonus', 'value'=> '20'],
        ['name'=>'bestperformancebonus', 'value'=> '1083'],
        
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        BonusSettings::insert($this->settings_data);
    }
}
