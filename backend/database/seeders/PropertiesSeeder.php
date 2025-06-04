<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyMetric;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            User::create([
                'name' => 'John Developer',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
            ]),
            User::create([
                'name' => 'Jane Manager',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
            ]),
        ];

        $propertyTypes = ['apartment', 'house', 'condo', 'commercial'];
        $addresses = [
            '123 Main St, New York, NY 10001',
            '456 Park Ave, Los Angeles, CA 90001',
            '789 Ocean Blvd, Miami, FL 33101',
            '321 Market St, San Francisco, CA 94101',
            '654 Broadway, Chicago, IL 60601',
            '987 Lake Shore Dr, Seattle, WA 98101',
            '147 Pine St, Boston, MA 02101',
            '258 Oak Ave, Austin, TX 78701',
            '369 Elm St, Denver, CO 80201',
            '741 Maple Dr, Portland, OR 97201',
        ];

        foreach ($users as $user) {
            for ($i = 0; $i < 27; $i++) {
                $purchasePrice = rand(150000, 2000000);
                $property = Property::create([
                    'user_id' => $user->id,
                    'name' => 'Property ' . ($i + 1) . ' - ' . $user->name,
                    'address' => $addresses[array_rand($addresses)] . ' Unit ' . ($i + 1),
                    'property_type' => $propertyTypes[array_rand($propertyTypes)],
                    'purchase_price' => $purchasePrice,
                    'current_value' => $purchasePrice * (1 + (rand(-20, 40) / 100)),
                    'bedrooms' => rand(1, 5),
                    'bathrooms' => rand(1, 3),
                    'square_feet' => rand(500, 5000),
                    'description' => 'This is a great property with excellent investment potential. Located in a prime area with easy access to amenities.',
                ]);

                // Create multiple metrics for each property
                $metricsCount = rand(3, 8);
                for ($j = 0; $j < $metricsCount; $j++) {
                    $monthlyRent = $purchasePrice * (rand(5, 12) / 1000); // 0.5% to 1.2% of purchase price
                    PropertyMetric::create([
                        'property_id' => $property->id,
                        'monthly_rent' => $monthlyRent,
                        'operating_expenses' => $monthlyRent * (rand(20, 40) / 100), // 20-40% of rent
                        'occupancy_rate' => rand(70, 100),
                        'recorded_at' => now()->subMonths($metricsCount - $j)->addDays(rand(-15, 15)),
                    ]);
                }
            }
        }
    }
}
