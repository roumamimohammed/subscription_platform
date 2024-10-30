<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Website;

class WebsiteSeeder extends Seeder
{
    public function run()
    {
        Website::create(['name' => 'Tech News', 'url' => 'https://technews.com']);
        Website::create(['name' => 'Health Updates', 'url' => 'https://healthupdates.com']);
        Website::create(['name' => 'Travel Blog', 'url' => 'https://travelblog.com']);
    }
}
