<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = [
            'title' => 'Create User',
            'button' => 'Create',
            'method' => 'POST',
            'action' => route('product.store')
        ];
        return view('user.form', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $page = [
            'title' => 'Edit User',
            'button' => 'Update',
            'method' => 'PUT',
            'action' => route('product.update', $user->id)
        ];
        return view('user.form', compact('page', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function user(){
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function orderlist(Request $request)
    {
    $status = $request->input('status');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $orders = Order::when($status, function ($query, $status) {
        return $query->where('status', $status);
    })
    ->when($startDate, function ($query, $startDate) {
        return $query->whereDate('created_at', '>=', $startDate);
    })
    ->when($endDate, function ($query, $endDate) {
        return $query->whereDate('created_at', '<=', $endDate);
    })
    ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal pesanan terbaru
    ->get();

    return view('admin.orderlist', compact('orders'));
    }
}
