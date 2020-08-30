<?php

use Illuminate\Database\Seeder;

class TiendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tiendas')->insert([[
            'user_id' => 1,
            'dominio' => 'deliciasurbanas',
            'nombre' => 'Delicias Urbanas',
            'email' => 'deliciasurbanas@comerciocentral.cl',
            'info' => 'La tienda oficial de Delicias Urbanas Online',
            'telefono' => '+56947065823',
            'img' => 'image.png',
            'is_active' => 1]]);
    }
}
