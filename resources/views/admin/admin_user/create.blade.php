    {{ Form::open(array('route' => 'adminuser.store')) }}
      
            <h2 class="page-header">アドミンユーザーの新規作成</h2>

            {!! Form::label('name', '名前'); !!}
            {!! Form::input('text', 'name', old("name"), array('required', 'class' => 'form-control','placeholder' => 'Gizumo')) !!}

            <p>

            <!-- {!! Form::label('sex', '性別'); !!}
            {!! Form::radio('sex', 'male', null, ['required', 'class' => 'form-control']) !!}
            男
            {!! Form::radio('sex', 'female', null, ['required', 'class' => 'form-control']) !!}
            女 -->

            <p>

            <!-- {!! Form::label('birth', '生年月日'); !!}
            {!! Form::input('birth',date('Y-M-D'), old("birth"), ['required', 'class' => 'form-control']) !!} -->

            <p>

            {!! Form::label('email', 'メールアドレス'); !!}
            {!! Form::input('text', 'email', old("email"), array('required', 'class' => 'form-control','placeholder' => 'greenhorn@gizumo.com')) !!}

            <p>

            {!! Form::label('tel', '電話番号'); !!}
            {!! Form::input('int', 'tel', old("tel"), array('required', 'class' => 'form-control','placeholder' => '03-3353-2720')) !!}

            <p>

        
        <button type="submit" class="btn btn-success pull-right">新規作成</button>

    {!! Form::close() !!}
