<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::with('product')
           ->status($request->query('status'))
           ->search($request->query('q'))
           ->latest()
           ->get();

       return view('admin.orders.index', [
          'orders' => $orders,
          'statuses' => Order::STATUSES,
          'currentStatus' => $request->query('status'),
          'currentSearch' => $request->query('q'),
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', [
           'order' => $order->load('product'),
           'statuses' => Order::STATUSES,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
             'status' => ['required', 'in:' . implode(',', Order::STATUSES)],
        ]);

       $order->update($validated);

       return back()->with('success', "Status {$order->order_number} → {$validated['status']}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
