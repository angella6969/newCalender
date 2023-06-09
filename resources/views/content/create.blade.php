@extends('layout.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Rencana Perjalanan Perjalanan</h1>
    </div>
    <div class="x_content" style="display: block;">
        <br>
        @php
            $date = '2023-05-05';
        @endphp
        <form id="my-form" class="form-label-left input_mask" method="post" enctype="multipart/form-data"
            action="{{ route('events.store1', ['date' => $date]) }}">
            @csrf
            <div class="row">

                {{-- Field Keperluan --}}
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
            {{-- End Field Keperluan --}}

            {{-- Field Perjalanan Dari --}}
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
                {{-- End Field Perjalanan Dari --}}

                {{-- Field Perjalanan Ke --}}
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
                {{-- End Field Perjalanan Ke --}}

                {{-- Field Tanggal Berangkat --}}
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Tanggal Berangkat</label>
                    <input class="date-picker form-control" name="start_date" placeholder="dd-mm-yyyy" type="text"
                        value="{{ Request::segment(2) }}" required="required" onfocus="this.type='date'"
                        onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'"
                        onmouseout="timeFunctionLong(this)">
                </div>
                {{-- End Field Tanggal Berangkat --}}

                {{-- Field Tanggal Kembali --}}
                <div class="col-md-6 col-sm-6 mb-3">
                    <label for="">Tanggal Kembali</label>
                    <input class="date-picker form-control" name="end_date" placeholder="dd-mm-yyyy" type="text"
                        value="{{ old('end_date') }}" required="required" onfocus="this.type='date'"
                        onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'"
                        onmouseout="timeFunctionLong(this)">
                </div>
                {{-- End Field Tanggal Kembali --}}

                {{-- Field Target Output --}}
                <div class="col-md-12 col-sm-6 mb-3">
                    <label for="output" class="form-label">Target Output</label>
                    <textarea class="form-control" id="output" rows="1" name="output" required>{{ old('output') }}</textarea>
                </div>
                {{-- End Field Target Output --}}

                {{-- Field Foto --}}
                <div class="col-md-12 col-sm-6 mb-3">
                    <label for="images">Foto Dokumentasi</label>
                    <div>
                        <div id="imagePreviews" class="image-previews"></div>
                        <input type="file" class="form-control @error('images') is-invalid @enderror" id="images"
                            onchange="previewImages()" name="images[]" multiple>
                        <h6>Photo Max 1 MB</h6>
                    </div>

                    {{-- @if ($errors->has('images'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('images') }}</strong>
                        </span>
                    @endif --}}
                </div>
                {{-- End Field Foto --}}

                {{-- Field Select --}}
                <div class="col-12">
                    {{-- Field Categoty --}}
                    <select id="normalize" name="category" class="mb-3">
                        <!-- Loop melalui opsi dari database -->
                        <option value="" selected>category</option>
                        <option value="WEB">OP Web</option>
                        <option value="DAT">Inventaris</option>
                        <option value="PVS">Foto & Video</option>
                        <option value="INT">Jaringan Komputer</option>
                    </select>
                    {{-- End Field Category --}}

                    {{-- Field Anggota Perjalanan --}}
                    <select id="remove-button" name="selecttools[]" multiple class="mb-3">
                        <!-- Loop melalui opsi dari database -->
                        <option value="" selected>Personil</option>
                        @foreach ($users as $tool)
                            <option value="{{ $tool['id'] }}">{{ $tool['name'] }}</option>
                        @endforeach
                    </select>
                    {{-- End Field Perjalanan --}}
                </div>
                {{-- End Field Select --}}
            </div>

            {{-- Field Button --}}
            <div class="form-group row">
                <div class="d-flex justify-content-center">

                    {{-- Field Button Back --}}
                    <a class="btn btn-info" href="/events" role="button"
                        style="margin: 10px;   width: 150px;
                        height: 40px; ">Back</a>
                    {{-- End Field Button Back --}}

                    {{-- Field Button Reset --}}
                    <button class="btn btn-primary"
                        style="margin: 10px;   width: 150px;
                    height: 40px;"
                        type="reset">Reset</button>
                    {{-- End Field Button Reset --}}

                    {{-- Field Button Sumbit --}}
                    <button type="submit" class="btn btn-success"
                        style="margin: 10px;   width: 150px;
                    height: 40px;">Submit</button>
                    {{-- End Field Button Sumbit --}}

                </div>
            </div>
            {{-- End Field Button --}}

        </form>
    </div>
    {{-- </div> --}}
    <script>
        function previewImages() {
            var previewContainer = document.getElementById('imagePreviews');
            previewContainer.innerHTML = ''; // Menghapus pratinjau gambar sebelumnya

            var files = document.getElementById('images').files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = (function(file) {
                    return function(event) {
                        var img = document.createElement('img');
                        img.setAttribute('src', event.target.result);
                        img.setAttribute('class', 'img-fluid mb-3 col-sm-5 image-preview');

                        var closeButton = document.createElement('span');
                        closeButton.innerHTML = '&times;';
                        closeButton.setAttribute('class', 'close-button');
                        closeButton.addEventListener('click', function() {
                            var previewItem = this.parentNode;
                            previewItem.parentNode.removeChild(
                                previewItem); // Menghapus pratinjau gambar saat tombol close diklik

                            // Menghapus file yang sesuai dari daftar file yang dipilih
                            var input = document.getElementById('images');
                            var files = Array.from(input.files);
                            var index = files.findIndex(function(file) {
                                return file.name === file.name;
                            });
                            if (index !== -1) {
                                files.splice(index, 1);
                                input.files = new FileList(files);
                            }
                        });

                        var previewItem = document.createElement('div');
                        previewItem.setAttribute('class', 'image-preview');
                        previewItem.appendChild(img);
                        previewItem.appendChild(closeButton);

                        previewContainer.appendChild(previewItem);
                    };
                })(file);

                reader.readAsDataURL(file);
            }
        }
    </script>
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
