<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            $this->load->view('admin/components/htmlheader');
        ?>  
        <!-- Custom Theme Style -->
        <link href="<?= base_url() ?>resource/build/css/app.css" rel="stylesheet">
        <link href="<?= base_url() ?>resource/build/css/bg-green-dark.css" rel="stylesheet">      
        <!-- Custom Theme Style -->
        <link href="<?= base_url() ?>resource/build/css/custom.min.css" rel="stylesheet">
        <style type="text/css">
            .nav > li.active{
                background: #2A3F54;
            }
            .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus{
                    background-color: #2b957a;
            }
            .nav-stacked > li + li{
                margin-top: 0px;
            }
            .panel {
                border-radius: 0px;
            }
            .table > thead > tr > th{
                padding: 2px 8px;
            }
            .btn_custom{
                padding: 2px 3px;
            }
        </style>
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
            <div class="page-title">
                <?php
                    $this->load->view('admin/components/page_title');
                ?>
            </div>
            <div class="clearfix"></div>
            
            <div class="row mt-lg">
                <div class="col-sm-3 col-md-3 col-xs-12">
                    <ul class="nav nav-pills nav-stacked navbar-custom-nav">
                        
                        <li>
                            <a href="<?= base_url('account/account_profile') ?>"> 
                                <i class="fa fa-user"></i>
                                <?= lang('website_profile') ?>
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?= base_url('account/account_settings') ?>">
                            <i class="fa fa-cog"></i>  
                            <?=lang('website_account')?></a>
                        </li>
                        
                        <li class="active">
                            <a href="<?= base_url('account/account_password') ?>">
                                <i class="fa fa-unlock-alt"></i>
                                <?= lang('website_password') ?>
                            </a>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <div class="tab-content" style="border: 0; padding:0;">
                        
                        <div class="active" style="position: relative;">
                            <div class="panel panel-custom">
                                <!-- Default panel contents -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><?= lang('password_page_name'); ?> </strong>
                                        
                                    </div>
                                </div>
                                <div class="panel-body form-horizontal">
                                    <?php if ($this->session->flashdata('password_info')) : ?>
                                            <div class="alert alert-success fade in">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <?php echo $this->session->flashdata('password_info'); ?>
                                            </div>
                                            <?php endif; ?>

                                            <div class="well">
                                                <?php echo lang('password_safe_guard_your_account'); ?>
                                            </div>
                                            
                                            
                                            <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

                                            <br>

                                            <div class="item form-group <?php echo (form_error('password_new_password')) ? 'has-error' : ''; ?>">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_new_password"><?php echo lang('password_new_password'); ?></label>

                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <div class="input-group">
                                                        <?php echo form_password(array('name' => 'password_new_password', 'id' => 'password_new_password',  'class'=>'form-control', 'value' => set_value('password_new_password'), 'autocomplete' => 'off')); ?>
                                                        <span class="input-group-addon">     
                                                            <input data-toggle="tooltip" data-placement="top" title="Show Password" id="show-password" type="checkbox">     
                                                        </span>
                                                    </div>
                                                    
                                                    <?php if (form_error('password_new_password'))
                                                {
                                                    ?>
                                                    <span class="help-inline">
                                                    <?php echo form_error('password_new_password'); ?>
                                                    </span>
                                                    <?php } ?>
                                                </div>
                                                
                                            </div>

                                            <div class="form-group <?php echo (form_error('password_retype_new_password')) ? 'has-error' : ''; ?>">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_retype_new_password"><?php echo lang('password_retype_new_password'); ?></label>

                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <div class="input-group">
                                                    <?php echo form_password(array('name' => 'password_retype_new_password', 'id' => 'password_retype_new_password',  'class'=>'form-control', 'value' => set_value('password_retype_new_password'), 'autocomplete' => 'off')); ?>
                                                        <span class="input-group-addon">     
                                                            <input data-toggle="tooltip" data-placement="top" title="Show Password" id="show-password2" type="checkbox">     
                                                        </span>
                                                    </div>
                                                    <?php if (form_error('password_retype_new_password'))
                                                {
                                                    ?>
                                                    <span class="help-inline">
                                                    <?php echo form_error('password_retype_new_password'); ?>
                                                    </span>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                              <div class="col-md-6 col-md-offset-3">
                                                    <button type="submit" class="btn btn-success"><?php echo lang('password_change_my_password'); ?></button>
                                                <button type="reset" class="btn btn-small">Cancel</button>
                                              </div>
                                            </div>
                                            <?php echo form_close(); ?>
                                                                             
                                </div>
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
    <!-- Custom -->
    <script src="<?= base_url() ?>resource/build/js/custom.min.js"></script>
    <script src="<?= base_url() ?>resource/build/js/hideShowPassword.min.js"></script>
    <script type="text/javascript">
        $('#show-password').change(function(){
          $('#password_new_password').hideShowPassword($(this).prop('checked'));
        });
        $('#show-password2').change(function(){
          $('#password_retype_new_password').hideShowPassword($(this).prop('checked'));
        });
    </script>
  </body>
</html>