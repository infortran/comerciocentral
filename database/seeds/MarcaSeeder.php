<?php

use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas')->insert([
            [
                'tienda_id' => 1,
                'marca'=>'Nike'],
            [
                'tienda_id' => 1,
                'marca'=>'Adidas'],
            [
                'tienda_id' => 1,
                'marca'=>'Puma:']
        ]);
    }
}
