<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        return view('user.guitar.welcome')->with('guitars', $guitars);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return the form for creating a new guitar
        return view('user.guitar.create-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $guitar = Guitar::where('id', $id)->firstOrFail();

        return view('guitar.product')->with("guitar",$guitar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
