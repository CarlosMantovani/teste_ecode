<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Aula;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
class CursoController extends Controller

{
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        
        return view('/cursos/create');
    }

    public function store(Request $request)
    {
        
        $data = [];

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->imagem->store('cursos_imagem');
        }
    
        Curso::create([
            'nome_curso' => $request->input('nome'),
            'titulo' => $request->input('titulo_curso'),
            'descricao' => $request->input('desc'),
            'imagem' => $data['imagem'] ?? null, 
        ]);
    
    $cursos = Curso::all();
    return view('/modulos/create', compact('cursos'));
    }

    public function show($id)
    {

        $curso = Curso::findOrFail($id);

        

    $quantidadeModulos = Modulo::where('curso_id', $id)->count();
    $quantidadeAulas = Aula::whereIn('modulos_id', Modulo::where('curso_id', $id)->pluck('id'))->count();

    return view('cursos.show', compact('curso', 'quantidadeModulos', 'quantidadeAulas'));

        
    }

    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        return view('/cursos/edit', compact('curso'));
    }

    public function update(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);

        if ($request->hasFile('imagem')) {

            if (Storage::exists($curso->imagem)) {
                Storage::delete($curso->imagem);
            }
           
            $curso->imagem = $request->file('imagem')->store('cursos_imagem');
        }


        if ($request->filled('nome') && $request->nome != $curso->nome_curso) {
            $curso->nome_curso = $request->nome;
        }
    
    
        if ($request->filled('titulo_curso') && $request->titulo_curso != $curso->titulo) {
            $curso->titulo = $request->titulo_curso;
        }
    
        if ($request->filled('desc') && $request->desc != $curso->descricao) {
            $curso->descricao = $request->desc;
        }
    
        
        if ($curso->isDirty()) {
            $curso->save();  
        } 
            return redirect()->route('cursos.index');
    }

    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return redirect()->route('cursos.index');
    }
}
