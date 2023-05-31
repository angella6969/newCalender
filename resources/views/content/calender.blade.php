@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12 mt-3 mb-3">
            <div class="col-sm-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    {{-- <div id="modal-action" class="modal" tabindex="-1"></div> --}}




    <!-- Elemen modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Detail Perjalanan</h5>
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
                            <tr>
                                <td>Berangkat dari</td>
                                <td><span id="eventAsal"></span></td>
                            </tr>
                            <tr>
                                <td>Tujuan </td>
                                <td><span id="eventTujuan"></span></td>
                            </tr>
                        </table>
                    </table>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Personil Name</th>
                                <!-- Tambahkan kolom-kolom lainnya sesuai kebutuhan -->
                            </tr>
                        </thead>
                        <tbody id="personilTableBody">
                            <!-- Data personil akan ditampilkan di sini -->
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <button style="margin: 10px;" type="button" class="btn btn-danger">Hapus</button>
                    <button style="margin: 10px;" type="button" class="btn btn-warning">Edit</button>
                    <button style="margin: 10px;" type="button" class="btn btn-primary">Save</button>
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
                            var personilData = response.personil;

                            var personilTableBody = document.getElementById(
                                'personilTableBody');
                            personilTableBody.innerHTML =
                                ''; // Bersihkan konten tabel sebelum mengisi data

                            personilData.forEach(function(personil) {
                                var row = document.createElement('tr');

                                // var emailCell = document.createElement('td');
                                // emailCell.textContent = personil.email;
                                // row.appendChild(emailCell);

                                var nameCell = document.createElement('td');
                                nameCell.textContent = personil.name;
                                row.appendChild(nameCell);

                                // Tambahkan kolom-kolom lainnya sesuai kebutuhan

                                personilTableBody.appendChild(row);
                            });

                            // Mengisi konten modal dengan data dari event
                            document.getElementById('eventName').textContent = eventData
                                .title;
                            document.getElementById('eventCategory').textContent = eventData
                                .category;
                            document.getElementById('eventStarDate').textContent = eventData
                                .start_date;
                            document.getElementById('eventEndDate').textContent = eventData
                                .end_date;
                            document.getElementById('eventAsal').textContent = eventData
                                .asal;
                            document.getElementById('eventTujuan').textContent = eventData
                                .tujuan;
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
