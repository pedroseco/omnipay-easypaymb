<?php

namespace Omnipay\EasypayMb\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['transStatus']) && 'Y' === $this->data['transStatus'];
    }
}
