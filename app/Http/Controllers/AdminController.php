<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $superAdmin = Admin::where('userType', '=', 'Super')->get();
        if(count($superAdmin) > 0){
            return redirect('/loginView');
        } else {
            return view('admin/regSuperUser');
        }
    }
    public function getAdminDet(){
        if(Auth()->check()){
            return Auth()->user();
        } 
    }
    public function panel()
    {
        if(Auth()->check()){
            return view('admin/admin');
        } else {
            return redirect('/api/v1/admin');
        }
    }
    public function loginView(){
        return view('admin/adminLogin');
    }

    public function login(Request $request){
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required','string']
        ]);

        $admin = Admin::where('email', '=', $request->email)->first();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'verified' => 'Y'])) {
            Auth::login($admin, true);
            echo 200;
        } else {
            echo 501;
        }
        // echo $admin;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required','string'],
            'lastname' => ['required','string'],
            'email' => ['required','email'],
            'phone' => ['required','string'],
            'password' => ['required','string'],
            'verified' => ['required','string']
        ]);

        $admin = Admin::create([
            'firstname'     => $request->firstname,
            'lastname'     => $request->firstname,
            'email'     => $request->email,
            'verified' => $request->verified,
            'phone' => $request->phone,
            'password' => $pass = bcrypt($request->password),
        ]);

        // $admin = Admin::create($request->all());
        if($admin){
            $adminToken = $admin->createToken('accessToken')->accessToken;
            $admin->accessToken = $adminToken;
            $admin->save();
            auth()->login($admin, true);

            echo 200;
               
        } else {
            echo 501;
        }
        
        
    }


    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
