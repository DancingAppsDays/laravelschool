<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscrito as Alumno;

class InscritoController extends Controller
{
    public function showall()
    {
        //

        $as = Alumno::all(); //paginate(25);  //::all()
        return response()->json([
            'status' => 'success',
            'mensaje' => 'Lista de inscritos recuperada con èxito',
            'data' => $as
        ]);
      
    }
    public function show($id) //for individual resource
    {
        //          //model
        $as = Alumno::where('id','=',$id)->first();   //mejor findor fail     //was get(), pero da como resultado un array al que hay que acceder con data['data'][0]

        return response()->json([
            'status' => 'success',
            'mensaje' => 'Cursos inscritos recuperado con éxito',
            'data' => $as
        ]);
    }


    public function showdemaestro($id,$idc) //from maestro
    {
        //          //model
        $as = Alumno::where('idmaestro','=',$id)->where('idcurso','=',$idc)->get();  
        return response()->json([
            'status' => 'success',
            'mensaje' => 'Curso recuperado con éxito',
            'data' => $as
        ]);
    }

    public function showdealumno($id) //from maestro
    {
        //          //model
        $as = Alumno::where('idalumno','=',$id)->get();  
        return response()->json([
            'status' => 'success',
            'mensaje' => 'Curso recuperado con éxito',
            'data' => $as
        ]);
    }




    public function store(Request $request)
    {
        //
        $as = Alumno::create($request->all());
        
        return response()->json([
          'status' => 'success',
          'mensaje' => 'Inscripcion registrado con éxito',
          'data' => $as
      ]);
        }

        public function update(Request $request,$id)        //ws $equip, but...
        {
            //
            $as = Alumno::where('id','=',$id)->first();
    
            $input = $request->all();
       $as->fill($input)->save();
    
       return response()->json([
        'status' => 'success',
        'mensaje' => 'Inscrito actualizado con éxito',
        'data' => $as
    ]);
            //  return $empleadonuevo;
        }


        public function destroy($id){

            $al = Alumno::find($id);

            $al->delete();

            return response()->json([
                'status' => 'success',
                'mensaje' => 'Inscrito borrado con éxito'
                
            ]);

        }

}
