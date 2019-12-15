<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Reviews;
class ReviewController extends Controller
{
    private $reviews;
        
    public function __construct(Reviews $reviews)
    {
        $this->reviews = $reviews;
    }

    public function index()
    {
        if(auth()->user() == null) {
            return \redirect('/');
        } else {
            $reviews = \App\Reviews::select('users.username','evaluate','comment')
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->get();    
            return view('users.review', [
                'reviews' => $reviews
            ]);
        }
    }
    public function store(Request $request) 
    {
        $user_id = auth()->user()->id;
        if(!isset($request->message) ) {
            $request->message = " ";
        }

            \App\Reviews::create(
               ['evaluate' => $request->rating,'comment' => $request->message, 'user_id' => $user_id ]  
            );
        
        $reviews = \App\Reviews::select('users.username','evaluate','comment')
        ->join('users', 'users.id', '=', 'reviews.user_id')
        ->get();    
        return view('users.review', [
            'reviews' => $reviews
        ]);
    }


}
