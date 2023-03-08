<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;


class AdminController extends Controller
{
    
    public function users ()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        if($users)
            return response()->json([
                'users' => $users,
                'success' => true,
                'message' => 'users retreived successfully'
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'users can not be retreived'
            ], 500);
    }

    public function getUserById ($id)
    {
        $user = User::find($id);
        if($user)
            return response()->json([
                'user' => $user,
                'success' => true,
                'message' => 'user retreived successfully'
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'user can not be retreived'
            ], 500);
    }

    public function getProjectById (User $user, $id)
    {
        $project = $user->projects()->find($id);
        if($project)
            return response()->json([
                'project' => $project,
                'success' => true,
                'message' => 'project retreived successfully'
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'project can not be retreived'
            ], 500);
    }

    public function projects()
    {
        $projects = Project::all();
        if($projects)
            return response()->json([
                'projects' => $projects,
                'success' => true,
                'message' => 'projects retreived successfully'
            ], 200);
        else
            return response()->json([
            'sucess' => false,
            'message' => 'projects can not be retreived'
        ], 500);
    }

    public function setDeveloper (Project $project,User $user)
    {
        $iduser = User::find($user);
        $result = $project->users()->attach($iduser);
        if (!$result)
            return response()->json([
                'success' => true,
                'message' => "developer created successfully."
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Validation Error: developer not added.'
            ], 500);
    }

    public function removeDeveloper (Project $project,User $user)
    {
        $iduser = User::find($user);
        if ($project->users()->detach($iduser))
            return response()->json([
                'success' => true,
                'message' => "developer removed successfully."
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Remove Error: developer not removed'
            ], 500);
    }

    public function getDevelopers (Project $project)
    {
        $result = $project->users;
        return response()->json([
            'DevList' => $result,
            'message' => 'Developers list of project '.$project->name
        ], 200);
    }

}
