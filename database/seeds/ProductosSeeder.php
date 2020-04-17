<?php

use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([[
            'nombre' => 'nombre del producto',
            'descripcion' => 'descripcion del producto',
            'precio' => '1000',
            'img' => 'image.png',
            'id_categoria' => 1,
            'id_marca' => 1],
            [
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'id_categoria' => 1,
                'id_marca' => 2],
            [
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'id_categoria' => 1,
                'id_marca' => 2],
            [
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'id_categoria' => 3,
                'id_marca' => 3],
            [
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'id_categoria' => 3,
                'id_marca' => 3],
            [
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'id_categoria' => 1,
                'id_marca' => 2],
            [
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'id_categoria' => 2,
                'id_marca' => 2],
            [
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'id_categoria' => 2,
                'id_marca' => 1]]);
    }
}
