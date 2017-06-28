@extends('partials.user_nav')

@section('content')
<h1 class="brand-header">質問詳細</h1>
<div class="container">
  <ul class="dailyreport-info-list">
    <li>
      <h3>タイトル</h3>
      {{ $questions->title }}
    </li>
    <li>
      <h3>カテゴリ</h3>
      {{ $questions->category->name }}
    </li>
    <li>
      <h3>本文</h3>
      {{ $questions->content }}
    </li>
  </ul>
  <lavel>解答</lavel>
    <div class="form-group @if(!empty($errors->first('contents'))) has-error @endif">
      {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-success pull-right">確認</button>
@endsection
