<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use App\Models\Guitar;
use App\Models\Types;
use Illuminate\Http\Request;

class Search extends Controller
{
    
    public function getSearch(Request $request) {

        $phrase = $request->phrase;
        $conditions = Condition::all();
        $types = Types::all();

        $guitars = Guitar::where('name', 'LIKE', '%' . $phrase . '%')->paginate(15);

        return view('search')->with('guitars', $guitars)->with('phrase', $phrase)
        ->with('types', $types)->with('conditions', $conditions);
    }

}
