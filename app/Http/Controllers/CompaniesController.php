<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * @return all companies
     */
    private function getCompanies()
    {
        return Company::all();
    }

    public function index()
    {
        $companies = $this->getCompanies();

        return view('companies', ['companies' => $companies]);
    }

    public function create()
    {
        return view('addCompany');
    }

    public function store(Request $req)
    {
        $company = $req->all();
        // dd($company);
        // we need to store this in db
        Company::create([
            'name' => $company['name'],
            'userName' => $company['user-name'],
            'email' => $company['email'],
            'password' => $company['password'],
            'city' => $company['city'],
            'street' => $company['street'],
        ]);
        
        return redirect()->route('companies');
    }

}
