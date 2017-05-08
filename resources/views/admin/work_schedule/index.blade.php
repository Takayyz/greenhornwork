@extends('partials.admin_nav')

@section('content')

    <h2 class="page-header header-gradient">勤務表一覧</h2>

<div class="search-box">
  <div class="inner-box">
    
      <div class="button-wrapper">
      <a class="button delete-margin" href="#openModal">勤務表を検索</a>  
      </div>

    <div id="openModal" class="modalDialog">
  <div>
    {!! Form::open(['route' => 'admin.schedule.index', 'method' => 'GET']) !!}
  <a href="#close" title="Close" class="close">X</a>
    <table class="search-table">
      <thead class="search-thead">
      </thead>
      <div class="modal-header">勤務表を検索</div>
      <tbody class="search-tbody">
      <tr>
          <td class="search-td">
          <label>
              年月
          </label>
          </td>
      <td class="sea0rch-td">
        {!! Form::selectRange('year', date('Y')-10, date('Y')+10, old('year'), ['class' => 'form-control', 'placeholder'=>'年']) !!}
      </td>
      <td class="search-td">
        {!! Form::selectRange('month', 1, 12, old('month'), ['class' => 'form-control', 'placeholder'=>'月']) !!}
      </td>
      </tr>
      <td class="search-td">
          <label>
              氏名
          </label>
          </td>
      <td class="search-td">
        {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '苗字']) !!}
       </td>
      <td class="search-td">
        {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名前']) !!}
       </td>
       </tbody>
       <tfoot class="search-tfoot">
        <tr class="search-tr">
          <td colspan="5" class="search-td">
          <div class="bottom-button-wrapper">
      {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success btn-sm']) !!}
    </div>
    </td>
        </tr>
      </tfoot>
    </table>
    {!! Form::close() !!}
  </div>
  </div>
  </div>
<div class="content-wrapper text-align">
  <table class="table table-hover todo-table">
    <thead>   
      <tr>
      　 <th>氏名</th>
        <th>勤務表</th>
        <th>店舗名</th>
      </tr>
      </thead>
      <tbody>
        @foreach($schedules as $schedule)
        <tr>
          <td>{{ $schedule->user->info->last_name }} {{ $schedule->user->info->first_name }}</td>
          <td>
            <a href="{{ url($schedule->file_path . $schedule->file_name) }}" target="_blank" >
              {{ $schedule->year }}年
              {{ $schedule->month }}月
              勤務表
            </a>
          </td>
          <td>{{ $schedule->user->info->store->name }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
 <div class="bottom-button-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-button">ホームへ</a>
  </div>
</div>
@endsection
