<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class superAdminController extends Controller
{
    public function index (){
        return view('superadmin/index');
    }
}
