<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>S . I . S . D . A . | Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.css"
        integrity="sha512-ClXpwbczwauhl7XC16/EFu3grIlYTpqTYOwqwAi7rNSqxmTqCpE8VS3ovG+qi61GoxSLnuomxzFXDNcPV1hvCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
        integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css"
        integrity="sha512-RPxGl20NcAUAq1+Tfj8VjurpvkZaep2DeCgOfQ6afXSEgcvrLE6XxDG2aacvwjdyheM/bkwaLVc7kk82+mafkQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('gentelella-master') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet"
        href="{{ asset('gentelella-master') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
        integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('gentelella-master') }}/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="login">

    <div>
        <div class="login_wrapper">
            <div class="container">
                <div class="row">
                </div>
            </div>
            <main class="form-signin w-100 m-auto">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form action="/login" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h1>Login Form</h1>

                            <div class="form-floating">
                                <input type="email" name='email' class="form-control  " id="email"
                                    placeholder="name@example.com" autofocus required value="">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div>
                                <input type="password" name='password' class="form-control  " id="password"
                                    placeholder="Password" required>
                            </div>
                            <div>
                                <button class="w-100 btn btn-lg btn-light" type="submit">Login</button>
                        </form>

                        <div class="separator">
                            <small class="d-block text-center">Not Registered? <a href="/registrasi"> Registrasi Now</a>
                            </small>
                            <div class="clearfix"></div>
                            <br /><br />
                            <div>
                                <a class="btn btn-link" href="#">
                                    <img class="img-thumbnail"
                                        src=https://sisdainvapp.online/storage/images/LOGO%20SISDA.png
                                        alt="LOGO SISDA.png">
                                </a>
                                <p>Sistem Informasi Sumber Daya Air</p>
                                <p>BBWS Serayu Opak</p>
                            </div>
                        </div>
                    </section>
                </div>

            </main>
        </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (Session::has('loginError'))
            iziToast.warning({
                title: 'Success',
                message: '{{ Session::get('loginError') }}',
                position: 'topRight',
            });
        @endif
    </script>
    <script>
        var emailInput = document.getElementById('email');
        var passwordInput = document.getElementById('password');

        function validateInput() {
            if (emailInput.value.trim() === '' || passwordInput.value.trim() === '') {
                iziToast.error({
                    title: 'Error',
                    message: 'Email atau password tidak boleh kosong',
                    position: 'topRight',
                });
                return false;
            }
            return true;
        }
        document.querySelector('form').addEventListener('submit', function(event) {
            if (!validateInput()) {
                event.preventDefault();
            }
        });
        emailInput.addEventListener('blur', function() {
            validateInput();
        });
    </script>

</body>

</html>
