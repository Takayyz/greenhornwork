@extends('partials.user_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>勤務表一覧</h2>
  </div>
  <div class="panel-body">
    <table class="table table-hover todo-table">
      <thead>
      <tr>
        <th>氏名</th>
        <th></th>
      </tr>
      </thead>
      <tbody>
        @foreach($schedules as $schedule)
        <tr>
          <td>{{ $schedule->user->info->last_name }} {{ $schedule->user->info->first_name }}</td>
          <td>
            <a href="{{ $schedule->file_path . $schedule->file_name }}" target="_blank" >
              {{ $schedule->year }}年
              {{ $schedule->month }}月
              勤務表
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
