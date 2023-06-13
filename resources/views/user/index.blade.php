@extends('layout.main')

@Section('tittle')
    <title> SISDA | dashboard Users </title>

@Section('container')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Halaman Pengguna</h1>
    </div>
    <div class="table-responsive col-lg-11">

        {{-- @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}

        <a href="/users/create" class="btn btn-primary mb-2"><span data-feather="user-plus"></span> Add New User</a>


        {{-- Table Users --}}
        <table class="table table-striped table-sm ms-4">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    {{-- <th scope="col">Status</th> --}}
                    {{-- <th scope="col">Role</th> --}}
                    {{-- @can('Admin') --}}
                    <th scope="col">Aksi</th>
                    {{-- @endcan --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->name }}</td>
                        <td>
                            <a href="/users/{{ $barang->id }}" class="badge bg-success border-0" style="margin: 10px;">
                                <i data-feather="eye"></i>
                            </a>
                            <a href="/users/{{ $barang->id }}/edit" class="badge bg-warning border-0"
                                style="margin: 10px;">
                                <i data-feather="user-check"></i>
                            </a>
                            <button type="button" class="btn btn-danger delete-event" data-event-id="{{ $barang->id }}"
                                style="margin: 10px;"><i data-feather="user-minus"></i></button>
                            {{-- <form action="/users/{{ $barang->id }}" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="badge bg-danger border-0" {{ $barang->role_id == 1 ? 'hidden' : '' }}
                                    onclick="return confirm('Yakin Ingin Menghapus Data? {{ $barang->nama }}')">
                                    <i data-feather="user-minus"></i>
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {{-- End Table Users --}}
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
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

    {{ $users->links() }}


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
        // Mengambil semua elemen dengan class 'delete-event'
        var deleteButtons = document.getElementsByClassName('delete-event');

        // Loop melalui setiap tombol delete dan tambahkan event listener
        for (var i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', function() {
                var eventId = this.getAttribute('data-event-id');

                // Menampilkan modal konfirmasi
                $('#confirmDeleteModal').modal('show');

                document.getElementById('confirmDeleteButton').addEventListener('click', function() {
                    // Mengirim permintaan delete ke server menggunakan AJAX
                    $.ajax({
                        url: '/users/' + eventId,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
            });
        }
    </script>
@endsection
