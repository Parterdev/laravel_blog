<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;

//Utilizamos la clase Storage para acceder a archivos
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aqui inicia todo
        $posts = Post::latest()->withTrashed()->paginate(8);
        //Devolvemos los datos a una vista
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Retornamos la vista para crear Posts
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //Aceptamos los datos unicamente validados
        //dd($request->validated());
        //Impresion de como llegan todos los datos
        //dd($request->all());


        //Salvado de datos
        $post = Post::create([
            //Obtenemos el id del usuario en sesion
            'user_id' => auth()->user()->id
            //Title, body and iframe
        ] + $request->validated());

        //obtenemos el archivo de imagen 
        if ($request->file('file')) {
            //Guardamos la ruta de acceso a la imagen en una carpeta posts dentro de storage
            $post->image = $request->file('file')->store('postImages', 'public');
            //Guardamos el post
            $post->save();
        }

        //Retornamos la data utilizando la variable de sesion status
        return back()->with('status', 'Post creado con éxito!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->deleted_at!==NULL) 
        {
            echo "error atrapado";
        }else {
            //Retornamos el formulario de edicion de posts
            return view('posts.edit', compact('post'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //Actualizamos el post
        $post->update($request->all());

        //obtenemos el archivo de imagen 
        if ($request->file('file')) {
            //Eliminamos imagen anterior
            Storage::disk('public')->delete($post->image);
            //Guardamos la ruta de acceso de la nueva imagen en una carpeta posts dentro de storage
            $post->image = $request->file('file')->store('postImages', 'public');
            $post->save();
        }

        //Retornamos a la página anterior 
        return back()->with('status', 'Actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage (softdelete).
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //Eliminar el post (solo de manera logica)
        //Solo coloca la fecha y hora actual en el campo deleted_at
        $post->delete();
        return back()->with('status', 'El post ha sido dado de baja');
    }

    
    public function restore($id)
    {
        Post::onlyTrashed()
            ->where('id',$id)
            ->restore();

        return back()->with('status', 'El post ha sido resturado');
    }

    /* public function forceDelete(Post $post)
    {
        //Eliminar el post (de manera permanente)
        //Primero eliminamos la imagen de su carpeta (storage)
        Storage::disk('public')->delete($post->image);
        $post->forceDelete();
        return back()->with('status', 'El post se ha eliminado permanentemente');
    } */
}
