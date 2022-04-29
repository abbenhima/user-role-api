<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];


    public function users(){
        return $this->belongsToMany(User::class,'user_roles');
    } 
    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permissions');
    }


}
