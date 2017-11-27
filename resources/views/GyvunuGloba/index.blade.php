@extends('GyvunuGloba.Layout.main')
@section('title', ' Pagrindinis')
@section('search') @include('GyvunuGloba.Layout.Partials.search') @endsection
@section('slider') @include('GyvunuGloba.Layout.Partials.slider') @endsection
@section('width') <div class="col-md-9"> @endsection
@section('content')
 

  @foreach ($data['animals'] as $animal)

  <div class="col-sm-4 col-lg-4 col-md-4">
      <div class="thumbnail">          
      @if($animal->photo_fk != NULL)
        <img src="{{ asset($animal->photo_fk) }}" width="320" height="150" alt="Avatar" id="avatar_show" class="img-thumbnail">
      @else
       <img src="/Style/Images/avatar2.jpg" width="320" height="150" alt="Avatar" id="avatar_show" class="img-thumbnail">
      @endif
      <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
          <div class="caption">
         
              @if($animal->animal_type_fk  == '0')

              <h4><a href="{{ route('animals.show', $animal->id) }}">Šuo</a>
              @endif
              @if($animal->animal_type_fk  == '1')
              <h4><a href="{{ route('animals.show', $animal->id) }}">Katė</a>
              @endif
              @if($animal->animal_type_fk  == '2')
              <h4><a href="{{ route('animals.show', $animal->id) }}">Šinšila</a>
              @endif
              @if($animal->animal_type_fk  == '3')
              <h4><a href="{{ route('animals.show', $animal->id) }}">Jūrų Kiaulytė</a>
              @endif
              </h4>
              <p>{{ substr($animal->body, 0, 50) }}{{ strlen($animal->body) > 50 ? "..." : "" }} </p>
              </h4>
          </div>
      </div>
      </div>
  </div>

  @endforeach

  <div class="col-sm-4 col-lg-4 col-md-4">
      <h4><a href="#">Norite sužinoti daugiau informacijos?</a>
      </h4>
      <p>Prisijunkite prie sistemos! </p>

  </div>
    </div>
@endsection