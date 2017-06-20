@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">貸出物種類一覧</h1>
  <div class="btn-wrapper">
    <a class="btn btn-success" href="{{ route('admin.item_category.create') }}">貸出物種類の登録</a>
    <a class="btn btn-success" href="{{ route('admin.rent.index') }}">貸出物一覧へ</a>
  </div>


  <div class="content-wrapper">
    <!-- <div class="has-error"><span class="help-block"></span></div> -->
    <table class="table table-hover">
      <thead>
        <tr>
          <th>種類</th>
        </tr>
      </thead>
      <tbody>
      @foreach($categories as $category)
        <tr>
          <td class="rental-item-list">{{ $category->category }}</td>
          <td>
            <a class="btn" href="{{ route('admin.item_category.edit', $category->id) }}">編集</a>
          </td>
          <td>
            {!! Form::open(["route" => ['admin.item_category.destroy', $category->id], 'method' => 'DELETE']) !!}
              <button class="btn-danger btn" type="submit">削除</button>
            {!! Form::close() !!}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-button">ホームへ</a>
  </div>
@endsection