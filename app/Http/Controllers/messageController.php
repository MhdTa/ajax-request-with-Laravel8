<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class messageController extends Controller
{
 public function index(){
    $messages = Post::get();
    return view('index',[
        'messages' => $messages
    ]) ;
 }

    public function store(Request $request,Post $message){
        $this->validate($request, [
            'message' => 'required',
        ]);

        
        $message->content =  $request->get('message');

        //store in db
        $message->save();

        return response()->json(['messages'=>$message]);

    }
}
