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
                <input type="text" class="form-control -left" id="title" name="title" placeholder="Judul"
                    value="{{ old('title') }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 mb-3">
                <label for="">Perjalanan Dari</label>
                <input type="text" class="form-control -left" id="asal" name="asal" placeholder="Perjalanan Dari"
                    value="{{ old('asal') }}" required>
            </div>
            <div class="col-md-6 col-sm-6 mb-3">
                <label for="">Perjalanan Ke</label>
                <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Perjalanan Ke"
                    value="{{ old('tujuan') }}" required>
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
            <div class="col-12">
                <select id="normalize" name="category" class="mb-3">
                    <!-- Loop melalui opsi dari database -->
                    <option value="" selected>category</option>
                    <option value="success">Jaringan Komputer</option>
                    <option value="info">OP Web Side</option>
                    <option value="warning">Foto & Vidio</option>
                    <option value="danger">Inventaris</option>
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
                <button class="btn btn-primary" style="margin: 10px;" type="reset">Reset</button>
                <button type="submit" class="btn btn-success" style="margin: 10px;">Submit</button>
            </div>
        </div>
    </form>

</div>
{{-- </div> --}}
<script>
    @if (Session::has('createError'))
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
@endsection