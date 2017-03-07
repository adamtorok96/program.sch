<div class="col-xs-12 col-sm-6 col-md-1-7">
    <div class="panel panel-{{ $day->isToday() ? 'info' : 'default' }}">
        <div class="panel-heading">
            <h3 class="panel-title text-center">
                {{ $day->format('m. d.') }}<br>
                {{ $day->format('l') }}
            </h3>
        </div>
        <table class="table table-hover">
            @foreach(\App\Models\Program::OnThisDay($day)->orderBy('from')->get() as $program)
                <tr>
                    <td>
                        <small>{{ $program->from->format('H:i') }}</small><br>
                        <b>
                            <a href="{{ route('programs.show', ['program' => $program]) }}">
                                {{ $program->name }}
                            </a>
                        </b>
                        <div class="text-right small">{{ $program->location }}</div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@if( $day->dayOfWeek == Carbon\Carbon::SUNDAY )
    <div class="clearfix"></div>
@endif