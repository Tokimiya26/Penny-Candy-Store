@extends('layouts.app')

@guest
<?php
  header('location:/login');
?>
@else
  @section('content')
    <div class="container pt-5">
      <div class="row justify-content-center" style="margin-bottom:10px;">
        <div class="col-md-8 text-center">
          <p style="font-size:30px;">出店ページ</p>
          <div class="card">
            <div class="card-header">
              出店商品入力
            </div>
            <div class="card-body">
              <form method="POST" action="/postitem" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6 offset-md-3">
                    <label for="name">商品名 <span class="bg-danger text-white p-1">必須</span></label>
                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6 offset-md-3">
                    <label for="amount">価格 <span class="bg-danger text-white p-1">必須</span></label>
                      <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6 offset-md-3">
                    <label for="image_url">画像 <span class="bg-danger text-white p-1">必須</span></label>
                      <input id="image_url" type="file" class="form-control" name="image_url" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6 offset-md-3">
                    <label for="description">商品説明 <span class="bg-danger text-white p-1">必須</span></label>
                      <textarea id="description" name="description" class="form-control" rows="10" required></textarea>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-6 offset-md-3">
                      <button type="submit" class="btn btn-primary" name="post">商品を出店する</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection
@endguest
