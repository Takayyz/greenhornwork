@extends('layouts.app')

@section('content')
<div class="container">

{{ Form::open(array('route'=> ['user.update', $user->id], 'method'=>'put')) }}
      
            <h2 class="page-header">ユーザーの編集</h2>

                {!! Form::label('last_name', '性'); !!}

            <div class="form-group @if(!empty($errors->first('last_name'))) has-error @endif">

                {!! Form::input('text', 'last_name', old("name", $user->last_name), array('class' => 'form-control','placeholder' => 'Giz')) !!}

            <span class="help-block">{{$errors->first('last_name')}}</span>

            </div>

                {!! Form::label('first_name', '名'); !!}

            <div class="form-group @if(!empty($errors->first('first_name'))) has-error @endif">

                {!! Form::input('text', 'first_name', old("name", $user->first_name), array('class' => 'form-control','placeholder' => 'mo')) !!}

            <span class="help-block">{{$errors->first('first_name')}}</span>

            </div>


            <div class="form-group @if(!empty($errors->first('sex'))) has-error @endif">

               {!! Form::label('sex', '男性'); !!}
                {!! Form::radio('text', 'sex', old("sex")) !!}

                {!! Form::label('sex', '女性'); !!}
                {!! Form::radio('text', 'sex', old("sex")) !!}

            <span class="help-block">{{$errors->first('sex')}}</span>

            </div>

             <div class="form-group @if(!empty($errors->first('email'))) has-error @endif">

                {!! Form::label('birthday', '生年月日'); !!}
                {!! Form::input('text', 'birthday', old("birthday"), array('class' => 'form-control','placeholder' => '1992年7月30日')) !!}

            <span class="help-block">{{$errors->first('birthday')}}</span>

            </div>

            <div class="form-group @if(!empty($errors->first('email'))) has-error @endif">


                {!! Form::label('email', 'メールアドレス'); !!}
                {!! Form::input('text', 'email', old("email", $user->email), array('class' => 'form-control','placeholder' => 'greenhorn@gizumo.com')) !!}

            <span class="help-block">{{$errors->first('email')}}</span>

            </div>

            <div class="form-group @if(!empty($errors->first('tel'))) has-error @endif">

                {!! Form::label('tel', '電話番号'); !!}
                {!! Form::input('int', 'tel', old("tel", $user->tel), array('class' => 'form-control','placeholder' => '03-3353-2720')) !!}

             <span class="help-block">{{$errors->first('tel')}}</span>

            </div>


                {!! Form::label('store_name', '店舗名'); !!}
                {!! Form::input('text', 'store_name', old("store_name", $user->store_id), array('class' => 'form-control')) !!}

        
        <button type="submit" class="btn btn-success pull-right">更新</button>
        <p class="pull-right"><a href="{{ url('admin/user') }}">一覧に戻る</a></p>

    {!! Form::close() !!}
    @endsection

