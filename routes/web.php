<?php

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/customer', function () {
    $customers = Customer::all();
    return view('customer', ['customers' => $customers]);
});

Route::get('/customer/edit/{id?}', function (int $id = null) {
    $customer = null;
    if ($id != null) $customer = Customer::find($id);
    return view('customer-edit', ['customer' => $customer]);
});

Route::post('/customer', function(Request $request){
    DB::table('customers')->insertGetId(
        ['last_name' => $request->input('last_name'), 
        'first_name' => $request->input('first_name'),
        'middle_name' => $request->input('middle_name')]
    );
    $customers = Customer::all();
    return view('customer', ['customers' => $customers]);
});

Route::put('/customer/{id}', function(Request $request, int $id){
    $name = $request->input('last_name');
    DB::table('customers')
        ->where('id', $id)
        ->update(['last_name' => $request->input('last_name'), 
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name')]);
    $customers = Customer::all();
    return view('customer', ['customers' => $customers]);        
});