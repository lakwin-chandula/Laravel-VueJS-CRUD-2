<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\Vue;

class AppController extends Controller
{
    public function index(){
        return view("welcome");         // name of the blade file
    }
}
