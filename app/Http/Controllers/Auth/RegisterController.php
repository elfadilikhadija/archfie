<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Division;

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
        $divisions = Division::all();
        return view('admine.createAcc', compact('divisions'));
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
        'role' => ['required'],
        'division_id' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
}

public function create()
{
    $divisions = Division::all(); // Fetch all divisions from the database
    return view('your_view', compact('divisions'));
}


public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'role' => 'required|string',
            'division_id' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);


        // Create the user
        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'division_id' => $request->division_id,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            // Redirect to 'admine.acounts' upon successful user creation
            return redirect()->route('admine.accounts')->with('success', 'User created successfully!');
        } else {
            // Redirect back with an error message if user creation fails
            return redirect()->back()->with('error', 'User creation failed. Please try again.');
        }
    }


    /**
     * @param  array  $data
     * @return \App\Models\User
     */

     public function userlist()
     {
         $users = User::all();
         $divisions = Division::all();

         return view('admine.acounts', ['users' => $users,'divisions' => $divisions]);
     }
     public function searchByName(Request $request)
     {
         $searchTerm = $request->input('search');

         $users = User::where('name', 'LIKE', "%$searchTerm%")->get();

         return view('admine.acounts', ['users' => $users]);
     }

}
