<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
//        error_reporting(0);
            $this->load->view('components/head');
        ?>  
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
            .field-icon {
                float: right;
                margin-left: -25px;
                margin-top: -25px;
                position: relative;
                z-index: 2;
            }
        </style>
    </head>
  <body class="nav-md" style="background-color: #fff">
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
            </div>
            <div class="clearfix"></div>
            
            <div class="row mt-lg">
                
                <div class="col-sm-12 col-xs-12">
                    <div class="x_panel" style="border: 0; padding:0;">
                        
                        <div class="active" style="position: relative;">
                            <div class="x_panel">
                                <!-- Default panel contents -->
                                <div class="x_title">
                                    <h2>ユーザー管理<?//= lang('users_list'); ?> </h2>
                                    <?php if( $this->authorization->is_permitted('create_users') ): ?>
                                    <a class="btn btn-success pull-right" href="<?= base_url('account/manage_users/save') ?>">
                                        <i class="fa fa-plus"></i> 
                                        <?php echo lang('website_create'); ?>
                                    </a>
                                    <?php endif;?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="form-horizontal" role="form" id="create-site-form"  name="create-site-form" action="<?= base_url('index.php/account/manage_users/manage_user_new') ?>" method="post">
                                    <table class="table table-bordered">
                                      
                                      <tr class="info">
                                        
                                        <td>
                                        <input id="user_name" name="user_name" type="text" placeholder="電話番号<?php //echo lang('users_username')?>" value="<?php echo set_value('user_name');?>" class="form-control input-sm">
                                        </td>
<!--                                        <td>-->
<!--                                        <input id="email" name="email" type="text" placeholder="--><?php //echo lang('email')?><!--" value="--><?php //echo set_value('email');?><!--" class="form-control input-sm">-->
<!--                                        </td>        -->
                                        <td>
                                        <input id="name" name="name" type="text" placeholder="氏名<?php //echo lang('fullname')?>" value="<?php echo set_value('name');?>" class="form-control input-sm">
                                        </td>
<!--                                        <td>-->
<!--                                        <div class="col-md-12">-->
<!--                                        <select name="role_id" class="form-control input-sm" id="user_role">-->
<!--                                            <option value="">--><?php //echo lang('select_all'); ?><!--</option>            -->
<!--                                            --><?php //foreach ($all_roles as $role) : ?>
<!--                                            <option value="--><?php //echo $role->id; ?><!--" --><?php //if(set_value('role_id')==$role->id) echo "selected";?><!-- >--><?php //echo $role->name; ?><!--</option>-->
<!--                                            --><?php //endforeach; ?>
<!--                                        </select>-->
<!--                                        </div>-->
<!--                                        </td>-->
                                        
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
<!--                                          <th>--><?php //echo lang('fullname'); ?><!--</th>-->
                                          <th>電話番号<?php //echo lang('users_username'); ?></th>
                                          <th>氏名<?php //echo lang('settings_email'); ?></th>
                                          <th style="text-align: right">
                                              <a href="javascript:void(0);" class="btn btn-info add_edit_user_form">
                                              新しいユーザーを作成する
                                              </a>
                                            <?//= lang('action') ?>
                                          </th>
                                        </tr>
                                      </thead>
                                  <?php if( count($all_accounts) > 0 ) : ?>
                                    
                                      <tbody>

                                        <?php foreach( $all_accounts as $acc ) : ?>
                                          <tr>
                                            <td><?php echo $acc['id']; ?></td>
<!--                                            <td>--><?php //echo $acc['fullname']; ?><!--</td>-->
                                            <td>
                                              <?php echo $acc['username']; ?>
                                                <input type="hidden" id="username_<?php echo $acc['id']; ?>" name="username" value="<?= $acc['username']; ?>">
<!--                                              --><?php //if( $acc['is_banned'] ): ?>
<!--                                                <span class="label label-important">--><?php //echo lang('users_banned'); ?><!--</span>-->
<!--                                              --><?php //elseif( $acc['is_admin'] ): ?>
<!--                                                <span class="label label-info">--><?php //echo lang('users_admin'); ?><!--</span>-->
<!--                                              --><?php //endif; ?>
                                            </td>
                                            
                                            <td><?php echo $acc['name']; ?>
                                                <input type="hidden" id="name_<?php echo $acc['id']; ?>" name="name" value="<?= $acc['name']; ?>">
                                            </td>
                                            
                                            <td style="width: 20%; text-align: center;">
                                              <?php //if( $this->authorization->is_permitted('update_users') ): ?>
                                                <a id="<?php echo $acc['id']; ?>" href="javascript:void(0);" class="btn btn-warning btn-xs add_edit_user_form">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                              <?php //endif; ?>
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
            <?php //echo lang('website_footer_text').' '.date("Y");?>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <?php
        // $this->load->view('admin/components/footer');
    ?>
    <div class="col-md-4 col-sm-4 col-xs-12 pull-right hide" id="sign_up_aria"
         style="position: fixed; right: 0px; bottom: 0px; padding: 4px;">
        <div class="panel panel-default" style="margin-bottom: 0;">
            <div class="panel-body">
                <form class="form-horizontal">
                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="singlebutton"></label>
                        <div class="col-md-9">
                            <button type="button" id="save_sign_up" title="登録" name="singlebutton"
                                    class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> 登録
                            </button>
                            <button type="button" id="close_sign_up" title="戻る" name="singlebutton"
                                    class="btn btn-default "><i class="fa fa-user-close" aria-hidden="true"></i> 戻る
                            </button>
                        </div>
                    </div>
                    <!-- Text Username/ Mobile-->
                    <div class="form-group <?= (form_error('sign_up_username') || isset($sign_up_username)) ? 'has-error' : ''; ?>">
                        <label class="col-md-3 control-label" for="sign_up_username">携帯番号</label>
                        <div class="col-md-9">
                            <input id="sign_up_username" style="ime-mode:active" type="text" class="form-control"
                                   name="sign_up_username" required="required"
                                   value="<?= set_value('sign_up_username') ?>" placeholder="携帯番号">

                        </div>
                    </div>
                    <!-- Name input-->
                    <div class="form-group <?= (form_error('sign_up_name') || isset($sign_up_name)) ? 'has-error' : ''; ?>">
                        <label class="col-md-3 control-label" for="sign_up_name"> 氏名</label>
                        <div class="col-md-9">
                            <input id="sign_up_name" style="ime-mode:active" type="text" class="form-control"
                                   name="sign_up_name" required="required"
                                   value="<?= set_value('sign_up_name') ?>" placeholder="氏名">
                            <input type="hidden" id="user_type" name="user_type"
                                   value="2">
                            <input type="hidden" id="company_id" name="company_id"
                                   value="<?php echo $account->id; ?>">
                            <input type="hidden" id="company_name" name="company_name"
                                   value="<?php echo $account->company_name; ?>">
                            <input type="hidden" id="user_id" name="user_id"
                                   value="0">
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group <?= (form_error('sign_up_password')) ? 'has-error' : ''; ?>">
                        <label class="col-md-3 control-label" for="sign_up_password">パスワード</label>
                        <div class="col-md-9">
                            <input id="sign_up_password" type="password" required="required" class="form-control"
                                   name="sign_up_password" onpaste="return false;" placeholder="パスワード（4桁以上）"
                                   value="<?= set_value('sign_up_password') ?>">
                            <span toggle="#sign_up_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="col-md-4 col-sm-4 col-xs-12 pull-right hide" id="sign_up_success"
         style="position: fixed; right: 0px; bottom: 0px; padding: 4px;">

        <div class="panel panel-success" style="margin-bottom: 0">
            <div class="panel-body">
                <p>携帯番号 : <span id="sign_up_phone_show"></span></p>
                <p>氏名 : <span id="sign_up_name_show"></span></p>
                <p>パスワード : <span id="sign_up_password_show"></span></p>
                <p class="text-success">登録が完了しました。</p>
                <button type="button" class="btn btn-default" id="success_close">戻る</button>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-12 pull-right hide" id="user_change_pass_error_message"
         style="position: fixed; right: 0px; bottom: 0px; padding: 4px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; text-align: center;">
        <p style="text-align: center; padding: 10px;"><span id="error_message_text"></span></p>
        <button type="button" class="btn btn-default" id="message_close">確認
        </button>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-12 pull-right hide" id="success_message"
         style="position: fixed; right: 0px; bottom: 0px; padding: 4px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; text-align: center;">
        <p style="text-align: center; padding: 10px;"><span id="success_message_text"
                                                            style="font-size: 18px; font-weight: bold;"></span></p>
        <button type="button" class="btn btn-success" id="success_message_close" style="border: 2px solid blue;">確認
        </button>
    </div>


<!--    <script src="--><?//= base_url() ?><!--resource/build/js/custom.min.js"></script>-->
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".add_edit_user_form").click(function (event) {
                var acc_id=this.id;
                $("#sign_up_aria").removeClass("hide").addClass("show");
                $("#change_pass_aria").removeClass("show").addClass("hide");
                $("#change_pass_form").removeClass("show").addClass("hide");

                if(acc_id){
                    $("#user_id").val(acc_id);
                    var username= $("#username_"+acc_id).val();
                    $("#sign_up_username").val(username);
                    var name= $("#name_"+acc_id).val();
                    $("#sign_up_name").val(name);
                }else{
                    $("#sign_up_username").val("");
                    $("#sign_up_name").val("");
                    $("#sign_up_password").val("");

                }
                /* Act on the event */
            });
            $("#close_sign_up").click(function (event) {
                $("#sign_up_aria").removeClass("show").addClass("hide");
            });
            $("#success_close").click(function (event) {
                $("#sign_up_success").removeClass("show").addClass("hide");
            });
            $("#message_close").click(function (event) {
                $("#user_change_pass_error_message").removeClass("show").addClass("hide");
            });
            $("#success_message_close").click(function (event) {
                $("#success_message").removeClass("show").addClass("hide");
            });

            $("#save_sign_up").click(function (event) {
                var username = $("#sign_up_username").val();
                var password = $("#sign_up_password").val();
                var sign_up_name = $("#sign_up_name").val();
                var user_type = $("#user_type").val();
                var company_name = $("#company_name").val();
                var company_id = $("#company_id").val();
                var user_id = $("#user_id").val();
//                alert(user_id);die();
                if (username == "") {
                    $("#user_change_pass_error_message").removeClass("hide").addClass("show");
                    document.getElementById('error_message_text').innerText = '氏名、携帯番号、パスワード、関連番号を入力して下さい。';
//                alert("氏名、携帯番号、パスワード、関連番号を入力して下さい。")
                    return false;
                } else if (password == "") {
                    $("#user_change_pass_error_message").removeClass("hide").addClass("show");
                    document.getElementById('error_message_text').innerText = '氏名、携帯番号、パスワード、関連番号を入力して下さい。';
//                alert("氏名、携帯番号、パスワード、関連番号を入力して下さい。")
                    return false;
                }else if (sign_up_name == "") {
                    $("#user_change_pass_error_message").removeClass("hide").addClass("show");
                    document.getElementById('error_message_text').innerText = '氏名、携帯番号、パスワード、関連番号を入力して下さい。';
//                alert("氏名、携帯番号、パスワード、関連番号を入力して下さい。")
                    return false;
                }
                $.post('index.php/account/sign_up', {
                    sign_up_username: username,
                    sign_up_password: password,
                    sign_up_name: sign_up_name,
                    company_name: company_name,
                    user_type: user_type,
                    company_id: company_id,
                    user_id: user_id
                }, function (resposnse) {
//                console.log(resposnse);die();
                    var res_data = JSON.parse(resposnse);

                    if (res_data.message == "success") {
                        $("#user_change_pass_error_message").removeClass("show").addClass("hide");
                        document.getElementById('sign_up_phone_show').innerText = username;
                        document.getElementById('sign_up_name_show').innerText = sign_up_name;
                        document.getElementById('sign_up_password_show').innerText = password;
                        $("#sign_up_aria").removeClass("show").addClass("hide");
                        $("#sign_up_success").removeClass("hide").addClass("show");

                        setTimeout(function () {
                            location.reload();
                        }, 1000);

                    }

                    if (res_data.message == "exist") {
                        $("#user_change_pass_error_message").removeClass("hide").addClass("show");
                        document.getElementById('error_message_text').innerText = 'この携帯番号は既に登録しました。';
//                    alert('この携帯番号は既に登録しました。');
                        // $( "#sign_up_exist_aria" ).removeClass( "hide" ).addClass( "show" );
                    }
                });
            });

            $(".toggle-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        })

    </script>
  </body>
</html>