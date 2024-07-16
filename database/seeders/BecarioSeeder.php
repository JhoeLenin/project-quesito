<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Becario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BecarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Becario::factory()->count(100)->create();
    }
}
