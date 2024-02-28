<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor as Alumno;
use Exception;

class ProfesorController extends Controller
{
    public function showall()
    {
        //

        $as = Alumno::all(); //paginate(25);  //::all()
        return response()->json([
            'status' => 'success',
            'mensaje' => 'Lista de Usuario recuperada con èxito',
            'data' => $as
        ]);
      
    }
    public function show($id) //for individual resource
    {
        //          //model
        $as = Alumno::where('id','=',$id)->first();   //mejor findor fail     //was get(), pero da como resultado un array al que hay que acceder con data['data'][0]

        return response()->json([
            'status' => 'success',
            'mensaje' => 'Usuario recuperado con éxito',
            'data' => $as
        ]);
    }

    public function store(Request $request)
    {
        //
        try{
        $as = Alumno::create($request->all());
        
        return response()->json([
          'status' => 'success',
          'mensaje' => 'Usuario registrado con éxito',
          'data' => $as
      ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'mensaje' => $e,
                'data' => $as
            ]);


        }
        }

        public function update(Request $request,$id)        //ws $equip, but...
        {
            //
            $as = Alumno::where('id','=',$id)->first();
    
            $input = $request->all();
       $as->fill($input)->save();
    
       return response()->json([
        'status' => 'success',
        'mensaje' => 'Usuario actualizado con éxito',
        'data' => $as
    ]);
            //  return $empleadonuevo;
        }


        public function destroy($id){

            $al = Alumno::find($id);

            $al->delete();

            return response()->json([
                'status' => 'success',
                'mensaje' => 'Usuario borrado con éxito'
                
            ]);

        }






}
