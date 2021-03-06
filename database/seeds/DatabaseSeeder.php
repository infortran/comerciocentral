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
        // $this->call(UserSeeder::class);
        $this->call([
        	AdminSeeder::class,
        	FooterTableSeeder::class,
        	HeaderFrontendTableSeeder::class,
            MarcaSeeder::class,
            CategoriaSeeder::class,
            ProductosSeeder::class,
            TiendaSeeder::class,
            PostSeeder::class]);
    }
}
