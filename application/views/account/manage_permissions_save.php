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
                                <h2><?php echo lang("permissions_{$action}_page_name"); ?> <small class="text-danger"><?= lang('star_requered') ?></small></h2>
                                    <a href="<?= base_url('account/manage_permissions') ?>" class="btn btn-info btn-xs pull-right">
                                        <i class="fa fa-list-alt"></i>
                                    </a>           
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            <?php echo form_open(uri_string(), 'class="form-horizontal" novalidate'); ?>
                                  <div class="item form-group <?php echo (form_error('permission_key') || isset($permission_key_error)) ? 'has-error' : ''; ?>">
                                      <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="permission_key"><?php echo lang('permissions_key'); ?>
                                          <span class="required">*</span>
                                      </label>

                                      <div class="col-md-5 col-sm-5 col-xs-12">
                                        <?php if( $is_system ) : ?>
                                          <?php echo form_hidden('permission_key', set_value('permission_key') ? set_value('permission_key') : (isset($permission->key) ? $permission->key : '')); ?>

                                          <span class="input uneditable-input"><?php echo $permission->key; ?></span><span class="help-block"><?php echo lang('permissions_system_name'); ?></span>
                                        <?php else : ?>
                                          <?php echo form_input(array('name' => 'permission_key', 'id' => 'permission_key', 'class'=>'form-control', 'value' => set_value('permission_key') ? set_value('permission_key') : (isset($permission->key) ? $permission->key : ''), 'maxlength' => 80)); ?>

                                        <?php endif; ?>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <?php if (form_error('permission_key') || isset($permission_key_error)) : ?>
                                            <span class="text-danger" >
                                            <?php
                                              echo form_error('permission_key');
                                              echo isset($permission_key_error) ? $permission_key_error : '';
                                            ?>
                                            </span>
                                          <?php endif; ?>
                                      </div>
                                  </div>

                                  <div class="item form-group <?php echo form_error('permission_description') ? 'has-error' : ''; ?>">
                                      <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="permission_description"><?php echo lang('permissions_description'); ?></label>

                                      <div class="col-md-5 col-sm-5 col-xs-12">
                                        <?php echo form_textarea(array('name' => 'permission_description', 'id' => 'permission_description', 'class'=>'form-control', 'value' => set_value('permission_description') ? set_value('permission_description') : (isset($permission->description) ? $permission->description : ''), 'maxlength' => 160, 'rows'=>'4')); ?>

                                        <?php if (form_error('permission_description') || isset($permission_name_error)) : ?>
                                          <span class="help-inline">
                                          <?php
                                            echo form_error('permission_description');
                                          ?>
                                          </span>
                                        <?php endif; ?>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="settings_lastname"><?php echo lang('permissions_role'); ?></label>

                                      <div class="col-md-5 col-sm-5 col-xs-12">
                                        <?php foreach( $roles as $role ) : ?>
                                          <?php
                                            $check_it = FALSE;

                                            if( isset($role_permissions) )
                                            {
                                              foreach( $role_permissions as $rperm )
                                              {
                                                if( $rperm->id == $role->id )
                                                {
                                                  $check_it = TRUE; break;
                                                }
                                              }
                                            }
                                          ?>
                                          <div class="checkbox">
                                          <label>
                                            <?php echo form_checkbox("role_permission_{$role->id}", 'apply', $check_it); ?>
                                            <?php echo $role->name; ?>
                                          </label>
                                          </div>
                                        <?php endforeach; ?>
                                      </div>
                                  </div>
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <?php echo form_submit('manage_permission_submit', lang('settings_save'), 'class="btn btn-primary"'); ?>
                                        <?php echo anchor('account/manage_permissions', lang('website_cancel'), 'class="btn btn-default"'); ?>

                                        <?php if( $this->authorization->is_permitted('delete_permissions') && $action == 'update' && ! $is_system ): ?>
                                          <span><?php echo lang('admin_or');?></span>
                                          <?php if( isset($permission->suspendedon) ): ?>
                                            <?php echo form_submit('manage_permission_unban', lang('permissions_unban'), 'class="btn btn-danger"'); ?>
                                          <?php else: ?>
                                            <?php echo form_submit('manage_permission_ban', lang('permissions_ban'), 'class="btn btn-danger"'); ?>
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