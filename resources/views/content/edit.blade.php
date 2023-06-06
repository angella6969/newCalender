@extends('layout.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Perjalanan</h1>
    </div>
    <div class="x_content" style="display: block;">

        <form id="my-form" class="form-label-left input_mask" method="post" action="{{ $event->id }}">
            @csrf
            <div class="row">
                <div class="col-md-12 col-sm-6 mb-3">
                    <label for="">Keperluan</label>
                    <input type="text" class="form-control -left" name="title" placeholder="Judul"
                        value="{{ $event->title }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Perjalanan Dari</label>
                    <input type="text" class="form-control -left" name="asal" placeholder="Perjalanan Dari"
                        value="{{ $event->asal }}">
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Perjalanan Ke</label>
                    <input type="text" class="form-control" name="tujuan" placeholder="Perjalanan Ke"
                        value="{{ $event->tujuan }}">
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Tanggal Berangkat</label>
                    <input class="date-picker form-control" name="start_date" placeholder="dd-mm-yyyy" type="text"
                        value=" {{ $event->start_date }}" required="required" onfocus="this.type='date'"
                        onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'"
                        onmouseout="timeFunctionLong(this)">
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Tanggal Kembali</label>
                    <input class="date-picker form-control" name="end_date" placeholder="dd-mm-yyyy" type="text"
                        value=" {{ $event->end_date }}" required="required" onfocus="this.type='date'"
                        onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'"
                        onmouseout="timeFunctionLong(this)">
                </div>
                <div class="col-12 mb-3">
                    <select id="normalize" name="category" class="mb-3">
                        @if ($event->category == 'success')
                            <option value="{{ $event->category }}" selected>
                                Jaringan Komputer
                            </option>
                        @elseif($event->category == 'info')
                            <option value="{{ $event->category }}" selected>
                                OP Web Side
                            </option>
                        @elseif($event->category == 'warning')
                            <option value="{{ $event->category }}" selected>
                                Foto & Vidio
                            </option>
                        @elseif($event->category == 'danger')
                            <option value="{{ $event->category }}" selected>
                                Inventaris
                            </option>
                        @endif


                        <option value="success">Jaringan Komputer</option>
                        <option value="info">OP Web Side</option>
                        <option value="warning">Foto & Vidio</option>
                        <option value="danger">Inventaris</option>
                    </select>
                    <table>
                        <thead>
                            <tr>
                                <td>No</td>
                                <td> </td>
                                <td>Personil Name</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userPerjalanan as $tool)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> </td>
                                    <td>
                                        {{ $tool->name }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <label for="">Edit Personil</label>
                    <select id="remove-button" name="selecttools[]" multiple class="mb-3">
                        <!-- Loop melalui opsi dari database -->
                        <option value="" selected>Personil</option>
                        @foreach ($users as $tool)
                            <option value="{{ $tool['id'] }}">{{ $tool['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" style="margin: 10px;">save</button>
                </div>
            </div>
        </form>
    </div>
    {{-- </div> --}}
    <script>
        @if (Session::has('loginError'))
            iziToast.warning({
                title: 'Error',
                message: '{{ Session::get('loginError') }}',
                position: 'topRight',
            });
        @endif
    </script>
    <script>
        @if (Session::has('fail'))
            iziToast.error({
                title: 'Error',
                message: '{{ Session::get('fail') }}',
                position: 'topRight',
            });
        @endif
    </script>

    <script>
        function resetSelect() {
            document.getElementById('remove-button').selectedIndex = -1;
        }
    </script>
    <script>
        function timeFunctionLong(input) {
            setTimeout(function() {
                input.type = 'text';
            }, 60000);
        }
    </script>
    <script>
        $("#remove-button").selectize({
            plugins: ["remove_button"],
            delimiter: ",",
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });
    </script>
    <script>
        $('#normalize').selectize({
            normalize: true
        });
    </script>
@endsection
