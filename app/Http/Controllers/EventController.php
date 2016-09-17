<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use Input;

class EventController extends Controller
{
    

	    public function index(){

           $events = Event::all() ;


           
           return view('event.index')
                ->with('title', 'List of All Events')
                ->with('eventCounter', 1)
                ->with('events', $events);

	    }



	    public function create(){

        return view('event.create')
                ->with('title', 'Add a Event');

	    }


	    public function store(Request $request){

              $event = new Event();

              $event->name =    Input::get('name');
              $event->date =    Input::get('date');
              $event->description = Input::get('details');
              $event->place =    Input::get('place');

             $event->save();

             return redirect()->route('event.index')->with('success', 'Event Added Successfuly.');



	    }


	    public function show(){

        return view('event.create')
                ->with('title', 'Add a Project');

	    }


	    public function destroy($id)
	    {
	        try {
	            Event::destroy($id);
	            return redirect()->route('event.index')->with('success','Event Deleted Successfully.');

	        } catch(Exception $ex){
	            return redirect()->route('event.index')->with('error','Something went wrong.Try Again.');
	        }
	    }





}


?>