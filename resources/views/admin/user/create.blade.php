@extends('partials.admin_nav')
 
@section('content')
<div class="container">
    {{ Form::open(array('route' => 'admin.user.store')) }}

            <h2 class="page-header">ユーザー作成</h2>

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

             <div class="form-group @if(!empty($errors->first('email'))) has-error @endif">

                {!! Form::label('hire_date', '入社日'); !!}
                {!! Form::input('text', 'hire_date', old("hire_date"), array('class' => 'form-control')) !!}

                <span class="help-block">{{$errors->first('email')}}</span>

            </div>

        
        <div class="col-xs-12 col-md-offset-5">
            <a href="{{ route('admin.user.index') }}" class="btn btn-primary">戻る</a> 
            <button type="submit" class="btn btn-success pull-right">作成</button>
        </div>

    {!! Form::close() !!}
</div>
@endsection
