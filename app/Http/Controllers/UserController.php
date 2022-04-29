<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',  Auth::user());
        $users = User::all();
        return response()->json($users);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Auth::user());

        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'Not Fund']);

        }
        return response()-> json($user,201);
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
        //admin update user
        $user = User::find($id);
        if(is_null($user)){
            return  response()->json(['message'=>'Not fund']);
        }

        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        $user->roles()->detach();
        $user->permissions()->detach();
        $role = Role::where("name",$request->role)->get('id');
        $user->roles()->attach($role[0]->id);
        $permissions = $role[0]->permissions;
        $user->permissions()->attach($permissions);
        $user->save();
        return response()->json($user,200);
        //$this users update name or email or pass

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
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'user not fund']);
        }
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return response()->json(['message'=>'user deleted ']);
        
    }


    public function show_user_by_role($id){
        $this->authorize('view',  Auth::user());

        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'user not found']);
        }
        $per = [];
        for($i=0;$i<count($user->permissions);$i++){
            $per[] = $user->permissions[$i]->name;
        }
        foreach ($user->roles as $role){
            $oneuser=array("id_user"=>$user->id,
                    "email"=>$user->email,
                    "name"=>$user->name,
                    "id_role"=>$role->id,
                    "role name"=>$role->name,
                    "permissions"=>$per
                );
        }
        return response()->json($oneuser,201);

    }


    public function all_users_by_role(){
        $this->authorize('view',  Auth::user());
        $users = User::all();
        $userroles=[];
       

        //fetch all user
        foreach($users as $user){
            $per = [];
        // fetch user by permission and get all the permissions
            for($i=0;$i<count($user->permissions);$i++){
                $per[] = $user->permissions[$i]->name;
            }
        //fetch user by role an get the role 
            foreach ($user->roles as $role ){
                $oneuser=array("id_user"=>$user->id,
                "email"=>$user->email,
                "name"=>$user->name,
                "role"=>$role->name,
                "permissions" =>$per);
                array_push($userroles,$oneuser);    
            }
        
        }
        return response()->json($userroles,200);
    }


    
    
}
