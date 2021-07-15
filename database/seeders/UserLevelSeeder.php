<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_levels')->insert(['name' => 'administrator']);
        DB::table('user_levels')->insert(['name' => 'operator']);
        DB::table('user_levels')->insert(['name' => 'user']);
    }
}
