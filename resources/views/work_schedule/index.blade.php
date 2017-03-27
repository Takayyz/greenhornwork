@extends('layouts.app')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>勤務表一覧</h2>
  </div>
  <div class="panel-body">
    <p class="pull-right"><a class="btn btn-success" href="{{ url('schedule/create') }}">作成</a></p>
    <table class="table table-hover todo-table">
      <thead>
      <tr>
        <th></th>
      </tr>
      </thead>
      <tbody>
        @foreach($schedules as $schedule)
        <tr>
          <td>
            <a href="{{ $schedule->file_path . $schedule->file_name }}" target="_blank" >
              {{ $schedule->year }}年
              {{ $schedule->month }}月
              勤務表
            </a>
          </td>
          <td></td>
          <td>
            {!! Form::open(['route' => ['schedule.destroy', $schedule->id], 'method' => 'DELETE']) !!}
              <button class="btn btn-danger" type="submit">削除</button>
            {!! Form::close() !!}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
