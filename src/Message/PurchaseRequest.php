<?php

namespace Omnipay\EasypayMb\Message;

use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    
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
	

	/** end set/get **/

    public function getData()
    {
        return $this->getParameters();
    }

    public function sendData($data)
    {
        $result = $this->createReference($data);
        return $this->response = new Response($this, $result);
    }


	/**
	 * Creates a New Reference
	 * @param string $type ["normal", "boleto", "recurring", "moto"]
	 * @return array
	 */
	public function createReference( $parameters, $type = 'normal' )
	{

 		$options = array(
			 'ep_user' => $parameters['user'],
			 'ep_entity'=> $parameters['entity'],
			 'ep_cin'=> $parameters['cin'],
			 't_value'=> $parameters['amount'],
			 't_key'=> $parameters['tkey'],
			 's_code'=> $parameters['code'],
			 'ep_language'=> $parameters['language'],
			 'ep_country'=> $parameters['country'],
			 'ep_ref_type'=> $parameters['ref_type'],
			 'o_name'=> $parameters['oname'],
			 'o_description'=> $parameters['description'],
			 'o_obs'=> $parameters['observation'],
			 'o_mobile'=> $parameters['mobile'],
			 'o_email'=> $parameters['email']
		 );


 		switch ($type)
 		{
 			case 'boleto':
 				$options['ep_type'] = 'boleto';
 			break;
 			case 'recurring':
 				$options['ep_rec_type'] = 'yes';
 			break;
 			case 'moto':
			 	$options['ep_type'] = 'moto';
 			break;
 			default:
 			break;
 		}

		//adds to setter all options for url building
		$this->setUri($options);

		$result_reference =  $this->_xmlToArray($this->_get_contents($this->_get_uri($this->getRequestReference())));

		return $result_reference;

	}


	/**
	 * Request a Payment
	 * @param string $type ["credit-card", "recurring"]
	 * @return array
	 */
	public function requestPayment( $reference, $key, $value, $type = 'credit-card')
	{
		$this->_add_uri_param('u', $this->user);
		$this->_add_uri_param('e', $this->entity);
		$this->_add_uri_param('r', $reference);
		$this->_add_uri_param('l', $this->language);
		$this->_add_uri_param('k', $key);
		$this->_add_uri_param('v', $value);
		//@todo check this for rec payment types	
		switch ($type)
		{
			case 'recurring':
				$this->_add_uri_param('ep_rec_type', 'yes');
			break;
			default:break;
		}
                                
		return $this->_xmlToArray( $this->_get_contents( $this->_get_uri( $this->request_payment)));
	}
	
	/**
	 * Returns an array with the requested payment information
	 */
	public function getPaymentInfo( $ep_doc = false )
	{
		if(!$ep_doc)
			throw new Exception("ep_doc is required for the communication");
		
		$this->_add_uri_param('ep_user', $this->user);
		$this->_add_uri_param('ep_cin', $this->cin);
		$this->_add_uri_param('ep_doc', $ep_doc);
		
		return $this->_xmlToArray( $this->_get_contents( $this->_get_uri( $this -> request_payment_data )));
	}
        
    /**
     * Returns an array with the transaction verification
     */    
    public function getTransactionVerification( $reference )
    {
		$this->_add_uri_param('ep_cin', $this->cin);
		$this->_add_uri_param('ep_user', $this->user);
		$this->_add_uri_param('e', $this->entity);
		$this->_add_uri_param('r', $reference);
		$this->_add_uri_param('c', $this->country);
                
        return $this->_xmlToArray( $this->_get_contents( $this->_get_uri( $this->request_transaction_key_verification)));                
    }
	
	
    /**
	 * Set current working mode
	 */
	public function set_live( $boolean = false )
	{
		$this->live_mode = $boolean; 
	}
	
	/**
	 * Returns a string from a link via cUrl
	 * @param string $url
	 * @param string $type
	 * @throws Exception
	 * @return string
	 */
	private function _get_contents( $url, $type = 'GET' )
	{
	
		try {
			$curl = curl_init();
			curl_setopt( $curl, CURLOPT_URL, $url );
			curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, 5 );
			if ( strtoupper( $type ) == 'GET' ) {
				//curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
			} elseif ( strtoupper( $type ) == 'POST' ) {
				curl_setopt( $curl, CURLOPT_POST, TRUE );
			} else {
				throw new Exception('Communication Error, standart communication not selected, POST or GET required');
			}
			
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE );
			$result = curl_exec( $curl );
			curl_close($curl);
		} catch( Exception $e ) {
			$result = false;
		}            
		

		$this->_log['contents'] = $result;
		return $result;
	}
	
	/**
	 * Returns an array from and xml formated string
	 * @param string $string
	 * @return array
	 */
	private function _xmlToArray( $string )
	{
		try {
			$obj 	= simplexml_load_string( $string );
			$data 	= json_decode( json_encode( $obj ), true );
		} catch( Exception $e ) {
			$data = false;
		}
		
		$this->_log['contents_array'] = $data;
		return $data;
	}
	
	/**
	 * Adds a parameter to our URI
	 * @param string $key
	 * @param string $value
	 */
	private function _add_uri_param( $key, $value )
	{
		$this->uri[$key] = $value;
	}
	
	/**
	 * Returns and clears the URI
	 * @param string $endPoint
	 * @return string
	 */
	private function _get_uri( $endPoint )
	{
		if($this->getLivemode())
		{
			$str = $this->getProductionServer();
		} else {
			$str = $this->getTestServer();
		}
		
		$str .= $endPoint;
		
		$tmp = str_replace(' ', '+', http_build_query( $this->getUri() ) );
		$this->_log['params']	= $this->getUri();
		$this->setUri(array());
		
		$this->_log['url'] 	= $str . '?' . $tmp;

		return $str . '?' . $tmp;
	}
	
	/**
	 * Returns the last operation logs
	 * @return array
	 */
	public function logs(){
		return $this -> _log;
	}


}
