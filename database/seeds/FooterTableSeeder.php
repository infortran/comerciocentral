<?php

use Illuminate\Database\Seeder;

class FooterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('footer_infos')->insert([
        	'info' => 'Ingrese un texto que describa su marca, negocio y el equipo que lo componen...',
        	'direccion' => 'Calle o pasaje, #1111, depto #1,Ciudad, Pais']);
    }
}
