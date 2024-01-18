<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            $this->load->view('admin/components/htmlheader');
        ?>        
        <!-- Custom Theme Style -->
        <link href="<?= base_url() ?>resource/build/css/custom.min.css" rel="stylesheet">
    </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <?php
                $this->load->view('admin/components/sidebar');
            ?>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
            <?php
                $this->load->view('admin/components/top_nav');
            ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <?php
                        $this->load->view('admin/components/page_title');
                    ?>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo lang("roles_{$action}_page_name"); ?> <small class="text-danger"><?= lang('star_requered') ?></small></h2>
                                    <a href="<?= base_url('account/manage_roles') ?>" class="btn btn-info btn-xs pull-right">
                                        <i class="fa fa-list-alt"></i>
                                    </a>           
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            <?php echo form_open(uri_string(), 'class="form-horizontal" novalidate'); ?>

                                  <div class="item form-group <?php echo (form_error('role_name') || isset($role_name_error)) ? 'has-error' : ''; ?>">
                                      <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="role_name"><?php echo lang('roles_name'); ?>
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-5 col-sm-5 col-xs-12">
                                        <?php if( $is_system ) : ?>
                                          <?php echo form_hidden('role_name', set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : '')); ?>

                                          <span class="input uneditable-input"><?php echo $role->name; ?></span><span class="help-block"><?php echo lang('roles_system_name'); ?></span>
                                        <?php else : ?>
                                          <?php echo form_input(array('name' => 'role_name', 'id' => 'role_name', 'class'=>'form-control', 'value' => set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : ''), 'maxlength' => 80)); ?>

                                          
                                        <?php endif; ?>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <?php if (form_error('role_name') || isset($role_name_error)) : ?>
                                            <span class="text-danger">
                                            <?php
                                              echo form_error('role_name');
                                              echo isset($role_name_error) ? $role_name_error : '';
                                            ?>
                                            </span>
                                          <?php endif; ?>
                                      </div>
                                  </div>

                                  <div class="item form-group <?php echo form_error('role_description') ? 'error' : ''; ?>">
                                      <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="role_description"><?php echo lang('roles_description'); ?></label>

                                      <div class="col-md-5 col-sm-5 col-xs-12">
                                        <?php echo form_textarea(array('name' => 'role_description', 'id' => 'role_description', 'class'=>'form-control', 'value' => set_value('role_description') ? set_value('role_description') : (isset($role->description) ? $role->description : ''), 'maxlength' => 160, 'rows'=>'4')); ?>

                                        <?php if (form_error('role_description') || isset($role_name_error)) : ?>
                                          <span class="help-inline">
                                          <?php
                                            echo form_error('role_description');
                                          ?>
                                          </span>
                                        <?php endif; ?>
                                      </div>
                                  </div>

                                  <div class="item form-group">
                                      <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="settings_lastname"><?php echo lang('roles_permission'); ?></label>

                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                           <?php foreach( $permissions as $perm ) : ?>
                                             <?php
                                               $check_it = FALSE;

                                               if( isset($role_permissions) )
                                               {
                                                 foreach( $role_permissions as $rperm )
                                                 {
                                                   if( $rperm->id == $perm->id )
                                                   {
                                                     $check_it = TRUE; break;
                                                   }
                                                 }
                                               }
                                             ?>
                                             <div class="checkbox">
                                               <label>
                                               <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it); ?>
                                               <?php echo $perm->key; ?>
                                               </label>
                                           </div>
                                           <?php endforeach; ?> 
                                        </div>                                      
                                  </div>
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <?php echo form_submit('manage_role_submit', lang('settings_save'), 'class="btn btn-success"'); ?>
                                            <?php echo anchor('account/manage_roles', lang('website_cancel'), 'class="btn btn-default"'); ?>
                                            <?php if( $this->authorization->is_permitted('delete_roles') && $action == 'update' && ! $is_system ): ?>
                                              <span><?php echo lang('admin_or');?></span>
                                              <?php if( isset($role->suspendedon) ): ?>
                                                <?php echo form_submit('manage_role_unban', lang('roles_unban'), 'class="btn btn-danger"'); ?>
                                              <?php else: ?>
                                                <?php echo form_submit('manage_role_ban', lang('roles_ban'), 'class="btn btn-danger"'); ?>
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
    $this->load->view('admin/components/footer');
    ?>
    <!-- validator -->
    <script src="<?= base_url() ?>resource/plugins/validator/validator.js"></script> 
    <!-- Custom -->
    <script src="<?= base_url() ?>resource/build/js/custom.min.js"></script>
    
  </body>
</html>