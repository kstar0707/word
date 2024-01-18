<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_currency_model extends CI_Model {

	// --------------------------------------------------------------------

	/**
	 * Get all ref language
	 *
	 * @access public
	 * @return object
	 */
	function get_all()
	{
		$this->db->order_by('alpha', 'asc');
		return $this->db->get('ref_currency')->result();
	}

}


/* End of file ref_language_model.php */
/* Location: ./application/account/models/ref_language_model.php */