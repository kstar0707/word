<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkup_model extends CI_Model {

	function get_checkup_data($user_id=NULL, $name=NULL, $site_Array = NULL, $whereClause=NULL, $start=NULL, $limit=NULL)
	{		
		$this->db->select('eh_patient.barcode_id as Barcode, 
			a3m_account.username as Username, 
			a3m_account.id as account_id, 
			a3m_account_details.fullname as Fullname, 
			a3m_account_details.gender,
			a3m_account_details.dateofbirth, 
			eh_patient_checkup.checkup_id, 
			eh_patient_checkup.checkup_date, 
			eh_patient_checkup.height, 
			eh_patient_checkup.weight, 
			eh_patient_checkup.bmi, 
			eh_patient_checkup.waist, 
			eh_patient_checkup.hip, 
			eh_patient_checkup.waist_hip_ratio, 
			eh_patient_checkup.temperature, 
			eh_patient_checkup.oxygen_of_blood, 
			eh_patient_checkup.bp_sys, 
			eh_patient_checkup.bp_dia, 
			eh_patient_checkup.blood_glucose, 
			eh_patient_checkup.blood_glucose_type, 
			eh_patient_checkup.blood_hemoglobin, 
			eh_patient_checkup.urinary_glucose, 
			eh_patient_checkup.urinary_protein, 
			eh_patient_checkup.urinary_urobilinogen, 
			eh_patient_checkup.urinary_ph, 
			eh_patient_checkup.pulse_rate, 
			eh_patient_checkup.arrhythmia, 
			eh_patient_checkup.cholesterol, 
			eh_patient_checkup.uric_acid, 
			eh_patient_checkup.hbsag, 
			eh_patient_checkup.color_status, 
			eh_patient_checkup.prescription_id, 
			eh_site_user_map.project_id as Site_ID,
			eh_project_site.project_title');
		$this->db->from('eh_patient');
		$this->db->join('eh_patient_checkup', 'eh_patient.user_id = eh_patient_checkup.user_id');
		$this->db->join('a3m_account', 'a3m_account.id = eh_patient.user_id');
		$this->db->join('a3m_account_details', 'a3m_account.id = a3m_account_details.account_id');
		
		$this->db->join('eh_site_user_map', 'eh_site_user_map.user_id = eh_patient.user_id');
		$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');
		if ($name!==NULL):
		$this->db->like('a3m_account_details.fullname',$name);
		endif;
		if (is_array($whereClause) && !empty($whereClause)):
		$this->db->where($whereClause);
		endif;
		$this->db->where_in('eh_site_user_map.project_id', $site_Array);
		$this->db->order_by("eh_patient_checkup.checkup_id", "desc");		 		
		if($limit!=NULL):
			$this->db->limit($limit, $start);
		endif;		
		return $this->db->get()->result();
	}
		
	function get_site_id($user_id = NULL)
	{
		$this->db->select('eh_project_site.project_id');
		$this->db->from('a3m_account');
		$this->db->join('eh_site_user_map', 'eh_site_user_map.user_id = a3m_account.id');
		$this->db->join('eh_project_site', 'eh_project_site.project_id = eh_site_user_map.project_id');
		$this->db->where('a3m_account.id',$user_id);
		$results = $this->db->get()->result();
		$values = array();
		foreach($results as $result){
		   $values[] = $result->project_id;
		}		
		return array_values($values);
	}
	
	function count_rows($whereClouse = NULL, $site_Array = NULL,$name=NULL){		
		$this->db->select('count(eh_patient_checkup.checkup_id) AS no_of_rows');
		$this->db->from('a3m_account');		
		$this->db->join('eh_patient_checkup', 'eh_patient_checkup.user_id = a3m_account.id');
		$this->db->join('a3m_account_details', 'a3m_account.id = a3m_account_details.account_id');
		$this->db->join('eh_patient', 'eh_patient.user_id = a3m_account.id');
		$this->db->join('eh_site_user_map', 'eh_site_user_map.user_id = a3m_account.id');	
		if ($name!==NULL):
		$this->db->like('a3m_account_details.fullname',$name);
		endif;
		$this->db->where($whereClouse);
		$this->db->where_in('eh_site_user_map.project_id', $site_Array);
		$result = $this->db->get()->result_array();
		return $result[0]['no_of_rows'];
	}
	
	function no_of_patient($whereClouse = NULL, $site_Array = NULL,$name=NULL){
		$this->db->select('count(DISTINCT(eh_patient_checkup.user_id)) AS no_of_rows');
		$this->db->from('a3m_account');
		$this->db->join('eh_patient_checkup', 'eh_patient_checkup.user_id = a3m_account.id');
		$this->db->join('eh_site_user_map', 'eh_site_user_map.user_id = a3m_account.id');	
		$this->db->join('a3m_account_details', 'a3m_account.id = a3m_account_details.account_id');
		$this->db->join('eh_patient', 'eh_patient.user_id = a3m_account.id');	
		if ($name!==NULL):
		$this->db->like('a3m_account_details.fullname',$name);
		endif;	
		$this->db->where($whereClouse);
		$this->db->where_in('eh_site_user_map.project_id', $site_Array);
		$result = $this->db->get()->result_array();
		
		return $result[0]['no_of_rows'];
		
	}
	
	function checkup_data_export($name=NULL, $site_Array = NULL, $whereClause=NULL, $file_name)
 	{
		$this->db->select('eh_patient.barcode_id as Barcode, 
			a3m_account.username as Username, 
			a3m_account.id as account_id, 
			a3m_account_details.fullname as Fullname, 
			a3m_account_details.gender,
			a3m_account_details.dateofbirth, 
			eh_patient_checkup.checkup_id, 
			eh_patient_checkup.checkup_date, 
			eh_patient_checkup.height, 
			eh_patient_checkup.weight, 
			eh_patient_checkup.bmi, 
			eh_patient_checkup.waist, 
			eh_patient_checkup.hip, 
			eh_patient_checkup.waist_hip_ratio, 
			eh_patient_checkup.temperature, 
			eh_patient_checkup.oxygen_of_blood, 
			eh_patient_checkup.bp_sys, 
			eh_patient_checkup.bp_dia, 
			eh_patient_checkup.blood_glucose, 
			eh_patient_checkup.blood_glucose_type, 
			eh_patient_checkup.blood_hemoglobin, 
			eh_patient_checkup.urinary_glucose, 
			eh_patient_checkup.urinary_protein, 
			eh_patient_checkup.urinary_urobilinogen, 
			eh_patient_checkup.urinary_ph, 
			eh_patient_checkup.pulse_rate, 
			eh_patient_checkup.arrhythmia, 
			eh_patient_checkup.cholesterol, 
			eh_patient_checkup.uric_acid, 
			eh_patient_checkup.hbsag, 
			eh_patient_checkup.color_status, 
			eh_patient_checkup.prescription_id, 
			eh_site_user_map.project_id as Site_ID,
			eh_project_site.project_title');
		$this->db->from('eh_patient');
		$this->db->join('eh_patient_checkup', 'eh_patient.user_id = eh_patient_checkup.user_id');
		$this->db->join('a3m_account', 'a3m_account.id = eh_patient.user_id');
		$this->db->join('a3m_account_details', 'a3m_account.id = a3m_account_details.account_id');
		
		$this->db->join('eh_site_user_map', 'eh_site_user_map.user_id = eh_patient.user_id');
		$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');
		if ($name!==NULL):
		$this->db->like('a3m_account_details.fullname',$name);
		endif;
		if (is_array($whereClause) && !empty($whereClause)):
		$this->db->where($whereClause);
		endif;
		$this->db->where_in('eh_site_user_map.project_id', $site_Array);
		$this->db->order_by("eh_patient_checkup.checkup_id", "desc");		 		
			
		$query = $this->db->get();
		
		
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
       // $query = $this->db->query($query);
        $delimiter = ",";
        $newline = "\r\n";
        force_download("$file_name.csv", $this->dbutil->csv_from_result($query, $delimiter, $newline));
 	}
	
	function birthday($birthday){ 
		$age = strtotime($birthday);
		
		if($age === false){ 
			return false; 
		} 
		
		list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
		
		$now = strtotime("now"); 
		
		list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
		
		$age = $y2 - $y1; 
		
		if((int)($m2.$d2) < (int)($m1.$d1)) 
			$age -= 1; 
			
			return $age; 
	} 

}

/* End of file account_details_model.php */
/* Location: ./application/account/models/account_details_model.php */