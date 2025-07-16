<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => '5 Hour Package',
                'description' => 'Perfect for getting started',
                'hours' => 5,
                'price_in_person' => 1500.00, // R300 per hour
                'price_online' => 1250.00,    // R250 per hour
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 1,
                'features' => [
                    ['feature' => '1-on-1 personalized sessions'],
                    ['feature' => 'Flexible scheduling'],
                    ['feature' => 'Progress tracking'],
                    ['feature' => 'Study materials included'],
                ],
            ],
            [
                'name' => '10 Hour Package',
                'description' => 'Great value for regular learning',
                'hours' => 10,
                'price_in_person' => 2700.00, // R270 per hour
                'price_online' => 2200.00,    // R220 per hour
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'features' => [
                    ['feature' => '1-on-1 personalized sessions'],
                    ['feature' => 'Flexible scheduling'],
                    ['feature' => 'Progress tracking'],
                    ['feature' => 'Study materials included'],
                    ['feature' => 'Weekly progress reports'],
                    ['feature' => 'Parent/guardian updates'],
                ],
            ],
            [
                'name' => '15+ Hour Package',
                'description' => 'Best value for intensive learning',
                'hours' => 15,
                'price_in_person' => 3750.00, // R250 per hour
                'price_online' => 3000.00,    // R200 per hour
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
                'features' => [
                    ['feature' => '1-on-1 personalized sessions'],
                    ['feature' => 'Flexible scheduling'],
                    ['feature' => 'Progress tracking'],
                    ['feature' => 'Study materials included'],
                    ['feature' => 'Weekly progress reports'],
                    ['feature' => 'Parent/guardian updates'],
                    ['feature' => 'Exam preparation support'],
                    ['feature' => 'Extended support hours'],
                ],
            ],
        ];

        foreach ($packages as $packageData) {
            Package::create($packageData);
        }
    }
}