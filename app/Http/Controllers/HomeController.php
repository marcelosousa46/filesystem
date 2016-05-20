<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Response;
use Validator;
use App\User;

class HomeController extends Controller
{
    private function lista($id)
    {
        $usuario = User::find($id)->name;
        $pasta = public_path().'\\'.studly_case($usuario);
        if (!file_exists($pasta)){
            mkdir($pasta);
        } else {
           $diretorio = dir($pasta);
           $i = 0;
           while($arquivo = $diretorio -> read()){
                 if ($arquivo <> '.' AND $arquivo <> '..')
                 {   
                     $lista[$i] = $arquivo;
                     $i++;
                 }    
              }
              $diretorio -> close();           
        }
        return $lista;
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usuario = User::find(auth()->user()->id);
        if (auth()->user()->status === 'L'){
            $lista   = $this->lista(auth()->user()->id);
            return view('home',compact('lista','usuario'));
        } else {
            $erro = 'Sistema de arquivos bloqueado, favor solicitar desbloqueio!';
            return view('home',compact('lista','erro','usuario'));
        }    
    }

    public function usuario($id)
    {
        $usuario = User::find($id);
        if (auth()->user()->status === 'L'){
            $lista   = $this->lista($usuario->id);
            return view('home',compact('lista','usuario'));
        } else {
            $erro = 'Sistema de arquivos bloqueado, favor solicitar desbloqueio!';
            return view('home',compact('lista','erro','usuario'));
        }    
    }

    public function upload(Request $request)
    {
        $dados = $request->all();
        $rules = array('arquivo' => 'required');
        $validacao = Validator::make($dados, $rules);
        if ($validacao->fails())
        {   
            $erro = 'Favor escolher um arquivo!';
            return view('upload',compact('erro'));
        }   
        $error = $request->file('arquivo')->getError();
        if ($error > 0)
        {
            $erro = 'Arquivo invalido!';
            return view('upload',compact('erro'));
        }    
        $usuario = auth()->user()->name;
        $destino = public_path().'\\'.studly_case($usuario).'\\';
        $nome    = $request->file('arquivo')->getClientOriginalName();
        $sucesso = $request->file('arquivo')->move($destino, $nome);
        return view('upload',compact('sucesso'));
    }

    public function download($id,$arquivo){
        $usuario = User::find($id);
        $file    = public_path().'\\'.studly_case($usuario->name).'\\'.$arquivo;
        $headers = array('Content-Type: application/pdf',);
        $lista   = $this->lista($usuario->id);
        $sucesso = Response::download($file, $arquivo, $headers);
        if ($sucesso){
            return $sucesso;
        } else {
            $erro = 'Problema no download do arquivo!';
            return view('home',compact('lista','erro','usuario'));
        }
    }    

    public function delete($id,$arquivo){
        $usuario = User::find($id);
        $lista   = $this->lista($usuario->id);
        $file    = public_path().'\\'.studly_case($usuario->name).'\\'.$arquivo;
        if (file_exists($file)){
            $sucesso = unlink($file);
            if ($sucesso){
               $lista = $this->lista($usuario->id);
               return view('home',compact('lista', 'sucesso','usuario'));
            } else {
                $erro = 'Problema no exclusão do arquivo!';
                return view('home',compact('lista','erro','usuario'));
            }
        } else {
            $erro = 'Arquivo não localizado para exclusão!';
            return view('home',compact('lista','erro','usuario'));
        }    
    }    

    public function listarUsuarios(){
        $lista = User::all();
        return view('desbloqueio',compact('lista','erro'));
    }

    public function desbloqueio($id){
        $usuario = User::find($id);
        $lista   = $this->lista($usuario->id);
        $user = User::find($id)->update(['status' => 'L']);
        if ($user){
           return view('home',compact('lista', 'sucesso','usuario'));
        } else {
            $erro = 'Problema no desbloqueio do usuário!';
            return view('home',compact('lista', 'erro','usuario'));
        }
    }
}
