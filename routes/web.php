<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','InvoiceController@index')->name('invoice.show');
Route::post('filter/invoices', 'InvoiceController@filterInvoice')->name('invoice.filter');
Route::get('get/product/{clientId?}', 'ProductController@getProduct')->name('product.list');
Route::get('test',function(){
    $invoiceObj = new InvoiceController();
    $invoiceObj->dateRangeFilter("this_year");
});
