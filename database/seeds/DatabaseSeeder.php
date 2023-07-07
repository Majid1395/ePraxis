<?php

use App\Rolle;
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
        Rolle::create(['name'=>'arzt']);
        Rolle::create(['name'=>'admin']);
        Rolle::create(['name'=>'mitarbeiter']);
        Rolle::create(['name'=>'patient']);
    }
}
