<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wordapp_model extends MY_Model
{

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_post_by_user_id($user_id = NULL, $start = NULL, $limit = NULL)
    {
        $this->db->select("post_id, post_title");
        if ($user_id) {
            $this->db->where('created_by', $user_id);
        }

        if ($limit) {
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('updated_at', 'desc');

        $query = $this->db->get('post');
        return $query->result();
    }

    function get_post_by_id($post_id)
    {
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('post');
        return $query->row();
    }

    function delete_post_by_id($post_id)
    {
        if ($this->db->delete('post', array('post_id' => $post_id))) {
            return true;
        } else {
            return false;
        }
    }

    function get_total_user_post($user_id)
    {
        $query = $this->db->query("SELECT post_id FROM `post` WHERE `created_by` = $user_id");
        return $query->num_rows();
    }

    function save_settlement_letter_form($data, $settlement_id)
    {
        $val = 0;
        if ($settlement_id <= 0) { //ADD
            $this->db->insert('settlement_form_tbl', $data);
            $val = $this->db->insert_id();
            return $val;
//                echo $this->db->last_query();
        } else { //EDIT
            $this->db->where('settlement_id', $settlement_id);

            $this->db->update('settlement_form_tbl', $data);
            //echo $this->db->last_query();die;
            if ($this->db->affected_rows() > 0)
                $val = $settlement_id;
            return $val;
        }

    }

    function get_total_shared_settlement($user_id = NULL, $view_type)
    {
        if ($user_id == NULL)
            return false;

        $this->db->distinct("settlement_form_tbl.settlement_id");
        $this->db->select("settlement_form_tbl.settlement_id");
        $this->db->from("email");
        $this->db->join("settlement_form_tbl", "email.settlement_id = settlement_form_tbl.settlement_id");
        if ($view_type == 4) //history view list
            $this->db->where(array("email.receiver_id" => $user_id, "settlement_form_tbl.president_seal_id" => 0));
        else if ($view_type == 5) // approved view list
            $this->db->where(array("email.receiver_id" => $user_id, "settlement_form_tbl.president_seal_id !=" => 0));
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_total_user_settlement_data($user_id, $view_type)
    {
        if ($view_type == 4) {
            $query = $this->db->query("SELECT settlement_id FROM `settlement_form_tbl` WHERE `created_by` = $user_id AND `president_seal_id` = 0 AND `is_deleted` = 0");
        } else {
            $query = $this->db->query("SELECT settlement_id FROM `settlement_form_tbl` WHERE `created_by` = $user_id AND `president_seal_id` != 0 AND `is_deleted` = 0");
        }
//        echo 'Query1  =  '.$this->db->last_query();
        return $query->num_rows();
    }

    public function get_settlement_data_by_user_id($user_id = NULL, $start = NULL, $limit = NULL, $view_type)
    {
        $this->db->select("settlement_id, settlement_title, is_share");
        if ($user_id && $view_type == 4) { // for history view
            $this->db->where('created_by', $user_id);
            $this->db->where('president_seal_id', 0);
            $this->db->where('is_deleted', 0);
        } else { // view only which are approved
            $this->db->where('president_seal_id !=', 0);
            $this->db->where('is_deleted', 0);
            $this->db->where('created_by', $user_id);
        }

        if ($limit) {
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('modified_date', 'desc');

        $query = $this->db->get('settlement_form_tbl');
        return $query->result();
    }

    function get_shared_settlement_data_by_user_id($user_id = NULL, $view_type)
    {
        if ($user_id == NULL)
            return false;
        $this->db->distinct("settlement_form_tbl.settlement_id");
        $this->db->select("settlement_form_tbl.settlement_id, settlement_form_tbl.settlement_title, settlement_form_tbl.is_share");
        $this->db->from("email");
        $this->db->join("settlement_form_tbl", "email.settlement_id = settlement_form_tbl.settlement_id");
        if ($view_type == 4) //history view list
            $this->db->where(array("email.receiver_id" => $user_id, "settlement_form_tbl.president_seal_id" => 0, "settlement_form_tbl.is_deleted" => 0));
        else if ($view_type == 5) // approved view list
            $this->db->where(array("email.receiver_id" => $user_id, "settlement_form_tbl.president_seal_id !=" => 0, "settlement_form_tbl.is_deleted" => 0));
        $query = $this->db->get();
        return $query->result();
    }

    function get_settlement_data_by_id($settlement_id, $created_by, $share_this_settlement_id)
    {
//        if (!$created_by)
//            return false;

        $this->db->where('settlement_id', $settlement_id);
//        $this->db->where('is_deleted', 0);
        if ($share_this_settlement_id == 0)
            $this->db->where('created_by', $created_by);
        $query = $this->db->get('settlement_form_tbl');
        return $query->row_array();
    }

    function get_seal_image_password_wise($password, $seal_image_type, $created_by)
    {
        if (!$created_by)
            return false;

        $result = array();
        $img_with_id = '';

        $this->db->select("seal_img, seal_id");
        $this->db->from('settlement_seal_img');
        $this->db->where('seal_password', $password);
//        $this->db->where('seal_img_type', $seal_image_type);
//        $this->db->where('created_by', $created_by);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $img_with_id = $result['seal_img'] . '#####' . $result['seal_id'];
        }
//        echo 'Query1  =  '.$this->db->last_query();
        return $img_with_id;
    }

    function get_only_seal_image_id_wise($seal_id)
    {
        $result = array();
        $img = '';

        $this->db->select("*");
        $this->db->from('settlement_seal_img');
        $this->db->where('seal_id', $seal_id);
//        $this->db->where('president_seal_img IS NULL', null, false);
//        $this->db->or_where('examination1_seal_img IS NULL', null, false);
//        $this->db->or_where('examination2_seal_img IS NULL', null, false);
//        $this->db->or_where('examination3_seal_img IS NULL', null, false);
//        $this->db->or_where('examination4_seal_img IS NULL', null, false);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            if ($result['seal_img'] != '') {
                $img = $result['seal_img'];
            }
        }
//        echo 'Query1  =  '.$this->db->last_query();
        return $img;
    }

    function change_seal_image_password($new_password, $seal_image_type, $created_by)
    {
        $this->db->set('seal_password', $new_password);
        $this->db->where('seal_img_type', $seal_image_type);
        $this->db->update('settlement_seal_img');
//        echo $this->db->last_query();
        if ($this->db->affected_rows() > 0)
            $val = 1;
        else
            $val = 0;

        return $val;
    }

    function delete_documents($settlement_id)
    {
        $this->db->set('document_encrypted_name', '');
        $this->db->set('document_name', '');
        $this->db->set('document_type', '');
        $this->db->where('settlement_id', $settlement_id);
        $this->db->update('settlement_form_tbl');
//        echo $this->db->last_query();
        if ($this->db->affected_rows() > 0)
            $val = 1;
        else
            $val = 0;

        return $val;
    }

    function insert_new_seal_image_password($data)
    {
        $this->db->insert('settlement_seal_img', $data);
        $val = $this->db->insert_id();
//                echo $this->db->last_query();
        return $val;
    }

    function check_if_password_exist($password)
    {
        $result = array();
        $img = '';

        $this->db->select("seal_password");
        $this->db->from('settlement_seal_img');
        $this->db->where('seal_password', $password);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            if ($result['seal_password'] != '') {
                $val = 1;
            }
        } else {
            $val = 0;
        }
//        echo 'Query1  =  '.$this->db->last_query();
        return $val;
    }

    function check_if_document_exist($settlement_id)
    {
        $result = array();
//        $val=0;
        $this->db->select("document_encrypted_name,document_name,document_type");
        $this->db->from('settlement_form_tbl');
        $this->db->where('settlement_id', $settlement_id);
        $this->db->where('document_encrypted_name !=', '');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
//        echo 'Query1  =  '.$this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
//            if($result['document_encrypted_name']!=''){
            return $result;
//            }
        } else {
            return $result;
        }

//        return $val;
    }

    function delete_settlement_by_id($settlement_id)
    {
        $this->db->set('is_deleted', 1);
        $this->db->where('settlement_id', $settlement_id);
        $this->db->update('settlement_form_tbl');
//        echo $this->db->last_query();
        if ($this->db->affected_rows() > 0)
            $val = 1;
        else
            $val = 0;

        return $val;
    }

    function save_email_info_specific_settlement_id_wise($settlement_id, $user_id)
    {
//        error_reporting(0);
        $this->db->select("receiver_id,receiver_name");
        $this->db->distinct("receiver_name");
        $this->db->from("email");
        $this->db->where(array("settlement_id" => $settlement_id));
        $query = $this->db->get();
//        echo $this->db->last_query();die();
        $result = $query->result();
//        return $result;
        if (!empty($result)) {
            $this->load->model('account/account_model');
            $sender_name = $this->account_model->get_username_by_id($user_id);
            foreach ($result as $get_results) {
                $receiver_name = $get_results->receiver_name;
                $receiver_id = $get_results->receiver_id;

                $this->db->distinct("sender_name");
                $this->db->select("sender_name,created_by");
                $this->db->from("email");
                $this->db->where(array("settlement_id" => $settlement_id));

                $query_all = $this->db->get();
//        echo $this->db->last_query();die();
                $result_all = $query_all->result();

                foreach ($result_all as $get_results_all) {
                    $receiver_mobile = $get_results_all->receiver_mobile;
                    $sender_is_receiver_name = $get_results_all->sender_name;
                    $sender_is_receiver_mobile = $get_results_all->sender_mobile;
                    $created_by = $get_results_all->created_by;
                }
                $email_data = array(
                    'settlement_id' => $settlement_id,
                    'receiver_id' => $receiver_id,
                    'receiver_name' => $receiver_name,
                    'sender_name' => $sender_name,
                    'receiver_mobile' => $receiver_mobile,
                    'sender_mobile' => $sender_name,
                    'parent_email_id' => NULL,
                    'subject' => NULL,
                    'content' => NULL,
                    'drft' => 0,
                    'created_by' => $user_id,
                    'created_at' => date('Y-m-d H:i:s')
                );
                if ($user_id != $receiver_id)
                    $this->db->insert('email', $email_data);

                if ($sender_is_receiver_name != '' ) {
                    $email_data1 = array(
                        'settlement_id' => $settlement_id,
                        'receiver_id' => $created_by,
                        'receiver_name' => $sender_is_receiver_name,
                        'sender_name' => $sender_name,
                        'receiver_mobile' => $sender_is_receiver_mobile,
                        'sender_mobile' => $sender_name,
                        'parent_email_id' => NULL,
                        'subject' => NULL,
                        'content' => NULL,
                        'drft' => 0,
                        'created_by' => $user_id,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    if ($user_id != $created_by)
                        $this->db->insert('email', $email_data1);
                }

            }


        }
    }
    
    function get_settlement_data_seal_wise($settlement_id, $seal_type)
    {
//        if (!$created_by)
//            return false;

        $this->db->where('settlement_id', $settlement_id);
//        $this->db->where('is_deleted', 0);
        $this->db->where($seal_type . ' !=', 0);

        $query = $this->db->get('settlement_form_tbl');
//        echo 'Query1  =  '.$this->db->last_query();die();
        if ($query->num_rows() > 0) {
            $val = 1;
        } else {
            $val = 0;
        }
        return $val;
//        return $query->row_array();
    }


}

/* End of file account_details_model.php */
/* Location: ./application/account/models/account_details_model.php */