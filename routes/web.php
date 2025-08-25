<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::get('/about',array('as'=>'about.page' , function () {
    $ab = route('about.page');
    return view('about',['ab'=> $ab]);
}));
Route::get('/home/{id}/{name}', function ($id,$name) {
    
    return view('home',['id' => $id , 'name'=> $name]);
});
//Route::get('/info/{aba}',[UserController::class,'index']);
Route::resource('/users',UserController::class);
Route::get('/views/{id}',[UserController::class,'view1']);
Route::get('/contact/{id}',function($id){
    return view('contact',compact('id'));
});
Route::get('/insert/{id}',function($id){
    DB::insert('insert into example(id, is_admin) values(?, ?)' ,[$id,1]);
});
Route::get('/read',function(){
    $res = DB::select('SELECT * FROM example WHERE id = ?' ,[3]);
    foreach( $res as  $a ){
        return $a->created_at;
    }
});
Route::get('/update',function(){
    $res = DB::update('UPDATE example set is_admin = 10 WHERE id = ?' , [3]);
    return $res;
});
Route::get('/delete/{id}',function($id){
    $res = DB::update('DELETE FROM example WHERE id = ?' , [$id]); 
    return $res;
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});




























require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
