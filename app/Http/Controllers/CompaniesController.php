<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DeliveryGuy;
use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class CompaniesController extends Controller
{
    /**
     * @return all companies
     */
    private function getCompanies()
    {
        // return Company::all();
        return Company::paginate(5);
    }

    public function register(Request $req)
    {
    }


    public function index()
    {
        $count = 1;

        $companies = $this->getCompanies();
        // dd($companies);
        foreach ($companies as $companie) {
            $companie->count = count($companie->deliveries);
        }

        foreach ($companies as $orders) {
            $orders->order = count($orders->invoices);
            $orders->waiting = count($orders->invoices->where('status', 'waiting'));
            $orders->onDelivering = count($orders->invoices->where('status', 'onDelivering'));
            $orders->delivered = count($orders->invoices->where('status', 'delivered'));
        }


        return view('companies', ['companies' => $companies, 'count' => $count]);
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

        $comp = Company::where('userName', $company['user-name'])->first();

        $token = $comp->createToken('compTokenapp')->plainTextToken;
        $comp->update(['api_token' => $token]);

        return redirect()->route('companies.dashboard');
    }

    public function search(Request $request)
    {

        $count = 1;
        $search = $request['query'] ?? "";
        // dd($search,$request,$request->pathInfo(),$request->requestUri,$request['pathInfo']);
        // Request::getRequestUri();
        if ($search != "") {
            $company = Company::where('name', 'LIKE', "%$search%")->orwhere('id', 'LIKE', "%$search%")->get();
        } else {
            $company = Company::all();
        }
        return view('companies', ['companies' => $company, 'count' => $count]);
    }


    public function delete($companyId)
    {
        Company::destroy($companyId);
        PersonalAccessToken::where(['tokenable_id' => $companyId, 'name' => 'compTokenapp'])->delete();
        return  redirect('/');
    }
}
