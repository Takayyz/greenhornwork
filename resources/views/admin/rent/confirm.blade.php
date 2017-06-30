@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">入力の確認</h1>
  {{ Form::open(['route' => 'admin.rent.store', 'method' => 'POST']) }}
    <div class="content">

      <ul class="rental-item-show-list">
        <li>
          <div class="form-group">
            <h4>{{ Form::label('name', '名称') }}</h4>
            {{ $inputs['name'] }}
            {{ Form::hidden('name', $inputs['name']) }}
          </div>
        </li>

        <li>
          <div class="form-group">
            <h4>{{ Form::label('item_category_id', '種類') }}</h4>
            {{ $category['category'] }}
            {{ Form::hidden('item_category_id', $inputs['item_category_id']) }}
          </div>
        </li>

        <li>
          <div class="form-group">
            <h4>{{ Form::label('item_info', '概要・説明') }}</h4>
            {{ $inputs['item_info'] }}
            {{ Form::hidden('item_info', $inputs['item_info']) }}
          </div>
        </li>
      </ul>

      <div class="bottom-btn-wrapper">
        <button type="submit" class="btn" >追加</button>
        <a href="{{ route('admin.rent.create', $inputs) }}" class="bottom-btn">戻る</a>
      </div>

    </div>
  {{ Form::close() }}

@endsection