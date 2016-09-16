<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Language;
use App\User;
use App\Http\Requests\ProjectRequest;
use App\Project;
use App\Details;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // date("Y_m_d_His"); 
        $projects = Project::with('developer')->with('language')->with('category')->get();
        return view('project.index')
                ->with('title', 'List of All Projects')
                ->with('projectCounter', 1)
                ->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users =  array();
        
        $allUsers = User::all();
        foreach ($allUsers as $user) {
            if ($user->hasRole('admin')) {  // fetching all developers who are not admin 
                continue;
            }
            $users = [ $user->id => $user->name];
        }
        $languages = Language::lists('name', 'id');
        $categories = Category::lists('name', 'id');
        return view('project.create')
                ->with('categories', $categories)
                ->with('languages', $languages)
                ->with('users', $users)
                ->with('title', 'Add a Project');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();
        $developers = $request->input('developer_id');
        $languages = $request->get('language_id');
        $project = new Project();
        $project->name = $request->get('name');
        $project->git_link = $request->input('git_link');
        $project->tech_description = $request->input('tech_description');
        $project->category_id = $request->get('category_id');
        try {
            $project->save();
            $project->developer()->sync($request->get('developer_id'));
            $project->language()->sync($request->get('language_id'));
            $project->details()->create([]); // creating related details row object and insert to database
            return redirect()->route('project.index')->with('success', 'Project Added Successfuly.');
        } catch(Exception $ex) {
            return $ex;
            return redirect()->route('project.index')->with('error', 'Something Went Wrong. Try Again');
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
        $project = Project::where('id', $id)
                            ->with('details')
                            ->with('category')
                            ->with('developer')
                            ->with('supervisor')
                            ->with('language')->first();
        return $project; // json response to modal 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pp = Project::where('id', 1)->with('details')->with('language')->first();
        $project = Project::findOrFail($id);

        $selectedLanguage =  array();
        foreach ($project->language as $language) {
            $selectedLanguage[] = $language->id;
        }
        // return $selectedLanguage;

        $selectedDeveloper =  array();
        foreach ($project->developer as $developer) {
            $selectedDeveloper[] = $developer->id;
        }
         // return $selectedDeveloper;
        // return User::all();
        $users =  array();
        
        $allUsers = User::all();
        foreach ($allUsers as $user) {
            if ($user->hasRole('admin')) {  // fetching all developers who are not admin 
                continue;
            }
            $users = [ $user->id => $user->name];
        }
        // return $users;
        $projects = Project::lists('name', 'id');
        $languages = Language::lists('name', 'id');
        $categories = Category::lists('name', 'id');
        return view('project.edit')
                ->with('project', $project)
                ->with('categories', $categories)
                ->with('languages', $languages)
                ->with('selectedLanguage', $selectedLanguage)
                ->with('selectedDeveloper', $selectedDeveloper)
                ->with('users', $users)
                ->with('projects', $projects)
                ->with('title', 'Edit Project');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $data = $request->all();
        $developers = $request->input('developer_id');
        $languages = $request->get('language_id');

        $project = Project::find($id);
        $db_backup = '/uploads/db_backup';
        if($request->hasFile('db_backup')) {

            $file = $request->file('db_backup');

            $validator = Validator::make([
            // here use the path to the uploaded Image
            'db_backup' => $file ],
            [
                'db_backup' => 'max:50000|mimes:sql,zip,db,csv'
            ]);

            if($validator->fails())
            {
                return redirect()->back()->withErrors("Size too large or Invalid file");
            }

            $destination = public_path().'/uploads/db_backups/';
            $filename = date("Y_m_d_His").'_'.preg_replace("/[^a-zA-Z0-9]/", "",$project->name).$file->getClientOriginalExtension();
            $file->move($destination, $filename);
            $db_backup = '/uploads/db_backups/'.$filename;
        }
        /*
            DB::table('profiles')
                ->where('user_id', Auth::user()->id)
                ->update(['propic' => $propic]);
            return redirect()->route('profile')->withSuccess("Your Profile Picture Succesfully Updated.");
        } else {
            return redirect()->back()->withErrors("You did not select any photos");
        }
        */

        // fetch the object from main project table 
        
        $project->name = $request->get('name');
        $project->git_link = $request->input('git_link');
        $project->tech_description = $request->input('tech_description');
        $project->category_id = $request->get('category_id');

        // fetch this project details from details table 
        $projectDetails = Details::where('project_id', $id)->first();
        $projectDetails->domain = $data['domain'];
        $projectDetails->credentials = $data['credentials'];
        $projectDetails->description = $data['description'];
        $projectDetails->dependency = $data['dependency'];
        $projectDetails->db_backup = $db_backup;

        try {
            $project->save();
            $projectDetails->save(); // or the following method
            /* not tested yet
            $projectDetails = App\Details::where('project_id', $id)->first();
            $project->details()->save(['domain' => $data['domain'],
                                        'ceredentials' => $data['credentials'],
                                        'description' = $data['description'],
                                        'dependency' = $data['dependency']
                                    ]);
            */
            $project->developer()->sync($request->get('developer_id'));
            $project->language()->sync($request->get('language_id'));
            return redirect()->route('project.index')->with('success', 'Project Updated Successfuly.');
        } catch(Exception $ex) {
            return $ex;
            return redirect()->route('project.index')->with('error', 'Something Went Wrong. Try Again');
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
        try {
            Project::destroy($id);
            return redirect()->route('project.index')->with('success','Project Deleted Successfully.');

        } catch(Exception $ex){
            return redirect()->route('project.index')->with('error','Something went wrong.Try Again.');
        }
    }
}
