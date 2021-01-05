@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <!-- Imprimimos la data de un unico post-->
          <div class="card">
                <div class="card-body">
                  <div class="form-group">
                    @if (!empty($post->image))
                      <img 
                        src="{{ $post->get_image }}" 
                        style="width: 70%; height: 80%" 
                        class="rounded"
                        alt="image"
                      >  
                    @else
                    <!-- Si no existe una imagen, devolvemos otro recurso-->
                    <div class="alert alert-secondary" role="alert">
                      Ooops! Este post no cuenta con imagen, 
                      pero puedes revisar más abajo...
                    </div>
                    @endif
                  </div>
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p class="card-text">
                    {{ $post->body }}
                  </p>
                  @if (!empty($post->iframe))
                    <div class="alert alert-primary" role="alert">
                      Disfruta de nuestro contenido digital!
                    </div>
                    <div class="embed-responsive embed-responsive-16by9">
                      {!! $post->iframe !!}
                    </div>
                  @else
                    <div class="alert alert-secondary" role="alert">
                      Oops! Quizás este post no tenga contenido extra, 
                      pero puedes revisar los demás...
                    </div>
                  @endif
                  <!-- Datos del usuario creador del post -->
                  <p class="text-muted mb-0">
                    <em>
                      &ndash; {{ $post->user->name }}
                    </em>
                    <p>
                      <i class="fa fa-calendar">{{ $post->created_at->format('d M Y') }}</i>
                    </p>
                  </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
