<?php

namespace App\Http\Controllers\V1\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Clinic related functionns served to users.
 * @package  App\Http\Controllers\
 */
class UsersController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('profile', 'profile.educationLevel', 'profile.reason')->paginate(50);
        return response()->json($users, 200);   
    }

    public function deletedUser(){
        $users = User::onlyTrashed()->get();
        return response()->json($users, 200);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::withTrashed()->find($id)->restore();
        // $res = $user->update($request->only('deleted_at'));
        if($user){
            return response()->json('restored', 200);
        } else {
            return response()->json('not restored', 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $res = $user->delete();
        
        if($res == 1){
            return response()->json('Done', 200);
        } else {
            return response()->json('Not done', 501);
        }
    }
}
