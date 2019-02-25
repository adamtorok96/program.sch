<tr data-toggle="tooltip" data-placement="bottom" data-html="true" title="{{ $program->summary }}@includeWhen($program->hasPoster(), 'calendar.poster-tooltip')">
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