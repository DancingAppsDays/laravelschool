<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Alumno;
use App\Models\Profesor;

use Illuminate\Support\Facades\Hash;  //lav8 docs?

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use Validator;

use Exception;

use Symfony\Component\Console\Output\ConsoleOutput;



class AuthController extends Controller
{
    private $apiToken;

    public function __construct()
     {
     $this->apiToken = uniqid(base64_encode(Str::random(100)));
     }



       //rooll key 
    public function rollnewkey()
    {
     do{ $this->apiToken = str_random(44);
 
     }while($this->where('remember_token', $this->apitoken)->exist());
     $this->save();
     
    }
 

    public function loginnohash(Request $request){


        

      $user = User::where([
        'email' => $request->email, 
        'password' => $request->password
    ])->first();
    
    if($user)
    {
        Auth::login($user);


        $user = auth()->user();
      
    //Setting login response 
    $success['access_token'] = $this->apiToken;      //sends error wihtout token
    $success['name'] = $user->username;
    $success['usertype'] = 'Admin';
    $success['userId'] = $user->id;
   
    $user->apitoken = $this->apiToken;  

     
    $user->save();

    $success['status'] = 'success';
      return response()->json([
        'status' => 'success',
        'data' => $success
      ]); 








    }else{

      $user = Alumno::where([
        'email' => $request->email, 
        'password' => $request->password
    ])->first();

    if($user)
    {
       //return "Alumno found";
        Auth::login($user);


        $user = auth()->user();

       // $output = new ConsoleOutput();
     // $output->writeln($user2);
      
    //Setting login response 
    $success['access_token'] = $this->apiToken;      //sends error wihtout token
    $success['name'] = $user->fullName;
    $success['userId'] = $user->id;
    $success['usertype'] = 'Student';
    $user->apitoken = $this->apiToken;  

     
    $user->save();

    $success['status'] = 'success';

      return response()->json([
        'status' => 'success',
        'data' => $success
        //$success

      ]); 






    }else{

      $user = Profesor::where([
        'email' => $request->email, 
        'password' => $request->password
    ])->first();

    if($user)
    {
       
        //return "Profesor found";
        Auth::login($user);


        $user = auth()->user();
      
    //Setting login response 
    $success['access_token'] = $this->apiToken;      //sends error wihtout token
    $success['name'] = $user->fullName;
    $success['usertype'] = 'Profesor';
    $success['userId'] = $user->id; 
   
    $user->apitoken = $this->apiToken;  

     
    $user->save();

    $success['status'] = 'success';
      return response()->json([
        'status' => 'success',
        'data' => $success
      ]); 





    }else{


       return response()->json([
        'status' => 'error',
        'message' => "El correo y password no coinciden"
      ]); 

    }


    }



    }
  }




    public function login(Request $request){ 
     
        
      //print_r("12341234");//print in page
     // $output = new ConsoleOutput();
     // $output->writeln('Converting of 50000');

      
      //$passo = $request->password;
      //$passo= Hash::make( $request->password);

     
      
    
      if(Auth::attempt( $request->only(['password', 'email'])))  //Auth::login($user))//
      {
   
    //print_r("passed authattemp....");

    

      $user = auth()->user();
      //return $user;
      //$user2 = auth()->Alumno();
      $output = new ConsoleOutput();
       $output->writeln("LOGGIGINGGG");// ,  $user);

    //Setting login response 
    $success['token'] = $this->apiToken;      //sends error wihtout token
    $success['name'] = $user->name;
 
   
    //$user->apitoken = $this->apiToken;  

     
    $user->save();

    
      return response()->json([
        'status' => 'success',
        'data' => $success
      ]); 
 
 
        } else  if (Auth::guard('alumno')->attempt(['email' => $request->email, 'password' => 
        $request->password], $request->remember)) {
    
        $output = new ConsoleOutput();
        $output->writeln("                Booya nish");
    
        $user = auth()->user();
    
        $output->writeln("                Autyhhuser");
        return 12341234;

        }   else  if (Auth::guard('profesor')->attempt(['email' => $request->email, 'password' => 
        $request->password], $request->remember)) {

        $output = new ConsoleOutput();
        $output->writeln("               profesor found");

        $user = auth()->user();

        $output->writeln("                Auth profesor");
      return 12341234;

    } else{
      
      //authlogin fauled
      return response()->json([    //(['error' => 'Email or password does\'t exist'], 401);
        'status' => 'error',
        'data' => 'Unauthorized Access',
        'error' => 'Email y password no coinciden222'//, // 401
      ]); 
    }
   }







   public function register(Request $request) 
   { 
     /*
     $validator = Validator::make($request->all(), [ 
       'name' => 'required', 
       'email' => 'required|email', 
       'password' => 'required', 
       
     ]);
     if ($validator->fails()) { 
       return response()->json(['error'=>$validator->errors()]);
     }*/
      //lav 8
     //$hashed = Hash::make('password', [
     // 'rounds' => 12,
  //]);

  

  $postArray = $request->all();                                                   //lav5.4
   //  $postArray['password'] = bcrypt($postArray['password']);      //withoutthis auth faileeeed1!!
     
     

     //$user = User::create($request); 

     try{

      $user = User::create($postArray); 
     
     
      //Auth::login($user,true);    //autenticate new user instance.... //crea remember token
 
          //ADD???
     //$success['token'] = $this->apiToken;  
     //$success['name'] =  $user->name;
 
     

        //ADD
     //$user->update(['apitoken' => $sucess['token']   ]);  //trouble??
     //$user->update(array('apitoken' => $sucess['token']));
     

      //ADDD
     //$user->apitoken =  $success['token'];//name = 'FFUCKKK UU';//apitoken = $sucess['token'];        //this was crashing but... why

     


      //$user->save();
      
      return response()->json([
        'status' => 'success',
        'message' => 'Usuario registrado con éxito',
        
    ]);

    }catch(Exception $e){

      return response()->json([ 
        'status' => 'error',
        'data' => 'Unauthorized Access',
        'error' => 'Falló el registro'
      ]); 
    }
   }
 

    
   public function registerA(Request $request) 
   { 
      

  $postArray = $request->all();                                                   //lav5.4
     //$postArray['password'] = bcrypt($postArray['password']);      //withoutthis auth faileeeed1!!
     
     

     //$user = User::create($request); 

     try{

      $user = Alumno::create($postArray); 
     
         $output = new ConsoleOutput();
      $output->writeln($user);


      //Auth::login($user,true);    //autenticate new user instance.... //crea remember token
 
          //ADD???
     //$success['token'] = $this->apiToken;  
    // $success['name'] =  $user->name;
 
     

        //ADD
     //$user->update(['apitoken' => $sucess['token']   ]);  //trouble??
     //$user->update(array('apitoken' => $sucess['token']));
     

      //ADDD
     //$user->apitoken =  $success['token'];//name = 'FFUCKKK UU';//apitoken = $sucess['token'];        //this was crashing but... why

     


      //$user->save();
      
      return response()->json([
        'status' => 'success',
        'message' => 'Alumno registrado con éxito',
        
    ]);

    }catch(Exception $e){

      return response()->json([ 
        'status' => 'error',
        'data' => 'Unauthorized Access',
        'error' => 'Falló el registro'
      ]); 
    }
   }
 

   public function registerP(Request $request) 
   { 
      

  $postArray = $request->all();                                                   //lav5.4
    // $postArray['password'] = bcrypt($postArray['password']);      //withoutthis auth faileeeed1!!
     
     

     //$user = User::create($request); 

     try{

      $user = Profesor::create($postArray); 
     
       


     // Auth::login($user,true);    //autenticate new user instance.... //crea remember token
 
          //ADD???
     //$success['token'] = $this->apiToken;  
     //$success['name'] =  $user->name;
 
     

        //ADD
     //$user->update(['apitoken' => $sucess['token']   ]);  //trouble??
     //$user->update(array('apitoken' => $sucess['token']));
     

      //ADDD
     //$user->apitoken =  $success['token'];//name = 'FFUCKKK UU';//apitoken = $sucess['token'];        //this was crashing but... why

     


     // $user->save();
      
     return response()->json([
      'status' => 'success',
      'message' => 'Profesor registrado con éxito',
      
  ]);

    }catch(Exception $e){

      return response()->json([ 
        'status' => 'error',
        'data' => 'Unauthorized Access',
        'error' => 'Falló el registro'
      ]); 
    }
   }
 













   public function logout(Request $request)
   {
     

    $headertoken = $request->header('Authorization');
    $token = null;
    $token = substr($headertoken,13); 

    $api = User::where('apitoken', '=', $token)->first();

      $api->apitoken  = null;
      $api->save();
      //Auth::logout();
 
     return response()->json(['status'=> 'success']);// 'Cerró sesión con éxito']);
   }
}





