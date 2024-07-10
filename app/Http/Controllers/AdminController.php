<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class AdminController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('admin.index', compact('customers'));
    }

    public function approve($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->approved = true;
        $customer->save();

        // Send email to the customer (you need to set up email configuration)
        // Mail::to($customer->email)->send(new ApprovalMail($customer));

        return redirect()->route('admin.index')->with('success', 'Customer approved successfully.');
    }
}
