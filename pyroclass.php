<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Body/Html class Plugin
 * This plugin allows you to quickly get css classes for styling individually pages.
 * Usage:
 * <html class="{{ pyroclass:classes }}"> or <body class="{{ pyroclass:classes }}">
 *
 * @author		webbear.ch
 * 
 * @copyright	Copyright (c) 2012 - 2014, webbbear.ch
 */
class Plugin_Pyroclass extends Plugin
{
	/**
	 * classes - getting the uri segments and user agents and  return them as css classes
	 * 
	 * @return string
	 */
	function classes()
	{
		$body_class ='';
		
		$classes = array();
		$segments = $this->uri->total_segments();
		$is_home = '';

		// no segment = it is the homepage 
		if ($this->uri->segment(1) === FALSE) {
			$is_home = 'homepage';
			$body_class .= $is_home;
		} 
		else
		{
			$segs = array();
			$segs = $this->uri->segment_array();
			for ($i = 1; $i <= $segments; $i++) 
			{
				$seg = $this->uri->segment($i);
				// if there is a number add a n to make css safe
				$classes[] = (is_numeric(substr($seg,0,1))) ? 'n'.$seg : $seg;
			}

			$output_class = implode(' ',$classes);
			$body_class .= $output_class;
		}
		
		// no let's check the user agent
		$version =  str_replace('.','-',$this->agent->version());
		$version_small = strstr($this->agent->version(), '.', true);
		$browser = strtolower($this->agent->browser());
		$ua_class = '';

		if ($browser == "safari") 
		{
			 $ua_class='safari' . ' safari'.$version_small;
		}
		elseif ($browser == "internet explorer") 
		{

			$ua_class = 'ie ' . 'ie'.$version .' ie'.$version_small;
		}
		elseif ($browser == "firefox")
		{
			$ua_class = 'firefox' . ' firefox' . $version_small;
		}
		elseif ($browser == "opera")
		{
			$ua_class = 'opera' .' opera'. $version_small;
		}
		elseif ($browser == "chrome")
		{
			$ua_class = 'chrome' .' chrome'. $version_small;
		}
		elseif ($browser == "gecko") {
			$ua_class = 'gecko' .' gecko'. $version_small;
		}
		else
		{
			$ua_class = 'undefined-ua';
		}
		// classe glued togehter
		$body_class .= ' '.$ua_class;
		
		return $body_class;
		
	}
}

/* End of file pyroclass.php */