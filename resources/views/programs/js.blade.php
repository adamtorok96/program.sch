@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $("#from").datetimepicker({
            formatTime: 'H:i',
            formatDate: 'Y. m. d.',
            lang: 'hu'
        }).change(function () {
            if( $("#to").val().length == 0 ) {
                var from = new Date($("#from").val());
                from.setHours(from.getHours() + 4);

                $("#to").datetimepicker('setOptions', {
                    value: from
                });
            }
        });

        $("#to").datetimepicker({
            formatTime: 'H:i',
            formatDate: 'Y. m. d.',
            lang: 'hu'
        });

        $("#location").autocomplete({
            source: [
                @foreach($locations as $location)'{{ $location->name }}'@if( !$loop->last ),@endif @endforeach
            ]
        });
    });
</script>
@endpush