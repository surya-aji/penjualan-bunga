<?php

namespace App\Http\Controllers;

use App\KategoriBunga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $kategori = KategoriBunga::all();
        return view('pembeli.layout.dashboard',compact('kategori'));
    }
}