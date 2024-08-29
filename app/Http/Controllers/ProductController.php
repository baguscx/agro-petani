<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = [
            'title' => 'Tambah Produk',
            'button' => 'Tambah',
            'method' => 'POST',
            'action' => route('product.store')
        ];
        return view('product.form', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required|numeric',
            'kategori' => 'required|string',
            'jumlah' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/product'), $imageName);
            $validatedData['gambar'] = 'images/product/' . $imageName;
        }

        // Store the new product
        Product::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $page = [
            'title' => 'Edit Produk',
            'button' => 'Update',
            'method' => 'PUT',
            'action' => route('admin.user.update', $product->id)
        ];
        return view('product.form', compact('page', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate the request
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required|numeric',
            'kategori' => 'required|string',
            'jumlah' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        // Check if a new image was uploaded
        if ($request->hasFile('gambar')) {
            // Upload new image
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/product'), $imageName);
            $validatedData['gambar'] = 'images/product/' . $imageName;
        } else {
            // Keep the existing image if no new image is uploaded
            $validatedData['gambar'] = $product->gambar;
        }

        // Update the product with validated data
        $product->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete the product (optional: delete the image file as well)
        // $product->delete();
    }
}
