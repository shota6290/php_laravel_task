@extends('layouts.profile')
@section('title','登録済みプロフィール一覧')

@section('content')
<div class="container">
    <div class="row">
        <h2>プロフィール一覧</h2>
    </div>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ action('Admin\ProfilesController@add') }}" role="button" class="btn btn-primary">プロフィールを新規作成しよう</a>
        </div>
        <div class="col-md-8">
            <form action="{{ action('Admin\ProfilesController@index') }}" method="get">
                <div class="form-group row">
                    <label class="col-md-2">タイトル</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                    </div>
                    <div class="col-md-2">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="検索">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="list-news col-md-12 mx-auto">
            <div class="row">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <tr width="10%">ID</tr>
                            <tr width="20%">名前</tr>
                            <tr width="10%">性別</tr>
                            <tr width="15%">趣味</tr>
                            <tr width="45%">自己紹介欄</tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $profile)
                        <tr>
                            <th>{{ $profile->id }}</th>
                            <td>{{ \Str::limit($profile->name, 10) }}</td>
                            <td>{{ \Str::limit($profile->gender, 10) }}</td>
                             <td>{{ \Str::limit($profile->hobby, 30) }}</td>
                             <td>{{ \Str::limit($profile->introduction, 100) }}</td>
                            <td>
                                <div>
                                    <a href="{{ action('Admin\ProfilesController@update', ['id' => $profile->id]) }}">編集</a>
                                </div>
                                <div>
                                    <a href="{{ action('Admin\ProfilesController@delete', ['id' => $profile->id]) }}">削除</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection