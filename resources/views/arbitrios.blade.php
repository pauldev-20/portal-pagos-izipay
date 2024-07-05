<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
</head>

<body>
    @include('components.nav')
    <section class="container-lg mt-4" style="flex: 1;">
        @if($periodos->count() > 0 && $selected != null)
        <form action="{{ route('arbitrio') }}">
            <div class="d-flex justify-content-start align-items-center mb-3" style="gap: 10px; width: 230px;">
                <label for="periodo-form">Año: </label>
                <select name="periodo" class="form-select" id="periodo-form">
                    @foreach($periodos as $periodo)
                    <option value="{{ $periodo->periodo }}" @if($selected==$periodo->periodo) selected @endif>{{ $periodo->periodo }}</option>
                    @endforeach
                </select>
                <button class="btn btn-danger" type="submit" onclick="showLoading()">Aplicar</button>
            </div>
        </form>
        @endif
        <div class="table-responsive">
            @foreach($errors->all() as $error)
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    {{ $error }}
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
            <form action="{{ route('izipay.requestpayment') }}" method="post">
                @csrf
                <table class="table text-center">
                    <thead>
                        <tr class="table-danger">
                            <th scope="col">
                                <span>
                                    <i id="nocheck" class="fa-sharp fa-regular fa-circle-check fa-lg" style="cursor: pointer;" onclick="selectAll()"></i>
                                    <i id="check" class="fa-sharp fa-solid fa-circle-check fa-lg d-none" style="color: green;cursor: pointer;" onclick="deSelectAll()"></i>
                                </span>
                                Seleccionar
                            </th>
                            <th scope="col">Número</th>
                            <th scope="col">Concepto</th>
                            <th scope="col">Año</th>
                            <th scope="col">Fecha de Vencimiento</th>
                            <th scope="col">Emisión</th>
                            <th scope="col">Importe</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $pago)
                        <tr class="table-active">
                            <th scope="row">
                                @if($pago->estado == 'Pendiente')
                                <input type="checkbox" class="form-check-input" name="pago_id[]" value="{{ $pago->id }}" onchange="checkAll()">
                                @endif
                            </th>
                            <th scope="row">{{ $pago->numero }}</th>
                            <td>{{ $pago->concepto. ' - ' . $pago->item }}</td>
                            <td>{{ $pago->periodo }}</td>
                            <td>{{ $pago->fecha_vencimiento }}</td>
                            <td>S/ {{ $pago->emision }}</td>
                            <td>S/ {{ $pago->importe }}</td>
                            <td>{{ $pago->estado }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <button type="submit" id="button-form-pago" class="btn btn-success d-none" onclick="showLoading()">Pagar</button>
                </div>
            </form>
        </div>
    </section>
    @include('components.footer')
    <script>
        function checkAll() {
            const checkboxes = document.querySelectorAll('input[type=checkbox]');
            const button = document.getElementById('button-form-pago');
            let checked = false;
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    checked = true;
                }
            });
            (checked) ? button.classList.remove('d-none'): button.classList.add('d-none');
        }
    </script>
</body>

</html>