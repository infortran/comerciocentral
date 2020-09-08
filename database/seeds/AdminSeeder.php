<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *$2y$10$sVwwiepca5wECk9VKFHp4ODWhbXSqoTf9WNUVxEYaLF01HGTifEbS
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
        	'name' => 'Freddy',
			'lastname' => 'Perez',
        	'email' => 'freddy@deliciasurbanas.cl',
        	'password' => '$2y$10$sVwwiepca5wECk9VKFHp4ODWhbXSqoTf9WNUVxEYaLF01HGTifEbS',
        	'telefono' => '+56 9 47065823',
        	'img' => 'avatar.png',
        	'role' => 'admin'],
			[
				'name' => 'Mayerlin',
				'lastname' => 'Urbina',
				'email' => 'mayerlin@comerciocentral.cl',
				'password' => '$2y$10$sVwwiepca5wECk9VKFHp4ODWhbXSqoTf9WNUVxEYaLF01HGTifEbS',
				'telefono' => '+56 9 47065823',
				'img' => 'avatar.png',
				'role' => 'admin']]);
    }
}
