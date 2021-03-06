@extends('GyvunuGloba.Layout.main')

@section('title','|Visi gyvūnai')

@section('width') <div class="col-md-12"> @endsection


@section('content')

  <div class="row">
    <div class="col-md-10">
      <h1>Gyvūnai</h1>
    </div>
        @if(Auth::check())
        @if( Auth::user()->Role->id == 1)
        
    <div class="col-md-2">
      <a href="{{ route('animals.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Pridėti gyvūną</a>
      <a href="{{ route('amenities.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Pridėti informaciją</a>
    </div>
        @endif
        @endif
    <div class="col-md-12">
      <hr>
    </div>
  </div> <!-- end of .row -->

  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <th> </th>
          <th>Tipas</th>
          <th>Amžius</th>
          <th>Aprašymas</th> 

          <th></th>
        </thead>

        <tbody>
          
          @foreach ($data['animals'] as $animal)
            
            <tr>
           
      @if($animal->photo_fk != NULL)
        <td><img src="{{ asset($animal->photo_fk) }}" width="100" height="150" alt="Avatar" id="avatar_show" class="img-thumbnail" /></td>
      @else
        <td><img src="/Style/Images/avatar2.jpg" width="100" height="150" alt="Avatar" id="avatar_show" class="img-thumbnail" /></td>
      @endif
      <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">


              @if($animal->animal_type_fk  == '0')
              <td>Šuo</td>
              @elseif($animal->animal_type_fk  == '1')
               <td>Katė</td>
              @elseif($animal->animal_type_fk  == '2')
               <td>Šinšila</td>
              @elseif($animal->animal_type_fk  == '3')
               <td>Jūrų kiaulyė</td>
              @endif


              <td>{{ $animal->age }} mėn.</td>
     
              <td>{{ substr($animal->body, 0, 50) }}{{ strlen($animal->body) > 50 ? "..." : "" }}</td>

              <td><a href="{{ route('animals.show', $animal->id) }}" class="btn btn-default btn-sm" style="float: right;">Plačiau</a>
              @if(Auth::check())
              @if( Auth::user()->Role->id == 1)
               <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-default btn-sm" style="float: right;">Redaguoti</a>
               <a href="{{ route('animals.destroy', $animal->id) }}" class="btn btn-default btn-sm " style="float: right;">Naikinti</a> </td>
              @endif
              @endif
          </tr>
          @endforeach

        </tbody>
      </table>
       
    </div>
  </div>

 
@endsection

