@extends('layout.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Perjalanan</h1>
    </div>
    <div class="x_content" style="display: block;">
        <br>
        @php
            $date = '2023-05-05';
        @endphp
        <form id="my-form" class="form-label-left input_mask" method="post"
            action="{{ route('events.store1', ['date' => $date]) }}">
            @csrf
            <div class="row">
                <div class="col-md-12 col-sm-6 mb-3">
                    <label for="">Keperluan</label>
                    <input type="text" class="form-control -left @error('title') is-invalid @enderror " id="title"
                        name="title" placeholder="Judul" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalit-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Perjalanan Dari</label>
                    <input type="text" class="form-control -left @error('asal') is-invalid @enderror " id="asal"
                        name="asal" placeholder="Perjalanan Dari" value="{{ old('asal') }}" required>
                    @error('asal')
                        <div class="invalit-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Perjalanan Ke</label>
                    <input type="text" class="form-control @error('tujuan') is-invalid @enderror" id="tujuan"
                        name="tujuan" placeholder="Perjalanan Ke" value="{{ old('tujuan') }}" required>
                    @error('tujuan')
                        <div class="invalit-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Tanggal Berangkat</label>
                    <input class="date-picker form-control" name="start_date" placeholder="dd-mm-yyyy" type="text"
                        value="{{ Request::segment(2) }}" required="required" onfocus="this.type='date'"
                        onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'"
                        onmouseout="timeFunctionLong(this)">
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Tanggal Kembali</label>
                    <input class="date-picker form-control" name="end_date" placeholder="dd-mm-yyyy" type="text"
                        value="{{ old('end_date') }}" required="required" onfocus="this.type='date'"
                        onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'"
                        onmouseout="timeFunctionLong(this)">
                </div>
                <div class="col-md-12 col-sm-6 mb-3">
                    <label for="output" class="form-label">Target Output</label>
                    <textarea class="form-control" id="output" rows="1" name="output" required>{{ old('output') }}</textarea>
                </div>
                <div class="col-12">
                    <select id="normalize" name="category" class="mb-3">
                        <!-- Loop melalui opsi dari database -->
                        <option value="" selected>category</option>
                        <option value="info">OP Web</option>
                        <option value="btn-custom">Inventaris</option>
                        <option value="warning">Foto & Video</option>
                        <option value="success">Jaringan Komputer</option>
                    </select>

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
                    <a class="btn btn-custom" href="/events" role="button"
                        style="margin: 10px;   width: 150px;
                        height: 40px; ">Back</a>
                    <button class="btn btn-primary" style="margin: 10px;   width: 150px;
                    height: 40px;"
                        type="reset">Reset</button>
                    <button type="submit" class="btn btn-success"
                        style="margin: 10px;   width: 150px;
                    height: 40px;">Submit</button>
                </div>
            </div>
        </form>
    </div>
    {{-- </div> --}}
    <script>
        @if (Session::has('createError'))
            iziToast.warning({
                title: 'Peringatan',
                message: '{{ Session::get('createError') }}',
                position: 'topRight',
            });
        @endif
    </script>
    <script>
        @if (Session::has('fail'))
            iziToast.error({
                title: 'Peringatan',
                message: '{{ Session::get('fail') }}',
                position: 'topRight',
            });
            @if (session('users'))
                <
                ul >
                    @foreach (session('users') as $user)
                        <
                        li > {{ $user->name }} < /li>
                    @endforeach <
                    /ul>
            @endif
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

    <script>
        const textarea = document.getElementById('output');
        const maxRows = 3; // Batas maksimum jumlah baris

        textarea.addEventListener('input', function() {
            adjustTextareaHeight(textarea);
        });

        function adjustTextareaHeight(element) {
            // Mengatur ketinggian textarea ke tinggi minimal
            element.style.height = 'auto';

            // Mengatur ketinggian textarea berdasarkan scrollHeight
            element.style.height = Math.min(element.scrollHeight, maxRows * element.scrollHeight) + 'px';
        }
    </script>
@endsection
