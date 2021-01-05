@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Publicaciones
                  <a 
                    href="{{ route('posts.create')}}"
                    class="btn btn-sm btn-success float-right"
                    ><i class="fa fa-plus-square"></i> Nuevo post
                  </a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Publicamos los registros de Posts -->
                    <table class="table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Título</th>
                          <th>Estado</th>
                          <th colspan="3">&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($posts as $post)
                        <tr>
                          <td>{{ $post->id }}</td>
                          <td>{{ $post->title }}</td>
                          <td>
                            @if ($post->deleted_at==NULL)
                              Activo
                            @elseif($post->deleted_at!==NULL)
                              Inactivo
                            @endif
                          </td>
                          <!-- Action buttons -->
                          <td>
                            <a 
                              href="{{ route('posts.edit', $post) }}"
                              class="btn btn-sm btn-primary"
                            >
                            Editar
                            </a>
                          </td>
                          @if ($post->deleted_at==NULL)
                            <td>
                              <form action="{{ route('posts.destroy', $post) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input 
                                  type="submit"
                                  value="Dar de baja"
                                  class="btn btn-sm btn-primary"
                                  onclick="return confirm('¿Realmente desea dar de baja al post?')"
                                >
                              </form>
                            </td>
                          @elseif($post->deleted_at!==NULL)
                            <td>
                              <form action="{{ route('posts.restore', $post->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <input 
                                  type="submit"
                                  value="Restaurar"
                                  class="btn btn-sm btn-primary"
                                  onclick="return confirm('¿Realmente desea restaurar el post?')"
                                >
                              </form>
                            </td>
                          @endif
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <!-- Datos de paginación 
          Utilizamos la funcion Links propia de Laravel haciendo referencia 
          al paginate de PageController-->
          <div class="row">
            {{ $posts->links("pagination::bootstrap-4") }}
          </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
