@extends('partials.admin_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>勤務表一覧</h2>
  </div>
  <div class="panel-body">
    <table class="table table-hover todo-table">
      <thead>
      <tr>
        <th></th>
        <th>氏名</th>
        <th>店舗名</th>
      </tr>
      </thead>
      <tbody>
        @foreach($schedules as $schedule)
        <tr>
          <td>
            <a href="../{{ $schedule->file_path . $schedule->file_name }}" target="_blank" >
              {{ $schedule->year }}年
              {{ $schedule->month }}月
              勤務表
            </a>
          </td>
          <td>{{ $schedule->user->info->last_name }} {{ $schedule->user->info->first_name }}</td>
          <td>{{ $schedule->user->info->store->name }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
