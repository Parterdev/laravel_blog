<?php

namespace App\Models;

/** Integrate Sluggable package */
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Inyectamos SoftDeletes para el borrado logico
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Sluggable;
    use HasFactory;
    use SoftDeletes;

    //Registramos la columna de softdelete
    protected $dates = ['deleted_at'];

    /**
     * Los atributos se asignan masivamente (sea uno o todos)
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'image',
        'iframe',
        'user_id',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() : array
    {
        /** Toma el campo titulo y lo convierte en un slug
         * Al haber una accion de guardado, el titulo tambien se
         * convertira en un slug
         */
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    //Relacionamos el campo de posts y usuario
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    //Funcion de extracto de body (Post)
    public function getGetExcerptAttribute()
    {
        //Funcion para extraer text
        return substr($this->body, 0, 140);
    }


    //Funcion para devolver la ruta de una imagen
    public function getGetImageAttribute()
    {
        //Si la imagen existe
        if ($this->image)
            //Accedemos al public/storage
            return url("storage:link/$this->image");
    }
}
