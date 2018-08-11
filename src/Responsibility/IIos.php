<?php

namespace peal\iosnotification\Responsibility;

interface IIos 
{
    /**
     * Notification description
     * 
     * @param string $description
     * @return $this
     * @throws \RuntimeException
     */
    
    public function notificationDescription($description);
    
    /**
     * AWS endpoint arncode
     * 
     * @param string $arncode
     * @return $this
     * @throws \RuntimeException
     */
    
    public function awsEndPoint($arncode);
    
    /**
     * Send notification to ios app using aws sns
     * 
     * @return void
     */
    
    public function iosNotifiction();
}