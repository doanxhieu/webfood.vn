<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatBoxController extends Controller
{
    public function chat(){
        return view('frontend.page.chatbox');
    }
}
