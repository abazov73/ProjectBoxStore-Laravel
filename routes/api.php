<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('customer')->group(function (){
    Route::get('/', function (){
        $customers = DB::table('customers')->get();
        return $customers;
    });

    Route::get('/{id}', function (int $id){
        $customer = DB::table('customers')->find($id);
        return $customer;
    });

    Route::post('/', function(Request $request){
        DB::table('customers')->insertGetId(
            ['last_name' => $request->input('last_name'), 
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name')]
        );
    });

    Route::put('/{id}', function(Request $request, int $id){
        $name = $request->input('last_name');
        try{
        DB::table('customers')
            ->where('id', $id)
            ->update(['last_name' => $request->input('last_name'), 
                    'first_name' => $request->input('first_name'),
                    'middle_name' => $request->input('middle_name')]);
        }
        catch (Throwable $e){
            error_log($e);
        }
    });

    Route::delete('/{id}', function(int $id){
        DB::table('customers')->where('id', $id)->delete();
    });
});

Route::prefix('store')->group(function(){
    Route::get('/', function(){
        $stores = DB::table('stores')->get();
        return $stores;
    });

    Route::get('/{id}', function(int $id){
        $store = DB::table('stores')->find($id);
        return ($store);
    });

    Route::post('/', function(Request $request){
        DB::table('stores')->insertGetId([
            'store_name' => $request->input("store_name")
        ]);
    });

    Route::put('/{id}', function(Request $request, int $id){
        // $name = $request->input('store_name');
        // error_log($name);
        try{
        DB::table('stores')
        ->where('id', $id)
        ->update(['store_name' => $request->input('store_name')]);
        }
        catch (Throwable $e){
            error_log($e);
        }
    });

    Route::delete('/{id}', function(int $id){
        DB::table('stores')->where('id', $id)->delete();
    });
});

Route::prefix('product')->group(function (){
    Route::get('/', function(){
        $products = DB::table('products')->get();
        return $products;
    });

    Route::get('/{id}', function (int $id){
        $product = DB::table('products')->find($id);
        return $product;
    });
    
    Route::post('/', function (Request $request){
        DB::table('products')->insertGetId([
            'product_name' => $request->input('product_name')
        ]);
    });

    Route::put('/{id}', function (Request $request, int $id){
        DB::table('products')
            ->where('id', $id)
            ->update(['product_name' => $request->input('product_name')]);
    });

    Route::delete('/{id}', function (int $id){
        DB::table('products')->where('id', $id)->delete();
    });
});