
<?php
error_reporting(0);
?>
<script>
    var base_url = $("#base_url").val();

    function showUsersName() {
        if ($("#new_partner_mobile").val() != ''){
            var partner_mobile = $("#new_partner_mobile").val();
            var partner_name = 'new_partner_name';

        }
        else{
            var partner_mobile = $("#partner_mobile").val();
            var partner_name = 'partner_name';
        }

        $.ajax({
            url: base_url + "index.php/wordapp/get_users_name",
            type: "POST",
            data: {
                partner_mobile: partner_mobile
            },
            async: false,
            cache: false,
            dataType: "text",
            success: function (response, textStatus, jqXHR) {
                var response_val = response.trim();
//                alert(response_val);die();
                if (response_val == 'user not registered') {
                    $("#invalid_partner_error_message").show();
                    $("#new_partner_registration_form").hide();
                } else {
                    $("#"+partner_name).val(response_val);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                //if fails
                alert(textStatus);
            }
        });
    }
</script>

<style type="text/css" media="screen">
    @media only screen and (max-width: 400px) {
        .email_share_navi{
            width: 85% !important;
        }

        .close_delete_email_partner_message{
            margin-left: 120px !important;
        }

    }



        /* Portrait */
        @media screen
        and (device-width: 360px)
        and (device-height: 640px)
        and (orientation: portrait) {

        .email_share_navi{
            width: 85% !important;
        }

        .close_delete_email_partner_message{
            margin-left: 120px !important;
        }
        
}


/* Portrait */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 4) 
  and (orientation: portrait) {

    .email_share_navi{
            width: 85% !important;
        }
    .close_delete_email_partner_message{
            margin-left: 120px !important;
    }

  }


    
</style>



<div class="col-md-8 pull-right table_of_partner hide draggable_aria" id="table_of_partner">


    <form id="email_partner_form" action="javascript()" method="POST">
        <div class="col-lg-3 col-md-3 col-sm-2 pull-left title_aria">
            <div style="padding-right: 0; padding: 10px 0px;">
                <p><strong>新規　登録・共有 </strong></p>
            </div>

        </div>
        <div id="button_aria_share_email" class="col-lg-9 col-md-9 col-sm-9 col-xs-12 pull-right button_aria">

            <button type="button" class="btn btn-warning pull-right btn_table" id="close_pertner"
                    style="margin-right: 0px;">戻る
            </button>
            <button type="button" class="btn btn-success pull-right btn_table" id="edit_partner_button">変更</button>
            <button type="button" class="btn btn-success pull-right btn_table" id="email_multiple_share">共有</button>
            <button type="button" class="btn btn-success pull-right btn_table" id="send_email_form_partner">メール</button>
            <input id="partner_add" type="submit" name="submit" class="btn btn-success pull-right btn_table" value="登録">
        </div>
        <!--            start show when share button click from settlement/requisiton form page-->
        <div style="display: none;" id="button_aria_share_form"
             class="col-lg-9 col-md-9 col-sm-9 col-xs-12 pull-right button_aria">

            <button type="button" class="btn btn-warning pull-right btn_table" id="close_partner"
                    style="margin-right: 0px;">戻る
            </button>
            <button type="button" class="btn btn-success pull-right btn_table" id="edit_partner_button_settlement">変更
            </button>
            <button type="button" class="btn btn-success pull-right btn_table" id="delete_partner_button_settlement">
                削除
            </button>
            <button type="button" class="btn btn-success pull-right btn_table" id="send_email_form_partner_addto">追加
            </button>
            <input type="submit" name="submit" class="btn btn-success pull-right btn_table" value="登録">
        </div>

        <div id="loader_partner_list" style="text-align: center; display: none;">
            <img src="<?php echo base_url(); ?>resource/img/ajax/ajax_load_6.gif">
        </div>

        <!--          end show when share button click from settlement/requisiton form page-->
        <dir id="partner_container">
            <div class="col-lg-6 col-md6 col-sm6 col-xs-6">
                <table width="50%" class="table table-bordered" id="post_list" style="font-size: 18px; color: #000;">
                    <thead>
                    <tr>
                        <th></th>
                        <th>電話番号&nbsp;&nbsp;&nbsp;&nbsp;会社名</th>
                        <th>氏名</th>
                    </tr>
                    </thead>
                    <tbody id="load_table_of_partner">
                    <?php
                    $total_partner = count($email_pertners);
                    for ($i = 0; $i < 10; $i++) {

                        ?>
                        <tr>
                            <td><?= $i + 1; ?></td>
                            <?php
                            if (!empty($email_pertners[$i])) { ?>
                                <td><?= $email_pertners[$i]->partner_name . ' - ' . $email_pertners[$i]->company ?></td>
                                <td><?= $email_pertners[$i]->partner_mobile ?></td>
                                <?php
                            } elseif ($total_partner == $i) { ?>

                                <td style="">
                                    <div class="form-group" style="margin-bottom: 0">
                                        <input style="width: 50%; margin-right:1%;" type="tel" required=""
                                               class="form-control input-sm pull-left "
                                               name="partner_mobile" id="partner_mobile" placeholder="電話番号">
                                        <input type="text" style="width: 49%; ime-mode:active"
                                               class="form-control input-sm" name="pertner_company" id="company"
                                               placeholder="会社名">
                                    </div>
                                </td>
                                <td style=" ime-mode:inactive" width="35%">
                                    <div class="form-group" style="margin-bottom: 0">
                                        <input type="text" style=" ime-mode:active"
                                               name="pertner_name" class="form-control input-sm has-error"
                                               id="partner_name" placeholder="氏名">

                                    </div>
                                </td>
                                <?php
                            } else {
                                ?>
                                <td style=""></td>
                                <td style="" width="35%"></td>
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
                <table width="50%" class="table" id="post_list" style="font-size: 18px; color: #000;">
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
                    for ($i = 10; $i < 20; $i++) {

                        ?>
                        <tr>
                            <td style=""><?= $i + 1; ?></td>
                            <?php
                            if (!empty($email_pertners[$i])) { ?>
                                <td><?= $email_pertners[$i]->partner_name . ' - ' . $email_pertners[$i]->company ?></td>
                                <td><?= $email_pertners[$i]->partner_mobile ?></td>
                                <?php
                            } elseif ($total_partner == $i) { ?>
                                <form id="email_partner_form" action="javascript()" method="POST">
                                    <td style="">
                                        <input style="width: 50%; margin-right:1%;" type="tel"
                                               class="form-control input-sm" name="partner_mobile"
                                               id="partner_mobile" placeholder="電話番号">
                                        <input type="text" style="width: 49%; ime-mode:active"
                                               class="form-control input-sm" name="pertner_company" id="company"
                                               placeholder="会社名">

                                    </td>
                                    <td style="ime-mode:inactive" width="35%">
                                        <input type="text" style=" ime-mode:active "
                                               name="pertner_name" class="form-control input-sm pull-left"
                                               id="partner_name" placeholder="氏名">

                                    </td>
                                </form>
                                <?php
                            } else {
                                ?>
                                <td style=""></td>
                                <td style="" width="35%"></td>
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
        </dir>
    </form>
    <div class="col-md-4 col-sm-4 col-xs-12 pull-right hide draggable_aria" id="delete_confirm_alirt"
         style="position: fixed; right: 0px; bottom: 0px; padding: 4px;">

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

    <!-- Email Partner Navigation Message-->
    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-7 pull-right draggable_aria message_close_aria close_aria"
         id="email_partner_message" style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body">
                <ul style="list-style:decimal; ">
                    <li>新規の登録ができます。（自動保存です）</li>
                    <li>〔共有〕を押して、複数の人と共有登録ができます。</li>
                </ul>
                <center>
                    <button id="close_select" class="btn btn-info btn-sm btn_popup"
                            style="box-shadow: none; border: none;">確認
                    </button>
                </center>

            </div>
        </div>
    </div>

    <!-- start Email Share Navi Message-->
    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-7 hide pull-right email_share_navi_message_aria close_aria email_share_navi"
         id="email_share_navi_message_aria " style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: solid 2px yellow; border-top: solid 7px yellow; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <input type="hidden" id="enable_email_multi_share" name="enable_email_multi_share" value="0">
            <div class="panel-body">
                <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
                <ul style="list-style: decimal; ">
                    <li>複数人を選べます<br>複数人と共有できます。
                    </li>
                    <li>選んだ相手先に色が付きます。</li>
                </ul>
                <center>
                    <button id="close_email_share_navi_message" class="btn btn-info btn-sm btn_popup"
                            style="box-shadow: none; border: none;">確認
                    </button>
                </center>

            </div>
        </div>
    </div>

    <!-- end Email Share Navi Message-->

    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-7 hide pull-right email_share_navi_user_list"
         id="email_share_navi_user_list" style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: solid 2px yellow; border-top: solid 7px yellow; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <input type="hidden" id="enable_email_multi_share" name="enable_email_multi_share" value="0">
            <div class="panel-body" style="padding: 5px;">
                <div class="col-md-12" style="padding: 0">
                    <button type="button" id="close_email_share_navi_user_list"
                            class="btn btn-warning btn-sm pull-right">戻る
                    </button>
                </div>
                <div class="col-lg-12" style="padding: 0;">
                    <ul id="share_multiple_partner_list" style="list-style: circle; font-size: 18px; ">

                    </ul>
                </div>
                <div class="col-md-12" style="text-align: center">
                    <p class="text-danger">共有にしました。</p>

                    <button id="share_email_selected_partner" class="btn btn-info btn-sm btn_popup"
                            style="box-shadow: none; border: none;">完了
                    </button>
                    <button id="share_email_selected_partner1" class="btn btn-info btn-sm btn_popup"
                            style="box-shadow: none; border: none; display: none; cursor: pointer;">完了
                    </button>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 draggable_aria close_aria" id="eidt_email_partner_message"
         style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body">
                <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
                <ul style="list-style: square; ">
                    <li>相手先をクリックして登録情報を変更できます。</li>
                    <li>相手先名と電話番号を変更してから登録ボタンを押して。</li>
                    <!--                    <li>ください。</li>-->
                </ul>

                <button id="close_select" class="btn btn-info btn-sm"
                        style="box-shadow: none; border: none; margin-left:180px" onclick='close_div_msg();'>確認
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 draggable_aria close_aria" id="delete_email_partner_message"
         style="position: fixed; right: 30px; bottom: 10px; padding: 4px; display: none;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body">
                <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
                <ul style="list-style: square; ">
                    <li>相手先をクリックして登録情報を削除できます。</li>
                </ul>
                <button id="close_delete_email_partner_message" class="btn btn-info btn-sm"
                        style="box-shadow: none; border: none; margin-left: 180px;"> 確認
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4  draggable_aria close_aria" id="invalid_partner_error_message"
         style="position: fixed; right: 30px; bottom: 10px; padding: 4px; display: none;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body">
                <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
                <ul style="list-style: none; text-align:center">
                    <li>相手がケイプローに登録されていません。</li>
                </ul>
                <button id="close_invalid_partner_error_message" class="btn btn-info btn-sm"
                        style="box-shadow: none; border: none; margin-left: 180px;"> 確認
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4  draggable_aria close_aria" id="already_exist_partner_error_message"
         style="position: fixed; right: 30px; bottom: 10px; padding: 4px; display: none;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body">
                <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
                <ul style="list-style: none; text-align:center">
                    <li>ユーザー名既に存在します。</li>
                </ul>
                <button id="close_already_exist_partner_error_message" class="btn btn-info btn-sm"
                        style="box-shadow: none; border: none; margin-left: 180px;"> 確認
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="delete_email_partner_message_confirm"
         style="position: fixed; right: 30px; bottom: 10px; padding: 4px; display: none; width: 25%; text-align: center;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE">
            <div class="panel-body">
                <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
                <ul style="list-style: none; font-weight: bold;">
                     <li><span id="show_delete_partner_name"> </span> さんを削除しました。</li>
                </ul>
                <button id="close_delete_email_partner_message_confirm" class="btn btn-info btn-sm"
                        style="box-shadow: none; border: none;">確認
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="add_email_partner_message_confirm"
         style="position: fixed; right: 30px; bottom: 10px; padding: 4px; display: none; width: 15%;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE">
            <div class="panel-body">
                <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
                <ul style="list-style: none; ">
                    <li>登録しました。</li>
                </ul>
                <button id="close_add_email_partner_message_confirm" class="btn btn-info btn-sm"
                        style="box-shadow: none; border: none; margin-left: 55px">確認
                </button>
            </div>
        </div>
    </div>

    <!-- start add president as partner message navi -->
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="president_add_navi"
         style="position: fixed; right: 30px; bottom: 15px; padding: 4px; display: none; width: 20%;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; text-align: center;">
            <div class="panel-body">
                <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
                <ul style="list-style: none; padding-left: 0; color: black;">
                    <li>最終決裁者が登録されていません</li>
                </ul>
                <button id="president_add_as_partner_button" class="btn btn-success btn-sm"
                        style="box-shadow: none; border: none;">最終決裁者登録

                </button>
            </div>
        </div>
    </div>
    <!-- end add president as partner message navi -->

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="edit_email_partner_message_confirm"
         style="position: fixed; right: 30px; bottom: 10px; padding: 4px; display: none; width: 15%;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE">
            <div class="panel-body">
                <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
                <ul style="list-style: none; ">
                    <li>変更しました。</li>
                </ul>
                <button id="close_edit_email_partner_message_confirm" class="btn btn-info btn-sm"
                        style="box-shadow: none; border: none; margin-left: 55px">確認
                </button>
            </div>
        </div>
    </div>


    <div class="col-md-3 col-sm-3 col-xs-4 pull-right hide draggable_aria close_aria" id="select_partner"
         style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">

        <div class="panel panel-warning"
             style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body">
                <h4><i style="color: #f1c40f" class="fa fa-warning"></i> 相手先を選択してください。</h4>
                <center>
                    <button id="close_select" class="btn btn-warning btn-sm" style="box-shadow: none; border: none;">
                        確認
                    </button>
                </center>

            </div>
        </div>
    </div>

    <!-- start delete partner confirmation popup -->
    <div style="overflow:hidden;width:25%; height:100px; right:35px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
         id="delete_partner_confirmation_popup">

        <div style="width:auto; text-align: right">

        </div>
        <div class="clearfix"></div>
        <div style="text-align: center">
            <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
                <span id="show_delete_partner_name1"> </span> さんを削除しますか？　
            </p>
            <p>
                <!--                yes-->
                <button type="button" id="delete_confirm_partner_button_settlement" class="btn btn-light_green"
                        style="border: 2px solid #46658C; margin-right: 10px;"> はい
                </button>
                <!--                no-->
                <button type="button" id="delete_confirm_no_partner_button_settlement" class="btn btn-yellow"
                        style="border: 2px solid #46658C; margin-right: 10px;"> いいえ
                </button>
            </p>
        </div>
    </div>
    <!-- end delete partner confirmation popup -->

    <!-- start edit partner confirmation popup -->
    <div style="overflow:hidden;width:25%; height:100px; right:35px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
         id="edit_partner_confirmation_popup">

        <div style="width:auto; text-align: right">

        </div>
        <div class="clearfix"></div>
        <div style="text-align: center">
            <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
                <span id="show_edit_partner_name"></span> さんを変更しますか？　
            </p>
            <p>
                <!--                yes-->
                <button type="button" id="edit_confirm_partner_button_settlement" class="btn btn-light_green"
                        style="border: 2px solid #46658C; margin-right: 10px;"> はい
                </button>
                <!--                no-->
                <button type="button" id="edit_confirm_no_partner_button_settlement" class="btn btn-yellow"
                        style="border: 2px solid #46658C; margin-right: 10px;"> いいえ
                </button>
            </p>
        </div>
    </div>
    <!-- end edit partner confirmation popup -->

    <!-- start new partner registration form -->
    <div style="overflow:hidden;width:30%; height:181px; right:20px; bottom:5px; position: fixed; padding: 10px; border: 2px solid orange; border-radius: 0.5em; background-color: #F1F2D5; display: none;"
         id="new_partner_registration_form">
        <div style="width:auto; text-align: right">

            <button type="button" class="btn btn-danger" id="new_partner_registration_form_close"> 戻る
            </button>

        </div>
        <div style="width:auto; margin-bottom: 10px; text-align: center; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px; color: black;">
            <span style="" id="partner_registration_text">共有したい相手を登録してください</span>
            <span style="display: none;" id="president_registration_text">最終決裁者を登録してください</span>　
        </div>
        <div class="clearfix"></div>
        <div style="text-align: left; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px;">
            <input onblur="setTimeout(function () { showUsersName(); }, 2000);" type="tel"
                   class="form-control input-sm pull-left" style="width: 64%;ime-mode:inactive; margin-right:1%; "
                   name="new_partner_mobile" id="new_partner_mobile" placeholder="電話番号">
<!--            <input type="text" style="width: 32%; ime-mode:active;margin-right:1%;"-->
<!--                   class="form-control input-sm pull-left" name="new_partner_company" id="new_partner_company"-->
<!--                   placeholder="会社名">-->
            <input type="text" style="width: 32%;ime-mode:active" name="new_partner_name"
                   class="form-control input-sm has-error" id="new_partner_name" placeholder="氏名">
            <p style="text-align: center; margin-top: 20px;">
                <button type="button" id="add_new_email_partner" class="btn btn-yellow"
                        style="border: 2px solid #46658C;"> 完了
                </button>
            </p>
        </div>
    </div>
    <!-- end new partner registration form -->

    <!-- start partner is not registered error message -->
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 hide pull-right email_invalid_partner_error_message close_aria"
         id="email_invalid_partner_error_message" style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">

        <div class="panel panel-info"
             style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body">
                <ul style="list-style: none; text-align:center">
                    <li>相手がケイプローに登録されていません。</li>
                </ul>
                <button id="close_email_invalid_partner_error_message" class="btn btn-info btn-sm"
                        style="box-shadow: none; border: none; margin-left: 180px;"> 確認
                </button>

            </div>
        </div>
    </div>
    <!-- end partner is not registered error message -->

</div>


<!-- ・相手先をクリックして登録情報を変更できます。<br>・相手先名と電話番号を変更してから登録ボタンを押して<br>・ください。 -->