<?php

namespace ConnorLock05\LaravelAdmin\Controllers;

use Illuminate\Routing\Controller;

class AdminPanelController extends Controller
{
    public function index()
    {
        return view('admin::dashboard');
    }
}