<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth', 'preventBackHistory']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = User::orderBy('id', 'DESC')->paginate(5);
        // return view('users.index', compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
        $data = User::all();
        return view('users.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input('roles'));
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'same:confirm-password',
                'min:8',
                'max:20',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^+&*-]).{8,20}$/' // replace {8,20} with * to avoide length
            ],
            'roles' => 'required'
        ], 
        [
            'roles.required' => 'Role is required. Please select a role.',
            'password.regex' => 'Password must contain upper and lower case alphabets, 
                                 at least one number and
                                 one special character.'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        // $user = User::create($input);

        $password = Hash::make($request->input('password'));
        $isAdmin = 0;
        if($request->input('roles') == 'Admin'){
            $isAdmin = 1;
        }
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password,
            'is_admin' => $isAdmin,
        ]);

        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => [
                'same:confirm-password',
                'min:8',
                'max:20',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^+&*-]).{8,20}$/'
            ],
            'roles' => 'required'
        ],
        [
            'password.regex' => 'Password must contain upper and lower case alphabets, 
                                 at least one number and
                                 one special character.'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function createChangePassword($id)
    {
        $user = User::find($id);
        return view(
            'users.change_password',
            [
                'user' => $user
            ]
        );
    }

    public function updateChangePassword(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'password' => 'required',
            'new_password' => [
                'same:confirm-password',
                'min:8',
                'max:20',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^+&*-]).{8,}$/'
            ],
        ],
        [
            'new_password.regex' => 'Password must contain upper and lower case alphabets, 
                                 at least one number and
                                 one special character.'
        ]);
        $input = $request->all();
        if (Hash::check($request->input('password'), $user->password)) {
            $input['password'] = Hash::make($input['new_password']);
            $user->update($input);
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('home')->with('success', 'Password updated successfully');
            }
            else{
                return redirect()->route('std_dashboard', [Auth::user()->student_id])->with('success', 'Password updated successfully');
            }
            // return back()->with('success', 'Password updated successfully');
        }
        else
        {
            return back()->with('error', 'Your password is incorrect');
            //return back()->withErrors('Your password is incorrect.');
        }

        // return redirect()->route('users.index')
        // ->with('success', 'Password updated successfully');
    }
}
