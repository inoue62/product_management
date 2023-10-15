@extends('adminlte::page')

@section('title', '書籍一覧')

@section('content_header')
    <h1>書籍一覧</h1>
@stop

@section('content')
    <div class="text-right mt-3 mb-4">
        <div class="search-area mx-4">
            <div class="overflow-visible">
                <table>
                    <tr>
                        <form action="/items" method="get">
                            <th><input type="text" class="form-control" placeholder="キーワード検索" name="keyword" value="{{ $keyword }}"></th>
                            <th><select class="form-control" name="keygenre" value="{{ $keygenre }}">
                                <option value="" <?php if($keygenre == "") { echo "selected"; } ?>>全種別</option>
                                <option value="1" <?php if($keygenre == "1") { echo "selected"; } ?>>単行本</option>
                                <option value="2" <?php if($keygenre == "2") { echo "selected"; } ?>>文庫</option>
                                <option value="3" <?php if($keygenre == "3") { echo "selected"; } ?>>新書</option>
                                <option value="4" <?php if($keygenre == "4") { echo "selected"; } ?>>全集･双書</option>
                                <option value="5" <?php if($keygenre == "5") { echo "selected"; } ?>>コミック</option>
                                <option value="6" <?php if($keygenre == "6") { echo "selected"; } ?>>事･辞典</option>
                                <option value="7" <?php if($keygenre == "7") { echo "selected"; } ?>>図鑑</option>
                                <option value="8" <?php if($keygenre == "8") { echo "selected"; } ?>>絵本</option>
                                <option value="9" <?php if($keygenre == "9") { echo "selected"; } ?>>磁性媒体</option>
                                <option value="10" <?php if($keygenre == "10") { echo "selected"; } ?>>雑誌･その他</option>
                            </select></th>
                            <th><button type="submit" class="btn btn-outline-primary btn-sm">検索</button></th>
                        </form>
                        <form action="/items" method="get">
                            <th><button type="submit" class="btn btn-outline-primary btn-sm">クリア</button></th>
                        </form>
                        <th>　ジャンル毎に名前/著者/詳細のいずれかでキーワード検索ができます。</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">書籍一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">書籍登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>書籍名</th>
                                <th>ジャンル</th>
                                <th>発売日</th>
                                <th>登録日</th>
                                <th>著者</th>
                                <th>出版社</th>
                                <th>在庫</th>
                                <th>価格</th>
                                <th>登録内容変更</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->genre == 1) 単行本
                                        @elseif ($item->genre == 2) 文庫
                                        @elseif ($item->genre == 3) 新書
                                        @elseif ($item->genre == 4) 全集･双書
                                        @elseif ($item->genre == 5) コミック
                                        @elseif ($item->genre == 6) 事･辞典
                                        @elseif ($item->genre == 7) 図鑑
                                        @elseif ($item->genre == 8) 絵本
                                        @elseif ($item->genre == 9) 磁性媒体
                                        @elseif ($item->genre == 10) 雑誌･その他
                                        @endif
                                    </td>
                                    <td>{{ date('Y年m月d日', strtotime($item->release_date . '')) }}</td>
                                    <td>{{ date('Y年n月j日', $item->timestamp) }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ $item->publisher }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td><a href="/items/edit/{{$item->id}}">更新・削除</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4">{{$items->links()}}</div>
@stop

@section('css')
@stop

@section('js')
@stop
