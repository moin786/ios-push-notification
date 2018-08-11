# ios-push-notification
<h1 align="center">Ios push notification in Laravel using AWS sns</h1>

<p align="center">
    Amazon Simple Notification Service (SNS) is a flexible, fully managed pub/sub messaging and mobile notifications service for coordinating the delivery of messages to subscribing endpoints and clients. With SNS you can fan-out messages to a large number of subscribers, including distributed systems and services, and mobile devices. It is easy to set up, operate, and reliably send notifications to all your endpoints – at any scale. You can get started using SNS in a matter of minutes using the AWS Management Console, AWS Command Line Interface, or using the AWS SDK with just three simple APIs. SNS eliminates the complexity and overhead associated with managing and operating dedicated messaging software and infrastructure.
</p>

## Installation

Inside your project root directory, open your terminal

```shell
composer require peal/ios-push-notification
```

Composer will automatically download all dependencies.

#### For Laravel

After complete the installation, open your app.php from config folder, paste below line inside providers array 

```php
peal\iosnotification\IosServiceProvider::class,
```

For Facade support, paste below line inside aliases array

```php
'IosPush' => peal\iosnotification\IosPush::class,
```

Then run this command

```shell
php artisan vendor:publish --provider="peal\iosnotification\IosServiceProvider"
```
After vendor published check your config folder aws-config.php is created.

```php
/*
 * AWS config file
 * 
 */

return [
    'SNS_ACCESS_KEY'  => 'YOUR-SNS-ACCESS-KEY',
    'SNS_SECRET_KEY'  => 'YOUR-SNS-SECRET-KEY',
    'SNS_APP_ARN'  => 'YOUR-SNS-APP-APN',
    'pushIos' => peal\iosnotification\IosPush::class,
];
```

### USAGES 

```php
try {
    $ios = \App::make('IosPush');
        $data = [ 
                    'desc' => 'Ios push description',
                    'TargetArn' => "AWS ENPOINT(AFTER INSTALL APP IN YOUR MOBILE AN END POINT NUMBER IS GENERATED)",
                ];


        return $ios->notificationDescription($data['desc'])
                ->awsEndPoint($data['TargetArn'])
                ->customPayLoadData("type", "Ios Push")
                ->customPayLoadData("cityid", "170")
                ->payLoadData()
                ->iosNotifiction();
} catch(\Exception $e) {
    return $e->getMessage();
}
```
### Using Facades

```php
use IosPush;

try {
    $data = [ 
                'desc' => 'Ios push description',
                'TargetArn' => "AWS ENPOINT(AFTER INSTALL APP IN YOUR MOBILE AN END POINT NUMBER IS GENERATED)",
            ];
                    
        
    return IosPush::notificationDescription($data['desc'])
            ->awsEndPoint($data['TargetArn'])
            ->customPayLoadData("type", "Ios Push")
            ->customPayLoadData("cityid", "170")
            ->payLoadData()
            ->iosNotifiction();
} catch(\Exception $e) {
    return $e->getMessage();
}

```

### For core php
```php
    
    use peal\iosnotification\PushHandler\PushHandler;
    use peal\iosnotification\IosPush;
    use Aws\Credentials\Credentials;
    use Aws\Sns\SnsClient;
    try {

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
                ->customPayLoadData("type", "Ios Push")
            	->customPayLoadData("cityid", "170")
            	->payLoadData()
                ->iosNotifiction();
} catch(\Exception $e) {
    return $e->getMessage();
}
```
### More tutorial from
[AWS sns](https://docs.aws.amazon.com/sns/latest/dg/welcome.html)
### Author

[Mohammed Minuddin(Peal)](https://moinshareidea.wordpress.com)

