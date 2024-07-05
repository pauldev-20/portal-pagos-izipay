<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                @if (Auth::check())
                <a href="{{ route('pagos') }}"><img src="{{ asset('images/logo.png') }}" width="200" height="60" alt="Logo de la Municipalidad"></a>
                @else
                <a href="{{ route('home')}}"><img src="{{ asset('images/logo.png') }}" width="200" height="60" alt="Logo de la Municipalidad" onclick="showLoading()"></a>
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMunicipalidad" aria-controls="navMunicipalidad" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navMunicipalidad">
                <ul class="navbar-nav">
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('agua')}}" onclick="showLoading()">Agua
                            <span class="ms-1">
                                <i class="fa-solid fa-droplet"></i>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('arbitrio')}}" onclick="showLoading()">Arbitrios
                            <span class="ms-1">
                                <i class="fa-solid fa-tree"></i>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('predio')}}" onclick="showLoading()">Predios
                            <span class="ms-1">
                                <i class="fa-solid fa-home"></i>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile')}}" onclick="showLoading()">{{ Auth::user()->name }}
                            <span class="ms-1">
                                <i class="fa-solid fa-user"></i>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout.api') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout.api') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login')}}">Ingresar
                            <span class="ms-1">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</header>