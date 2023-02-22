<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * get data
     * @return view
     */
    public function getAllCompanies()
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
}
