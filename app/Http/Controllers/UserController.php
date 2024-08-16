<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()  {
        $users = User::all();
        return view('pages.user.list', ['users' => $users]);
    }

    public function insert()
    {
        return view('pages.user.insert');
    }


    public function create(Request $request)
    {
          $request -> validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6'
          ]);

         $isUser = User::where('email',$request->email)->first();
 
         if($isUser) {
            return redirect()->back()->withErrors(['email' => 'This email address is already registered.']);
         }
         
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request ->password
        ]);

        return redirect()->route('user.list');

    }

    public function edit( $id)
    {
        $user = User::findOrFail($id);
        return view('.pages.user.edit', compact('user'));

    }  

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:6'
        ]);
    
        $user->name = $request->input('name');
        $user->email = $request->input('email');
    
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
    
        $user->save();
    
        return redirect()->route('user.list')->with('success', 'User updated successfully.');
    }
    
    public function destroy($id)
    {
        $user = User::withTrashed()->find($id);
        $user->delete();

        return redirect()->route('user.list')->with('success', 'User deleted successfully.');
    }


    public function bulkDelete(Request $request)
    {
        $userIds = $request->input('user_ids', []);
    
        if (!empty($userIds)) {
            User::whereIn('id', $userIds)->delete();
        }
    
        return redirect()->route('user.list')->with('success', 'Selected users deleted successfully.');
    }
    


}
