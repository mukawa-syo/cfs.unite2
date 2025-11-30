<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\PurchaseCompleted;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        // 新しいOrderインスタンスを作成
        $order = new Order([
            'order_date' => now(),
            'last_name' => '匿名',
            'first_name' => 'サポーター',
            'last_name_kana' => 'トクメイ',
            'first_name_kana' => 'サポーター',
            'phone_number' => '000-0000-0000',
            'email' => '1234@mail.com',
            'postal_code' => '000-0000',
            'prefecture' => '東京都',
            'city' => '新宿区',
            'address' => 'サンプル1-1-1',
            'building_name' => 'サンプルビル101',
            'terms_agreement' => 1,
            'payment_status' => Order::PAYMENT_PENDING,
            'charge_id' => null,
            'session_id' => null,
            'reward_detail_id' => 1,
            'supporter_id' => 1,
        ]);

        // 保存
        $order->save();

        // 購入完了メールを送信
        Mail::to($order->email)->send(new PurchaseCompleted($order));

        return redirect()->route('orders.index');
    }

    public function show($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('orders.show', compact('order'));
    }

    public function edit($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->update($request->all());
        return redirect()->route('orders.index');
    }

    public function destroy($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->delete();
        return redirect()->route('orders.index');
    }
}
