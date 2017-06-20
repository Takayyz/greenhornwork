@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">貸出物種類の登録</h1>
  <div class="btn-wrapper">
    <a href="{{ route('admin.item_category.index') }}" class="btn btn-success">貸出物種類一覧に戻る</a>
  </div>
  {{ Form::open(array('route' => 'admin.item_category.store')) }}
    <div class="content">
      <ul>
        <li>
          <div class="form-group @if(!empty($errors->first('category'))) has-error @endif">
            <h4>{{ Form::label('category', '種類') }}</h4>
            {{ Form::input('text', 'category', old("category"), array('class' => 'form-control')) }}
             <span class="help-block">{{ $errors->first('category') }}</span>
          </div>
        </li>

      </ul>

      <div class="bottom-btn-wrapper">
        <button type="submit" class="btn">追加</button>
        <a href="{{ route('admin.item_category.index') }}" class="bottom-btn">一覧へ</a>
      </div>

    </div>
  {{ Form::close() }}

@endsection