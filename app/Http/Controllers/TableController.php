<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableController extends Controller
{

    public function qrcode(Request $request)
    {
        $table = Table::findOrFail($request->table_id);
        return $table->qrcode . '<br>' . $table->token; 
    }

    public function index()
    {
        return view('table.index',[
            'tables' => Table::all()
        ]);
    }

    public function create()
    {
        return view('table.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:255',
        ]);
    
        $table = Table::create([
            'number' => $request->number,
            'token' => Str::uuid(),
        ]);

        $url = route('site.token', ['token' => $table->token]);

        $qrcode = QrCode::size(200)->generate($url);

        $table->update([
            'qrcode' => $qrcode
        ]); 

        return redirect()->route('table.index')->with('success', 'Mesa criada com sucesso!');
    }

    public function edit()
    {
        return view('table.edit');
    }

    public function show()
    {
        return view('table.show');
    }

    public function destroy()
    {
        return view('table.destroy');
    }

    public function orders()
    {
        return view('table.orders');
    }
}
