@extends('partials.admin_nav')

@section('content')

  <h1 class='brand-header'>貸出物の更新</h1>
  {!! Form::open(['route' => ['admin.rent.update', $item->id], 'method' => 'PUT']) !!}
    <div class="content-wrapper">
      <ul>

        <li>
          <div class="form-group">
            <h4>{!! Form::label('name', '名称') !!}</h4>
            {!! Form::input('text', 'name', $item->name, ['class' => 'form-control-custom']) !!}
            <span class="help-block">{{ $errors->first('name') }}</span>
          </div>
        </li>

        <li>
          <div class="form-group">
            <h4>{!! Form::label('item_category_id', '種類') !!}</h4>
            <select name="item_category_id">
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $item->item_category_id === $category->id ? 'selected' : '' }}>{{ $category->category }}</option><!--admin.user.edit 写し-->
              @endforeach
            </select>
          </div>
        </li>

        <li>
          <div class="form-group">
            <h4>{!! Form::label('item_info', '概要・説明') !!}</h4>
            {!! Form::textarea('item_info', $item->item_info, ['maxlength' => '255']) !!}
            <span class="help-block">{{ $errors->first('item_info') }}</span>
          </div>
        </li>

      </ul>
    </div>

    <div class="bottom-btn-wrapper">
      <button class="btn btn-success" type="submit">更新</button>
    </div>
  {!! Form::close() !!}
    <div class="bottom-btn-wrapper pull-right">
      <a href="{{ route('admin.rent.show', $item->id) }}" class="btn">詳細に戻る</a>
      <a href="{{ route('admin.rent.index') }}" class="btn">一覧へ</a>
    </div>
@endsection