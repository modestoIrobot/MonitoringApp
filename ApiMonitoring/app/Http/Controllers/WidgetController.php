<?php

namespace App\Http\Controllers;
use App\Models\widget;
use App\Models\page;

use Illuminate\Http\Request;

class WidgetController extends Controller
{
    //
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(page $page)
    {
        $widgets = $page->widgets;

        return response()->json([
            'success' => true,
            'message' => "widgets List",
            'data' => $widgets
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
 
        $widget = new widget();
        $widget->name = $request->name;
        if(isset($request->fonction)){
            $widget->fonction = $request->fonction;
        }
        $widget->description = $request->description;
        $tabwidgets = $page->widgets;
        $bool = true;
       
        foreach($tabwidgets as $tab){            
            if($widget->name === $tab["name"]){
                $bool = false;
                break;
            }
        }
        
        if($bool){
            if ($page->widgets()->save($widget))
                return response()->json([
                    'success' => true,
                    'message' => "widget created successfully.",
                    'data' => $widget->toArray()
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error: widget not added'
                ], 500);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'access denied: This interface already has a widget of the same name'
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
        $widget = $page->widgets()->find($id);
        if (!$widget) {
            return response()->json([
                'success' => false,
                'message' => 'widget not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'message' => "widget retrieved successfully.",
            'data' => $widget->toArray()
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
        $widget = $page->widgets()->find($id);
        if (!$widget) {
            return response()->json([
                'success' => false,
                'message' => 'widget not found'
            ], 400);
        }
        
        $bool = true;

        if(isset($request->name)){
            if($request->name !== $widget->name){
                $tabwidgets = $page->widgets;
                foreach($tabwidgets as $tab)
                {
                    if($request->name === $tab["name"]){
                        $bool = false;
                        break;
                    }
                }
                if($bool){
                    $updated = $widget->fill($request->all())->save();
                    if ($updated)
                        return response()->json([
                            'success' => true,
                            'message' => 'widget updated successfully.',
                            'data' => $widget
                        ], 200);
                    else
                        return response()->json([
                            'success' => false,
                            'message' => 'widget can not be updated'
                        ], 500);
                }else{
                    return response()->json([
                    'success' => false,
                    'message' => 'access denied: This interface already has a widget of the same name'
                    ], 400);
                }
            }
        }

        $updated = $widget->fill($request->all())->save();
       
        if ($updated)
            return response()->json([
                'success' => true,
                'message' => 'widget updated successfully.',
                'data' => $widget
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'widget can not be updated'
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
        $widget = $page->widgets()->find($id);
        if (!$widget) {
            return response()->json([
                'success' => false,
                'message' => 'widget not found'
            ], 400);
        }
 
        if ($widget->delete()) {
            return response()->json([
                'success' => true,
                'message' => "widget deleted successfully."
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'widget can not be deleted'
            ], 500);
        }
    }

}
