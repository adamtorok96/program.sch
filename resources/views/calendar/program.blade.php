<tr data-toggle="tooltip" data-placement="top" title="{{ $program->summary }}">
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