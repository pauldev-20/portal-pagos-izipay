<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portal de Pagos Izipay</title>
<link rel="icon" href="{{ asset('images/logo_1.png') }}" type="image/x-icon" />

<link rel="stylesheet" href="{{ asset('js/bootstrap.min.js') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ asset('js/bootstrap.bundle.js') }}">
<link rel="stylesheet" href="{{ asset('js/bootstrap.bundle.min.js')}}">

<script src="{{ asset('js/loading.js') }}"></script>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@vite('resources/css/app.css')
<script>
    window.addEventListener('load', () => {
        const alertList = document.querySelectorAll('.alert')
        setTimeout(() => {
            alertList.forEach(alert => {
                alert.classList.add('d-none')
            })
        }, 5000)

        hideLoading()
    })

    function selectAll() {
        const notchek = document.getElementById('nocheck');
        const check = document.getElementById('check');
        const button = document.getElementById('button-form-pago');
        document.querySelectorAll('input[type=checkbox]').forEach((checkbox) => {
            checkbox.checked = true;
            button.classList.remove('d-none');
        })
        notchek.classList.add('d-none');
        check.classList.remove('d-none');
    }

    function deSelectAll() {
        const notchek = document.getElementById('nocheck');
        const check = document.getElementById('check');
        const button = document.getElementById('button-form-pago');
        document.querySelectorAll('input[type=checkbox]').forEach((checkbox) => {
            checkbox.checked = false;
        });
        button.classList.add('d-none');
        notchek.classList.remove('d-none');
        check.classList.add('d-none');
    }
</script>
<section id="loading">
    <div id="loading-content"></div>
</section>