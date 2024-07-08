# Portal de Pago con Izipay

Este proyecto es una aplicación que te permite administrar tus usuarios con sus respectivos conceptos de pago siendo procesados por una passarela de pagos como Izipay. 

## Contenidos

- [Requerimientos](#requerimientos)
- [Requisitos](#requisitos)
- [Conseguir credenciales de Izipay](#conseguir-credenciales-de-izipay)
- [Levantar aplicación](#levantar-aplicación)
- [Capturas de Pantalla](#capturas-de-pantalla)

## Requerimientos

Esta aplicación debe permitirte

- Registrar una lista o lote de usuarios en el portal
- Registrar los respectivos conceptos de pago por cada usuario
- Permitir el inicio de sesión a los usuarios
- Permitir visualizar el estado de pago de los usuarios
- Permitir filtrar por fecha los pagos atrasados o pendiente agrupados por concepto
- Cargarte un pasarella de pagos una vez selecciones los recibos a pagar
- Procesar y realizar el pago correspondiente

## Requisitos

Para ejecutar este proyecto, necesitas tener instalado:

-  Docker 24 o superior

## Conseguir credenciales de Izipay

Para poder incrustar el formulario de Izipay se necesita unas credenciales de desarrollo o producción:
- Vaya a [https://secure.micuentaweb.pe/doc/es-PE/rest/V4.0/javascript/guide/keys/file.html].
- Uze las credenciales de prueba que le brinda ahi o siga las instrucciones para ingresar en su Back Office.
- Copie el archivo .env.example en uno .env y en las credenciales de Izipay coloce las suyas o deje las siguientes que son de prueba:
```bash
IZIPAY_URL=https://api.micuentaweb.pe
IZIPAY_USERNAME=89289758
IZIPAY_PASSWORD=testpassword_7vAtvN49E8Ad6e6ihMqIOvOHC6QV5YKmIXgxisMm0V7Eq
IZIPAY_PUBLIC_KEY=89289758:testpublickey_TxzPjl9xKlhM0a6tfSVNilcLTOUZ0ndsTogGTByPUATcE
IZIPAY_HASH_KEY=fva7JZ2vSY7MhRuOPamu6U5HlpabAoEf8VmFHQupspnXB
```

## Levantar aplicación

1. Para levantar la aplicación ejecute el docker-compose.yml en su terminal

```bash
docker compose up --build -d
```

2. Una vez levantado ingrese al contenedor de la aplicación para levantar la aplicación laravel siguiendo los siguientes comandos:

```bash
docker compose exec app sh
```
```bash
composer install
php artisan key:generate
php artisan optimize
php artisan view:clear
php artisan cache:clear
php artisan migrate --seed
```

## Capturas de Pantalla
<img src="./public/captures/image.png" alt="Imagen" height=400>
<img src="./public/captures/image-1.png" alt="Imagen 1" height=400>
<img src="./public/captures/image-2.png" alt="Imagen 2" height=400>