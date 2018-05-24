@extends('partials.admin_nav')

@section('content')
<h1 class="brand-header">質問詳細</h1>
<div class="container">
  {!! Form::open(['route' => 'admin.answer.confirm']) !!}
  {!! Form::hidden('question_id', $question->id) !!}
  <ul class="dailyreport-info-list">
    <li>
      <h3>タイトル</h3>
      <div>{{ $question->title }}</div>
      {!! Form::hidden('title', $question->title) !!}
    </li>
    <li>
      <h3>カテゴリ</h3>
      <div>{{ $question->category->name }}</div>
      {!! Form::hidden('category', $question->category->name) !!}
    </li>
    <li>
      <h3>本文</h3>
      <div>{!! $question->mark_content !!}</div>
      {!! Form::hidden('question_detail', $question->mark_content) !!}
    </li>
  </ul>
  <lavel>回答</lavel>
  <div class="form-group @if(!empty($errors->first('contents'))) has-error @endif">
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
  </div>
  <button type="submit" class="btn btn-success pull-right">確認</button>
  {!! Form::close() !!}
@endsection
