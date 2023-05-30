@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12 mt-3">
            <div id='calendar'></div>
        </div>
    </div>


    <script>
        const modal = $('#modal-action')
        const csrfToken = $('meta[name=csrf_token]').attr('content')

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                events: `{{ route('events.list') }}`,
                editable: false,
                dateClick: function(info) {
                    window.location.href = '/create/' + info.dateStr;
                }
            });
            calendar.render();
        });
    </script>
@endsection
