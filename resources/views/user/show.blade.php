@extends('layout.main')

@Section('tittle')
    <title> SISDA | Dashboard Users </title>

@Section('container')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    {{-- Profile --}}
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img " width="200" 
                                    src="{{ asset('storage/images/LOGO_SISDA.png') }}" alt="LOGO_SISDA.png">
                            </div>

                            <h3 class="profile-username text-center">{{ $users->name }}</h3>

                            <p class="text-muted text-center">{{ $users->username }}</p>
                        </div>
                    </div>
                    {{-- End Profile --}}

                    {{-- About Me --}}
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            {{-- <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong> --}}
                            {{-- <p class="text-muted"> {{ $users->address }} </p> --}}
                            <hr>
                            <strong><i class="fa fa-envelope-square mr-1"></i> Email</strong>
                            <p class="text-muted">{{ $users->email }}</p>
                            <hr>
                            {{-- <strong><i class="fa fa-mobile-phone mr-1"></i> Phone</strong> --}}
                            {{-- <p class="text-muted">{{ $users->phone }}</p> --}}
                            <hr>
                        </div>
                    </div>
                    {{-- End About Me --}}

                </div>
                {{-- Log Peminjaman --}}
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <h1> Log Perjalanan Dinas</h1>
                                    <div class="table-responsive-sm">
                                        <div>
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Keperluan</th>
                                                        <th scope="col">Berangkat Dari </th>
                                                        <th scope="col">Tujuan </th>
                                                        <th scope="col">Tgl Berangkat</th>
                                                        <th scope="col">Tgl Kembali</th>
                                                        {{-- <th scope="col">Actual Return Date</th> --}}
                                                        {{-- @can('SuperAdmin')
                                                            <th scope="col">Action</th>
                                                        @endcan --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($logs as $log)
                                                        <tr class="{{ $log->end_date < $date_now ? 'bg-danger' : '' }}">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $log->title }}</td>
                                                            <td>{{ $log->asal}}</td>
                                                            <td>{{ $log->tujuan }}</td>
                                                            <td>{{ $log->start_date }}</td>
                                                            <td>{{ $log->end_date }}</td>
                                                            {{-- <td>{{ $log->actual_return_date }}</td> --}}
                                                            <td>
                                                                {{-- @can('SuperAdmin')
                                                                    <a href="/rent-item/{{ $log->id }}" class="badge bg-warning border-0 d-inline"><span
                                                                            data-feather="eye"></span></a>
                                        
                                                                    <a href="/rent-item/{{ $log->id }}/edit" class="badge bg-warning border-0 d-inline"><span
                                                                            data-feather="edit"></span></a>
                                                                    <form action="/rent-item/{{ $log->id }}" class="d-inline" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="badge bg-danger border-0"
                                                                            onclick="return confirm('Yakin Ingin Menghapus Data? {{ $log->nama }}')"><span
                                                                                data-feather="file-minus"></span></button>
                                                                    </form>
                                                                @endcan --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        {{ $logs->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Log Peminjaman --}}
            </div>
        </div>
    </section>

@endsection
