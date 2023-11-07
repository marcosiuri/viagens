<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passagem;

class PassagemController extends Controller
{
    public function index()
    {
        // Retorna todas as passagens
        $passagens = Passagem::all();
        return view('passagens.index', compact('passagens'));
    }

    public function show($id)
    {
        // Retorna uma passagem específica pelo ID
        $passagem = Passagem::find($id);
        return view('passagens.show', compact('passagem'));
    }

    public function create()
    {
        // Retorna a view para criar uma nova passagem
        return view('passagens.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados e criação de uma nova passagem
        $request->validate([
            'destino_id' => 'required|exists:destinos,id',
            'user_id' => 'required|exists:users,id',
            // Adicione outras validações conforme necessário
        ]);

        Passagem::create($request->all());

        return redirect()->route('passagens.index')->with('success', 'Passagem criada com sucesso!');
    }

    public function edit($id)
    {
        // Retorna a view para editar uma passagem
        $passagem = Passagem::find($id);
        return view('passagens.edit', compact('passagem'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados e atualização da passagem
        $request->validate([
            'destino_id' => 'required|exists:destinos,id',
            'user_id' => 'required|exists:users,id',
            // Adicione outras validações conforme necessário
        ]);

        $passagem = Passagem::find($id);
        $passagem->update($request->all());

        return redirect()->route('passagens.index')->with('success', 'Passagem atualizada com sucesso!');
    }

    public function destroy($id)
    {
        // Exclusão de uma passagem
        $passagem = Passagem::find($id);
        $passagem->delete();

        return redirect()->route('passagens.index')->with('success', 'Passagem excluída com sucesso!');
    }
}
