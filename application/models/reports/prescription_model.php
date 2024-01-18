<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prescription_model extends CI_Model {

	function get_relational_data($user_id=NULL, $name=NULL, $site_Array = NULL, $whereClause=NULL, $start=NULL, $limit=NULL)
	{		
		$this->db->select('a3m_account.username, 
		a3m_account_details.fullname, 
		a3m_account_details.gender, 
		a3m_account_details.dateofbirth, 
		eh_patient.barcode_id, eh_site_user_map.project_id AS Site_ID, 
		eh_prescription.prescription_id,
		eh_prescription.extra_symptom,
		eh_prescription.create_user_id,
		eh_prescription.extra_advice,
		eh_project_site.project_title,
		eh_prescription.create_date, 
		eh_patient_checkup.color_status');
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account_details.account_id = a3m_account.id');
		$this->db->join('eh_patient', 'eh_patient.user_id = a3m_account.id');
		$this->db->join('eh_patient_checkup', 'eh_patient_checkup.user_id = a3m_account.id');
		$this->db->join('eh_prescription', 'eh_prescription.checkup_id = eh_patient_checkup.checkup_id');
		$this->db->join('eh_site_user_map', 'eh_site_user_map.user_id = eh_patient.user_id');
		$this->db->join('eh_project_site', 'eh_site_user_map.project_id = eh_project_site.project_id');
		if ($name!==NULL):
		$this->db->like('fullname',$name);
		endif;
		if (is_array($whereClause) && !empty($whereClause)):
		$this->db->where($whereClause);
		endif;
		$this->db->where_in('eh_site_user_map.project_id', $site_Array);
		$this->db->order_by("eh_prescription.prescription_id", "ASC");		 		
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
	
	function get_drugs($prescription_id=NULL)
	{
		$this->db->select('rx_type.type_name,
       rx_drug_name.drug_name,
	   rx_size.drug_size,
       rx_prescription_drugs.special_instruction,       
       rx_doze.doze,
       rx_doze.doze_bn,
       rx_instruction.drug_instruction,
       rx_instruction.drug_instruction_bn,
       rx_duration.drug_duration_bn,	   
       rx_prescription_drugs.drug_duration,
       rx_duration.drug_duration AS duration_name,
	   rx_duration.drug_duration_bn AS duration_name_bn');
		$this->db->from('rx_prescription_drugs');
		$this->db->join('rx_type', 'rx_type.type_id = rx_prescription_drugs.type_id','left');
		$this->db->join('rx_drug_name', 'rx_drug_name.drug_id = rx_prescription_drugs.drug_id','left');
		$this->db->join('rx_duration', 'rx_prescription_drugs.drug_duration_id = rx_duration.drug_duration_id','left');
		$this->db->join('rx_instruction', 'rx_instruction.drug_instruction_id = rx_prescription_drugs.drug_instruction_id','left');
		$this->db->join('rx_size', 'rx_size.drug_size_id = rx_prescription_drugs.drug_size_id','left');
		$this->db->join('rx_doze', 'rx_doze.doze_id = rx_prescription_drugs.doze_id','left');
		
		$this->db->where('rx_prescription_drugs.prescription_id',$prescription_id);
		return  $this->db->get()->result();
	}
	
	function get_chief_complaint($prescription_id=NULL) 
	{
		$this->db->select('eh_prescription_cc_template.id, eh_prescription_cc_template.cc_name');
		$this->db->from('eh_prescription_cc_template');
		$this->db->join('eh_prescription_cc', 'eh_prescription_cc_template.id = eh_prescription_cc.cc_id','left');
		
		$this->db->where('eh_prescription_cc.prescription_id',$prescription_id);
		return  $this->db->get()->result();
	}
	
	function get_advices($prescription_id = NULL) 
	{
		$this->db->select('eh_prescription_advice_template.advice_en, eh_prescription_advice_template.advice_bn');
		$this->db->from('eh_prescription_advice');
		$this->db->join('eh_prescription_advice_template', 'eh_prescription_advice.advice_id =
              eh_prescription_advice_template.id');
		
		$this->db->where('eh_prescription_advice.prescription_id',$prescription_id);
		return  $this->db->get()->result();
	}
	
	function get_test($prescription_id=NULL) 
	{
		$this->db->select('eh_prescription_test_template.test_name');
		$this->db->from('eh_prescription_test');
		$this->db->join('eh_prescription_test_template', 'eh_prescription_test.test_id = eh_prescription_test_template.id');
		
		$this->db->where('eh_prescription_test.prescription_id',$prescription_id);
		return  $this->db->get()->result();
	}
	
	function get_doctors($site_Array=NULL){
		$this->db->distinct('eh_doctor.user_id');
		$this->db->select('a3m_account_details.fullname, a3m_account.id, a3m_account.username');
		
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account.id = a3m_account_details.account_id','left');
		$this->db->join('eh_doctor', 'eh_doctor.user_id = a3m_account.id');	
		$this->db->join('eh_site_user_map', 'eh_doctor.user_id = eh_site_user_map.user_id');
		
		$this->db->where_in('eh_site_user_map.project_id', $site_Array);
				
		//$this->db->where('a3m_rel_account_role.role_id',$doctor_role);
		return  $this->db->get()->result();	
	}
	
	
	function count_rows($whereClouse = NULL, $site_Array = NULL){
		$this->db->select('count(eh_prescription.prescription_id) AS no_of_rows');
		$this->db->from('a3m_account');
		$this->db->join('a3m_account_details', 'a3m_account.id = a3m_account_details.account_id');
		$this->db->join('eh_patient_checkup', 'eh_patient_checkup.user_id = a3m_account.id');
		$this->db->join('eh_prescription', 'eh_prescription.checkup_id = eh_patient_checkup.checkup_id');
		$this->db->join('eh_patient', 'eh_patient.user_id = a3m_account.id');
		$this->db->join('eh_site_user_map', 'eh_site_user_map.user_id = a3m_account.id');			
		$this->db->where($whereClouse);
		$this->db->where_in('eh_site_user_map.project_id', $site_Array);
		$result = $this->db->get()->result_array();
		return $result[0]['no_of_rows'];
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

	function get_bma_reg($dr_username){
		$this->db->select('a3m_account.id, eh_doctor.bma_reg_no');
		$this->db->from('a3m_account');
		$this->db->join('eh_doctor', 'a3m_account.id = eh_doctor.user_id');
		$this->db->where('a3m_account.username', $dr_username);
		return $this->db->get()->row()->bma_reg_no;
	}
	
	function get_drug_info_in_a_date($user_id,$checkup_id,$drug_date,$day_part)
	{
	$checkup_info=$this->general_model->get_all_table_info_by_id('eh_patient_checkup', 'checkup_id', $checkup_id);
	$prescription_info=$this->general_model->get_all_table_info_by_id('eh_prescription', 'prescription_id', $checkup_info->prescription_id);	
	$prescription_date=date('Y-m-d',strtotime($prescription_info->create_date));
	//return $prescription_date;
	$drug_info=$this->general_model->get_all_table_info_by_id_asc_desc('rx_prescription_drugs', 'prescription_id', $checkup_info->prescription_id,'id','ASC');
		foreach($drug_info as $druginfo)
		{
		//check if drug in the date range
			if($druginfo->drug_duration_id==1)  // 1= days
			{
			$doze=$this->doctor_model->get_doze($druginfo->doze_id);
			$dozepieces = explode("+", $doze);
			
			if(isset($dozepieces[$day_part]))
			{
				if($dozepieces[$day_part]!='0') // 1+1+1 
					{
					$drug_duration=$this->general_model->bn2enNumber($druginfo->drug_duration);
					//echo $druginfo->drug_duration.",".
					$drug_end_date = strtotime("+".($drug_duration+1)." days", strtotime($prescription_date));
						if($drug_date <= $drug_end_date)
						{
						echo $this->doctor_model->get_drug($druginfo->drug_id).' ';
						if($druginfo->drug_size_id)
						echo $this->doctor_model->get_size($druginfo->drug_size_id);
						if($druginfo->drug_instruction_id)
					 	echo " (".$this->doctor_model->get_drug_instruction($druginfo->drug_instruction_id).")";
						echo '<br/>';
						}						
					}
				}
			}
			
			else if($druginfo->drug_duration_id==2)
			{
			$doze=$this->doctor_model->get_doze($druginfo->doze_id);
			$dozepieces = explode("+", $doze);
			
			if(isset($dozepieces[$day_part]))
			{
				if($dozepieces[$day_part]!='0') // 1+1+1 
					{
					$drug_duration=$this->general_model->bn2enNumber($druginfo->drug_duration);	
					$drug_end_date = strtotime("+".($drug_duration)." Weeks", strtotime($prescription_date));
					$drug_end_date=strtotime("+1 days", $drug_end_date);
						if($drug_date <= $drug_end_date)
						{
						echo $this->doctor_model->get_drug($druginfo->drug_id).' ';
						if($druginfo->drug_size_id)
						echo $this->doctor_model->get_size($druginfo->drug_size_id);
						if($druginfo->drug_instruction_id)
						echo " (".$this->doctor_model->get_drug_instruction($druginfo->drug_instruction_id).")";
						echo '<br/>';
						}						
					}
				}
			
			}
			else if($druginfo->drug_duration_id==3)
			{
			$doze=$this->doctor_model->get_doze($druginfo->doze_id);
			$dozepieces = explode("+", $doze);
			
			if(isset($dozepieces[$day_part]))
			{
				if($dozepieces[$day_part]!='0') // 1+1+1 
					{
					$drug_duration=$this->general_model->bn2enNumber($druginfo->drug_duration);	
					$drug_end_date = strtotime("+".($drug_duration)." Month", strtotime($prescription_date));
					$drug_end_date=strtotime("+1 days", $drug_end_date);
						if($drug_date <= $drug_end_date)
						{
						echo $this->doctor_model->get_drug($druginfo->drug_id).' ';
						if($druginfo->drug_size_id)
						echo $this->doctor_model->get_size($druginfo->drug_size_id);
						if($druginfo->drug_instruction_id)
						echo " (".$this->doctor_model->get_drug_instruction($druginfo->drug_instruction_id).")";
						echo '<br/>';
						}						
					}
				}
			
			}
			else if($druginfo->drug_duration_id==4)
			{
			$doze=$this->doctor_model->get_doze($druginfo->doze_id);
			$dozepieces = explode("+", $doze);
			
			if(isset($dozepieces[$day_part]))
			{
				if($dozepieces[$day_part]!='0') // 1+1+1 
					{
					//$drug_duration=$this->general_model->bn2enNumber($druginfo->drug_duration);	
					$drug_end_date = strtotime("+6 Month", strtotime($prescription_date));
					$drug_end_date=strtotime("+1 days", $drug_end_date);
						if($drug_date <= $drug_end_date)
						{
						echo $this->doctor_model->get_drug($druginfo->drug_id).' ';
						if($druginfo->drug_size_id)
						echo $this->doctor_model->get_size($druginfo->drug_size_id);
						if($druginfo->drug_instruction_id)
						echo " (".$this->doctor_model->get_drug_instruction($druginfo->drug_instruction_id).")";
						echo '<br/>';
						}						
					}
				}
			
			}				
		
		}// End for each
	
	
	}
	
	
	
	function en2bnNumber ($number){
    $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
	$search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");    
    $en_number = str_replace($search_array, $replace_array, $number);
    return $en_number;
	}
	
	
}

/* End of file account_details_model.php */
/* Location: ./application/account/models/account_details_model.php */