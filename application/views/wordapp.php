<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//date_default_timezone_set('Asia/Tokyo');
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <?php $this->load->view('components/head'); ?>

    <?php
    if (preg_match('/(?i)msie [10]/', $_SERVER['HTTP_USER_AGENT'])) {

        ?>
        <!--  if IE = 10 -->
        
        <script src="<?= base_url('resource/tiny_mce/tiny_mce.js?cachebuster=123') ?>"></script>
        <script src="<?= base_url('resource/js/custom_editor3.js') ?>"></script>
    <?php
    }else{
    ?>
        <script src="<?= base_url('resource/tinymce/tinymce.min.js') ?>"></script>

        <link rel="stylesheet" media="screen" type="text/css" href="resource/css/jsim.css"/>
        <script type="text/javascript" src="resource/js/jsim/jsim_common.js"></script>
        <script type="text/javascript" src="resource/js/jsim/jsim_caret.js"></script>
        <script type="text/javascript" src="resource/js/jsim/jsim_keycode.js"></script>
        <script type="text/javascript" src="resource/js/jsim/jsim.js"></script>
        <!-- <script type="text/javascript" src="resource/js/jsim/roma.js"></script> -->
        <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/jsim/jsim_vje.js?id=<?php echo rand(0,10000)?>"></script>
        <!-- <script type="text/javascript" src="resource/js/jsim/jsim_vje.js"></script> -->
        <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/custom_editor4.js?id=<?php echo rand(0,10000)?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.0/jspdf.debug.js"></script>
        <script src="resource/js/html2canvas.js"></script>
        <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
        <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

        <script src="resource/js/jspdf.customfonts.min.js"></script>
        <script src="resource/js/default_vfs.js"></script>
        <?php
    }

    ?>

    <!--    <script src="--><? //= base_url('resource/js/modernizr-custom.js') ?><!--"></script>-->

    <style>
        .mce-tinymce.mce-container.mce-panel {
            border: 0;
        }

        .mce-content-body *[contentEditable=false][data-mce-selected]{
            outline: none;
        }

        .mce-edit-area.mce-container.mce-panel.mce-stack-layout-item.mce-first.mce-last {
            border: 0;
        }

        .btn_table1 {
            padding: 3px;
            margin: 5px;
            border-radius: 10px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            min-width: 50px;
        }

        .resp {
            position: absolute;
            min-width: 270px;
        }

        @media only screen and (max-width: 400px) {
            .blank_document_pagination_alert {

                right: 20px !important;
            }
        }

        @media only screen and (max-width: 768px) {

            .resp {
                position: fixed;
                left: 0px;
                width: 100%;
                bottom: 10px;
            }
        }

        .mce-floatpanel{
            background-color: red;
            border-width: 1px; 
            z-index: 65536; 
            left: 448px; 
            top: 73px; 
            width: 638px; 
            height: 384px;
        }
        .videoSharingScreen {
            position: fixed;
            right: 240px;
            bottom: 10px;
            padding: 4px;
            width: 70%;
        }
        /* For 1024 Resolution */  
        @media only screen   
        and (min-device-width : 768px)   
        and (max-device-width : 1024px)  
        { 
            .screenSharingVideo{
                width: 800px;
                height: 370px;
                overflow: auto;
            }

            .videoSharingScreen {
                position: fixed;
                right: 240px;
                bottom: 10px;
                padding: 4px;
                width: 60%;
            }
        } 

        /* For 1366 Resolution */  
        @media only screen   
        and (min-width: 1030px)   
        and (max-width: 1366px)  
        {
            .screenSharingVideo{
                width: 800px;
                height: 370px;
                overflow: auto;
            }

            .videoSharingScreen {
                position: fixed;
                right: 240px;
                bottom: 10px;
                padding: 4px;
                width: 65%;
            }
        }  

        @media only screen   
        and (min-width: 1370px)  
        and (max-width: 1605px)  
        { 
            .screenSharingVideo{
                width: 1000px;
                height: 500px;
                overflow: auto;
            }


        }   
        
        /*.mce-content-body.my_class{*/
        /*padding-left: 50px;*/
        /*padding-right: 50px;*/
        /*word-wrap: break-word;*/
        /*}*/
        /*@media print {*/
        /*#dddd{*/
        /*display: none;*/
        /*visibility: hidden;*/
        /*}*/
        /*}*/
        /*.mce-tinymce.mce-container.mce-panel {*/
        /*border: 2px dashed blue !important;*/
        /*}*/
    </style>
    <script>
        jQuery(document).ready(function ($) {

            setTimeout(function () {
                $('#preloader').fadeOut('slow', function () {
                    $(this).remove();
                    $('#doc_content_maindiv').show();
                    // tinymce.get('doc_content').focus();
                });
            }, 300);

            $("#notification_aria_close, #notification_aria_close_normal_email").click(function (event) {
                var id = this.id;
                if (id == 'notification_aria_close_normal_email') {
                    $("#notification_aria_normal_email").hide();
                } else {
                    $(".notification_aria").removeClass('show').addClass('hide');
                }
            });

            $("#allow_notification_sound_button").click(function (event) {
//                alert('hi');
                $("#allow_notification_sound_div").hide();
                var created_date = $("#created_date").val();
                var sender_name = $("#sender_name").val();
                var total_unread_email = $("#total_unread_email").val();

                var shutter = new Audio();
                shutter.autoplay = true;
                shutter.src = navigator.userAgent.match(/Firefox/) ? 'notification_sound.ogg' : 'notification_sound.mp3';
                // play sound effect
                shutter.play();
                $("#notification_aria").show();
                $(".home_page_navi").removeClass('hide').addClass('show');
                $('#date_time').html(created_date);
                $('#show_sender_name').html(sender_name);
                if (total_unread_email > 0) {
                    $('#total_unread_email_section').show();
                    $('#total_unread_email_section').html('未読 ' + total_unread_email + ' 通あります。');
                }
            });

//            var dntrigger = document.getElementById('trigger');
//            dntrigger.addEventListener('click', function (e) {
//
////            e.preventDefault();
////                alert('hi');
//                if (!("Notification" in window)) {
//                    alert("This browser does not support desktop notification");
//                }
//                if (Notification.permission !== "granted")
//                    Notification.requestPermission();
//                else {
//                    var notification = new Notification('', {
//                        icon: 'https://keipro.development.dhaka10.dev.jacos.jp/resource/img/notification_icon.png',
//                        body: "決裁書が届いています",
//                        lang: "jp",
//                        data: 'hmmm',
//                        actions:'yes'
//                        });
//                    notification.onclick = function () {
//                        console.log(this.actions);
//                        //                    window.open("http://stackoverflow.com/a/13328397/1269037");
//                    };
//                }
//
//
//            });

        });


//        var notificationInterval = setInterval(function () {
//            var counter = 0;
//            email_check_for_user();
//        }, 15000);

        function view_settlement_form_home(id) {
            var settlement_id = $("#settlement_id_home").val();
            var base_url = $("#base_url").val();
            var share_this_settlement_id = 1;
            var back_one_step = 0;

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

            if (id == 2) {
                var settlement_mail_screen = 1;
                window.open(base_url + 'index.php/wordapp/view_settlement_form/' + settlement_id + '/' + share_this_settlement_id + '/' + back_one_step + '/' + settlement_mail_screen, "New Window", style);

            } else {
                window.open(base_url + 'index.php/wordapp/view_settlement_form/' + settlement_id + '/' + share_this_settlement_id, "New Window", style);

            }
        }

        //        function allow_notification_sound_button() {
        //            var shutter = new Audio();
        //            shutter.autoplay = true;
        //            shutter.src = navigator.userAgent.match(/Firefox/) ? 'notification_sound.ogg' : 'notification_sound.mp3';
        //            // play sound effect
        //            shutter.play();
        //        }
        function email_check_for_user() {
            var login_user_id = $("#login_user_id").val();

//            if (login_user_id == 105) { //login_user_id == 113 || login_user_id == 129
//
//                showNotification_test();
//
//            } //end if

//            alert(counter);
            var base_url = $("#base_url").val();
            $.ajax({
                url: base_url + "index.php/wordapp/email_check_for_user",
                type: "POST",
                data: {},
                async: false,
                cache: false,
                dataType: "text",
                success: function (response, textStatus, jqXHR) {
                    var response_val = response.trim();

                    if (response_val != 0) {
                        var response_val_array = response_val.split('######');
                        var settlement_id = response_val_array[0];
                        var email_id = response_val_array[1];
                        var president_seal_id = response_val_array[2];
                        $("#president_seal_id").val(president_seal_id);

//                        alert(president_seal_id);die();
//                    if (response_val > 0 && counter == 0) {
//                        counter = 1;
//                    }
//                alert(response_val);die();
//                    var counter = 0;

//                        if (counter == 1) {
                        setTimeout(function () {
                            $.ajax({
                                url: base_url + "index.php/wordapp/update_notification_shown",
                                data: {email_id: email_id},
                                async: false,
                                cache: false,
                                dataType: "text",
                                type: 'POST',
                                success: function (response2, textStatus, jqXHR) {
                                    var response_val2 = response2.trim();

                                    var response_val2_array = response_val2.split('#####');
                                    var created_date = response_val2_array[0];
                                    var sender_name = response_val2_array[1];
                                    var total_unread_email = response_val2_array[2];
//                                    console.log(total_unread_email);
//                                die();

//                            $("#settlement_id_home").show();

//                                setTimeout('$("#notification_aria").hide();', 40000);
//                            showNotification();
                                    if (settlement_id > 0) {

//                                        if (login_user_id == 105) {
                                            $("#settlement_id_home").val(settlement_id);
                                            $("#created_date").val(created_date);
                                            $("#sender_name").val(sender_name);
                                            $("#total_unread_email").val(total_unread_email);

                                            showNotification_test();

//                                        }
//                                        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
//                                            $("#settlement_id_home").val(settlement_id);
//                                            $("#created_date").val(created_date);
//                                            $("#sender_name").val(sender_name);
//                                            $("#total_unread_email").val(total_unread_email);
//                                            showNotification();
//                                            $("#allow_notification_sound_div").show();
//                                            $("#settlement_id_home").val(settlement_id);
//                                            $("#created_date").val(created_date);
//                                            $("#sender_name").val(sender_name);
//                                            if (total_unread_email > 0) {
//                                                $('#total_unread_email_section').show();
//                                                $('#total_unread_email_section').html('未読 ' + total_unread_email + ' 通あります。');
//                                            }
//                                            $("#allow_notification_sound_button").trigger('click');
//                                            shutter.play();
//                                            var audio = new Audio(base_url + 'notification_sound.ogg');
//                                        } else {
//                                            var audio = new Audio('notification_sound.mp3');
//                                            audio.play();
//                                            $("#notification_aria").show();
//                                            if (president_seal_id != 0)
//                                                $("#notification_text").text("最終決裁が承認しました");
//                                            else
//                                                $("#notification_text").text("決裁書が届いています");
//
//                                            $(".home_page_navi").removeClass('hide').addClass('show');
//                                            $('#date_time').html(created_date);
//                                            $('#show_sender_name').html(sender_name);
//
//                                            if (total_unread_email > 0) {
//                                                $('#total_unread_email_section').show();
//                                                $("#total_unread_email_section").removeClass('hide').addClass('show');
//                                                $('#total_unread_email_section').html('未読 ' + total_unread_email + ' 通あります。');
//                                            }
//                                        }
                                    }
                                    if (settlement_id == 0) {

                                        $("#notification_aria_normal_email").show();
                                        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
                                            var audio = new Audio('notification_sound.ogg');
                                        } else {
                                            var audio = new Audio('notification_sound.mp3');
                                        }
                                        audio.play();
                                        $(".home_page_navi").removeClass('hide').addClass('show');
                                        $('#date_time_normal_email').html(created_date);
                                        $('#show_sender_name_normal_email').html(sender_name);
                                    }

//                                clearInterval(notificationInterval);


                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    //if fails
//                    alert(textStatus);
                                }
                            });
                        }, 5000);
                    }


//                        } else {
//                            $("#notification_aria").hide();
//                            setInterval(function () {
//                                counter = 2;
//                                email_check_for_user(counter);
//                            }, 10000);
//                        }

//                    } else {
////                        $("#notification_aria").hide();
////                        $(".home_page_navi").removeClass('show').addClass('hide');
//                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
//                    alert(textStatus);
                }
            });
        }

        function showNotification() {
//            alert('new function');
            var shutter = new Audio();
            shutter.autoplay = true;
            shutter.src = navigator.userAgent.match(/Firefox/) ? 'notification_sound.ogg' : 'notification_sound.mp3';
            // play sound effect
            shutter.play();

            $(".notification_aria").removeClass('hide').addClass('show');
            var created_date = $("#created_date").val();
            var sender_name = $("#sender_name").val();
            var president_seal_id = $("#president_seal_id").val();
            var total_unread_email = $("#total_unread_email").val();

            $(".home_page_navi").removeClass('hide').addClass('show');

            if (president_seal_id != 0)
                $("#notification_text").text("最終決裁が承認しました");
            else
                $("#notification_text").text("決裁書が届いています");

//                                            $(".notification_aria").removeClass('hide').addClass('show');
            $('#date_time').html(created_date);
            $('#show_sender_name').html(sender_name);

            if (total_unread_email > 0) {
//                $('#total_unread_email_section').show();
                $(".total_unread_email_section").removeClass('hide').addClass('show');
                $('#total_unread_email_section').html('未読 ' + total_unread_email + ' 通あります。');
            }

//
//                    if (!("Notification" in window)) {
//                        alert("This browser does not support desktop notification");
//                    }
//                    if (Notification.permission !== "granted")
//                        Notification.requestPermission();
//                    else {
////                        alert('granted');
//                        var audio = new Audio('notification_sound.mp3');
//                        audio.play();
//                        var notification = new Notification('', {
//                            icon: 'https://keipro.development.dhaka10.dev.jacos.jp/resource/img/notification_icon.png',
//                            body: "決裁書が届いています<?php ////echo $email_subject; ?>//",
//                        });
//        //                決裁書があります
//                        notification.onclick = function () {
//                            event.preventDefault();
//        //                    window.open("http://stackoverflow.com/a/13328397/1269037");
//                        };
//
//                    }

        }

        function showNotification_test() {
            var created_date = $("#created_date").val();
            var sender_name = $("#sender_name").val();
            var president_seal_id = $("#president_seal_id").val();
            var total_unread_email = $("#total_unread_email").val();
            var settlement_id = $("#settlement_id_home").val();
            var base_url = $("#base_url").val();
            var share_this_settlement_id = 1;
            var back_one_step = 0;

            if (president_seal_id != 0)
                var notification_text = "最終決裁が承認しました";
            else
                var notification_text = "決裁書が届いています";

            if (total_unread_email > 0) {
                var total_unread_email_section = '未読 ' + total_unread_email + ' 通あります。';
            }


            navigator.serviceWorker.register('sw.js');
            Notification.requestPermission(function (result) {
                if (result === 'granted') {
                    navigator.serviceWorker.ready.then(function (registration) {
                        registration.showNotification(total_unread_email_section, {
                            body: '送信者：' + sender_name + ' さんより\n' + notification_text + '\n日付             時間\n' + created_date,
                            icon: 'https://e901-83-234-227-9.ngrok-free.app/resource/img/notification_icon.png',
                            vibrate: [200, 100, 200, 100, 200, 100, 200],
                            tag:base_url + 'index.php/wordapp/view_settlement_form/' + settlement_id + '/' + share_this_settlement_id
//                            requireInteraction: true,
//                            lang: 'ja'
                        });

                    });

                }
            });


//            if (!("Notification" in window)) {
//                alert("This browser does not support desktop notification");
//            }
//            if (Notification.permission !== "granted")
//                Notification.requestPermission();
//            else {
//                var notification = new Notification('', {
//                    icon: 'https://keipro.development.dhaka10.dev.jacos.jp/resource/img/notification_icon.png',
//                    body: "test",
//                });
////                決裁書があります
//                notification.onclick = function () {
//                    event.preventDefault();
//                    $(".email_main_modal").modal('show');
//                    // $("#emailing_aria").show();
//                    $("#email_navigation_message").removeClass('hide').addClass('show');
//
////                    window.open("http://stackoverflow.com/a/13328397/1269037");
//                };
//
//            }

        } // end function
    </script>
</head>

<body style="padding-top: 0; margin-top: 0;">
<!--loader for copy/paste on editor-->
<div id="preloader"
     style="position: fixed; left: 0; top: 0; z-index: 999; width: 100%; height: 100%; overflow: visible; background: transparent url('resource/img/ajax/ajax_load_6.gif') no-repeat center center;">

</div>
<style>
    #print-preview-popup{
        position: fixed;
        width: 90%;
        left: 5%;
        border: 1px solid gainsboro;
        height: 95%;
        z-index: 999;
        bottom: 5%;
        background: white;
        box-shadow: 1px 2px 5px 0px;

    }
    .print-preview-settings{
        width: 20%;
        padding:1em;
        float:left;
        padding-top:2em;
    }
    .print-preview-content{
        width: 80%;
        background: gainsboro;
        height: 100%;
        float:left;
    }
    .print-preview-pdfcontent{
        width:100%;
        height: 100%;
    }

    .pp-navi,.pp-navi-partial{
        position: fixed;
        width: 300px;
        right: 8%;
        border: 1px solid gainsboro;
        border-radius: 7px;
        height: 150px;
        z-index: 9999;
        bottom: 8%;
        background: #FFFFCC;
        box-shadow: 1px 2px 5px 0px;
        padding: 15px;
    }
    .pp-navi-finish{
        position: fixed;
        width: 300px;
        right: 8%;
        border: 1px solid gainsboro;
        border-radius: 7px;
        height: 70px;
        z-index: 9999;
        bottom: 8%;
        background: #FEEBFF;
        box-shadow: 1px 2px 5px 0px;
        padding: 15px;
    }

    .mce-tinymce.mce-container.mce-panel {
        margin: 0 auto;
    }
    .print-pdf-loading{
        position: relative;
        width: 100%;
        height: 100%;
        background: gray;
    }
    .print-pdf-loading .loading-text{
        position: absolute;
        top:50%;
        width:100%;
        text-align: center;
        color:white;
        font-size:18px;
    }



</style>

<div id="print-preview-popup" style="display:none;">
    <div class="print-preview-settings">
        <label class="pull-left" style="margin-top:5px;">印刷する</label>
        <button class="btn btn-danger pull-right btn-sm print-preview-cancel">戻る</button>
        <div class="clearfix"></div>
        <hr>
        <br>
        <select class="form-control print-preview-paper-size">
            <option value="A4">サイズ A4</option>
            <option value="A3">サイズ A3</option>
            <option value="A2">サイズ A2</option>
            <option value="B5">サイズ B5</option>
            <option value="B4">サイズ B4</option>
        </select>
        <br>
        <button class="btn btn-default form-control print-preview-selection">部分印刷優先</button>
        <br><br>
        <button class="btn btn-default form-control print-preview-pagecount">部数（ページ）</button>
        <br><br>
        <button class="btn btn-success form-control print-preview-printout" disabled>印刷実行</button>

    </div>
    <!-- <div class="print-preview-content">
        <iframe class="print-preview-pdfcontent" src="" style="display:none;"></iframe>
        <div class="print-pdf-loading">
            <span class="loading-text">Loading .... </span>
        </div>
    </div> -->

</div>

<div class="pp-navi text-center" style="display:none;">
    <label style="margin-top:1.5em;"><data id="pp-navi-page-count">000</data> ページですが、よろしいですか？</label>
    <br>
    <button style="margin-right:10px;margin-top:1em;" class="btn btn-success pp-navi-success">はい</button>
    <button style="margin-right:10px;margin-top:1em;" class="btn btn-danger pp-navi-cancel">いいえ</button>
</div>

<div class="pp-navi-partial text-center" style="display:none;">
    <label style="margin-top:1.5em;">選択した部分の印刷をします。よろしいですか？</label>
    <br>
    <button style="margin-right:10px;margin-top:1em;" class="btn btn-success pp-navi-partial-success">はい</button>
    <button style="margin-right:10px;margin-top:1em;" class="btn btn-danger pp-navi-partial-cancel">いいえ</button>
</div>

<div class="pp-navi-finish text-center" style="display:none;">
    <label style="margin-top:.5em;">印刷完了しました。</label>
</div>



<div class="top_header" style="width: 100%; background-color: #5cb85c; margin-top: 0; margin-bottom: 7px;">
    <!--    <div style="width: 90%; ">-->
    <div class="container" style="margin-top: 0">
        <?php
        if ($account->user_type == 2 && $account->company_id != 0) {
            ?>
            <div style="float: left; color: white;">
                会社名 - <?php
                if ($company_name->company_name != '')
                    echo $company_name->company_name;
                else if ($company_name->name != '')
                    echo $company_name->name;
                else
                    echo $company_name->username;
                ?>
            </div>
            <?php
        }
        ?>
        <div class="dropdown" style="float: right; z-index: 1200;">
            <button class="btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                <?php
                if ($account->company_name != '')
                    echo $account->company_name;
                else if ($account->name != '')
                    echo $account->name;
                else
                    echo $account->username;
                ?>
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <?php if ($account->user_type == 1) {
                    ?>
                    <li><a id="user_management" href="javascript:void(0);">ユーザー管理</a></li>
                    <?php
                } ?>
                <li><a href="javascript:void(0);" id="destroy_session1" data-html="true" data-toggle="popover"
                       data-container="body" title="" data-trigger="hover" data-original-title="">終了</a></li>
            </ul>
        </div>
    </div>

    <!--    </div>-->
</div>
<!--end loader for copy/paste on editor-->
<!--<a id="trigger" href="#">Notify me!</a>-->
<!--<button onclick="showNotification_test()">Notify me!</button>-->

<!--<div class="internet_connection_alert navbar-fixed-top" id="internet_connection_alert" style="display: none;">-->
<!--    <a href="#" id="internet_connection_alert_close" class="internet_connection_alert_close pull-right"-->
<!--       style="color:white;">-->
<!--        <i class="fa fa-close"></i></a>-->
<!--    <center>インターネットに接続されていません。 接続を確認してください。</center>-->
<!--</div>-->
<!--<button id="insert_row">row add</button>-->
<div class="container-fluid">
    <div class="row">
        <input type="hidden" id="login_user_id" name="login_user_id" value="<?= $account->id; ?>">
        <input type="hidden" name="base_url" id="base_url" value="<?= base_url() ?>">
        <input type="hidden" name="word_bold_mapping" id="word_bold_mapping" value="0">
        <input type="hidden" name="apply_style" id="apply_style" value="0">
        <input type="hidden" name="font_family_mapping" id="font_family_mapping" value="0">
        <input type="hidden" name="font_size_mapping" id="font_size_mapping" value="0">
        <input type="hidden" name="font_size_number_mapping" id="font_size_number_mapping" value="0">
        <input type="hidden" name="font_color_mapping" id="font_color_mapping" value="0">
        <input type="hidden" name="font_color_code_mapping" id="font_color_code_mapping" value="0">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 sidebar-offcanvas show" id="left_content_aria">
            <div class="left_content_aria sidebar-nav-fixed affix">
                <center><strong>見出し表示</strong></center>
                <!-- <button type="button" id="account_setting-btn" class="btn btn-info btn-sm">Account Setting</button> -->
                <input id="sign_up_namedafda" autofocus style="ime-mode:active; border:0; width: 20%" type="tel" class="form-control" name="sign_up_namedafda" required="required" >
            </div>

            <div class="clearfix"></div>
        </div>


        <div style="background-color: #DDDDDF; height: 0.5em;"
             class="col-lg-2 col-md-2  col-sm-2 col-xs-12 mobile_width pull-right">
            <div style="background-color: #DDDDDF" class="word_btn_containers">
                <div class="word_btn_container22 flex-container" style="margin-top: 0.3em">
                    <!-- <button tabindex="0" class="btn btn-success btn_keipro word_style_button" id="show_table_of_content" data-toggle="popover" id="show_table_of_content"
                            role="button">目次
                    </button> -->
                    <button tabindex="0" class="btn btn-success btn_keipro word_style_button" id="show_table_of_content"
                            role="button" data-toggle="popover" data-container="body" data-html="true" title=""
                            data-content="目次<br>目次を表示し、文章を選択・削除します。" data-placement="auto left" data-trigger="hover">目次
                    </button>

                    <button class="btn btn-success btn_keipro" id="create_new_doc" data-toggle="popover" data-container="body" title="" data-html="true" data-content="新規<br>新しい文章を書きます。目次は自動保存されます。"
                            data-placement="auto left" data-trigger="hover">新規
                    </button>

                    <button class="btn btn-success btn_keipro" id="undo" data-html="true" role="button"
                            onclick="word_undo()" data-toggle="popover" data-container="body" title=""
                            data-content="復元<br>誤って消去した文字を復元します。" data-placement="auto left" data-trigger="hover">復元
                    </button>

                    <button class="btn btn-success btn_keipro" id="font_width" data-html="true" role="button"
                            onclick="font_width()" data-toggle="popover" data-container="body" title=""
                            data-content="太字<br>選択した文字を、太字に修飾します。<br>再度（２度）操作すると、太字は解消します。
　" data-placement="auto left" data-trigger="hover">太 字
                    </button>

                    <button class="btn btn-success btn_keipro" id="font_family" data-html="true" role="button"
                            data-toggle="popover" data-container="body" title="" data-content="書体<br>明朝体・・・などの書体を変更します。
                                    " data-placement="auto left" data-trigger="hover">書 体
                    </button>

                    <button class="btn btn-success btn_keipro " id="font_size" data-html="true" role="button"
                            data-toggle="popover" data-container="body" title="" data-content="サイズ<br>選択した文字の大きさを拡大・縮小します。
                                    " data-placement="auto left" data-trigger="hover">サイズ
                    </button>


                    <button class="btn btn-success btn_keipro" data-html="true" role="button" data-toggle="popover"
                            data-container="body" id="income_sheet_btn" title="" data-content="表計算<br>。。。。。"
                            data-placement="auto left" data-trigger="hover">表計算
                    </button>
                    <button class="btn btn-success btn_keipro" id="inserImage" data-html="true" role="button"
                            data-toggle="popover" data-container="body" title="" data-content="挿し絵<br>写真や画像を文中に入れられます"
                            data-placement="auto left" data-trigger="hover">挿し絵
                    </button>

                    <button class="btn btn-success btn_keipro" id="word_function" data-html="true" role="button"
                            data-toggle="popover" data-container="body" title="" data-content="機能<br>多くの機能があり、選択して使用します。ご確認ください。
                                    " data-placement="auto left" data-trigger="hover">機能
                    </button>

                    <button class="btn btn-success btn_keipro" role="button"
                            title="" data-content="ペーパーレス" data-placement="auto left" data-trigger="hover" href="/">
                         <a href="/mail" target="_blank" style="color: white;text-decoration: none">ペーパーレス</a>
                    </button>

                    <button class="btn btn-success btn_keipro" role="button"                                                                                                                                                                                                              `
                            title="" data-content="ペーパーレス" data-placement="auto left" data-trigger="hover" href="/">
                        <a href="/kessai" target="_blank" style="color: white;text-decoration: none">メール</a>
                    </button>


                    <!--                            <button class="btn btn-success btn_keipro" id="shapes" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content=" 絵・図 " data-placement="bottom" data-trigger="hover"> 絵・図</button>-->


                    <!--                    <button class="btn btn-success btn_keipro" id="shapes" data-html="true" role="button"-->
                    <!--                            data-toggle="popover" data-container="body" title="" data-content="絵・図"-->
                    <!--                            data-placement="auto left" data-trigger="hover">絵・図-->
                    <!--                    </button>-->


<!--                    <button id="emailing_aria_button" data-html="true" class="btn btn-success btn_keipro" role="button"-->
<!--                            data-toggle="popover" data-container="body" title=""-->
<!--                            data-content="メール<br>ペーパーレス促進のため、共有が出来ます。。" data-placement="left" data-trigger="hover">メール-->
<!--                    </button>-->

                    <!-- <button id="pagingTest" data-html="true" class="btn btn-success btn_keipro" role="button"
                            data-toggle="popover" data-container="body" title=""
                            data-content="テスト" data-placement="left" data-trigger="hover">テスト
                    </button> -->

<!--                    <button style="height:47px; font-size: 12px" class="btn btn-success btn_keipro"-->
<!--                            id="settlement_letter_choice1"-->
<!--                            data-html="true" role="button"-->
<!--                            data-toggle="popover" data-container="body" title="" data-content="ペーパーレス-->
<!--" data-placement="auto left" data-trigger="hover">ペーパー<br>レス-->
<!--                    </button>-->

                    <button class="btn btn-success btn_keipro" id="destroy_session" data-html="true"
                       class="btn btn-success sign_out_btn btn_keipro" role="button" data-toggle="popover" data-container="body"
                       title="" data-content="終了<br>全てを終了します。自動保存で安心です。" data-placement="auto left"
                       data-trigger="hover">終了</button>


                    <!--                    <span contenteditable="false" id="page_count1" style="width:5%;text-align: right; position: absolute; right:8px ;bottom: 15px; ">1/1</span>-->
                </div>
                <!-- <div id="explanation">
                    <div class="title">【日本語IME操作方法】</div>
                    
                        On / Off : Shift + Space<br>
                        変換開始 : Space<br>
                        候補選択 : Space ↑ ↓<br>
                        文節移動 : ← →, 確定 : Enter<br>
                        強制かな : F6, 強制カナ : F7
                    
                </div> -->
                <div class="clearfix"></div>

                <!-- Japanies -->
                <!--<button id="full_screen_word" class="btn btn-success pull-right" role="button" data-toggle="popover" data-container="body" data-html="true" title="" data-content="拡大<br>全画面に拡大出来、2度押すと元に戻ります。" data-placement="left" data-trigger="hover">拡大</button>-->

            </div>
            <div class="clearfix"></div>
        </div>
        <!--/.sidebar-offcanvas-->

        <div class="content_maindiv col-lg-8 col-sm-10 col-md-10 col-xs-12" id="doc_content_maindiv">
            <div class="fixed-editor" id="fixed-editor" style="margin-left:0">
                <input type="hidden" id="number_of_page" value="1" name="number_of_page">
                <input type="hidden" name="post_id" id="post_id" value="">
                <input type="hidden" name="current_open_file" id="current_open_file" value="">
                <input type="hidden" id="event_mapping" name="event_mapping" value="1">
                <textarea class="form-control" id="doc_content" name="doc_content" style="ime-mode:active;">

                </textarea>
                <script>
                    $('#doc_content').on('keyup', function(e) {
                        alert(e);
                        if(e.chatCode === 13) {
                            var text = $('#doc_content').val();
                            $('#doc_content').val("   " + text);
                        }
                    });
                </script>
                <!--<span contenteditable="false" id="page_count1"
                      style="width:17%;float: right; right:1px ;bottom: 15px; font-family: ms mincho, ｍｓ 明朝; font-weight: bold;"> ページ 1 / 1</span>-->
                <!--                <textarea class="form-control" id="doc_content2" name="doc_content2">-->
                <!--                </textarea>-->
            </div>
            <?php
            /*for ($x = 2; $x <= 4; $x++) {
                ?>
                <div style="margin-top: 20px; display: none;" class="fixed-editor" id="fixed_editor<?php echo $x; ?>">
                <textarea class="form-control" id="doc_content<?php echo $x; ?>" name="doc_content<?php echo $x; ?>">
                </textarea>
                    <span contenteditable="false" id="page_count<?php echo $x; ?>"
                          style="width:17%;float: right; right:1px ;bottom: 15px; font-family: ms mincho, ｍｓ 明朝; font-weight: bold;"> ページ 2 / 2</span>
                </div>
                <?php
            }*/
            ?>
        </div>


    </div>
    <!--/row-->

</div>
<!--/.container-->
<!-- Font Color Area -->

<div class="col-lg-4 col-md-5 col-sm-5 col-xs-7 draggable_aria close_aria home_page_navi"
     id="default_autosaving_message">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body" style="padding: 5px;">
            <h4>第１ナビ</h4>
                <p>1. 自動保存されますので、保存操作は不要です。</p>
                <p>2. 新文書の先頭15文字が、目次に自動保存されます。</p>
                <!-- 3. メールおよび、ペーパーレスのボタンを押して使用できます。 -->
            </strong>
        </div>
    </div>
</div>
<div class="col-lg-10 col-md-10 draggable_aria videoSharingScreen hide"
     id="videoSharingScreen">
    
    <div class="panel panel-default"
         style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
         <div class="panel-heading">
            <button type="button" class="btn btn-danger btn-lg pull-right" id="videoSharingScreen_close" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="戻る" data-placement="auto top"> 戻る</button>

            <button type="button" class="btn btn-success btn-lg pull-right" id="videoImageInsert" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="貼り付け" data-placement="auto top" style="margin-right: 5px;"> 貼り付け</button>
            <div class="clearfix"></div>
         </div>
        <div class="panel-body" style="padding: 5px;">
            <video class="screenSharingVideo" id="screenSharingVideo" autoplay></video>
            <canvas class="screenSharingVideo hide" id="screenSharingCanvas"></canvas>
            
        </div>
    </div>
</div>

<!-- start settlement/requisition/decision notification popup -->
<input type="hidden" id="settlement_id_home" name="settlement_id_home"
       value="<?php if (isset($settlement_id)) echo $settlement_id; else echo 0; ?>">
<input type="hidden" id="created_date" name="created_date"
       value="">
<input type="hidden" id="sender_name" name="sender_name"
       value="">
<input type="hidden" id="total_unread_email" name="total_unread_email"
       value="0">
<input type="hidden" id="president_seal_id" name="president_seal_id"
       value="">
<div style="background-color: #FFFFFF; border-radius: 2px;  box-shadow: 1px 2px 2px 4px #ccc;border-radius: 2px;"
     class="col-lg-4 col-md-5 col-sm-5 col-xs-7 notification_aria hide"
     id="notification_aria">

    <div style="margin-bottom: 2px;">
        <div style="width:auto; text-align: right; cursor: pointer;" id="notification_aria_close">
            <img src="<?php echo base_url(); ?>resource/img/close.png">
        </div>
        <div style="width:auto; text-align: left; font-family: ms mincho, ｍｓ 明朝; ">
        <span onclick="view_settlement_form_home(2);" class="total_unread_email_section hide"
              id="total_unread_email_section"
              style="margin-left: 55px; cursor: pointer;background-color: #204d74;padding: 7px; width:180px; height: 35px; color: white; border: 1px solid #204d74; border-radius: 5px;">&nbsp; </span><br>
            <img src="<?php echo base_url(); ?>resource/img/notification_icon.png"> <span
                    id="sender_name" style="font-size: 16px;">送信者：<span id="show_sender_name"> </span> さんより</span><br>
            <span
                    id="notification_text" style="font-size: 16px; margin-left: 60px;"></span><br>
            <span style="margin-left:80px;">日付 &nbsp;&nbsp;&nbsp; 時間 </span><br> <span id="date_time"
                                                                                       style="margin-left:60px;"><?php echo $created_at; ?> </span>
        </div>
        <div style="width:auto; text-align: center; margin-top: 7px;">

            <!--        <button type="button" id="view_email_main_modal"-->
            <!--                style="background-color: green; color: white; padding: 5px; width:100px; border: 1px solid transparent; border-radius: 4px;">-->
            <!--            受発信画面-->
            <!--        </button>-->
            <button onclick="view_settlement_form_home(1);" type="button" id="view_settlement_form"
                    style="margin-left: 7px;background-color: #00CC00; color: white; padding: 5px; width:100px; border: 1px solid transparent; border-radius: 4px;">
                決裁書を開く
            </button>
        </div>
    </div>
</div>
<div class="col-lg-2 col-md-4 col-sm-4 col-xs-8 pull-right" id="notification_aria1111"
     style="display:none; width:300px;position: fixed; padding: 7px 7px 7px 15px; border-radius: 2px; z-index:9999; right:400px; bottom:5px;background-color: #FFFFFF; border-radius: 2px;  box-shadow: 1px 2px 2px 4px #ccc;">
    <div style="width:auto; text-align: right; cursor: pointer;" id="notification_aria_close">
        <img src="<?php echo base_url(); ?>resource/img/close.png">
    </div>
    <div style="width:auto; text-align: left; font-family: ms mincho, ｍｓ 明朝; ">
        <span onclick="view_settlement_form_home(2);" id="total_unread_email_section111"
              style="margin-left: 55px; cursor: pointer;background-color: #204d74;padding: 7px; width:200px; height: 100px; color: white; border: 1px solid #204d74; border-radius: 5px;  display: none;"> </span><br>
        <img src="<?php echo base_url(); ?>resource/img/notification_icon.png"> <span
                id="sender_name" style="font-size: 16px;">送信者：<span id="show_sender_name"> </span> さんより</span><br>
        <span
                id="notification_text" style="font-size: 16px; margin-left: 60px;"></span><br>
        <span style="margin-left:80px;">日付 &nbsp;&nbsp;&nbsp; 時間 </span><br> <span id="date_time"
                                                                                   style="margin-left:60px;"><?php echo $created_at; ?> </span>
    </div>
    <div style="width:auto; text-align: center; margin-top: 7px;">

        <!--        <button type="button" id="view_email_main_modal"-->
        <!--                style="background-color: green; color: white; padding: 5px; width:100px; border: 1px solid transparent; border-radius: 4px;">-->
        <!--            受発信画面-->
        <!--        </button>-->
        <button onclick="view_settlement_form_home(1);" type="button" id="view_settlement_form"
                style="margin-left: 7px;background-color: #00CC00; color: white; padding: 5px; width:100px; border: 1px solid transparent; border-radius: 4px;">
            決裁書を開く
        </button>
    </div>
</div>
<!-- end settlement/requisition/decision notification popup -->

<!-- start normal email notification popup -->
<div class="col-lg-2 col-md-4 col-sm-4 col-xs-8 pull-right" id="notification_aria_normal_email"
     style="display:none; width:300px;position: fixed; padding: 7px 7px 7px 15px; border-radius: 2px; z-index:9999; left:300px; bottom:5px;background-color: #FFFFFF; border-radius: 2px;  box-shadow: 1px 2px 2px 4px #ccc;">
    <div style="width:auto; text-align: right; cursor: pointer;" id="notification_aria_close_normal_email">
        <img src="<?php echo base_url(); ?>resource/img/close.png">
    </div>
    <div style="width:auto; text-align: left; font-family: ms mincho, ｍｓ 明朝; ">
        <img src="<?php echo base_url(); ?>resource/img/notification_icon.png"> <span
                id="sender_name" style="font-size: 16px;">送信者：<span
                    id="show_sender_name_normal_email"> </span> さんより</span><br>
        <span
                id="notification_text_normal_email" style="font-size: 16px; margin-left: 60px;">メールが届いています。</span><br>
        <span style="margin-left:80px;">日付 &nbsp;&nbsp;&nbsp; 時間 </span><br> <span id="date_time_normal_email"
                                                                                   style="margin-left:60px;"><?php echo $created_at; ?> </span>
    </div>
    <div style="width:auto; text-align: center; margin-top: 7px;">

        <button type="button" id="view_email_main_modal"
                style="background-color: green; color: white; padding: 5px; width:100px; border: 1px solid transparent; border-radius: 4px;">
            受発信画面
        </button>
        <!--        <button onclick="view_settlement_form_home();" type="button" id="view_settlement_form"-->
        <!--                style="margin-left: 7px;background-color: #00CC00; color: white; padding: 5px; width:100px; border: 1px solid transparent; border-radius: 4px;">-->
        <!--            決裁画面-->
        <!--        </button>-->
    </div>
</div>

<!-- end normal email notification popup -->


<!-- start allow notification sound popup -->
<div class="col-lg-2 col-md-4 col-sm-4 col-xs-8 pull-right" id="allow_notification_sound_div"
     style="position: fixed; display: none; width: 100%; height: 100%; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); z-index: 2; cursor: pointer;">
    <!--    display:none; width:300px;position: fixed; padding: 7px 7px 7px 15px; border-radius: 2px; z-index:9999; left:300px; bottom:5px;background-color: #FFFFFF; border-radius: 2px;  box-shadow: 1px 2px 2px 4px #ccc;-->
    <div style="width:100%; text-align: center; margin-top: 7px;">
        <div style="display: inline-block; position: fixed;top: 0; bottom: 0;left: 0;right: 0;margin: auto;width:350px; height: 110px; padding: 20px; border-radius: 2px;background-color: #FFFFFF; border-radius: 2px;  box-shadow: 1px 2px 2px 4px #ccc; font-family: ms mincho, ｍｓ 明朝; ">
            <span style="font-size: 16px;">決裁書が届きました、</span><br><br>
            <button type="button" id="allow_notification_sound_button"
                    style="background-color: green; color: white; padding: 5px; width:100px; border: 1px solid transparent; border-radius: 4px;">
                <!--            onclick="allow_notification_sound_button();"-->
                許可
            </button>
        </div>
    </div>

</div>

<!-- end allow notification sound popup -->
<?php
//if(!empty($new_email_check_for_user)){
?>
<script>
    //        var audio = new Audio('notification_sound.mp3');
    //        audio.play();
    //        showNotification();
    //        var notificationInterval = setInterval(function(){
    //            showNotification();
    //        }, 35000);
    //        // cancel after 5 min
    //        setTimeout(myStopFunction, 5 * 60 * 1000)
    //
    //        // clears the interval
    //
    //        function myStopFunction() {
    //            clearInterval(notificationInterval);
    //        }

</script>
<!--<div class="col-lg-4 col-md-5 col-sm-5 col-xs-7 draggable_aria close_aria home_page_navi hide"-->
<!--     id="new_email_notification_for_user" style="width:15%; right: 254px; bottom: 112px;padding: 4px 4px 4px 6px;">-->
<!---->
<!--    <div class="panel panel-info"-->
<!--         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; padding-left: 10px;">-->
<!--        <div class="panel-body">-->
<!--            <strong> 決裁書があります</strong>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<?php //} ?>
<div class="col-lg-10 col-md-10 col-sm-11 col-xs-11 pull-right table_of_contantes hide draggable_aria resp"
     id="table_of_contantes">
    <div style="padding: 0px;" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 title_aria">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding: 10px 0px">
            <strong>目次 <span class="span-title-list-files"
                             style="border: 1px red dashed; font-size: 16px;">（直近順に表示）</span></strong>
        </div>
        <div style="padding: 0px;" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <strong>
                <p>新文章の先頭15文字が、目次に自動登録されます。</p>
                <p>目次変更は文章を押し訂正します。</p>
            </strong>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 button_aria">

        <!-- Contextual button for informational alert messages -->
        <button type="button" class="btn btn-danger btn_table1 pull-right" id="table_close" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="戻る" data-placement="auto top"> 戻る</button>

        <!-- Indicates a successful or positive action -->
        <button type="button" class="btn btn-warning btn_table1 pull-right" id="word_next_page" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="次の頁へ" data-placement="auto top"> 次</button>
        <input type="hidden" id="word_start_list" name="word_start_list" value="0">
        <input type="hidden" id="total_user_post" name="total_user_post" value="0">
        <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        
        <button type="button" class="btn btn-warning btn_table1 pull-right" id="word_previous_page" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="前の頁へ" data-placement="auto top">
            前
        </button>
        <button type="button" class="btn btn-primary btn_table1 pull-right" id="delete_file" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="文章を削除します" data-placement="auto top"> 削除</button>
        <!-- Standard button -->

        <button type="button" class="btn btn-success btn_table1 pull-right" id="open_file" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="文章を開きます" data-placement="auto top"> 開く</button>
        <button type="button" class="btn btn-default btn_table1 pull-right" id="trash_folder" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="ゴミ箱を表示します" data-placement="auto top"> ゴミ箱</button>
    </div>
    <div class="clearfix"></div>

    <div style="padding: 0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 word_table_content_scroll_prant">
        <div class="word_table_content_scroll_child">
            <table class="table table-bordered content_tale_rasponsive" id="post_list"
                   style="font-size: 18px; color: #000;">

            </table>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right hide draggable_aria delete_confirm_alirt" id="delete_confirm_alirt"
         style="">

        <div class="panel panel-warning"
             style="margin-bottom: 2px; border: solid 2px #e74c3c; border-top: solid 7px #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body" style="font-size: 20px;">
                <p style="color: black;">削除する文章 </p>
                <p>: <span id="delete_title_show" style="font-weight: bold  !important; font-size: 20px !important; color: blue;"></span></p>
                <p><center style="font-size: 24px !important; color: red;">削除しますか？</center></p>
                <br>
                <center>
                    <button style="margin-left: 0; box-shadow: none; border: none;" type="button" class="btn btn-danger btn-lg"
                            id="delete_confirm">削除
                    </button>
                    <button type="button" class="btn btn-warning btn-lg" style="box-shadow: none; border: none;" id="delete_close">
                        戻る
                    </button>
                </center>
                
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-10 col-xs-10 pull-right hide draggable_aria close_aria delete_confirm_alirt" id="deleted_file_deleted" style="">
        <div class="panel panel-warning"
             style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body" style="font-size: 20px;">
                <h4>「 <span id="deletedss_file_title"></span> 」<br>&nbsp &nbsp を削除しました。</h4>
                <center>
                    <h5 style="color: blue;">ゴミ箱に移動しました。</h5>
                    <button id="close_select" class="btn btn-warning btn-lg">確認
                    </button>
                </center>
            </div>
        </div>
    </div>
    

    

    <div class="col-md-3 col-sm-10 col-xs-10 pull-right hide draggable_aria close_aria select_document" id="select_document"
         style="">

        <div class="panel panel-warning"
             style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body">
                <center><h4><i style="color: #f1c40f" class="fa fa-warning"></i>目次を選択してください。</h4>
                    <button id="close_select" class="btn btn-warning " style="box-shadow: none; border: none;">確認
                    </button>
                </center>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="col-lg-10 col-md-10 col-sm-11 col-xs-11 pull-right table_of_contantes hide draggable_aria resp"
     id="table_of_trash_files">
    <div style="padding: 0px;" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 title_aria">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding: 10px 0px">
            <strong>ゴミ箱 <span class="span-title-list-files"
                              style="border: 1px red dashed; font-size: 16px;">（直近順に表示）</span></strong>
        </div>
        <div style="padding: 0px;" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <strong>
                <!--                <p>新文章の先頭15文字が、目次に自動登録されます。</p>-->
                <!--                <p>目次変更は文章を押し訂正します。</p>-->
            </strong>
        </div>

    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 button_aria">

        <!-- Contextual button for informational alert messages -->
        <button type="button" class="btn btn-danger btn_table1 pull-right" id="trash_table_close" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="戻る" data-placement="auto top"> 戻る</button>

        <!-- Indicates a successful or positive action -->
        <!--        <button type="button" class="btn btn-warning btn_table1 pull-right" id="word_next_page"> 次</button>-->
        <input type="hidden" id="word_start_list" name="word_start_list" value="0">
        <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
        <!--        <button type="button" class="btn btn-warning btn_table1 pull-right" disabled="disabled" id="word_previous_page">-->
        <!--            前-->
        <!--        </button>-->
        
         <button type="button" class="btn btn-primary btn_table1 pull-right" id="permanent_delete_file" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="文章を完全に削除します" data-placement="auto top"> 削除</button>
        <!-- Standard button -->
        <button type="button" class="btn btn-success btn_table1 pull-right" id="restore_file" data-toggle="popover" data-trigger="hover" data-container="body" title="" data-html="true" data-content="文章を回復します" data-placement="auto top"> 回復</button>
    </div>
    <div class="clearfix"></div>

    <div style="padding: 0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 word_table_content_scroll_prant">
        <div class="word_table_content_scroll_child">
            <table class="table table-bordered content_tale_rasponsive" id="trash_post_list"
                   style="font-size: 18px; color: #000;">

            </table>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>

    <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right hide draggable_aria" id="delete_confirm_alirt"
         style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">

        <div class="panel panel-warning"
             style="margin-bottom: 2px; border: solid 2px #e74c3c; border-top: solid 7px #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body">
                <p style="font-size: 20px; font-weight: bold;">削除する文章: <span id="delete_title_show"></span></p>
                <br>
                <button style="margin-left: 0; box-shadow: none; border: none;" type="button" class="btn btn-danger"
                        id="delete_confirm">削 除
                </button>
                <button type="button" class="btn btn-default" style="box-shadow: none; border: none;" id="delete_close">
                    戻 る
                </button>
            </div>
        </div>
    </div> -->

    <div class="col-md-3 col-sm-10 col-xs-10 pull-right hide draggable_aria close_aria" id="select_document"
         style="position: fixed; right: 30px; bottom: 15px; padding: 4px;">

        <div class="panel panel-warning"
             style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            <div class="panel-body">
                <center><h4><i style="color: #f1c40f" class="fa fa-warning"></i>目次を選択して<br>ください。</h4>
                    <button id="close_select" class="btn btn-warning " style="box-shadow: none; border: none;">確認
                    </button>
                </center>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="col-lg-4 col-md-5 col-sm-4 col-xs-10 pull-right hide blanck_document_message" id="blanck_document_message"
     style="">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body" style="font-size: 20px;">
            <p>自動保存しますので保存操作は不要です。</p>
            <p>最初の１５文字が自動で目次（表題）になります。</p>
            <center><button id="close_blanck_document_btn" class="btn btn-warning btn-lg">確認</button></center>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="col-lg-4 col-md-4 col-sm-4  pull-right hide draggable_aria close_aria blank_document_pagination_alert"
     id="blank_document_pagination_error"
     style="position: fixed; right: 210px; bottom: 5px; padding: 4px;">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <p>あなたのドキュメントは空です</p>
            <p>何かお書きください</p>
            <button id="close_blank_document_pagination_error" class="btn btn-warning btn_keipro"
                    style="box-shadow: none; border: none;">確認
            </button>
        </div>
    </div>
</div>

<div class="col-lg-2 col-md-4 col-sm-4 col-xs-8 hide pull-right font_size_aria multiple_navi" id="font_size_aria"
     style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2); padding: 5px;">
    <div class="col-lg-12" style="padding: 0">
        <button type="button" style="margin-bottom: 10px; margin-right: 0;"
                class="btn btn-warning btn-lg pull-right" id="close_font_size_aria">戻る
        </button>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12" style="padding: 0;">
        <!-- <div class="col-md-12 font_size_table_parent">
        <div class="font_size_table_child"> -->
        <input type="hidden" id="change_font_size" value="16px" name="">
        <table class="table table-bordered" id="font-size-popup-table" style="margin: 0;">
            <tr>
                <td onclick="change_font_size('10.666667px', 8)" class="font_size" id="font_size_8">8</td>
                <td onclick="change_font_size('13.333333px', 10)" class="font_size" id="font_size_10">10</td>
                <td onclick="change_font_size('16px', 12)" class="font_size" id="font_size_12">12</td>
            </tr>
            <tr>
                <td onclick="change_font_size('18.666667px', 14)" class="font_size" id="font_size_14">14</td>
                <td onclick="change_font_size('21.333333px', 16)" class="font_size" id="font_size_16">16</td>
                <td onclick="change_font_size('24px', 18)" id="font_size_18" class="font_size">18</td>
            </tr>
            <tr>
                <td onclick="change_font_size('26.666667px', 20)" class="font_size" id="font_size_20">20</td>
                <td onclick="change_font_size('29.333333px', 22)" class="font_size" id="font_size_22">22</td>
                <td onclick="change_font_size('32px', 24)" class="font_size" id="font_size_24">24</td>
            </tr>
            <tr>
                <td onclick="change_font_size('34.666667px', 26)" class="font_size" id="font_size_26">26</td>
                <td onclick="change_font_size('37.333333px', 28)" class="font_size" id="font_size_28">28</td>
                <td onclick="change_font_size('40px', 30)" class="font_size" id="font_size_30">30</td>
            </tr>
            <tr>
                <td onclick="change_font_size('42.666667px', 32)" class="font_size" id="font_size_32">32</td>
                <td onclick="change_font_size('45.333333px', 34)" class="font_size" id="font_size_34">34</td>
                <td onclick="change_font_size('48px', 36)" class="font_size" id="font_size_36">36</td>
            </tr>
        </table>
        <!-- </div>
    </div> -->
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>


<div class="col-lg-2 col-md-4 col-sm-4 col-xs-8 pull-right hide shapes_area" id="shapes_area"
     style="position: fixed; right: 5px; bottom: 5px; padding: 4px; background-color: #FFFFFF; border-radius: 2px;">
    <div class="col-lg-12" style="padding: 0">
        <button type="button" style="margin-bottom: 10px; margin-right: 0;"
                class="btn btn-warning pull-right btn_keipro" id="close_shapes_area">戻る
        </button>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12" style="padding: 0;">

        <table class="table table-bordered" style="margin-bottom: 0;">
            <tr>
                <td style="background-color: #fff" class="checked">
                    <button class="btn btn-info btn_table" id="arrows_shape"><i class="fa fa-long-arrow-right"></i> 矢印
                    </button>
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff">
                    <button class="btn btn-info btn_table" id="diamond_shape">  <!-- 四角 -->　ひし形　◇</button>
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff">
                    <button class="btn btn-info btn_table" id="rect_shape"><i class="fa fa-square"></i> 四角</button>
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff">
                    <button class="btn btn-info btn_table" id="add_text"><!--四角-->　□ <i class="fa fa-pencil"></i>
                    </button>
                </td>
            </tr>
        </table>
        <!-- </div>
    </div>  -->
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>


<div class="col-lg-2 col-md-4 col-sm-4 col-xs-8 pull-right hide font_family_aria multiple_navi" id="font_family_aria" style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2); padding: 5px;">
    <div class="col-lg-12" style="padding: 0">
        <button type="button" style="margin-bottom: 10px; margin-right: 0;"
                class="btn btn-warning btn-lg pull-right" id="close_family_aria">戻る
        </button>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12" style="padding: 0;">
        <!-- <div class="font_family_aria_parent">
        <div class="font_family_aria_child"> -->
        <table class="table table-bordered" style="margin-bottom: 0;">
            <input type="hidden" id="change_font_family" value="ms mincho, ｍｓ 明朝" name="">
            <tr>
                <td id="font_1" onclick="change_font_family('ms mincho, ｍｓ 明朝')" class="checked">ＭＳ明朝</td>
            </tr>
            <tr>
                <td id="font_2" onclick="change_font_family('ms gothic, ｍｓ ゴシック')" class="">ＭＳ ゴシック</td>
            </tr>
            <tr>
                <td id="font_3" onclick="change_font_family('hg行書体,hgp行書体,cursive')" class="">HG 行書体</td>
            </tr>
            <tr>
                <td id="font_4" onclick="change_font_family('hg丸ｺﾞｼｯｸm-pro,hg正楷書体-pro,ms ui gothic')" class="">
                    HG丸ｺﾞｼｯｸM-PRO
                </td>
            </tr>
            <tr>
                <td id="font_5" onclick="change_font_family('hgp創英角ﾎﾟｯﾌﾟ体,hg創英角ﾎﾟｯﾌﾟ体')" class="">HGS創英角ﾎﾟｯﾌﾟ体</td>
            </tr>
        </table>
        <!-- </div>
    </div>  -->
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<!--<div class="col-lg-2 col-md-4 col-sm-4 col-xs-8 pull-right hide settlement_letter_aria" id="settlement_letter_aria"-->
<!--     style="position: fixed; right: 5px; bottom: 5px; padding: 4px; background-color: #FFFFFF; border-radius: 2px;">-->
<!--    <div class="col-lg-12" style="padding: 0">-->
<!--        <button type="button" style="margin-bottom: 10px; margin-right: 0;"-->
<!--                class="btn btn-warning pull-right btn_keipro" id="close_settlement_letter_aria">戻る-->
<!--        </button>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--    <div class="col-lg-12" style="padding: 0;">-->
<!--        <table class="table table-bordered" style="margin-bottom: 0;">-->
<!--            <tr>-->
<!--                <td><input type="checkbox" id="settlement_letter_choice1" name="settlement_letter_choice" value="purchase" onclick="showSettlementLetterForm(1)"> 物品購入 </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td><input type="checkbox" id="settlement_letter_choice2" name="settlement_letter_choice" value="expenses" onclick="showSettlementLetterForm(2)"> 交通費 </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td><input type="checkbox" id="settlement_letter_choice3" name="settlement_letter_choice" value="other" onclick="showSettlementLetterForm(3)"> その他 </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td><input type="checkbox" id="settlement_letter_choice3" name="settlement_letter_choice" value="other" onclick="showSettlementLetterForm(4)"> 履歴 </td>-->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</div>-->
<!--<div class="clearfix"></div>-->

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 pull-right word_function_aria multiple_navi hide" id="word_function_aria"
     style="">

    <div class="panel panel-info" style="margin-bottom: 2px; border: 2px solid #eee;">
        <div class="col-md-12" style="margin-top: 10px;">
            <button type="button" id="close_function_aria" class="btn btn-warning popup_button pull-right" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="戻る" data-placement="auto top" data-trigger="hover" id="close-app">戻る
            </button>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12 panel-body">            
            <button class="btn btn-info popup_button" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="絵・図" data-placement="auto top" data-trigger="hover" id="btn-shapes-design">絵・図</button>
            <button class="btn btn-info popup_button" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="表" data-placement="auto top" data-trigger="hover" id="btn-shapes-table">表</button>
            <button id="eeeee" onclick="word_special_cherecter()" class="btn btn-info popup_button" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="記号" data-placement="auto top" data-trigger="hover">記号
            </button>
            <button class="btn btn-info popup_button" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="移動" data-placement="auto left" data-trigger="hover" onclick="word_cut()" id="btn-note-cut">移 動</button>
            <button class="btn btn-info popup_button" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="複写" data-placement="auto top" data-trigger="hover" onclick="word_copy()" id="btn-note-copy">複 写</button>
            <!-- <button id="" type="button" class="btn btn-info" title="辞書">辞書</button> -->
            <button id="dddd" class="btn btn-info popup_button" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="文例" data-placement="auto top" data-trigger="hover">文例</button>
            <button class="btn btn-info popup_button" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="カラー" data-placement="auto top" data-trigger="hover" id="word_color">カラー </button>
            <button id="search_replace" class="btn btn-info popup_button" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="見出" data-placement="auto top" data-trigger="hover">見出</button>
            <!-- <button type="button" onclick="print_word()" id="print_word" class="btn btn-info popup_button" title="印刷">
                印刷
            </button> -->
            <button id="print_word" class="btn btn-info print_word popup_button" type="button"data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="印刷" data-placement="auto top" data-trigger="hover">印刷
            </button>
            <!-- <button type="button" id="print_word" class="btn btn-info popup_button" title="印刷">
                印刷
            </button> -->
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- Font Color Aria -->
<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 pull-right hide draggable_aria font_color_aria multiple_navi" id="font_color_aria" style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2); padding: 5px;">

    <div class="row" style="">
        <div class="col-sm-12">
            <button type="button" class="btn btn-warning btn-lg pull-right" id="close_font_color_aria" style="margin-bottom: 10px;">戻る</button>
            <div class="clearfix"></div> 
        </div>
            
        <div class="col-sm-12">
            <table class="table table-bordered">
                <input type="hidden" id="show_color_popup" name="show_color_popup" value="0">
                <input type="hidden" id="word_font_color" value="#000000" name="">
                <tr>
                    <td onclick="word_font_color('#000000')" style="background-color: #000000;"></td>
                    <td onclick="word_font_color('#FF0000');" style="background-color: #FF0000;"></td>
                    <td onclick="word_font_color('blue');" style="background-color: #0000FF;"></td>
                </tr>
                <tr>
                    <td onclick="word_font_color('#00FF00');" style="background-color: #00FF00;"></td>
                    <td onclick="word_font_color('#00CC99');" style="background-color: #00CC99;"></td>
                    <td onclick="word_font_color('#8B4513');" style="background-color: #8B4513;"></td>
                </tr>
            </table>
        </div>
           
        </div>
    </div>
</div>
<!-- Font Color Aria -->
<div class="col-md-4 col-sm-4 col-xs-12 pull-right hide draggable_aria close_aria font_cut_copy_aria" id="font_cut_copy_aria">

    <div class="panel panel-info" style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0;">
                <button onclick="return_close()" type="button" class="btn btn-lg btn-warning pull-right" id="close_copy_cut_aria">
                    戻る
                </button><br><br>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12" style="padding: 0;">
                <p style="font-size: 18px;">黄色く塗った部分を、別の場所に移動します。 <br> 移動部分の先頭にカーソルを置き、マウスの左クリックを押し続けて黄塗りします。
                    <br> 次に。右クリックを押し「切り取り」を選び、
                    移動先にカーソルを置き、右クリックで「貼り付け」ます。
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<!-- Font Color Aria -->
<div class="col-md-3 col-sm-3 pull-right draggable_aria close_aria ajax_loading_aria" id="ajax_loading_aria"
     style="position: fixed; right: 0px; bottom: 0px; padding: 4px; display: none;">

    <div class="panel panel-info" style="margin-bottom: 2px; border: 2px solid #eee;">
        <div class="panel-body" style="color: #000; font-weight: bold;">
            読み込んでいます... <img src="resource/img/ajax/ajax_load_4.gif">
        </div>
    </div>
</div>

<!-- Image Selection message -->
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 pull-right hide draggable_aria word_image_selection_message multiple_navi" id="word_image_selection_message" style="">

    <div class="panel panel-warning" style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0">
                <h5 class="pull-left" style="font-size: 20px;">何を挿入しますか？</h5> 
                <button style="margin-left: 2px;" id="close_word_image_selection"
                        class="btn btn-warning btn-lg pull-right">戻る
                </button>
                <br>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12" style="padding: 0">
                <center>
                    <br>

                    <form method="post" id="word_image_upload_form" enctype="multipart/form-data" action="#">
                        <input type="hidden" name="word_uploaded_file_name" id="word_uploaded_file_name" value="">
                        <input type="hidden" name="word_image_width" id="word_image_width" value="400">
                        <input type="file" name="word_imgupload" id="word_imgupload" style="display:none"/>
                        <button class="btn btn-success btn-lg" id="word_upload_image"
                                style="margin-left: 0; margin-right:20px !important; " title="写真・画像">写真・画像
                        </button>
                        <button class="btn btn-success btn-lg " id="startCapture" title="画像コピー">画像コピー</button>
                    </form>

                    
                </center>
                
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- Cursor Confermation -->

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 pull-right hide draggable_aria word_image_past_message multiple_navi" id="word_image_past_message" style="">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <p style="font-size: 18px;">
                どこに貼り付けますか？ <br> カーソルで指定し、位置を決めて下さい。
            </p>
            <center>
                <button class="btn btn-success btn-lg" id="word_cursor_ok" style="margin-right: 20px;" title="位置決定">位置決定</button>
                <button class="btn btn-warning btn-lg" id="word_cursor_colse" title="戻る"> 戻る</button>
            </center>
            
        </div>
    </div>
</div>
<!-- Image Past Confirmation -->

<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 pull-right hide draggable_aria word_image_past_confirmation multiple_navi" id="word_image_past_confirmation"style="">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <h5 style="font-size: 24px;">
                <center>この場所にしますか？</center> 
            </h5>
            <center>
                <button class="btn btn-success btn-lg" style="margin-right: 20px !important;" id="word_image_paste_ok" title="はい">はい</button>
                <button class="btn btn-warning btn-lg" id="word_image_paste_colse" title="いいえ">いいえ</button>
            </center>            
        </div>
    </div>
</div>

<!-- Image Zoom -->
<div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 hide draggable_aria word_image_zooming multiple_navi" id="word_image_zooming"
     style="">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0">
                <h4 class="text-center" style="font-size: 26px;">
                    サイズを選んで下さい。
                </h4>
                <!-- <button id="word_image_zooming_close" style="margin-left: 2px;" class="btn btn-warning btn-lg pull-right">戻る
                </button> -->
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                    <br>
                    <button style="margin-right: 20px;" class="btn btn-success btn-lg" id="word_image_zoom_btn" title="拡大"><i
                                class="fa fa-search-plus"></i> 拡大
                    </button>
                    <button style="margin-right: 20px;" class="btn btn-success btn-lg" id="word_image_small_btn" title="縮小"><i
                                class="fa fa-search-minus"></i> 縮小
                    </button>
                    <button style="" class="btn btn-success btn-lg" id="word_image_width_completed" title="完了">
                        <i class="fa fa-check"></i> 完了
                    </button>
                </center>
                
            </div>

        </div>
    </div>
</div>

<!-- Image Zoom -->
<div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 hide draggable_aria screen_image_zooming multiple_navi" id="screen_image_zooming"
     style="">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0">
                <h4 class="text-center" style="font-size: 26px;">
                    サイズを選んで下さい。
                </h4>
                <!-- <button id="word_image_zooming_close" style="margin-left: 2px;" class="btn btn-warning btn-lg pull-right">戻る
                </button> -->
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <center>
                    <br>
                    <button style="margin-right: 20px;" class="btn btn-success btn-lg" id="word_screen_image_zoom_btn" title="拡大"><i
                                class="fa fa-search-plus"></i> 拡大
                    </button>
                    <button style="margin-right: 20px;" class="btn btn-success btn-lg" id="word_screen_image_small_btn" title="縮小"><i
                                class="fa fa-search-minus"></i> 縮小
                    </button>
                    <button style="" class="btn btn-success btn-lg" id="word_screen_image_width_completed" title="完了">
                        <i class="fa fa-check"></i> 完了
                    </button>
                </center>
                
            </div>

        </div>
    </div>
</div>
<!-- Image Upload Completed -->
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 pull-right hide draggable_aria close_aria word_image_upload_completed multiple_navi"
     id="word_image_upload_completed" style="">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0">
                <center>
                    <p class="pull-left" style="font-size: 24px;">
                        貼り付けが完了しました。
                    </p>
                    <br>
                    <button id="word_image_upload_completed_close" style=""
                        class="btn btn-warning btn-lg" autofocus="true" title="確認">確認
                    </button>
                </center>
                
            </div>
        </div>
    </div>
</div>

<!-- Canvase Art Aria -->
<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 pull-right hide word_canvase_aria multiple_navi" id="word_canvase_aria">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0">
                <p class="pull-left" style="font-size: 18px;">
                    絵・図
                </p>
                
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- <button style="margin-left: 0" class="btn btn-info btn-sm" id="line-shape"> <i class="fa fa-minus"></i> ライン </button> -->
                    <button class="btn btn-info btn_table" id="line-shape-arrows"><i class="fa fa-long-arrow-right"></i>
                        矢印
                    </button>

                    <button class="btn btn-info btn_table" id="addText"><!--四角-->　□ <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-info btn_table" from_button="0" id="dimond-squere">  <!-- 四角 -->　ひし形　◇
                    </button>
                    <button class="btn btn-info btn_table" id="shape-rectangle"><i class="fa fa-square"></i>
                        四角
                    </button>
                    <button class="btn btn-danger btn_table" id="delete-shapes"><i class="fa fa-trash"
                                                                                   style="margin-left: 0"></i></button>
                    <!--                    <button class="btn btn_table pink lighten-5" id="shape-table">表</button>-->

                    <button class="btn btn-success btn_table" from_button="0" id="shapesSaveClose"><i
                                class="fa fa-floppy-o"></i> 完了
                    </button>
                    <button id="word_shape_aria_close" style="margin-left: 2px;"
                        class="btn btn-warning btn_table">戻る
                    </button>
                    <!-- <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        絵・図 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#" id="addTriangle">三角（△）</a></li>
                        <li><a href="#" id="addRectangle"> 四角（□）</a></li>
                    </ul>

                    <button class="btn btn-warning btn-sm pull-right" id="shapesSaveClose"><i class="fa fa-floppy-o"></i> 保存</button>
                </div> -->
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-9 col-md-9 col-sm-12 pull-left word_canvas_container" style="padding-left: 0px;">
                        <canvas class="word_canvas" width="750" height="500" id="WordCanvas" style="border:1px solid #ddd;">
                        </canvas>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-right" style="padding-left: 0;">
                        <div class="form-group">
                            <label style="color: black; font-size: 16px;" class="col-md-7 label"
                                   for="text_color_picker">テキスト色、</label>
                            <div class="col-md-4" style="padding: 0;">
                                <input type="text" img_id="text" id="text_color_picker" size="10" value="#ffffff"/>
                            </div>
                            <div class="col-md-1" style="padding: 0;">
                                <img src="resource/img/close.png" img_id="text" id="close_color_picker"
                                     style="display:none; cursor: pointer; width:30px; height:30px; vertical-align: middle;">

                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color: black; font-size: 16px;" class="col-md-7 label"
                                   for="back_color_picker">
                                背景色 </label>
                            <div class="col-md-4" style="padding: 0; margin-bottom: 10px;">
                                <input type="text" img_id="back" value="#ffffff" id="back_color_picker" size="10">
                            </div>
                            <div class="col-md-1" style="padding: 0; margin-bottom: 10px;">
                                <img src="resource/img/close.png" img_id="back" id="close_back_color_picker"
                                     style="display:none; cursor: pointer; width:30px; height:30px; vertical-align: middle;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color: black; font-size: 16px;" class="col-md-7 label"
                                   for="shape_bg_color_picker">
                                図 背景色 </label>
                            <div class="col-md-4" style="padding: 0; margin-bottom: 10px;">
                                <input type="text" img_id="shape_back" value="#ffffff" id="shape_bg_color_picker"
                                       size="10">
                            </div>
                            <div class="col-md-1" style="padding: 0; margin-bottom: 10px;">
                                <img src="resource/img/close.png" img_id="shape_back" id="close_shape_back_color_picker"
                                     style="display:none; cursor: pointer; width:30px; height:30px; vertical-align: middle;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color: black; font-size: 16px;" class="col-md-7 label"
                                   for="shape_line_color_picker">
                                アウトライン 色 </label>
                            <div class="col-md-4" style="padding: 0; margin-bottom: 10px;">
                                <input type="text" img_id="shape_line_back" value="#ffffff" id="shape_line_color_picker"
                                       size="10">
                            </div>
                            <div class="col-md-1" style="padding: 0; margin-bottom: 10px;">
                                <img src="resource/img/close.png" img_id="shape_line_back"
                                     id="close_shape_line_back_color_picker"
                                     style="display:none; cursor: pointer; width:30px; height:30px; vertical-align: middle;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="color: black; font-size: 16px;" class="col-md-7 label" for="text_font_size">
                                サイズ
                            </label>
                            <div class="col-md-5" style="padding: 0; margin-bottom: 10px;">
                                <select id="text_font_size" name="font-control">
                                    <option value="8" selected="selected">8</option>
                                    <option value="10">10</option>
                                    <option value="12">12</option>
                                    <option value="14">14</option>
                                    <option value="16">16</option>
                                    <option value="18">18</option>
                                    <option value="20">20</option>
                                    <option value="22">22</option>
                                    <option value="24">24</option>
                                    <option value="26">26</option>
                                    <option value="28">28</option>
                                    <option value="30">30</option>
                                    <option value="32">32</option>
                                    <option value="34">34</option>
                                    <option value="36">36</option>
                                </select>

                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>


            </div>

        </div>
    </div>
</div>


<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pull-right hide" id="print_aria"
     style="position: fixed; right: 5px; bottom: 5px; overflow-y: scroll; height:100%; border: 0;">
    <div style="background-color: #fff; width: 100%; padding:10px; margin:0; min-height:1110px;">
        <p>
        <h3 style="text-align: center;">印刷プレビュー</h3></p>
        <p>
            <button class="btn btn-info print_word" title="印刷" type="button"
                    onClick="javascript: print_word();">印刷
            </button>
            <button title="戻る" aria-label="Close" class="btn btn-warning pull-right" type="button"
                    onClick="javascript: setTimeout(function () {$('#print_aria').removeClass('show').addClass('hide');}, 10);">
                戻る
            </button>
        </p>

        <div style="margin-left: 110px;">
                <textarea class="form-control" id="print_content" name="print_content">
            </textarea>
        </div>

    </div>
</div>


<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 pull-right hide word_canvase_aria1" id="word_canvase_aria1">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0">
                <p class="pull-left" style="font-size: 18px;">
                    絵・図
                </p>
                <button id="word_shape_aria_close1" style="margin-left: 2px;"
                        class="btn btn-warning pull-right btn_table">戻る
                </button>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- <button style="margin-left: 0" class="btn btn-info btn-sm" id="line-shape"> <i class="fa fa-minus"></i> ライン </button> -->
                    <button class="btn btn-info btn_table" id="line-shape-arrows"><i class="fa fa-long-arrow-right"></i>
                        矢印
                    </button>

                    <button class="btn btn-info btn_table" id="addText"><!--四角-->　□ <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-info btn_table" from_button="1" id="dimond-squere1">  <!-- 四角 -->　ひし形　◇
                    </button>
                    <button class="btn btn-info btn_table" id="shape-rectangle"><i class="fa fa-square"></i>
                        四角
                    </button>
                    <button class="btn btn-danger btn_table" id="delete-shapes"><i class="fa fa-trash"
                                                                                   style="margin-left: 0"></i></button>

                    <button class="btn btn-warning btn_table" from_button="1" id="shapesSaveClose1"><i
                                class="fa fa-floppy-o"></i> 保存
                    </button>

                    <!-- <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        絵・図 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#" id="addTriangle">三角（△）</a></li>
                        <li><a href="#" id="addRectangle"> 四角（□）</a></li>
                    </ul>

                    <button class="btn btn-warning btn-sm pull-right" id="shapesSaveClose"><i class="fa fa-floppy-o"></i> 保存</button>
                </div> -->
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-9 col-md-9 col-sm-12 pull-left word_canvas_container" style="padding-left: 0px;">
                        <canvas class="word_canvas" id="WordCanvas1" width="750" height="500" style="border:1px solid #ddd;">
                        </canvas>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-right" style="padding: 0;">
                        <div class="form-group">
                            <label style="color: black; font-size: 16px;" class="col-md-7 label" for="text_color_piker">テキスト色、</label>
                            <div class="col-md-5" style="padding: 0;">
                                <input id="text_color_piker" name="text_color_piker" type="text" placeholder="#000000"
                                       class="form-control input-sm">

                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color: black; font-size: 16px;" class="col-md-7 label" for="text_color_piker">
                                背景色 </label>
                            <div class="col-md-5" style="padding: 0; margin-bottom: 10px;">
                                <input id="back_color_piker" name="back_color_piker" type="text" placeholder="#000000"
                                       class="form-control input-sm">

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right hide draggable_aria restore_confirm_alirt" id="restore_confirm_alirt" style="">

    <div class="panel panel-warning"
             style="margin-bottom: 2px; border: solid 2px #e74c3c; border-top: solid 7px #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body" style="font-size: 20px;">
            <p>回復する文章</p>
            <p style="font-size: 20px !important; font-weight: bold  !important; color: blue;">： <span id="restore_title"></span></p>            
            <p><center style="font-size: 24px !important; color: red;">　回復しますか？</center></p>
            <center>
                <button style="margin-left: 0; box-shadow: none; border: none;" type="button" class="btn btn-danger btn-lg"
                        id="restore_confirm">回復
                </button>
                <button type="button" class="btn btn-warning btn-lg" style="box-shadow: none; border: none;" id="restore_delete_close">
                    戻る
                </button>
            </center>                
        </div>
    </div>
</div>

<div class="col-md-3 col-sm-10 col-xs-10 pull-right hide draggable_aria close_aria restore_select_document " id="restore_select_document" style="">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <center><h4><i style="color: #f1c40f" class="fa fa-warning"></i>目次を選択してください。</h4>
                <button id="close_select" class="btn btn-warning " style="box-shadow: none; border: none;">確認
                </button>
            </center>
        </div>
    </div>
</div>

<div class="col-md-3 col-sm-10 col-xs-10 pull-right hide draggable_aria close_aria restore_select_document" id="deleted_file_restored" style="">
    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body" style="font-size: 20px;">
            <h4>「 <span id="restored_title"></span> 」<br>&nbsp &nbsp を回復しました。</h4>
            <center>
                <h5 style="color: blue;">目次に移動しました。</h5>
                <button id="close_select" class="btn btn-warning btn-lg got_to_table_of_content">確認
                </button>
            </center>
        </div>
    </div>
</div>
<div class="col-md-3 col-sm-10 col-xs-10 pull-right hide draggable_aria close_aria restore_select_document" id="deleted_file_deleted" style="">
    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body" style="font-size: 20px;">
            <h4>「 <span id="deleted_file_title"></span> 」<br>&nbsp &nbsp を削除しました。</h4>
            <center>
                <h5 style="color: blue;">ゴミ箱に移動しました。</h5>
                <button id="close_select" class="btn btn-warning btn-lg">確認
                </button>
            </center>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right hide draggable_aria resp restore_select_document" id="permanent_delete_confirm_alirt"
         style="">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #e74c3c; border-top: solid 7px #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body" style="font-size: 20px;">
            <p style="color: black;" >削除する文章</p>
            <p>: <span id="permanent_delete_title" style="font-weight: bold  !important; font-size: 20px !important; color: blue;"></span></p>
            <p><center style="font-size: 24px !important; color: red;">削除しますか？</center></p>
            <center>
                <button style="margin-left: 0; box-shadow: none; border: none;" type="button" class="btn btn-danger btn-lg" id="permanent_delete_confirm">削除
                </button>
                <button type="button" class="btn btn-warning btn-lg" style="box-shadow: none; border: none;" id="permanent_delete_close">
                    戻る
                </button>
            </center>                
        </div>
    </div>
</div>
<div class="col-md-3 col-sm-10 col-xs-10 pull-right hide draggable_aria close_aria restore_select_document" id="permanent_file_deleted" style="">
    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body" style="font-size: 20px;">
            <h4>「 <span id="permanent_file_title"></span> 」<br>&nbsp &nbsp を削除しました。</h4>
            <center>
                <!-- <h5 style="color: blue;">ゴミ箱に移動しました。</h5> -->
                <button id="close_select" class="btn btn-warning btn-lg">確認
                </button>
            </center>
        </div>
    </div>
</div>
<div class="pull-right draggable_aria hide ajax_loading_aria" id="ajax_loading_aria"
     style="">

    <div class="panel panel-info" style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body" style="color: #000; font-weight: bold;">
            <h3>読み込んでいます... </h3>
            <img src="resource/img/ajax/ajax_load_8.gif">
        </div>
    </div>
</div>
<div class="pull-right draggable_aria hide resp" id="word_image_upload_error"
     style="position: fixed; right: 10px; bottom: 0px; padding: 4px;">

    <div class="panel panel-info" style="margin-bottom: 2px; border: solid 2px red; border-top: solid 7px red; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body" style="color: #000; font-weight: bold;">
            <h3 id="word_image_upload_error_message"></h3>
            <center>
                <button id="return_image_upload_for_error" class="btn btn-warning btn-lg">戻る</button>
            </center>
        </div>
    </div>
</div>

<?php
//$this->load->view('components/email_modal');
?>
<?php
//$this->load->view('components/email_main_modal');
?>
<?php
//        $this->load->view('components/partner_registration');
?>
<?php
//        $this->load->view('components/introducer_registration');
?>
<?php
$this->load->view("components/account_setting_modal")
?>
<?php
$this->load->view('components/income_modal')
?>
<script src="<?php echo base_url('resource/js/jquery-confirm.min.js'); ?>"></script>
<script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="<?php echo base_url('resource/js/profit_loss.js'); ?>"></script>

<!--<script src="--><?php //echo base_url('resource/js/jquery-ui.min.js'); ?><!--"></script>-->
<!-- Art Shapes -->
<script src="<?php echo base_url('resource/js/shapes/fabric.min.js'); ?>"></script>
<!--<script src="--><?php //echo base_url('resource/js/shapes/fabric.js'); ?><!--"></script>-->
<!-- <script src="<?php // echo base_url('resource/js/shapes/shapes.js'); ?>"></script> -->
<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/shapes/shapes.js?id=<?php echo rand(0,10000)?>"></script>
<!-- Art Shapes -->
<!-- Color Picker -->
<link rel="stylesheet" media="screen" type="text/css" href="resource/color_picker/css/colorPicker.css"/>
<script type="text/javascript" src="resource/color_picker/js/jquery.colorPicker.js"></script>
<!-- color picker -->
<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/custom.js?id=<?php echo rand(0,10000)?>"></script>


</body>

</html>
<script type="text/javascript">
     
    jQuery(document).ready(function ($) {
       
        // jQuery("#back_color_picker,#text_color_picker,#shape_bg_color_picker,#shape_line_color_picker").hexColorPicker({
        //     "pickerWidth": 110,
        //     "size": 5
        // });

        jQuery("#text_color_picker,#back_color_picker,#shape_bg_color_picker,#shape_line_color_picker").click(function (event) {
            var img_id = $(this).attr('img_id');
//            alert(img_id);
            if (img_id == 'text') {
                $('#close_color_picker').show();
                $('#close_back_color_picker').hide();
                $('#close_shape_back_color_picker').hide();
                $('#close_shape_line_back_color_picker').hide();
            }

            if (img_id == 'back') {
                $('#close_back_color_picker').show();
                $('#close_color_picker').hide();
                $('#close_shape_back_color_picker').hide();
                $('#close_shape_line_back_color_picker').hide();
            }
            if (img_id == 'shape_back') {
                $('#close_shape_back_color_picker').show();
                $('#close_back_color_picker').hide();
                $('#close_color_picker').hide();
                $('#close_shape_line_back_color_picker').hide();
            }
            if (img_id == 'shape_line_back') {
                $('#close_shape_line_back_color_picker').show();
                $('#close_shape_back_color_picker').hide();
                $('#close_back_color_picker').hide();
                $('#close_color_picker').hide();
            }

        });
        jQuery("#close_color_picker,#close_back_color_picker,#close_shape_back_color_picker,#close_shape_line_back_color_picker").click(function (event) {
            var img_id = $(this).attr('img_id');
            if (img_id == 'text') {
                $('#close_color_picker').hide();
                $('.hex-color-picker-wrapper').hide();
            }
            if (img_id == 'back') {
                $('#close_back_color_picker').hide();
                $('.hex-color-picker-wrapper').hide();
            }
            if (img_id == 'shape_back') {
                $('#close_shape_back_color_picker').hide();
                $('.hex-color-picker-wrapper').hide();
            }
            if (img_id == 'shape_line_back') {
                $('#close_shape_line_back_color_picker').hide();
                $('.hex-color-picker-wrapper').hide();
            }

        });
    })

    function close_color_picker() {

        $('#close_color_picker').hide();
        $('#close_back_color_picker').hide();
        $('#close_shape_back_color_picker').hide();
        $('#close_shape_line_back_color_picker').hide();
    }

    $(".word_canvas").css({
        width: '750',
        height: '500'
    });
    function hideTooltip(btn_id) {
        // alert("Hide");
        setTimeout(function () {
            // alert("Hided");
            $('#'+btn_id).popover('hide');
            // $('#'+btn_id).trigger('click');
        }, 1500);
    }
    
    
    // $('[data-toggle="popover"]').popover({container: 'body'});
    if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('.btn').click(function(event) {
            $('[data-toggle="popover"]').popover('destroy');
        });
        $( ".btn" ).bind( "taphold", tapholdHandler );

        function tapholdHandler( event ){
            var btn_id = $(this).attr('id');
            $('#'+btn_id).popover('show');
            hideTooltip(btn_id);
        }

        $("#doc_content").bind( "taphold", editorTapholdHandler );
    
        function editorTapholdHandler( event ){
            $(".btn_keipro").removeAttr("disabled");
            $(".close_aria, .font_color_aria, #word_function_aria, #word_image_selection_message, #font_size_aria, .font_family_aria").addClass('hide').removeClass('show');
            $("#table_of_contantes").addClass('hide').removeClass('show');
        }

    $(".btn_keipro").attr('data-placement', 'auto bottom');
    

    
    }else{
        $('[data-toggle="popover"]').popover({container: 'body'});
    }
    $.mobile.loader.prototype.options.text = "";

    


    
</script>