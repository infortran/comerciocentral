<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            [
                'tienda_id' => 1,
                'categoria'=>'Zapatos'],
            [
                'tienda_id' => 1,
                'categoria'=>'Zapatillas'],
            [
                'tienda_id' => 1,
                'categoria'=>'Tacos y tacones']
            ]);
    }
}
