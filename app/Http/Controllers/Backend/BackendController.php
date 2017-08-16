<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    protected $limit = 5;

    /**
     * Create a new controller instance.
     *
     * @return \App\Http\Controllers\Backend\BackendController
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-permissions');
    }
}
