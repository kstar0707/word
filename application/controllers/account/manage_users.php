<?php
/*
 * Manage_users Controller
 */
class Manage_users extends CI_Controller {

  /**
   * Constructor
   */
  function __construct()
  {
    parent::__construct();

    // Load the necessary stuff...
    $this->load->config('account/account');
    $this->load->helper(array('date', 'language', 'account/ssl', 'url'));
    $this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
    $this->load->model(array('account/account_model', 'account/account_details_model', 'account/acl_permission_model', 'account/acl_role_model', 'account/rel_account_permission_model', 'account/rel_account_role_model', 'account/rel_role_permission_model','general_model'));
    $this->load->language(array('general', 'account/manage_users', 'account/account_settings', 'account/account_profile', 'account/sign_up', 'account/account_password'));
	
	//date_default_timezone_set('Asia/Dhaka');  // set the time zone UTC+6
		
		$language = $this->session->userdata('site_lang');
		if(!$language)
		{
		$this->lang->load('general', 'english');
		$this->lang->load('menu', 'english');
		$this->lang->load('site', 'english');
		$this->lang->load('doctor', 'english');
		}
		else
		{
		$this->lang->load('general', $language);
		$this->lang->load('menu', $language);
		$this->lang->load('site', $language);
		$this->lang->load('doctor', $language);
		}
		ini_set('memory_limit', '-1');
  }

  /**
   * Manage Users
   */
  function index()
  {
    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_users'));
    }

    // Redirect unauthorized users to account profile page
    if ( ! $this->authorization->is_permitted('retrieve_users'))
    {
      redirect('account/account_profile');
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
	$data['title'] = lang('users_page_name');
	// Setup form validation
    $this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
    $this->form_validation->set_rules(
      array(
        array(
          'field' => 'user_name',
          'label' => 'Username',
          'rules' => 'trim'),
        array(
          'field' => 'role_id', 
          'label' => 'Role Type', 
          'rules' => 'trim'), 
	    array(
          'field' => 'email', 
          'label' => 'Email', 
          'rules' => 'trim|valid_email'), 
        array(
          'field' => 'fullname', 
          'label' => 'Name', 
          'rules' => 'trim')
      ));
	// Search Peramiters
	$this->form_validation->run();
	//$whereClause = array();
	if ($this->input->post('search_submit')) 		
	{
		$username = array();
		if($this->input->post('user_name')):
		$username = array('username'=>$this->input->post('user_name'));
		endif;
			
		$user_type = array();
		if($this->input->post('role_id')):
		$user_type = array('role_id'=>$this->input->post('role_id'));
		endif;
		
		$email = array();
		if($this->input->post('email')):
		$email = array('email'=>$this->input->post('email'));
		endif;
		$whereClause = array_merge($username, $user_type, $email);		
		$this->session->set_userdata('whereClause',$whereClause);
		
		$fullname =NULL; 
		if($this->input->post('fullname')):
		$fullname = $this->input->post('fullname');		
		endif;		
		$this->session->set_userdata('fullname',$fullname);
		
	}
	else
	{	
		$fullname = $this->session->userdata('fullname');
		$whereClause = $this->session->userdata('whereClause');
	}
	
	//print_r($this->session->userdata('whereClause'));
	//exit;
	
	// Paginations
	$this->load->library('pagination');
	
	$config = array();
	$config['base_url'] = base_url().'account/manage_users/index/';
	
	$config['total_rows'] = count($this->account_model->get($fullname, $whereClause, NULL, NULL));
	$config['num_links'] = 3;
	$config['per_page'] = $this->config->item("pagination_perpage");
	$config['uri_segment'] = 4;
	
	$config['full_tag_open'] = '<nav><ul class="pagination pagination-sm">';
	$config['full_tag_close'] = '</ul></nav><!--pagination-->';
	
	$config['first_link'] = '&laquo; First';
	$config['first_tag_open'] = '<li class="prev page">';
	$config['first_tag_close'] = '</li>';
	
	$config['last_link'] = 'Last &raquo;';
	$config['last_tag_open'] = '<li class="next page">';
	$config['last_tag_close'] = '</li>';
	
	$config['next_link'] = 'Next &rarr;';
	$config['next_tag_open'] = '<li class="next page">';
	$config['next_tag_close'] = '</li>';
	
	$config['prev_link'] = '&larr; Previous';
	$config['prev_tag_open'] = '<li class="prev page">';
	$config['prev_tag_close'] = '</li>';
	
	$config['cur_tag_open'] = '<li class="active"><a>';
	$config['cur_tag_close'] = '</a></li>';
	
	$config['num_tag_open'] = '<li class="page">';
	$config['num_tag_close'] = '</li>';
	
	$this->pagination->initialize($config);
	
	$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
	
	
    // Get all user information
    $all_accounts = $this->account_model->get($fullname, $whereClause, $page, $config['per_page']);

    // print_r($all_accounts);
    // exit();
		
    $all_account_details = $this->account_details_model->get();
    $all_account_roles = $this->rel_account_role_model->get();
	$data['all_roles'] = $this->general_model->get_all_table_info_asc_desc('a3m_acl_role', 'id', 'asc');
	/*echo "<pre>"; print_r($all_roles); echo "</pre>"; 
	exit;*/
    $admin_role = $this->acl_role_model->get_by_name('Admin');
	$data["links"] = $this->pagination->create_links();
    // Compile an array for the view to use
    $data['all_accounts'] = array();
    foreach ( $all_accounts as $acc )
    {
      $current_user = array();
      $current_user['id'] = $acc->id;
      $current_user['username'] = $acc->username;
      $current_user['email'] = $acc->email;
      $current_user['firstname'] = '';
      $current_user['lastname'] = '';
      $current_user['is_admin'] = FALSE;
      $current_user['is_banned'] = isset( $acc->suspendedon );

      foreach( $all_account_details as $det ) 
      {
        if( $det->account_id == $acc->id ) 
        {
		  $current_user['fullname'] = $det->fullname;
          $current_user['firstname'] = $det->firstname;
          $current_user['lastname'] = $det->lastname;
        }
      }

      foreach( $all_account_roles as $acrole ) 
      {
        if( $acrole->account_id == $acc->id && $acrole->role_id == $admin_role->id ) 
        {
          $current_user['is_admin'] = TRUE;
          break;
        }
      }

      // Append to the array
      $data['all_accounts'][] = $current_user;
    }
	
    // Load manage users view
    $this->load->view('account/manage_users', $data);
  }


  /**
   * Create/Update Users
   */
  function save($id=null)
  {
    // Keep track if this is a new user
    $is_new = empty($id);

    // Enable SSL?
    maintain_ssl($this->config->item("ssl_enabled"));

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_users'));
    }

    // Check if they are allowed to Update Users
    if ( ! $this->authorization->is_permitted('update_users') && ! empty($id) )
    {
      redirect('account/manage_users');
    }

    // Check if they are allowed to Create Users
    if ( ! $this->authorization->is_permitted('create_users') && empty($id) )
    {
      redirect('account/manage_users');
    }

    // Retrieve sign in user
    $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

    // Get all the roles
    $data['roles'] = $this->acl_role_model->get();

    // Set action type (create or update user)
    $data['action'] = 'create';

    // Get the account to update
    if( ! $is_new )
    {
      $data['update_account'] = $this->account_model->get_by_id($id);
      $data['update_account_details'] = $this->account_details_model->get_by_account_id($id);
      $data['update_account_roles'] = $this->acl_role_model->get_by_account_id($id);
      $data['action'] = 'update';
    }
    $action = $data['action'];
    $data['title'] = lang("users_{$action}_page_name");
    // Setup form validation
    $this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
    $this->form_validation->set_rules(
      array(
        array(
          'field' => 'users_username',
          'label' => 'lang:profile_username',
          'rules' => 'trim|required|alpha_dash|min_length[3]|max_length[24]'),
        array(
          'field' => 'users_email', 
          'label' => 'lang:settings_email', 
          'rules' => 'trim|required|valid_email|max_length[160]'), 
        array(
          'field' => 'users_fullname', 
          'label' => 'lang:settings_fullname', 
          'rules' => 'trim|max_length[160]'), 
        array(
          'field' => 'users_firstname', 
          'label' => 'lang:settings_firstname', 
          'rules' => 'trim|max_length[80]'), 
        array(
          'field' => 'users_lastname', 
          'label' => 'lang:settings_lastname', 
          'rules' => 'trim|max_length[80]'),
        array(
          'field' => 'users_new_password', 
          'label' => 'lang:password_new_password', 
          'rules' => 'trim|'.($is_new?'required':'optional').'|min_length[6]'),
        array(
          'field' => 'users_retype_new_password', 
          'label' => 'lang:password_retype_new_password', 
          'rules' => 'trim|'.($is_new?'required':'optional').'|matches[users_new_password]')
      ));

    // Run form validation
    if ($this->form_validation->run())
    {

      $email_taken = $this->email_check($this->input->post('users_email', TRUE));
      $username_taken = $this->username_check($this->input->post('users_username'));

      // If user is changing email and new email is already taken OR
      // if this is a new user, just check if it's been taken already.
      if ( (! empty($id) && strtolower($this->input->post('users_email', TRUE)) != strtolower($data['update_account']->email) && $email_taken) || (empty($id) && $email_taken) )
      {
        $data['users_email_error'] = lang('settings_email_exist');
      }
      // Check if user name is taken
      elseif ( (! empty($id) && strtolower($this->input->post('users_username', TRUE)) != strtolower($data['update_account']->username) && $username_taken) || (empty($id) && $username_taken) )
      {
        $data['users_username_error'] = lang('sign_up_username_taken');
      }
      else
      {

        // Create a new user
        if( empty($id) ) {
          $id = $this->account_model->create(
            $this->input->post('users_username', TRUE), 
            $this->input->post('users_email', TRUE), 
            $this->input->post('users_new_password', TRUE));
        }
        // Update existing user information
        else 
        {
          // Update account username
          $this->account_model->update_username($id, 
            $this->input->post('users_username', TRUE) ? $this->input->post('users_username', TRUE) : NULL);

          // Update account email
          $this->account_model->update_email($id, 
            $this->input->post('users_email', TRUE) ? $this->input->post('users_email', TRUE) : NULL);

          // Update password
          $pass = $this->input->post('users_new_password', TRUE) ? $this->input->post('users_new_password', TRUE) : NULL;
          if( ! empty($pass) )
          {
            $this->account_model->update_password($id, $pass);
          }

          // Check if the user should be suspended
          if( $this->authorization->is_permitted('ban_users') ) 
          {
            if( $this->input->post('manage_user_ban', true) )
            {
              $this->account_model->update_suspended_datetime($id);
            }
            elseif( $this->input->post('manage_user_unban', true) )
            {
              $this->account_model->remove_suspended_datetime($id);
            }
          }
        }

        // Update account details
        $attributes = array();
        $attributes['fullname'] = $this->input->post('users_fullname', TRUE) ? $this->input->post('users_fullname', TRUE) : NULL;
        $attributes['firstname'] = $this->input->post('users_firstname', TRUE) ? $this->input->post('users_firstname', TRUE) : NULL;
        $attributes['lastname'] = $this->input->post('users_lastname', TRUE) ? $this->input->post('users_lastname', TRUE) : NULL;
        $this->account_details_model->update($id, $attributes);

        // Apply roles
        $roles = array();
        foreach($data['roles'] as $r)
        {
          if( $this->input->post("account_role_{$r->id}", TRUE) )
          {
            $roles[] = $r->id;
          }
        }
        $this->rel_account_role_model->delete_update_batch($id, $roles);

        redirect("account/manage_users");
      }
    }

    // Load manage users view
    $this->load->view('account/manage_users_save', $data);
  }

  /**
   * Filter the user list by permission or role.
   *
   * @access public
   * @param string $type (permission, role)
   * @param int $id (permission_id, role_id)
   * @return void
   */
  function filter($type=null,$id=null)
  {
    $this->index();
  }

  /**
   * Check if a username exist
   *
   * @access public
   * @param string
   * @return bool
   */
  function username_check($username)
  {
    return $this->account_model->get_by_username($username) ? TRUE : FALSE;
  }

  /**
   * Check if an email exist
   *
   * @access public
   * @param string
   * @return bool
   */
  function email_check($email)
  {
    return $this->account_model->get_by_email($email) ? TRUE : FALSE;
  }

    /**
     * Created by: farjana
     * Date: 11/12/2018 (d/m/y)
     * Manage Users New
     */
    function manage_user_new()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if ( ! $this->authentication->is_signed_in())
        {
            redirect('account/sign_in/?continue='.urlencode(base_url().'account/manage_users/manage_user_new'));
        }

        // Redirect unauthorized users to account profile page
//        if ( ! $this->authorization->is_permitted('retrieve_users'))
//        {
//            redirect('account/account_profile');
//        }

        // Retrieve sign in user
        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['title'] = lang('users_page_name');
        // Setup form validation
        $this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
        $this->form_validation->set_rules(
            array(
                array(
                    'field' => 'user_name',
                    'label' => 'Username',
                    'rules' => 'trim'),
                array(
                    'field' => 'role_id',
                    'label' => 'Role Type',
                    'rules' => 'trim'),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|valid_email'),
                array(
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim')
            ));
        // Search Peramiters
        $this->form_validation->run();
        //$whereClause = array();
        if ($this->input->post('search_submit'))
        {
            $username = array();
            if($this->input->post('user_name')):
                $username = array('username'=>$this->input->post('user_name'));
            endif;

            $user_type = array();
            if($this->input->post('role_id')):
                $user_type = array('role_id'=>$this->input->post('role_id'));
            endif;

            $email = array();
            if($this->input->post('email')):
                $email = array('email'=>$this->input->post('email'));
            endif;

            $whereClause = array_merge($username, $user_type, $email);
            $this->session->set_userdata('whereClause',$whereClause);

            $fullname =NULL;
            if($this->input->post('name')):
                $fullname = $this->input->post('name');
            endif;
            $this->session->set_userdata('name',$fullname);
        }
        else
        {

            $fullname = $this->session->userdata('name');
            $whereClause = $this->session->userdata('whereClause');
            $whereClause=array();
            $fullname='';
        }

        //print_r($this->session->userdata('whereClause'));
        //exit;

        // Paginations
        $this->load->library('pagination');

        $config = array();
        $config['base_url'] = base_url().'index.php/account/manage_users/manage_user_new/';

        $config['total_rows'] = count($this->account_model->get($fullname, $whereClause, NULL, NULL,$this->session->userdata('account_id')));
        $config['num_links'] = 3;
        $config['per_page'] = $this->config->item("pagination_perpage");
        $config['uri_segment'] = 4;

        $config['full_tag_open'] = '<nav><ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul></nav><!--pagination-->';

        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;


        // Get all user information
        $all_accounts = $this->account_model->get($fullname, $whereClause, $page, $config['per_page'],$this->session->userdata('account_id'));

//        echo "<pre>" ;
//        print_r($all_accounts);
//         exit();

        $all_account_details = $this->account_details_model->get();
        $all_account_roles = $this->rel_account_role_model->get();
        $data['all_roles'] = $this->general_model->get_all_table_info_asc_desc('a3m_acl_role', 'id', 'asc');
        /*echo "<pre>"; print_r($all_roles); echo "</pre>";
        exit;*/
        $admin_role = $this->acl_role_model->get_by_name('Admin');
        $data["links"] = $this->pagination->create_links();
        // Compile an array for the view to use
        $data['all_accounts'] = array();
        foreach ( $all_accounts as $acc )
        {
            $current_user = array();
            $current_user['id'] = $acc->id;
            $current_user['username'] = $acc->username;
            $current_user['email'] = $acc->email;
            $current_user['name'] = $acc->name;
            $current_user['firstname'] = '';
            $current_user['lastname'] = '';
            $current_user['is_admin'] = FALSE;
            $current_user['is_banned'] = isset( $acc->suspendedon );

            foreach( $all_account_details as $det )
            {
                if( $det->account_id == $acc->id )
                {
                    $current_user['fullname'] = $det->fullname;
                    $current_user['firstname'] = $det->firstname;
                    $current_user['lastname'] = $det->lastname;
                }
            }

            foreach( $all_account_roles as $acrole )
            {
                if( $acrole->account_id == $acc->id && $acrole->role_id == $admin_role->id )
                {
                    $current_user['is_admin'] = TRUE;
                    break;
                }
            }

            // Append to the array
            $data['all_accounts'][] = $current_user;
        }

        // Load manage users view
        $this->load->view('account/manage_users_new', $data);
    }

}

/* End of file manage_users.php */
/* Location: ./application/account/controllers/manage_users.php */
