<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InvoiceController extends Controller
{
    /**
     * All the invoices will be load from here.
     * @return View 
     */
    public function index()
    {
        //All the client will be load 
        $clients = Client::all();
        //Joins of multiple table 
        $invoices = DB::table('InvoiceLineItems')
        ->join('Invoices', 'InvoiceLineItems.invoice_num', '=', 'Invoices.invoice_num')
        ->join('Products', 'InvoiceLineItems.product_id', '=', 'Products.product_id')
        ->join('Clients', 'Products.client_id', '=', 'Products.client_id')
        ->orderBy('Invoices.invoice_date')
        ->select('Invoices.invoice_date', 'Invoices.invoice_num','Products.product_description', 'Products.product_id', 'InvoiceLineItems.qty', 'InvoiceLineItems.price')
        ->get();

        //store invoice list view and pass it main view file
        $invoiceList = view('invoice.ajax-invoice')->with(compact('invoices'))->render();
        return view('invoice.index')->with(compact('clients', 'invoices', 'invoiceList'));
    }

    /**
     * Filter invoices 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterInvoice(Request $request)
    {
        //Invoice list will be be filter here with provided filter from request
        $invoices = DB::table('InvoiceLineItems')
        ->join('Invoices', 'InvoiceLineItems.invoice_num', '=', 'Invoices.invoice_num')
        ->join('Products', 'InvoiceLineItems.product_id', '=', 'Products.product_id')
        ->join('Clients', 'Products.client_id', '=', 'Products.client_id')
        ->select('Invoices.invoice_date', 'Invoices.invoice_num', 'Products.product_description', 'Products.product_id', 'InvoiceLineItems.qty', 'InvoiceLineItems.price')
        ->when($request->relative_date,function($query) use ($request){
            $date = $this->dateRangeFilter($request->relative_date);
            $from = $date['from'];
            $to = $date['to'];
            return $query->whereBetween('Invoices.invoice_date',[$from,$to]);
        })
        ->when($request->client_id,function($query) use($request) {
            return $query->where('Clients.client_id', $request->client_id);
        })
        ->when($request->product_id,function($query) use($request) {
            return $query->where('Products.product_id', $request->product_id);
        })
        ->orderBy('Invoices.invoice_date')
        ->get();
      
        $invoiceList = view('invoice.ajax-invoice')->with(compact('invoices'))->render();

        return response()->json(['status' => true, 'msg' => 'Invoice list', 'data' => array('invoiceList' => $invoiceList)]);
    }

    /**
     * Get from and to date based on provided relative date
     * @param mixed $relativeDate
     * @return string[]
     */
    public function dateRangeFilter($relativeDate)
    {
        if($relativeDate == "this_month"){
            $from = new Carbon('first day of this month');
            $to = new Carbon('last day of this month');
        }elseif($relativeDate == "last_month_to_date"){
            $from = new Carbon('first day of last month');
            $to = new Carbon('today');
        }elseif ($relativeDate == "this_year") {
            $to = new Carbon('today');
            $from = $to->copy()->startOfYear();
        }elseif ($relativeDate == "last_year") {
            $from = new Carbon('today');
            $from->startOfYear()->subWeek(52);
            $to = $from->copy()->endOfYear();
        }
     
        return array('from'=>$from->format('Y-m-d'),'to'=>$to->format('Y-m-d'));
        
    }

}
