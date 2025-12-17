<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // For simplicity, passing lists to the dashboard view
        $users = User::all();
        $briefs = Brief::with('user')->latest()->get();
        
        return view('admin.dashboard', compact('users', 'briefs'));
    }
}
