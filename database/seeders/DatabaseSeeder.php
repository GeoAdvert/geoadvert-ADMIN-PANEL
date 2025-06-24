<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\IndependentAd;
use App\Models\PlanItem;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

$userRole = Role::create(['name' => 'admin']);
$adminRole = Role::create(['name' => 'tablet']);

        $user = User::create([
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => Hash::make('password'),
            'hashedPassword' => "password"
        ]);

        $user->assignRole('admin');

        $independentAd = IndependentAd::create([
            'total_quiz' => 2,
        ]);


        $this->call(StructureSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
