<?php

namespace App\Http\Controllers\Api;
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use App\Http\Controllers\BaseController;
use App\Mail\emailMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send()
    {
        // return 'send email';
        Mail::to(Auth::user()->email)->send(new emailMailable());
        return $this->sendResponse("Email send ");
    }
}
