<?php

namespace App\Http\Controllers;

use App\PostItem;
use App\Item;
use Illuminate\Http\Request;

//出店画面のコントローラ
class PostItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('postitem/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('post')) {

          //投稿画像を格納
          $originalName = $request->file('image_url')->getClientOriginalName();//ファイル名取得
          $request->file('image_url')->move(public_path() . '/images/post-img', $originalName);
          //itemテーブルへ投稿内容をインサート
          Item::insert(
            [
              'name' => $request->post('name'),
              'amount' => $request->post('amount'),
              'image_url' => $request->file('image_url')->getClientOriginalName(), //ファイル名取得
              'description' => $request->post('description'),
            ]
          );
          return redirect('/')->with('flash_message', '出店登録しました');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostItem  $postItem
     * @return \Illuminate\Http\Response
     */
    public function show(PostItem $postItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostItem  $postItem
     * @return \Illuminate\Http\Response
     */
    public function edit(PostItem $postItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostItem  $postItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostItem $postItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostItem  $postItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostItem $postItem)
    {
        //
    }
}
