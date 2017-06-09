@extends('partials.admin_nav')

@section('content')

  <h1 class='brand-header'>貸出物の更新</h1>
  <div class="btn-wrapper">
    <a href="{{ route('admin.rent.show', $item->id) }}" class="btn">詳細に戻る</a>
    <a href="{{ route('admin.rent.index') }}" class="btn">一覧へ</a>
  </div>
  {!! Form::open(['route' => ['admin.rent.update', $item->id], 'method' => 'PUT']) !!}
    <div class="content-wrapper">
      <ul>

        <li>
          <div class="form-group">
            <h4>{!! Form::label('name', '名称') !!}</h4>
            {!! Form::input('text', 'name', $item->name, ['class' => 'form-control-custom']) !!}
          </div>
        </li>

        <li>
          <div class="form-group">
            <h4>{!! Form::label('item_category_id', '種類') !!}</h4>
            <select name="item_category_id">
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $item->item_category_id === $category->id ? 'selected' : '' }}>{{ $category->category }}</option>
              @endforeach
            </select>
          </div>
        </li>

        <li>
          <div class="form-group">
            <h4>{!! Form::label('item_info', '概要・説明') !!}</h4>
            {!! Form::textarea('item_info', $item->item_info, ['maxlength' => '255']) !!}
          </div>
        </li>

      </ul>
    </div>

    <div class="bottom-btn-wrapper">
      <button class="btn" type="submit">更新</button>
    </div>
  {!! Form::close() !!}

@endsection