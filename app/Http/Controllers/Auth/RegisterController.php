<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AllowedUserAndWorkspaces;
use App\Models\User;
use App\Models\UserInfo;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $allow = AllowedUserAndWorkspaces::where(['allowed_email' => $data['email']]);
        if ($allow->count() > 0) {

            foreach ($allow->get() as $item) {
                $allow->update(
                    [
                        'is_register' => true,
                        'allowed_user_id' => $user->id

                    ]);
            }

        } else {
            $allowed_user = new AllowedUserAndWorkspaces();
            $allowed_user->allowed_user_id = $user->id;
            $allowed_user->allowed_email = $data['email'];
            $allowed_user->is_register = true;
            $allowed_user->user_role = 'owner';
            $allowed_user->save();
        }
        $user_info = new UserInfo();
        $user_info->user_id = $user->id;
        $user_info->user_img = '/images/vector-users-icon.jpg';
        $user_info->save();

        Alert::success('Kayıt işlemi başarıyla tamamlandı.')->showConfirmButton('Tamam', '#3085d6');;

        return $user;


    }


}
