<?php
namespace peal\iosnotification;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Aws\Credentials\Credentials;
use Aws\Sns\SnsClient;
use Illuminate\Support\ServiceProvider;
use peal\iosnotification\PushHandler\PushHandler;

class IosServiceProvider extends ServiceProvider {
    
    /**
     * Register our IosPush service
     */
    public function register() {
        
        $this->registerIosPush();
        
    }
    
    
    /**
     * Register IosPush Handler
     * 
     */
    protected function registerIosPush() {
        
        return $this->app->bind('IosPush', function(Container $app) {
                return new PushHandler(
                        new $app['config']['aws-config.pushIos'](
                            new SnsClient([
                                'version' => 'latest',
                                'region' => 'us-west-2',
                                'credentials' => new Credentials(
                                    $app['config']['aws-config.SNS_ACCESS_KEY'], 
                                    $app['config']['aws-config.SNS_SECRET_KEY']
                                )
                        ])
                            
                ));
        });
        
        $this->app->alias('IosPush', PushHandler::class);
    }
    
    
    /**
     * Setup the application configuration
     * 
     */
    protected function setupConfig()
    {
        $config_source = realpath(__DIR__.'/../config/aws-config.php');
        
        // Check app instance is Laravel or lumen 
        if ($this->app instanceof LaravelApplication) {
            
            $this->publishes([
                $config_source => config_path('aws-config.php')
            ]);
            
        } elseif ($this->app instanceof LumenApplication) {
            
            $this->app->configure('aws-config');
            
        }
        $this->mergeConfigFrom($config_source, 'aws-config');
    }
    
    /*
     * Load routes if needed from package
     * 
     * 
     */
    protected function loadRoute() {
        
        require __DIR__ . '/routes.php';
        
    }
    
    /**
    * Application boot option
    **/

    public function boot(){
          
          $this->setupConfig();
          
          $this->loadRoute();
    }
    
    /**
     * Service name
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'IosPush'
        ];
    }
}
