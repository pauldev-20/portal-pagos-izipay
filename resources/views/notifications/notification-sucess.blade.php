<head>
    @include('components.head')
</head>

<body class="w-ful h-screen flex justify-center items-center bg-slate-300">
    <div class="w-56 rounded-md bg-white shadow-lg px-6 py-3">
        <p class="text-lg">
            @if (session()->has('status'))
            🎉 {{session()->get('status')}} 🎉
            @else
            Hola y buen dia
            @endif
        </p>
    </div>
</body>