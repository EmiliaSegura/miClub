@push('styles')
<link href="{{ asset('css/logged/publicacion.css') }}" rel="stylesheet">
@endpush

 <article class="publicacion">
      <ul>
        <!-- pasar solo estooo -->
      @forelse($posts as $post)
      
      @if (auth()->id()==$post->etiqueta_id)
      <article class="publicacion">
          <div class="quienPublica">
              <a class="cuadrado5" href="profile"><img id="fotoPerfil5" src="{{ Storage::url($post->user->person->avatar) }}"  alt="" width="50px"></a>
              <div class="quienPublicaInfo">
                <h4 class="userName" >{{$post->user->name}}</h4>
                @isset($post->group)
                <p>Este post pertenece a la categoria :<b> {{$post->group->name}}</b></p>
                @endisset
              </div>
            </div>

              <p class="textoPublicacion">{{$post->body }}</p>

              <img class="imgPublicacion" src="/storage/{{$post->image}}"  alt="">
              <br> <br>

                <div id='publicacion-user' class="publicacion-user">
                  <div class="botones">
                    <a id='like-button' class='like-button' href="#"><i class="fas fa-thumbs-up"></i>Me gusta</a>
                    <a id='dislike-button' class='dislike-button' href="#"><i class="fas fa-thumbs-down"></i>No me gusta</a>
                    <a id='share-button' class='share-button' href="#"><i class="fas fa-share"></i>Compartir</a>
                  </div>
                  <div id='interaccion' class="interaccion">
                    <!-- Aca va la informacion sobre la interaccion del usuario con el posteo -->
                    <br>
                    <i class="compartido"><?=
                    $numero_aleatorio = rand(1,5) . ' veces compartidos'; ?></i>
                  </div>
                </div>



                  @forelse($comments as $comment)
                  @if ($post->id == $comment->post_id)
                 <b>{{$post->user->name }}</b>
                <p>{{$comment->body }}</p>
              @endif


                @empty
                @endforelse
              <div class="form-row">
              <div class="form-group col-md-12" style="justify-content: center">
                <form action="comment/create" method="POST">

                   {{ csrf_field() }}

                   <input type="hidden" value='1' name="postid">
                    <input type="text" class="" id="bodyComentarios" name="body" placeholder="Deja acá tu comentario">
                 </form>
              </div>

              </div>
            </article>
@endif
      @empty
      <br>Nadie te ha etiquetado aun </b><img src="/img/triste.jpg" width="150px">
      @endforelse
    <!-- pasar solo estooo -->
</ul>

      {{ $posts->appends(request()->query())->links() }}

       </article>
