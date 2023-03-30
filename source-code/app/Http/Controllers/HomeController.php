<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function index(Request $request) {
        $user = Auth::user();
        $home = "home";

        if($user->role_id === 3) {
            $home = "/admin/guitar";
        }
        else if($user->role_id === 1) {
            $home = "/user/guitar";
        }
        else if($user->role_id === 2) {
            $home = "/shop/guitar";
        }
        // else the user does not have a role
        else {
           $home = 'norole.guitar.index';
        }
        return redirect($home);
    }
}
