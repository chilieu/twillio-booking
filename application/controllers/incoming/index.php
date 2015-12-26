<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Incoming_Controller
{
	private $layout;
	private $incoming_data;
	public function __construct()
	{
		parent::__construct();
		$this->layout = 'xml-layout';
		$this->incoming_data = $_REQUEST;

		//insert tracking data
		if(!empty($this->incoming_data)) {
			$data = array(
			   'callid' => $this->incoming_data['From'],
			   'digits' => $this->incoming_data['Digits']
			);
			$this->db->insert('tracking', $data);
		}
	}


	public function index()
	{
		$booking = array();
		$steps = array(
        	'step' => 'booking',
        	'next_step' => 'booking-room',
        	'booking' => $booking
       	);
		$this->session->set_userdata('steps', $steps);

		//insert incoming data
		$data = array(
		   'caller' => $this->incoming_data['From'],
		   'json_data' => json_encode($this->incoming_data)
		);
		$this->db->insert('incoming', $data);

		$this->viewData['_body'] = $this->load->view( $this->APP . '/incoming', array(), true);
		$this->render( $this->layout );
	}

	public function booking()
	{
		$step = $this->session->userdata['steps']['next_step'];

		switch ( $step ) {

			case 'booking-room':
				$booking = array();
				$booking['callid'] = $this->incoming_data['Digits'];

				$steps = array(
                	'step' => 'booking',
                	'next_step' => 'booking-date',
                	'booking' => $booking
               	);
       			$this->session->set_userdata('steps', $steps);

				$this->viewData['_body'] = $this->load->view( $this->APP . '/booking-room', array(), true);
				exit;
				break;

			case 'booking-date':
				$booking = $this->session->userdata['steps']['booking'];
				$booking['room'] = $this->incoming_data['Digits'];

				$steps = array(
                	'step' => 'booking',
                	'next_step' => 'booking-confirm',
                	'booking' => $booking
               	);
       			$this->session->set_userdata('steps', $steps);

				$this->viewData['_body'] = $this->load->view( $this->APP . '/booking-date', array(), true);
				exit;
				break;

			case 'booking-confirm':
				$booking = $this->session->userdata['steps']['booking'];

				$date = str_split( $this->incoming_data['Digits'] );
				$booking['day'] = date("Y") . "-" . $date[0].$date[1] . "-" .$date[2].$date[3];
				$booking['time'] = date("H:m:i");
				$booking['period'] = 2;
				$booking['book_timestamp'] = time();

				$steps = array(
                	'step' => 'booking',
                	'next_step' => 'booking-end',
                	'booking' => $booking
               	);
       			$this->session->set_userdata('steps', $steps);

				$this->viewData['_body'] = $this->load->view( $this->APP . '/booking-confirm', array(), true);
				exit;
				break;

			case 'booking-end':

				//if reset
				if( $this->incoming_data['Digits'] == '2' ) redirect("/incoming/index/index/");

				$booking = $this->session->userdata['steps']['booking'];
				//insert booking data
				$this->db->insert('booking', $booking);
				$this->viewData['_body'] = $this->load->view( $this->APP . '/booking-end', array(), true);
				exit;
				break;

			default:

				redirect("/incoming/index/index/");
			break;
		}


	}

}