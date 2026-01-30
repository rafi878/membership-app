<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Jika user sudah login, redirect ke dashboard
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        
        return view('home.index');
    }
}