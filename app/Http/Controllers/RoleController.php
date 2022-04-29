<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Auth::User());
        $roles = Role::all();
        return response()->json($roles,201);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Auth::user());
        $role = Role::create([
            'name'=> $request->name,
        ]);
        return response()->json($role,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view',Auth::User());
        $role = Role::find($id);
        if(is_null($role)){
            return response()->json(['message'=>'Not found']);
        }
        return response()->json($role,200);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Auth::user());
        $role = Role::find($id);
        if(is_null($role)){
            return response()->json(['message'=>'not found']);
        }
        $role->name = $request->name;
        $role->save();
        return response()->json($role,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Auth::user());
        $role = Role::find($id);
        if(is_null($role)){
            return response()->json(['message'=>'not found']);
        }
        $role->delete();
        return response()->json('role has deleted');
    }
}
