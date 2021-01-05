@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear post </div></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Formulario de creacion de posts 
                      Utilizamos el protocolo de encriptado multipart/...
                    -->
                    <form 
                      action="{{ route('posts.store') }}" 
                      method="POST"
                      enctype="multipart/form-data"
                    >
                      <div class="form-group">
                        <label>* Título</label>
                        <input type="text" name="title" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label>Imagen</label>
                        <div class="custom-file">
                          <input name="file" type="file" class="custom-file-input" lang="es">
                          <label class="custom-file-label" for="customFile">Seleccionar imagen</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>* Contenido</label>
                        <textarea name="body" cols="30" rows="6" class="form-control" required></textarea>
                      </div>
                      <div class="form-group">
                        <label>Contenido embebido</label>
                        <textarea name="iframe" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                        @csrf
                        <input 
                          type="submit" 
                          value="Guardar"
                          class="btn btn-sm btn-primary">
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
