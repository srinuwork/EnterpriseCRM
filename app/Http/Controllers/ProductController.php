<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Client;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('client')->latest()->get();
        return view('products.allproducts', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('products.newproduct', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'project_name' => 'required|string|max:255',
            'project_type' => 'required|string',
            'price' => 'required|numeric',
            'project_status' => 'required|string',
            'description' => 'nullable|string'
        ]);

        // Merging missing schema requirements (initial_price and dates)
        $data = $request->all();
        $data['initial_price'] = $request->price; // Default initial price to current price
        $data['start_date'] = now()->toDateString(); // Default to today
        $data['end_date'] = now()->addMonths(1)->toDateString(); // Default to 1 month from now

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Project launched successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('client')->findOrFail($id);
        return view('products.viewproduct', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $clients = \App\Models\Client::all();
        return view('products.editproduct', compact('product', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'project_name' => 'required|string|max:255',
            'project_type' => 'required|string',
            'price' => 'required|numeric',
            'project_status' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Project removed successfully.');
    }
}
