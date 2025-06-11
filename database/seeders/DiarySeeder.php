<?php

namespace Database\Seeders;

use App\Models\Diary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demo_data = [
            [
                'id' => 1,
                'title' => 'Title text 1',
                'entry' => "(1) Lorem ipsum dolar sin amet..."
            ],
            [
                'id' => 2,
                'title' => 'Title text 2',
                'entry' => "(2) Lorem ipsum dolar sin amet..."
            ],
            [
                'id' => 3,
                'title' => 'Title text 3',
                'entry' => "(3) Lorem ipsum dolar sin amet..."
            ],
        ];

        foreach ($demo_data as $data) {
            DB::table('diaries')->insert([
                'id' => $data['id'],
                'title' => $data['title'],
                'entry' => $data['entry']
            ]);
        }
        
        
    }
}
