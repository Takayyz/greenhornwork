@extends('partials.outline')

@section('outline')
<body>
<div class="container">
  <div class="row container__inner">
      <div class="col-md-3 col-md-offset-1 col-xs-8 col-xs-offset-2">
        <a href="{{ route('schedule.index') }}" class="user__btn"><i class="fa fa-briefcase mt60 fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;<p class="font-size">勤退</p></a>
      </div>
      <div class=" col-md-3 col-md-offset-1 col-xs-8 col-xs-offset-2">
        <a href="{{ route('report.index') }}" class="user__btn"><i class="fa fa-file-text-o mt60 fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;<p class="font-size">日報</p></a>
      </div>
  </div>
  </div>
  <div class="container">
    <div class="row container__inner__top">
  <div class=" col-md-3 col-md-offset-1 col-xs-8 col-xs-offset-2">
    <a href="{{ route('question.index') }}" class="user__btn"><i class="fa fa-comments-o mt60 fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;<p class="font-size">質問掲示板</p></a>
  </div>
</div>
</div>
</body>

@endsection
