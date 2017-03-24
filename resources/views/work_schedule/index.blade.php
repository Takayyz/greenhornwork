@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="page-header">勤怠一覧</h2>
  <p class="pull-right"><a class="btn btn-success" href="schedule/create">作成</a></p>
  <table class="table table-hover todo-table">
    <thead>
    <tr>
      <th>年月</th>
      <th>ファイル名</th>
    </tr>
    </thead>
    <tbody>
      @foreach($schedules as $schedule)
      <tr>
        <td>{{ date("Y年m月", strtotime($schedule->year_month)) }}</td>
        <td><a href="{{ $schedule->file_path }}">ファイル名</a></td>
        <td></td>
        <td>
          {!! Form::open(['url' => ['user/schedule', $schedule->id], 'method' => 'DELETE']) !!}
            <button class="btn btn-danger" type="submit">削除</button>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
