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

    <main class="containerLogin place-items-center">
        <form action="{{route('auth.login')}}" method="POST">
        @csrf

        <h2>Prijava</h2>

        <label for="email">Email: </label>
        <input type="text" name="email" id="email" value="{{old('email')}}" required>

        <label for="password">Password: </label>
        <input type="password" name="password" id="password" value="{{old('password')}}" required>

        <button type="submit" class="btn mt-4">Prijavi se</button>

        @if($errors->any())
            <ul class="px-4 py-2 bg-red-100">
                @foreach($errors->all() as $error)
                    <li class="my-2 text-red-500">{{$error}}</li>
                @endforeach
            </ul>
            
        @endif
    </form>
    </main>
</body>
</html>