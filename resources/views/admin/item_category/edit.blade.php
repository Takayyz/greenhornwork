@extends('partials.admin_nav')

@section('content')

  <h1 class='brand-header'>貸出物種類の更新</h1>
  {!! Form::open(['route' => ['admin.item_category.update', $category->id], 'method' => 'PUT']) !!}
    <div class="content-wrapper">
      <ul>

        <li>
          <div class="form-group @if(!empty($errors->first('category'))) has-error @endif">
            <h4>{!! Form::label('category', '種類') !!}</h4>
            {!! Form::input('text', 'category', $category->category, ['class' => 'form-control']) !!}
            <span class="help-block">{{ $errors->first('category') }}</span>
          </div>
        </li>

      </ul>
    </div>

    <div class="bottom-btn-wrapper">
      <button class="btn btn-success" type="submit">更新</button>
    </div>
  {!! Form::close() !!}
    <div class="bottom-btn-wrapper pull-right">
      <a href="{{ route('admin.item_category.index') }}" class="btn">一覧へ</a>
    </div>
@endsection