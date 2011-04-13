<?php 

/*******************************************************************************
 *                      PHP Mobile Redirect Class
 *******************************************************************************/
class mobile_redirect {
    
	var $iphone;
	var $ipad;
	var $android;
	var $opera;
	var $blackberry;
	var $palm;
	var $windows;
	     
	var $mobile_redirect;  // will send the user 
	var $homepage;

 
	function mobile_redirect() {    
	   // initialization constructor.  Called when class is created.   
	   $this->mobile_redirect = '';
   	 $this->homepage = '';
	}

	/**
	 * Function to clear the do not redirect cookie.
	 */
	function _clear_cookie() {
	  setcookie("nomobi", "", time()-3600);
	  header('Location: '.$this->mobile_redirect);
	}

	/**
	 * Function to set the do not redirect cookie.
	 */
	function _set_cookie() {
	  $expire=time()+60*60*24*30;
	  setcookie("nomobi", "yes", $expire);
	  header('Location: '.$this->homepage); 
	}
	
	function detect() {

	  if (isset($_GET["nomobi"])) {
	    // clear any redirect variables so the process will go to the main site.
	    $this->iphone = '';
	    $this->ipad = '';
	    $this->android = '';
	    $this->opera = '';
	    $this->blackberry = '';
	    $this->palm = '';
	    $this->windows = '';
	    $this->mobile_redirect = '';
	    _set_cookie();
	  }

	  if (isset($_COOKIE["nomobi"])) {
	    $this->iphone = '';
	    $this->ipad = '';
	    $this->android = '';
	    $this->opera = '';
	    $this->blackberry = '';
	    $this->palm = '';
	    $this->windows = '';
	    $this->mobile_redirect = '';
	  }
	
	  // set mobile_browser as false till we can prove otherwise
	  $is_mobile_browser = false;
	  // get the user agent
	  $user_agent	= $_SERVER['HTTP_USER_AGENT']; 
	  // get the content accept
	  $httpaccept = $_SERVER['HTTP_ACCEPT']; 

	  // using a switch to check for the user agent, smoother than a searies of if's
	  switch (TRUE) {

	    // find the word ipad in the user agent
	    case (preg_match('/ipad/i',$user_agent)): 
	      $is_mobile_browser = $this->ipad; 
	      // Is there a URL to redirect iPads to?
	      if(substr($this->ipad,0,4)=='http') { 
	        $this->mobile_redirect = $this->ipad; 
	      } 
	      break; 

	    // find the word iphone in the user agent
	    case (preg_match('/ipod/i',$user_agent)||preg_match('/iphone/i',$user_agent)): 
	      $is_mobile_browser = $this->iphone; 
	      // Is there a URL to redirect iPhones to?
	      if(substr($this->iphone,0,4)=='http') { 
	        $this->mobile_redirect = $this->iphone; 
	      } 
	      break; 

	    // we find android in the user agent
	    case (preg_match('/android/i',$user_agent)):
	      $is_mobile_browser = $this->android; 
	      // Is there a URL to redirect android to?
	      if(substr($this->android,0,4)=='http') { 
	        $this->mobile_redirect = $this->android; 
	      } 
	      break; 

	    // we find opera mini in the user agent
	    case (preg_match('/opera mini/i',$user_agent)):
	      $is_mobile_browser = $this->opera; 
	      // Is there a URL to redirect opera to?
	      if(substr($this->opera,0,4)=='http') {
	        $this->mobile_redirect = $this->opera; 
	      } 
	      break; 

	    // we find blackberry in the user agent
	    case (preg_match('/blackberry/i',$user_agent)): 
	      $is_mobile_browser = $this->blackberry; 
	      // Is there a URL to redirect blackberry to?
	      if(substr($this->blackberry,0,4)=='http') { 
	        $this->mobile_redirect = $this->blackberry; 
	      } 
	      break; 

	    // we find palm os in the user agent 
	    case (preg_match('/(pre\/|palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine)/i',$user_agent)): 
	      $is_mobile_browser = $this->palm; 
	      // Is there a URL to redirect Plam to?
	      if(substr($this->palm,0,4)=='http') { 
	        $this->mobile_redirect = $this->palm; 
	      }
	      break; 

	    // we find windows mobile in the user agent - the i at the end makes it case insensitive
	    case (preg_match('/(iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile)/i',$user_agent)): 
	      $is_mobile_browser = $this->windows; 
	      if(substr($this->windows,0,4)=='http') { 
	        $this->mobile_redirect = $this->windows; 
	      } 
	    	break; 

	    // check if any of the values listed create a match on the user agent - these are some of the most common terms used in agents to identify them as being mobile devices 
	    case (preg_match('/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320|vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|psp|treo)/i',$user_agent)): 
	      $is_mobile_browser = true; 
	      break;  

	    // is the device showing signs of support for text/vnd.wap.wml or application/vnd.wap.xhtml+xml
	    case ((strpos($httpaccept,'text/vnd.wap.wml')>0)||(strpos($httpaccept,'application/vnd.wap.xhtml+xml')>0)): 
	      $is_mobile_browser = true; 
	    	break; 

	    // is the device giving us a HTTP_X_WAP_PROFILE or HTTP_PROFILE header - only mobile devices would do this
	    case (isset($_SERVER['HTTP_X_WAP_PROFILE'])||isset($_SERVER['HTTP_PROFILE'])): 
	      // set mobile browser to true
	      $is_mobile_browser = true; 
	    	break; 

	    default:
	      // set mobile browser to false
	      $is_mobile_browser = false; 
	  		break; 
	  // ends the switch 
	  } 

	  if ($is_mobile_browser == '') {
	    $is_mobile_browser = false;
	  }
	
	  // if redirect (either the value of the mobile or desktop redirect depending on the value of $is_mobile_browser) is true redirect else we return the status of $is_mobile_browser
	  if($redirect = ($is_mobile_browser==true) ? $this->mobile_redirect : '') {
	    // redirect to the right url for this device
	    header('Location: '.$redirect);
	    exit;
	  }
	} 

   
 }
 
