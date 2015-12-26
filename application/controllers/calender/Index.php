<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Calender_Controller
{
	private $layout;
	public function __construct()
	{
		parent::__construct();
		$this->layout = 'calender-layout';
	}


	public function index()
	{

		$this->viewData['_body'] = $this->load->view( $this->APP . '/list', array(), true);
		$this->render( $this->layout );
	}

	public function getList()
	{
		date_default_timezone_set('America/Los_Angeles');
		$numRows = isset($_GET['iDisplayLength']) ? intval($_GET['iDisplayLength']) : 25;
		$offset = isset($_GET['iDisplayStart']) ? intval($_GET['iDisplayStart']) : 0;
		$sortCol = isset($_GET['iSortCol_0']) ? intval($_GET['iSortCol_0']) : false;
		$sortDir = isset($_GET['sSortDir_0']) && strtolower($_GET['sSortDir_0']) == 'desc' ? 'DESC' : 'ASC';
		$search = isset($_GET['sSearch']) && !empty($_GET['sSearch']) ? preg_replace("/[^a-zA-Z0-9 @]/", "", $_GET['sSearch']) : null;

		$this->db->select("*")->from('booking');
		if (!empty($search)) {
			$this->db->where("(callid LIKE '$search%' OR room LIKE '$search%' OR day LIKE '$search%')");
		}

		$totalRows = $this->db->count_all_results();

		$this->db->select("*")->from('booking');
		if (!empty($search)) {
			$this->db->where("(callid LIKE '$search%' OR room LIKE '$search%' OR day LIKE '$search%')");
		}

		if ($numRows != -1) {
			$this->db->limit($numRows, $offset);
		}
		$this->db->order_by('id DESC');

		$rows = $this->db->get()->result();

		$result = array();
		foreach ($rows as $r) {
			$result[] = array(
				$r->id,
				$r->callid,
				$r->room,
				$r->day,
				$r->time,
				$r->period,
				date("F j, Y, g:i a", $r->book_timestamp)
			);
		}


		echo json_encode(array(
			'iTotalRecords' => $totalRows,
			'iTotalDisplayRecords' => $totalRows,
			'aaData' => $result
		));

		return;
	}

}