<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;

class PassportAuthController extends Controller
{
    //
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|min:4',
            'lastname' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
 
        $user = User::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        $result = [ 'user' => $user,
                    'token' => $token
        ];
        return response()->json($result, 200);
        
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $user = User::where('email', $request->email)->first();
            if($user->hasRole()){
                $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
                $result = [ 'user' => $user,
                            'token' => $token
                ];
                return response()->json($result, 200);
            }else{
                return response()->json(['error' => 'the user has an invalid role'], 501);
            }
        } else {
            return response()->json(['error' => 'Unauthorised user'], 401);
        }
    }

    public function logout ()
    {
        $token = auth()->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response()->json($response, 200);
    }

    public function getLast4Projects ()
    {
        if($projects = Project::latest()->take(4)->get())
            return response()->json([
                'success' => true,
                'message' => 'Recents projects',
                'projects' => $projects
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Validation error: internal error database'
            ], 400);
    }

}
