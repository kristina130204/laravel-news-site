<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BlacklistController extends Controller
{
    public function index()
    {
        $users = User::where('banned', 1)->paginate(10);
        return view('admin.users.blacklist', compact('users'));
    }
}
