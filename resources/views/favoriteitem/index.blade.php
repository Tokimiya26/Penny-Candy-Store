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
          <p style="font-size:30px;">欲しい物リスト</p>
          <div class="card">
            @foreach ($favoriteitems as $favoriteitem)
              <div class="card-header">
              <a href="/item/{{ $favoriteitem->item_id }}">{{ $favoriteitem->name }}</a>
              </div>
              <div class="card-body">
                <p><img src="/images/post-img/{{ $favoriteitem->image_url }} " width="250" height="250"></p>
                <div>
                  価格: {{ $favoriteitem->amount }}円（税込）
                </div>
                <div class="form-inline">
                  <!-- 削除フォーム -->
                  <form method="POST" action="/favoriteitem/{{ $favoriteitem->id }}" class="col-md-6 offset-md-3 my-2">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">欲しい物リストから削除</button>
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  @endsection
@endguest
