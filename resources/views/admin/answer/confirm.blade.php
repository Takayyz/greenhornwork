@extends('partials.admin_nav')

@section('content')
<h1 class="brand-header">確認画面</h1>
<div class="container">
  {!! Form::open(['route'  => 'admin.answer.store']) !!}
    {!! Form::hidden('question_id', $question['question_id']) !!}
      <ul class="dailyreport-info-list">
        <li>
          <h3>タイトル</h3>
            <div>{{ $question['title'] }}</div>
        </li>
        <li>
          <h3>カテゴリ</h3>
            <div>{{ $question['category'] }}</div>
        </li>
        <li>
          <h3>質問内容</h3>
            <div>{!! $question['question_detail'] !!}</div>
        </li>
        <li>
          <h3>回答内容</h3>
            <div>{!! $question['content'] !!}</div>
            {!! Form::hidden('content', $question['content']) !!}
        </li>
      </ul>
      <button type="submit" class="btn btn-success pull-right">送信</button>
  {!! Form::close() !!}
  @endsection
