<?php

namespace App\Http\Controllers\Admin;

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


// admin is the super user and has full functionality


class GuitarController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // sends user to welcome view
    public function index()
    {
        $this->isAdmin();

        // load first 6 guitars
        $guitars = DB::table('guitars')->take(6)->get();

        // return welcome view with guitars
        return view('admin.guitar.welcome')->with('guitars', $guitars);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  returns the create form for guitars
    public function create()
    {
        $this->isAdmin();

        // return the form for creating a new guitar
        return view('admin.guitar.create-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // stores new guitars in db
    public function store(Request $request)
    {

        $this->isAdmin();

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
            'image' => 'file|image'
        ]);

        // image data
        $guitar_image = $request->file('image');
        $extension = $guitar_image->getClientOriginalExtension();
        $file = date('Y-m-d-His') . '_' . $request->input('name') . '.' . $extension;
        $path = $guitar_image->storeAs('public/images', $file);

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
            'image' => $file
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // shows single product view
    public function show($id)
    {
        $this->isAdmin();

        // load current highest bid
        $current = UserBid::where('guitar_id', $id)->max('bid_amount');

        // if the current highest bid is null
        // start current at 0
        if(is_null($current)) {
            $current = 0;
        }

        // eager load data for view
        $guitar = Guitar::where('id', $id)->firstOrFail();
        $altProducts = DB::table('guitars')->where('id', '!=', $guitar->id)->take(5)->get();
        $type = Types::where('id', $guitar->type_id)->firstOrFail();
        $condition = Condition::where('id', $guitar->condition_id)->firstOrFail();
        $postedBy = User::where('id', $guitar->user_id)->firstOrFail();

        // return view with data
        return view('admin.guitar.product')->with("guitar",$guitar)->with('altProducts', $altProducts)->with('type', $type)
        ->with('condition', $condition)->with('user', $postedBy)->with('current', $current);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // returns the edit guitar form
    public function edit($id)
    {

        $this->isAdmin();

        // load guitar and return form with current guitar
        $guitar = Guitar::where('id', $id)->firstOrFail();
        return view('admin.guitar.edit-form')->with("guitar",$guitar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // updates guitar in the db
    public function update(Request $request, $id)
    {

        $this->isAdmin();

        // load updated guitar
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

    // deletes guitar from db
    public function destroy($id)
    {
        $this->isAdmin();
        
        // load guitar
        $guitar = Guitar::where('id', $id)->firstOrFail();

        // check if admin created this guitar
        if($guitar->user_id != Auth::id()) {
            return abort(403);
        }

        // delete selected guitar
        $guitar->delete();

    }

    // view users accounts
    public function account($user_id) {

        $this->isAdmin();

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
        return view('admin.guitar.account')->with('guitar', $guitar)->with('liked', $liked)->with('user', $user);
    }

    // users can buy products outright
    public function buy(Request $request) {
        $this->isAdmin();

        // get current guitar by id
        $guitar_id = $request->guitar_id;
        $guitar = Guitar::where('id', $guitar_id)->firstOrFail();

        // change the sold property to true
        $guitar->update([
            'sold' => true
        ]);

        // get the current highest bid
        $current = UserBid::where('guitar_id',$guitar_id)->max('bid_amount');

        // if the bid is null start current at 0
        if(is_null($current)) {
            $current = 0;
        }

        // eager load data 
        $guitar = Guitar::where('id', $guitar_id)->firstOrFail();
        $altProducts = DB::table('guitars')->where('id', '!=', $guitar->id)->take(5)->get();
        $type = Types::where('id', $guitar->type_id)->firstOrFail();
        $condition = Condition::where('id', $guitar->condition_id)->firstOrFail();
        $postedBy = User::where('id', $guitar->user_id)->firstOrFail();

        // redirect to view
        // (redirect prevents buy duplicates in table )
        return redirect('admin/guitar/' . $guitar->id)->with("guitar",$guitar)->with('altProducts', $altProducts)->with('type', $type)
        ->with('condition', $condition)->with('user', $postedBy)->with('current', $current);        
    }

    // make a bid on a guitar
    public function bid(Request $request){
        $this->isAdmin();

        // get the current highest bid
        $current = UserBid::where('guitar_id', $request->guitar_id)->max('bid_amount');

        // if bid is null start current at 0
        if(is_null($current)) {
            $current = 0;
        }

        // load current id
        $id = $request->guitar_id;

        // validate request
        $request->validate([
            'user_id' => 'required',
            'guitar_id' => 'required',
            'bid_amount' => 'required|numeric'
        ]);
        
        // create new entry to user bid table
        UserBid::create([
            'guitar_id' => $request->guitar_id,
            'user_id' => $request->user_id,
            'bid_amount' => $request->bid_amount,
        ]);

        // eager load data
        $guitar = Guitar::where('id', $id)->firstOrFail();
        $altProducts = DB::table('guitars')->where('id', '!=', $guitar->id)->take(5)->get();
        $type = Types::where('id', $guitar->type_id)->firstOrFail();
        $condition = Condition::where('id', $guitar->condition_id)->firstOrFail();
        $postedBy = User::where('id', $guitar->user_id)->firstOrFail();

        // redirect to product view
        // redirect prevents duplicate bids in db
        return redirect('admin/guitar/' . $guitar->id)->with("guitar",$guitar)->with('altProducts', $altProducts)->with('type', $type)
        ->with('condition', $condition)->with('user', $postedBy)->with('current', $current);
    }


    // authorise admin user
    private function isAdmin() {
        $admin = 3;

        if(Auth::user()->role_id !== $admin) {
            return abort(401, 'this action is unauthorized');
        }

    }
}
