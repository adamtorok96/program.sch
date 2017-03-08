BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//ZContent.net//Zap Calendar 1.0//EN
CALSCALE:GREGORIAN
METHOD:PUBLISH
@each('calendar.ical.event', App\Models\Program::all(), 'program')
END:VCALENDAR