<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Item;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $item = Item::all();
        
        return view('item.index')->with('item',$item);
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {   
        $item = Item::create($request->all());
        
        return redirect()->route('item.index')->withSuccess('Data saved');
    }

    public function edit(Item $item)
    {
        return view('item.create')->with('item',$item);
    }

    public function update(Request $request, Item $item)
    {
        $item->update($request->all());
        return redirect()->route('item.index')->withSuccess('Data updated');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('item.index')->withSuccess('Data deleted');
    }
   
}
