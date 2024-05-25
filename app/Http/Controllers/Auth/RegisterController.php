<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\Staffs;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'staffID' => ['required', 'string', 'min:8'],
            'user_type' => ['required', 'integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'staff_no' => $data['staffID'],
            'user_type' => $data['user_type'],
        ]);

        $userType = $data['user_type'];

        if ($userType == 2) {
            Staffs::create([
                'user_id' => $user->id,
                'full_name' => $data['name'],
                'phone_no' => $data['phoneNo'],
                'staff_no' => $data['staffID'],
                'branch_id' => 2,
                'is_admin' => 0
            ]);
        }

        if ($userType == 5) {
            Staffs::create([
                'user_id' => $user->id,
                'full_name' => $data['name'],
                'phone_no' => $data['phoneNo'],
                'staff_no' => $data['staffID'],
                'branch_id' => 1,
                'is_admin' => 0
            ]);

            $user->update([
                'user_type' => 2,
            ]);
        }
        
        if ($userType == 3) {
            Parents::create([
                'user_id' => $user->id,
                'full_name' => $data['name'],
                'phone_no' => $data['phoneNo'],
                'staff_no' => $data['staffID'],
                'email' => $data['email'],
                'role_id' => 2
            ]);
        }
        
        if ($userType == 4) {
            Parents::create([
                'user_id' => $user->id,
                'full_name' => $data['name'],
                'phone_no' => $data['phoneNo'],
                'staff_no' => $data['staffID'],
                'email' => $data['email'],
                'role_id' => 1
            ]);
        }

        return $user;

        // return User::create([
        //     // 'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);

    }
}
