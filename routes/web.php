<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AdminController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    $products = Product::all();
    return view('welcome', compact('products'));
})->name('welcome');

Route::get('/update-stock', function () {
        // Ambil order terbaru untuk setiap produk
    $latestOrders = DB::table('orders')
        ->select('product_id', DB::raw('MAX(selesai) as latest_date'))
        ->groupBy('product_id')
        ->get();

    foreach ($latestOrders as $latestOrder) {
        // Ambil detail order terbaru untuk setiap produk
        $latestOrderData = DB::table('orders')
            ->where('product_id', $latestOrder->product_id)
            ->where('selesai', $latestOrder->latest_date)
            ->first();

        if ($latestOrderData) {
            $selesai = Carbon::parse($latestOrderData->selesai);
            $sekarang = Carbon::now();

            if ($selesai->lessThanOrEqualTo($sekarang)) {
                // Update kolom `jumlah` di tabel `product` dengan menambahkan jumlah dari order yang paling baru
                DB::table('products')
                    ->where('id', $latestOrderData->product_id)
                    ->increment('jumlah', $latestOrderData->jumlah);
            }
        }
    }
    return redirect()->route('welcome');
});

Route::get('/dashboard', function () {
    if(Auth::user()->hasRole('user')){
            return redirect()->route('welcome');        // return redirect()->route('admin.dashboard');
    } else if (Auth::user()->hasRole('admin')){
        return redirect()->route('admin.dashboard');
    } else if (Auth::user()->hasRole('seller')){
        return redirect()->route('seller.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/product/{product}/detail', [ProductController::class, 'show'])->name('product.show');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/success/{order}', [OrderController::class, 'success'])->name('order.success');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('/orderlist', [SellerController::class, 'orderlist'])->name('order.list');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/user', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/user/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::get('/user/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::get('/user/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::get('/admin/orderlist', [AdminController::class, 'orderlist'])->name('admin.orderlist');
});


require __DIR__.'/auth.php';
