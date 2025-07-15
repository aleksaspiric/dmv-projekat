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
        
        <div class="flex flex-row justify-between">
            <a href="{{route('dmv.edit', $device->id)}}" class="btn">Update device</a>
            <a href="{{route('dmv.export')}}" class="btn">Export csv</a>
        </div>
    </div>

    @auth
        @if (auth()->user()->role === 'user')
            <form action="{{route('dmv.remove', ['did' => $device->id, 'uid' => auth()->user()->id]) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn my-4">Remove device from your collection</button>
            </form>
        
        @endif
    @endauth

</x-layout> 