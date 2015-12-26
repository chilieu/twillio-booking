<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calender_Controller extends Global_Controller
{
	protected $APP = 'calender';
	public function __construct($theme=null)
	{
		if (empty($theme)) {
			$theme = 'calender';
		}
		parent::__construct($theme);
	}
}