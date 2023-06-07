<?php

use App\Models\Customer;
use App\Models\Product;
use App\Models\Store;
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
        foreach ($products as $product){
            if ($product->store_id != null) $product->store_name = Store::find($product->store_id)->store_name;
        }
        return $products;
    });

    Route::get('/getWithoutStores', function (){
        try{
            $products = DB::table('products')->whereNull('store_id')->get();
            return $products;
        }
        catch (Throwable $e){
            error_log($e);
        }
    });

    Route::get('/getWithStores', function (){
        try{
            $products = DB::table('products')->whereNotNull('store_id')->get();
            return $products;
        }
        catch (Throwable $e){
            error_log($e);
        }
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

    Route::put('/deliver/{id}', function(Request $request, int $id){
        error_log('deliver');
        DB::table('products')->where('id', $id)->update(['store_id' => $request->input('id')]);
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

Route::prefix('order')->group(function(){
    Route::get('/', function(){
        $orders = DB::table('ordereds')->get();
        foreach ($orders as $order){
            $product = Product::find($order->product_id);
            $customer = Customer::find($order->customer_id);
            $order->product_name = $product->product_name;
            $order->customer_fio = $customer->last_name . ' ' . $customer->first_name . ' ' . $customer->middle_name;
            $order->store_name = Store::find($product->store_id)->store_name;
        }
        return $orders;
    });

    Route::get('/{id}', function(int $id){
        $order = DB::table('ordereds')->find($id);
        return $order;
    });

    Route::post('/', function(Request $request){
        try{
        DB::table('ordereds')->insertGetId([
            'quantity' => $request->input('quantity'),
            'product_id' => $request->input('product_id'),
            'customer_id' => $request->input('customer_id')
        ]);
        }
        catch (Throwable $e){
            error_log($e);
        }
    });
});