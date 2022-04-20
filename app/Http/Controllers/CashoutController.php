<?php

namespace App\Http\Controllers;

use App\Models\cashoutRequest;
use Illuminate\Http\Request;

class CashoutController extends Controller
{
    public function index(Request $request)
    {
        return view('cashoutrequest');
    }

    public function CreatePayOutRequest(Request $request){
        $cashoutrequest = new cashoutRequest();

        $cashoutrequest->code = $this->createCode()

    }

    private function createCode($id){

    }
}
