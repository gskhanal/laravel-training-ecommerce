<?php
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\ProductsController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', function () {
    $products = Product::all();
    return view('home', ['products' => $products] );
});
Route::get('/products/{prod}', function (Product $prod) {  
    // $product = Product::find($id);
    return view('product', ['product' => $prod] );
});

Route::get('/create_product', function(){
    Product::create([
        'product_name' => 'Laptop1',
        'product_desc' => 'This is very nice laptop1',
        'price' => '100000'
    ]);

    $product = new Product;
    $product->product_name = 'Pen';
    $product->product_desc = 'This is pen';
    $product->price = '10';
    $product->save();

    $product = Product::find(2);

});

Route::get('/home', [ProductsController::class, 'index']);

Route::get('/categories/{category}', function(Category $category) {
    // $products = Product::whereCategoryId($category->id)->get();
    $products = $category->products;
    return view('category', ['products' => $products, 'category' => $category]);
});

// Route::get('/get_product', function(){
//     $products = Product::get();
//     return $products;
// });


//  admin routing
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('dashboard');
    // Route::get('products', [App\Http\Controllers\Admin\ProductsController::class, 'index'])->name('products_list');
    // Route::get('products/create', [App\Http\Controllers\Admin\ProductsController::class, 'create'])->name('create_product');
    // Route::post('products/store', [App\Http\Controllers\Admin\ProductsController::class, 'store']);
    // Route::get('products/edit/{product}', [App\Http\Controllers\Admin\ProductsController::class, 'edit']);
    Route::resource('categories', App\Http\Controllers\Admin\CategoriesController::class);
    Route::resource('products', App\Http\Controllers\Admin\ProductsController::class);
});