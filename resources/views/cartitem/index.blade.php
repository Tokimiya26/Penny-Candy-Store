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
        <div class="col-md-8 text-center mt-2">
          <p style="font-size:30px;">カート内商品</p>
          <div class="card">
            @foreach ($cartitems as $cartitem)
              <div class="card-header">
              <a href="/item/{{ $cartitem->item_id }}">{{ $cartitem->name }}</a>
              </div>
              <div class="card-body text-center">
                <p><img src="/images/post-img/{{ $cartitem->image_url }} " width="250" height="250"></p>
                <div>
                  価格: {{ $cartitem->amount }}円（税込）
                </div>
                <div class="form-inline">
                  <!-- 数量更新フォーム -->
                  <form method="POST" action="/cartitem/{{ $cartitem->id }}" class="col-md-6 offset-md-3 my-2">
                    @method('PUT')
                    @csrf
                    <input type="text" class="form-control" name="quantity" value="{{ $cartitem->quantity }}">個
                    <button type="submit" class="btn btn-success">更新</button>
                  </form>
                  <!-- 削除フォーム -->
                  <form method="POST" action="/cartitem/{{ $cartitem->id }}" class="col-md-6 offset-md-3 my-2">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-1">カートから削除する</button>
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <div class="col-md-4 text-center mt-2">
          <p style="font-size:30px;">お会計</p>
          <div class="card">
            <div class="card-header">
              小計
            </div>
            <div class="card-body">
              <div>
                価格 : {{ $subtotal }}円（税込）
              </div>
              <div>
                <a class="btn btn-primary mt-2" href="/buy" role="button">
                  レジに進む
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection
@endguest
