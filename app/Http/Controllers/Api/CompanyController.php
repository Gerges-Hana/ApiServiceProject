<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Sanctum\PersonalAccessToken;

class CompanyController extends Controller
{

    public function getCompanies()
    {
        return Company::all();
        // return 'tttt';

    }

    // function to add a new company
    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'userName' => 'required|unique:companies,userName',
            'city' => 'required',
            'password' => 'required',
            'email' => 'required|unique:companies,email',
        ]);

        $company = $req->all();

        Company::create([
            'name' => $company['name'],
            'userName' => $company['userName'],
            'city' => $company['city'],
            'password' => bcrypt($company['password']),
            'street' => $company['street'],
            'email' => $company['email'],
        ]);

        $comp = Company::where('userName', $company['userName'])->first();

        $token = $comp->createToken('compTokenapp')->plainTextToken;
        $comp->update('api_token',$token);
        return response()->json([
            'message' => 'Company has been added successfully',
            'data' => $company
        ], 200);
    }



    public function login(Request $req)
    {
        $field = $req->all();

        // $field = $req->validate([
        //     'user-name' => 'requierd|string',
        //     'password' => 'required|string'
        // ]);

        // check if company user name exist
        $company = Company::where('userName', $field['userName'])->first();
        // check if company or password is not exist
        if (!$company || !Hash::check($field['password'], $company->password)) {
            return response([
                'message' => 'sorry you dont have account, please contact your supervisor!'
            ], 401);
        }


        // generate token if company is exist
        $token = $company->createToken('compTokenapp')->plainTextToken;
        // return $token;
        return response([
            'company Data' => $company,
            'token' => $token
        ], 201);
    }



    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successfully logged out',
            'token' => $request->bearerToken(),
         ], 201);
    }

    public function update(Request $request,$id)
    {

        // $request->validate([
        //     'name' => 'required',
        //     'userName' => 'required|unique:companies,userName',
        //     'city' => 'required',
        //     'password' => 'required',
        //     'email' => 'required|unique:companies,email',
        // ]);
        $company=Company::find($id);
        $company->update($request->all());
        // return $company;
        return response()->json([
            'message' => 'Company has been update successfully',
            'data' => $company
        ], 200);

        // ===========eswee============
        // $company->name=$request->name;
        // $company->city=$request->city;
        // $company->street=$request->street;
        // $company->userName=$request->userName;
        // $company->password=$request->password;
        // $company->email=$request->email;
        // $company->save();
        // ===========eswee============
    }


    public function delete($id)
    {
        // return 'delete function ';
        Company::destroy($id);
        PersonalAccessToken::where(['tokenable_id' => $id, 'name' => 'compTokenapp'])->delete();

    }

    public static function getCompanyId(Request $req)
    {
        // return token code
        $hashedToken = $req->bearerToken();
        // return company of this token
        $token = PersonalAccessToken::findToken($hashedToken);
        // return company id of this token
        return $token->tokenable_id;
    }

}
