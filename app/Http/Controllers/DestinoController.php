<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Models\User;
use App\Models\DestinoComprado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DestinoController extends Controller
{
    public function destino()
    {
        $destinos = Destino::all();
        return view('destino', compact('destinos'));
    }

    public function show($id)
    {
        $destino = Destino::find($id);
        if (!$destino) {
            abort(404);
        }
        return view('destino', ['destino' => $destino]);
    }
    

    public function salvarContador(Request $request, $id)
    {
        $destino = Destino::find($id);

        $request->validate([
            'contador' => 'required|integer|min:1',
        ]);

        $contador = $request->input('contador');

        if ($contador > 0 && $contador <= $destino->quantidade_pessoas) {
            $valorTotal = $contador * $destino->valor;

            auth()->user()->passagens()->create([
                'destino_id' => $destino->id,
                'quantidade' => $contador,
                'valor_total' => $valorTotal,
            ]);

            $destino->quantidade_pessoas -= $contador;
            $destino->save();

            return response()->json(['novaQuantidade' => $destino->quantidade_pessoas, 'valorTotal' => $valorTotal], 200);
        }

        return response()->json(['error' => 'Contador inválido'], 400);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'destino' => 'required|string|max:255',
                'valor' => 'required|numeric|min:0',
                'quantidade_pessoas' => 'required|integer|min:1',
            ]);

            $novoDestino = Destino::create([
                'destino' => $request->input('destino'),
                'valor' => $request->input('valor'),
                'quantidade_pessoas' => $request->input('quantidade_pessoas'),
            ]);

            return redirect()->route('main')->with('success', 'Destino cadastrado com sucesso.');
        } catch (\Exception $e) {
            Log::error('Erro ao salvar destino: ' . $e->getMessage());
            return redirect()->route('main')->with('error', 'Erro ao cadastrar destino.');
        }
    }

    public function create()
    {
        return view('create');
    }
}
