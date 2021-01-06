@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <!-- Imprimimos a todos nuestros posts-->
          @foreach($posts as $post)
          <div class="card mb-4">
                <div class="card-body">
                  <div class="form-group">
                    @if (!empty($post->image))
                      <img 
                        src="{{ asset("storage/$post->image") }}" 
                        style="width: 70%; height: 80%" 
                        class="rounded"
                        alt="image"
                      >  
                    @else
                    <!-- Si no existe una imagen, devolvemos otro recurso-->
                    <div class="embed-responsive embed-responsive-16by9">
                      {!! $post->iframe !!}
                    </div> 
                    @endif
                  </div>
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p class="card-text">
                    <!-- Extracto del body (numero limitado de palabras a cargar) -->
                    {{ $post->get_excerpt }}
                    <a href="{{ route('post', $post) }}">Leer más</a>
                  </p>
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
          @endforeach
          <!-- Datos de paginación 
          Utilizamos la funcion Links propia de Laravel haciendo referencia 
          al paginate de PageController-->
          <div class="row">
            {{ $posts->links("pagination::bootstrap-4") }}
          </div>
        </div>
    </div>
</div>
@endsection
