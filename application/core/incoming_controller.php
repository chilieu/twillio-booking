<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Incoming_Controller extends Global_Controller
{
	protected $APP = 'incoming';
	public function __construct($theme=null)
	{
		if (empty($theme)) {
			$theme = 'incoming';
		}
		parent::__construct($theme);
	}
}