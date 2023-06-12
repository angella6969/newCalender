@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-md-8 mt-3 mb-3">

            <div class="col-sm-12">
                <div id='calendar'></div>
            </div>
        </div>
        <div class="col-md-4 mt-3 mb-3">
            <div class="card h-100">
                <Label class="d-flex justify-content-center mt-3">Daftar Event SPPD</Label>
                <form action="/events">
                    <div class="row">
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="Search By Item Name..." name="search"
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit" id="basic-addon2">Search</button>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <table class="table table-striped table-sm table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Event</th>
                                <th scope="col">Berangkat</th>
                                <th scope="col">Kembali</th>
                                {{-- <th scope="col">Kode Inventaris</th> --}}
                                {{-- @can('SuperAdmin')
                                    <th scope="col">Action</th> 
                                @endcan --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event as $item)
                                <tr class="{{ $item->end_date < $date_now ? 'bg-danger' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->end_date }}</td>
                                    {{-- <td>{{$item->categoryCode }}</td> --}}
                                    {{-- <td> --}}

                                        {{-- <a href="#" class="badge bg-info"><span data-feather="eye"></span></a> --}}
                                        {{-- @can('SuperAdmin') --}}
                                        {{-- <form action="/perjalanan/{{ $item->id }}" class="d-inline" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="badge bg-danger border-0"
                                                    onclick="return confirm('Yakin Ingin Menghapus Data? {{ $item->title }}')"><i
                                                        data-feather="trash-2"></i></button>
                                            </form> --}}
                                        {{-- @endcan --}}
                                    {{-- </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $event->links() }}
                    </ul>
                </nav>

            </div>
        </div>

    </div>


    <!-- Elemen modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
        aria-hidden="true">
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
                            {{-- <tr>
                            <td>Kategori</td>
                            <td><span id="eventCategory"></span></td>
                        </tr> --}}
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
                    <button type="button" class="btn btn-danger" style="margin: 10px;" id="deleteEvent">Delete</button>
                    <button type="button" class="btn btn-success" style="margin: 10px;" id="editEvent">EDIT</button>
                </div>



                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                    aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Event</h5>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus event ini?
                            </div>
                            <div class="modal-footer d-flex justify-content-center mb-3">
                                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
                            </div>
                        </div>
                    </div>
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
        // const modal = $('#modal-action')
        const csrfToken = $('meta[name=csrf_token]').attr('content')

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: 'auto',
                locale: 'id',
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                events: `{{ route('events.list') }}`,
                editable: false,

                dateClick: function(info) {

                    window.location.href = '/create/' + info.dateStr;
                },

                eventClick: function(info) {

                    var eventId = info.event.id; // Mendapatkan ID event yang diklik

                    // Mengambil data event dari database menggunakan AJAX
                    $.ajax({
                        url: '/perjalanan/' + eventId,
                        method: 'GET',
                        success: function(response) {
                            var eventData = response.event;
                            var personilData = response.personil;

                            var personilTableBody = document.getElementById(
                                'personilTableBody');
                            personilTableBody.innerHTML = '';

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

                            // document.getElementById('eventCategory').textContent = eventData
                            //     .category;

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

                    document.getElementById('deleteEvent').addEventListener('click', function() {
                        // Menampilkan modal konfirmasi
                        $('#confirmDeleteModal').modal('show');
                    });

                    document.getElementById('confirmDeleteButton').addEventListener('click',
                        function() {

                            // Mengirim permintaan delete ke server menggunakan AJAX
                            $.ajax({
                                url: '/perjalanan/' + eventId,
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        console.log(response.message);

                                        // Menampilkan notifikasi iziToast
                                        iziToast.success({
                                            title: 'Sukses',
                                            message: response.message,
                                            position: 'topRight'
                                        });

                                        // Lakukan tindakan lain setelah berhasil menghapus event
                                        location.reload();
                                    } else {
                                        console.log('Gagal menghapus event');
                                    }
                                },
                                error: function() {
                                    console.log('Gagal menghapus event');
                                }
                            });

                            // Menutup modal konfirmasi setelah tombol "Hapus" ditekan
                            $('#confirmDeleteModal').modal('hide');
                        });


                    document.getElementById('editEvent').addEventListener('click', function() {
                        // Mengirim permintaan delete ke server menggunakan AJAX
                        window.location.href = '/edit/' + eventId;
                    });
                },
            });
            calendar.render();
        });
    </script>
@endsection
