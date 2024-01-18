<!DOCTYPE html>
<html lang="jp">
<head>
    <?php $this->load->view('components/head'); ?>
    <style type="text/css">
        @media all and (max-width:768px) {

            .in-mobile {
                padding-top: 5px !important;
            }
        }

    </style>


</head>
<?php
$inactive_time=31536000; //1 yr
//if((time()-$this->session->userdata('last_timeout_pass'))>$inactive_time){
//    $this->session->unset_userdata('last_timeout_pass');
//    redirect('account/sign_out');
//}
?>

<body style="background-color: white">

<div class="row" style="width:100%; margin: 0 auto;">
    <div class="col-md-6 col-sm-12">
        <span style="font-size: 16px; font-weight: bold"> パスワードを設定してください </span><br>
        <div class="panel panel-default" style="border: 0">
            <div style="padding-top:30px;" class="panel-body">
                <div class="form-group in-mobile">
                    <label class="col-md-5 control-label">パスワード（４ケタ以上）</label>
                    <div class="col-md-7">
                        <input id="new_password" type="text" class="form-control" autofocus="true"
                               name="new_password" style="ime-mode:active; min-width: 25%" required="required"
                               placeholder="パスワード（４ケタ以上）">
                    </div>

                </div>
                <div class="form-group in-mobile" style="padding-top:30px;">
                    <label class="col-md-5 control-label">パスワードを再入力してください</label>
                    <div class="col-md-7">
                        <input id="retype_new_password" type="text" class="form-control" autofocus="true"
                               name="retype_new_password" style="ime-mode:active; min-width: 25%" required="required"
                               placeholder="パスワードを再入力してください">
                        <input type="hidden" id="token" name="token" value="<?= $reset_password_token ?>">
                        <input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>">
                    </div>

                </div>


                <div class="form-group in-mobile" style="padding-top:30px;">
                    <label class="col-md-5 control-label">&nbsp;</label>
                    <div class="col-md-7">
                        <button style="" type="button" id="submit_reset_password" title="ログイン"
                                name="submit_reset_password"
                                class="btn btn-success"> パスワードを再設定する
                        </button>
                    </div>

                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 pull-right hide" id="user_change_pass_error_message"
                     style="position: fixed; right: 0px; bottom: 10px; padding: 4px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; text-align: center;">
                    <p style="text-align: center; padding: 10px;"><span id="error_message_text"></span></p>
                    <button type="button" class="btn btn-default" id="message_close">確認
                    </button>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 pull-right hide" id="success_message"
                     style="position: fixed; right: 0px; bottom: 10px; padding: 4px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; text-align: center;">
                    <p style="text-align: center; padding: 10px;"><span id="success_message_text"
                                                                        style="font-size: 18px; font-weight: bold;"></span></p>
                    <a href="<?= base_url() ?>index.php/account/sign_in"><strong>ログインページ</strong></a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container_lg -->

<?php $this->load->view('components/footer'); ?>
<script type="text/javascript">


    $("#submit_reset_password").click(function (event) {
        var user_new_password = $("#new_password").val();
        var retype_new_password = $("#retype_new_password").val();
        var token = $("#token").val();
        var base_url = $("#base_url").val();
//            alert(username);
//            die();
        if (user_new_password == "") {
            $("#user_change_pass_error_message").removeClass("hide").addClass("show");
            document.getElementById('error_message_text').innerText = 'このフィールドに記入してください';
//                alert(" 新パスワード を入力して下さい。")
            return false;
        } else if (retype_new_password == "") {
            $("#user_change_pass_error_message").removeClass("hide").addClass("show");
            document.getElementById('error_message_text').innerText = 'このフィールドに記入してください';
//                alert("現在のパスワード を入力して下さい。")
            return false;
        }else if (user_new_password != retype_new_password) {
            $("#user_change_pass_error_message").removeClass("hide").addClass("show");
            document.getElementById('error_message_text').innerText = 'パスワードが一致しません';
//                alert("現在のパスワード を入力して下さい。")
            return false;
        }
        $.post('index.php/account/account_password/user_update_password', {
            user_new_password: user_new_password,
            token: token
        }, function (response) {
            var result = response.trim();
//                alert(result);die();

            if (result == 2) {
                $("#new_password").val("");
                $("#retype_new_password").val("");
                $("#success_message").removeClass("hide").addClass("show");
                document.getElementById('success_message_text').innerText = 'パスワードが正常に変更されました。';
            }
//            else{
//                window.location.href = base_url + 'index.php/account/sign_out/';
//            }


        });
    });

</script>
</body>
</html>