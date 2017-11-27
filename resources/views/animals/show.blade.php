@extends('GyvunuGloba.Layout.main')

@section('title','|Peržiūrėti gyvūną')

@section('width') <div class="col-md-12"> @endsection

@section('content')



  <div class="row">
    <div class="col-md-10">
      <h1>Gyvūnas</h1>
    </div>

    <div class="col-md-2">
      @if(Auth::check())
      @if( Auth::user()->Role->id == 1)
      <a href="{{ route('animals.edit', $data['animal'] -> id) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Redaguoti</a>
     {!! Form::open(['route' => ['animals.destroy', $data['animal'] -> id], 'method' => 'DELETE'])!!}
     {!! Form::submit('Pašalinti', ['class' => 'btn btn-lg btn-block btn-primary btn-h1-spacing','style' => 'margin-top:15px;'])!!}
     {!! Form::close() !!}
     @endif
     @endif

    </div>
    <div class="col-md-12">
      <hr>
    </div>
  </div> <!-- end of .row -->

<div class="col-md-12 well">
  <div class="col-md-6 well">
      <h1>Globotinio informacija</h1>
      <hr>
    <h3>Globotinio vardas: <small>{{ $data['animal']->name }}</small></h3>
        @if($data['animal']->animal_type_fk  == '0')
    <h3>Gyvūnas: <small>Šuo</small></h3>
    @elseif($data['animal']->animal_type_fk  == '1')
     <h3>Gyvūnas: <small>Katė</small></h3>
    @elseif($data['animal']->animal_type_fk  == '2')
     <h3>Gyvūnas: <small>Šinšila</small></h3>
    @else
     <h3>Gyvūnas: <small>Jūrų Kiaulytė</small></h3>
     @endif
    <h3>Gyvūno amžius: <small>{{ $data['animal']->age }} mėn.</small></h3>
    <h3>Gyvūno aprašymas: <small>{{ $data['animal']->body }}</small></h3>
 <div>

 </div>
  </div>
  <div class="col-md-6 well">
      <h1>Gyvūno nuotrauka</h1>
      <hr>
    <div class="my-slider">
<ul>
    @if($data['animal']->photo_fk != NULL)
        <li><img src="{{ asset($data['animal']->photo_fk) }}" width="650" height="450" alt="Avatar" id="avatar_show" class="img-thumbnail" />
        </li>
    @else
        <li><img src="/Style/Images/avatar2.jpg" width="650" height="450" alt="Avatar" id="avatar_show" class="img-thumbnail" />
        </li>
    @endif
</ul>
    </div>

</div>
        <td><a href="{{ route('animals.index', $data['animal']->id) }}" class="btn btn-primary btn-lg" style="float: right;">    Atgal į sąrašą   </a></td>

  </div>
  </div>



  <div class="row">
    <div class="col-md-8" style="margin-top: 20px;">
<h3 class="comments-title"><span class="glyphicon glyphicon-comment"></span>{{ $data['animal']->rate()->count() }} Komentarai</h3>
@if(Auth::check())
@else
<div class="comment-content">Norint peržiūrėti komenterus - prisijunkite!</div>
@endif

           @foreach($data['animal']->rate as $comment)
        <div class="comment" style="margin-top: 45px;">
        <div class="author-info">

              @if($comment->photo_fk == 0)
                    <img src="/Style/Images/avatar.jpg" class="author-image" alt="">
                  @else
                    @foreach($data['foto'] as $photo)
                    @if($comment->photo_fk == $photo->id)
                    <img src="/{{$photo->url}}" class="author-image" alt="">
                    @endif
                   @endforeach
              @endif

        <div class="author-name">
        <h4>{{$comment->name}}</h4>
        <p class="author-time">{{ date('F nS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
            </div>

          </div>

          <div class="comment-content">
            {{ $comment->comment }}

          </div>

        </div>
@endforeach
        </div>
  </div>


  <div class="row">
    <div id="comment-form" class="col-md-8" style="margin-top: 50px;">
      {{ Form::open(['route' => ['rate.store', $data['animal']->id], 'method' => 'POST']) }}
@if(Auth::check())
@if(Auth::user()->information_fk > 0)

        <div class="row">
          <div class="col-md-6">
            {{ Form::label('name', "Vardas:") }}
           <input autofocus type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->user_information->name }}" readonly>

          </div>

          <div class="col-md-6">
            {{ Form::label('email', 'El.paštas:') }}
             <input autofocus type="text" name="email" class="form-control" id="name" value="{{ Auth::user()->email }}" readonly>
          </div>

          <div class="col-md-12">
            {{ Form::label('comment', "Komentaras:") }}
            {{ Form::textarea('comment', null, ['class' => 'form-control', 'required' => '', 'rows' => '5']) }}


@if(Auth::user()->user_information->photo_fk != 0)
  <input type="hidden" name="photo_fk" class="form-control" id="photo_fk" value="{{ Auth::user()->user_information->photo->id }}">
@else  <input type="hidden" name="photo_fk" class="form-control" id="photo_fk" value="0">
@endif
            <div class="col-md-12">
           {{ Form::submit('Pridėti komentarą', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;']) }}
          </div>

@endif
@endif
      {{ Form::close() }}
    
  </div>

@endsection
@section('scripts')
  <script src="/Style/Js/Image_upload.js"></script>
@endsection

