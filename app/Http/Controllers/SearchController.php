<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * this method let you search with company name and return collection of $wanted model 
     * @param Request $request passing search request
     * @param Model $wanted the entity that I want to get in result for example DeliveryGuyModel or InvoiceModel
     * @return Collection $results of $wanted model 
     */
    public static function searchWithCompanyName(Request $request, Model $wanted)
    {
        $search = $request['query'] ?? "";
        $results = collect();

        if ($search != "") {

            $modelsIds = Company::select('id')->where('name', 'LIKE', "%$search%")->get()->toArray();

            foreach ($modelsIds as $id) {

                $result = $wanted::select()->where('companyId', $id)->get();

                if (!$result->isEmpty()) {
                    $results = $results->merge($result);
                }

            }
        } else {
            $results = $wanted::all();
        }
        return $results;
    }
}
