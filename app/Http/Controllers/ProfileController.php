<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\UserLevel;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function index(){
        $levels = UserLevel::pluck('name','id');
        return view('profile',['levels'=>$levels]);
    }

    function update(UpdateProfileRequest $request)
    {
        auth()->user()->update($request->only('name','email','level_id'));
        if($request->input('password')){
            auth()->user()->update([
                'password'=>bcrypt($request->input('password'))
            ]);
        }

        return redirect()->route('profile')->with('message','Profile saved succesfully');
    }
}
