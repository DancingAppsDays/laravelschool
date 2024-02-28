<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preregistro;

use Symfony\Component\Console\Output\ConsoleOutput;

use Notification;
use App\Notifications\EmailPreregistroNotification;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailPreregistro;


class PreregistroController extends Controller
{
    public function store(Request $request)
    {
        //
         // $output = new ConsoleOutput();
    // $output->writeln($request);

        $as = Preregistro::create($request->all());

          // $output = new ConsoleOutput();
 //$output->writeln($as);
 //$output->writeln($as->name);
 //$output->writeln($as->email);

       self::sendWelcomeEmail($as->name,$as->email);
       self::sendNotificationEmail($as->name,$as->email,$as->phone);
        
        return response()->json([
          'status' => 'success',
          'mensaje' => 'Curso registrado con éxito',
          'data' => $as
      ]);

        }

    public function showall(){
        $as = Preregistro::select('id','name','phone','email','created_at')->orderBy('created_at', 'desc')->get(); //paginate(25);  //::all() //groupby('created_at')
        return response()->json([
            'status' => 'success',
            'mensaje' => 'Lista de preregistros recuperada con èxito',
            'data' => $as
        ]);
    }


    public function show($id) //for individual resource
    {
        //          //model
        $as = Preregistro::where('id','=',$id)->first();   //mejor findor fail     //was get(), pero da como resultado un array al que hay que acceder con data['data'][0]

        return response()->json([
            'status' => 'success',
            'mensaje' => 'Registro recuperado con éxito',
            'data' => $as
        ]);
    }
       
  

    public function showfirst(){
        $as = Preregistro::first(); //paginate(25);  //::all() //groupby('created_at')
        return response()->json([
            'status' => 'success',
            'mensaje' => 'Lista de preregistros recuperada con èxito',
            'data' => $as
        ]);
    }


    public function send(){

       $user = \App\Models\User::find(1);
        $project = [
            'greeting' => 'Hi ' , //.$user->name.',',
            'body' => 'This is the project assigned to you.',
            'thanks' => 'Thank you this is from codeanddeploy.com',
            'actionText' => 'View Project',
            'actionURL' => url('/'),
            'id' => 57
        ];
        Notification::send($user, new EmailPreregistroNotification($project));
    }

    public function sendWelcomeEmail($name,$email)
    {
        $title = 'Preregistro en el CIET';
        $body = 'Hola '.$name.' Gracias por registrarte en el CIET, te mantendremos informado de las actividades que realizamos. Saludos.';

        Mail::to($email)->send(new MailPreregistro($title, $body));

       // return "Email sent successfully!";
    }

    public function sendNotificationEmail($name,$email,$phone)
    {
        $title = 'Nuevo preregistro en el sistema';
        $body = "Hay un nuevo preregistro en el sistema:\nNombre:".$name."\nTel: ".$phone."\nEmail: ".$email."\nRevisa el sistema para más detalles. Saludos.";

        Mail::to('etrac.ciet@gmail.com')->send(new MailPreregistro($title, $body));

       // return "Email sent successfully!";
    }


}
