<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DeviceController extends Controller
{
    public function index(){
        $devices = Device::orderBy('battery', 'desc')->paginate(10);   

        return view('dmv.index', ["devices" => $devices]);
    }

    public function indexUser(){
        $devices = auth()->user()->devices()->orderBy('battery', 'desc')->paginate(10);   

        return view('dmv.devices', ["devices" => $devices]);
    }

    public function show($id){
        $device = Device::findOrFail($id);

        return view('dmv.show', ["device" => $device]);
    }

    public function show2($id){
        $device = Device::findOrFail($id);

        return view('dmv.show2', ["device" => $device]);
    }

    public function edit($id){
        $device = Device::findOrFail($id);

        return view('dmv.edit', ["device" => $device]);
    }

    public function create(){
        

        return view('dmv.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|min:3|max:255',
            'type'=>'required',
            'location'=>'required|string|min:3|max:255',
        ]); 

        $validated['status']=random_int(0,1);
        $validated['battery'] = random_int(0, 100);

        Device::create($validated);

        return redirect()->route('dmv.index')->with('success', 'Device created.');;
    }

    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        
        $device->delete();

        return redirect()->route('dmv.index')->with('success', 'Device deleted.');;
    }

    public function charge($id)
    {
        $device = Device::findOrFail($id);

        $device->update([
            'battery' => 100,
        ]);

        return redirect()->back()->with('success', 'Uređaj uspešno napunjen.');
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name'=>'required|string|min:3|max:255',
            'type'=>'required',
            'location'=>'required|string|min:3|max:255',
            'status'=>'required'
        ]); 

        $validated['battery'] = random_int(0, 100);

        $device = Device::findOrFail($id);
        $device->update($validated);

        if (auth()->user()->role === 'admin') {
        return redirect()->route('dmv.show', $id)->with('success', 'Device updated.');
        } else {
            return redirect()->route('dmv.show2', $id)->with('success', 'Device updated.');
        }
    }

    public function chart()
    {

        $userId = auth()->id();

        $data = DB::table('devices as d')
            ->join('device_user as du', 'd.id', '=', 'du.device_id')
            ->where('du.user_id', $userId)
            ->select('d.type', DB::raw('count(*) as total'))
            ->groupBy('d.type')
            ->get();

        return view('dmv.chart', compact('data'));
    }

    public function export()
    {
        $user = auth()->user();
        $devices = $user->devices()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="devices.csv"',
        ];

        $columns = ['ID', 'Name', 'Type', 'Location', 'Status', 'Battery'];

        return new StreamedResponse(function () use ($devices, $columns) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, $columns);

            foreach ($devices as $device) {
                fputcsv($handle, [
                    $device->id,
                    $device->name,
                    $device->type,
                    $device->location,
                    $device->status,
                    $device->battery
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }

}
