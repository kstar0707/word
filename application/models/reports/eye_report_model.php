<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eye_report_model extends MY_Model {

	public $_table_name;
    public $_order_by;
    public $_primary_key;
    
	function get_user_info($user_id, $select = NULL, $whereClause=NULL)
	{
		if ($select !== NULL):
		$this->db->select($select);
		endif;
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account_details.account_id = a3m_account.id');
		$this->db->join('eh_patient', 'a3m_account_details.account_id = eh_patient.user_id', 'left');
		//$this->db->join('eh_patient_checkup', 'eh_patient_checkup.user_id = a3m_account.id');	
		$this->db->where('user_id',$user_id);
		if (is_array($whereClause) && !empty($whereClause)):
		$this->db->where($whereClause);
		endif;		
		return $this->db->get()->row();
	}

	function get_eye_test($patient_id= NULL)
	{
		$this->db->select('eye_investigation_report_main.*');
		$this->db->from('eye_investigation_report_main');
		$this->db->where('eye_investigation_report_main.user_id',$patient_id);
		$this->db->order_by('report_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_eye_test_by_join($patient_id= NULL)
	{
		$this->db->select('eye_investigation_report_main.*,
				eye_investigation.checkup_id,
				eye_vision_test.vision_test_id,
				eye_preliminary_test.preliminary_test_id,
				eye_final_examination.final_id,
				eye_refraction.refraction_id,
				eye_investigation.investigation_id,
				eye_glass_prescription.eye_prescription_id,
				eye_prescription.prescription_id
			');
		$this->db->from('eye_investigation_report_main');
		
		// Join Another Report
		$this->db->join('eye_vision_test', 'eye_investigation_report_main.report_id =
                     eye_vision_test.report_id', 'left');
		$this->db->join('eye_preliminary_test', 'eye_investigation_report_main.report_id =
                     eye_preliminary_test.report_id', 'left');
		$this->db->join('eye_investigation', 'eye_investigation_report_main.report_id =
                     eye_investigation.report_id', 'left');
		$this->db->join('eye_refraction', 'eye_investigation_report_main.report_id =
                     eye_refraction.report_id', 'left');
		$this->db->join('eye_final_examination', 'eye_investigation_report_main.report_id =
                     eye_final_examination.report_id', 'left');
		$this->db->join('eye_glass_prescription', 'eye_investigation_report_main.report_id =
                     eye_glass_prescription.report_id', 'left');

		// Eye Prescription list
		$this->db->join('eye_prescription', 'eye_investigation_report_main.report_id =
                     eye_prescription.checkup_id', 'left');
		// Order by query
		if ($patient_id!=NULL) {
			$this->db->where('eye_investigation_report_main.user_id', $patient_id);
		}		
		
		$this->db->order_by('eye_investigation_report_main.report_id', 'desc');
		$query = $this->db->get();
		// return $this->db->last_query();
		return $query->result();
	}

	function get_eye_single_prescription($patient_id= NULL)
	{
		$this->db->select('eye_prescription.*, eye_prescription.create_date as created_at,
				a3m_account_details.fullname as dr_name
			');
		
		$this->db->from('eye_prescription');
		// Eye Prescription list
		$this->db->join('a3m_account_details', 'eye_prescription.create_user_id =
                     a3m_account_details.account_id');
		
		$this->db->where('eye_prescription.checkup_id <', 1);
		if ($patient_id!=NULL) {
			$this->db->where('eye_prescription.user_id', $patient_id);
		}			
		
		$this->db->order_by('eye_prescription.prescription_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_eye_test_list_by_join($account_id, $eye_query_close = array(), $start = NULL, $page = NULL)
	{
		// echo "Array: "; print_r($eye_query_close);
		// exit();
		// User Sites
    	$user_projects = $this->get_user_istes($account_id);

		$this->db->select('eye_investigation_report_main.*,
				eye_vision_test.*,
				eye_preliminary_test.*,
				eye_investigation.*,
				a3m_account_details.*,
				eh_patient.barcode_id, 
				eh_project_site.project_title
			');
		$this->db->from('eye_investigation_report_main');
		
		// Join Another Report
		$this->db->join('eye_vision_test', 'eye_investigation_report_main.report_id =
                     eye_vision_test.report_id', 'left');
		$this->db->join('eye_preliminary_test', 'eye_investigation_report_main.report_id =
                     eye_preliminary_test.report_id', 'left');
		$this->db->join('eye_investigation', 'eye_investigation_report_main.report_id =
                     eye_investigation.report_id', 'left');			
		$this->db->join('a3m_account_details', 'eye_investigation_report_main.user_id =
                     a3m_account_details.account_id', 'left');	
        $this->db->join('eh_patient', 'eye_investigation_report_main.user_id =
                     eh_patient.user_id', 'left');

        $this->db->join('eh_site_user_map', 'eh_patient.user_id = eh_site_user_map.user_id');
    	$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');

        if ($eye_query_close['site_id']!='') {
        	$this->db->where_in('eh_project_site.project_id', $eye_query_close['site_id']);
        }
        if ($eye_query_close['start_date']!='') {
            $start_date = date('Y-m-d', strtotime($eye_query_close['start_date']));
        }

        if ($eye_query_close['end_date']!='') {
            $end_date = date('Y-m-d', strtotime($eye_query_close['end_date']));
        }
        
        if(($eye_query_close['start_date']!='') && ($eye_query_close['end_date']=='')){
            $end_date = date('Y-m-d');               
        }
        elseif (($eye_query_close['start_date']=='') && ($eye_query_close['end_date']!='')) {
            $first_data = $this->get_frist_row();
            $start_date =  date('Y-m-d', strtotime($first_data->created_at));
            
        }
        if (!empty($start_date) || !empty($end_date)) {
            $this->db->where('eye_investigation_report_main.created_at >=', $start_date);
            $this->db->where('eye_investigation_report_main.created_at <=', $end_date.' 23:59:59');
        }
        // Get Only Patient by  Dr. Access by his site
    	$this->db->where_in('eh_site_user_map.project_id', $user_projects);

		$this->db->order_by('eye_investigation_report_main.report_id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_eye_vision_test($report_id)
	{
		$this->db->where('report_id',$report_id);
		$query = $this->db->get('eye_vision_test');
		return $query->row();
	}

	function get_eye_main_report($report_id)
	{
		$this->db->where('report_id',$report_id);
		$query = $this->db->get('eye_investigation_report_main');
		return $query->row();
	}

	function get_eye_preliminary_test($report_id)
	{
		$this->db->where('report_id',$report_id);
		$query = $this->db->get('eye_preliminary_test');
		return $query->row();
	}
	
	function birthday($birthday){ 
		
		$age = strtotime($birthday);
		
		if($age === false){ 
			return false; 
		} 
		
		list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
		
			
		$now = strtotime(date('Y-m-d')); 
		
		
		
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

	public function get_frist_row()
    {
        $this->db->select('created_at');
        $this->db->select_min('report_id');
        $query = $this->db->get("eye_investigation_report_main");
        return $query->row();
    }

    public function count_rows($account_id, $site_id = NULL, $start_date = NULL, $end_date = NULL)
    {
    	// User Sites
    	$user_projects = $this->get_user_istes($account_id);

		$this->db->select('eye_investigation_report_main.*,
				eye_vision_test.*,
				eye_preliminary_test.*,
				eye_investigation.*,
				a3m_account_details.*,
				eh_patient.barcode_id, 
				eh_project_site.project_title
			');
		$this->db->from('eye_investigation_report_main');
		
		// Join Another Report
		$this->db->join('eye_vision_test', 'eye_investigation_report_main.report_id =
                     eye_vision_test.report_id', 'left');
		$this->db->join('eye_preliminary_test', 'eye_investigation_report_main.report_id =
                     eye_preliminary_test.report_id', 'left');
		$this->db->join('eye_investigation', 'eye_investigation_report_main.report_id =
                     eye_investigation.report_id', 'left');			
		$this->db->join('a3m_account_details', 'eye_investigation_report_main.user_id =
                     a3m_account_details.account_id', 'left');	
        $this->db->join('eh_patient', 'eye_investigation_report_main.user_id =
                     eh_patient.user_id', 'left');

        $this->db->join('eh_site_user_map', 'eh_patient.user_id = eh_site_user_map.user_id');
    	$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');

        if ($site_id!=NULL) {
        	$this->db->where_in('eh_project_site.project_id', $site_id);
        }
        if (!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($start_date));
        }

        if (!empty($end_date)) {
            $end_date = date('Y-m-d', strtotime($end_date));
        }
        
        if(($start_date!='') && ($end_date=='')){
            $end_date = date('Y-m-d');               
        }
        elseif (($start_date=='') && ($end_date!='')) {
            $first_data = $this->get_frist_row();
            $start_date =  date('Y-m-d', strtotime($first_data->created_at));
            
        }
        if (!empty($start_date) || !empty($end_date)) {
            $this->db->where('eye_investigation_report_main.created_at >=', $start_date);
            $this->db->where('eye_investigation_report_main.created_at <=', $end_date.' 23:59:59');
        }
        // Get Only Patient by Pathologis Dr. Access by his site
    	$this->db->where_in('eh_site_user_map.project_id', $user_projects);

		$this->db->order_by('eye_investigation_report_main.report_id', 'desc');
		$query = $this->db->get();
		return $query->num_rows();
    }

    // Eye Prescription
    // Created by Ahasan Ullah
    // Created at 03 May 2017
    public function get_eye_prescription_cc($presscription_id = NULL)
    {
    	$this->db->from('eye_prescription_cc');
		
		// Join Another Report
		$this->db->join('eh_prescription_cc_template', 'eye_prescription_cc.cc_id =
                     eh_prescription_cc_template.id');
		$this->db->where('eye_prescription_cc.prescription_id', $presscription_id);
		$query = $this->db->get();
		return $query->result();
    }

    // Eye Prescription
    // Created by Ahasan Ullah
    // Created at 03 May 2017
    public function get_eye_prescription_advice($presscription_id = NULL)
    {
    	$this->db->from('eye_prescription_advice');		
		// Join Another Report
		$this->db->join('eh_prescription_advice_template', 'eye_prescription_advice.advice_id = eh_prescription_advice_template.id');
		$this->db->where('eye_prescription_advice.prescription_id', $presscription_id);
		$query = $this->db->get();
		return $query->result();
    }

    // Eye Prescription
    // Created by Ahasan Ullah
    // Created at 03 May 2017
    public function get_eye_prescription_test($presscription_id = NULL)
    {
    	$this->db->from('eye_prescription_test');		
		// Join Another Report
		$this->db->join('eh_prescription_test_template', 'eye_prescription_test.test_id = eh_prescription_test_template.id');
		$this->db->where('eye_prescription_test.prescription_id', $presscription_id);
		$query = $this->db->get();
		return $query->result();
    }

    // Eye Prescription
    // Created by Ahasan Ullah
    // Created at 03 May 2017
    public function get_eye_prescription_doctor($user_id = NULL)
    {
    	$this->db->from('a3m_account');		
		// Join Another Report
		$this->db->join('a3m_account_details', 'a3m_account.id = a3m_account_details.account_id');
		$this->db->join('eh_doctor', 'a3m_account.id = eh_doctor.user_id');
		$this->db->where('a3m_account.id', $user_id);
		$query = $this->db->get();
		return $query->result();
    }
}

/* End of file account_details_model.php */
/* Location: ./application/account/models/account_details_model.php */