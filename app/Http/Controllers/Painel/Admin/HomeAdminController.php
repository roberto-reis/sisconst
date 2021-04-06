<?php

namespace App\Http\Controllers\Painel\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        
        return view('painel.admin.home');
    }
}
