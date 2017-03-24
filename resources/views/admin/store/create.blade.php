@extends('partials.admin_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>店舗の登録</h2>
  </div>
  <p class="pull-right"><a href="./">一覧に戻る</a></p>
  <div class="panel-body">
    {!! Form::open(['route' => ['store.store']]) !!}
      <div class="form-group @if(!empty($errors->first('kananame'))) has-error @endif">
        <p>店舗名(カタカナ)</p>
        {!! Form::input('text', 'kananame', null, ['class' => 'form-control', 'placeholder' => '例：◯△カメラシンジュクテン']) !!}
        <span class="help-block">{{$errors->first('name')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('name'))) has-error @endif">
        {!! Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => '例：◯△カメラ新宿店']) !!}
        <span class="help-block">{{$errors->first('name')}}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">追加</button>
    {!! Form::close() !!}
  </div>
</div>
@endsection
