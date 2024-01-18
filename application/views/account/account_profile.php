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
                        
                        <li class="active">
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
                        
                        <li>
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
                                        <strong><?= lang('account_profile'); ?> </strong>
                                        <!-- <div class="pull-right hidden-print">
                                            <span data-placement="top" data-toggle="tooltip" title="<?= lang('basic_info').' '. lang('action_update') ?>">
                                                <a href="<?= base_url() ?>" class="text-default text-sm ml btn-link"><?= lang('action_update') ?></a>
                                            </span>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="panel-body form-horizontal">
                                    <?php if (isset($profile_info))
                                    {
                                    ?>
                                    <div class="alert alert-success fade in">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <?php echo $profile_info; ?>
                                    </div>
                                    <?php } ?>

                                    

                                    <div class="well"><?php echo lang('profile_instructions'); ?></div>

                                    <?php echo form_open_multipart(uri_string(), 'class="form-horizontal"'); ?>
                                    <?php echo form_fieldset(); ?>
                                    
                                    <div class="form-group <?php echo (form_error('profile_username')) ? 'error' : ''; ?>">
                                        <label class="col-md-3 control-label" for="profile_username"><?php echo lang('profile_username'); ?></label>
                                        <div class="col-md-4">
                                            <?php echo form_input(array('name' => 'profile_username', 'class'=> 'form-control input-md', 'id' => 'profile_username', 'value' => set_value('profile_username') ? set_value('profile_username') : (isset($account->username) ? $account->username : ''), 'maxlength' => '24')); ?>
                                            <?php if (form_error('profile_username') || isset($profile_username_error))
                                        {
                                            ?>
                                            <span class="help-inline">
                                            <?php
                                                echo form_error('profile_username');
                                                echo isset($profile_username_error) ? $profile_username_error : '';
                                                ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group <?php echo (form_error('profile_username')) ? 'error' : ''; ?>">
                                        <label class="col-md-3 control-label" for="profile_picture"><?php echo lang('profile_picture'); ?></label>

                                        <div class="col-md-4">
                                        <p>
                                            <?php if (isset($account_details->picture) && strlen(trim($account_details->picture)) > 0) : ?>
                                            <?php echo showPhoto($account_details->picture); ?> &nbsp;
                                            <?php echo anchor('account/account_profile/index/delete', '<i class="icon-trash"></i> '.lang('profile_delete_picture'), 'class="btn"'); ?>
                                            <?php else : ?>
                                                
                                                <div class="accountPicSelect clearfix">
                                                    <div class="pull-left">
                                                        <input type="radio" name="pic_selection" value="custom" checked="true" />
                                                        <?php echo showPhoto(); ?>
                                                    </div>
                                                    <div class="pull-left">
                                                        <p><?php echo lang('profile_custom_upload_picture'); ?><br>
                                                            <?php echo form_upload(array('name' => 'account_picture_upload', 'id' => 'account_picture_upload')); ?><br>
                                                            <small>(<?php echo lang('profile_picture_guidelines'); ?>)</small>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="accountPicSelect clearfix">
                                                    <div class="pull-left">
                                                        <input type="radio" name="pic_selection" value="gravatar" />
                                                        <?php echo showPhoto( $gravatar ); ?>
                                                    </div>
                                                    <div class="pull-left">
                                                        <p>
                                                            <small><a href="http://gravatar.com/" target="_blank">Gravatar</a></small>
                                                        </p>
                                                    </div>
                                                </div>
                                            
                                            <?php endif; ?>
                                            </p>
                                            <?php if ( ! isset($account_details->picture)) : ?>
                                            <?php endif; ?>

                                            <?php if (isset($profile_picture_error))
                                            {
                                            ?>
                                            <span class="help-inline">
                                            <?php echo $profile_picture_error; ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                      <div class="col-md-6 col-md-offset-3">
                                            <button type="submit" class="btn btn-success"><?php echo lang('profile_save'); ?></button>
                                        <button type="reset" class="btn btn-small">Cancel</button>
                                      </div>
                                    </div>
                                    <?php echo form_fieldset_close(); ?>
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

  </body>
</html>