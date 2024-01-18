<script>
        function view_settlement_form(id) {
//        alert('hi');

        if (id == 'settlement_id' || id == 'yes_show_settlement_form') {

            if (id == 'yes_show_settlement_form') {
                var share_this_settlement_id = 1;
                var text_settlement_id = $("#text_settlement_id").text();
                var link = 'index.php/wordapp/view_settlement_form/' + text_settlement_id + '/' + share_this_settlement_id;
                $("#view_settlement_form_yes_no_popup").show();
            }
            else if (id == 'settlement_id'){
                var link = document.getElementById("settlement_id").href;
            }

            if ((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1) {
                var style = 'height=650,width=1600, left=100, top=5, scrollbars=yes, resizable=1';
            }
            else if (navigator.userAgent.indexOf("Chrome") != -1) {
                var style = 'height=650,width=1600, left=100, top=5, scrollbars=yes, resizable=1';
            }
            else if (navigator.userAgent.indexOf("Safari") != -1) {
                var style = 'height=650,width=1600, left=100, top=5, scrollbars=yes, resizable=1';
            }
            else if (navigator.userAgent.indexOf("Firefox") != -1) {
                var style = 'height=650,width=1600, left=100, top=5, scrollbars=yes, resizable=1';
            }
            else if ((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
            {
                var style = 'height=1100,width=1600, left=100, top=5, scrollbars=yes, resizable=1';
            }
            else {
                var style = 'height=650,width=1600, left=100, top=5, scrollbars=yes, resizable=1';
            }

            window.open(link, "New Window", style);
        }
        if (id = 'no_show_settlement_form') {
            $("#view_settlement_form_yes_no_popup").hide();
        }
    }
</script>
<style>
    .btn-light_blue {
        color: #000;
        background-color: #B7DEE8;
        border: 2px solid #46658C;
    }

    .btn-light_pink {
        color: #000;
        background-color: #F2DCDB;
        border: 2px solid #46658C;
    }
</style>
<div class="modal email_main_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg jaacos_modal" role="document">
        <div class="modal-content">

            <div class="col-lg-12">
                <span id="title-list-mail-0" style="color: green; font-weight: bold;">送受信</span><br>
                <span id="title-list-mail" style="color: green; font-weight: bold;"> <span
                            id="email_inbox_title">直近順一覧</span> </span>

                <button class="btn btn-success btn_table" style="display: none;" id="btn-filter">相手先</button>
                <button class="btn btn-success btn_table" id="most_uses">相手先別</button>
                <button class="btn btn-success btn_table" id="new_mail">新規</button>
                <button id="create_pertner" class="btn  btn-success btn_table">登録・共有</button>
                <button id="btn-drafts" class="btn btn-success btn_table">下書き</button>
                <!-- <button id="btn-zoom" class="btn btn-success btn_keipro">拡大</button> -->
                <button id="btn_delete_email" class="btn btn-warning btn_table">

                    削除
                </button>

                <button id="email_close" class="btn btn-danger btn_table">戻る</button>
                <button id="btn_introduce" class="btn btn-info pull-right btn_table">紹介</button>
                <!--            <button id="settlement_letter" class="btn btn-success pull-right btn_table">決栽</button>-->
                <!--            <button id="settlement_letter_mail" class="btn btn-success pull-right btn_table">決栽</button>-->
            </div>

            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-8 pull-right settlement_letter_aria"
                 id="settlement_letter_aria"
                 style="display:none;position: absolute; padding: 4px; background-color: #FFFFFF; border-radius: 2px; z-index:9999; left:950px; top:67px; box-shadow: 1px 2px 2px 4px #ccc;">
                <div class="col-lg-12" style="padding: 0">
                    <button type="button" style="margin-bottom: 10px; margin-right: 0;"
                            class="btn btn-warning pull-right btn_keipro" id="close_settlement_letter_aria">戻る
                    </button>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12" style="padding: 0;">
                    <!-- <div class="font_family_aria_parent">
                    <div class="font_family_aria_child"> -->
                    <table class="table table-bordered" style="margin-bottom: 0;">
                        <tr>
                            <td><input type="checkbox" id="settlement_letter_choice1" name="settlement_letter_choice"
                                       value="purchase"> 物品購入
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="settlement_letter_choice2" name="settlement_letter_choice"
                                       value="expenses"> 交通費
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="settlement_letter_choice3" name="settlement_letter_choice"
                                       value="other"> その他
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="settlement_letter_choice4" name="settlement_letter_choice"
                                       value="history"> 履歴
                            </td>
                        </tr>

                    </table>
                    <!-- </div>
                </div>  -->
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 wrapper">


                <table class="table" style="margin-bottom: 0">
                    <tr class="danger">
                        <th width="6%">
                            <input type="checkbox" id="select_all" value="">
                        </th>
                        <th width="25%" nowrap="true"><i class="fa fa-clock-o"></i> 日時</th>
                        <th width="26%" nowrap="true"> 受・送 <i class="fa fa-user"></i> 相手先・会社名</th>
                        <th width="27%"><i class="fa fa-clipboard"></i> 用　件</th>
                        <th width="6%" nowrap="">既読</th>
                        <th width="10%" nowrap="true"><i class="fa fa-paper-plane"></i> 注意</th>
                    </tr>
                </table>
                <div class="email_list_container">
                    <div class="email_list_container2">

                        <table class="table table-hover" id="email_list">

                            <tr>
                                <th colspan="6">
                                    <center>読み込み中。。。待って下さい<img
                                                src="<?= base_url("resource/img/ajax/ajax_load_8.gif") ?>"></center>
                                </th>
                            </tr>

                        </table>
                    </div>

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="email_details" id="email_details">
                    <div class="emal_header">
                        <?php
                        if (!empty($user_emails)) {
                            $month = date('m', strtotime($user_emails[0]->created_at));
                            $email_date = date('d', strtotime($user_emails[0]->created_at));
                            $email_day = date('D', strtotime($user_emails[0]->created_at));
                            $email_time = date('h:i', strtotime($user_emails[0]->created_at));
                            $email_event = date('A', strtotime($user_emails[0]->created_at));
                            $am_pm = "";
                            if ($email_event == "PM") {
                                $am_pm = "午後";
                            } else {
                                $am_pm = "午前";
                            }

                            $jaDay = "";

                            switch ($email_day) {
                                case "Mon":
                                    $jaDay = "月";
                                    break;
                                case "Tue":
                                    $jaDay = "火";
                                    break;
                                case 'Wed':
                                    $jaDay = "水";
                                    break;
                                case "Thu":
                                    $jaDay = "木";
                                    break;
                                case "Fri":
                                    $jaDay = "金";
                                    break;
                                case "Sat":
                                    $jaDay = "土";
                                    break;
                                default:
                                    $jaDay = "日";
                            }
                        }

                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8" style="padding: 0">
                                <i class="fa fa-user"></i>

                                <span id="email_sender_and_receiver">
                                
                            </span>
                                <br>
                            </div>

                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-4" style="padding: 0">
                                <p class="pull-right">
                                    <input type="hidden" name="reply_mail_id" id="reply_mail_id"
                                           value="<?= (!empty($user_emails)) ? $user_emails[0]->email_id : '' ?>">
                                    <input type="hidden" name="reply_mail_mobile" id="reply_mail_mobile"
                                           value="<?= (!empty($user_emails)) ? $user_emails[0]->sender_mobile : '' ?>">

                                    <input type="hidden" name="reply_mail_subject" id="reply_mail_subject"
                                           value="<?= (!empty($user_emails)) ? $user_emails[0]->subject : '' ?>">
                                    <span id="email_create_date">
                                    
                                </span>

                                </p>
                            </div>

                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"
                                 style="padding-left: 0; padding-top: 10px;">
                                <i class="fa fa-file-text"></i>
                                <span id="email_detail_subject">

                            </span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 hide" id="email_details_button_aria"
                                 style="padding: 0">

                                <!-- Edit Draft_mail -->
                                <button id="edit_draft_mail" type="button"
                                        class="btn btn-info pull-right hide btn_table">
                                    <i class="fa fa-pencil-square-o"></i>
                                    更新
                                </button>
                                <!-- Reply Mail -->
                                <button id="reply_mail" type="button" class="btn btn-warning pull-right show btn_table">
                                    <!--                                <i class="fa fa-reply"></i>-->
                                    返信・拡大
                                </button>
                                <button id="delete_email" type="button" class="btn btn-warning pull-right btn_table">
                                    <!--                                <i class="fa fa-trash"></i>-->
                                    削除
                                </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="email_content">
                        <div class="email_content2">
                            <div style="width:100%; float: left;">
                                <p style="float: left; width:65%; text-align: left;" class="email_content_detail"
                                   id="email_content_detail">

                                </p>
                                <!--                                <p style="float: left; width:30%; text-align: left; margin-top: 60px;"-->
                                <!--                                   class="email_content_detail" id="view_email_settlement_id">-->
                                <!---->
                                <!--                                </p>-->
                            </div>
                            <div style="width:100%; float: left;">
                                <p style="float: left; width:30%; text-align: left; margin-top: 7px;"
                                   class="email_content_detail" id="view_email_settlement_id">

                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-xs-6 jcs_mdl close_aria" id="success_email_message">
                    <div class="panel panel-info"
                         style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                        <div class="panel-body">
                            <strong>送信が完了しました</strong>
                        </div>
                    </div>
                </div>

                <!-- delete_multiple_email_confirmation_aria -->

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right hide draggable_aria close_aria"
                     id="delete_multiple_email_confirmation_aria"
                     style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">

                    <div class="panel panel-danger"
                         style="margin-bottom: 2px; border: solid 2px #e74c3c; border-top: solid 7px #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                        <div class="panel-body">
                            <h4>
                                選択されたメールを削除しますか
                            </h4>
                            <br>
                            <center>
                                <button type="button" id="delete_multiple_email_confirmation"
                                        class="btn btn-danger btn-sm">はい
                                </button>
                                <button type="button" id="cancel_delete_multiple_email_confirmation"
                                        class="btn btn-info btn-sm">
                                    <small style="font-size: 12px;">いいえ</small>
                                </button>
                            </center>
                        </div>
                    </div>
                </div>

                <!-- Email email_delete_confirmation -->
                <div class="pull-right hide draggable_aria" id="email_delete_confirmation_aria"
                     style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">

                    <div class="panel panel-danger"
                         style="margin-bottom: 2px; border: solid 2px #e74c3c; border-top: solid 7px #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                        <div class="panel-body">
                            <h5>
                                用件 ： <span id="delete_email_title"></span> のメールを削除しますか<i style="color: #e74c3c"
                                                                                         class="fa fa-question"></i>
                            </h5>
                            <br>
                            <center>
                                <button type="button" id="email_delete_confirmation" class="btn btn-danger btn-sm">はい
                                </button>
                                <button type="button" id="cancel_email_delete_confirmation" class="btn btn-info btn-sm">
                                    <small style="font-size: 12px;">いいえ</small>
                                </button>

                            </center>
                        </div>
                    </div>
                </div>
                <!-- end Email email_delete_confirmation -->

                <!-- start view_settlement_form_yes_no_popup -->
                <div class="pull-right draggable_aria" id="view_settlement_form_yes_no_popup"
                     style="display:none; position: fixed; right: 30px; bottom: 10px; padding: 4px;">

                    <div style="margin-bottom: 2px; border: solid 2px #40628C; border-radius: 10px; background-color: #FFFF99;">
                        <div class="panel-body">
                            <h5>
                                決裁書：<span id="text_settlement_id"> </span>　を開きますか？
                            </h5>
                            <br>
                            <center>
                                <button onclick="view_settlement_form(this.id);" type="button"
                                        id="yes_show_settlement_form" style="background-color: #DBEEF4"
                                        class="btn btn-light_blue">はい
                                </button>
                                <button onclick="view_settlement_form(this.id);" type="button"
                                        id="no_show_settlement_form" class="btn btn-light_pink">
                                    <small style="font-size: 12px;">いいえ</small>
                                </button>

                            </center>
                        </div>
                    </div>
                </div>
                <!-- end view_settlement_form_yes_no_popup -->

                <?php
                //                if (!empty($new_email_check_for_user)) {
                ?>
                <script>
                    //                        var audio = new Audio('notification_sound.mp3');
                    //                        audio.play();
                </script>
                <!-- start new_email_notification_for_user -->
                <!--                    <div class="pull-right draggable_aria" id="new_email_notification_for_user1"-->
                <!--                         style="position: fixed; right: 0px; bottom: 0px; padding: 4px 4px 4px 6px; display: ">-->
                <!---->
                <!--                        <div class="panel panel-info"-->
                <!--                             style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE;">-->
                <!--                            <div class="panel-body">-->
                <!--                                <strong>「決裁書があります」</strong>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!-- end new_email_notification_for_user -->


                <!--                --><?php //} ?>
            </div>

            <div class="clearfix"></div>
            <?php
            $this->load->view('components/introducer_registration');
            ?>
            <?php

            $this->load->view('components/partner_registration');
            ?>
            <?php

            //        $this->load->view('components/settlement_letter_mail');
            $this->load->view('components/view_settlement_letter');
            ?>

        </div>

    </div>

</div>

<script>
//    jQuery(document).ready(function ($) {
//        $(".modal").on('click', function (event) {
//            event.preventDefault();
//            $("#new_email_notification_for_user1").removeClass('show').addClass('hide');
//        });
//    });
</script>