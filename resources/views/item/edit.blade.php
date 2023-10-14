@extends('adminlte::page')

@section('title', '書籍編集')

@section('content_header')
    <h1>書籍編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" action="/items/add/upload" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image">
                    <button>アップロード</button>
                </form>
                


                <form method="POST" action="/items/edit/update/{{$item->id}}">
                    @csrf
                    <div class="card-body">
                        <label style="color:#FF0000;">必須入力 * </label>
                        <div class="form-group">
                            <label for="name">書籍名<span style="color:#FF0000;">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name',$item->name)}}" placeholder="名前">
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">ジャンル<span style="color:#FF0000;">*</span></label>
                                    <selected id="productonInputtype" name="genre">
                                        <select type="text" name="genre" id="productonInputtype" class="form-control col-5" required>
                                            <option selected>ジャンル選択</option>
                                            <option value="1" @if($item->genre==1) selected @endif>1.単行本</option>
                                            <option value="2" @if($item->genre==2) selected @endif>2.文庫</option>
                                            <option value="3" @if($item->genre==3) selected @endif>3.新書</option>
                                            <option value="4" @if($item->genre==4) selected @endif>4.全集･双書</option>
                                            <option value="5" @if($item->genre==5) selected @endif>5.コミック</option>
                                            <option value="6" @if($item->genre==6) selected @endif>6.事･辞典</option>
                                            <option value="7" @if($item->genre==7) selected @endif>7.図鑑</option>
                                            <option value="8" @if($item->genre==8) selected @endif>8.絵本</option>
                                            <option value="9" @if($item->genre==9) selected @endif>9.磁性媒体</option>
                                            <option value="10" @if($item->genre==10) selected @endif>10.雑誌･その他</option>
                                        </selected>
                                    </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="detail">発売日</label>
                                    <input type="text" class="form-control" id="release_date" name="release_date" value="{{old('name',$item->release_date)}}" placeholder="発売日">
                                </div>
                            </div>
                       </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="detail">著者<span style="color:#FF0000;">*</span></label>
                                    <input type="text" class="form-control" id="author" name="author" value="{{old('name',$item->author)}}" placeholder="著者名">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="detail">出版社</label>
                                    <input type="text" class="form-control" id="publisher" name="publisher" value="{{old('name',$item->publisher)}}" placeholder="出版社名">
                                </div>
                            </div>
                       </div>

                       <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="detail">在庫</label>
                                    <input type="text" class="form-control" id="stock" name="stock" value="{{old('name',$item->stock)}}" placeholder="在庫数">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="detail">価格</label>
                                    <input type="text" class="form-control" id="price" name="price" value="{{old('name',$item->price)}}" placeholder="価格（円）">
                                </div>
                            </div>
                       </div>

                        <div class="form-group">
                            <label for="InputDetail" class="form-label">詳細</label>
                            <td><textarea type="text" id="InputDetail" class="form-control" name="detail" rows="5" value="{{old('name',$item->detail)}}" placeholder="詳細説明"></textarea></td>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </form>

                <div class="card-footer">
                    <form action="/items/edit/delete/{{$item->id}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger" data-bs-dismiss="modal">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
