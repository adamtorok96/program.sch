@php
$programs = \App\Models\Program::OnThisDay($day)->orderBy('from');

    if( Auth::check() && Auth::user()->filter ) {
        $programs->Filtered(Auth::user());
    }

$programs = $programs->get();
$isEmpty = $programs->count() == 0;
@endphp
<div class="col-xs-12 col-sm-6 col-md-1-7 {{ $isEmpty ? 'hidden-xs' : '' }}">
    <div class="panel panel-{{ $day->isToday() ? 'info' : 'default' }}">
        <div class="panel-heading">
            <h3 class="panel-title text-center">
                {{ $day->format('m. d.') }}<br>
                @hunDays($day->dayOfWeek)
            </h3>
        </div>
        <table class="table table-hover">
            @each('calendar.program', $programs, 'program')
        </table>
    </div>
</div>
@if( $day->dayOfWeek == Carbon\Carbon::SUNDAY )
    <div class="clearfix"></div>
@endif