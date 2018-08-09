<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Countries;
use File;

class PageController extends Controller
{
    public function __construct(Countries $countries)
    {
        $this->countries = $countries;
    }

    public function index()
    {
        $countries = $this->countries->all();
        return view('pages.home.index', compact('countries'));
    }

    public function getCountry(Request $request)
    {
        $country = $this->countries->where('name', $request['country'])->first();
        if ( $country ) 
        {
            return response()->json($country);
        }
    }

}
