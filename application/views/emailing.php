<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <?php $this->load->view('components/head'); ?>
    <script src="<?php echo base_url('resource/js/custom.js'); ?>"></script>
    <style type="text/css">
        .table_of_contantes{
            height: 570px !important;
        }
        .seen{
            font-weight: normal;
        }
        .unseen{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container emailing">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-11 top_nav">
            <br>

                <span id="title-list-mail-0" style="color: green; font-weight: bold;">送受信</span><br>
                <span id="title-list-mail" style="color: green; font-weight: bold;">直近順一覧</span>

                <button class="btn btn-success" id="btn-filter">相手先別</button>
                <button class="btn btn-success" id="new_mail">新規</button>
                <button id="create_pertner" class="btn  btn-success">登録・共有</button>
                <button id="btn-drafts" class="btn btn-success">下書き</button>
                <button id="btn-zoom" class="btn btn-success">拡大</button>

                <button onclick="javascript:window.close()" id="btn-back" class="btn btn-success">戻る</button>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-1 pull-right">
                <br>       <br>
                <button id="btn-intro" class="btn btn-success pull-right">紹介</button>
            </div>
        </div><!--/row-->
        <div class="row">
            <br><br>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <table class="table table-striped">
                    <thead>
                        <tr class="info">
                            <th nowrap="true"><i class="fa fa-clock-o"></i> 日時</th>
                            <th nowrap="true"> 受・送 <i class="fa fa-user"></i> 相手先・会社名</th>
                            <th><i class="fa fa-clipboard"></i> 用　件</th>
                            <th>既読</th>
                            <th nowrap="true"><i class="fa fa-paper-plane"></i> 注意</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($user_emails as $user_email) {
                        ?>
                                <tr class="warning <?= $user_email->seen==1? 'seen':'unseen'; ?>">
                                    <td><?= date('m月d日(火)h:i A', strtotime($user_email->created_at)) ?></td>
                                    <td><?= $user_email->created_by == $account->id? '送 '.$user_email->receiver_name:'受 '.$user_email->username ?> </td>
                                    <td>
                                        <a id="show_email_details" class="show_email_details" href="<?= $user_email->email_id ?>"><?= substr($user_email->subject, 0,20).'...' ?></a>

                                        </td>
                                    <td>
                                        <i class="<?= $user_email->seen==1? 'fa fa-check-circle':'fa fa-check-circle-o' ?>" style="color: <?= $user_email->seen==1? '#e38d13':''?>"></i>
                                    </td>
                                    <td><i class="fa fa-star-o"></i></td>
                                </tr>

                        <?php
                            }
                        ?>

                    </tbody>
                </table>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="email_details">
                    <div class="emal_header">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8" style="padding: 0">
                                <i class="fa fa-user"></i>

                                <input type="hidden" name="reply_mail_name" id="reply_mail_name" value="<?= (!empty($user_emails))? $user_emails[0]->created_by == $account->id? $user_emails[0]->receiver_name:$user_emails[0]->username:'' ?>">
                                <span id="email_sender_and_receiver">
                                    <?php
                                    if (!empty($user_emails)) {
                                        echo $user_emails[0]->created_by == $account->id? $user_emails[0]->receiver_name:$user_emails[0]->username;
                                    }
                                    ?>
                                </span>
                                <br>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-4" style="padding: 0">
                                <p class="pull-right">
                                    <input type="hidden" name="reply_mail_id" id="reply_mail_id" value="<?= (!empty($user_emails))? $user_emails[0]->email_id:'' ?>">
                                    <input type="hidden" name="reply_mail_mobile" id="reply_mail_mobile" value="<?= (!empty($user_emails))? $user_emails[0]->sender_mobile:'' ?>">
                                    <input type="hidden" name="reply_mail_subject" id="reply_mail_subject" value="<?= (!empty($user_emails))? $user_emails[0]->subject:'' ?>">
                                    <span id="email_create_date">
                                        <?php
                                        if (!empty($user_emails)) {
                                        echo  date('m月d日(火)h:i A', strtotime($user_emails[0]->created_at));
                                        }?>
                                    </span>

                                </p>
                            </div>

                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left: 0; padding-top: 10px;">
                                <i class="fa fa-file-text"></i>
                                <input type="hidden" name="reply_mail_subject" id="reply_mail_subject" value="<?= (!empty($user_emails))? $user_emails[0]->subject:'' ?>">
                                <span id="email_detail_subject">
                                    <?php
                                    if (!empty($user_emails)) {
                                        echo $user_emails[0]->subject;
                                    }?>
                                </span>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding: 0">
                                <button id="reply_mail" type="button" class="btn btn-lg btn-warning pull-right">
                                    <i class="fa fa-reply"></i>
                                    返信・確認
                                </button>
                                <button id="delete_email" type="button" class="btn btn-warning btn-sm pull-right">
                                    <i class="fa fa-trash"></i>
                                    削除
                                </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="email_content" style="min-height: 300px;">
                        <p>
                            <input type="hidden" name="reply_mail_content" id="reply_mail_content" value="<?= (!empty($user_emails))? $user_emails[0]->content:'' ?>">
                            <span id="email_content_detail">
                                <?php
                                if (!empty($user_emails)) {
                                    echo $user_emails[0]->content;
                                }?>
                            </span>

                        </p>

                    </div>
                </div>
            </div>
        </div><!--/row-->

    </div><!--/.container-->

    <!-- Pertner Registration -->
    <div class="col-md-8 pull-right table_of_contantes hide draggable_aria close_aria" id="table_of_partner">
        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2 pull-left title_aria">
            <div style="padding-right: 0">
                <strong>新規　登録・共有 </strong>
            </div>

        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-10 pull-right button_aria">
            <button id="close_pertner" class="btn btn-default pull-right" id="close-phone">戻　る</button>
            <button class="btn btn-default pull-right" id="config-phone">変更</button>
            <button class="btn btn-default pull-right" id="create-group">共有</button>
            <button class="btn btn-default pull-right" id="create-one-man">メール</button>
            <button class="btn btn-default pull-right" id="addphone">登録</button>

        </div>
        <div class="col-lg-6 col-md6 col-sm6 col-xs-6">
            <table width="50%" class="table table-hover table-bordered" id="post_list" style="font-size: 18px; color: #000;">
                <thead>
                    <tr>
                        <th></th>
                        <th>相手先・会社名</th>
                        <th>電話番号</th>
                    </tr>
                </thead>
                <tbody id="load_table_of_partner">
                    <?php
                        $total_partner = count($email_pertners);
                        for ($i=0; $i <10 ; $i++) {

                        ?>
                        <tr class="checked22">
                            <td style="padding: 5px;"><?= $i+1; ?></td>
                            <?php
                            if (!empty($email_pertners[$i])) {?>
                                <td><?= $email_pertners[$i]->partner_name.' - '.$email_pertners[$i]->company?></td>
                                <td><?= $email_pertners[$i]->partner_mobile?></td>
                            <?php
                            }elseif ($total_partner==$i) {?>
                                <form id="email_partner_form" action="javascript()" method="POST">

                                    <td style="padding: 5px;">
                                        <div class="form-group" style="margin-bottom: 0">
                                            <input type="text" style="width: 50%; margin-right:1%; ime-mode:active" name="pertner_name" class="form-control input-sm pull-left has-error" id="partner_name" placeholder="お名前">
                                            <input type="text" style="width: 49%; ime-mode:active" class="form-control input-sm" name="pertner_company" id="company" placeholder="会社名">
                                        </div>
                                    </td>
                                    <td style="padding: 5px; ime-mode:inactive" width="35%">
                                        <div class="form-group" style="margin-bottom: 0">
                                            <input type="text" class="form-control input-sm" name="partner_mobile" id="partner_mobile" placeholder="電話番号">
                                        </div>
                                    </td>
                                </form>
                            <?php
                            }else{?>
                                <td style="padding: 5px;"></td>
                                <td style="padding: 5px;" width="35%"></td>
                            <?php
                            }
                            ?>

                        </tr>
                        <?php
                        }
                        ?>
                </tbody>

            </table>
        </div>
        <div class="col-lg-6 col-md6 col-sm6 col-xs-6">
            <table width="50%" class="table table-bordered" id="post_list" style="font-size: 18px; color: #000;">
                <thead>
                    <tr>
                        <th></th>
                        <th>相手先・会社名</th>
                        <th>電話番号</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_partner = count($email_pertners);
                    for ($i=10; $i <20 ; $i++) {

                    ?>
                    <tr>
                        <td style="padding: 5px;"><?= $i+1; ?></td>
                        <?php
                        if (!empty($email_pertners[$i])) {?>
                            <td><?= $email_pertners[$i]->partner_name.' / '.$email_pertners[$i]->company?></td>
                            <td><?= $email_pertners[$i]->partner_mobile?></td>
                        <?php
                        }elseif ($total_partner==$i) {?>
                            <form id="email_partner_form" action="javascript()" method="POST">
                                <td style="padding: 5px;">
                                    <input type="text" style="width: 50%; margin-right:1%; ime-mode:active " name="pertner_name" class="form-control input-sm pull-left" id="partner_name" placeholder="お名前">
                                    <input type="text" style="width: 49%; ime-mode:active" class="form-control input-sm" name="pertner_company" id="company" placeholder="会社名">

                                </td>
                                <td style="padding: 5px;ime-mode:inactive" width="35%">
                                    <input type="text"  class="form-control input-sm" name="partner_mobile" id="partner_mobile" placeholder="電話番号">
                                </td>
                            </form>
                        <?php
                        }else{?>
                            <td style="padding: 5px;"></td>
                            <td style="padding: 5px;" width="35%"></td>
                        <?php
                        }
                        ?>

                    </tr>
                    <?php
                    }
                    ?>
                </tbody>

            </table>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12 pull-right hide draggable_aria" id="delete_confirm_alirt" style="position: fixed; right: 0px; bottom: 0px; padding: 4px;">

            <div class="panel panel-warning" style="margin-bottom: 2px; border: 2px solid #eee;">
                <div class="panel-body">
                    <br>
                    <p style="font-size: 20px; font-weight: bold;">削除する文章: <span id="delete_title_show"></span></p>
                    <br>
                    <button style="margin-left: 0" type="button" class="btn btn-danger" id="delete_confirm">削 除</button>
                    <button type="button" class="btn btn-default" id="partner_close">戻 る</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ajax Loading Aria -->
    <!-- <div class="col-md-3 col-sm-3 pull-right draggable_aria close_aria" id="ajax_loading_aria" style="position: fixed; right: 0px; bottom: 0px; padding: 4px; display: none;">

        <div class="panel panel-info" style="margin-bottom: 2px; border: 2px solid #eee;">
            <div class="panel-body" style="color: #000; font-weight: bold;">
                読み込んでいます... <img src="resource/img/ajax/ajax_load_4.gif">
            </div>
        </div>
    </div> -->
    <!-- Large modal -->

    <?php
    $this->load->view('components/email_modal')
    ?>
    <script src="<?php echo base_url('resource/js/jquery-confirm.min.js'); ?>"></script>
    <script src="<?php echo base_url('resource/js/jquery-ui.min.js'); ?>"></script>
    <link rel="stylesheet" href="resource/css/jquery-confirm.min.css">
    <script type="text/javascript">
        $(document).ready(function($) {

           $(".draggable_aria").draggable();
            $("#partner_close").click(function(event) {
                alert('Okay');
            });
        });
    </script>
</body>
</html>