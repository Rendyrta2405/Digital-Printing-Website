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
           ->paginate(10)
           ->withQueryString();

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
             'product_id' => ['required', 'exists:products,id'],
             'quantity' => ['required', 'integer', 'min:1', 'max:10000'],
             'width' => ['nullable', 'numeric', 'min:0.1', 'max:100'],
             'height' => ['nullable', 'numeric', 'min:0.1', 'max:100'],
             'design_option' => ['required', 'in:punya,buatkan'],
             'notes' => ['nullable', 'string', 'max:500'],
             'customer_name' => ['required', 'string', 'max:100'], 
             'customer_phone' => ['required', 'string', 'max:20'],
        ]);

       $existing = Order::where('product_id', $validated['product_id'])
          ->where('customer_name', $validated['customer_name'])
          ->where('created_at', '>', now()->subMinutes(5))
          ->first();

       if ($existing) {
          return redirect()->route('orders.success', [
              'orderNumber' => $existing->order_number,
          ]);
       }

       $order = Order::create([...$validated, 'status' => 'menunggu']);
       $order->total = $order->calculateTotal();
       $order->save();

       // return redirect()->away($order->whatsappUrl());

       // ❌ SEBELUM (melanggar PRG)
       // return view('order.success', ['order' => $order]);

       // ✅ SESUDAH (PRG)
       return redirect()->route('orders.success', [
           'orderNumber' => $order->order_number,
       ]);
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

   public function track(Request $request)
   {
      $order = null;

      if ($request->filled('order_number')) {
         $order = Order::with('product')
            ->where('order_number', $request->order_number)
            ->first();
      }

      return view('track', [
         'order' => $order,
         'searched' => $request->filled('order_number'),
      ]);
   }

   public function success(string $orderNumber)
   {
      return view('order.success', [
         'order' => Order::where('order_number', $orderNumber)->firstOrFail(),
      ]);
   }
}
