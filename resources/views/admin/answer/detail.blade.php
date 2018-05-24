@extends('partials.admin_nav')

@section('content')
<h1 class="brand-header">質問詳細</h1>
<div class="container">
  <ul class="dailyreport-info-list">
  @foreach($questions as $question)  
    <li>
      <h3>タイトル</h3>
      {{ $question->title }}
    </li>
    <li>
      <h3>カテゴリ</h3>
      {{ $question->category->name }}
    </li>
    <li>
      <h3>本文</h3>
      {!! $question->mark_content !!}
    </li>
  @endforeach
  @foreach($answers as $answer)
    <li>
    <h3>回答</h3>
    {{ $answer->content }}
    </li>
  @endforeach    
  </ul>
  @foreach($questions as $question)
    @if($question->has_answer === NULL)
      <a href="{{ route('admin.answer.index') }}" class="btn pull-left">戻る</a>
    @else
      <a href="{{ route('admin.answer.answered') }}" class="btn pull-left">戻る</a>      
    @endif
    @if($question->deleted_at === NULL)
      {!! Form::open(['route' => ['admin.answer.destroy', $question->id], 'method' => 'DELETE']) !!}
      <button type="submit" class="btn btn-danger pull-right">削除</button>
      {!! Form::close() !!}
    @endif
  @endforeach
@endsection
