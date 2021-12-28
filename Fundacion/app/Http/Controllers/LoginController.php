<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Login.Login");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function diferenciar(Request $request)
    {
        $Correo = $request->post("Correo");
        $Clave = $request->post("Clave");
        $Personal = DB::table("personal")->select("idPersonal","Nombre","Apellido","idTipo")
        ->where("Email",$Correo)
        ->where("Clave",$Clave)
        ->get();
        if(count($Personal) == 1){
            $id = $Personal[0]->idPersonal;
            $nombre = $Personal[0]->Nombre;
            $apellido = $Personal[0]->Apellido;
            $idTipo = $Personal[0]->idTipo;
            Session::put('id', $id);
            session()->put("id", $id);
            session()->push('nombre', $nombre);
            session()->push('apellido', $apellido);
            session()->push('idtipo', $idTipo);

            return redirect()->route('Welcome');
        }
        elseif(count($Personal) == 0){
            $Estudiante = DB::table("estudiantes")->select("idEstudiante","Nombre","Apellido","idTipo")
            ->where("Email",$Correo)
            ->where("Clave",$Clave)
            ->get();
            if(count($Estudiante) == 1){
                $id = $Estudiante[0]->idEstudiante;
                $nombre = $Estudiante[0]->Nombre;
                $apellido = $Estudiante[0]->Apellido;
                $idTipo = $Estudiante[0]->idTipo;
                session()->put("id", $id);
                session()->push('nombre', $nombre);
                session()->push('apellido', $apellido);
                session()->push('idtipo', $idTipo);

                /*return redirect()->route('Login.iniciar_session',$parametros);*/
            }
            else{
                echo "No estas Registrado";
            }
        }
        else{
            echo 'Usted no esta Registrado en el Sistema';
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
