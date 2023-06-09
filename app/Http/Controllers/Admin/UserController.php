<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        return view('admin.user.index', compact('users'));
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
        $date = Carbon::now();
        if (isset($date)) {
            $formattedDate = $date->format('m-d-Y');
        }
        
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            $user->role_as = $request->role_as;
            $user->update();

            return redirect('admin/users')->with('message', 'Updated Successfully');
        } else {
            return redirect('admin/users')->with('message', 'No User Found');
        }
    }
}
