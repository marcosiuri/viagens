<?php



namespace App\Http\Controllers;

use App\Models\Destino;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main()
    {
        $destinos = Destino::all();
        return view('main', compact('destinos'));
    }

    public function buscarSugestoes(Request $request)
    {
        $query = $request->input('query');
        $sugestoes = Destino::where('destino', 'like', "%$query%")->pluck('destino');
        return response()->json($sugestoes);
    }
}

