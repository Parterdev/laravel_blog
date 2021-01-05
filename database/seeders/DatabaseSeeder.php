<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//Inyectamos los modelos
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Creamos un usuario por default (manualmente)
        User::create([
            'name'     => 'Paul Teran F',
            'email'    => 'my@admin.com',
            'password' => bcrypt('12345678')
        ]);

        //Utilizamos el factory para crear posts
        Post::factory(24)->create();
    }
}
