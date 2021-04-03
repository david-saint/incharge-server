<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Admin;
use App\Models\EducationLevel;
use App\Http\Resources\General\GenericNamedResource;
use App\Models\ContraceptionReason;
use App\Http\Resources\General\ContraceptionReasonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('isAdmin', ['except' => [
            'index', 'login', 'store', 'logout', 'loginView', 'panel'
        ]]);
    }
    
    public function index()
    {
        $superAdmin = Admin::where('userType', '=', 'Super')->get();
        if(count($superAdmin) > 0){
            return redirect('/loginView');
        } else {
            return view('admin/regSuperUser');
        }
    }
    public function allUsers()
    {
        $users = User::with('profile', 'profile.educationLevel', 'profile.reason')->paginate(50);
        return response()->json($users, 200);   
    }
    public function deletedUser(){
        $users = User::onlyTrashed()->get();
        return response()->json($users, 200);  
    }
    public function revertDeletedUser($id)
    {
        $clinic = User::withTrashed()->find($id)->restore();
        if($clinic){
            return response()->json('restored', 200);
        } else {
            return response()->json('not restored', 501);
        }
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $res = $user->delete();
        
        if($res == 1){
            return response()->json('Done', 200);
        } else {
            return response()->json('Not done', 501);
        }
    }
    public function deleteClinic($id)
    {
        $user = Clinic::findOrFail($id);
        $res = $user->delete();
        
        if($res == 1){
            return response()->json('Done', 200);
        } else {
            return response()->json('Not done', 501);
        }
    }
    public function revertDeletedClinic($id)
    {
        $clinic = Clinic::withTrashed()->find($id)->restore();
        if($clinic){
            return response()->json('restored', 200);
        } else {
            return response()->json('not restored', 501);
        }
    }
    public function allClinics()
    {
        $clinics = Clinic::paginate(50);
        return response()->json($clinics, 200);   
    }
    public function addClinic(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
            'address' => ['required','string'],
            'latitude' => ['required','numeric'],
            'longitude' => ['required','numeric'],
            'added_by_id' => ['required','numeric']
        ]);
        
        $clinic = Clinic::create($request->all());
        if($clinic){
            return response()->json('done', 201);
        }
    }
    public function updateClinic(Request $request, $id)
    {
        $clinic = Clinic::findOrFail($id);
        $res = $clinic->update($request->only('name', 'address', 'latitude', 'longitude', 'added_by_id'));
        if($res){
            return response()->json('Updated', 200);
        } else {
            return response()->json('Not Updated', 501);
        }
    }
    public function deletedClinics(){
        $clinics = Clinic::onlyTrashed()->get();
        return response()->json($clinics, 200);  
    }
    public function eduLevel()
	{
		$el = EducationLevel::all();

		return GenericNamedResource::collection($el);
	}
    public function contraceptionReasons()
    {
        $cr = ContraceptionReason::all();

        return ContraceptionReasonResource::collection($cr);
    }
    public function getAdminDet(){
        return Auth()->user();
    }
    public function panel()
    {
        if(Auth()->check()){
            return view('admin/admin');
        } else {
            return redirect('/admin');
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
            'verified' => ['required','string'],
            'userType' => ['required','string']
        ]);

        $admin = Admin::create([
            'firstname'     => $request->firstname,
            'lastname'     => $request->lastname,
            'email'     => $request->email,
            'verified' => $request->verified,
            'phone' => $request->phone,
            'userType' => $request->userType,
            'password' => $pass = bcrypt($request->password),
        ]);

        // $admin = Admin::create($request->all());
        if($admin){
            $adminToken = $admin->createToken('accessToken')->accessToken;
            $admin->accessToken = $adminToken;
            $admin->save();
            if($request->userType == 'Super'){
                auth()->login($admin, true);
            }
            

            echo 200;
               
        } else {
            echo 501;
        }
        
        
    }

    public function allAdmins(){
        $admin = Admin::orderBy('verified', 'DESC')->paginate(50);
        return response()->json($admin, 200);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
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
        $admin = Admin::findOrFail($id);
        $res = $admin->update($request->only('firstname', 'lastname', 'phone', 'email', 'verified', 'userType', 'accessToken'));
        if($res){
            return response()->json('Done', 200);
        } else {
            return response()->json('Not DOne', 501);
        }   
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
