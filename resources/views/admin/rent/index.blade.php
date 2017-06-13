@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">貸出物一覧</h1>
  {!! Form::open(['route' => 'admin.rent.index', 'method' => 'GET']) !!}
  <div class="btn-wrapper">
    <a class="btn btn-success" href="{{ route('admin.rent.create') }}">貸出物の登録</a>
    <a class="btn" href="#openModal">貸出物の検索</a>
  </div>
<!-- admin.user.index写し -->
  <div id="openModal" class="modalDialog">
    <div><a href="#close" class="close" title="Close">X</a>
      <table class="search-table">
        <thead class="search-thead">
        </thead>
        <div class="modal-header">貸出物の検索</div>
        <tbody class="search-tbody">
          <tr>
            <td class="search-td">
              <label>
                名称
              </label>
            </td>
            <td class="search-td">
              {!! Form::input('text', 'name', null, ['class' => 'form-control']) !!}
            </td>
            <td class="search-td">
              <label>
                種類
              </label>
            </td>
            <td class="search-td">
              {!! Form::select('item_category_id', [null => '種類選択'] + array_pluck($categories, 'category', 'id'), null, ['class' => 'form-control', 'id' => 'item_category_id']) !!}
            </td>
          </tr>
        </tbody>
        <tfoot class="search-tfoot">
          <tr class="search-tr">
            <td colspan="5" class="search-td">
              <div class="bottom-btn-wrapper">
                {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success']) !!}
              </div>
            </td>
          </tr>
        </tfoot>
      </table>
      {!! Form::close() !!}
    </div>
  </div>

  <div class="content-wrapper">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>名称</th>
          <th>種類</th>
        </tr>
      </thead>
      <tbody>
      @foreach($items as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ $item->category->category }}</td>
          <td><a class="btn btn-success" href="{{ route('admin.rent.show', $item->id) }}">詳細</a></td>
          <td>
            {!! Form::open(["route" => ['admin.rent.destroy', $item->id], 'method' => 'DELETE']) !!}
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