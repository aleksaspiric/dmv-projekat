<x-layout>
    <h2>Dostupni uredjaji</h2>

    <ul>
        @foreach($devices as $device)
            <li>
                <x-card href="{{route('dmv.show', $device->id)}}" :highlight="$device['battery']>70">
                    <h3>{{ $device->name }}</h3>
                </x-card>
            </li>   
        @endforeach 
    </ul>

    {{ $devices->links() }}
</x-layout>