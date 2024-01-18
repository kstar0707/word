<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{

    /**
     * Get all accounts
     *
     * @access public
     * @return object all accounts
     */

    function get($name = NULL, $whereClause = NULL, $start = NULL, $limit = NULL,$account_id='')
    {
        // $this->db->select('a3m_account.id, a3m_account.username, a3m_account.email,  a3m_account_details.fullname, a3m_acl_role.name');
        // $this->db->select('a3m_account.id, a3m_account.username, a3m_account.email,  a3m_account_details.fullname, a3m_acl_role.name');
        $this->db->from('a3m_account');
        // $this->db->join('a3m_account_details', 'a3m_account_details.account_id = a3m_account.id', 'left');
        // $this->db->join('a3m_rel_account_role', 'a3m_rel_account_role.account_id = a3m_account.id', 'left');
        // $this->db->join('a3m_acl_role', 'a3m_acl_role.id = a3m_rel_account_role.role_id', 'left');

        if ($name != NULL):
            $this->db->like('name', $name);
        endif;
        if (is_array($whereClause) && !empty($whereClause)):
            $this->db->where($whereClause);
        endif;

        if ($account_id != ''):
            $this->db->where('company_id', $account_id);
        endif;

        $this->db->order_by("id", "ASC");
        if ($limit != NULL):
            $this->db->limit($limit, $start);
        endif;
//        echo 'Query1  =  '.$this->db->last_query();
        return $this->db->get()->result();
    }

    function get_list_multi_clause($table_name = NULL, $field_array = NULL, $select = NULL, $order_by = NULL, $asc_or_desc = NULL, $start = NULL, $limit = NULL)
    {
        if ($select != NULL):
            $this->db->select($select);
        endif;
        if ($order_by != NULL && $asc_or_desc != NULL):
            $this->db->order_by($order_by, $asc_or_desc);
        endif;
        if (is_array($field_array) && count($field_array) > 0):
            $this->db->where($field_array);
        endif;
        if ($start != NULL && $limit != NULL):
            $this->db->limit($limit, $start);
        endif;
        $query = $this->db->get($table_name);
        //if($query->num_rows()>0):
        return $query->result();

    }

    /**
     * Get account by id
     *
     * @access public
     * @param string $account_id
     * @return object account object
     */
    function get_by_id($account_id)
    {
        $this->db->select('a3m_account.id, a3m_account.name, a3m_account.username, a3m_account.company_name, a3m_account.company_id, a3m_account.email, a3m_account.password, a3m_account.user_type, a3m_account_details.*');
        $this->db->from('a3m_account');
        $this->db->join('a3m_account_details', 'a3m_account.id = a3m_account_details.account_id', 'left');
        $this->db->where('a3m_account.id', $account_id);
        return $this->db->get()->row();
        // return $this->db->get_where('a3m_account.id',  $account_id)->row();
    }


    function get_username_by_id($account_id, $from = 0) // //from 1 for settlement page; 0 for others page
    {
        //return $this->db->get_where('a3m_account', array('id' => $account_id))->row();

        $this->db->select('username,name,email,id');
        $this->db->from('a3m_account');
        $this->db->where('id', $account_id);
        $result_set = $this->db->get();
        if ($from == 1)
            return $result_set->row();
        else
//            return $result_set->row();
            return $result_set->row()->username;
        //echo $result_set;

    }
    // --------------------------------------------------------------------

    /**
     * Get account by username
     *
     * @access public
     * @param string $username
     * @return object account object
     */
    function get_by_username($username, $receiver_name = '', $user_account_id = 0)
    {
//        echo $this->db->last_query();
//	    return $this->db->get_where('a3m_account', array('username' => $username))->row();
        if ($receiver_name != '')
            return $this->db->from('a3m_account')->where('username', $username)->or_where('email', $username)->or_where('username', $receiver_name)->get()->row();
        else if ($user_account_id != 0)
            return $this->db->from('a3m_account')->where(array('username' => $username, 'id !=' => $user_account_id))->or_where('email', $username)->get()->row();
        else{
            //$this->db->select('id,username,password');
//            $this->db->from('a3m_account');
//            $this->db->where('login_menu_type', $login_menu_type);
//            $this->db->where("(login_menu_type='$login_menu_type') AND (username='$username' OR email='$username')");
//
//            $query = $this->db->get();
        //echo $this->db->last_query();
//            return $query->row();
            return $this->db->from('a3m_account')->where('username', $username)->or_where('email', $username)->get()->row();

        }

    }

    function get_by_mobile_no($mobile)
    {
        return $this->db->from('a3m_account')->where('username', $mobile)->or_where('email', $mobile)->get()->row();
    }

    // --------------------------------------------------------------------

    /**
     * Get account by email
     *
     * @access public
     * @param string $email
     * @return object account object
     */
    function get_by_email($email)
    {
        return $this->db->get_where('a3m_account', array('email' => $email))->row();
    }

    // --------------------------------------------------------------------

    /**
     * Get account by username or email
     *
     * @access public
     * @param string $username_email
     * @return object account object
     */
    function get_by_username_email($username_email)
    {
//        $this->db->select('id,name,username,email,password');
//        $this->db->from('a3m_account');
//        $this->db->where("(login_menu_type='$login_menu_type') AND (username='$username_email' OR email='$username_email')");
//
//        $query = $this->db->get();
//        //echo $this->db->last_query();
//        return $query->row();

        return $this->db->from('a3m_account')->where(array('username' => $username_email))->or_where('email', $username_email)->get()->row();
    }

    // --------------------------------------------------------------------

    /**
     * Create an account
     *
     * @access public
     * @param string $username
     * @param string $hashed_password
     * @return int insert id
     */
    function create($username, $email = NULL, $password = NULL, $sign_up_name = NULL, $user_type, $company_id, $user_id, $company_name = NULL)
    {
        // Create password hash using phpass
        if ($password !== NULL) {
            $this->load->helper('account/phpass');
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $hashed_password = $hasher->HashPassword($password);
        }

        $this->load->helper('date');
        if ($user_id > 0) {
            $this->db->update('a3m_account', array('username' => $username, 'name' => $sign_up_name, 'company_name' => $company_name, 'password' => isset($hashed_password) ? $hashed_password : NULL), array('id' => $user_id));
            return $this->db->affected_rows();
        } else {
            $this->db->insert('a3m_account', array('username' => $username, 'name' => $sign_up_name, 'company_name' => $company_name, 'company_id' => $company_id, 'user_type' => $user_type, 'email' => $email, 'password' => isset($hashed_password) ? $hashed_password : NULL, 'createdon' => mdate('%Y-%m-%d %H:%i:%s', now())));

            return $this->db->insert_id();
        }
    }

    // --------------------------------------------------------------------

    /**
     * Change account username
     *
     * @access public
     * @param int $account_id
     * @param int $new_username
     * @return void
     */
    function update_username($account_id, $new_username)
    {
        $this->db->update('a3m_account', array('username' => $new_username), array('id' => $account_id));
    }

    // --------------------------------------------------------------------

    /**
     * Change account email
     *
     * @access public
     * @param int $account_id
     * @param int $new_email
     * @return void
     */
    function update_email($account_id, $new_email)
    {
        $this->db->update('a3m_account', array('email' => $new_email), array('id' => $account_id));
    }

    // --------------------------------------------------------------------

    /**
     * Change account password
     *
     * @access public
     * @param int $account_id
     * @param int $hashed_password
     * @return void
     */
    function update_password($account_id, $password_new)
    {
        $this->load->helper('account/phpass');
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        $new_hashed_password = $hasher->HashPassword($password_new);

        $this->db->update('a3m_account', array('password' => $new_hashed_password), array('id' => $account_id));
    }

    function update_password_by_token($token, $password_new) //,$account_id
    {
        $this->load->helper('account/phpass');
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        $new_hashed_password = $hasher->HashPassword($password_new);

        $this->db->update('a3m_account', array('password' => $new_hashed_password), array('reset_password_token' => $token));
//        $this->db->update('a3m_account', array('reset_password_token' => ''), array('id' => $account_id));
    }

    function update_token($account_id, $token)
    {
        $this->load->helper('account/phpass');

        $this->db->update('a3m_account', array('reset_password_token' => $token), array('id' => $account_id));
    }

    // --------------------------------------------------------------------

    /**
     * Update account last signed in dateime
     *
     * @access public
     * @param int $account_id
     * @return void
     */
    function update_last_signed_in_datetime($account_id, $firebase_token = NULL)
    {
        $this->load->helper('date');
        if ($firebase_token != NULL) {
            $this->db->update('a3m_account', array('lastsignedinon' => mdate('%Y-%m-%d %H:%i:%s', now()), 'firebase_token' => $firebase_token), array('id' => $account_id));
        } else {
            $this->db->update('a3m_account', array('lastsignedinon' => mdate('%Y-%m-%d %H:%i:%s', now())), array('id' => $account_id));
        }

    }

    // --------------------------------------------------------------------

    /**
     * Update firebase token it will be null after signout by Mobile
     *
     * @access public
     * @param int $account_id
     * @return void
     */
    function update_firebase_token($account_id)
    {
        $this->db->update('a3m_account', array('firebase_token' => NULL), array('id' => $account_id));
    }

    // --------------------------------------------------------------------

    /**
     * Update password reset sent datetime
     *
     * @access public
     * @param int $account_id
     * @return int password reset time
     */
    function update_reset_sent_datetime($account_id)
    {
        $this->load->helper('date');

        $resetsenton = mdate('%Y-%m-%d %H:%i:%s', now());

        $this->db->update('a3m_account', array('resetsenton' => $resetsenton), array('id' => $account_id));

        return strtotime($resetsenton);
    }

    /**
     * Remove password reset datetime
     *
     * @access public
     * @param int $account_id
     * @return void
     */
    function remove_reset_sent_datetime($account_id)
    {
        $this->db->update('a3m_account', array('resetsenton' => NULL), array('id' => $account_id));
    }

    // --------------------------------------------------------------------

    /**
     * Update account deleted datetime
     *
     * @access public
     * @param int $account_id
     * @return void
     */
    function update_deleted_datetime($account_id)
    {
        $this->load->helper('date');

        $this->db->update('a3m_account', array('deletedon' => mdate('%Y-%m-%d %H:%i:%s', now())), array('id' => $account_id));
    }

    /**
     * Remove account deleted datetime
     *
     * @access public
     * @param int $account_id
     * @return void
     */
    function remove_deleted_datetime($account_id)
    {
        $this->db->update('a3m_account', array('deletedon' => NULL), array('id' => $account_id));
    }

    // --------------------------------------------------------------------

    /**
     * Update account suspended datetime
     *
     * @access public
     * @param int $account_id
     * @return void
     */
    function update_suspended_datetime($account_id)
    {
        $this->load->helper('date');

        $this->db->update('a3m_account', array('suspendedon' => mdate('%Y-%m-%d %H:%i:%s', now())), array('id' => $account_id));
    }

    /**
     * Remove account suspended datetime
     *
     * @access public
     * @param int $account_id
     * @return void
     */
    function remove_suspended_datetime($account_id)
    {
        $this->db->update('a3m_account', array('suspendedon' => NULL), array('id' => $account_id));
    }

    function check_if_user_exist($sender_id, $sender_name)
    {
        $this->db->select('id,username,email');
        $this->db->from('a3m_account');
        $this->db->where('id', $sender_id);
        $this->db->where('username', $sender_name);
        $this->db->or_where('email', $sender_name);
        $result_set = $this->db->get();
//        echo $this->db->last_query();
        return $result_set->row_array();
    }

    function check_password($username,$password)
    {
        $this->db->select('id,username,password');
        $this->db->from('a3m_account');
        $this->db->where('username', $username);
//        $this->db->where('password', md5($password));
        $this->db->limit(1);
        $query = $this->db->get();
//        echo $this->db->last_query();
        if($query->num_rows() == 1){
            return $query->result();
        }
        else{
            return false;
        }


    }

    function get_login_menu_type($username_email)
    {
        $this->db->select('login_menu_type');
        return $this->db->from('a3m_account')->where(array('username' => $username_email))->or_where('email', $username_email)->get()->row();
    }

}


/* End of file account_model.php */
/* Location: ./application/account/models/account_model.php */