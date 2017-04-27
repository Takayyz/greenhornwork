@extends('partials.admin_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>店舗の登録</h2>
  </div>
  <div class="panel-body">
    {!! Form::open(['route' => ['admin.store.store']]) !!}
      <div class="form-group @if(!empty($errors->first('name'))) has-error @endif">
        <p>店舗名</p>
        {!! Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => '例：◯△カメラ新宿店']) !!}
        <span class="help-block">{{$errors->first('name')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('kana_name'))) has-error @endif">
        <p>店舗名(カタカナ)</p>
        {!! Form::input('text', 'kana_name', null, ['class' => 'form-control', 'placeholder' => '例：◯△カメラシンジュクテン']) !!}
        <span class="help-block">{{$errors->first('kana_name')}}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">追加</button>
    {!! Form::close() !!}
  </div>
</div>
<div class="col-xs-12 col-md-offset-5">
    <a href="{{ route('admin.store.index') }}" class="btn btn-primary">店舗一覧に戻る</a>
</div>
@endsection
