<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Types;
use App\Models\Guitar;
use App\Models\Condition;
use App\Models\User;
use App\Models\UserLike;
use App\Models\UserBid;


// shop users can do full crud opperations of products they posted


class GuitarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // sends shop user to welcome view
    public function index()
    {
        $this->isShop();

        // load first 6 guitars and send them to welcome view 
        $guitars = DB::table('guitars')->take(6)->get();
        return view('shop.guitar.welcome')->with('guitars', $guitars);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // returns the create form
    public function create()
    {
        $this->isShop();

        // return the form for creating a new guitar
        return view('shop.guitar.create-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // stores the new guitar in the database
    public function store(Request $request)
    {
        $this->isShop();

        // validate request
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'make' => 'required',
            'bid_expiration' => 'required',
            'price' => 'required|numeric',
            'type_id' => 'required|numeric',
            'condition_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

        // add new entry to guitar table 
        Guitar::create([
            'name' => $request->name,
            'description' => $request->description,
            'make' => $request->make,
            'bid_expiration' => $request->bid_expiration,
            'price' => $request->price,
            'type_id' => $request->type_id,
            'condition_id' => $request->condition_id,
            'user_id' => $request->user_id,
        ]);

        // return dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  shows one product view
    public function show($id)
    {
        $this->isShop();

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
        return view('shop.guitar.product')->with("guitar",$guitar)->with('altProducts', $altProducts)->with('type', $type)
        ->with('condition', $condition)->with('user', $postedBy)->with('current', $current);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  returns the edit guitar form
    public function edit($id)
    {
        $this->isShop();

        // load guitar and send it to edit form
        $guitar = Guitar::where('id', $id)->firstOrFail();
        return view('shop.guitar.edit-form')->with("guitar",$guitar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // updates the guitar in the database
    public function update(Request $request, $id)
    {
        $this->isShop();

        // load current guitar
        $guitar = Guitar::where('id', $id)->firstOrFail();

        // validate request
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'make' => 'required',
            'bid_expiration' => 'required',
            'price' => 'required',
            'type_id' => 'required',
            'condition_id' => 'required',
            'user_id' => 'required',
        ]);

        // update guitar in db
        $guitar->update([
            'name' => $request->name,
            'description' => $request->description,
            'make' => $request->make,
            'bid_expiration' => $request->bid_expiration,
            'price' => $request->price,
            'type_id' => $request->type_id,
            'condition_id' => $request->condition_id,
            'user_id' => $request->user_id,
        ]);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // deletes guitar
    public function destroy($id)
    {
        $this->isShop();

        // load current guitar
        $guitar = Guitar::where('id', $id)->firstOrFail();

        // check this guitar is posted by current user
        if($guitar->user_id != Auth::id()) {
            return abort(403);
        }

        // delete selected guitar
        $guitar->delete();

    }

    // view users account
    public function account($user_id) {

        $this->isShop();

        // eager load data with user_id
        $guitar = Guitar::where('user_id', $user_id)->get();

        // get the guitars that the current user has already liked
        // (as opposed to the entries in user_like which is just user / guitar ids)
        $liked = Guitar::whereHas(
            'userLikes', function($query) use ($user_id) {
                $query->where('user_id', $user_id);
            }
        )->get();
        
        $user = User::where('id', $user_id)->get();

        // return account view with data
        return view('shop.guitar.account')->with('guitar', $guitar)->with('liked', $liked)->with('user', $user);
    }

    // validation for shop users
    private function isShop() {
        $shop = 2;

        if(Auth::user()->role_id !== $shop) {
            return abort(401, 'this action is unauthorized');
        }

    }
}
