<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Sentinel;

class AdminController extends Controller
{
    public function getIndex(){
        $date1 = strtotime('15-11-2018');
        dd(date('d/m/Y',$date1));
        return view('admin.layout.home');
    }
    public function calendar() {
        return view('admin.calendar.quickstart');
    }
    public function getError404(){
        return view('admin.layout.404');
    }
    public function patch() {
        $set = User::patch(request([
            'email','password','last_name', 'first_name'
        ]));
        dd($set);
    }
}
