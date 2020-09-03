<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([[
            'tienda_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'titulo' => 'Tendencias alimenticias en 2020',
            'contenido' => 'Contenido del post',
            'img' => 'post1.jpeg',
            'user_id' => 1,
            'destacado' => 0
        ],[
            'tienda_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'titulo' => 'Berlines y que mejor',
            'contenido' => 'Contenido del post',
            'img' => 'post2.jpeg',
            'user_id' => 1,
            'destacado' => 0
        ]]);
    }
}
