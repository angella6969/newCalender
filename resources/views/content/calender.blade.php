@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-10 mt-3">
            <div id='calendar'></div>
        </div>
    </div>

    <div id="modal-action" class="modal" tabindex="-1"></div>




    <!-- Elemen modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Detail Event</h5>
                </div>

                <style>
                    .table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .table td {
                        padding: 10px;
                        border: 1px solid #ddd;
                        word-wrap: break-word;
                        /* Atau overflow-wrap: break-word; */
                    }
                </style>
                <div class="modal-body">
                    <table class="table-responsive-sm">
                        <table class="table">
                            <tr>
                                <td>Keperluan</td>
                                
                                <td><span id="eventName"></span></td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                
                                <td><span id="eventCategory"></span></td>
                            </tr>
                            <tr>
                                <td>Berangkat</td>
                                
                                <td><span id="eventStarDate"></span></td>
                            </tr>
                            <tr>
                                <td>Kembali</td>
                                
                                <td><span id="eventEndDate"></span></td>
                            </tr>
                        </table>
                    </table>
                    {{-- <p><strong>Nama:</strong> <span id="eventName"></span></p>
                    <p><strong>Kategori:</strong> <span id="eventCategory"></span></p>
                    <p><strong>star:</strong> <span id="eventStarDate"></span></p>
                    <p><strong>end:</strong> <span id="eventEndDate"></span></p> --}}
                </div>
                <div>
                    <button class="success"> edit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if (Session::has('success'))
            iziToast.success({
                title: 'success',
                message: '{{ Session::get('success') }}',
                position: 'topRight',
            });
        @endif
    </script>
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
                },

                eventClick: function(info) {
                    // var eventId = info.event.id; // Mendapatkan ID event yang dipilih
                    // window.location.href = '/perjalanan/' + eventId + '/edit';

                    var eventId = info.event.id; // Mendapatkan ID event yang diklik

                    // Mengambil data event dari database menggunakan AJAX
                    $.ajax({
                        url: '/perjalanan/' + eventId, // Ganti dengan URL endpoint yang sesuai
                        method: 'GET',
                        success: function(response) {
                            var eventData = response
                                .event; // Mendapatkan data event dari response

                            // Mengisi konten modal dengan data dari event
                            document.getElementById('eventName').textContent = eventData
                                .title;
                            document.getElementById('eventCategory').textContent = eventData
                                .category;
                            document.getElementById('eventStarDate').textContent = eventData
                                .start_date;
                            document.getElementById('eventEndDate').textContent = eventData
                                .end_date;
                            // Menampilkan modal
                            $('#eventModal').modal('show');
                        },
                        error: function() {
                            console.log('Gagal mengambil data event dari database.');
                        }
                    });
                },

                eventDrop: function(info) {
                    const event = info.event
                    $.ajax({
                        url: `{{ url('events') }}/${event.id}`,
                        method: 'put',
                        data: {
                            id: event.id,
                            start_date: event.startStr,
                            end_date: event.end.toISOString().substring(0, 10),
                            title: event.title,
                            category: event.extendedProps.category
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            accept: 'application/json'
                        },
                        success: function(res) {
                            iziToast.success({
                                title: 'Success',
                                message: res.message,
                                position: 'topRight'
                            });
                        },
                        error: function(res) {
                            const message = res.responseJSON.message
                            info.revert()
                            iziToast.error({
                                title: 'Error',
                                message: message ?? 'Something wrong',
                                position: 'topRight'
                            });
                        }
                    })
                },
                eventResize: function(info) {
                    const {
                        event
                    } = info
                    $.ajax({
                        url: `{{ url('events') }}/${event.id}`,
                        method: 'put',
                        data: {
                            id: event.id,
                            start_date: event.startStr,
                            end_date: event.end.toISOString().substring(0, 10),
                            title: event.title,
                            category: event.extendedProps.category
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            accept: 'application/json'
                        },
                        success: function(res) {
                            iziToast.success({
                                title: 'Success',
                                message: res.message,
                                position: 'topRight'
                            });
                        },
                        error: function(res) {
                            const message = res.responseJSON.message
                            info.revert()
                            iziToast.error({
                                title: 'Error',
                                message: message ?? 'Something wrong',
                                position: 'topRight'
                            });
                        }
                    })
                }


            });
            calendar.render();
        });
    </script>
@endsection
