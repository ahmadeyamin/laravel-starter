<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * index
     *
     * @param  mixed $r
     * @return void
     */
    public function index(Request $r)
    {
        return view('backend.admin.home');
    }

}
