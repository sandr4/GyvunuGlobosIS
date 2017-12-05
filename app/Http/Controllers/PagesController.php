<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Animal;
use App\RatedAnimals;
class PagesController extends Controller
{
	public function getIndex() {

		//$cat=array();
		$animals = Animal::orderBy('id', 'asc')->take(4)->get();
       /* foreach($animals = animal::orderBy('id', 'asc')->take(4)->get() as $ct)
         {
         	$users  = RatedAnimals::where('animal_id',$ct->id)->leftJoin('animals', 'rated_animals.animal_id', '=', 'animals.id') -> avg('rate_id');
         	$cat[]= $users;
         }  */
		$data = array(
            'animals' 	=> $animals,
            //'users'		=> $users,
            //'cat'		=> $cat,
        );
		return view("GyvunuGloba.index")->with('data', $data);
	}

	public function home() {

		//$cat=array();
		$animals = Animal::orderBy('id', 'asc')->take(4)->get();
		//$users  = RatedAnimals::leftJoin('animals', 'rated_animals.animal_id', '=', 'animals.id') -> avg('rate_id');

        /* foreach($animals = animal::orderBy('id', 'asc')->take(4)->get() as $ct)
         {	
         	$average=RatedAnimals::where('animal_id', $ct->id) -> avg('rate_id');
         	if($average!=NULL){
         		$arr=$ct->id;
         	}else $arr=0;
         	$cat[]= $average;
         	$cat2[]=$arr;
         }    */ 	
		$data = array(
            'animals' 	=> $animals,
            //'users'		=> $users,
            //'cat'		=> $cat,
            //'cat2'		=> $cat2,
             
        );
		if(Auth::user()->state->id == 2){
			return redirect('/registration');
		}
		return view("GyvunuGloba.index")->with('data', $data);
	}

}
