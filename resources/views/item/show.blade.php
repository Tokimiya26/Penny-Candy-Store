@extends('layouts.app')

@section('content')
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <p style="font-size:30px;">商品詳細</p>
        <div class="card">
          <div class="card-header">
            <a href="/item/{{ $item->id }}">{{ $item->name }}</a>
          </div>
          <div class="card-body">
            <p><img src="/images/post-img/{{ $item->image_url }} " width="250" height="250"></p>
            <p>商品説明 : {{ $item->description }}</p>
            <div>価格 : {{ $item->amount }}円（税込）</div>
          </div>
          @auth
          <form method="POST" action="/cartitem" class="form-inline m-2">
            {{ csrf_field() }}
            <select name="quantity" class="form-control col-md-2 offset-md-1 mr-1">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <button type="submit" class="btn btn-primary col-md-6">カートに入れる</button>
          </form>
          <form method="POST" action="/favoriteitem" class="form-inline m-2">
            {{ csrf_field() }}
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <button type="submit" class="btn btn-warning col-md-6 offset-md-3 mb-3">欲しい物リスト追加</button>
          </form>
          @endauth
        </div>
      </div>
    </div>
  </div>
@endsection
