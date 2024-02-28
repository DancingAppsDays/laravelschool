<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Alumno;
use App\Models\Profesor;


use Symfony\Component\Console\Output\ConsoleOutput;

class tokenmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $headertoken = $request->header('Authorization');
        $token = null;

        if(!empty($headertoken))//->isEmpty())    //if not empty
      {
        $token =substr($headertoken,7);   //included dobule beraerer   //was 13
      
        //$output = new ConsoleOutput();
       // $output->writeln($token);
        

    $authuser = User::where('apitoken', '=', $token)->first();              
       if(isset($authuser))          //if token valid
       {
        //$output->writeln("Userfound");
           return $next($request);
       }else { 

        $authuser = Alumno::where('apitoken', '=', $token)->first();   
        
        if(isset($authuser))          //if token valid
        {
            return $next($request);
        }else { 

            $authuser = Profesor::where('apitoken', '=', $token)->first();   

             if(isset($authuser))          //if token valid
       {
           return $next($request);
       }else { 


        return response()->json([
            'status' => 'error',           //error para mas espsecifico
            'data' => 'Acceso no autorizado, Favor de ingresar'
          ]); 

         }

         }
        }

    }else{
      return response()->json([
        'status' => 'error',           //error para mas espsecifico
        'data' => 'Acceso no autorizado, Favor de ingresar'
      ]); 

    }

    }
    }

