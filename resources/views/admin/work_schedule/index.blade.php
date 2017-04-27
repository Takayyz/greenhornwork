@extends('partials.admin_nav')

@section('content')

    <h2 class="page-header header-gradient">勤務表一覧</h2>
  <div class="container">
  <!-- 検索メニュー -->
  <div class="panel-body">
    {!! Form::open(['route' => 'admin.schedule.index', 'method' => 'GET']) !!}
    <div class="form-group">
      <div class="col-xs-2">
        {!! Form::selectRange('year', date('Y')-10, date('Y')+10, old('year'), ['class' => 'form-control', 'placeholder'=>'年']) !!}
      </div>
      <div class="col-xs-2">
        {!! Form::selectRange('month', 1, 12, old('month'), ['class' => 'form-control', 'placeholder'=>'月']) !!}
      </div>
      <div class="col-xs-2">
        {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '苗字']) !!}
      </div>
      <div class="col-xs-2">
        {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名前']) !!}
      </div>
      {!! Form::input('submit', '', '検索', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
    {!! Form::close() !!}
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
            <a href="{{ url($schedule->file_path . $schedule->file_name) }}" target="_blank" >
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
 <div class="bottom-button-wrapper">
    <a href="{{ route('admin.') }}" class="bottom-button">ホームへ</a>
  </div>
</div>
@endsection
