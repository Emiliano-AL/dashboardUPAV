<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'rol_id'  => '1',
            'name'  => 'Jhon Smith',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
    }
}
