<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AgeGroup;
use App\UserInformation;
use App\Photo;
use App\User;
use App\EmailConfirm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Session;
use Image;
use Storage;
use App\Animal;
use App\Rate;
use App\RatedAnimals;
use App\AnimalType;
use App\StarsValue;
use App\Amenities;
use App\AmenityAnimals;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::all();
        $data = array(
            'animals'    => $animals,
            'count'    => Animal::count(),
        );
   
        return view('animals.index')->with('data', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //tikrinu ar vartotojos prisijunges
        if(Auth::check()){
        if(Auth::user()->Role->id == 1)
        {
        foreach(animalType::all() as $ce){$animal[]= $ce -> name;}
        foreach(Amenities::all() as $ct){$cat[]= $ct; }
            $data = array(
                'animal' => $animal,
                'cat' => $cat,
            );
        return view('animals.create')->with('data', $data);
        }
        }
       return redirect('/animals');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        //tikrinu ar vartotojas prisijunges
        if(Auth::check()){
        if(Auth::user()->Role->id == 1)
        {
        //validate the data
        $this->validate($request,array(
            'name'        => 'required|max:10',
            'age'         => 'required|max:4',
            'body'          => 'required',
            'animal_type_fk'  => 'required',
            'animal_image'    => 'sometimes|image'
            
            ));

            $v = Validator::make($request->all(), []);  
            if(Animal::where('name', $request->input('name'))->exists())
            {
                Session::flash('warning', 'Gyvūno vardas jau egzistuoja!');
                return redirect()->back()->withErrors($v->errors())->withInput();
            }

        // store in the database
        $animal = new Animal;
        $animal -> name       = $request -> name;
        $animal -> age        = $request -> age;
        $animal -> body         = $request -> body;
        $animal -> animal_type_fk = $request -> animal_type_fk;

        //save image
        if($request->hasFile('avatar')){
            $animal_image = $request->file('avatar');
            $ext = $animal_image->getClientOriginalExtension();
            $filename = time(). '.' . $ext;
            $location = public_path('database/animals/'. $filename);
            File::isDirectory(public_path('database/animals/')) or File::makeDirectory(public_path('database/animals/'), 0777, true, true);
            $img = Image::make($animal_image)->resize(250, 250)->save($location);

        //Photo
            $photo = new Photo;
            $photo->url       = 'database/animals/' . $filename;
            $photo->ext       = $ext;
            $photo->size      = $img->filesize();
            $photo->cover     = 1;
            $photo->save();
            $animal -> photo_fk = $photo->url;
        }

//        dd($animal);
        
        $animal -> save();

        //save_amenities
         if($request->input('amenities')!= NULL){
                    foreach ($request->input('amenities') as $amenitie) {
            $amenitie_animal = new Amenityanimals;
            $amenitie_animal->animal_id = $animal->id;
            $amenitie_animal->amenity_id = $amenitie;
            $amenitie_animal -> save();
        }
        }
        //sėkmės pranešimas
        Session::flash('succsess', 'Naujas gyvūnas pridėtas.');
        //redirect to another page
        return redirect() -> route('animals.show',$animal->id);
        }
    }else{ return redirect('/animals');}
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       $animal=Animal::find($id);
       $average=Rate::where('animal_id', $id) -> avg('value_id');
       foreach(Amenities::all() as $ce){$catt[]= $ce;}
        foreach(Photo::all() as $cee){$foto[]= $cee;}
       
       foreach(Amenityanimals::all() as $cem){$cat1[]= $cem;}
       foreach(StarsValue::all() as $ct){$cat[]= $ct -> value;}
       if($cat1!=NULL){
                $data = array(
                'animal' => $animal,
                'cat' => $cat,
                'average' => $average,
                'catt' => $catt,
                'cat1' => $cat1,
                'foto'  => $foto,
                );
       }else{
                $data = array(
                'animal' => $animal,
                'cat' => $cat,
                'average' => $average,
                'catt' => $catt,
                'foto'  => $foto,
                );
       }
        return view('animals.show')->with('data',$data);
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function selected($selected_amenities, $id)
    {
      foreach ($selected_amenities as $selected_amenity) {
        if($selected_amenity->amenity_id == $id) return true;
      }
      return false;
    }

    public function edit($id)
    {

        if(Auth::check() && Auth::user()->Role->id == 1)
        {
          $animal = Animal::find($id);
          $cat = array();
          $amenities = Amenities::all();
          $amenities_result = array();
          foreach(animalType::all() as $ct){$cat[]= $ct -> name;}
          foreach($amenities as $amenitiy)
          {
            $amenities_result[] = (object)array(
              'id' => $amenitiy->id,
              'name' => $amenitiy->name,
              'checked' => ($this->selected(Amenityanimals::where('animal_id', $id)->get(), $amenitiy->id)) ? 'checked' : '',
            );
          }
          $data = array(
            'animal' => $animal,
            'cat' => $cat,
            'catt' => $amenities_result,
          );
          return view('animals.edit')->with('data',$data);
        }
      return redirect('/animals');
    }

    public function update(Request $request, $id)
    {

        // Validate the data
        $this->validate($request,array(
            'name'        => 'required|max:10',
            'age'         => 'required|max:4',
            'body'          => 'required',
            'animal_type_fk'  => 'required',
            'animal_image'    => 'image'
            ));

        // Save to the database
        $animal = Animal::find($id);
        $animal -> name       = $request -> input('name');
        $animal -> age        = $request -> input('age');
        $animal -> body         = $request -> input('body');
        $animal -> animal_type_fk   = $request -> input('animal_type_fk');

            if($request->hasFile('avatar'))
            {
              //tikrinu ar yra nuotrauka
            if(Photo::where('url',$animal->photo_fk)->exists())
            {
                  $id = Photo::where('url', $animal->photo_fk) -> first() -> id;
                  $photo = Photo::find($id);
                  //$photo->delete();
            }else
            {
                $photo = new Photo;
            }

            $animal_image = $request->file('avatar');
            $ext = $animal_image->getClientOriginalExtension();
            $filename = time(). '.' . $ext;
            $location = public_path('database/animals/'. $filename);
            
            $img = Image::make($animal_image)->resize(250, 250)->save($location);
            $oldFilename = $animal->photo_fk;
            //update
            $animal->photo_fk = 'database/animals/'. $filename;
            //Photo
            $photo->url     = 'database/animals/' . $filename;
            $photo->ext     = $ext;
            $photo->size    = $img->filesize();
            $photo->cover   = 1;
            $photo->save();
            $animal -> photo_fk = $photo->url;
            //delete
            File::delete(public_path($oldFilename));
            }

        //amenitie_remove
        $id_amenity_animal = Amenityanimals::where('animal_id', $animal->id) -> count();
        if($id_amenity_animal != NULL){
          for ($x = 0; $x < $id_amenity_animal; $x++) {
            $id_amenity_animalm = Amenityanimals::where('animal_id', $animal->id) -> first() -> id;
            $amenity = Amenityanimals::find($id_amenity_animalm);
            $amenity->delete();
          }  
        }
        //save_amenities
         if($request->input('amenities')!= NULL){
            foreach ($request->input('amenities') as $amenitie) {
              $amenitie_animal = new Amenityanimals;
              $amenitie_animal->animal_id = $animal->id;
              $amenitie_animal->amenity_id = $amenitie;
              $amenitie_animal -> save();
        }}        
        $animal -> save();
        //set flash data with success message
        Session::flash('succsess', 'Informacija atnaujinta');
        // redirect wth flash data to animals.show
        return redirect() -> route('animals.show',$animal->id);
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id2)
    {
        if(Auth::check()){
        if(Auth::user()->Role->id == 1)
        {
      
        $animal = Animal::find($id2);
        if($animal->photo_fk != NULL){
        $id = Photo::where('url', $animal->photo_fk) -> first() -> id;
        $photo = Photo::find($id);
        $photo -> delete();
        File::delete(public_path($animal->photo_fk));

        //amenitie_remove
        $id_amenity_animal = Amenityanimals::where('animal_id', $animal->id) -> count();
        if($id_amenity_animal != NULL){
          for ($x = 0; $x < $id_amenity_animal; $x++) {
            $id_amenity_animalm = Amenityanimals::where('animal_id', $animal->id) -> first() -> id;
            $amenity = Amenityanimals::find($id_amenity_animalm);
            $amenity->delete();
            }  
        }

        }else{
             //amenitie_remove
             $id_amenity_animal = Amenityanimals::where('animal_id', $animal->id) -> count();
             for ($x = 0; $x < $id_amenity_animal; $x++) {
                $id_amenity_animalm = Amenityanimals::where('animal_id', $animal->id) -> first() -> id;
                $amenity = Amenityanimals::find($id_amenity_animalm);
                $amenity->delete();
                }
            //rate_remove
             $id_rated_animal = RatedAnimals::where('animal_id', $animal->id) -> count();
             for ($x = 0; $x < $id_rated_animal; $x++) {
                $id_rated_animalm = RatedAnimals::where('animal_id', $animal->id) -> first() -> id;
                $rates = RatedAnimals::find($id_rated_animalm);
                $rates->delete();
                } 
          }
        $animal->delete();
        Session::flash('succsess', 'Gyvūnas pašalintas');
        return redirect()->route('animals.index');
    }
    }
    return redirect('/animals');
}
}