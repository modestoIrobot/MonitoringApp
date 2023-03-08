<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fonction;
use App\Models\page;

class fonctionController extends Controller
{
    //
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(page $page)
    {
        $fonctions = $page->fonctions;
 
        return response()->json([
            'success' => true,
            'message' => "functions List",
            'data' => $fonctions
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
            'description' => 'required'
        ]);
 
        $fonction = new fonction();
        $fonction->name = $request->name;
        $fonction->workflow = $page->path.'/'.$request->name;
        $fonction->description = $request->description;

        $tabfunctions = $page->fonctions;
        $bool = true;

        foreach($tabfunctions as $tab){
            if($fonction->name === $tab["name"]){
                $bool = false;
                break;
            }
        }
        
        if($bool){
            if ($page->fonctions()->save($fonction))
                return response()->json([
                    'success' => true,
                    'message' => "function created successfully.",
                    'data' => $fonction->toArray()
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error: function not added'
                ], 500);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'access denied: This page already has a function of the same name'
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
        $fonction = $page->fonctions()->find($id);
 
        if (!$fonction) {
            return response()->json([
                'success' => false,
                'message' => 'function not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'message' => "function retrieved successfully.",
            'data' => $fonction->toArray()
        ], 200);
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
        $fonction = $page->fonctions()->find($id);

        if (!$fonction) {
            return response()->json([
                'success' => false,
                'message' => 'function not found'
            ], 400);
        }
        
        $bool = true;

        if(isset($request->workflow)){
            if(isset($request->name)){
                $request->merge(['workflow' => $page->path.'/'.$request->name]);
            }else{
                $request->merge(['workflow' => $page->path.'/'.$fonction->name]);
            }
        }

        if(isset($request->name)){
            $request->merge(['workflow' => $page->path.'/'.$request->name]);
            if($request->name !== $fonction->name){
                $tabfunctions = $page->fonctions;
                foreach($tabfunctions as $tab){
                    if($request->name === $tab["name"]){
                        $bool = false;
                        break;
                    }
                }
                if($bool){
                    $updated = $fonction->fill($request->all())->save();
                    if ($updated)
                        return response()->json([
                            'success' => true,
                            'message' => 'function updated successfully.',
                            'data' => $fonction
                        ], 200);
                    else
                        return response()->json([
                            'success' => false,
                            'message' => 'function can not be updated'
                        ], 500);
                }else{
                    return response()->json([
                    'success' => false,
                    'message' => 'access denied: This page already has a function of the same name'
                    ], 400);
                }
            }
        }

        $updated = $fonction->fill($request->all())->save();
        
        if ($updated)
            return response()->json([
                'success' => true,
                'message' => 'function updated successfully.',
                'data' => $fonction
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'function can not be updated'
            ], 500);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(page $page, $id)
    {
        $fonction = $page->fonctions()->find($id);

        if (!$fonction) {
            return response()->json([
                'success' => false,
                'message' => 'function not found'
            ], 400);
        }
 
        if ($fonction->delete()) {
            return response()->json([
                'success' => true,
                'message' => "function deleted successfully."
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'function can not be deleted'
            ], 500);
        }
    }
    
}
