<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Language;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();
        return view('language.index')
                        ->with('title', 'List of all Languages')
                        ->with('languages', $languages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('language.create')
                        ->with('title', 'Add Language');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required'
            ];

        $data = $request->all();
        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $language = new Language();
        $language->name = $data['name'];
        if($language->save()) {
            return redirect()->route('language.index')->with('success','Language Successfully Added');
        } else {
            return redirect()->route('language.index')->with('error','Something went wrong. Try Again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('language.edit')
                        ->with('title', 'Edit language')
                        ->with('language', $language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required'
            ];

        $data = $request->all();
        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $language = Language::findOrFail($id);
        $language->name = $data['name'];
        if($language->save()) {
            return redirect()->route('language.index')->with('success','Language Successfully Updated');
        } else {
            return redirect()->route('language.index')->with('error','Something went wrong. Try Again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Language::destroy($id);

            return redirect()->route('language.index')->with('success','Language Deleted Successfully.');

        }catch(Exception $ex){
            return redirect()->route('language.index')->with('error','Something went wrong.Try Again');
        }
    }
}
