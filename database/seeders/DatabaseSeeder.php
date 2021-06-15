<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('11111111'),
            ]);
        $this->call(PermissionsSeeder::class);
        
        $this->call(ServiceSeeder::class);
        $this->call(BusRouteSeeder::class);
        $this->call(SeatClassSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BusSeeder::class);
        $this->call(BusCategorySeeder::class);
        $this->call(BusScheduleSeeder::class);
        $this->call(CompanySeeder::class);
    }
}
