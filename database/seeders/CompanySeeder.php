<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the company with the specific id already exists
        $companyExists = DB::table('companies')->exists();

        // If the company does not exist, insert it
        if (!$companyExists) {
            DB::table('companies')->insert([
                'name' => 'Jeevani',
                'country_id' => null,
                'ceo' => null,
                'address' => 'Mohammadpur, Dhaka',
                'city' => 'Dhaka',
                'zip' => '1207',
                'registration_number' => null,
                'tax_number' => null,
                'email' => 'jeevani@gmail.com',
                'phone' => '017',
                'website' => null,
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
