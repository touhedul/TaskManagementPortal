<?php

use App\Models\Admin;
use App\Models\ContactFeedback;
use App\Models\Employee;
use Database\Seeders\AdminSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\UserSeeder;
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
        // $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SettingSeeder::class);
        Employee::factory()->count(4)->create();
    }
}
