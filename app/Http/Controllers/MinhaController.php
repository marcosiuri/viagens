<?php

namespace App\Http\Controllers;
use App\Models\Passagem;
use App\Models\Destino;
use App\Models\User;
use Illuminate\Http\Request;

class MinhaController extends Controller
{
    public function minha()
    {
        $passagens = auth()->user()->passagens;
        return view('minha', compact('passagens'));
    }


    public function cancelarPassagem($passagemId, $destinoId)
    {
        \Log::info('Cancelando passagem. Passagem ID: ' . $passagemId . ', Destino ID: ' . $destinoId);

        $passagem = Passagem::find($passagemId);

        if (!$passagem || $passagem->user_id !== auth()->user()->id) {
            return response()->json(['success' => false, 'message' => 'Passagem não encontrada.']);
        }

        $quantidadePassagens = $passagem->quantidade;

        $passagem->delete();

        $destino = Destino::find($destinoId);
        if ($destino) {
            $destino->quantidade_pessoas += $quantidadePassagens;
            $destino->save();
        }

        \Log::info('Passagem cancelada com sucesso.');

        return response()->json(['success' => true]);
    }


    public function diminuirPassagem($passagemId, $destinoId)
    {
        \Log::info('Diminuindo passagem. Passagem ID: ' . $passagemId . ', Destino ID: ' . $destinoId);

        $passagem = Passagem::find($passagemId);
        if (!$passagem || $passagem->user_id !== auth()->user()->id) {
            abort(404);
        }

        $passagem->quantidade--;

        if ($passagem->quantidade <= 0) {
            $passagem->delete(); 
        } else {
            $passagem->save();
        }

        \Log::info('Número de passagens diminuído com sucesso.');

        return redirect()->route('minha')->with('success', 'Número de passagens diminuído com sucesso.');
    }

}
