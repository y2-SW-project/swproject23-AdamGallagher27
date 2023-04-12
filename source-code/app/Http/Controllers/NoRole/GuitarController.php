<?php

namespace App\Http\Controllers\NoRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Guitar;
use App\Models\Types;
use App\Models\Condition;
use App\Models\UserBid;



// if a user has no role they can only look at guitars and see the welcome page

class GuitarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // load first 6 guitars and send them to welcome view
        $guitars = DB::table('guitars')->take(12)->get();
        return view('norole.guitar.welcome')->with('guitars', $guitars);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // load current highest bid
        $current = UserBid::where('guitar_id', $id)->max('bid_amount');

        // if the current bid is null start it at 0
        if(is_null($current)) {
            $current = 0;
        }

        // eager load data for product view
        $guitar = Guitar::where('id', $id)->firstOrFail();
        $altProducts = DB::table('guitars')->where('id', '!=', $guitar->id)->take(5)->get();
        $type = Types::where('id', $guitar->type_id)->firstOrFail();
        $condition = Condition::where('id', $guitar->condition_id)->firstOrFail();
        $postedBy = User::where('id', $guitar->user_id)->firstOrFail();

        // return product view with data
        return view('norole.guitar.product')->with("guitar",$guitar)->with('altProducts', $altProducts)->with('type', $type)
        ->with('condition', $condition)->with('user', $postedBy)->with('current', $current);
    }

}
