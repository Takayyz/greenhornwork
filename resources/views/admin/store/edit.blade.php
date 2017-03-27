@extends('partials.admin_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>店舗の更新</h2>
  </div>
  <p class="pull-right"><a href="./">一覧に戻る</a></p>
  <div class="panel-body">
    {!! Form::open(['route' => ['store.update', $store->id], 'method'=> 'PUT']) !!}
      {!! Form::hidden('id', $store->id, ['class' => 'form-control']) !!}
      <div class="form-group {{ $errors->has('name')? 'has-error' : '' }}">
        <p>店舗名</p>
        {!! Form::input('text', 'name', $store->name, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('name')}}</span>
      </div>
      <div class="form-group {{ $errors->has('kana_name')? 'has-error' : '' }}">
        <p>店舗名(カタカナ)</p>
        {!! Form::input('text', 'kana_name', $store->kana_name, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('kana_name')}}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">追加</button>
    {!! Form::close() !!}
  </div>
</div>
@endsection
