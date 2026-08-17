<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimonial;

class DashboardController extends Controller
{
   public function index()
   {
      $stats = [
         'categories' => Category::count(),
         'products' => Product::count(),
         'orders' => Order::valid()->count(),
         'leads' => Order::where('status', 'menunggu')->count(),
         'ordersToday' => Order::whereDate('created_at', today())->count(),
         'revenue' => Order::valid()->sum('total'),
         'awaitingApproval' => Testimonial::where('is_approved', false)->count(),
      ];

      $recentOrders = Order::with('product')->latest()->get();

      return view('admin.dashboard', compact('stats', 'recentOrders'));
   }
}
