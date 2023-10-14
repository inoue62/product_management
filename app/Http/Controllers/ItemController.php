<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Image;

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
//    public function index()
//    {
//        // 書籍一覧取得
//        $items = Item::all();
//
//        return view('item.index', compact('items'));
//    }
    public function index(Request $request)
    {
        $keyword = $request -> keyword;
        $keygenre = $request -> keygenre;
        $clear = $request -> clear;
        $query = Item::query();

        if($keygenre){
            //ジャンル選択時
            if($keyword){
                //キーワード入力時
                $query =  $query->where(function($query) use($keyword){
                    $query->where( 'name' , 'like' , '%' . $keyword .'%' )
                        ->orwhere( 'author' , 'like' , '%' . $keyword .'%' )
                        ->orwhere( 'detail' , 'like' , '%' . $keyword .'%' );
                })->where( 'genre', $keygenre );
            }else{
                //キーワード未入力時
                $query = $query->where( 'genre', $keygenre );
            }
        }else if($keyword){
            //ジャンル非選択時　キーワード入力時
            $query = $query->where( 'name' , 'like' , '%' . $keyword .'%' )
            ->orwhere( 'author' , 'like' , '%' . $keyword .'%' )
            ->orwhere( 'detail' , 'like' , '%' . $keyword .'%' );
        }

        $items = $query ->orderBy('id', 'asc') ->paginate(10);
        return view('item.index',[
            'items'=> $items,
            'keyword' => $keyword,
            'keygenre' => $keygenre
        ]);
    }
    /**
     * 書籍登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {

            //エラーチェック
            $rule=[
                'name' => 'required|max:100',                                                                          
                'genre' => 'integer',                                                        
                'author' => 'required|max:100',   
                'publisher' => 'max:100', 
                'detail' => 'max:500', 
                ];
            //エラーメッセージ
            $msg=[
                'name.required' => '書籍名を入力してください',
                'name.max' => '書籍名は100文字以下で入力してください',
                'genre.integer' => 'ジャンルを選択してください',
                'author.required' => '著者名を入力してください',
                'author.max' => '著者名は100文字以下で入力してください',
                'publisher.max' => '出版社名は100文字以下で入力してください',
                'detail.max' => '詳細は500文字以下で入力してください',
                ];
            $request->validate($rule,$msg);

            if($request->image){
                // ディレクトリ名
                $dir = 'sample';
    
                // アップロードされたファイル名を取得
                $file_name = $request->file('image')->getClientOriginalName();
//                $file_name = $request->image->getClientOriginalName();
    
                // 取得したファイル名で保存
                $request->file('image')->storeAs('public/' . $dir, $file_name);
    
                // ファイル情報をDBに保存
//                $item->image = $file_name;
//                $item->image_path = 'storage/' . $dir . '/' . $file_name;

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
                    'image' => $file_name,
                    'type' => 'storage/' . $dir . '/' . $file_name
                ]);
            }else{
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
            }

            return redirect('/items');
        }

        return view('item.add');
    }

    public function edit(Request $request, $id)
    {
        $item = Item::find($request->id);
        return view('item.edit',['item' => $item]);
    }

    public function update(Request $request, $id)
    {
        //エラーチェック
        $rule=[
            'name' => 'required|max:100',                                                                          
            'genre' => 'integer',                                                        
            'author' => 'required|max:100',   
            'publisher' => 'max:100', 
            'detail' => 'max:500', 
            ];
        //エラーメッセージ
        $msg=[
            'name.required' => '書籍名を入力してください',
            'name.max' => '書籍名は100文字以下で入力してください',
            'genre.integer' => 'ジャンルを選択してください',
            'author.required' => '著者名を入力してください',
            'author.max' => '著者名は100文字以下で入力してください',
            'publisher.max' => '出版社名は100文字以下で入力してください',
            'detail.max' => '詳細は500文字以下で入力してください',
            ];
        $request->validate($rule,$msg);

        $item = Item::find($id);
        $item->name = $request->name;
        $item->genre = $request->genre;
        $item->release_date = $request->release_date;
        $item->price = $request->price;
        $item->author = $request->author;
        $item->publisher = $request->publisher;
        $item->stock = $request->stock;
        $item->detail = $request->detail;

        if($request->image){
            // ディレクトリ名
            $dir = 'sample';

            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();

            // 取得したファイル名で保存
            $request->file('image')->storeAs('public/' . $dir, $file_name);

            // ファイル情報をDBに保存
            $item->image = $file_name;
            $item->type = 'storage/' . $dir . '/' . $file_name;
        }

        $item->save();

        return redirect('/items');
    }

    // 削除処理
    public function delete(Request $request,$id)
    {
        Item::find($request->id)->delete();
        return redirect('/items');
    }

    public function upload(Request $request,$id)
    {
        $item = Item::find($request->id);
        
        if($request->image){
            // ディレクトリ名
            $dir = 'sample';
    
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
    
            // 取得したファイル名で保存
            $request->file('image')->storeAs('public/' . $dir, $file_name);
    
            $item->image = $file_name;
            $item->type = 'storage/' . $dir . '/' . $file_name;
            $item->save();
        }


        return view('item.edit',['item' => $item]);
    }
}
