<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\User;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    public function index(Request $request)
    {
        $worker = User::whereIn('role_id',[2,3])->get();
        
        return view('worker.index')->with('worker',$worker);
    }

    public function create()
    {
        return view('worker.create');
    }

    public function store(Request $request)
    {   
        $request->merge([
            'password'=>Hash::make('123456789'),
            'username'=>$request->name,
        ]);
        $worker = User::create($request->all());
        
        return redirect()->route('worker.index')->withSuccess('Data saved');
    }

    public function edit(User $worker)
    {
        return view('worker.create')->with('worker',$worker);
    }

    public function update(Request $request, User $worker)
    {
        $worker->update($request->all());
        return redirect()->route('worker.index')->withSuccess('Data updated');
    }

    public function destroy(User $worker)
    {
        $worker->delete();

        return redirect()->route('worker.index')->withSuccess('Data deleted');
    }
   
}
