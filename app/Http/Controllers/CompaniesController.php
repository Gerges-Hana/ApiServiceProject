<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class CompaniesController extends Controller
{
    /**
     * @return all companies
     */
    private function getCompanies()
    {
        return Company::all();
    }

    public function register(Request $req)
    {

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
        // $req->validate([
        //     'name' => 'required|string',
        //     'userName' => 'required|string',
        //     'email' =>'required|string|unique:companies,email',
        //     'password' => 'required|string',
        //     'city' => 'required|string',
        //     'street' => 'required|string',
        // ]);

        $company = $req->all();

        // dd($company);
        // we need to store this in db
        $comp = Company::create([
            'name' => $company['name'],
            'userName' => $company['user-name'],
            'email' => $company['email'],
            'password' => bcrypt($company['password']),
            'city' => $company['city'],
            'street' => $company['street'],
        ]);

        $token = $comp->createToken('compTokenapp')->plainTextToken;

        // dd($token);

        return redirect()->route('companies');
    }
    public function search(Request $request){
        $search=$request['query']??"";
        if($search!=""){
            $company=Company::where('name','LIKE',"%$search%")->orwhere('id','LIKE',"%$search%")->get();

        }
        else{
            $company=Company::all();
        }
        return view('companies', ['companies' => $company]);
    }
   

}
