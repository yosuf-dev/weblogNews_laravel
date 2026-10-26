<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class Admin
{
    public function admin()
    {
        $dbUserCount = User::count();
        $dbNewsCount = News::count();
        $dbNewsStatusVisable = News::all()->where("status", "==", "visable")->count();
        $dbNewsStatusDisable = News::all()->where("status", "==", "disable")->count();

        return view("admin.home", compact("dbUserCount", "dbNewsCount", "dbNewsStatusVisable", "dbNewsStatusDisable"));
    }
    public function adminUsers()
    {
        $dbUsers = User::all();
        return view("admin.users", compact("dbUsers"));
    }
    public function adminNews()
    {
        return view("admin.news");
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users-edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email
        ]);

        return redirect('/admin/users');
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);

        $user->delete();
        return redirect('/admin/users');
    }
    
    public function createUser(){
        return view("admin.users-create");
    }

    public function createUserTrue(Request $request){
        User::create([
            "first_name"=>$request->first_name,
            "last_name"=> $request->last_name,
            "email"=> $request->email,
            "status"=> $request->status
        ]);
        return redirect('/admin/users');
    }
    // public function test()
    // {
    //     $dbNewsCount = News::all();

    //     return dd($dbNewsCount);
    // }
}
