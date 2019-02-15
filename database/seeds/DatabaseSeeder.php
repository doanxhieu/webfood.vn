<?php

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
         $this->call(UsersTableSeeder::class);
         $this->call(InserDataMenu::class);
        
    }
}

class insertDataSlide extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slides')->insert([
            ['link'=>'banner1','image'=>'banner1.png'],
            ['link'=>'banner2','image'=>'banner2.png'],
            ['link'=>'banner3','image'=>'banner3.png'],
            ['link'=>'banner4','image'=>'banner4.png'],
            ['link'=>'banner5','image'=>'banner5.png'],
        ]);
    }
}
