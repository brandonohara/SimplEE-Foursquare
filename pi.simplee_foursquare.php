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
			$this->helper = new Simplee_helper();
		}
		
		/* @TODO STILL IN DEVELOPMENT */
		public function explore(){
			$params = array();
			$params['ll'] = ee()->TMPL->fetch_param("latlng", NULL);
			$params['near'] = ee()->TMPL->fetch_param("location", NULL);
			$params['radius'] = ee()->TMPL->fetch_param("radius", 800);
			$params['query'] = ee()->TMPL->fetch_param("query", NULL);
			$params['categoryId'] = ee()->TMPL->fetch_param("category", NULL);
			$params['limit'] = ee()->TMPL->fetch_param("limit", 10);
			
			$data = $this->_request("venues/explore", $params);
			$this->helper->p($data);
		}
		
		public function search(){
			$params = array();
			$params['ll'] = ee()->TMPL->fetch_param("latlng", NULL);
			$params['near'] = ee()->TMPL->fetch_param("location", NULL);
			$params['radius'] = ee()->TMPL->fetch_param("radius", 800);
			$params['query'] = ee()->TMPL->fetch_param("query", NULL);
			$params['categoryId'] = ee()->TMPL->fetch_param("category", NULL);
			$params['limit'] = ee()->TMPL->fetch_param("limit", 10);
			
			$data = $this->_request("venues/search", $params);
			$venues = $data->response->venues;
			//echo "Total: ".count($venues);
			//$this->p($venues);
			
			$count = 0;
			$total = count($venues);
			$tagdata = ee()->TMPL->tagdata;
			
			if($total == 0)
				return ee()->TMPL->no_results();
			
			$output = '';	
			foreach($venues as $row){
				$venue = new Foursquare_venue($row);
				$venue->count = $count++;
				$venue->total_results = $total;
				$output .= ee()->TMPL->parse_variables_row($tagdata, $this->helper->flatten($venue));
			}
			return $output;
		}
		
		private function _request($segment, $params){
			$base = "https://api.foursquare.com/v2/".$segment;
			$params['v'] = 20130815;
			$params['client_id'] = FOURSQUARE_CLIENT_ID;
			$params['client_secret'] = FOURSQUARE_CLIENT_SECRET;
			$url = $base . "?" . http_build_query($params);
			return json_decode(file_get_contents($url));
		}
		
		public static function usage(){
	        return "";
	    }
	}

/* End of file pi.simplee_foursquare.php */
/* Location: ./system/expressionengine/third_party/simplee_foursquare/pi.simplee_foursquare.php */
