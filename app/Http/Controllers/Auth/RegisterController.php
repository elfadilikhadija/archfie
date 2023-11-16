<?php

namespace App\Http\Controllers\Auth;

use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{


    use RegistersUsers;

    /**

     * @var string
     */
     protected $redirectTo = '/admin/home';


    /**

     * @return void
     */
        public function index()
    {
        $services = Service::all();
        return view('admine.createAcc', compact('services'));
    }

    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'role'=>['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'role' => $data['role'],
            'service_id' => $data['service_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
    /**
     * @param  array  $data
     * @return \App\Models\User
     */

     public function userlist()
     {
         $users = User::all();

         return view('admine.acounts', ['users' => $users]);
     }

}
