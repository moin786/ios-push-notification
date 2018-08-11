<?php

namespace peal\iosnotification;

use peal\iosnotification\Abstraction\IosAbstract;
use Aws\Credentials\Credentials;
use Aws\Sns\SnsClient;

class IosPush extends IosAbstract{
    
    /**
     * Data container
     * 
     * @var array $data
     */
    public $data = [];
    
    /**
     * Custom pay load data
     * 
     * @var array $custompayload
     */
    
    public $custompayload = [];
    
    /**
     * Badge number
     * 
     * @var int $badgecount
     */
    
    protected $badgecount = 1;
    
    /**
     * aws sns client object
     * 
     * @var object $snsclient
     */
    
    protected $snsclient;
    
    /**
     * aws client credentials
     * 
     * 
     * @var object $credentials; 
     */
    
    protected $credentials;
    
    /**
     * 
     * @param SnsClient $client
     */
    
    public function __construct(SnsClient $client) {
        
        $this->snsclient = $client;
        
    }
    
    /**
     * Notification description
     * 
     * @param string $data
     * @return $this
     * @throws \RuntimeException
     */
    
    public function notificationDescription($data) {
        
        if (is_string($data)) {
            
            $this->data['desc'] = $data;
            
            return $this;
        }
        
        throw new \RuntimeException("Title {$data} must be string");
        
    }
    
    /**
     * AWS endpoint arncode
     * 
     * @param string $data
     * @return $this
     * @throws \RuntimeException
     */
    public function awsEndPoint($data) {
        
        if (is_string($data)) {
            
            $this->data['TargetArn'] = $data;
            
            return $this;
        }
        
        throw new \RuntimeException("Title {$data} must be string");
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
        
        if ((is_string($label) 
                && is_string($value)) 
                && (isset($label) 
                && isset($value))) {
            
            $arr = [
                        'aps' => [
                            'alert' => strip_tags($this->data['desc']),
                            'badge' => $this->badgecount
                        ]
                   ];
            $this->custompayload = array_add($this->custompayload,$label,$value);
            
            $this->custompayload = array_merge($arr, $this->custompayload);
            
            return $this;
        }
        
        throw new \RuntimeException("Custom payload must be key value string");
    }
    
    /**
     * Send notification to ios app using aws sns
     * 
     * @return void
     */
    public function iosNotifiction() {
        $endpointAtt = $this->snsclient->getEndpointAttributes(
             [
                 "EndpointArn" => $this->data['TargetArn']
             ]
        );

         if ($endpointAtt != 'failed' && $endpointAtt['Attributes']['Enabled'] == "true") {

             $result = $this->snsclient->publish([
                 'TargetArn' => $this->data['TargetArn'],
                 'MessageStructure' => 'json',
                 'Message' => json_encode([
                     'default' => strip_tags($this->data['desc']),
                     'APNS' => json_encode($this->custompayload)
                 ])
             ]);
             return $result;
         }

         throw new \RuntimeException("Error in {$result}");
    }
    
    /**
     * Pay load data
     * 
     * @return $this
     * @throws \RuntimeException
     */
    
    public function payLoadData() {
        
        if (is_array($this->data)) {
            
            array_merge($this->data,$this->data);
            
            return $this;
        }
        
        throw new \RuntimeException("Invaid array");
    }
    

}
