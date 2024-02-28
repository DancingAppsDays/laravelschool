<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Alumno;
//use DB;
use App\Http\Controllers\Controller;

class AlumnoController extends Controller
{
    public function showall()
    {
        //if ( !Gate::allows('Admin')) {    //never got to work
       //     abort(403);
        //}


        $as = Alumno::all(); //paginate(25);  //::all()
        return response()->json([
            'status' => 'success',
            'mensaje' => 'Lista de alumnos recuperada con èxito',
            'data' => $as
        ]);
      
    }
    public function show($id) //for individual resource
    {
        //          //model
        $as = Alumno::where('id','=',$id)->first();   //mejor findor fail     //was get(), pero da como resultado un array al que hay que acceder con data['data'][0]

        return response()->json([
            'status' => 'success',
            'mensaje' => 'Alumno recuperado con éxito',
            'data' => $as
        ]);
    }

    public function store(Request $request)
    {
        //
        $as = Alumno::create($request->all());
        
        return response()->json([
          'status' => 'success',
          'mensaje' => 'Alumnoregistrado con éxito',
          'data' => $as
      ]);
        }

        public function update(Request $request,$id)      
        {
            //
            $as = Alumno::where('id','=',$id)->first();
    
            $input = $request->all();
       $as->fill($input)->save();
    
       return response()->json([
        'status' => 'success',
        'mensaje' => 'Alumno actualizado con éxito',
        'data' => $as
    ]);
            //  return $empleadonuevo;
        }


        public function destroy($id){

            $al = Alumno::find($id);

            $al->delete();

            return response()->json([
                'status' => 'success',
                'mensaje' => 'Alumno borrado con éxito'
                
            ]);

        }

}
