<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    //
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(User $user)
    {
    $projects = $user->projects;
 
        return response()->json([
            'success' => true,
            'message' => "project List",
            'data' => $projects
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'deployment' => 'required',
            'project_type' => 'required'
        ]);
 
        $project = new project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->deployment = $request->deployment;
        $project->project_type = $request->project_type;

        if ($user->projects()->save($project))
            return response()->json([
                'success' => true,
                'message' => "project created successfully.",
                'data' => $project->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Validation Error: project not added'
            ], 500);

    }
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(User $user, $id)
    {
        $project = $user->projects()->find($id);
 
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'project not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'message' => "project retrieved successfully.",
            'data' => $project->toArray()
        ]);
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function update(Request $request,User $user, $id)
    {
        $project = $user->projects()->find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'project not found'
            ], 400);
        }
        
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $updated = $project->fill($request->all())->save();
        
        if ($updated)
            return response()->json([
                'success' => true,
                'message' => 'project updated successfully.',
                'data' => $project
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'project can not be updated'
            ], 500);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $user, $id)
    {
        $project = $user->projects()->find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'project not found'
            ], 400);
        }
 
        if ($project->delete()) {
            return response()->json([
                'success' => true,
                'message' => "project deleted successfully."
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'the project can not be deleted'
            ], 500);
        }
    }

}
