@extends('partials.user_nav')

@section('content')
  <h2 class="brand-header">質問する</h2>

  <div class="container">
    {!! Form::open(['route' => 'confirmcreate', 'method' => 'post']) !!}
      <h3>タイトル</h3>
        <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
          {!! Form::text('title', null, ['class' => 'form-control']) !!}
          <span class="help-block">{{$errors->first('title')}}</span>
        </div>
      <h3>カテゴリ</h3>
        <div class="form-group @if(!empty($errors->first('tag_category_id'))) has-error @endif">
          <select name='tag_category_id'　class = "form-control"　id =　"pref_id">
            <option value="">カテゴリ</option>
            @foreach($categories as $category)
            <option value= "{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
          <span class="help-block">{{$errors->first('tag_category_id')}}</span>
        </div>
      <h3>質問内容</h3>
        <div class="form-group @if(!empty($errors->first('content'))) has-error @endif">
          {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
          <span class="help-block">{{$errors->first('content')}}</span>
        </div>
        {!! Form::submit('確認', array('name' => 'create', 'class' => 'btn btn-success pull-right')) !!}
    {!! Form::close() !!}
  </div>

@endsection
