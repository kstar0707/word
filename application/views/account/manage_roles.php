<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            $this->load->view('admin/components/htmlheader');
        ?>        
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
                
                <div class="col-sm-12 col-xs-12">
                    <div class="x_panel" style="border: 0; padding:0;">
                        
                        <div class="active" style="position: relative;">
                            <div class="x_panel">
                                <!-- Default panel contents -->
                                <div class="x_title">
                                    <h2><?php echo lang('roles_list'); ?></h2>
                                    <?php if( $this->authorization->is_permitted('create_roles') ): ?>
                                      <?php echo anchor('account/manage_roles/save', '<i class="fa fa-user-plus"></i> '.lang('website_create'), 'class="btn btn-success pull-right"'); ?>
                                    <?php endif; ?>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    
                                    <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th>#</th>
                                            <th><?php echo lang('roles_column_role'); ?></th>
                                            <th><?php echo lang('roles_column_users'); ?></th>
                                            <th><?php echo lang('roles_permission'); ?></th>
                                            <th>
                                              <?php echo lang('action'); ?>
                                            </th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach( $roles as $role ) : ?>
                                            <tr>
                                              <td><?php echo $role['id']; ?></td>
                                              <td>
                                                <?php echo $role['name']; ?>
                                                <?php if( $role['is_disabled'] ): ?>
                                                  <span class="label label-important"><?php echo lang('roles_banned'); ?></span>
                                                <?php endif; ?>
                                              </td>
                                              <td>
                                                <?php if( $role['user_count'] > 0 ) : ?>
                                                  <?php echo anchor('account/manage_users/filter/role/'.$role['id'], $role['user_count'], 'class="badge badge-info"'); ?>
                                                <?php else : ?>
                                                  <span class="badge">0</span>
                                                <?php endif; ?>
                                              </td>
                                              <td>
                                                <?php if( count($role['perm_list']) == 0 ) : ?>
                                                  <span class="label">No Permissions</span>
                                                <?php else : ?>
                                                  <ul class="list-inline">
                                                    <?php foreach( $role['perm_list'] as $itm ) : ?>
                                                      <li><?php echo anchor('account/manage_permissions/save/'.$itm['id'], $itm['key'], 'title="'.$itm['title'].'"'); ?></li>
                                                    <?php endforeach; ?>
                                                  </ul>
                                                <?php endif; ?>
                                              </td>
                                              <td>
                                                <?php if( $this->authorization->is_permitted('update_roles') ): ?>
                                                  <?php echo anchor('account/manage_roles/save/'.$role['id'], lang('website_update'), 'class="btn btn-default btn-sm"'); ?>
                                                <?php endif; ?>
                                              </td>
                                            </tr>
                                          <?php endforeach; ?>
                                        </tbody>
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
        $this->load->view('admin/components/footer');
    ?>
    
    <!-- Custom -->
    <script src="<?= base_url() ?>resource/build/js/custom.min.js"></script>

  </body>
</html>