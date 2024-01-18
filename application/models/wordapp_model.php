<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wordapp_model extends MY_Model
{

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_post_by_user_id($user_id = NULL, $start = NULL, $limit = NULL,$deleted=0)
    {
        if($deleted)
            $is_deleted=1;
        else
            $is_deleted=0;
        $this->db->select("post_id, post_title");
        if ($user_id) {
            $this->db->where('created_by', $user_id);
            $this->db->where('is_deleted', $is_deleted);
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
        $this->db->set('is_deleted', 1);
        $this->db->where('post_id', $post_id);
        $this->db->update('post');
        return $this->db->affected_rows();
    }

    public function permanent_delete($post_ids)
    {
        $this->db->where_in('post_id', (array) $post_ids);
        $delete = $this->db->delete('post');
        if ($delete) {
           return ture;
        }else{
            return false;
        }
    }

    function get_total_user_post($user_id,$deleted=0)
    {
        if($deleted)
            $is_deleted=1;
        else
            $is_deleted=0;
        $query = $this->db->query("SELECT post_id FROM `post` WHERE `created_by` = $user_id AND `is_deleted` = $is_deleted");
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

    function insert_decision_documents($settlement_id, $document_encrypted_name, $document_name, $document_type)
    {
        $documents = array(
            'settlement_id' => $settlement_id,
            'document_name' => $document_name,
            'document_encrypted_name' => $document_encrypted_name,
            'document_type' => $document_type,
            'created_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('settlement_decision_document_tbl', $documents);
//        echo $this->db->last_query();die;

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

    public function get_settlement_data_by_user_id($user_id = NULL, $start = NULL, $limit = NULL, $view_type,$is_deleted)
    {
        if ($user_id && $view_type == 4) {
            $this->db->select("settlement_id,president_seal_id, settlement_title,is_share,modified_date AS created_at,document_name,created_by,on_hold");
        }else{
            $this->db->select("settlement_id,president_seal_id, settlement_title,is_share,modified_date,document_name,created_by,on_hold");
        }
        if ($user_id && $view_type == 4) { // for history view
            $this->db->where('created_by', $user_id);
            $this->db->where('president_seal_id', 0);
            $this->db->where('is_deleted', $is_deleted);
//            $this->db->where('is_share', 0);
        } else if ($view_type == 5) { // approval list of only created by login users
            $this->db->where('president_seal_id !=', 0);
            $this->db->where('is_deleted', 0);
            $this->db->where('created_by', $user_id);
        } else if ($view_type == 7) { // approval list of all users
            $this->db->where('president_seal_id !=', 0);
            $this->db->where('is_deleted', 0);
//            $this->db->where('is_share', 1);
            $this->db->where('created_by', $user_id);
        }

        if ($limit) {
            $this->db->limit($limit, $start);
        }
        if ($user_id && $view_type == 4) {
            $this->db->order_by('created_at', 'desc');
        }else{
            $this->db->order_by('modified_date', 'desc');
        }

        $query = $this->db->get('settlement_form_tbl');
        return $query->result();
    }

    function get_shared_settlement_data_by_user_id($user_id = NULL, $view_type,$username='',$name='',$is_deleted)
    {
        error_reporting(0);
        if ($user_id == NULL)
            return false;
        $this->db->distinct("settlement_form_tbl.settlement_id,email.sender_name");
        if ($view_type == 4)
            $this->db->select("settlement_form_tbl.settlement_id,email.sender_name,email.created_at,settlement_form_tbl.settlement_id,settlement_form_tbl.is_share, settlement_form_tbl.modified_date AS created_at,settlement_form_tbl.created_by,settlement_form_tbl.settlement_title,settlement_form_tbl.document_name,settlement_form_tbl.on_hold");
//            $this->db->select("email.receiver_id,email.created_at,email.receiver_name,email.sender_name,settlement_form_tbl.settlement_id, settlement_form_tbl.president_seal_id,settlement_form_tbl.settlement_title, settlement_form_tbl.is_share, settlement_form_tbl.modified_date AS created_at,settlement_form_tbl.document_name,settlement_form_tbl.created_by");
        else
            $this->db->select("settlement_form_tbl.settlement_id, settlement_form_tbl.president_seal_id,settlement_form_tbl.settlement_title, settlement_form_tbl.is_share, settlement_form_tbl.modified_date,settlement_form_tbl.document_name");
        $this->db->from("email");
        $this->db->join("settlement_form_tbl", "email.settlement_id = settlement_form_tbl.settlement_id");
        if ($view_type == 4) { //history view list
            $this->db->where(array("email.receiver_id" => $user_id, "settlement_form_tbl.is_deleted" => $is_deleted, "settlement_form_tbl.is_share" => 1, "settlement_form_tbl.president_seal_id" => 0));
//            $this->db->or_where(array("email.sender_name" => $username));
//            $this->db->or_where(array("email.sender_name" => $name));
        }
        else if ($view_type == 5) // approval list of only created by login users
            $this->db->where(array("settlement_form_tbl.president_seal_id !=" => 0, "settlement_form_tbl.created_by" => $user_id, "settlement_form_tbl.is_deleted" => 0));
        else if ($view_type == 7) // approval list of all users
            $this->db->where(array("email.receiver_id" => $user_id, "settlement_form_tbl.president_seal_id !=" => 0, "settlement_form_tbl.is_deleted" => 0));

        $this->db->order_by('email.created_at', 'desc');
        $query = $this->db->get();
//        echo 'Query1  =  '.$this->db->last_query();

        return $query->result();
    }

    public function get_settlement_data_by_user_id_approved($user_id = NULL, $start = NULL, $limit = NULL, $view_type,$is_deleted)
    {
        $this->db->select("settlement_id,president_seal_id, settlement_title,is_share,modified_date AS created_at,document_name,created_by,on_hold");
        $this->db->where('created_by', $user_id);
        $this->db->where('president_seal_id !=', 0);
        $this->db->where('is_deleted', $is_deleted);

        if ($limit) {
            $this->db->limit($limit, $start);
        }

//        $this->db->order_by('president_seal_id', 'asc');
        $this->db->order_by('modified_date', 'desc');

        $query = $this->db->get('settlement_form_tbl');
        return $query->result();
    }

    function get_shared_settlement_data_by_user_id_approved($user_id = NULL, $view_type,$is_deleted)
    {
        if ($user_id == NULL)
            return false;
        $this->db->distinct("settlement_form_tbl.settlement_id");
        $this->db->select("email.receiver_id,email.created_at,email.receiver_name,email.sender_name,settlement_form_tbl.settlement_id, settlement_form_tbl.president_seal_id,settlement_form_tbl.settlement_title, settlement_form_tbl.is_share, settlement_form_tbl.modified_date AS created_at,settlement_form_tbl.document_name,settlement_form_tbl.created_by,settlement_form_tbl.on_hold");
        $this->db->from("email");
        $this->db->join("settlement_form_tbl", "email.settlement_id = settlement_form_tbl.settlement_id");
        $this->db->where(array("email.receiver_id" => $user_id, "settlement_form_tbl.is_deleted" => $is_deleted, "settlement_form_tbl.president_seal_id !=" => 0));
        $this->db->order_by('email.created_at', 'desc');
        $query = $this->db->get();
//        echo 'Query1  =  '.$this->db->last_query();

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
        $this->db->where('created_by', $created_by);

//        $this->db->where('seal_img_type', $seal_image_type);
//        $this->db->order_by('modified_date', 'desc');
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

    function change_seal_image_password($current_password, $new_password, $seal_image_type, $created_by)
    {
        $this->db->set('seal_password', $new_password);
//        $this->db->where('seal_img_type', $seal_image_type);
        $this->db->where('seal_password', $current_password);
        $this->db->where('created_by', $created_by);
        $this->db->update('settlement_seal_img');
//        echo $this->db->last_query();
//        if ($this->db->affected_rows() > 0)
//            $val = 1;
//        else
//            $val = 0;

        return $this->db->affected_rows();
    }

    function update_seal_image_password_wise($add_password, $seal_img)
    {
        $this->db->set('seal_img', $seal_img);
//        $this->db->where('seal_img_type', $seal_image_type);
        $this->db->where('seal_password', $add_password);
        $this->db->update('settlement_seal_img');
//        echo $this->db->last_query();
//        if ($this->db->affected_rows() > 0)
//            $val = 1;
//        else
//            $val = 0;

        return $this->db->affected_rows();
    }

    function delete_documents($document_id,$settlement_id)
    {
        if($settlement_id){
            $this->db->set('document_name', '');
            $this->db->where('settlement_id', $settlement_id);
            $this->db->update('settlement_form_tbl');
//        echo $this->db->last_query();
//            if ($this->db->affected_rows() > 0)
//                $val = 1;
//            else
//                $val = 0;
        }
        $this->db->where('document_id', $document_id);
        $this->db->delete('settlement_decision_document_tbl');
        return 1;
    }

    function insert_new_seal_image_password($data)
    {
        $this->db->insert('settlement_seal_img', $data);
        $val = $this->db->insert_id();
//                echo $this->db->last_query();
        return $val;
    }

    function check_if_password_exist($password, $created_by)
    {
        $result = array();
        $img = '';

        $this->db->select("seal_password");
        $this->db->from('settlement_seal_img');
        $this->db->where('seal_password', $password);
        if ($created_by != '')
            $this->db->where('created_by', $created_by);
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
        $this->db->select("receiver_id,receiver_name,receiver_mobile");
        $this->db->distinct("receiver_name");
        $this->db->from("email");
        $this->db->where(array("settlement_id" => $settlement_id));
        $query = $this->db->get();
//        echo $this->db->last_query();die();
        $result = $query->result();
        $sender_name = $this->account_model->get_username_by_id($user_id);
        $get_sender_mobile_no_from_partner_table = $this->emailing_model->get_sender_mobile_no_from_partner_table($user_id, $sender_name);

//        return $result;
        if (!empty($result)) {
//            $this->load->model('account/account_model');
            foreach ($result as $get_results) {
                $receiver_name = $get_results->receiver_name;
                $receiver_id = $get_results->receiver_id;
                $receiver_mobile = $get_results->receiver_mobile;
                $email_data = array(
                    'settlement_id' => $settlement_id,
                    'receiver_id' => $receiver_id,
                    'receiver_name' => $receiver_name,
                    'sender_name' => $sender_name,
                    'receiver_mobile' => $receiver_mobile,
                    'sender_mobile' => $get_sender_mobile_no_from_partner_table->partner_mobile,
                    'parent_email_id' => NULL,
                    'subject' => NULL,
                    'content' => NULL,
                    'drft' => 0,
                    'created_by' => $user_id,
                    'created_at' => date('Y-m-d H:i:s')
                );
                if ($user_id != $receiver_id)
                    $this->db->insert('email', $email_data);
            }
        }


        // email send to requisitor/sender
        $this->db->select("sender_name,sender_mobile,created_by");
        $this->db->distinct("sender_name,sender_mobile,created_by");
        $this->db->from("email");
        $this->db->where(array("settlement_id" => $settlement_id));
        $this->db->where(array("settlement_id" => $settlement_id));
        $query_sender = $this->db->get();
//        echo $this->db->last_query();die();
        $result_sender = $query_sender->result();
//        return $result;
        if (!empty($result_sender)) {
            foreach ($result_sender as $get_results_all) {
                $sender_as_receiver_name = $get_results_all->sender_name;
                $sender_as_receiver_mobile = $get_results_all->sender_mobile;
                $created_by = $get_results_all->created_by;


                if ($sender_as_receiver_name != '' || $sender_as_receiver_mobile != '') {
                    $sender_email_data = array(
                        'settlement_id' => $settlement_id,
                        'receiver_id' => $created_by,
                        'receiver_name' => $sender_as_receiver_name,
                        'sender_name' => $sender_name,
                        'receiver_mobile' => $sender_as_receiver_mobile,
                        'sender_mobile' => $get_sender_mobile_no_from_partner_table->partner_mobile,
                        'parent_email_id' => NULL,
                        'subject' => NULL,
                        'content' => NULL,
                        'drft' => 0,
                        'created_by' => $user_id,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    if ($user_id != $created_by)
                        $this->db->insert('email', $sender_email_data);
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

    function update_document_name_settlement_table()
    {
        $this->db->select("*");
        $this->db->from('settlement_form_tbl');
        $this->db->where('document_encrypted_name !=', '');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();

            foreach ($result AS $info) {
                $settlement_id = $info['settlement_id'];
                $document_name = $info['document_name'] . '|';
                $document_encrypted_name = $info['document_encrypted_name'] . '|';
                $document_type = $info['document_type'] . '|';

                $this->db->set('document_name', $document_name);
                $this->db->set('document_encrypted_name', $document_encrypted_name);
                $this->db->set('document_type', $document_type);
//        $this->db->where('seal_img_type', $seal_image_type);
                $this->db->where('settlement_id', $settlement_id);
                $this->db->update('settlement_form_tbl');
            }

//            if ($result['document_name'] != '') {


//        echo $this->db->last_query();
//        if ($this->db->affected_rows() > 0)
//            }
        } else {

        }
    }

    function get_latest_seal_password_userwise($created_by)
    {
        $result = array();
        $img = '';

        $this->db->select("seal_password");
        $this->db->from('settlement_seal_img');
        $this->db->where('seal_img !=', '');
        $this->db->where('created_by', $created_by);
        $this->db->order_by('created_date', 'desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            if ($result['seal_password'] != '') {
                $val = $result;
            }
        } else {
            $val = 0;
        }
//        echo 'Query1  =  '.$this->db->last_query();
        return $val;
    }

    function get_settlement_documents_info($settlement_id)
    {
//        if (!$created_by)
//            return false;

        $this->db->where('settlement_id', $settlement_id);
        $query = $this->db->get('settlement_decision_document_tbl');
        return $query->result_array();
    }

    public function get_user_list_from_settlement($user_id = NULL, $start = NULL, $limit = NULL, $view_type, $from = 0)
    {
        if ($user_id == NULL)
            return false;

        $this->db->distinct("settlement_form_tbl.created_by");
        $this->db->select("a3m_account.id,a3m_account.username, a3m_account.name,settlement_form_tbl.created_by");
        $this->db->from("a3m_account");
        $this->db->join("settlement_form_tbl", "a3m_account.id = settlement_form_tbl.created_by");
        if ($from == 0)
            $this->db->where(array("a3m_account.id !=" => $user_id));
//            $this->db->where(array("settlement_form_tbl.is_deleted" => 0, "a3m_account.id !=" => $user_id));
        else
            $this->db->where(array("a3m_account.id" => $user_id));
//            $this->db->where(array("settlement_form_tbl.is_deleted" => 0, "a3m_account.id" => $user_id));
        $query = $this->db->get();
//        echo 'Query1  =  '.$this->db->last_query();

        return $query->result();
    }

    public function get_receiver_list_from_email_by_sender_name($user_id, $name, $username)
    {
        if ($user_id == NULL)
            return false;

        $where_cls = '';
        if ($name != '')
            $where_cls = " OR sender_name='" . $name . "' OR receiver_name='" . $name . "'";
        $where_cls .= " OR receiver_name='" . $username . "' ";
//        $sql = "SELECT distinct receiver_name,settlement_id FROM email WHERE settlement_id != 0 AND (sender_name='" . $username . "' $where_cls) order by email_id asc";
        $sql = "SELECT distinct receiver_name,settlement_id,receiver_id FROM email WHERE settlement_id != 0 order by email_id asc";
//        $sql = "SELECT distinct receiver_name,settlement_id FROM email WHERE settlement_id != 0 AND (sender_name='" . $username . "' $where_cls) ";
        $query = $this->db->query($sql);
//        echo 'Query1  =  '.$this->db->last_query();
        return $query->result_array();
    }

    function update_hold_status_settlement($settlement_id)
    {
        $this->db->set('on_hold', 1);
        $this->db->where('settlement_id', $settlement_id);
        $this->db->update('settlement_form_tbl');
//        echo $this->db->last_query();
//        if ($this->db->affected_rows() > 0)
//            $val = 1;
//        else
//            $val = 0;

        return $this->db->affected_rows();
    }

    function restore_posts($post_id)
    {
        $this->db->set('is_deleted', 0);
        $this->db->where('post_id', $post_id);
        $this->db->update('post');
        return $this->db->affected_rows();
    }

    function restore_settlement_from_trash($settlement_id)
    {
        $this->db->set('is_deleted', 0);
        $this->db->where('settlement_id', $settlement_id);
        $this->db->update('settlement_form_tbl');
        return $this->db->affected_rows();
    }

    function get_all_decision_documents()
    {
//        if (!$created_by)
//            return false;

        $result=array();
        $this->db->select("settlement_id");
//        $this->db->where('settlement_id', $settlement_id);
        $query = $this->db->get('settlement_decision_document_tbl');
//        if ($query->num_rows() > 0) {
////            echo 'Query1  =  '.$this->db->last_query();
//
//        }
         $result=$query->result_array();
        foreach ($result as $all_decision_document) {
            $all_decision_document_array[] = $all_decision_document['settlement_id'];
        }
        $all_decision_document_string= implode(',', $all_decision_document_array);
        return $all_decision_document_string;

    }

}


/* End of file account_details_model.php */
/* Location: ./application/account/models/account_details_model.php */