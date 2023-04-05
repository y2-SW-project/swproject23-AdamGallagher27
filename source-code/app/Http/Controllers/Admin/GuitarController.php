<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Guitar;
use App\Models\Types;
use App\Models\Condition;
use App\Models\UserLike;


class GuitarController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->isAdmin();

        $guitars = DB::table('guitars')->take(8)->get();
        $users = DB::table('users')->take(8)->get();

        return view('admin.guitar.welcome')->with('guitars', $guitars)->with('users', $users);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {

        $this->isAdmin();

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
    public function show($id)
    {
        $this->isAdmin();

        $guitar = Guitar::where('id', $id)->firstOrFail();
        $altProducts = DB::table('guitars')->where('id', '!=', $guitar->id)->take(5)->get();
        $type = Types::where('id', $guitar->type_id)->firstOrFail();
        $condition = Condition::where('id', $guitar->condition_id)->firstOrFail();
        $postedBy = User::where('id', $guitar->user_id)->firstOrFail();


        return view('admin.guitar.product')->with("guitar",$guitar)->with('altProducts', $altProducts)->with('type', $type)
        ->with('condition', $condition)->with('user', $postedBy);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $this->isAdmin();

        $guitar = Guitar::where('id', $id)->firstOrFail();
        // dd($guitar);
        return view('admin.guitar.edit-form')->with("guitar",$guitar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->isAdmin();

        $guitar = Guitar::where('id', $id)->firstOrFail();

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

        // dd($guitar);
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
    public function destroy($id)
    {
        $this->isAdmin();
        
        $guitar = Guitar::where('id', $id)->firstOrFail();

        if($guitar->user_id != Auth::id()) {
            return abort(403);
        }

        // delete selected guitar
        $guitar->delete();

    }


    public function account($user_id) {

        $this->isAdmin();

        $guitar = Guitar::where('user_id', $user_id)->get();
        $liked = UserLike::where('user_id', $user_id)->get();
        $user = User::where('id', $user_id)->get();

        return view('admin.guitar.account')->with('guitar', $guitar)->with('liked', $liked)->with('user', $user);
    }

    private function isAdmin() {
        $admin = 3;

        if(Auth::user()->role_id !== $admin) {
            return abort(401, 'this action is unauthorized');
        }

    }
}
