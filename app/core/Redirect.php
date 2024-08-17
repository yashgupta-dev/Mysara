<?php

namespace app\core;

class Redirect {
    
    private $url;
	private $ssl;
	private $rewrite = array();
	
	/**
	 * Constructor
	 *
	 * @param	string	$url
	 * @param	string	$ssl
	 *
 	*/
	public function __construct($url = BASE_URL, $ssl = '') {
		$this->url = $url;
		$this->ssl = $ssl;
	}

	/**
	 *
	 *
	 * @param	object	$rewrite
 	*/	
	public function addRewrite($rewrite) {
		$this->rewrite[] = $rewrite;
	}

	/**
	 * link
	 *
	 * @param	string		$route
	 * @param	mixed		$args
	 * @param	bool		$secure
	 *
	 * @return	string
 	*/
    public function link($route, $args = '', $secure = false) {

        if ($this->ssl && $secure) {
			$url = $this->ssl . $route;
		} else {
			$url = $this->url . $route;
		}
		
		if ($args) {
			if (is_array($args)) {
				$url .= '&amp;' . http_build_query($args);
			} else {
				$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
			}
		}
		
		foreach ($this->rewrite as $rewrite) {
			$url = $rewrite->rewrite($url);
		}
		
		return $url; 
    } 


    /**
     * encode
     *
     * @param  mixed $data
     * @return json|string|array
     */
    public static function url($url) {
        header("Location:/".$url);
        exit;
    }

}