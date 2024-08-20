<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsApiService
{

    private $url;
    private $Http;

    public function __construct()
    {
        $this->setApiProperties();
    }

    public function SendCode(String $phone, $verification)
    {
        return $this->post([
            'senderID' => '13201',
            'phoneNumber' => '218' . $phone,
            'message' => 'رمز التحقق: ' . $verification,
            
        ]);
    }
    public function SendCredential(String $phone, $password)
    {
        return $this->post([
            'senderID' => '13201',
            'phoneNumber' => '218' . $phone,
            'message' => 'اسم المستخدم  : ' . $phone .': كلمة المرور '.$password,
            
        ]);
    }

    public function SendPasswordOnly(String $phone, $password)
    {
        return $this->post([
            'senderID' => '13201',
            'phoneNumber' => '218' . $phone,
            'message' => 'كلمة المرور : ' . $password,
            
        ]);
    }
    
    
  



   
    

    


    public function sms_messages(String $phone,String $message)
    {
        return $this->post([
            'senderID' => '13201',
            'phoneNumber' => '218' . $phone,
            'message' => $message,
            
        ]);
    }
    // drmsg
    


    
    private function setApiProperties()
    {
        $this->url = "https://client.almasafa.ly/api/sms/send";

    }



    private function post(array $parameters)
    {
        

    //   return   Http::withHeaders([
    //         'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJodHRwOi8vc2NoZW1hcy54bWxzb2FwLm9yZy93cy8yMDA1LzA1L2lkZW50aXR5L2NsYWltcy9uYW1laWRlbnRpZmllciI6ImFuZGFsdXNiYW5rIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiQWRtaW4iLCJodHRwOi8vc2NoZW1hcy54bWxzb2FwLm9yZy93cy8yMDA1LzA1L2lkZW50aXR5L2NsYWltcy9lbWFpbGFkZHJlc3MiOiIyOEF1NzIwMTEiLCJleHAiOjE3Mjg0NjgyODgsImlzcyI6Imh0dHBzOi8vY2xpZW50LmFsbWFzYWZhLmx5IiwiYXVkIjoiaHR0cHM6Ly9jbGllbnQuYWxtYXNhZmEubHkifQ.3gb7gdkQ2FonSmSe6nSuU7g4O0JRdyUr_OoTlRaJ7uw',
    //     ])
    //     ->post($this->url, $parameters);


    return   Http::withHeaders([
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJodHRwOi8vc2NoZW1hcy54bWxzb2FwLm9yZy93cy8yMDA1LzA1L2lkZW50aXR5L2NsYWltcy9uYW1laWRlbnRpZmllciI6ImFuZGFsdXNiYW5rIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiQWRtaW4iLCJodHRwOi8vc2NoZW1hcy54bWxzb2FwLm9yZy93cy8yMDA1LzA1L2lkZW50aXR5L2NsYWltcy9lbWFpbGFkZHJlc3MiOiJ3eDVtIiwiZXhwIjoxNzMwMTA3NjA5LCJpc3MiOiJodHRwczovL2NsaWVudC5hbG1hc2FmYS5seSIsImF1ZCI6Imh0dHBzOi8vY2xpZW50LmFsbWFzYWZhLmx5In0.WLH8VYETYiq3vQuDl-yGtM2DcahVcrBLgikQe8hLTDs',
    ])
    ->post($this->url, $parameters);
    }


    
}

