<?php

namespace Database\Seeders;

use App\Models\TipeEvaluasi;
use Illuminate\Database\Seeder;

class TipeEvaluasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipeEvaluasi::create(['nama_evaluasi' => 'Efektivitas']);
        TipeEvaluasi::create(['nama_evaluasi' => 'Fungsionalitas']);
    }
}
