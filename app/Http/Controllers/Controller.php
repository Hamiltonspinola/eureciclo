<?php

namespace App\Http\Controllers;

use App\Models\Dados;
use App\Models\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $dadosFile = File::with('dados')->get();
        dd($dadosFile);
        return view('dados.index', compact('dadosFile'));
    }

    public function store(Request $request)
    {
        $dado = new Dados;
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        $createFile = File::create([
            'nome_arquivo' => $fileName,
        ]);
        
        $myfile = fopen($file, "r") or die("Unable to open file!");
        $dados = fread($myfile, filesize($file));
        $somaValorTotal = array();
        $objDados = explode("\n", $dados);
        for ($i = 1; $i < count($objDados); $i++) {
            $result = explode("\t", $objDados[$i]);
            $somaValorTotal[] = $result[2] * $result[3];
            $dado->create([
                'comprador' => $result[0],
                'descricao' => $result[1],
                'preco_unitario' => $result[2],
                'quantidade' => $result[3],
                'endereco' => $result[4],
                'fornecedor' => $result[5],
                'file_id'  => $createFile->id
            ]);
        }
        fclose($myfile);

        return redirect()->route('dados.index');
    }
}
