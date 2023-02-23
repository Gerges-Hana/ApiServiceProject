<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = [
            [
                'id' => 1,
                "name" => 'Sherka'
            ],
            [
                'id' => 2,
                "name" => 'comp'
            ]
        ];

        return view('companies', ['companies' => $companies]);
    }

    public function create()
    {
        return view('addCompany');
    }

    public function store(Request $req)
    {
        
        return \redirect()->route('companies');
    }

}
