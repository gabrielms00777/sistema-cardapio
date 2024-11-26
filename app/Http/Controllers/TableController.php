<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TableController extends Controller
{
    public function generateQRCode($tableId)
    {
        $table = Table::find($tableId);

        $payload = Crypt::encrypt([
            'table_id' => $tableId,
            'session_id' => session()->getId(),
            'timestamp' => now()->timestamp, 
        ]);

        $url = route('menu.validate', ['token' => $payload]);

        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($url);

        return $qrCode; 
    }

    public function validateToken($token)
    {
        try {
            $data = Crypt::decrypt($token);

            if (now()->timestamp - $data['timestamp'] > 300) {
                return response('Token expirado. Por favor, leia o QR Code novamente.', 403);
            }

            session([
                'table_id' => $data['table_id'],
                'session_token' => $data['session_id'],
            ]);

            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return response('Token inválido. Por favor, leia o QR Code novamente.', 403);
        }
    }
    // class ValidateUserSession
    // {
    //     public function handle($request, Closure $next)
    //     {
    //         $tableId = session('table_id');
    //         $sessionToken = session('session_token');
    
    //         if (!$tableId || !$sessionToken) {
    //             return redirect()->route('menu.validate')->withErrors('Sessão inválida. Por favor, leia o QR Code novamente.');
    //         }
    
    //         $table = Table::find($tableId);
    //         if (!$table) {
    //             session()->forget(['table_id', 'session_token']);
    //             return redirect()->route('menu.validate')->withErrors('Mesa inválida. Leia o QR Code novamente.');
    //         }
    
    //         return $next($request);
    //     }
    // }

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
            'name' => 'required|string|max:255',
        ]);
    
        $table = Table::create([
            'name' => $request->name,
        ]);

        return redirect()->route('tables.index')->with('success', 'Mesa criada com sucesso!');
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
