<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMV Projekat</title>

    @vite('resources/css/app.css')
</head>
<body>
    @if(session('success'))
        <div id="flash" class="p-4 text-center bg-green-100 text-green-400 font-bold">
            {{session('success')}}
        </div>
    @endif
    <header>
        <nav>
            <h1>
                <a href="{{ route('dmv.index')}}">DMV</a>
            </h1>

            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{route('dmv.create')}}" class="btn">Kreiraj uredjaj</a>
                @else
                    <p>Dobrodošao, {{auth()->user()->name}}</p>
                    <a href="{{route('dmv.devices')}}" class="btn">Vasi uredjaji</a>
                    <a href="{{route('dmv.chart')}}" class="btn">Grafikon</a>
                @endif
                <form action="{{route('logout')}}" method="POST">
                    @csrf       
                        <button type="submit" class="btn mt-4">Logout</button>
                </form>
            @endauth

                     

            @guest
                <a href="{{route('auth.login')}}" class="btn">Login</a>
            @endguest
        </nav>
    </header>

    <main class="container">
        {{
            $slot
        }}
    </main>
</body>
</html>