<?php

namespace Epicsweb;

class PhpOpportunities
{

	private $framework;

	//CONSTRUCT
	public function __construct($framework = 'ci') {

		$this->framework = $framework;

	}

    //FUNÇAO QUE EXECUTA O CURL
    private function executeCurl($param) {

    	if( is_array($param) && $param['url'] && $param['data'] ) {

	    	//VERIFICA FRAMEWORK
	    	switch ($this->framework) {
	    		case 'laravel':
	    			
	    			$url 					= env('OP_URL');
	    			$param['data']['token']	= env('OP_TOKEN');

	    		break;
	    		case 'ci':
	    			
	    			//LOAD THE CONFIG FILE
	    			$ci =& get_instance();
	    			$ci->config->load('epicsweb');
			    	$url 					= $ci->config->item('op_url');
	    			$param['data']['token']	= $ci->config->item('op_token');

	    		break;
	    		default:

	    			return false;

	    		break;
	    	}

	    	//PREPARA OS DADS
	    	$url 				= $url . $param['url'];
  
	        switch ( strtolower($param['method']) ) {

	            case 'get':

	                $curl = curl_init($url);
	                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	                $curl_response = curl_exec($curl);
	                curl_close($curl);
	                return json_decode($curl_response);

	            break;
	            default:

	                $curl 			= curl_init($url);
	                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	                curl_setopt($curl, CURLOPT_POST, true);
	                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($param['data'], NULL, '&'));
	                $curl_response = curl_exec($curl);
	                curl_close($curl);
	                return json_decode($curl_response);

	            break;

	        }

	   	} else return false;

    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // MAIL
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

    //FUNCTION TO SEND A EMAIL
    public function send_opportunity($data)
    {
        return $this->executeCurl([
            'url'       => 'api/opportunity/webhook_secutiry',
            'data'      => $data,
            'method'    => 'post'
        ]);
    }
    
}