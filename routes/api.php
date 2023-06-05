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

