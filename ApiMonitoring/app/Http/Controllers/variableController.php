<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\variable;
use App\Models\page;

class variableController extends Controller
{
    //
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(page $page)
    {
        $variables = $page->variables;
 
        return response()->json([
            'success' => true,
            'message' => "variable List",
            'data' => $variables
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request,page $page)
    {
        $this->validate($request, [
            'name' => 'required',
            'value' => 'required',
            'configuration' => 'required',
            'description' => 'required'
        ]);
 
        $variable = new variable();
        $variable->name = $request->name;
        $variable->value = $request->value;
        $variable->page_path = $page->path;
        $variable->configuration = $request->configuration;
        $variable->description = $request->description;

        $tabvariables = $page->variables;
        $bool = true;

        foreach($tabvariables as $tab){
            if($request->name === $tab["name"]){
                if($request->value === $tab["value"]){
                    $bool = false;
                    break;
                }
            }
        }
        
        if($bool){
            if ($page->variables()->save($variable))
                return response()->json([
                    'success' => true,
                    'message' => "variable created successfully.",
                    'data' => $variable->toArray()
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error: variable not added'
                ], 500);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'access denied: This page already has a variale of the same value'
            ], 400);
        }
    }
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(page $page, $id)
    {
        $variable = $page->variables()->find($id);
 
        if (!$variable) {
            return response()->json([
                'success' => false,
                'message' => 'variable not found '
            ]);
        }
 
        return response()->json([
            'success' => true,
            'message' => "variable retrieved successfully.",
            'data' => $variable->toArray()
        ]);
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
public function update(Request $request,page $page, $id)
    {
        $variable = $page->variables()->find($id);

        if (!$variable) {
            return response()->json([
                'success' => false,
                'message' => 'variable not found'
            ], 400);
        }

        $tabvariables = $page->variables;        
        $bool = true;

        if(isset($request->page_path))
        $request->merge(['page_path' => $page->path]);

        if(isset($request->value)){
            if(isset($request->name)){
                foreach($tabvariables as $tab){
                    if($request->name === $tab["name"]){
                        if($request->value === $tab["value"]){
                            $bool = false;
                            break;
                        }
                    }
                }
                if($bool){
                    $updated = $variable->fill($request->all())->save();
        
                    if ($updated)
                        return response()->json([
                            'success' => true,
                            'message' => 'variable updated successfully.',
                            'data' => $variable
                        ]);
                    else
                        return response()->json([
                            'success' => false,
                            'message' => 'variable can not be updated'
                        ], 500);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'access denied: This page already has a variale of the same value'
                    ], 400);  
                }
            }else{
                foreach($tabvariables as $tab){
                    if($variable->name === $tab["name"]){
                        if($request->value === $tab["value"]){
                            $bool = false;
                            break;
                        }
                    }
                }
                if($bool){
                    $updated = $variable->fill($request->all())->save();
        
                    if ($updated)
                        return response()->json([
                            'success' => true,
                            'message' => 'variable updated successfully.',
                            'data' => $variable
                        ]);
                    else
                        return response()->json([
                            'success' => false,
                            'message' => 'variable can not be updated'
                        ], 500);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'access denied: This page already has a variale of the same value'
                    ], 400);
                }
            }
        }

        if(isset($request->name)){
            if(isset($request->value)){
                foreach($tabvariables as $tab){
                    if($request->name === $tab["name"]){
                        if($request->value === $tab["value"]){
                            $bool = false;
                            break;
                        }
                    }
                }
                if($bool){
                    $bool1 = true;
                    foreach($tabvariables as $tab){
                        if($request->name === $tab["name"]){
                            $bool1 = false;
                            break;
                        }
                    }
                    if($bool1){
                        return response()->json([
                                'success' => false,
                                'message' => 'You can not update this variable with this name'
                            ], 400);   
                    }
                    else{
                        $updated = $variable->fill($request->all())->save();
            
                        if ($updated)
                            return response()->json([
                                'success' => true,
                                'message' => 'variable updated successfully.',
                                'data' => $variable
                            ]);
                        else
                            return response()->json([
                                'success' => false,
                                'message' => 'variable can not be updated'
                            ], 500);
                    }
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'access denied: This page already has a variale of the same value'
                    ], 400);
                }
            }else{
                if($request->name !== $variable->name){
                    foreach($tabvariables as $tab){
                        if($request->name === $tab["name"]){
                            $bool = false;
                            break;
                        }
                    }
                    if($bool){
                        return response()->json([
                            'success' => false,
                            'message' => 'You can not update this variable with this name'
                        ], 400);
                    }else{
                        $bool1 = true;
                        foreach($tabvariables as $tab){
                            if($request->name === $tab["name"]){
                                if($variable->value === $tab["value"]){
                                    $bool1 = false;
                                    break;
                                }
                            }
                        }
                        if($bool1){
                            $updated = $variable->fill($request->all())->save();
                
                            if ($updated)
                                return response()->json([
                                    'success' => true,
                                    'message' => 'variable updated successfully.',
                                    'data' => $variable
                                ], 200);
                            else
                                return response()->json([
                                    'success' => false,
                                    'message' => 'variable can not be updated'
                                ], 500);
                        }
                        else{
                            return response()->json([
                                'success' => false,
                                'message' => 'access denied: This page already has a variale of the same value'
                            ], 400);
                        } 
                    }
                }   
            }
        }
        $updated = $variable->fill($request->all())->save();
        
        if ($updated)
            return response()->json([
                'success' => true,
                'message' => 'variable updated successfully.',
                'data' => $variable
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'variable can not be updated'
            ], 500);
    }    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(page $page, $id)
    {
        $variable = $page->variables()->find($id);

        if (!$variable) {
            return response()->json([
                'success' => false,
                'message' => 'variable not found'
            ], 400);
        }
 
        if ($variable->delete()) {
            return response()->json([
                'success' => true,
                'message' => "variable deleted successfully."
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'variable can not be deleted'
            ], 500);
        }
    }
}
