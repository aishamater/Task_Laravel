<?php

use App\Models\Category;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    $category = Category::all();
    return view('welcome', compact('category'));
});

Route::post('/store', function (Request $request) { //post method for save data
    $request->validate([
        'name' => 'required'
    ]);
    $cat = new Category();
    $cat->name = $request->name;
    $cat->parent_id = $request->parent == null ? 0 : $request->parent;

    $cat->save(); // now save here
    toastr()->success('Created Successfully'); // this is for notification for success
    return redirect()->back(); //after store data redirect back to main page
})->name('category_store');// this is route name



Route::get('getdata/{id}', function ($id) { //this is for show category
    $data = Category::where('parent_id', $id)->get(); //getting category where parent id is that id
    return json_encode($data);
    // return response($data);
});

