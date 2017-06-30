@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">入力の確認</h1>
  {{ Form::open(['route' => 'admin.item_category.updateCategory', 'method' => 'PUT']) }}
    <div class="content">
      <ul>
        <li>
          <div class="form-group">
            <h4>{{ Form::label('category', '種類') }}</h4>
            {{ $inputs['category'] }}
            {{ Form::hidden('id', $inputs['id']) }}
            {{ Form::hidden('category', $inputs['category']) }}
          </div>
        </li>
      </ul>

      <div class="bottom-btn-wrapper">
        <button type="submit" class="btn">更新</button>
        <a href="{{ route('admin.item_category.edit', $inputs) }}" class="bottom-btn">戻る</a>
      </div>

    </div>
  {{ Form::close() }}

@endsection