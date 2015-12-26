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

		if(!empty($this->incoming_data['From'])) {
			$data = array(
			   'callid' => $this->incoming_data['From'],
			   'digits' => $this->incoming_data['Digits'],
			   'session_id' => session_id()
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

	public function confirmation()
	{

		$this->viewData['_body'] = $this->load->view( $this->APP . '/confirmation', array(), true);
		$this->render( $this->layout );
	}

	public function booking()
	{
		//booking confirmation
		$booking = array();
		if( $this->incoming_data['Digits'] == '2' ) redirect("/incoming/index/confirmation/");
		if( $this->incoming_data['Digits'] == '*' ) redirect("/incoming/index/");

		$step = $this->session->userdata['steps']['next_step'];

		switch ( $step ) {

			case 'booking-room':
				$booking['callid'] = $this->incoming_data['From'];

				$steps = array(
                	'step' => 'booking',
                	'next_step' => 'booking-date',
                	'booking' => $booking
               	);
       			$this->session->set_userdata('steps', $steps);

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

				break;

			case 'booking-end':

				//if reset
				if( $this->incoming_data['Digits'] == '2' ) redirect("/incoming/index/index/");

				$booking = $this->session->userdata['steps']['booking'];
				//insert booking data
				$this->db->insert('booking', $booking);
				break;

			default:

				redirect("/incoming/index/index/");
			break;
		}
			$this->viewData['_body'] = $this->load->view( $this->APP . '/' . $step, array('booking' =>$booking), true);
			$this->render( $this->layout );


	}

}
