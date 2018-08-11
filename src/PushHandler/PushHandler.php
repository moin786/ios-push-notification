<?php

namespace peal\iosnotification\PushHandler;

use peal\iosnotification\Abstraction\IosAbstract;

class PushHandler
{
    /**
     * peal\iosnotification\Abstraction\IosAbstract object container
     * 
     * @var object $iospush 
     */
    protected $iospush;
    
    /**
     * PushHandler construct 
     * 
     * @param IosAbstract $iospush
     */
    public function __construct(IosAbstract $iospush) {
        
        $this->iospush = $iospush;
    }
    
     /**
     * Send notification to ios app using aws sns
     * 
     * @return void
     */
    
    public function iosNotifiction() {
        
        return $this->iospush->iosNotifiction();
        
    }
    
    /**
     * AWS endpoint arncode
     * 
     * @param string $arncode
     * @return $this
     * @throws \RuntimeException
     */
    
    public function awsEndPoint($arncode){
        
        return $this->iospush->awsEndPoint($arncode);
        
    }
    
    /**
     * Notification description
     * 
     * @param string $description
     * @return $this
     * @throws \RuntimeException
     */
    
    public function notificationDescription($description) {
        
        return $this->iospush->notificationDescription($description);
        
    }
    
    /**
     * Custom pay load data 
     * 
     * @param string $label
     * @param string $value
     * @return $this
     * @throws \RuntimeException
     */
    
    public function customPayLoadData($label,$value) {
        
        return $this->iospush->customPayLoadData($label,$value);
        
    }
    
    /**
     * Pay load data
     * 
     * @return $this
     * @throws \RuntimeException
     */
    
    public function payLoadData() {
        
        return $this->iospush->payLoadData();
        
    }
}
