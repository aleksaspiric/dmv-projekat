<x-layout>
    <h2>ID Uredjaja - {{ $device->name }}</h2>

    <div class="bg-gray-200 p-4 rounded">
        <p><strong>Type: </strong>{{ $device->type}}</p>
        <p><strong>Location: </strong>{{ $device->location}}</p>
        <p><strong>Status: </strong>
        @if($device->status==1)
            Active
        @else
            Inactive
        @endif
        </p>
        <p><strong>Battery: </strong>{{ $device->battery}}</p>
        <a href="{{route('dmv.edit', $device->id)}}" class="btn">Update device</a>
    </div>

    @auth
        @if (auth()->user()->role === 'admin')
            <div class="flex flex-row justify-around max-w-xs">
                <form action="{{ route('dmv.destroy', $device->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn my-4">Delete device</button>
                </form>
                <form action="{{ route('dmv.charge', $device->id) }}" method="POST">
                    @csrf

                    <button type="submit" class="btn my-4">Charge device</button>
                </form>
            </div>
        @elseif (auth()->user()->role === 'user')
            <form action="{{ route('dmv.add', ['did' => $device->id, 'uid' => auth()->user()->id]) }}" method="POST">
                @csrf

                <button type="submit" class="btn my-4">Add device to your collection</button>
            </form>
            
        @endif
    @endauth

</x-layout>