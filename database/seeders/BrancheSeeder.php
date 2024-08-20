<?php

namespace Database\Seeders;

use App\Models\Branche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrancheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run(): void
    {
        $branche = Branche::create([
            'branche_number' => '100', 
            'branche_name' => 'الإدارة',
            'active'=>1
        ]);
        $branche2 = Branche::create([
            'branche_number' => '101', 
            'branche_name' => 'الرئيسي',
            'active'=>1
        ]);
        $branche3 = Branche::create([
            'branche_number' => '102', 
            'branche_name' => 'البرج',
            'active'=>1
        ]);
        $branche4 = Branche::create([
            'branche_number' => '103', 
            'branche_name' => 'الشط',
            'active'=>1
        ]);

        $branche5= Branche::create([
            'branche_number' => '201', 
            'branche_name' => 'مصراته',
            'active'=>1
        ]);
        $branche6= Branche::create([
            'branche_number' => '202', 
            'branche_name' => 'زليتن',
            'active'=>1
        ]);
    }
}
