<?php
namespace Omnipay\EasypayMb;

use Omnipay\Common\AbstractGateway;

/**
 * EasypayMb
 *
 * @link http://www.easypay.pt
 */
class Gateway extends AbstractGateway
{

    public function getName()
    {
        return "EasypayMb";
    }


    public function getDefaultParameters()
    {
        return array(
            'request_reference' => 'api_easypay_01BG.php',
            'request_payment' => 'api_easypay_05AG.php',
            'request_payment_data' => 'api_easypay_03AG.php',
            'request_payment_list' => 'api_easypay_040BG1.php',
            'request_transaction_key_verification' => 'api_easypay_23AG.php',
            'modify_payment' => 'api_easypay_00BG.php',
            'test_server' => 'http://test.easypay.pt/_s/',
            'production_server' => 'https://www.easypay.pt/_s/',
            'uri' => array(),
            'live_mode' => false,
            'country' => 'PT',
            'language'=> 'PT',
            'ref_type'=> 'auto',
            'user'=>'',
            'cin'=>'',
            'entity'=>'',
            'oname'=>'',
            'description'=>'',
            'observation'=>'',
            'mobile'=>'',
            'email'=>'',
            'amount'=>'',
            'tkey'=>'',
            'code'=>null,
            'scode'=>null,
            '_log'=> array()
        );
    }

	public function getRequestReference()
    {
        return $this->getParameter('request_reference');
    }

	public function setRequestReference($value)
    {
        return $this->setParameter('request_reference',$value);
    }

    public function getProductionServer()
    {
        return $this->getParameter('production_server');
    }

	public function setProductionServer($value)
    {
        return $this->setParameter('production_server',$value);
    }

    public function getTestServer()
    {
        return $this->getParameter('test_server');
    }

	public function setTestServer($value)
    {
        return $this->setParameter('test_server',$value);
    }

    public function getUser()
    {
        return $this->getParameter('user');
    }

    public function setUser($value)
    {
        return $this->setParameter('user', $value);
    }

    public function getEntity()
    {
        return $this->getParameter('entity');
    }

    public function setEntity($value)
    {
        return $this->setParameter('entity', $value);
    }

    public function getCin()
    {
        return $this->getParameter('cin');
    }

    public function setCin($value)
    {
        return $this->setParameter('cin', $value);
    }

    public function getReftype()
    {
        return $this->getParameter('ref_type');
    }

    public function setReftype($value)
    {
        return $this->setParameter('ref_type', $value);
    }

    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    public function getCountry()
    {
        return $this->getParameter('country');
    }

    public function setCountry($value)
    {
        return $this->setParameter('country', $value);
    }

    public function getLivemode()
    {
        return $this->getParameter('live_mode');
    }

    public function setLivemode($value)
    {
        return $this->setParameter('live_mode', $value);
    }

    public function getTkey()
    {
        return $this->getParameter('tkey');
    }

    public function setTkey($value)
    {
        return $this->setParameter('tkey', $value);
    }

    public function getCode()
    {
        return $this->getParameter('code');
    }

    public function setCode($value)
    {   
        return $this->setParameter('code', $value);
    }

    public function getObservation()
    {
        return $this->getParameter('observation');
    }

    public function setObservation($value)
    {
        return $this->setParameter('observation', $value);
    }


    public function getOname()
    {
        return $this->getParameter('oname');
    }

    public function setOname($value)
    {
        return $this->setParameter('oname', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getMobile()
    {
        return $this->getParameter('mobile');
    }

    public function setMobile($value)
    {
        return $this->setParameter('mobile', $value);
    }

    public function getUri()
    {
        return $this->getParameter('uri');
    }

    public function setUri($value)
    {
        return $this->setParameter('uri', $value);
    }

    public function purchase(array $parameters = array())
    {
        
        return $this->createRequest('\Omnipay\EasypayMb\Message\PurchaseRequest', $parameters);
    }


    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\EasypayMb\Message\CompletePurchaseRequest', $parameters);
    }

}
