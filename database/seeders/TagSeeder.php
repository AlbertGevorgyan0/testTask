<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'name' => 'Teg1',
            ],
            [
                'name' => 'Teg2',
            ],
            [
                'name' => 'Teg3',
            ],
            [
                'name' => 'Teg4',
            ],
            [
                'name' => 'Teg5',
            ],
            [
                'name' => 'Teg6',
            ],
            [
                'name' => 'Teg7',
            ],
        ]);
    }
}
