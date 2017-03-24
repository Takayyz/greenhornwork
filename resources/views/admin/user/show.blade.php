{{ Form::open(array('route' => 'user.show')) }}
      
            <h2 class="page-header">ユーザーの編集</h2>

            {!! Form::label('last_name', '性'); !!}
            {!! Form::input('text', 'last_name', old("name"), array('required', 'class' => 'form-control','placeholder' => 'Giz')) !!}

            {!! Form::label('first_name', '名'); !!}
            {!! Form::input('text', 'first_name', old("name"), array('required', 'class' => 'form-control','placeholder' => 'mo')) !!}

            <p>

            {!! Form::label('sex', '性別'); !!}
            {!! Form::radio('sex', 'male', null, ['required', 'class' => 'form-control']) !!}
            男
            {!! Form::radio('sex', 'female', null, ['required', 'class' => 'form-control']) !!}
            女

            <p>

            {!! Form::label('birth', '生年月日'); !!}
            {!! Form::input('birth',date('Y-M-D'), old("birth"), ['required', 'class' => 'form-control']) !!}

            <p>

            {!! Form::label('email', 'メールアドレス'); !!}
            {!! Form::input('text', 'email', old("email"), array('required', 'class' => 'form-control','placeholder' => 'greenhorn@gizumo.com')) !!}

            <p>

            {!! Form::label('tel', '電話番号'); !!}
            {!! Form::input('int', 'tel', old("tel"), array('required', 'class' => 'form-control','placeholder' => '03-3353-2720')) !!}

            <p>

            {!! Form::label('store_name', '店舗名'); !!}
            {!! Form::input('text', 'store_name', old("store_name"), array('required', 'class' => 'form-control')) !!}

            <p>
        
        <button type="submit" class="btn btn-success pull-right">新規作成</button>

    {!! Form::close() !!}
