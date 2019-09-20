@extends('layouts.app')

@guest
<?php
  header('location:/login');
?>
@else
  @section('content')
    @if (Session::has('flash_message'))
      <div class="alert alert-success text-center">
        {{ session('flash_message') }}
      </div>
    @endif
    <div class="container pt-5">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center">
          <p style="font-size:30px;">購入履歴</p>
          <div class="card">
            @foreach ($orderitems as $orderitem)
              <div class="card-header">
              <a href="/item/{{ $orderitem->item_id }}">{{ $orderitem->name }}</a>
              </div>
              <div class="card-body">
                <p><img src="/images/post-img/{{ $orderitem->image_url }} " width="250" height="250"></p>
                <div>
                  価格 : {{ $orderitem->amount }}円（税込）
                </div>
                <div>
                  個数 : {{ $orderitem->quantity }}個
                </div>
                <div>
                  注文日時 : {{ $orderitem->created_at }}
                </div>
                <?php
                  $carbon = $orderitem->created_at; // 注文日時
                  $dt = $carbon->addDays(3); //注文日時の3日後
                  $now = now(); //現在の時刻
                 ?>
                <!-- 現在の時刻が注文日時の3日後の場合 -->
                @if ($now > $dt)
                <!-- 現在の時刻が注文日時の3日以内の場合 -->
                @else
                <div class="form-inline">
                  <!-- 削除フォーム -->
                  <form method="POST" action="/orderitem/{{ $orderitem->id }}" class="col-md-6 offset-md-3 my-2">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('本当にキャンセルしますか？')">注文をキャンセル</button>
                  </form>
                </div>
                @endif
                <p>※注文日時より3日以内ならキャンセル可能です。</p>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  @endsection
@endguest
