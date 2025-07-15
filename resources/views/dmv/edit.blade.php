<x-layout>
    
    <form action="{{route('dmv.update', $device->id)}}" method="POST">
        @csrf
        @method('PUT')

        <h2>Izmeni uredjaj</h2>

        <label for="name">Name: </label>
        <input type="text" name="name" id="name" value="{{$device->name}}" required>

        <label for="type">Type of device: </label>
        <select name="type" id="type">
            <option value="Smartphone">Smartphone</option>
            <option value="Tablet">Tablet</option>
            <option value="Laptop">Laptop</option>
            <option value="Smartwatch">Smartwatch</option>
            <option value="Router">Router</option>
            <option value="Sensor">Sensor</option>
            <option value="Printer">Printer</option>
            <option value="Camera">Camera</option>
            <option value="Speaker">Speaker</option>
            <option value="Monitor">Monitor</option>
            <option value="Smart TV">Smart TV</option>
            <option value="Game Console">Game Console</option>
            <option value="Drone">Drone</option>
            <option value="VR Headset">VR Headset</option>
            <option value="Server">Server</option>
            <option value="Projector">Projector</option>
            <option value="Thermostat">Thermostat</option>
            <option value="Fitness Tracker">Fitness Tracker</option>
            <option value="Network Switch">Network Switch</option>
            <option value="Smart Plug">Smart Plug</option>
        </select>

        <label for="location">Location: </label>
        <input type="text" name="location" id="location" value="{{$device->location}}">

        <label for="status">Status: </label>
        <select name="status" id="status">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
        </select>

        <button type="submit" class="btn mt-4">Update device</button>

        @if($errors->any())
            <ul class="px-4 py-2 bg-red-100">
                @foreach($errors->all() as $error)
                    <li class="my-2 text-red-500">{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </form>
</x-layout>