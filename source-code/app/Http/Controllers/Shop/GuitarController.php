<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $this->isShop();

        $guitars = DB::table('guitars')->take(8)->get();

        return view('shop.guitar.welcome')->with('guitars', $guitars);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        $this->isShop();


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
        $this->isShop();

        $guitar = Guitar::where('id', $id)->firstOrFail();
        $altProducts = DB::table('guitars')->where('id', '!=', $guitar->id)->take(5)->get();

        return view('shop.guitar.product')->with("guitar",$guitar)->with('altProducts', $altProducts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->isShop();

        $guitar = Guitar::where('id', $id)->firstOrFail();
        // dd($guitar);
        return view('shop.guitar.edit-form')->with("guitar",$guitar);
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
        $this->isShop();


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
        $this->isShop();

        $guitar = Guitar::where('id', $id)->firstOrFail();

        if($guitar->user_id != Auth::id()) {
            return abort(403);
        }

        // delete selected guitar
        $guitar->delete();

    }

    private function isShop() {
        $shop = 2;

        if(Auth::user()->role_id !== $shop) {
            return abort(401, 'this action is unauthorized');
        }

    }
}