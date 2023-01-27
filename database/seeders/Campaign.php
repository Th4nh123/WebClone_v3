<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HwpCampaign;
class Campaign extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HwpCampaign::query()->insert([
            "campaign" => "Thanh",
            "language" => "Vietnamese",
            "check" => 0
        ]);
    }
}
