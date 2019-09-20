<?php

namespace App\Http\Controllers;

use App\FavoriteItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//欲しい物リストのコントローラ
class FavoriteItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favoriteitems = FavoriteItem::select('favorite_items.*', 'items.name', 'items.amount', 'items.image_url')
          ->where('user_id', Auth::id())
          ->join('items', 'items.id', '=', 'favorite_items.item_id')
          ->get();
        return view('favoriteitem/index', ['favoriteitems' => $favoriteitems]);
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
        FavoriteItem::updateOrCreate(
          [
            'user_id' => Auth::id(),
            'item_id' => $request->post('item_id'),
          ]
        );
        return redirect('/')->with('flash_message', '欲しい物リストに追加しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FavoriteItem  $favoriteItem
     * @return \Illuminate\Http\Response
     */
    public function show(FavoriteItem $favoriteItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FavoriteItem  $favoriteItem
     * @return \Illuminate\Http\Response
     */
    public function edit(FavoriteItem $favoriteItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FavoriteItem  $favoriteItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FavoriteItem $favoriteItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FavoriteItem  $favoriteItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteItem $favoriteItem)
    {
        $favoriteItem->delete();
        return redirect('/favoriteitem')->with('flash_message', '欲しい物リストから削除しました');
    }
}
