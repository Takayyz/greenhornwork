@extends('partials.user_nav')

@section('content')

    <h2 class="page-header header-gradient">勤務表一覧</h2>
<div class="container">

  <!-- 検索メニュー -->
  <div class="panel-body">
    {!! Form::open(['route' => 'schedule.index', 'method' => 'GET']) !!}
      <div class="form-group">
        <div class="col-xs-2">
          {!! Form::selectRange('year', date('Y')-10, date('Y')+10, old('year'), ['class' => 'form-control', 'placeholder'=>'年']) !!}
        </div>
        <div class="col-xs-2">
          {!! Form::selectRange('month', 1, 12, old('month'), ['class' => 'form-control', 'placeholder'=>'月']) !!}
        </div>
        {!! Form::input('submit', '', '検索', ['class' => 'btn btn-primary btn-sm']) !!}
      </div>
    {!! Form::close() !!}
  </div>

  <div class="panel-body">
    <p class="pull-right"><a class="btn btn-success" href="{{ route('schedule.create') }}">作成</a></p>
    <table class="table table-hover todo-table">
      <thead>
      <tr>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      </thead>
      <tbody>
        @foreach($schedules as $schedule)
        <tr>
          <td>
            <a href="{{ url($schedule->file_path . $schedule->file_name) }}" target="_blank" >
              {{ $schedule->year }}年
              {{ $schedule->month }}月
              勤務表
            </a>
          </td>
          <td><a class="btn btn-primary" href="{{ route('schedule.edit', $schedule->id) }}">変更</a></td>
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
<div class="col-md-offset-5">
 <div class="bottom-button-wrapper">
    <a href="{{ route('admin.') }}" class="bottom-button">ホームへ</a>
  </div>
</div>
@endsection
