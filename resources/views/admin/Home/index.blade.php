@extends('partials.admin_nav')

@section('content')
<div class="container">
  <div class="row container__inner">
      <div class="col-md-3 col-md-offset-2 col-xs-8 col-xs-offset-2">
        <a href="{{ route('admin.schedule.index') }}" class="btn btn-work__schedules admin__btn"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;&nbsp;勤退</a>
      </div>
      <div class=" col-md-3 col-md-offset-2 col-xs-8 col-xs-offset-2">
        <a href="{{ route('admin.report.index') }}" class="btn btn__daily__reports admin__btn"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;日報</a>
      </div>
  </div>
  <div class="row container__inner">
      <div class="col-md-3 col-md-offset-2 col-xs-8 col-xs-offset-2">
        <a href="{{ route('admin.store.index') }}" class="btn btn-store admin__btn"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;店舗</a>
      </div>
      <div class="col-md-3 col-md-offset-2 col-xs-8 col-xs-offset-2">
        <a href="{{ route('admin.user.index') }}" class="btn btn-user admin__btn"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;ユーザー</a>
      </div>
  </div>
  <div class="row container__inner">
    <div class="col-md-3 col-md-offset-2 col-xs-8 col-xs-offset-2">
      <a href="{{ route('admin.adminuser.index') }}" class="btn btn-admin admin__btn"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;管理者</a>
    </div>
  </div>
</div>
@endsection
