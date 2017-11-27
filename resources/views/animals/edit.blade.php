@extends('GyvunuGloba.Layout.main')

@section('title','|Gyvūno redagavimas')

@section('width') <div class="col-md-12"> @endsection


@section('content')

  <div class="col-md-12 alert alert-info text-center" role="alert">
    <strong>Gyvūno redagavimas:</strong> Pakeiskite norimą informacija.
  </div>

  <div class="col-md-6 well">


      <h1>Redaguoti Gyvūno informaciją</h1>
      <hr>
      {!! Form::model($data['animal'], ['route' => ['animals.update', $data['animal'] -> id], 'method'=>'PUT', 'files' =>true]) !!}
         {{ Form::label('body','Gyvūno vardas:') }}
         {{ Form::textarea('body',null, array('class' => 'form-control', 'required' => '','minlength' => '10', 'maxlength' => '255')) }}
        
        <div class="form-group">
            <label for="">Gyvūno tipas</label>
            {{ Form::select('animal_type_fk', $data['cat'],null,array('class'=>'form-control','style'=>'width: 25%;')) }}
        </div>

        <div class="form-group">
       <label for="">Gyvūno patogumai: </label>
        <div class="checkbox" name="animal_type_fk">    
       
 
        @foreach($data['catt'] as $type) 
          <label>
              <input type="checkbox" name="amenities[]" {{ $type->checked }} value="{{ $type->id }}" >{{ $type->name }}
          </label></br>
        @endforeach
          

</div>
       </div>
        {{ Form::label('price','Kaina:') }}
        {{ Form::number('price',null, array('class' => 'form-control', 'required' => '','min' => '0','minlength' => '3', 'maxlength' => '4')) }}


      
        {{ Form::label('body','Aprašymas:') }}
        {{ Form::textarea('body',null, array('class' => 'form-control', 'required' => '','minlength' => '10', 'maxlength' => '255')) }}
        <br>
        <div class="col-sm-6">
         {!! Html::linkRoute('animals.show', 'Atšaukti', array($data['animal']->id), array('class' => 'btn btn-danger btn-block')) !!}
          </div>
          <div class="col-sm-6">
            
            {{  Form::submit('Pakeisti', array('class' => 'btn btn-success btn-block')) }}
          </div>

     

  </div>
    <div class="col-md-6  well">
    <h1>Gyvūno nuotrauka</h1>
    <hr>
    @if($data['animal']->photo_fk != NULL)
        <img src="{{ asset($data['animal']->photo_fk) }}" width="650" height="450" alt="Avatar" id="avatar_show" class="img-thumbnail" />
    @else
        <img src="/Style/Images/avatar2.jpg" width="650" height="450" alt="Avatar" id="avatar_show" class="img-thumbnail" />
    @endif
    
      <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
      <input style="margin: 0 auto !important" type="file" id="avatar" name="avatar">
      @if ($errors->has('avatar'))
          <span class="help-block">
              <strong>{{ $errors->first('avatar') }}</strong>
          </span>
      @endif
      <br><button id="remove_button" type="button" class="hidden btn btn-danger btn-lg" style="width:250px;"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Pašalinti</button>
    </div>
    </div>
     {!! Form::close() !!}
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  </div>
  
@endsection
@section('scripts')
  <script src="/Style/Js/Image_upload.js"></script>
@endsection
