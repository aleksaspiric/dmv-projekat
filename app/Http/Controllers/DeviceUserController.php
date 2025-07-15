<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;

class DeviceUserController extends Controller
{
    public function add($did, $uid)
    {
        if (auth()->id() !== (int) $uid) {
            abort(403);
        }

        $user = User::findOrFail($uid);
        $alreadyAttached = $user->devices()->where('devices.id', $did)->exists();

        if ($alreadyAttached) {
        
            return redirect()->route('dmv.index')->with('success', 'Već ste dodali ovaj uređaj.');
        
        }
        else {
            
            $user->devices()->attach($did);
            return redirect()->route('dmv.index')->with('success', 'Device uspešno dodat!');
        }
    }

    public function remove($did, $uid)
    {
        if (auth()->id() !== (int) $uid) {
            abort(403);
        }

        $user = User::findOrFail($uid);
        $user->devices()->detach($did);

        return redirect()->route('dmv.index')->with('success', 'Device uspešno uklonjen!');
    }
}
