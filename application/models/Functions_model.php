<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class functions_model  extends CI_Model{
	
	function __construct(){

		parent::__construct();

	}


	/*
		@author: Dário Ribeiro de Lima
		@description: Uma função que imprime Hello World
		@type:void
		@params: - 
	*/
		public function hello_world(){

			echo "Hello World!";

		}

		public function request_to_xvideos($url = ""	){

			if($params){
			}

			$ch = curl_init("http://www.xvideos.com/$url&durf=10min_more");

			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$html = curl_exec($ch);
			curl_close($ch);
			$re = '/(alt|href|src)=("[^"]*")/'; 
			$html = preg_match_all($re, $html, $matches);
			$videos = array();
			foreach ($matches as $key => $value) {
				foreach ($value as $link) {
					if(strpos($link,"video") && !strpos($link,'jpg')){
						$link = str_replace(array('"','href','=','src','video','/0/'), array('','','','','',''), $link);
						if(strlen($link) > 3 && !empty($link)){

							$videos[] = preg_replace('/[A-Za-z\/.:]/','',substr($link,0,12));

						}
					}
				}
			}
			$videos = (array_unique($videos));
			unset($videos[0]);
			unset($videos[1]);

			$final_array = array_values($videos);



			return $final_array;
		}

		public function incorporate($link, $options = array()){
			if(!count($options)>0){
				$options['frameborder'] = 0;
				$options['width'] = 100;
				$options['height'] = 600;
				$options['scrolling'] = "yes";
			}

			$inicial = "<iframe "; 
			$src = ' src="http://flashservice.xvideos.com/embedframe/'.$link.'"';
			$frameborder = " frameborder=".$options['frameborder'];
			$width = " width=".$options['width']."%"; 
			$height = " height=".$options['height']; 
			$scrolling = " scrolling=".$options['scrolling'];
			$final = "></iframe>";

			return $inicial.$src.$frameborder.$width.$height.$scrolling.$final;

		}

		public function get_random_video($videos){
			@session_start();
			$random=rand(0,(count($videos)-3));
			if(isset($_SESSION['videos'])){

				if(!in_array($random, @$_SESSION['videos'])){			 
					$_SESSION['videos'][]=$random;
					return $this->incorporate($videos[$random]);
				}

			}
			else{
				$_SESSION['videos']=array();
			}
			return $this->get_random_video($videos);
		}

		public function dump($array){
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}
	}	