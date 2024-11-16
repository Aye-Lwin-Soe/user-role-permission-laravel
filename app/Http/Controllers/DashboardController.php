<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $userActiveCount = User::where('is_active', '1')->count();

        $userInActiveCount = User::where('is_active', '0')->count();

        return view('dashboard', compact('userActiveCount', 'userInActiveCount'));
    }
}
