<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('website')->insert([
	   	'name' => 'First Site',
		'description' => 'Here is the first site to be showcased',
		'link' => 'https://www.example.com',
		'is-hidden' => false,
        'categories' =>"School+Work"
	   ]);
    }
}
