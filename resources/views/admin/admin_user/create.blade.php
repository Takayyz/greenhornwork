@extends('partials.admin_nav')

@section('content')
  <h2 class="page-header header-gradient">管理者ユーザーの作成</h2>
  {{ Form::open(['route' => 'admin.adminuser.store']) }}
  <div class="container">
  <ul class="user-info-list">
    <li>
    <h4>{!! Form::label('last_name', '苗字'); !!}</h4>
    <div class="form-group {{ $errors->has('last_name') ? 'has-error' :''}}">
      {!! Form::input('text', 'last_name', old("name"), array('class' => 'form-control-custom','placeholder' => '小松')) !!}
      <span class="help-block">{{$errors->first('last_name')}}</span>
    </div>
    </li>

    <li>
    <h4>{!! Form::label('first_name', '名前'); !!}</h4>
    <div class="form-group {{ $errors->has('first_name') ? 'has-error' :''}}">
      {!! Form::input('text', 'first_name', old("name"), array('class' => 'form-control-custom','placeholder' => '信之')) !!}
      <span class="help-block">{{$errors->first('first_name')}}</span>
    </div>
    </li>

    <li>
    <div class="form-group {{ $errors->has('sex') ? 'has-error' :''}}">
      {!! Form::label('sex', '男性'); !!}
      {!! Form::radio('sex', '男', old("sex")) !!}
      {!! Form::label('sex', '女性'); !!}
      {!! Form::radio('sex', '女', old("sex")) !!}
      <span class="help-block">{{$errors->first('sex')}}</span>
    </div>
    </li>

    <li>
    <div class="form-group {{ $errors->has('birthday') ? 'has-error' :''}}">
      <h4>{!! Form::label('birthday', '生年月日'); !!}</h4>
      {!! Form::input('date', 'birthday', old("birthday"), array('class' => 'form-control-custom','placeholder' => '1992年7月30日')) !!}</h4>
      <span class="help-block">{{$errors->first('birthday')}}</span>
    </div>
    </li>

    <li>   
    <div class="form-group {{ $errors->has('email') ? 'has-error' :''}}">
      <h4>{!! Form::label('email', 'メールアドレス'); !!}</h4>
      {!! Form::input('text', 'email', old("email"), array('class' => 'form-control-custom','placeholder' => 'greenhorn@gizumo.com')) !!}
      <span class="help-block">{{$errors->first('email')}}</span>
    </div>
    </li>

    <li>
    <div class="form-group {{ $errors->has('tel') ? 'has-error' :''}}">
      <h4>{!! Form::label('tel', '電話番号'); !!}</h4>
      {!! Form::input('int', 'tel', old("tel"), array('class' => 'form-control-custom','placeholder' => '0333532720')) !!}
      <span class="help-block">{{$errors->first('tel')}}</span>
    </div>
    </li>

    <li>
    <div class="form-group {{ $errors->has('hire_date') ? 'has-error' :''}}">
      <h4>{!! Form::label('hire_date', '入社日'); !!}</h4>
      {!! Form::input('date', 'hire_date', old("hire_date"), array('class' => 'form-control-custom')) !!}
      <span class="help-block">{{$errors->first('hire_date')}}</span>
    </div>
    </li>

    <li>
    <div class="form-group">
      <h4>{!! Form::label('privileges', '管理者権限'); !!}</h4>
      <select name="privileges">
        <option value="1">SuperAdmin</option>
        <option value="2">Admin</option>
      </select>
    </div>
    </li>
</ul>
        <div class="bottom-button-wrapper">
          <button type="submit" class="button">管理者ユーザー作成</button>
          <a href="{{ route('admin.user.index') }}" class="button">管理者ユーザー一覧画面へ</a>
        </div>
      </div>
  {!! Form::close() !!}
 </div>
@endsection
