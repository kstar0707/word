<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pathological_report_model extends MY_Model {

	public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_all_report($user_id) 
    {
    	// User Sites
    	$user_projects = $this->get_user_istes($user_id);

    	// Site Wise Report 
    	$this->db->select('pr_pathological_report_main.*, eh_site_user_map.project_id, eh_project_site.project_title, eh_patient.*, a3m_account_details.*');
    	$this->db->from('pr_pathological_report_main');
    	$this->db->join('a3m_account_details', 'pr_pathological_report_main.user_id = a3m_account_details.account_id');
        $this->db->join('eh_site_user_map', 'pr_pathological_report_main.user_id = eh_site_user_map.user_id');
    	$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');
    	$this->db->join('eh_patient', 'pr_pathological_report_main.user_id = eh_patient.user_id');
    	$this->db->where_in('eh_site_user_map.project_id', $user_projects);
    	$query = $this->db->get();
    	return $query->result();
    } 

    public function generate_pathological_report($user_id, $start = NULL, $limit = NULL)
    {
    	// User Sites
    	$user_projects = $this->get_user_istes($user_id);

    	// Site Wise Report 
    	$this->db->select('pr_pathological_report_main.*, 
    		eh_site_user_map.project_id, 
    		eh_project_site.project_title, 
    		eh_patient.*, 
    		a3m_account_details.fullname,
    		a3m_account_details.dateofbirth, 
    		a3m_account_details.gender');
    	$this->db->from('pr_pathological_report_main');
    	$this->db->join('eh_site_user_map', 'pr_pathological_report_main.user_id = eh_site_user_map.user_id');
    	$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');
    	$this->db->join('eh_patient', 'pr_pathological_report_main.user_id = eh_patient.user_id');
    	$this->db->join('a3m_account_details', 'eh_patient.user_id = a3m_account_details.account_id');
    	$this->db->where_in('eh_site_user_map.project_id', $user_projects);
    	if($limit!=NULL):
			$this->db->limit($limit, $start);
		endif;
    	$query = $this->db->get();
    	return $query->result();
    }

    
    public function get_all_haematologi_report($user_id, $type=NULL)
    {
    	// User Sites
    	$user_projects = $this->get_user_istes($user_id);

    	// Site Wise Report  
    	$this->db->select('eh_patient.*,
    		a3m_account_details.fullname, 
    		a3m_account_details.gender, 
    		pr_pathological_report_main.*, 
    		eh_site_user_map.project_id, 
    		eh_project_site.project_title, 
    		eh_patient.*, 
    		pr_blood_examination_report.*');
    	// Get Data From Main Table
    	$this->db->from('pr_pathological_report_main'); 
    	// Get Data From pr_blood_examination_report Table for haematological Report
    	$this->db->join('pr_blood_examination_report', 'pr_pathological_report_main.report_id = pr_blood_examination_report.report_id');
    	// Get Patient Site Info
    	$this->db->join('eh_site_user_map', 'pr_pathological_report_main.user_id = eh_site_user_map.user_id');
    	// get Patient Site name
    	$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');
    	// Get Patient Information 
    	$this->db->join('eh_patient', 'pr_pathological_report_main.user_id = eh_patient.user_id');
    	// Get Patient User Details
    	$this->db->join('a3m_account_details', 'eh_patient.user_id = a3m_account_details.account_id');
    	// Get Only Patient by Pathologis Dr. Access by his site
    	$this->db->where_in('eh_site_user_map.project_id', $user_projects);
    	// Get Only Report that not put pathologist data
    	if ($type==NULL) {
    		$this->db->where('microscopic_report_create_user_id', NULL);
    	}
    	// $this->db->where('microscopic_report_create_user_id', NULL);
    	$this->db->order_by('pr_pathological_report_main.report_id', 'asc');
    	$query = $this->db->get();
    	return $query->result();
    }

    public function get_all_urine_report($user_id, $type=NULL)
    {
    	// User Sites
    	$user_projects = $this->get_user_istes($user_id);

    	// Site Wise Report  
    	$this->db->select('eh_patient.*,
    		a3m_account_details.fullname, 
    		a3m_account_details.gender,
    		pr_pathological_report_main.*, 
    		eh_site_user_map.project_id, 
    		eh_project_site.project_title, 
    		eh_patient.*, 
    		pr_urine_analycis.*');
    	// Get Data From Main Table
    	$this->db->from('pr_pathological_report_main'); 
    	// Get Data From pr_blood_examination_report Table for haematological Report
    	$this->db->join('pr_urine_analycis', 'pr_pathological_report_main.report_id = pr_urine_analycis.report_id');
    	// Get Patient Site Info
    	$this->db->join('eh_site_user_map', 'pr_pathological_report_main.user_id = eh_site_user_map.user_id');
    	// get Patient Site name
    	$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');
    	// Get Patient Information 
    	$this->db->join('eh_patient', 'pr_pathological_report_main.user_id = eh_patient.user_id');
    	// Get Patient User Details
    	$this->db->join('a3m_account_details', 'eh_patient.user_id = a3m_account_details.account_id');
    	// Get Only Patient by Pathologis Dr. Access by his site
    	$this->db->where_in('eh_site_user_map.project_id', $user_projects);
    	// Get Only Report that not put pathologist data
    	if ($type==NULL) {
    		$this->db->where('microscopic_report_create_user_id', NULL);
    	}
    	// $this->db->where('microscopic_report_create_user_id', NULL);
    	$this->db->order_by('pr_pathological_report_main.report_id', 'asc');
    	$query = $this->db->get();
    	return $query->result();
    }

    public function get_all_stool_report($user_id, $type=NULL)
    {
    	// User Sites
    	$user_projects = $this->get_user_istes($user_id);

    	// Site Wise Report  
    	$this->db->select('eh_patient.*,
    		a3m_account_details.fullname, 
    		a3m_account_details.gender, 
    		pr_pathological_report_main.*, 
    		eh_site_user_map.project_id, 
    		eh_project_site.project_title, 
    		eh_patient.*, 
    		pr_stool_examination_report.*');
    	// Get Data From Main Table
    	$this->db->from('pr_pathological_report_main'); 
    	// Get Data From pr_blood_examination_report Table for haematological Report
    	$this->db->join('pr_stool_examination_report', 'pr_pathological_report_main.report_id = pr_stool_examination_report.report_id');
    	// Get Patient Site Info
    	$this->db->join('eh_site_user_map', 'pr_pathological_report_main.user_id = eh_site_user_map.user_id');
    	// get Patient Site name
    	$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');
    	// Get Patient Information 
    	$this->db->join('eh_patient', 'pr_pathological_report_main.user_id = eh_patient.user_id');
    	// Get Patient User Details
    	$this->db->join('a3m_account_details', 'eh_patient.user_id = a3m_account_details.account_id');
    	// Get Only Patient by Pathologis Dr. Access by his site
    	$this->db->where_in('eh_site_user_map.project_id', $user_projects);
    	// Get Only Report that not put pathologist data
    	if ($type==NULL) {
    		$this->db->where('microscopic_report_create_user_id', NULL);
    	}
    	// $this->db->where('microscopic_report_create_user_id', NULL);
    	$this->db->order_by('pr_pathological_report_main.report_id', 'asc');
    	$query = $this->db->get();
    	return $query->result();
    } 

    public function get_all_microbiology_report($user_id, $type=NULL)
    {
    	// User Sites
    	$user_projects = $this->get_user_istes($user_id);

    	// Site Wise Report  
    	$this->db->select('eh_patient.*,
    		a3m_account_details.fullname, 
    		a3m_account_details.gender, 
    		pr_pathological_report_main.*, 
    		eh_site_user_map.project_id, 
    		eh_project_site.project_title, 
    		eh_patient.*, 
    		pr_microbiology_analysis.*');
    	// Get Data From Main Table
    	$this->db->from('pr_pathological_report_main'); 
    	// Get Data From pr_blood_examination_report Table for haematological Report
    	$this->db->join('pr_microbiology_analysis', 'pr_pathological_report_main.report_id = pr_microbiology_analysis.report_id');
    	// Get Patient Site Info
    	$this->db->join('eh_site_user_map', 'pr_pathological_report_main.user_id = eh_site_user_map.user_id');
    	// get Patient Site name
    	$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');
    	// Get Patient Information 
    	$this->db->join('eh_patient', 'pr_pathological_report_main.user_id = eh_patient.user_id');
    	// Get Patient User Details
    	$this->db->join('a3m_account_details', 'eh_patient.user_id = a3m_account_details.account_id');
    	// Get Only Patient by Pathologis Dr. Access by his site
    	$this->db->where_in('eh_site_user_map.project_id', $user_projects);
    	// Get Only Report that not put pathologist data
    	if ($type==NULL) {
    		$this->db->where('microscopic_report_create_user_id', NULL);
    	}
    	// $this->db->where('microscopic_report_create_user_id', NULL);
    	$this->db->order_by('pr_pathological_report_main.report_id', 'asc');
    	$query = $this->db->get();
    	return $query->result();
    }

    
	function get_user_info($user_id, $select = NULL, $whereClause=NULL)
	{
		if ($select !== NULL):
		$this->db->select($select);
		endif;
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account_details.account_id = a3m_account.id');
		$this->db->join('eh_patient', 'a3m_account_details.account_id = eh_patient.user_id');
		//$this->db->join('eh_patient_checkup', 'eh_patient_checkup.user_id = a3m_account.id');	
		$this->db->where('user_id',$user_id);
		if (is_array($whereClause) && !empty($whereClause)):
		$this->db->where($whereClause);
		endif;		
		return $this->db->get()->row();
	}

	public function get_report_images($report_id)
	{
		$this->db->where('report_id',$report_id);
			
		return $this->db->get('pr_images')->result();
	}

	public function get_urine_routine_test($user_id)
	{
		$this->db->select('pr_pathological_report_main.*, pr_urine_analycis.microscopic_report_create_user_id');
		$this->db->from('pr_pathological_report_main');
		$this->db->join('pr_urine_analycis', 'pr_pathological_report_main.report_id =
                 pr_urine_analycis.report_id');
		$this->db->where(array('pr_pathological_report_main.report_type'=>1, 'pr_pathological_report_main.user_id'=>$user_id));
		$this->db->order_by('pr_pathological_report_main.report_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_stool_routine_test($user_id)
	{
		$this->db->select('pr_pathological_report_main.*, pr_stool_examination_report.microscopic_report_create_user_id');
		$this->db->from('pr_pathological_report_main');
		$this->db->join('pr_stool_examination_report', 'pr_pathological_report_main.report_id =
                 pr_stool_examination_report.report_id');
		$this->db->where(array('pr_pathological_report_main.report_type'=>4, 'pr_pathological_report_main.user_id'=>$user_id));
		$this->db->order_by('pr_pathological_report_main.report_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_microbiology_test($user_id)
	{
		$this->db->select('pr_pathological_report_main.*, pr_microbiology_analysis.microscopic_report_create_user_id');
		$this->db->from('pr_pathological_report_main');
		$this->db->join('pr_microbiology_analysis', 'pr_pathological_report_main.report_id =
                 pr_microbiology_analysis.report_id');
		$this->db->where(array('pr_pathological_report_main.report_type'=>5, 'pr_pathological_report_main.user_id'=>$user_id));
		$this->db->order_by('pr_pathological_report_main.report_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	
	//Add by ripon 2016-09-19
	// report_type'=>2 means Haematologycal report
	public function get_blood_haematological_tests($user_id)
	{
		$this->db->select('pr_pathological_report_main.*, pr_blood_examination_report.microscopic_report_create_user_id');
		$this->db->from('pr_pathological_report_main');
		$this->db->join('pr_blood_examination_report', 'pr_pathological_report_main.report_id =
                 pr_blood_examination_report.report_id');
		$this->db->where(array('pr_pathological_report_main.report_type'=>2, 'pr_pathological_report_main.user_id'=>$user_id));
		$this->db->order_by('pr_pathological_report_main.report_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	
	
	//Add by ripon 2016-09-22
	// report_type'=>3 means Haematologycal report
	public function get_blood_biochemistry_tests($user_id)
	{
		$this->db->select('pr_pathological_report_main.*, pr_blood_biochemistry_report.create_user_id');
		$this->db->from('pr_pathological_report_main');
		$this->db->join('pr_blood_biochemistry_report', 'pr_pathological_report_main.report_id =
                 pr_blood_biochemistry_report.report_id');
		$this->db->where(array('pr_pathological_report_main.report_type'=>3, 'pr_pathological_report_main.user_id'=>$user_id));
		$this->db->order_by('pr_pathological_report_main.report_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	
	
	public function get_urine_routine_report($report_id)
	{
		$this->db->select('pr_pathological_report_main.*, pr_urine_analycis.*');
		$this->db->from('pr_pathological_report_main');
		$this->db->join('pr_urine_analycis', 'pr_pathological_report_main.report_id =
                 pr_urine_analycis.report_id');

		$this->db->where(array('pr_pathological_report_main.report_id'=> $report_id));
		$query = $this->db->get();
		return $query->row();
	}

	public function get_stool_routine_report($report_id)
	{
		$this->db->select('pr_pathological_report_main.*, pr_stool_examination_report.*');
		$this->db->from('pr_pathological_report_main');
		$this->db->join('pr_stool_examination_report', 'pr_pathological_report_main.report_id =
                 pr_stool_examination_report.report_id');

		$this->db->where(array('pr_pathological_report_main.report_id'=> $report_id));
		$query = $this->db->get();
		return $query->row();
	}

	public function microbiology_report($report_id)
	{
		$this->db->select('pr_pathological_report_main.*, pr_microbiology_analysis.*');
		$this->db->from('pr_pathological_report_main');
		$this->db->join('pr_microbiology_analysis', 'pr_pathological_report_main.report_id =
                 pr_microbiology_analysis.report_id');

		$this->db->where(array('pr_pathological_report_main.report_id'=> $report_id));
		$query = $this->db->get();
		return $query->row();
	}
	
	//Add by ripon 2016-09-20
	public function get_haematologycal_report($report_id)
	{
		$this->db->select('pr_pathological_report_main.*, pr_blood_examination_report.*');
		$this->db->from('pr_pathological_report_main');
		$this->db->join('pr_blood_examination_report', 'pr_pathological_report_main.report_id =
                 pr_blood_examination_report.report_id');

		$this->db->where(array('pr_pathological_report_main.report_id'=> $report_id));
		$query = $this->db->get();
		return $query->row();
	}
	
	//Add by ripon 2016-09-24
	public function get_biochemistry_report($report_id)
	{
		$this->db->select('pr_pathological_report_main.*, pr_blood_biochemistry_report.*');
		$this->db->from('pr_pathological_report_main');
		$this->db->join('pr_blood_biochemistry_report', 'pr_pathological_report_main.report_id =
                 pr_blood_biochemistry_report.report_id');

		$this->db->where(array('pr_pathological_report_main.report_id'=> $report_id));
		$query = $this->db->get();
		return $query->row();
	}
	
	
	function get_pathologist_info($pathologist_id)
	{
		$this->db->select('a3m_account_details.fullname, eh_pathologist.*');
		$this->db->from('a3m_account_details');
		$this->db->join('eh_pathologist', 'a3m_account_details.account_id =
                 eh_pathologist.user_id');

		$this->db->where(array('a3m_account_details.account_id'=> $pathologist_id));
		$query = $this->db->get();
		return $query->row();
	}

	function get_patient_site($user_id)
	{
		$this->db->select('eh_project_site.*');
		$this->db->from('eh_project_site');
		$this->db->join('eh_site_user_map', 'eh_site_user_map.project_id = eh_project_site.project_id');
		$this->db->where(array('eh_site_user_map.user_id'=> $user_id));
		$query = $this->db->get();
		return $query->row();
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

	public function get_user_istes($user_id)
	{
		$this->db->select('eh_site_user_map.project_id AS project_id');
		$this->db->from('eh_project_site');
		$this->db->join('eh_site_user_map', 'eh_site_user_map.project_id = eh_project_site.project_id');
		$this->db->where(array('eh_site_user_map.user_id'=> $user_id));
		$query = $this->db->get();
		$results = $query->result();
		foreach($results as $result) 
		{
			$projects[] = $result->project_id;
		}
		return $projects;
	}

}

/* End of file account_details_model.php */
/* Location: ./application/account/models/account_details_model.php */