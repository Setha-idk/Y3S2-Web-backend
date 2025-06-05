<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\History;

class HistorySeeder extends Seeder
{
    public function run(): void
    {
        History::factory()->count(10)->create();
    }
}
