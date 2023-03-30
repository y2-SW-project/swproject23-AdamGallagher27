<?php

namespace App\Http\Controllers\NoRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Guitar;

class GuitarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $guitars = DB::table('guitars')->take(8)->get();
        $users = DB::table('users')->take(8)->get();


        return view('norole.guitar.welcome')->with('guitars', $guitars)->with('users', $users);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $guitar = Guitar::where('id', $id)->firstOrFail();
        $altProducts = DB::table('guitars')->where('id', '!=', $guitar->id)->take(5)->get();

        return view('user.guitar.product')->with("guitar", $guitar)->with('altProducts', $altProducts);
    }

}
