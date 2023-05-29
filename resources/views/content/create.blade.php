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
        <form class="form-label-left input_mask" method="post" action="{{ route('events.store1', ['date' => $date]) }}">
            @csrf
            <div class="row">
                <div class="col-md-12 col-sm-6 mb-3">
                    <label for="">Keperluan</label>
                    <input type="text" class="form-control -left" name="keperluan" placeholder="Judul">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Perjalanan Dari</label>
                    <input type="text" class="form-control -left" name="asal" placeholder="Perjalanan Dari">
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Perjalanan Ke</label>
                    <input type="text" class="form-control" name="tujuan" placeholder="Perjalanan Ke">
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Tanggal Berangkat</label>
                    <input class="date-picker form-control" name="berangkat" placeholder="dd-mm-yyyy" type="text"
                        required="required" onfocus="this.type='date'" onmouseover="this.type='date'"
                        onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                </div>
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Tanggal Kembali</label>
                    <input class="date-picker form-control" name="kembali" placeholder="dd-mm-yyyy" type="text"
                        required="required" onfocus="this.type='date'" onmouseover="this.type='date'"
                        onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                </div>
                <div>
                    <select id="remove-button" name="select-tools" multiple class="mb-3 col-12">
                        <!-- Loop melalui opsi dari database -->
                        @foreach ($users as $tool)
                            <option value="{{ $tool['id'] }}">{{ $tool['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-md-9 col-sm-9  offset-md-3 ">
                    <button type="button" class="btn btn-primary">Cancel</button>
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
    {{-- </div> --}}
    <script>
        function timeFunctionLong(input) {
            setTimeout(function() {
                input.type = 'text';
            }, 60000);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.box').select2();
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('#select-tools').selectize({
                maxItems: null,
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                options: {!! json_encode($users) !!},
                create: false
            });
        });
    </script> --}}
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
@endsection
