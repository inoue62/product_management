@extends('adminlte::page')

@section('title', '書籍一覧')

@section('content_header')
    <h1>書籍一覧</h1>
@stop

@section('content')
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
                                <th>価格</th>
                                <th>著者</th>
                                <th>出版社</th>
                                <th>在庫</th>
                                <th>詳細</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->genre }}</td>
                                    <td>{{ date('Y年m月d日', strtotime($item->release_date . '')) }}</td>
                                    <td>{{ date('Y年n月j日', $item->timestamp) }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ $item->publisher }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->detail }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
