<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;

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

//DATABASE SIMPLE/BASIC OPERATION


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


//ELOQUENT MODEL


    //find

Route::get('/read' ,function(){

    $add_data = Post::all();
    foreach($add_data as $data){
        echo '<pre>';
        echo $data->id.' ';
        echo $data->name.' ';
        echo $data->email.' ';
        echo '</pre>';
    }
});

Route::get('/find/{id}' ,function($id){

    $data = Post::find($id);
        echo '<pre>';
        echo $data->id.' ';
        echo $data->name.' ';
        echo $data->email.' ';
        echo '</pre>';
});

Route::get('/findwhere/{id}' ,function($id){

    $data = Post::where('id',$id)->first();
        echo '<pre>';
        echo $data->id.' ';
        echo $data->name.' ';
        echo $data->email.' ';
        echo '</pre>';
});

Route::get('/findmore' , function(){
    // $find = Post::findOrFail(8);
    //goes to defalut not found page 
    $find = Post::where('id' ,'<', '7')->firstOrFail();
    return $find;
});

    //insert
Route::get('/insertdata', function(){
        $post = new Post;
        $post->id = 4;
        $post->name = 'ganesh';
        $post->email = 'ganesh@gmaail.com';
        $post->save();
        $display = Post::find(4);
        return $display;
    });


    //update
Route::get('/updatedata/{id}', function($id){
        $post = Post::find($id);
        $post->name = 'ganesh2';
        $post->email = 'ganesh2@gmaail.com';
        $post->save();
        $display = Post::find($id);
        return $display;
    });
        //update data method 2 
        Route::get('/updatedata2/{id}', function($id){
            Post::where('id',$id)->update(['name'=>'vigyan',  'email'=>'vigyan@gmail.com']);
        });

// create data

Route::get('/createdata', function(){
        $post = Post::create(['name'=>'asdasd','email'=>'asd@gmail.com']);
        
    });

//delete data

    //method 1
    Route::get('/deletedata/{id}', function($id){
            $post = Post::where('id',$id)->delete();
            
        });

    //method 2
    Route::get('/deletedata2/{id}', function($id){
            $post = Post::destroy($id);
            
        });

//TRASHING

Route::get('/softdeletes/{id}', function($id){
    Post::find($id)->delete();
});
    //know which one's aare trashed
Route::get('/retsoftdeletes', function(){
    $post = Post::onlyTrashed()->get();
    foreach($post as $p){
        echo '<pre>';
        echo $p->id;
        echo $p->name;
        echo $p->email;
    }
});

    //restore the trashed
Route::get('/restoredeletes', function(){
    //$post = Post::onlyTrashed()->restore();

    //or

    $post = Post::where('id',1)->restore();
    return $post;
});

    //force delete .completely delete it without option to restore

Route::get('/forcedeletes', function(){
    //$post = Post::onlyTrashed()->restore();

    //or

    $post = Post::onlyTrashed()->where('id',4)->forceDelete();
    return $post;
});


    //Eloquent : One-To_One Relation

    Route::get('user/{id}/post',function($id){
        $result = User::find($id)->post;
        return $result;

    });

















require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
