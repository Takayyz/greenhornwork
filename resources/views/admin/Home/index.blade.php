@extends('partials.outline')

@section('outline')

  <body>

    <ul class="home-btn-wrapper">
      <li>
        <a href="{{ route('admin.schedule.index') }}" class="admin__btn schedule__btn__position">
          <i class="fa fa-briefcase fa-2x mt70"></i>
          <p>勤退</p>
        </a>
      </li>

      <li>
        <a href="{{ route('admin.report.index') }}" class="admin__btn dailyreport__btn__position">
        	<i class="fa fa-file-text-o fa-2x mt70"></i>
          <p>日報</p>
        </a>       
      </li>

      <li>
        <a href="{{ route('admin.store.index') }}" class="admin__btn store__btn__position">
        	<i class="fa fa-home mt70 fa-2x"></i>
          <p>店舗</p>
        </a>
      </li>

      <li>
        <a href="{{ route('admin.user.index') }}" class="admin__btn user__btn__position">
        	<i class="fa fa-user mt70 fa-2x"></i>
          <p>ユーザー</p>
        </a>
      </li>

      <li>
        <a href="{{ route('admin.adminuser.index') }}" class="admin__btn adminuser__btn__position">
          <i class="fa fa-cog mt70 fa-2x"></i>
          <p>管理者</p>
        </a>
      </li>
    </ul>

  </body>

@endsection
