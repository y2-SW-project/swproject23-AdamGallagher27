<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Types;
use App\Models\Condition;
use App\Models\User;
use App\Models\Guitar;
use App\Models\UserLike;
use App\Models\UserBid;


// regular users with an account can
// view guitars, buy, bid and see users accounts


class GuitarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //  sends users to welcome view
    public function index()
    {
        $this->isUser();

        // load first 6 guitars and send them to welcome view
        $guitars = DB::table('guitars')->take(6)->get();
        return view('user.guitar.welcome')->with('guitars', $guitars);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // shows product
    public function show($id)
    {
        $this->isUser();

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
        return view('user.guitar.product')->with("guitar",$guitar)->with('altProducts', $altProducts)->with('type', $type)
        ->with('condition', $condition)->with('user', $postedBy)->with('current', $current);
    }

    // users can buy products outright
    public function buy(Request $request) {
        $this->isUser();

        // load current guitar
        $guitar_id = $request->guitar_id;
        $guitar = Guitar::where('id', $guitar_id)->firstOrFail();

        // change the sold property to true
        $guitar->update([
            'sold' => true
        ]);

        // load current highest bid
        $current = UserBid::where('guitar_id',$guitar_id)->max('bid_amount');

        // if its null start current at 0
        if(is_null($current)) {
            $current = 0;
        }

        // eager load data
        $guitar = Guitar::where('id', $guitar_id)->firstOrFail();
        $altProducts = DB::table('guitars')->where('id', '!=', $guitar->id)->take(5)->get();
        $type = Types::where('id', $guitar->type_id)->firstOrFail();
        $condition = Condition::where('id', $guitar->condition_id)->firstOrFail();
        $postedBy = User::where('id', $guitar->user_id)->firstOrFail();

        // redirect to product view with data
        // redirect prevents multiple buy entries in db
        return redirect('user/guitar/' . $guitar->id)->with("guitar",$guitar)->with('altProducts', $altProducts)->with('type', $type)
        ->with('condition', $condition)->with('user', $postedBy)->with('current', $current);        
    }


    // make a bid on a guitar
    public function bid(Request $request){
        $this->isUser();

        // load current highest bid
        $current = UserBid::where('guitar_id', $request->guitar_id)->max('bid_amount');

        // if the current highest bid is null
        // start current at 0
        if(is_null($current)) {
            $current = 0;
        }

        $id = $request->guitar_id;

        // validate request
        $request->validate([
            'user_id' => 'required',
            'guitar_id' => 'required',
            'bid_amount' => 'required|numeric'
        ]);
        
        // add new entry to bid table
        UserBid::create([
            'guitar_id' => $request->guitar_id,
            'user_id' => $request->user_id,
            'bid_amount' => $request->bid_amount,
        ]);

        // eager load data for product view
        $guitar = Guitar::where('id', $id)->firstOrFail();
        $altProducts = DB::table('guitars')->where('id', '!=', $guitar->id)->take(5)->get();
        $type = Types::where('id', $guitar->type_id)->firstOrFail();
        $condition = Condition::where('id', $guitar->condition_id)->firstOrFail();
        $postedBy = User::where('id', $guitar->user_id)->firstOrFail();

        // redirect to guitar view with data
        // redirect prevents multiple entries into the bid table
        return redirect('user/guitar/' . $guitar->id)->with("guitar",$guitar)->with('altProducts', $altProducts)->with('type', $type)
        ->with('condition', $condition)->with('user', $postedBy)->with('current', $current);
    }


    // view users account
    public function account($user_id) {

        $this->isUser();

        // load data for account view
        $guitar = Guitar::where('user_id', $user_id)->get();
        $liked = UserLike::where('user_id', $user_id)->get();
        $user = User::where('id', $user_id)->get();

        // load account view with data
        return view('user.guitar.account')->with('guitar', $guitar)->with('liked', $liked)->with('user', $user);
    }

    // function to authorize a user
    private function isUser() {
        $user = 1;

        if(Auth::user()->role_id !== $user) {
            return abort(401, 'this action is unauthorized');
        }

    }


}
