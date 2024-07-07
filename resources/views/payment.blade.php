<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
    <script type="text/javascript" src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js" kr-public-key="{{config('services.izipay.public_key')}}" kr-post-url-success="paid" ; kr-language="es-ES">
    </script>

    <link rel="stylesheet" ref="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon-reset.min.css">
    <script src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon.js">
    </script>
    <style type="text/css">
        .kr-card-header-label {
            display: none !important;
        }

        .kr-card-header {
            height: 70px !important;
            background-color: transparent !important;
        }

        .kr-card-icons {
            display: flex;
            align-items: center !important;
            gap: 40px !important;
        }

        .kr-card-icons span {
            width: 20px;
            height: 20px;
            background-color: transparent !important;
        }

        .kr-card-icons span svg {
            width: 40px !important;
            height: 25px !important;
        }


        .kr-embedded {
            font-family: Arial, sans-serif !important;
            margin: 0 auto !important;
            padding: 20px !important;
            border: 1px solid #ccc !important;
            border-radius: 5px !important;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1) !important;
        }

        .flex-container {
            display: flex !important;
            flex-direction: column !important;
            gap: 10px !important;
            margin-bottom: 10px !important;
        }

        .kr-group-expiry-code {
            display: flex !important;
            gap: 10px !important;
        }

        .kr-expiry {
            flex: 2 !important;
        }

        .kr-security-code {
            flex: 1 !important;
        }

        .kr-pan,
        .kr-expiry,
        .kr-security-code,
        .kr-identity-document-type,
        .kr-identity-document-number,
        .kr-installment-number,
        .kr-first-installment-delay {
            padding: 10px !important;
            border: 1px solid #ccc !important;
            border-radius: 5px !important;
            font-size: 14px !important;
        }

        .kr-installment-number,.kr-first-installment-delay {
            margin-bottom: 10px !important;
        }

        .kr-select {
            border: none !important;
        }

        .kr-options {
            border: 1px solid #ccc !important;
            border-radius: 5px !important;
            cursor: pointer !important;
        }

        .kr-option {
            padding: 10px !important;
            background-color: #fff !important;
            color: #333 !important;
            transition: background-color 0.3s ease !important;
        }

        .kr-option:hover {
            background-color: #ebdfe1 !important;
        }

        .kr-option.selected {
            background-color: #f0f0f0 !important;
            color: #fff !important;
        }

        .kr-identity-document-number input:focus {
            outline: none !important;
            border: none !important;
        }

        .kr-pan,
        .kr-expiry,
        .kr-security-code {
            height: 40px !important;
        }

        .kr-payment-button {
            display: block !important;
            width: 100% !important;
            padding: 10px !important;
            background-color: #dc1727 !important;
            color: #fff !important;
            border: none !important;
            border-radius: 5px !important;
            font-size: 16px !important;
            cursor: pointer !important;
            transition: background-color 0.3s ease !important;
        }

        .kr-payment-button:hover {
            background-color: #dc1727 !important;
        }

        /* Estilos para la etiqueta de error */
        .error-message {
            color: #ff0000 !important;
            font-size: 12px !important;
            margin-top: 5px !important;
        }
    </style>
</head>

<body>
    @include('components.nav')
    <section class="container mt-4 d-flex justify-content-center">
        <div class="kr-smart-form col-lg-5 col-md-7 col-sm-7 col-11" kr-card-form-expanded kr-form-token="{{$formToken}}">
            <div class="kr-embedded">
                <div class="flex-container">
                    <div class="kr-pan">
                    </div>
                    <div class="kr-group-expiry-code">
                        <div class="kr-expiry">
                        </div>
                        <div class="kr-security-code">
                        </div>
                    </div>
                </div>
                <div class="flex-container">
                    <div class="kr-identity-document-type">
                    </div>
                    <div class="kr-identity-document-number">
                    </div>
                </div>
                <button class="kr-payment-button">
                </button>
            </div>
        </div>
    </section>
    @include('components.footer')
</body>

</html>