<?php

namespace Modules\KycModule\Http\Controllers\Customer;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KycModuleConstantsController extends Controller
{

  public static function formatPhone($phone){

    	if (preg_match("~^0\d+$~", $phone)) {
                 $phone = "255".substr($phone, 1);
          }
      return $phone;
    }



      public static function getOtp(){
            $characters = '1923084765';
            $charactersLength = strlen($characters);
            $randomCodes = '';
                 for ($i = 0; $i <6 ; $i++) {
                        $randomCodes .= $characters[rand(0, $charactersLength - 1)];
                     }
               return $randomCodes;
     }



   static function sendSMS($message, $phone){

         $api_key='b8db79fa59c41a23';
$secret_key = 'MThlMzhlZDk3MDhlNGI0MjVjZWMwOGU3Y2E3YTA1NDA1NzU2NTJhNGEwMGVkNDdmODViNGE4MWU1MjIwMGMxOA==';


$postData = array(
    'source_addr' => 'DAWAMKONONI',
    'encoding'=>0,
    'schedule_time' => '',
    'message' => $message,
    'recipients' => [array('recipient_id' => '1','dest_addr'=>$phone)]
);

$Url ='https://apisms.beem.africa/v1/send';

$ch = curl_init($Url);
error_reporting(E_ALL);
ini_set('display_errors', 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

$response = curl_exec($ch);

// if($response === FALSE){
//         echo $response;

//     die(curl_error($ch));
// }
// var_dump($response);
   }


   public  static function sendOtp($otp, $phone)
   {




      $message = "<#> Dawa Mkononi: Your verification code is ".$otp.". This is authentication code do not share with anyone.\nLWV2k9IBeJL";

            $api_key='b8db79fa59c41a23';
$secret_key = 'MThlMzhlZDk3MDhlNGI0MjVjZWMwOGU3Y2E3YTA1NDA1NzU2NTJhNGEwMGVkNDdmODViNGE4MWU1MjIwMGMxOA==';



$postData = array(
    'source_addr' => 'DAWAMKONONI',
    'encoding'=>0,
    'schedule_time' => '',
    'message' => $message,
    'recipients' => [array('recipient_id' => '1','dest_addr'=>$phone)]
);

$Url ='https://apisms.beem.africa/v1/send';

$ch = curl_init($Url);
error_reporting(E_ALL);
ini_set('display_errors', 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

$response = curl_exec($ch);


}
}
