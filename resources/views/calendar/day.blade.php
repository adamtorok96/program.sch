@php
$intertemporal_programs = \App\Models\Program::OnThisDay($day)->Intertemporal()->orderBy('from');
$onetime_programs = \App\Models\Program::OnThisDay($day)->OneTime()->orderby('from');

    if( Auth::check() && Auth::user()->filter ) {
        $intertemporal_programs->Filtered(Auth::user());
        $onetime_programs->Filtered(Auth::user());
    }

$intertemporal_programs = $intertemporal_programs->get();
$onetime_programs = $onetime_programs->get();
$isEmpty = $intertemporal_programs->count() == 0 && $onetime_programs->count() == 0;
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
            @each('calendar.program', $intertemporal_programs, 'program')
            @each('calendar.program', $onetime_programs, 'program')
        </table>
    </div>
</div>
@if( $day->dayOfWeek == Carbon\Carbon::SUNDAY )
    <div class="clearfix"></div>
@endif