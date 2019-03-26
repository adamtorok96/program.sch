@inject('dayService', 'App\Services\CalendarDayService')
@php($dayService->setDay($day))

<div class="col-xs-12 col-sm-6 col-md-1-7 {{ !$dayService->hasProgram() ? 'hidden-xs' : '' }}">
    <div class="panel panel-{{ $day->isToday() ? 'info' : 'default' }}">
        <div class="panel-heading">
            <h3 class="panel-title text-center raleway">
                {{ $day->format('m. d.') }}<br>
                @hunDays($day->dayOfWeek)
            </h3>
        </div>
        <table class="table table-hover">
            @each('calendar.program', $dayService->getPrograms(), 'program')
        </table>
    </div>
</div>

@if( $day->dayOfWeek == Carbon\Carbon::SUNDAY )
    <div class="clearfix"></div>
@endif