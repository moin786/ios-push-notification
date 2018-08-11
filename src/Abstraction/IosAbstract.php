<?php

namespace peal\iosnotification\Abstraction;

use peal\iosnotification\Responsibility\IIos;

abstract class IosAbstract implements IIos
{
    
    /**
     * Notification description
     * 
     * @param string $description
     * @return $this
     * @throws \RuntimeException
     */
    
    public function notificationDescription($description) {
        
    }
    
    /**
     * AWS endpoint arncode
     * 
     * @param string $arncode
     * @return $this
     * @throws \RuntimeException
     */
    
    public function awsEndPoint($arncode) {
        
    }
    
    /**
     * Send notification to ios app using aws sns
     * 
     * @return void
     */
    
    public function iosNotifiction() {
        
    }
    
    /**
     * Custom pay load data 
     * 
     * @param string $label
     * @param string $value
     * @return $this
     * @throws \RuntimeException
     */
    

    abstract function customPayLoadData($label,$value);

    /**
     * Pay load data
     * 
     * @return $this
     * @throws \RuntimeException
     */
    
    abstract function payLoadData();
}
