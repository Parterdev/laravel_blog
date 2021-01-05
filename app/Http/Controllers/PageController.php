<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Inyectamos la entidad Post
use App\Models\Post;

class PageController extends Controller
{
    //Creamos el metodo publico para posts
    public function posts() 
    {
        //Retornamos una vista
        return view('posts', [
            //Estraemos data en base a la relacion de entidad
            'posts' => Post::with('user')->latest()->paginate(5)
        ]);
    }

    //Para post en particular, retornando un post
    public function post(Post $post) 
    {
        //Retornamos una vista con unico post
        return view('post', ['post' => $post]);
    }
}
