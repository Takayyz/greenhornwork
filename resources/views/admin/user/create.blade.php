@extends('layouts.app')

@section('content')
<div class="container">
    {{ Form::open(array('route' => 'user.store')) }}
      
            <h2 class="page-header">ユーザーの新規作成</h2>

                {!! Form::label('last_name', '性'); !!}

            <div class="form-group @if(!empty($errors->first('last_name'))) has-error @endif">

                {!! Form::input('text', 'last_name', old("name"), array('class' => 'form-control','placeholder' => '小松')) !!}

                <span class="help-block">{{$errors->first('last_name')}}</span>

            </div>

            
                {!! Form::label('first_name', '名'); !!}

            <div class="form-group @if(!empty($errors->first('first_name'))) has-error @endif">

                {!! Form::input('text', 'first_name', old("name"), array('class' => 'form-control','placeholder' => '信之')) !!}

            <span class="help-block">{{$errors->first('first_name')}}</span>

            </div>

             <div class="form-group @if(!empty($errors->first('sex'))) has-error @endif">

                {!! Form::label('sex', '男性'); !!}
                {!! Form::radio('sex', '男', old("sex")) !!}

                {!! Form::label('sex', '女性'); !!}
                {!! Form::radio('sex', '女', old("sex")) !!}

            <span class="help-block">{{$errors->first('sex')}}</span>

            </div>

             <div class="form-group @if(!empty($errors->first('birthday'))) has-error @endif">

                {!! Form::label('birthday', '生年月日'); !!}
                {!! Form::input('text', 'birthday', old("birthday"), array('class' => 'form-control','placeholder' => '1992年7月30日')) !!}

            <span class="help-block">{{$errors->first('birthday')}}</span>

            </div>

            <div class="form-group @if(!empty($errors->first('email'))) has-error @endif">

                {!! Form::label('email', 'メールアドレス'); !!}
                {!! Form::input('text', 'email', old("email"), array('class' => 'form-control','placeholder' => 'greenhorn@gizumo.com')) !!}

            <span class="help-block">{{$errors->first('email')}}</span>

            </div>

            <div class="form-group @if(!empty($errors->first('tel'))) has-error @endif">

                {!! Form::label('tel', '電話番号'); !!}
                {!! Form::input('int', 'tel', old("tel"), array('class' => 'form-control','placeholder' => '03-3353-2720')) !!}

            <span class="help-block">{{$errors->first('tel')}}</span>

            </div>

             <div class="form-group @if(!empty($errors->first('hire_date'))) has-error @endif">

                {!! Form::label('hire_date', '入社日'); !!}
                {!! Form::input('date', 'hire_date', old("hire_date"), array('class' => 'form-control')) !!}

            <span class="help-block">{{$errors->first('hire_date')}}</span>

            </div>


             <div class="form-group @if(!empty($errors->first('store_id'))) has-error @endif">

                {!! Form::label('store_id', '店舗名'); !!}
                {!! Form::input('text', 'store_id', old("store_id"), array('class' => 'form-control')) !!}

            <span class="help-block">{{$errors->first('store_id')}}</span>

            </div>

        
        <button type="submit" class="btn btn-success pull-right">新規作成</button>
        <p class="pull-right">
            <a href="./">一覧に戻る</a>
        </p>

    {!! Form::close() !!}
@endsection
