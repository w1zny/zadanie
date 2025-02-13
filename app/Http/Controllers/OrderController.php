<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getProducts($order_id, Request $request)
    {
        $page = $request->input('page',1);
        $limit = $request->input('limit',5);
        $filter = $request->input('filter','');
        
        $order = Order::find($order_id);
        if (!$order) return abort(404);

        $productsQuery = $order->products();

        if ($filter) {
            $productsQuery = $productsQuery->where('name', 'like', '%' . $filter . '%');
        }

        $products = $productsQuery->paginate($limit, ['name', 'price'], 'page', $page);

        return response()->json($products);
    }

    public function getOrders(Request $request)
    {
        $page = $request->input('page',1);
        $limit = $request->input('limit',5);

        $orders = Order::paginate($limit, ['customer_name', 'total_price'], 'page', $page);

        return response()->json($orders);
    }
}
