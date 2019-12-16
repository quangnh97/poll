<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\SurveyResponse;
class AccountController extends Controller
{
    public function index()
    {
            $user = \App\User::select('id','username','email','role')
            ->get();    
            return view('admin.acount-management', [
                'user' => $user
            ]);
    }

    public function update(Request $request, $id)
    {
        
        $data = \request()->validate([
            'role' => ['required', 'max:255'],
        ]);
        \App\User::where('id', $id)->update($data);
        return \redirect()->back();
    }

    
    public function destroy($id)
    {   
        \App\SurveyResponse::where('user_id', $id)->delete();
        \App\User::where('id', $id)->delete();

        return \redirect()->back();
    }
}
