<?php

namespace Database\Seeders;

use App\Models\MarketingCampaign;
use Illuminate\Database\Seeder;

class MarketingCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MarketingCampaign::factory()->count(5)->create();
    }
}
