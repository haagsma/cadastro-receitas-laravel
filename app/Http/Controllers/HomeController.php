<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use App\Models\Receita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receitas = Receita::all();
        return view('home', [
            'receitas'=>$receitas
        ]);
    }
    public function adicionar(){
        return view('adicionar');
    }
    public function salvar(Request $request){
       $ingredientes = $request->input('ingredientes');
       $receita = new Receita();
       $receita->loadModel($request->input());
       if(count($ingredientes) > 0){
           $receita->ingredientes = 1;
       }else{
           $receita->ingredientes = 0;
       }
       $receita->usuario = Auth::user()->id;
       if($receita->save()){
           foreach ($ingredientes as $key=>$data){
               $ing = new Ingrediente();
               $ing->ingrediente = $data;
               $ing->receita = $receita->id;
               if(!$ing->save()){
                   $request->session()->flash('error','Erro ao salvar o ingrediente '.$data.', tente novamente!');
                   $receita->delete();
                   return redirect('/');
                   break;
               }
           }
           $request->session()->flash('success','Receita salva com sucesso!');
           return redirect('/');
       }else{
           $request->session()->flash('error','Erro ao salvar a receita, tente novamente!');
           return redirect('/');
       }

    }
    public function deletar(Request $request){
        $receita = new Receita();
        $receita = $receita->find($request->input('id'));
        if($receita->delete()){
            $ing = new Ingrediente();
            $ing->where('receita', $receita->id)->delete();
            $request->session()->flash('success','Receita excluida com sucesso!');
            return redirect('/');
        }else{
            $request->session()->flash('error','Erro ao excluir a receita, tente novamente!');
            return redirect('/');
        }
    }

    public function editar(Request $request){
        $receita = new Receita();
        $receita = $receita->find($request->input('id'));
        return view('editar', ['receita'=>$receita]);
    }
    public function editsalvar(Request $request){
        $ingredientes = $request->input('ingredientes');
        $receita = new Receita();
        $receita = $receita->find($request->input('id'));
        $receita->loadModel($request->input());
        if(count($ingredientes) > 0){
            $receita->ingredientes = 1;
        }else{
            $receita->ingredientes = 0;
        }
        $receita->usuario = Auth::user()->id;
        $receita->updated_at = Carbon::now();
        if($receita->save()){
                $ing = new Ingrediente();
                $ing->where('receita', $receita->id)->delete();
            foreach ($ingredientes as $key=>$data){
                $ing = new Ingrediente();
                $ing->ingrediente = $data;
                $ing->receita = $receita->id;
                if(!$ing->save()){
                    $request->session()->flash('error','Erro ao salvar o ingrediente '.$data.', tente novamente!');
                    $receita->delete();
                    return redirect('/');
                    break;
                }
            }
            $request->session()->flash('success','Receita salva com sucesso!');
            return redirect('/');
        }else{
            $request->session()->flash('error','Erro ao salvar a receita, tente novamente!');
            return redirect('/');
        }
    }
}
