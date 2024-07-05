<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
</head>

<body>
    @include('components.nav')
    <section class="container mt-4 d-flex justify-content-center">
        <div class="container">
            @foreach($errors->all() as $error)
            <div class="alert alert-warning d-flex align-items-center w-50" role="alert">
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
            @if(session('error'))
            <div class="alert alert-warning d-flex align-items-center w-50" role="alert">
                <span>
                    <i class="fa-solid fa-circle-exclamation"></i>
                </span>
                <div>
                    {{ session('error') }}
                </div>
                <div class="flex-grow-1 d-flex justify-content-end">
                    <button type="button" class="btn-close btn-alert" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success d-flex align-items-center w-50" role="alert">
                <span>
                    <i class="fa-solid fa-circle-check"></i>
                </span>
                <div>
                    {{ session('success') }}
                </div>
                <div class="flex-grow-1 d-flex justify-content-end">
                    <button type="button" class="btn-close btn-alert" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6 mb-sm-2 mb-1">
                    <form action="{{ route('profile.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card profile">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre completo:</label>
                                    <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="dni" class="form-label">DNI:</label>
                                    <input type="text" class="form-control" id="dni" value="{{ Auth::user()->dni }}" readonly name="dni">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-danger" onclick="showLoading()">Actualizar Datos</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('profile.update.password')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card profile">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="password_actually" class="form-label">Contraseña actual:</label>
                                    <input type="password" class="form-control" id="password_actually" name="password_actually" placeholder="************">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Nueva contraseña:</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="************">
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar contraseña:</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="************">
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-danger" onclick="showLoading()">Actualizar Contraseña</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    @include('components.footer')
</body>

</html>