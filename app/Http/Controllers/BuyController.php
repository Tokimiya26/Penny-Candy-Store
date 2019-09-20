<?php

namespace App\Http\Controllers;

use App\OrderItem;
use App\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Buy;
use Illuminate\Support\Facades\Mail;
//時刻に関するCarbonを使用
use Carbon\Carbon;

//購入画面のコントローラ
class BuyController extends Controller
{
  public function index()
  {
    $cartitems = CartItem::select('cart_items.*', 'items.name', 'items.amount', 'items.image_url')
      ->where('user_id', Auth::id())
      ->join('items', 'items.id', '=', 'cart_items.item_id')
      ->get();

    //商品の小計
    $subtotal = 0;
    foreach ($cartitems as $cartitem) {
      $subtotal += $cartitem->amount * $cartitem->quantity;
    }
    return view('buy/index', ['cartitems' => $cartitems, 'subtotal' => $subtotal]);
  }

  //入力した郵送先の情報を処理
  public function store(Request $request)
  {
    if ($request->has('order')) {
      //現在の時刻
      $now = Carbon::now();

      $cartitems = CartItem::select('cart_items.*', 'items.name', 'items.amount', 'items.image_url')
        ->where('user_id', Auth::id())
        ->join('items', 'items.id', '=', 'cart_items.item_id')
        ->get();

      //購入履歴に追加
      foreach ($cartitems as $cartitem) {
        OrderItem::insert(
          [
            'user_id' => Auth::id(),
            'item_id' => $cartitem->item_id,
            'quantity' => $cartitem->quantity,
            'created_at' => $now,
            'updated_at' => $now,
          ]
        );
      }
      //MailクラスとBuyクラスを使ってメールを送信する
      Mail::to(Auth::user()->email)->send(new Buy());
      //カートから削除する
      CartItem::where('user_id', Auth::id())->delete();
      return view('buy/complete');
    }
    $request->flash();
    return $this->index();
  }
}
