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
            'categoria_id' => 1,
            'descripcion' => 'descripcion del producto',
            'img' => 'image.png',
            'marca_id' => 1,
            'nombre' => 'nombre del producto',
            'precio' => '1000',
            'tienda_id' => 1],

            [
                'tienda_id' => 1,
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'categoria_id' => 1,
                'marca_id' => 2],
            [
                'tienda_id' => 1,
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'categoria_id' => 1,
                'marca_id' => 2],
            [
                'tienda_id' => 1,
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'categoria_id' => 3,
                'marca_id' => 3],
            [
                'tienda_id' => 1,
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'categoria_id' => 3,
                'marca_id' => 3],
            [
                'tienda_id' => 1,
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'categoria_id' => 1,
                'marca_id' => 2],
            [
                'tienda_id' => 1,
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'categoria_id' => 2,
                'marca_id' => 2],
            [
                'tienda_id' => 1,
                'nombre' => 'nombre del producto',
                'descripcion' => 'descripcion del producto',
                'precio' => '1000',
                'img' => 'image.png',
                'categoria_id' => 2,
                'marca_id' => 1]]);
    }
}
