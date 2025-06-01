<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\RfpCategory;


class RfpCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('rfp_categories')->insert([
        //     ['name' => 'IT Services', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Consulting', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Marketing', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Construction', 'status' => 0, 'created_at' => now(), 'updated_at' => now()],
        // ]);

        RfpCategory::factory()->count(10)->create();
    }
}
