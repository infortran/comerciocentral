<?php

use Illuminate\Database\Seeder;

class HeaderFrontendTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('header_frontends')->insert([
        	'telefono' => '+56 9 12345678',
        	'email' => 'contacto@dominio.cl',
        	'facebook' => 'facebook.com/user',
        	'twitter' => 'twitter.com/user',
        	'instagram' => 'instagram.com/user',
    		'linkedin' => 'linkedin.com/user',
			'img_header' => 'navbar-brand.png',]);
    }
}
