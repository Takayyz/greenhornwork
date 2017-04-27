@extends('partials.outline')

@section('outline')
<body>
<div class="container">
  <div class="row container__inner">
      <div class="col-md-3 col-md-offset-2 col-xs-8 col-xs-offset-2">
        <a href="{{ route('schedule.index') }}" class="btn btn-work__schedules user__btn"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;&nbsp;勤退</a>
      </div>
      <div class=" col-md-3 col-md-offset-2 col-xs-8 col-xs-offset-2">
        <a href="{{ route('report.index') }}" class="btn btn__daily__reports user__btn"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;日報</a>
      </div>
  </div>
</div>
</body>

@endsection
