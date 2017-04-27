@extends('partials.outline')

@section('outline')
<body>
  <ul class="home-button-wrapper">
        <li class="floating-button">
        	<a href="{{ route('admin.schedule.index') }}" class="btn btn-schedule admin__btn block">
        		<i class="fa fa-briefcase mt60 fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;<p class="block">勤退
        		</p>
        	</a>
        </li>
        <li  class="floating-button">
        	<a href="{{ route('admin.report.index') }}" class="btn btn-dailyreport admin__btn block">
        		<i class="fa fa-file-text-o mt60  fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;<p class="block">日報
        			</p>
        	</a>
        </li>
        <li  class="floating-button">
        	<a href="{{ route('admin.store.index') }}" class="btn btn-store admin__btn block">
        		<i class="fa fa-home mt60 fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;<p class="block">店舗
        			</p>
        	</a>
        </li>
        <li  class="floating-button"><a href="{{ route('admin.user.index') }}" class="btn btn-user admin__btn block">
        		<i class="fa fa-user mt60 fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;<p class="block">ユーザー
        			</p>
        	</a>
        </li>
        <li  class="floating-button"><a href="{{ route('admin.adminuser.index') }}" class="btn btn-adminuser admin__btn block">
        		<i class="fa fa-cog mt60 fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;<p class="block">管理者
        			</p>
        	</a>
        </li>
  </ul>
  <div id="background-wrap">
    <div class="bubble x1"></div>
    <div class="bubble x2"></div>
    <div class="bubble x9"></div>
    <div class="bubble x10"></div>
	</div>
</body>
@endsection
