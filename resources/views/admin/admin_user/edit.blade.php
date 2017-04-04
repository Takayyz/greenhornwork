@extends('partials.admin_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>管理者ユーザーの更新</h2>
  </div>
  <p class="pull-right"><a href="{{ route('admin.adminuser.index') }}">一覧に戻る</a></p>
  <div class="panel-body">
    {!! Form::open(['route' => ['admin.adminuser.update', $adminuser->id], 'method'=> 'PUT']) !!}
      {!! Form::hidden('id', $adminuser->id, ['class' => 'form-control']) !!}
      <div class="form-group {{ $errors->has('name')? 'has-error' : '' }}">
        <p>ユーザー名</p>
        {!! Form::input('text', 'name', $adminuser->name, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('name')}}</span>
      </div>
      <div class="form-group {{ $errors->has('last_name')? 'has-error' : '' }}">
        <p>性</p>
        {!! Form::input('text', 'last_name', $adminuser->info->last_name, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('last_name')}}</span>
      </div>
      <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
        <p>名</p>
        {!! Form::input('text', 'first_name', $adminuser->info->first_name, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('first_name')}}</span>
      </div>
      <div class="form-group {{ $errors->has('sex')? 'has-error' : '' }}">
        <p>性別</p>
        {!! Form::input('text', 'sex', $adminuser->info->sex, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('sex')}}</span>
      </div>
      <p>生年月日</p>
      <div class="container__box">
        <p class="container__box__txt">{{ date("Y/m/d", strtotime($adminuser->info->birthday)) }}</p>
      </div>
      <p>メールアドレス</p>
      <div class="container__box">
        <p class="container__box__txt">{{ $adminuser->info->email }}<span class="container__box__link"><a href="{{ route('admin.adminuser.mailedit', $adminuser->id) }}">メールアドレスの変更はこちら</a></span></p>
      </div>
      <div class="form-group {{ $errors->has('tel')? 'has-error' : '' }}">
        <p>電話番号</p>
        {!! Form::input('text', 'tel', $adminuser->info->tel, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('tel')}}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">更新</button>
    {!! Form::close() !!}
  </div>
</div>
@endsection
