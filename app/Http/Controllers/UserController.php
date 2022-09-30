<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        if ($users)
        {
            return response()->json([
                'status' => 200,
                'users' => $users,
            ]);
        }
    }

    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:8|confirmed',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
            'permission' => 'required|integer',
            'active' => 'required|integer',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'validation_error' => $validator->messages(),
            ]);
        }
        else
        {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = Hash::make($request->input('password'));
            DB::table('users')->insert([
                'name' => $name,
                'email' =>  $email,
                'password'=> $password,
                'permission'=> $request->input('permission'),
                'active'=> $request->input('active'),
            ]);

            return response()->json([
                'status' => 200,
                'message' => "User successfully registered!",
            ]);
        }
    }

    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'validation_error' => $validator->messages(),
            ]);
        }
        else
        {
            $email =  $request->input('email');
            $password = $request->input('password');
    
            $user = DB::table('users')->where('email',$email)->first();

            if ($user)
            {
                if(!Hash::check($password, $user->password))
                {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Credentials provide did not match.',
                    ]);
                }
                else
                {
                    $user = DB::table('users')->where('email',$email)->first(); //
                    return response()->json([
                        'status' => 200,
                        'user' => [
                            'name' => $user->name,
                            'email' => $user->email,
                        ],
                    ]);
                }
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Login attempt failed.',
                ]);
            }
        }
    }

    function destroy($id)
    {
        $user = User::find($id);

        if ($user)
        {
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'User successfully deleted!',
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'User ID Not Found.',
            ]);
        }
    }
}
