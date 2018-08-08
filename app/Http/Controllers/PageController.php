<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class PageController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data = [
            'countries' => $this->countries()
        ];
        // dd($data);
        return view('pages.home.index', $data);
    }

    private function countries()
    {
        $countries_path = storage_path('json/countries.json');
        if ( File::exists($countries_path) )
            return json_decode(File::get($countries_path), true);
        return [];
    }
}
