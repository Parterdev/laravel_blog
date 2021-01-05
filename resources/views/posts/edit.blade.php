@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar publicación</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Configuramos el formulario de edicion de datos -->
                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>* Título</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title', $post->title) }}">
                      </div>
                      <div class="form-group">
                        @if (!empty($post->image))
                          <div class="col-12">
                            <label>Imagen</label>
                          </div>
                          <div class="center">
                            <img 
                              src="{{ url('storage/'. old('image', $post->image)) }}" 
                              style="width: 60%; height: 80%"  
                              class="rounded mx-auto d-block"
                              alt="image"
                            >
                          </div> 
                        @else
                          <div class="alert alert-secondary" role="alert">
                            Este post no contiene imagen de portada!
                          </div>  
                        @endif
                      </div>
                      <div class="form-group">
                        <div class="custom-file">
                          <input name="file" type="file" class="custom-file-input" lang="es">
                          <label class="custom-file-label" for="customFile">Seleccionar imagen</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>* Contenido</label>
                        <textarea name="body" class="form-control" required>
                          {{ old('body', $post->body) }}
                        </textarea>
                      </div>
                      <div class="form-group">
                        <label>Contenido embebido</label>
                        <textarea name="iframe" class="form-control">
                          {{ old('iframe', $post->iframe) }}
                        </textarea>
                      </div>
                      <div class="form-group">
                        @csrf
                        @method('PUT')
                        <input 
                          type="submit" 
                          value="Actualizar"
                          class="btn btn-sm btn-primary">
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
