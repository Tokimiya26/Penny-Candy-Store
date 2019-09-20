@extends('layouts.app')

@section('content')
  @if (Session::has('flash_message'))
    <div class="alert alert-success text-center">
      {{ session('flash_message') }}
    </div>
  @endif
  <div class="text-center mb-3" style="background-image:url('/images/img/dagashi-top.jpg'); background-position: center; background-size: cover; width: 100%; height: 500px;">
  </div>
  <div class="container">
    <div class="row justify-content-left">
      <div class="col-md-8 offset-md-2 text-center mb-5">
        <h2 class="font-weight-bold mt-5">Penny-Candy-Storeへようこそ</h2>
        <hr style="background-color:#EFB73E" width="250px">
        <p class="mt-4" style="font-size:18px;">こちらは駄菓子を販売しているショッピングサイトです。
          <br>購入するまでの一連の流れを体験することができます。
          <br>（※実際に購入はできません）
          <br>また、商品を出店登録することもできますのでよろしければ試してみて下さい。
          <br>昔懐かしい駄菓子を思い出しながら楽しんで頂けると幸いです。</p>
      </div>
      <div class="col-md-8 offset-md-2 mb-2 text-center">
        <p style="font-size:30px;">商品一覧</p>
      </div>
      @foreach ($items as $item)
      <div class="col-lg-4 col-md-6 mb-2 text-center">
        <div class="card">
          <div class="card-header">
            <a href="/item/{{ $item->id }}">{{ $item->name }}</a>
          </div>

          <div class="card-body">
            <p><img src="/images/post-img/{{ $item->image_url }} " width="250" height="250"></p>
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
              <button type="submit" class="btn btn-primary col-md-7">カートに入れる</button>
            </form>
            <form method="POST" action="/favoriteitem" class="form-inline m-2">
              {{ csrf_field() }}
              <input type="hidden" name="item_id" value="{{ $item->id }}">
              <button type="submit" class="btn btn-warning col-md-7 offset-md-3 mb-3">欲しい物リスト追加</button>
            </form>
          @endauth
        </div>
      </div>
      @endforeach
    </div>
    <div class="row justify-content-center mt-4">
      {{ $items->appends(['keyword' => Request::get('keyword')])->links() }}
    </div>
  </div>
@endsection
