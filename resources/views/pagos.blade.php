<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
    <style>
        .alerta {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 16px 5px 16px 20px;
            border-radius: 5px;
        }

        .alerta-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
    </style>
</head>

<body>
    @include('components.nav')
    <section class="container-lg mt-4" style="flex: 1;">
        <div class="table-responsive">
            @foreach($conceptosContain as $concepto)
            <div class="alerta alerta-success mb-2" role="alerta">
                Esta al dia con sus pagos de {{ $concepto}}
            </div>
            @endforeach
            @if($deudaTotal->count() > 0)
            <table class="table text-center">
                <thead>
                    <tr class="table-danger">
                        <th scope="col">Concepto</th>
                        <th scope="col">Nº de recibos</th>
                        <th scope="col">Derecho de emisión</th>
                        <th scope="col">Importe</th>
                        <th scope="col">Deuda Total</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deudaTotal as $pago)
                    <tr class="table-active">
                        <td>{{ $pago->concepto }}</td>
                        <td>{{ $pago->cantidad }}</td>
                        <td>S/ {{ $pago->derecho_tramite }}</td>
                        <td>S/ {{ $pago->deuda_total }}</td>
                        <td>S/ {{ $pago->derecho_tramite + $pago->deuda_total }}</td>
                        <td>
                            @if($pago->concepto == 'Agua')
                            <a class="nav-link" href="{{ route('agua')}}" onclick="showLoading()">
                                <button class="btn btn-info">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>
                            @elseif($pago->concepto == 'Arbitrios')
                            <a class="nav-link" href="{{ route('arbitrio')}}" onclick="showLoading()">
                                <button class="btn btn-info">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>
                            @elseif($pago->concepto == 'Predios')
                            <a class="nav-link" href="{{ route('predio')}}" onclick="showLoading()">
                                <button class="btn btn-info">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </section>
</body>

</html>