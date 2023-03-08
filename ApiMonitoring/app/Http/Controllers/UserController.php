<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class UserController extends Controller
{
    public function userInfo() 
    {
 
        $user = auth()->user();
        if($user->hasRole()){
            return response()->json(['user' => $user], 200);
        }else{
            return response()->json(['error' => 'the user has an invalid role'], 501);
        }
 
    }

    public function getProjects ()
    {
        $result = auth()->user()->projects2;
        return response()->json([
            'ProjectsList' => $result,
            'message' => 'My Dev Projects list'
        ], 200);
    }

    public function fonctionsByProject (Project $project)
    {
        $result = Project::join('pages','projects.id','=','pages.project_id')
                         ->join('fonctions','fonctions.page_id','=','pages.id')
                         ->where('projects.id',$project->id)
                         ->get();
        return response()->json([
            'Fonctions' => $result,
            'message' => 'List of functions of project'
        ], 200);
    }

    public function variablesByProject (Project $project)
    {
        $result = Project::join('pages','projects.id','=','pages.project_id')
                         ->join('variables','variables.page_id','=','pages.id')
                         ->where('projects.id',$project->id)
                         ->get();
        return response()->json([
            'Variables' => $result,
            'message' => 'List of configurations of project'
        ], 200);
    }
    
}
