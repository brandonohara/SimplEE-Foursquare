<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require_once(PATH_THIRD."simplee_foursquare/config.simplee_foursquare.php");
	
	$plugin_info = array(
		'pi_name' 			=> SIMPLEE_FOURSQUARE_NAME,
		'pi_version' 		=> SIMPLEE_FOURSQUARE_VERSION,
		'pi_author' 		=> 'Brandon OHara',
		'pi_author_url' 	=> 'http://brandonohara.com/',
		'pi_description' 	=> '',
	    'pi_usage'        	=> Simplee_foursquare::usage()
	);

	class Simplee_foursquare {
		public $plugin_name = SIMPLEE_FOURSQUARE_NAME;
    
		public function __construct(){
			
		}
		
		public static function usage(){
	        return "";
	    }
	}

/* End of file pi.simplee_foursquare.php */
/* Location: ./system/expressionengine/third_party/simplee_foursquare/pi.simplee_foursquare.php */
