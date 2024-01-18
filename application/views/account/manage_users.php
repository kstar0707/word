<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $this->load->view('components/head');
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
                // $this->load->view('components/sidebar');
            ?>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
            <?php
                // $this->load->view('components/top_nav');
            ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">            
            <div class="page-title">
                <?php
                    // $this->load->view('admin/components/page_title');
                ?>
            </div>
            <div class="clearfix"></div>
            
            <div class="row mt-lg">
                
                <div class="col-sm-12 col-xs-12">
                    <div class="x_panel" style="border: 0; padding:0;">
                        
                        <div class="active" style="position: relative;">
                            <div class="x_panel">
                                <!-- Default panel contents -->
                                <div class="x_title">
                                    <h2><?= lang('users_list'); ?> </h2>
                                    <?php if( $this->authorization->is_permitted('create_users') ): ?>
                                    <a class="btn btn-success pull-right" href="<?= base_url('account/manage_users/save') ?>">
                                        <i class="fa fa-plus"></i> 
                                        <?php echo lang('website_create'); ?>
                                    </a>
                                    <?php endif;?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="form-horizontal" role="form" id="create-site-form"  name="create-site-form" action="<?= base_url('account/manage_users') ?>" method="post">  
                                    <table class="table table-bordered">
                                      
                                      <tr class="info">
                                        
                                        <td>
                                        <input id="user_name" name="user_name" type="text" placeholder="<?=lang('users_username')?>" value="<?php echo set_value('user_name');?>" class="form-control input-sm"> 
                                        </td>
                                        <td>
                                        <input id="email" name="email" type="text" placeholder="<?=lang('email')?>" value="<?php echo set_value('email');?>" class="form-control input-sm">
                                        </td>        
                                        <td>
                                        <input id="fullname" name="fullname" type="text" placeholder="<?=lang('fullname')?>" value="<?php echo set_value('fullname');?>" class="form-control input-sm">
                                        </td>
                                        <td>
                                        <div class="col-md-12">
                                        <select name="role_id" class="form-control input-sm" id="user_role">
                                            <option value=""><?php echo lang('select_all'); ?></option>            
                                            <?php foreach ($all_roles as $role) : ?>
                                            <option value="<?php echo $role->id; ?>" <?php if(set_value('role_id')==$role->id) echo "selected";?> ><?php echo $role->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                        </td>
                                        
                                         <td>
                                         
                                         <input type="submit" class="btn btn-info" name="search_submit" value="<?=lang('action_search')?>">
                                        
                                        </td>
                                      </tr>
                                      
                                    </table>
                                </form>
                                    <table class="table table-hover table-bordered">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th><?php echo lang('fullname'); ?></th>
                                          <th><?php echo lang('users_username'); ?></th>
                                          <th><?php echo lang('settings_email'); ?></th>
                                          <th>
                                            <?= lang('action') ?>
                                          </th>
                                        </tr>
                                      </thead>
                                  <?php if( count($all_accounts) > 0 ) : ?>
                                    
                                      <tbody>

                                        <?php foreach( $all_accounts as $acc ) : ?>
                                          <tr>
                                            <td><?php echo $acc['id']; ?></td>
                                            <td><?php echo $acc['fullname']; ?></td>
                                            <td>
                                              <?php echo $acc['username']; ?>
                                              <?php if( $acc['is_banned'] ): ?>
                                                <span class="label label-important"><?php echo lang('users_banned'); ?></span>
                                              <?php elseif( $acc['is_admin'] ): ?>
                                                <span class="label label-info"><?php echo lang('users_admin'); ?></span>
                                              <?php endif; ?>
                                            </td>
                                            
                                            <td><?php echo $acc['email']; ?></td>
                                            
                                            <td>
                                              <?php if( $this->authorization->is_permitted('update_users') ): ?>
                                                <a href="account/manage_users/save/<?php echo $acc['id']; ?>" class="btn btn-warning btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                              <?php endif; ?>
                                            </td>
                                          </tr>
                                        <?php endforeach; ?>

                                      </tbody>        
                                     
                                  <?php else: ?>      
                                    <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            Data Not found
                                        </td>
                                    </tr>
                                  <?php endif;?>
                                    <tr>
                                        <td colspan="5"><?php echo $links; ?></td>
                                    </tr>
                                    </tfoot>
                                  </table>                               
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
        // $this->load->view('admin/components/footer');
    ?>
    
    <!-- Custom -->
    <script src="<?= base_url() ?>resource/build/js/custom.min.js"></script>

  </body>
</html>