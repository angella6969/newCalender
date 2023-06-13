@extends('layout.main')
@Section('tittle')
    <title> SISDA | Create Users </title>
@section('container')

    <div class="row justify-content-center align-items-center">
        <div class="col-lg-8">
            <main class="form-registration">

                <section class="login_content">
                    <form action="/users" method="post">
                        @csrf
                        <h1>Tambah Pengguna</h1>
                        {{-- Field Name --}}
                        <div class="form-floating mb-1">
                            <input type="text" name='name'
                                class="form-control rounded-top @error('name') is-invalid @enderror " id="name"
                                placeholder="name" required value="{{ old('name') }}">
                            <label for="name">Nama</label>
                            @error('name')
                                <div class="invalit-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- End Field Name --}}

                        {{-- Field Username --}}
                        {{-- <div class="form-floating mb-1">
                            <input type="text" name='username'
                                class="form-control @error('username') is-invalid @enderror" id="username"
                                placeholder="username" required value="{{ old('username') }}">
                            <label for="username">username</label>
                            @error('username')
                                <div class="invalit-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        {{-- End Field Username --}}

                        {{-- Field Phone --}}
                        {{-- <div class="form-floating mb-1">
                            <input type="text" name='phone' class="form-control @error('phone') is-invalid @enderror"
                                id="phone" placeholder="phone" required value="{{ old('phone') }}">
                            <label for="phone">Phone</label>
                            @error('phone')
                                <div class="invalit-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        {{-- End Field Phone --}}

                        {{-- Field Email --}}
                        <div class="form-floating mb-1">
                            <input type="email" name='email' class="form-control @error('email') is-invalid @enderror"
                                id="floatingInput" placeholder="email" required value="{{ old('email') }}">
                            <label for="floatingInput">Email</label>
                            @error('email')
                                <div class="invalit-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- End Field Email --}}

                        {{-- Field Password --}}
                        <div class="form-floating mb-1">
                            <input type="password" name='password'
                                class="form-control rounded-bottom @error('password') is-invalid @enderror"
                                id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                            @error('password')
                                <div class="invalit-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- End Field Password --}}

                        {{-- Field Role --}}
                        {{-- @can('SuperAdmin')
                            <div class="mb-2">
                                <select class="form-select" name=role_id>
                                    <option value=""> awd </option>
                                    @foreach ($roles as $item)
                                        @if (old('role_id') == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                                @error('role_id')
                                    <div class="invalit-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endcan --}}
                        {{-- End Field Role --}}

                        {{-- Button Submit --}}
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-lg btn-primary" type="submit">Submit</button>
                        </div>
                        {{-- Button Submit --}}

                        <div class="clearfix"></div>

                        {{-- Footer --}}

                        {{-- End Footer --}}
                    </form>
                </section>
                {{-- <small class="d-block text-center mb-5">Alredy Registered? <a href="/login"> Login</a>
      </small> --}}
            </main>
        </div>

    @endsection
