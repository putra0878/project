<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $customer = Customer::create([
            'order_number' => $request->order_number,
            'name' => $request->name,
            'email' => $request->email,
            'image_path' => $imagePath,
            'approved' => false,
        ]);

        return redirect()->route('customer.waiting', $customer->id);
    }

    public function waiting($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.waiting', compact('customer'));
    }

    public function status($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json(['approved' => $customer->approved]);
    }
}
