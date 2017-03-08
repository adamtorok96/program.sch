BEGIN:VEVENT
SUMMARY:{{ str_replace("\n", "", $program->summary) }}
UID:{{ $program->uuid }}
SEQUENCE:{{ $program->sequence }}
STATUS:CONFIRMED
TRANSP:TRANSPARENT
DTSTART:{{ $program->from->format('Ymd\THis') }}
DTEND:{{ $program->to->format('Ymd\THis') }}
DTSTAMP:{{ $program->from->format('Ymd\THis\Z') }}
LOCATION:{{ $program->location }}
ORGANIZER:{{ isset($program->circle) ? $program->circle->name : 'Program.sch' }}
@if( isset($program->description) )
DESCRIPTION:{{ str_replace("\n", "", $program->description) }}
@endif
@if( isset($program->website) )
URL:{{ $program->website }}
@endif
END:VEVENT
{{--
http://www.kanzaki.com/docs/ical/
RRULE:FREQ=YEARLY;INTERVAL=1;BYMONTH=2;BYMONTHDAY=12
 CATEGORIES:U.S. Presidents,Civil War People
 --}}