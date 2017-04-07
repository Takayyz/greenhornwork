<?php
 $birthday = date("Y-m-d", strtotime($user->info->birthday));
 $hireDate = date("Y-m-d", strtotime($user->info->hire_date));
?>
@extends('partials.admin_nav')
@section('content')
<div class="container">
  <p class="pull-right"><a href="{{ route('admin.user.index') }}">一覧に戻る</a></p>
  {{ Form::open(array('route'=> ['admin.user.update', $user->id], 'method'=>'put')) }}
    <h2 class="page-header">ユーザーの編集</h2>
    {!! Form::label('name', 'ユーザー名'); !!}
    <div class="form-group {{ $errors->has('name') ? 'has-error' :''}}">
    {!! Form::input('text', 'name', old("name", $user->name), array('class' => 'form-control','placeholder' => 'Giztaro')) !!}
    <span class="help-block">{{$errors->first('name')}}</span>
    </div>
    {!! Form::label('last_name', '性'); !!}
    <div class="form-group {{ $errors->has('last_name') ? 'has-error' :''}}">
    {!! Form::input('text', 'last_name', old("name", $user->info->last_name), array('class' => 'form-control','placeholder' => 'Giz')) !!}
    <span class="help-block">{{$errors->first('last_name')}}</span>
    </div>
    {!! Form::label('first_name', '名'); !!}
    <div class="form-group {{ $errors->has('first_name') ? 'has-error' :''}}">
    {!! Form::input('text', 'first_name', old("name", $user->info->first_name), array('class' => 'form-control','placeholder' => 'mo')) !!}
    <span class="help-block">{{$errors->first('first_name')}}</span>
    </div>
    <div class="form-group {{ $errors->has('sex') ? 'has-error' :''}}">
    {!! Form::label('sex', '男性'); !!}
    {!! Form::radio('sex', '男', old("male", $user->info->sex)) !!}
    {!! Form::label('sex', '女性'); !!}
    {!! Form::radio('sex', '女', old("female", $user->info->sex)) !!}
    <span class="help-block">{{$errors->first('sex')}}</span>
    </div>
    <div class="form-group {{ $errors->has('birthday') ? 'has-error' :''}}">
    {!! Form::label('birthday', '生年月日'); !!}
    {!! Form::input('date', 'birthday', old("birthday", $birthday), array('class' => 'form-control','placeholder' => '1992年7月30日')) !!}
    <span class="help-block">{{$errors->first('birthday')}}</span>
    </div>
    <div class="form-group {{ $errors->has('email') ? 'has-error' :''}}">
    {!! Form::label('email', 'メールアドレス'); !!}
    {!! Form::input('text', 'email', old("email", $user->info->email), array('class' => 'form-control','placeholder' => 'greenhorn@gizumo.com')) !!}
    <span class="help-block">{{$errors->first('email')}}</span>
    </div>
    <div class="form-group {{ $errors->has('tel') ? 'has-error' :''}}">
    {!! Form::label('tel', '電話番号'); !!}
    {!! Form::input('int', 'tel', old("tel", $user->info->tel), array('class' => 'form-control','placeholder' => '03-3353-2720')) !!}
    <span class="help-block">{{$errors->first('tel')}}</span>
    </div>
    <div class="form-group {{ $errors->has('hire_date') ? 'has-error' :''}}">
    {!! Form::label('hire_date', '入社日'); !!}
    {!! Form::input('date','hire_date', old("hire_date", $hireDate), array('class' => 'form-control')) !!}
    <span class="help-block">{{$errors->first('email')}}</span>
    </div>
    {!! Form::label('store_name', '店舗名'); !!}
    <select name="store_id">
    @foreach($stores as $store)
      <option value="{{ $store->id }}" {{$store->id === $user->info->store_id ? 'selected':''}} >{{ $store->name }}</option> 
    @endforeach
    </select>
    <button type="submit" class="btn btn-success pull-right">更新</button>
  {!! Form::close() !!}
@endsection
