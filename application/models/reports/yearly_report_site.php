<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Yearly_report_site extends CI_Model {
	
	function get_total_checkup_by_user_site($user_id)
	{
	$query="SELECT DISTINCT eh_site_user_map.project_id AS project_id
  FROM eh_site_user_map eh_site_user_map
 WHERE (eh_site_user_map.user_id = ".$user_id.")";
 $result_set=$this->db->query($query);
 
	 foreach($result_set->result() as $result) 
	 {
		$ids[]=$result->project_id;
	 }
 
 	$comma_separated = implode(",", $ids);

	$sql="SELECT count(*) as year_checkup_in_the_year
  FROM    eh_patient_checkup eh_patient_checkup
       INNER JOIN
          eh_site_user_map eh_site_user_map
       ON (eh_patient_checkup.user_id = eh_site_user_map.user_id)
 WHERE  eh_site_user_map.project_id IN(".$comma_separated.")";
	
	$result_set=$this->db->query($sql);
 	return $result_set->row()->year_checkup_in_the_year; 	
	
	}
	
	function get_yearwise_total_checkup_by_user_site($valyear,$user_id)
	{
	$query="SELECT DISTINCT eh_site_user_map.project_id AS project_id
  FROM eh_site_user_map eh_site_user_map
 WHERE (eh_site_user_map.user_id = ".$user_id.")";
 $result_set=$this->db->query($query);
 
	 foreach($result_set->result() as $result) 
	 {
		$ids[]=$result->project_id;
	 }
 
 	$comma_separated = implode(",", $ids);

	$sql="SELECT count(*) as year_checkup_in_the_year
  FROM    eh_patient_checkup eh_patient_checkup
       INNER JOIN
          eh_site_user_map eh_site_user_map
       ON (eh_patient_checkup.user_id = eh_site_user_map.user_id)
 WHERE (Year(eh_patient_checkup.checkup_date) = '".$valyear."') AND eh_site_user_map.project_id IN(".$comma_separated.")";
	
	$result_set=$this->db->query($sql);
 	return $result_set->row()->year_checkup_in_the_year; 
		
	}
	
	
	function get_checkup()
	{
		$this->db->select("YEAR(eh_patient_checkup.checkup_date) AS year_val, COUNT(eh_patient_checkup.checkup_id) AS total_checkpu");
		//$this->db->select("YEAR(eh_patient_checkup.checkup_date) AS year_val");
		//$this->db->select("YEAR(eh_patient_checkup.checkup_date) AS year_val");
		$this->db->from('eh_patient_checkup');
		//$this->db->join('eh_site_user_map', 'eh_patient_checkup.user_id = eh_site_user_map.user_id');
		//$this->db->where('eh_patient_checkup.checkup_date >=', '2013-01-01 00:00:00.000000');
		//$this->db->where('eh_site_user_map.project_id', 26);		
		$this->db->group_by('YEAR(eh_patient_checkup.checkup_date)');
		
		return $this->db->get()->result();
	}

	function get_patients()
	{
		$this->db->select("YEAR(eh_patient_checkup.checkup_date) AS year_val, COUNT( DISTINCT eh_patient_checkup.user_id) AS unique_user");
		//$this->db->select("YEAR(eh_patient_checkup.checkup_date) AS year_val");
		$this->db->from('eh_patient_checkup');
		//$this->db->join('eh_site_user_map', 'eh_patient_checkup.user_id = eh_site_user_map.user_id');
		//$this->db->where('eh_patient_checkup.checkup_date >=', '2013-01-01 00:00:00.000000');
		//$this->db->where('eh_patient_checkup.checkup_date <=', "$current_year-12-31 23:59:59.999999");		
		$this->db->group_by('YEAR(eh_patient_checkup.checkup_date)');
		
		return $this->db->get()->result();
	}
	
	function unique_user($project_id, $year)
	{
		$sql = "SELECT eh_patient_checkup.checkup_date,
       eh_site_user_map.project_id,
       COUNT( DISTINCT eh_site_user_map.user_id) AS unique_user
  FROM    eh_site_user_map eh_site_user_map
       INNER JOIN
          eh_patient_checkup eh_patient_checkup
       ON (eh_site_user_map.user_id = eh_patient_checkup.user_id)
 WHERE (eh_site_user_map.project_id = $project_id)
 AND eh_patient_checkup.checkup_date BETWEEN '$year-01-01 00:00:00.000000' AND '$year-12-31 23:59:59.999999'";
		
		$query  = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->row()->unique_user;
		}
		else
		{
			return 0;	
		}
		/*$this->db->select("COUNT(DISTINCT eh_site_user_map.user_id) AS unique_user");
		$this->db->from('eh_site_user_map');
		$this->db->join('eh_patient_checkup', 'eh_patient_checkup.user_id = eh_site_user_map.user_id');
		$this->db->where('eh_patient_checkup.checkup_date >=', "$year-01-01 00:00:00.000000");
		$this->db->where('eh_patient_checkup.checkup_date <=', "$year-12-31 23:59:59.999999");
		$this->db->where('eh_site_user_map.project_id', $project_id);
		$this->db->group_by('YEAR(eh_patient_checkup.checkup_date)');*/
		
		
	}	
	
	function get_site()
	{
		$this->db->select("project_id, project_title");
		$this->db->group_by('project_title');
		return $this->db->get('eh_project_site')->result();	
	}
	
	function get_project_checkup($project_id, $year)
	{
		/*$this->db->select("YEAR(eh_patient_checkup.checkup_date) AS year_val, COUNT(eh_patient_checkup.checkup_id) AS site_checkpu, eh_site_user_map.project_id");
		$this->db->from('eh_patient_checkup');
		$this->db->join('eh_site_user_map', 'eh_patient_checkup.user_id = eh_site_user_map.user_id');
		$this->db->where('eh_patient_checkup.checkup_date >=', "$year-01-01 00:00:00.000000");
		$this->db->where('eh_patient_checkup.checkup_date <=', "$year-12-31 23:59:59.999999");
		$this->db->where('eh_site_user_map.project_id', $project_id);
		
		return $this->db->get()->row()->site_checkpu;	*/
		$sql = "SELECT COUNT(*) AS site_checkpu
  FROM    eh_patient_checkup eh_patient_checkup
       INNER JOIN
          eh_site_user_map eh_site_user_map
       ON (eh_patient_checkup.user_id = eh_site_user_map.user_id)
 WHERE (eh_site_user_map.project_id = $project_id)
 AND eh_patient_checkup.checkup_date BETWEEN  '$year-01-01 00:00:00' AND '$year-12-31 23:59:59'";
 		$query  = $this->db->query($sql);
		return $query->row()->site_checkpu;
		/*if ($query->num_rows() > 0)
		{
			return $query->row()->site_checkpu;
		}
		else
		{
			return 0;	
		}*/
	}
}

/* End of file account_details_model.php */
/* Location: ./application/account/models/Yearly_report_site.php */