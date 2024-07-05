<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
</head>

<body class="d-flex flex-column">
    <header>
        @include('components.nav')
    </header>
    <section class="container-xl mt-4 mt-sm-1 d-flex justify-content-center align-items-center" style="flex: 1;">
        <div class="col-lg-4 col-md-5 col-sm-6 col-11">
            @foreach($errors->all() as $error)
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <span>
                    <i class="fa-solid fa-circle-exclamation"></i>
                </span>
                <div>
                    {{ $error }}
                </div>
                <div class="flex-grow-1 d-flex justify-content-end">
                    <button type="button" class="btn-close btn-alert" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endforeach
            <form action="{{ route('login.api') }}" method="post" class="container needs-validation d-flex flex-column" novalidate style="gap: 20px;">
                @csrf
                <div class="row">
                    <label for="dni" class="form-label">Dni o Ruc:</label>
                    <input class="form-control" type="text" name="dni" required>
                    <div class="invalid-feedback">
                        Por favor ingrese su dni o ruc.
                    </div>
                </div>

                <div class="row">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" name="password" required>
                    <div class="invalid-feedback">
                        Ingrese su contraseña.
                    </div>
                </div>

                <div class="row d-flex justify-content-end">
                    <button class="btn btn-danger col-12 col-lg-5 col-md-6 col-sm-7" type="submit" onclick="showLoading()">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </section>
    @include('components.footer')
    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>