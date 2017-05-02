@extends('partials.admin_nav')

@section('content')
    <h2 class="page-header header-gradient">店舗情報の更新</h2>
  </div>
  <div class="container">
  <div class="panel-body">

    {!! Form::open(['route' => ['admin.store.update', $store->id], 'method'=> 'PUT']) !!}

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
      <button type="submit" class="btn btn-success pull-right">更新</button>
    {!! Form::close() !!}
  </div>
</div>
<div class="bottom-button-wrapper">
{!! Form::open(['route'=>['admin.store.destroy',$store->id],'method'=>'DELETE']) !!}
    <a href="{{ route('admin.store.index') }}" class="button">店舗一覧へ</a> 
    <button class="button-danger btn" type="submit">削除</button>
{!! Form::close() !!}
</div>
@endsection
