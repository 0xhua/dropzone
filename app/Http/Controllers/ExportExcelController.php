<?php

namespace App\Http\Controllers;

use App\Exports\DASellersRequestsExport;
use App\Exports\ItemExport;
use App\Exports\itemRequestsExport;
use App\Models\da_info;
use App\Models\Item;
use App\Models\item_size;
use App\Models\Location;
use App\Models\paid_status;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;


class ExportExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Admin|seller|da']);
    }
    public function index()
    {
        $customer_data = DB::table('tbl_customer')->get();
        return view('export_excel')->with('customer_data', $customer_data);
    }

    public function excel_request_list()
    {
        $file_name = 'items_request_'.Carbon::now();
        return Excel::download(new itemRequestsExport, $file_name.'.xlsx');
    }

    public function excel_itemlist()
    {
        $file_name = 'items'.Carbon::now();
//        return (new ItemExport)->download('invoices.xlsx');
        return Excel::download(new ItemExport, $file_name.'.xlsx');
    }
    public function excel_sellerlist()
    {
        $file_name = 'sellers'.Carbon::now();
        return Excel::download(new DASellersRequestsExport, $file_name.'.xlsx');
    }
}


