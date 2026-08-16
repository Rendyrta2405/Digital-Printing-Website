<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
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
