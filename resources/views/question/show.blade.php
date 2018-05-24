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
      {!! $questions->mark_content !!}
    </li>
    @foreach($answers as $answer)
      <li>
        <h3>回答</h3>
        {{ $answer->content }}
      </li>
    @endforeach    
  </ul>

  <a href="{{ route('question.index') }}" class="btn pull-left">戻る</a>
  @if($questions->user_id === $userId)
    {!! Form::open(['route' => ['question.destroy', $questions->id], 'method' => 'DELETE']) !!}
      <button type="submit" class="btn btn-danger pull-right">削除</button>
    {!! Form::close() !!}
  @endif
@endsection
