<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 書籍一覧
     */
    public function index()
    {
        // 書籍一覧取得
        $items = Item::all();

        return view('item.index', compact('items'));
    }

    /**
     * 書籍登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 書籍登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'genre' => $request->genre,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'release_date' => $request->release_date,
                'stock' => $request->stock,
                'price' => $request->price,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }
}
