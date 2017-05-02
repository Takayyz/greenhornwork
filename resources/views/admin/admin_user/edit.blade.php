<?php
//日報の日付をstringからdatetimeに変換
 $reporting_time = date("Y-m-d", strtotime($adminuser->info->birthday));
 ?>

@extends('partials.admin_nav')

@section('content')
 {!! Form::open(['route' => ['admin.adminuser.update', $adminuser->id], 'method'=> 'PUT']) !!}
 <h2 class="page-header header-gradient">管理者ユーザーの更新</h2>

<div class="container">
<ul class="user-info-list">

    <li>
      <!-- {!! Form::hidden('id', $adminuser->id, ['class' => 'form-control-custom']) !!} -->
      <h4>{!! Form::label('name', 'ユーザー名'); !!}</h4>
      <div class="form-group {{ $errors->has('name')? 'has-error' : '' }}">
        {!! Form::input('text', 'name', $adminuser->name, ['class' => 'form-control-custom']) !!}
        <span class="help-block">{{$errors->first('name')}}</span>
      </div>
    </li>

    <li>
      <div class="form-group {{ $errors->has('last_name')? 'has-error' : '' }}">
        <h4>{!! Form::label('name', '苗字'); !!}</h4>
        {!! Form::input('text', 'last_name', $adminuser->info->last_name, ['class' => 'form-control-custom']) !!}
        <span class="help-block">{{$errors->first('last_name')}}</span>
      </div>
    </li>

    <li>
      <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
        <h4>{!! Form::label('name', '名前'); !!}</h4>
        {!! Form::input('text', 'first_name', $adminuser->info->first_name, ['class' => 'form-control-custom']) !!}
        <span class="help-block">{{$errors->first('first_name')}}</span>
      </div>
    </li>

    <li>
      <div class="form-group {{ $errors->has('sex')? 'has-error' : '' }}">
        {!! Form::label('sex', '男性'); !!}
        {!! Form::radio('sex', '男', old("male", $adminuser->info->sex)) !!}
        {!! Form::label('sex', '女性'); !!}
        {!! Form::radio('sex', '女', old("female", $adminuser->info->sex)) !!}
        <span class="help-block">{{$errors->first('sex')}}</span>
    </li>

    <li>
      <div class="form-group {{ $errors->has('birthday')? 'has-error' : '' }}">
        <h4>{!! Form::label('name', '生年月日'); !!}</h4>
        {!! Form::input('date', 'birthday', $reporting_time, ['class' => 'form-control-custom']) !!}
        <span class="help-block">{{$errors->first('sex')}}</span>
      </div>
    </li>


    <li>
      <div class="form-group {{ $errors->has('email') ? 'has-error' :''}}">
          <h4>{!! Form::label('email', 'メールアドレス'); !!}</h4>
          {!! Form::input('text', 'email', old("email", $adminuser->info->email), array('class' => 'form-control-custom','placeholder' => 'greenhorn@gizumo.com')) !!}
          <span class="help-block">{{$errors->first('email')}}</span>
      </div>
    </li>


      <li>
      <div class="form-group {{ $errors->has('tel')? 'has-error' : '' }}">
        <h4>{!! Form::label('name', '電話番号'); !!}</h4>
        {!! Form::input('text', 'tel', $adminuser->info->tel, ['class' => 'form-control-custom']) !!}
        <span class="help-block">{{$errors->first('tel')}}</span>
      </div>
    </li>
</ul>
      <div class="button-wrapper">
      <a href="{{ route('admin.adminuser.index') }}" class="button">管理者ユーザー一覧画面へ</a> 
      <button type="submit" class="button">更新</button>
      </div> 

    {!! Form::close() !!}
  </div>
</div>
@endsection
