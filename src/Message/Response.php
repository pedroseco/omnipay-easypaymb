<?php

namespace Omnipay\EasypayMb\Message;

use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
	
    public function isSuccessful()
    {
        return true;
    }
	
	public function getMessage()
    {
        $data = $this->getData();
       
        return $data;
    }
	
	public function getTransactionDetails()
    {
        $data = $this->getData();
        return $data;
    }
    
}
