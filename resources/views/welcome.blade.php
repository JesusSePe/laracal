<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EzCal</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-200">
    <nav class="flex bg-gray-800 px-8 pt-2 shadow-md justify-around">
        <div class="-mb-px flex justify-center">
            <a class="no-underline text-white border-b-2 border-teal-dark uppercase tracking-wide font-bold text-xs py-3 mr-8" href="/">
                Inicio
            </a>
            <a class="no-underline text-white border-b-2 border-transparent uppercase tracking-wide font-bold text-xs py-3 mr-8" href="/docs">
                Documentación
            </a>
            <a class="no-underline text-white border-b-2 border-transparent uppercase tracking-wide font-bold text-xs py-3 mr-8" href="/about">
                Sobre nosotros
            </a>
            @isset($_SESSION['Dis_id'])
            <a class="no-underline text-white border-b-2 border-transparent uppercase tracking-wide font-bold text-xs py-3 mr-8" href="/dashboard">
                Eventos
            </a>
            <div class="flex rounded border-b-2 border-grey-dark overflow-hidden">
                <img src="https://cdn.discordapp.com/avatars/{{ $_SESSION['Dis_id']}}/{{ $_SESSION['avatar']}}.png?size=128" class="rounded-full w-7 h-7 self-center">
                <p class="block text-white text-sm shadow-border bg-blue text-sm py-3 px-4 font-sans tracking-wide uppercase font-bold">{{ $_SESSION['user']}}#{{ $_SESSION['disc']}}</p>
            </div>
            <a class="no-underline text-white border-b-2 border-transparent uppercase tracking-wide font-bold text-xs py-3 ml-8" href="/logout">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </a>
            @endisset
            @empty ($_SESSION['Dis_id'])
            <div>
                <div class="flex rounded border-b-2 border-grey-dark overflow-hidden" style="background:cornflowerblue">
                    <a class="block text-white text-sm shadow-border bg-blue text-sm py-3 px-4 font-sans tracking-wide uppercase font-bold" href='https://discord.com/api/oauth2/authorize?client_id=835936611371188224&redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Flogin&response_type=code&scope=identify%20guilds' type="button">
                        Login
                    </a>
                    <div class="shadow-border p-3" style="background: lightseagreen;">
                        <div class="w-4 h-4">
                            <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 245 240">
                                <style>
                                    .st0 {
                                        fill: #FFFFFF;
                                    }
                                </style>
                                <path class="st0" d="M104.4 103.9c-5.7 0-10.2 5-10.2 11.1s4.6 11.1 10.2 11.1c5.7 0 10.2-5 10.2-11.1.1-6.1-4.5-11.1-10.2-11.1zM140.9 103.9c-5.7 0-10.2 5-10.2 11.1s4.6 11.1 10.2 11.1c5.7 0 10.2-5 10.2-11.1s-4.5-11.1-10.2-11.1z" />
                                <path class="st0" d="M189.5 20h-134C44.2 20 35 29.2 35 40.6v135.2c0 11.4 9.2 20.6 20.5 20.6h113.4l-5.3-18.5 12.8 11.9 12.1 11.2 21.5 19V40.6c0-11.4-9.2-20.6-20.5-20.6zm-38.6 130.6s-3.6-4.3-6.6-8.1c13.1-3.7 18.1-11.9 18.1-11.9-4.1 2.7-8 4.6-11.5 5.9-5 2.1-9.8 3.5-14.5 4.3-9.6 1.8-18.4 1.3-25.9-.1-5.7-1.1-10.6-2.7-14.7-4.3-2.3-.9-4.8-2-7.3-3.4-.3-.2-.6-.3-.9-.5-.2-.1-.3-.2-.4-.3-1.8-1-2.8-1.7-2.8-1.7s4.8 8 17.5 11.8c-3 3.8-6.7 8.3-6.7 8.3-22.1-.7-30.5-15.2-30.5-15.2 0-32.2 14.4-58.3 14.4-58.3 14.4-10.8 28.1-10.5 28.1-10.5l1 1.2c-18 5.2-26.3 13.1-26.3 13.1s2.2-1.2 5.9-2.9c10.7-4.7 19.2-6 22.7-6.3.6-.1 1.1-.2 1.7-.2 6.1-.8 13-1 20.2-.2 9.5 1.1 19.7 3.9 30.1 9.6 0 0-7.9-7.5-24.9-12.7l1.4-1.6s13.7-.3 28.1 10.5c0 0 14.4 26.1 14.4 58.3 0 0-8.5 14.5-30.6 15.2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @endempty
        </div>
    </nav>
    <main class="max-w-5xl m-auto pt-6">
        <div class="flex justify-center items-center bg-gray-200">
            <div class="container bg-admin text-center w-3/4 rounded-xl p-8 shadow-x" style="text-align: -webkit-center">
                <h1 class="text-4xl md:text-6xl font-bold md:font-semibold text-user">EzCal</h1>
                <p class="my-8 text-base">Un bot sencillo para Discord que te permite tener siempre a mano tus tareas, tanto personales cómo con amigos.</p>
                <div class="block items-center" style="width: 230px;">
                    <div class="flex rounded border-b-2 border-grey-dark overflow-hidden" style="background:cornflowerblue">
                        <a class="block text-white text-sm shadow-border bg-blue text-sm py-3 px-4 font-sans tracking-wide uppercase font-bold" href='https://discord.com/oauth2/authorize?client_id=835936611371188224&permissions=412672&scope=bot' type="button">
                            Añadir a Discord
                        </a>
                        <div class="shadow-border p-3">
                            <div class="w-7 h-7">
                                <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 245 240">
                                    <style>
                                        .st0 {
                                            fill: #FFFFFF;
                                        }
                                    </style>
                                    <path class="st0" d="M104.4 103.9c-5.7 0-10.2 5-10.2 11.1s4.6 11.1 10.2 11.1c5.7 0 10.2-5 10.2-11.1.1-6.1-4.5-11.1-10.2-11.1zM140.9 103.9c-5.7 0-10.2 5-10.2 11.1s4.6 11.1 10.2 11.1c5.7 0 10.2-5 10.2-11.1s-4.5-11.1-10.2-11.1z" />
                                    <path class="st0" d="M189.5 20h-134C44.2 20 35 29.2 35 40.6v135.2c0 11.4 9.2 20.6 20.5 20.6h113.4l-5.3-18.5 12.8 11.9 12.1 11.2 21.5 19V40.6c0-11.4-9.2-20.6-20.5-20.6zm-38.6 130.6s-3.6-4.3-6.6-8.1c13.1-3.7 18.1-11.9 18.1-11.9-4.1 2.7-8 4.6-11.5 5.9-5 2.1-9.8 3.5-14.5 4.3-9.6 1.8-18.4 1.3-25.9-.1-5.7-1.1-10.6-2.7-14.7-4.3-2.3-.9-4.8-2-7.3-3.4-.3-.2-.6-.3-.9-.5-.2-.1-.3-.2-.4-.3-1.8-1-2.8-1.7-2.8-1.7s4.8 8 17.5 11.8c-3 3.8-6.7 8.3-6.7 8.3-22.1-.7-30.5-15.2-30.5-15.2 0-32.2 14.4-58.3 14.4-58.3 14.4-10.8 28.1-10.5 28.1-10.5l1 1.2c-18 5.2-26.3 13.1-26.3 13.1s2.2-1.2 5.9-2.9c10.7-4.7 19.2-6 22.7-6.3.6-.1 1.1-.2 1.7-.2 6.1-.8 13-1 20.2-.2 9.5 1.1 19.7 3.9 30.1 9.6 0 0-7.9-7.5-24.9-12.7l1.4-1.6s13.7-.3 28.1 10.5c0 0 14.4 26.1 14.4 58.3 0 0-8.5 14.5-30.6 15.2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mini about and Docs-->
        <div class="flex flex-wrap justify-between bg-base p-4 w-full">
            <div class="flex flex-col space-y-2 w-full md:w-5/12 mx-6 my-3 md:my-0 rounded-lg bg-purple-200 shadow-lg">
                <span class="uppercase block text-lg text-center font-semibold bg-gray-400 py-2 px-4 m-2 rounded-lg">Sobre nosotros: </span>
                <p class="text-justify px-5 m-2">Este proyecto es un trabajo de final de grado realizado por Jesús Serrano, estudiante de Desarrollo de Aplicaciones Web en IES Esteve Terrades i Illa. Dicho proyecto empezó el 26 de Abril de 2021 con la creación del bot en Discord, y una semana después, se empezó a desarrollar esta página web.</p>
                <a class="flex text-justify px-5 m-2" href="/about">Saber más <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            <div class="flex flex-col space-y-2 w-full md:w-5/12 mx-6 my-3 md:my-0 rounded-lg bg-purple-200 shadow-lg">
                <span class="uppercase block text-lg text-center font-semibold bg-gray-400 py-2 px-4 m-2 rounded-lg">Documentación: </span>
                <p class="text-justify px-5 m-2">¿En qué consiste este proyecto? Muy sencillo. Consiste en crear un calendario que cualquiera pueda usar desde cualquier sitio, sin necesidad de aplicaciones externas, más allá de la aplicación de mensajería Discord. De hecho, tampoco hace falta instalarla, ¡puedes usarla desde tu navegador!</p>
                <a class="flex text-justify px-5 m-2" href="/docs">Saber más <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </main>
</body>

</html>