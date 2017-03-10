<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contato;
use File, Input, Redirect, Image;
use App\Helpers\UploadFilesHelper;
use App\Http\Requests;
use App\Http\Requests\ContatoRequest;
use App\Http\Controllers\Controller;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $contatos = Contato::all();
        return view('admin/contatos')->with('contatos', $contatos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/createContatos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContatoRequest $request)
    {
        $contato = new Contato;

        $contato->nome = $request->get('nome');

        $contato->endereco = $request->get('endereco');

        $contato->email = $request->get('email');

        $contato->telefone = $request->get('telefone');

        $file = Input::file("img");

        $destinationPath = 'files/img/contatos/';

        if(! File::isDirectory ($destinationPath)){
            File::makeDirectory('files/img/contatos/');
        }

        $filename = UploadFilesHelper::removerCaracterEspecial(utf8_decode($file->getClientOriginalName()));

        $file->move($destinationPath, $filename);

        $contato->path = $destinationPath;

        $contato->filename = Input::file("img");

        $contato->filename = $filename;

        $contato->save();

        return redirect('contatos')->with('mensagem', "Contato cadastrado com sucesso.");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contato = Contato::find($id);

        return view('admin/alterarContatos')->with('contato', $contato);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contato = Contato::find($id);

        $contato->nome = $request->get('nome');

        $contato->endereco = $request->get('endereco');

        $contato->email = $request->get('email');

        $contato->telefone = $request->get('telefone');

        if(Input::file("img") == null){

            $contato->path = $contato->path;

            $contato->filename = $contato->filename;

        }else{

            unlink($contato->path . $contato->filename);

            $file = Input::file("img");

            $destinationPath = 'files/img/contatos/';

            $contato->filename = Input::file('img');

            $filename = UploadFilesHelper::removerCaracterEspecial(utf8_decode($file->getClientOriginalName()));

            $file->move($destinationPath, $filename); 

            $contato->filename = $filename;

            $contato->path = $destinationPath;
        }

        $contato->save();

        return redirect('contatos')->with('mensagem', "Contato atualizado com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contato = Contato::find($id)->delete();

        return redirect('contatos')->with('mensagem', "Contato excluído com sucesso.");
    }
}
