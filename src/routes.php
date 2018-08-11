<?php

/**
 * Can use route from here
 */
//use peal\iosnotification\Facades\IosPush;

use peal\iosnotification\PushHandler\PushHandler;
use peal\iosnotification\IosPush;
use Aws\Credentials\Credentials;
use Aws\Sns\SnsClient;

Route::get("/testIos",function(){
    
    try {
    //Using core php
    $pios = new PushHandler(new IosPush(
                new SnsClient([
                        'version' => 'latest',
                        'region' => 'us-west-2',
                        'credentials' => new Credentials(
                            config('aws-config.SNS_ACCESS_KEY'), 
                            config('aws-config.SNS_SECRET_KEY')
                        )
                ])
            ));
    $data = [ 
                'desc' => 'Ios push description',
                'TargetArn' => "AWS ENPOINT(AFTER INSTALL APP IN YOUR MOBILE AN END POINT NUMBER IS GENERATED)",
            ];
    return $pios->notificationDescription($data['desc'])
                ->awsEndPoint($data['TargetArn'])
                ->payLoadData()
                ->customPayLoadData("type","Ios Push") //can anyting
                ->customPayLoadData("cityid","170") // can anything
                ->customPayLoadData("City Name","Dhaka") //can anyting
                ->iosNotifiction();
    
    
    //Using Facades
    
    $data = [ 
                'desc' => 'Ios push description',
                'TargetArn' => "AWS ENPOINT(AFTER INSTALL APP IN YOUR MOBILE AN END POINT NUMBER IS GENERATED)",
            ];


    //Using Facad

    return IosPush::notificationDescription($data['desc'])
            ->awsEndPoint($data['TargetArn'])
            
            ->payLoadData()
            ->customPayLoadData("type","Ios Push") //can anyting
            ->customPayLoadData("cityid","170") // can anything
            ->iosNotifiction();

    
    //OR
    //Without Facad

    $ios = \App::make('IosPush');

    return $ios->notificationDescription($data['desc'])
            ->awsEndPoint($data['TargetArn'])
            
            ->payLoadData()
            ->customPayLoadData("type","Ios Push") //can anyting
            ->customPayLoadData("cityid","170") // can anything
            ->iosNotifiction();
    } catch(\Exception $e) {
        return $e->getMessage();
    }
                
    
});
