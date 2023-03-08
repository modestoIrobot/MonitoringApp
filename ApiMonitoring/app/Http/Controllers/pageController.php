<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\page;
use App\Models\Project;

class pageController extends Controller
{
    //
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Project $project)
    {
        $pages = $project->pages;
 
        return response()->json([
            'success' => true,
            'message' => "page List",
            'data' => $pages
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request,Project $project)
    {
        $this->validate($request, [
            'name' => 'required',
            'path' => 'required',
            'uri' => 'required',
            'type_page' => 'required',
            'description' => 'required'
        ]);
        
        $page = new page();
        $page->name = $request->name;
        $page->path = $project->name.'/'.$request->path;
        $page->uri = $request->uri;
        $page->type_page = $request->type_page;
        $page->description = $request->description;

        $tabpages = $project->pages;
        $bool = true;

        foreach($tabpages as $tab){
            if($request->name === $tab["name"]){
                $bool = false;
                break;
            }
        }
        
        if($bool){
            if($request->type_page === 'interface'){
                foreach($tabpages as $tab){
                    if($request->uri === $tab["uri"]){
                        $bool = false;
                        break;
                    }
                }
                if($bool){
                    if ($project->pages()->save($page))
                        return response()->json([
                            'success' => true,
                            'message' => "page created successfully.",
                            'data' => $page->toArray()
                        ], 200);
                    else
                        return response()->json([
                            'success' => false,
                            'message' => 'Validation Error: page not added'
                        ], 500);
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'access denied: This project already has a interface of the same uri'
                    ], 400);
                }
            }else{   
                if ($project->pages()->save($page))
                    return response()->json([
                        'success' => true,
                        'message' => "page created successfully.",
                        'data' => $page->toArray()
                    ], 200);
                else
                    return response()->json([
                        'success' => false,
                        'message' => 'Validation Error: page not added'
                    ], 500);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'access denied: This project already has a page of the same name'
            ], 400);
        }
        
    }
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Project $project, $id)
    {
        $page = $project->pages()->find($id);
 
        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'page not found '
            ]);
        }
 
        return response()->json([
            'success' => true,
            'message' => "page retrieved successfully.",
            'data' => $page->toArray()
        ]);
    }
    /**
     * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function update(Request $request,Project $project, $id)
    {
        $page = $project->pages()->find($id);

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'page not found'
            ], 400);
        }

        $bool = true;
        $tabpages = $project->pages;

        if(isset($request->path))
        $request->merge(['path' => $project->name.'/'.$request->path]);

        if(isset($request->name)){
            if($request->name !== $page->name){
                foreach($tabpages as $tab){
                    if($request->name === $tab["name"]){
                        $bool = false;
                        break;
                    }
                }
                if($bool){
                    if(isset($request->uri)){
                        if($request->uri !== $page->uri && $page->type_page === 'interface'){
                            foreach($tabpages as $tab){
                                if($request->uri === $tab["uri"]){
                                    $bool = false;
                                    break;
                                }
                            }
                            if($bool){
                                $updated = $page->fill($request->all())->save();
                                if ($updated)
                                    return response()->json([
                                        'success' => true,
                                        'message' => "interface updated successfully.",
                                        'data' => $page->toArray()
                                    ], 200);
                                else
                                    return response()->json([
                                        'success' => false,
                                        'message' => 'Validation Error: interface can not be updated'
                                    ], 500);
                            }else{
                                return response()->json([
                                    'success' => false,
                                    'message' => 'access denied: This project already has a interface of the same uri'
                                ], 400);
                            }   
                        }
                    }else{
                        $updated = $page->fill($request->all())->save();
                        if ($updated)
                            return response()->json([
                                'success' => true,
                                'message' => 'page updated successfully.',
                                'data' => $page->toArray()
                            ], 200);
                        else
                            return response()->json([
                                'success' => false,
                                'message' => 'page can not be updated'
                            ], 500);
                    }
                }else{
                    return response()->json([
                    'success' => false,
                    'message' => 'access denied: This project already has a page of the same name'
                    ], 400);
                }
            }
        }
        
        if(isset($request->uri)){
            if($request->uri !== $page->uri && $page->type_page === 'interface'){
                foreach($tabpages as $tab){
                    if($request->uri === $tab["uri"]){
                        $bool = false;
                        break;
                    }
                }
                if($bool){
                    $updated = $page->fill($request->all())->save();
                    if ($updated)
                        return response()->json([
                            'success' => true,
                            'message' => "interface updated successfully.",
                            'data' => $page->toArray()
                        ], 200);
                    else
                        return response()->json([
                            'success' => false,
                            'message' => 'Validation Error: interface can not be updated'
                        ], 500);
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'access denied: This project already has a interface of the same uri'
                    ], 400);
                }   
            }
        }

        $updated = $page->fill($request->all())->save();
        
        if ($updated)
            return response()->json([
                'success' => true,
                'message' => 'page updated successfully.',
                'data' => $page->toArray()
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'page can not be updated'
            ], 500);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Project $project, $id)
    {
        $page = $project->pages()->find($id);

        if (!$page) {
            return response()->json([
                'success' => false,
                'message' => 'page not found'
            ], 400);
        }
 
        if ($page->delete()) {
            return response()->json([
                'success' => true,
                'message' => "page deleted successfully."
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'page can not be deleted'
            ], 500);
        }
    }

}
