<?php

namespace App\Http\Controllers;

use App\Permission;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    /**the corresponding policy method will automatically be invoked
     before the controller method is executed
     */
    // public function __construct(){

    //     $this->authorizeResource(Permission::class,'permission');
        
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Permission::class);
        $permissions = Permission::all();
        return response()->json($permissions,200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Permission::class);
        $permission = Permission::create([
            'name'=>$request->name
        ]);
        return response()->json($permission,201);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',Permission::class);
        $permission = Permission::find($id);
        if(is_null(($permission))){
            return response()->json(['message' =>'Not Found']);
        }
        return response()->json($permission,200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {   
        $this->authorize('update',Permission::class);
       $permission = Permission::find($id);
       if(is_null($permission)){
           return response()->json(['message'=>'Not Found']);
       }
       $permission->name = $request->name;
       $permission->save();
       return response()->json($permission,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Permission::class);
        $permission = Permission::find($id);
        if(is_null($permission)){
            return response()->json(['message'=>"Not Found"]);
        }        
        $permission->delete();
        return response()->json(['message'=>"deleted"]);
    }
}
