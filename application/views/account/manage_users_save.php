<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            $this->load->view('components/head');
        ?>        
        <!-- Custom Theme Style -->
        <link href="<?= base_url() ?>resource/build/css/custom.min.css" rel="stylesheet">
    </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <?php
                // $this->load->view('admin/components/sidebar');
            ?>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
            <?php
                // $this->load->view('admin/components/top_nav');
            ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <?php
                        // $this->load->view('admin/components/page_title');
                    ?>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo lang("user_info"); ?> <small class="text-danger"><?= lang('star_requered') ?></small></h2>
                                    <a href="<?= base_url('account/manage_users') ?>" class="btn btn-info btn-xs pull-right">
                                        <i class="fa fa-list-alt"></i>
                                    </a>           
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <?php echo form_open(uri_string(), 'class="form-horizontal" novalidate'); ?>
                                
                                <div class="item form-group <?php echo (form_error('users_username') || isset($users_username_error)) ? 'has-error' : ''; ?>">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="users_username"><?php echo lang('profile_username'); ?>
                                        <span class="required">*</span>
                                    </label>

                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                      <?php echo form_input(array('name' => 'users_username', 'id' => 'users_username', 'required' =>'required', 'class'=>'form-control', 'value' => set_value('users_username') ? set_value('users_username') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 160)); ?>

                                      <?php if (form_error('users_username') || isset($users_username_error)) : ?>
                                        <span class="help-inline">
                                        <?php
                                          echo form_error('users_username');
                                          echo isset($users_username_error) ? $users_username_error : '';
                                        ?>
                                        </span>
                                      <?php endif; ?>
                                    </div>
                                </div>

                                <div class="item form-group <?php echo (form_error('users_email') || isset($users_email_error)) ? 'error' : ''; ?>">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="users_email"><?php echo lang('settings_email'); ?>
                                        <span class="required">*</span>
                                    </label>

                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                      <?php echo form_input(array('name' => 'users_email', 'id' => 'users_email', 'class'=>'form-control', 'required' => 'required', 'value' => set_value('users_email') ? set_value('users_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160)); ?>

                                      <?php if (form_error('users_email') || isset($users_email_error)) : ?>
                                        <span class="help-inline">
                                        <?php
                                          echo form_error('users_email');
                                          echo isset($users_email_error) ? $users_email_error : '';
                                        ?>
                                        </span>
                                      <?php endif; ?>
                                    </div>
                                </div>

                                <div class="item form-group <?php echo (form_error('users_fullname')) ? 'has-error' : ''; ?>">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="users_fullname"><?php echo lang('settings_fullname'); ?>
                                      <span class="required">*</span>
                                  </label>

                                  <div class="col-md-5 col-sm-5 col-xs-12">
                                    <?php echo form_input(array('name' => 'users_fullname', 'id' => 'users_fullname', 'class'=>'form-control', 'required' => 'required', 'value' => set_value('users_fullname') ? set_value('users_fullname') : (isset($update_account_details->fullname) ? $update_account_details->fullname : ''), 'maxlength' => 160)); ?>

                                    <?php if (form_error('users_fullname')) : ?>
                                      <span class="help-inline">
                                        <?php echo form_error('users_fullname'); ?>
                                      </span>
                                    <?php endif; ?>
                                  </div>
                                </div>

                                <div class="item form-group <?php echo (form_error('users_firstname')) ? 'error' : ''; ?>">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="users_firstname"><?php echo lang('settings_firstname'); ?>
                                        <span class="required">*</span>
                                    </label>

                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                    <?php echo form_input(array('name' => 'users_firstname', 'id' => 'users_firstname', 'class'=>'form-control', 'required' => 'required', 'value' => set_value('users_firstname') ? set_value('users_firstname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80)); ?>
                                    <?php if (form_error('users_firstname')) : ?>
                                        <span class="help-inline">
                                          <?php echo form_error('users_firstname'); ?>
                                          </span>
                                    <?php endif; ?>
                                    </div>
                                </div>

                                <div class="item form-group <?php echo (form_error('users_lastname')) ? 'error' : ''; ?>">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="users_lastname"><?php echo lang('settings_lastname'); ?>
                                        <span class="required">*</span>
                                    </label>

                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                    <?php echo form_input(array('name' => 'users_lastname', 'id' => 'users_lastname', 'required' => 'required', 'class'=>'form-control', 'value' => set_value('users_lastname') ? set_value('users_lastname') : (isset($update_account_details->lastname) ? $update_account_details->lastname : ''), 'maxlength' => 80)); ?>
                                    <?php if (form_error('users_lastname')) : ?>
                                        <span class="help-inline">
                                          <?php echo form_error('users_lastname'); ?>
                                        </span>
                                    <?php endif; ?>
                                    </div>
                                </div>

                                <div class="item form-group <?php echo (form_error('users_new_password')) ? 'error' : ''; ?>">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="users_new_password"><?php echo lang('password_new_password'); ?>
                                  <?php
                                  if(!isset($update_account->password) ){
                                  ?>
                                      <span class="required">*</span>
                                      <?php
                                      }?>
                                  </label>

                                  <div class="col-md-5 col-sm-5 col-xs-12">
                                    <?php echo form_password(array('name' => 'users_new_password', 'id' => 'users_new_password', 'class'=>'form-control', 'value' => set_value('users_new_password'), 'autocomplete' => 'off')); ?>

                                    <?php if (form_error('users_new_password')) : ?>
                                      <span class="help-inline">
                                        <?php echo form_error('users_new_password'); ?>
                                      </span>
                                    <?php endif; ?>
                                  </div>
                                </div>

                                <div class="item form-group <?php echo (form_error('users_retype_new_password')) ? 'error' : ''; ?>">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="users_retype_new_password"><?php echo lang('password_retype_new_password'); ?>
                                      <?php
                                  if(!isset($update_account->password) ){
                                  ?>
                                      <span class="required">*</span>
                                      <?php
                                      }?>
                                  </label>

                                  <div class="col-md-5 col-sm-5 col-xs-12">
                                    <?php echo form_password(array('name' => 'users_retype_new_password', 'id' => 'users_retype_new_password', 'class'=>'form-control', 'value' => set_value('users_retype_new_password'), 'autocomplete' => 'off')); ?>
                                    
                                    <?php if (form_error('users_retype_new_password')) : ?>
                                      <span class="help-inline">
                                        <?php echo form_error('users_retype_new_password'); ?>
                                      </span>
                                    <?php endif; ?>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="col-md-3 control-label" for="checkboxes"><?php echo lang('users_roles'); ?>
                                      <span class="required">*</span>
                                  </label>
                                  <div class="col-md-5">
                                        <?php foreach($roles as $role) : 
                                          $check_it = FALSE;
                                          
                                          if( isset($update_account_roles) ) 
                                          {
                                            foreach($update_account_roles as $acrole) 
                                            {
                                              if($role->id == $acrole->id)
                                              {
                                                $check_it = TRUE; break;
                                              }
                                            }
                                          }
                                          ?>

                                          <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox("account_role_{$role->id}", 'apply', $check_it); ?>
                                            <?php echo $role->name; ?>
                                            </label>
                                          </div>
                                        <?php endforeach; ?>
                                      
                                  </div>
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-6 col-md-offset-3">
                                    <?php echo form_submit('manage_user_submit', lang('settings_save'), 'class="btn btn-success"'); ?>
                                    <?php echo anchor('account/manage_users', lang('website_cancel'), 'class="btn btn-default"'); ?>
                                    <?php if( $this->authorization->is_permitted('ban_users') && $action == 'update' ): ?>
                                      <span><?php echo lang('admin_or');?></span>
                                      <?php if( isset($update_account->suspendedon) ): ?>
                                        <?php echo form_submit('manage_user_unban', lang('users_unban'), 'class="btn btn-warning"'); ?>
                                      <?php else: ?>
                                        <?php echo form_submit('manage_user_ban', lang('users_ban'), 'class="btn btn-danger"'); ?>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                  </div>
                                </div>


                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <?php echo lang('website_footer_text').' '.date("Y");?> 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <?php
    // $this->load->view('admin/components/footer');
    ?>
    <!-- validator -->
    <script src="<?= base_url() ?>resource/plugins/validator/validator.js"></script> 
    <!-- Custom -->
    <script src="<?= base_url() ?>resource/build/js/custom.min.js"></script>
    
  </body>
</html>