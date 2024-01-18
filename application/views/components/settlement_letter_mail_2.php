<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//date_default_timezone_set('Asia/Tokyo');
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="<?php echo base_url(); ?>"/>
<script src="<?php echo base_url('resource/js/jquery.min.js'); ?>"></script>
<!--<script src="--><?php //echo base_url('webcamjs/webcam.min.js');  ?><!--"></script>-->
<!--<script src="--><?php //echo base_url('webcamjs/webcam.js');  ?><!--"></script>-->
<link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/css/font-awesome.min.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/dist/css/bootstrap.min.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/css/settelment_letter_mail.css'); ?>"/>
<script src="<?php echo base_url('resource/dist/js/bootstrap.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('resource/css/croppie.min.css'); ?>">
<script src="<?php echo base_url('resource/js/croppie.js'); ?>"></script>

<?php
if (isset($settlement_id)) {
    if ($president_seal_id != 0) {
        $decision_document_disable = 'pointer-events:none';
        $done_settlement_button = 'pointer-events:none';
        $delete_documents_button = 'pointer-events:none';
        $approval_seal_message_div = 'display:block';
    } else {
        $decision_document_disable = '';
        $done_settlement_button = '';
        $delete_documents_button = '';
        $approval_seal_message_div = 'display:none';
    }
} else {
    $decision_document_disable = 'pointer-events:none';
    $done_settlement_button = '';
    $delete_documents_button = '';
    $approval_seal_message_div = 'display:none';
}
if ($seal_image_exist) {
    $user_has_no_seal_message_div = 'display:none';
}else{
    $user_has_no_seal_message_div = 'display:block';
}
?>

<style type="text/css">
    *[unselectable=on] {
        -moz-user-select: -moz-none;
        -khtml-user-select: none;
        -webkit-user-select: none;

        /*
          Introduced in IE 10.
          See http://ie.microsoft.com/testdrive/HTML5/msUserSelect/
        */
        -ms-user-select: none;
        user-select: none;
    }

    .share_mail > tbody > tr.active > td {
        background-color: yellow;
    }

    .share_mail > tbody > tr.danger > td {
        background-color: yellow;
    }

    .border_red {
        padding:20px 0px;border-radius: 5px; border: 2px solid red;
    }
    .border_white {
        padding:20px 0px;border-radius: 5px; border: 2px solid white;
    }
    /*.unseen {*/
    /*font-weight: bold;*/
    /*}*/
    /*.seen {*/
    /*font-weight: normal;*/
    /*}*/

    .table_style {
        border-collapse: separate;
        border: solid black 3px;
        border-radius: 12px;
        -moz-border-radius: 12px;
        -webkit-border-radius: 12px;
    }

    .table_style1 {
        border-collapse: separate;
        border: solid black 3px;
        border-radius: 12px;
        -moz-border-radius: 12px;
        -webkit-border-radius: 12px;
    }

    /*.td_style {*/
    /*border-left:solid black 1px;*/
    /*border-top:solid black 1px;*/
    /*}*/
    hr {
        border-top: 1px solid #000;
        padding: 0;
        margin: 0;
    }

    /* style for table input box */
    .input_style1 {
        width: 88%;
        padding: 0 0 20px 4px;
        margin-left: 5px;
        display: block;
        border: none;
        /*-ms-word-break: break-all; word-break: break-all;word-break: break-word;*/
        font-family: ms mincho, ｍｓ 明朝;
        font-size: 18.666667px;
        ime-mode: active;
        /*overflow-wrap: break-word;*/

    }

    #settlement_title {
        outline-style: solid;
        outline-color: #27040e;
    }

    /* style for input box */
    .input_style2 {
        width: 72%;
        padding: 0 0 7px 4px;
        /*display:block;*/
        border: none;
        /*-ms-word-break: break-all; word-break: break-all;word-break: break-word;*/
        font-family: ms mincho, ｍｓ 明朝;
        font-size: 18.666667px;
        ime-mode: active;
        margin-left: 0px;
        /*overflow-wrap: break-word;*/

    }

    /* style for textarea */
    .input_style {
        width: 98%;
        height: 150px;
        /*max-height: 150px;*/
        display: block;
        margin-top: 7px;
        /*padding: 0 0 75px 4px;*/
        border: none;
        -ms-word-break: break-all;
        word-break: break-all;
        word-break: break-word;
        font-family: ms mincho, ｍｓ 明朝;
        font-size: 18.666667px;
        ime-mode: active;
        margin-left: 7px;
        vertical-align: top;
        overflow: hidden;
        /*overflow-wrap: break-word;*/

    }

    .required {
        border: 1px solid red;
        ime-mode: disabled;
    }

    .required_input {
        border: 2px solid red;
    }

    .pass_style {
        border: 2px solid #446590;
        ime-mode: disabled;
    }

    .btn-primary {
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
    }

    .btn-warning {
        color: #fff;
        background-color: #f0ad4e;
        border-color: #eea236;
    }

    .btn-danger {
        color: #fff;
        background-color: #d9534f;
        border-color: #b92c28;
    }

    .btn-yellow {
        color: #000;
        background-color: #FBFB96;
        border-color: #46658C;
    }

    .btn-light_green {
        color: #000;
        background-color: #92D050;
        border-color: #46658C;
    }

    .btn-light_blue {
        color: #000;
        background-color: #B7DEE8;
        border-color: #46658C;
    }

    .btn-success {
        color: #fff;
        background-color: #419641;
        border-color: #3e8f3e;
        margin-left: 7px;
        font-size: 16px;
    }
    .btn-default {
        color: #000;
        background-color: #EFEFEF;
        border-color: #EFEFEF;
        /*margin-left: 7px;*/
    }

    .btn-upload {
        /*display: inline-block;*/
        padding: 5px 12px 8px 12px;
        margin-bottom: 4px;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 18.6667px;
        font-weight: 400;
        font-family: ms mincho, ｍｓ 明朝;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    @media print {
        #done_settlement, #close_settlement_letter_form, #close_settlement_letter_aria, #delete_documents, #settlement_letter_aria, #close_settlement_letter_form_section, #done_configuration_seal_image_insert_message1, #seal_image_password_form, #click_here_text, #enter_settlement_title_message, #font_color_area {
            display: none;
            visibility: hidden;
        }

        a[href]:after {
            content: none !important;
        }
    }

    textarea:-ms-input-placeholder {
        color: darkgray; /*lightgray*/
    }

    input:-ms-input-placeholder {
        color: darkgray; /*lightgray*/
    }

    #conclusion[placeholder]:empty:before {
        content: attr(placeholder);
        color: darkgray;
    }

    #conclusion[placeholder]:empty:focus:before {
        content: "";
    }

    #case_study[placeholder]:empty:before {
        content: attr(placeholder);
        color: darkgray;
    }

    #case_study[placeholder]:empty:focus:before {
        content: "";
    }

    #others[placeholder]:empty:before {
        content: attr(placeholder);
        color: darkgray;
    }

    #others[placeholder]:empty:focus:before {
        content: "";
    }

    #reason[placeholder]:empty:before {
        content: attr(placeholder);
        color: darkgray;
    }

    #reason[placeholder]:empty:focus:before {
        content: "";
    }

    .enable_to_multi_share1 {
        background-color: yellow;
    }

    #partnerr_row {
        cursor: pointer;
    }

    .decision_document_disable {
        pointer-events: none;
    }

    .croppie-container {
        width: 100%;
        height: 85%;
    }
    .checked {
        background-color: #DDDDDF;
    }
    .checked_list {
        background-color: #ffff00;
    }
    .seal_iamge_brightness{
        filter: grayscale(0%) blur(0px) brightness(180%) contrast(100%) hue-rotate(0deg) opacity(100%) invert(0%) saturate(100%) sepia(0%);
    }

    .canvas_width_height {
        width: 320px;
        height: 240px;
    }
    .canvas_width_height_mobile {
        width: 180px;
        height: 220px;
    }
    .camera-text{
        font-size: 16px;
    }

    @media only screen and (max-width: 400px) {


        .cr-boundary{
            width: 160px !important;
            height: 160px !important;
        }

        .croppie-container {
            width: 100%;
            height: 66%;
        }

        .incorrect_password_message_sp{
            width: 85% !important;
            right: 6% !important;
            bottom: 47% !important;
        }

        .crop_seal_image_popup_res {
            width: 80% !important;
            height: 265px !important;
            right: 8% !important;
            bottom: 52% !important;
            padding: 0px !important;
            z-index: 9999 !important;
        }
        .canvas_width_height {
            width: 180px !important;
            height: 220px !important;
        }
        .image_insert_message {
            right: 32px !important;
            width: 92% !important;
            bottom: 50% !important;
            z-index: 9999 !important;

        }

        .password_form_notification {
            width: 80% !important;
            top: 18% !important;
            right: 4% !important;
            height: 160px !important;
            font-size: 10px;
            padding: 4px !important;
        }

        .font_color_area{
            width: 85% !important;
            height: 256px !important;
            right: 5% !important;

        }

        .settlement_letter_aria1_options tr td {
            font-size: 20px !important;

        }

        .enter_settlement_title {
            right: 10% !important;
            bottom: 42% !important;
            width: 85% !important;
        }

        .panel-body{
            padding: 4px !important;
        }

        .close_settlement_letter_form_btn{
            margin-top: 12px;
        }

        .input_style2{
            width: 80% !important;
            font-size: 16px;
        }

        .camera-text{
            font-size: 12px !important;
        }


        .camera-text-confirm{
            margin-left: 0 !important;
        }

        .password_confirmation_popup{
            right: 50px !important;
            width: 70% !important;
            height: 20% !important;
            z-index: 9999 !important;
        }

        .seal_image_change_password_popup{
            width: 90% !important;
            height: 180px;
            height: 31% !important;
            right: 20px !important;
            bottom: 15px !important;
            z-index: 9999;
        }


        #show_configuration_seal_image_form{
            margin-left:100px !important;
        }


        .seal_image_confirmation_message{
            width: 90% !important;
            height: 130px !important;
            right: 4% !important;
            bottom: 3% !important;
            z-index: 9999 !important;
            padding: 10px 0px 0px !important;
        }

        .seal_password_form_step_2{
            width: 90% !important;
            right: 14px !important;
            bottom: 5% !important;
            z-index: 9999;
        }

        .password_exist_message_notif{
            right: 15% !important;
            bottom: 35% !important;
            width: 80% !important;
            z-index: 99999;
        }

        .password_exist_message_notif .btn{
            margin-left: 115px !important;
        }
    }

    /* ----------- Android SmartPhone !!!!----------- */

    /* Portrait and Landscape */
    @media screen
    and (device-width: 360px)
    and (device-height: 640px)
    and (-webkit-device-pixel-ratio: 4) {

    }

    /* Portrait */
    @media screen
    and (device-width: 360px)
    and (device-height: 640px)
    and (-webkit-device-pixel-ratio: 4)
    and (orientation: portrait) {

        .croppie-container {
            width: 100%;
            height: 66%;
        }

        .incorrect_password_message_sp{
            width: 85% !important;
            right: 6% !important;
            bottom: 48% !important;
        }

        .crop_seal_image_popup_res {
            width: 80% !important;
            height: 265px !important;
            right: 8% !important;
            bottom: 52% !important;
            padding: 0px !important;
            z-index: 9999 !important;
        }

        .incorrect_password_message_sp{
            width: 85% !important;
            right: 6% !important;
            bottom: 47% !important;
        }

        .image_insert_message {
            width: 92% !important;
            bottom: 50% !important;
            z-index: 9999 !important;
        }

        .password_form_notification {
            width: 80% !important;
            bottom: 40% !important;
            right: 4% !important;
            height: 160px !important;
            font-size: 10px;
        }

        .font_color_area{
            width: 85% !important;
            height: 256px !important;
            right: 5% !important;

        }

        .settlement_letter_aria1_options tr td {
            font-size: 20px !important;

        }

        .enter_settlement_title {
            right: 10% !important;
            bottom: 42% !important;
            width: 85% !important;
        }

        .panel-body{
            padding: 4px !important;
        }

        .input_style2{
            width: 80% !important;
            font-size: 16px;
        }
        .close_settlement_letter_form_btn{
            margin-top: 12px;
        }

        .camera-text{
            font-size: 12px !important;
        }

        .camera-text-confirm{
            margin-left: 0 !important;
        }

        .password_confirmation_popup{
            right: 50px !important;
            width: 70% !important;
            height: 20% !important;
            z-index: 9999 !important;
        }

        .seal_image_change_password_popup{
            width: 90% !important;
            height: 180px;
            height: 31% !important;
            right: 20px !important;
            bottom: 15px !important;
            z-index: 9999;
        }

        #show_configuration_seal_image_form{
            margin-left:100px !important;
        }


    }


    /* =========----------- Android SmartPhone !!!!-----------============== */

    /* Portrait and Landscape */
    @media screen
    and (device-width: 360px)
    and (device-height: 640px)
    and (-webkit-device-pixel-ratio: 4) {

    }

    /* Portrait */
    @media screen
    and (device-width: 360px)
    and (device-height: 640px)
    and (orientation: portrait) {

        .croppie-container {
            width: 100%;
            height: 66%;
        }

        .incorrect_password_message_sp{
            width: 85% !important;
            right: 6% !important;
            bottom: 48% !important;
        }

        .crop_seal_image_popup_res {
            width: 80% !important;
            height: 265px !important;
            right: 8% !important;
            bottom: 52% !important;
            padding: 0px !important;
            z-index: 9999 !important;

        }

        .image_insert_message {
            width: 92% !important;
            bottom: 50% !important;
            z-index: 9999 !important;
        }

        .password_form_notification {
            width: 80% !important;
            bottom: 40% !important;
            right: 4% !important;
            height: 160px !important;
            font-size: 10px;
        }

        .font_color_area{
            width: 85% !important;
            height: 256px !important;
            right: 5% !important;

        }

        .settlement_letter_aria1_options tr td {
            font-size: 20px !important;

        }

        .enter_settlement_title{
            right: 10% !important;
            bottom: 42% !important;
            width: 85% !important;

        }

        .panel-body{
            padding: 4px !important;
        }

        .input_style2{
            width: 80% !important;
            font-size: 16px;
        }
        .close_settlement_letter_form_btn{
            margin-top: 12px;
        }

        .camera-text{
            font-size: 12px !important;
        }

        .camera-text-confirm{
            margin-left: 0 !important;
        }

        .password_confirmation_popup{
            right: 50px !important;
            width: 70% !important;
            height: 20% !important;
            z-index: 9999 !important;
        }

        .seal_image_change_password_popup{
            width: 90% !important;
            height: 180px;
            height: 31% !important;
            right: 20px !important;
            bottom: 15px !important;
            z-index: 9999;
        }

        #show_configuration_seal_image_form{
            margin-left:100px !important;
        }



        /* =========----------- IPhone 6,7,8!!!!-----------============== */
        @media only screen
        and (min-device-width : 375px)
        and (max-device-width : 667px) {



        }


    }

</style>

<script>
    var base_url = $("#base_url").val();
    jQuery(document).ready(function ($) {

        if (/Android|iPhone|BlackBerry|BB|IEMobile|Windows Phone/i.test(navigator.userAgent)) {
//            $("#canvas").removeClass('canvas_width_height').addClass('canvas_width_height_mobile');
            $("#canvas").attr("width", "180");
            $("#canvas").attr("height", "220");
        }else{
//            $("#canvas").removeClass('canvas_width_height_mobile').addClass('canvas_width_height');
            $("#canvas").attr("width", "320");
            $("#canvas").attr("height", "240");
        }


        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
            $('#deployment_name,#name_printing,#settlement_title,#conclusion,#others,#reason,#case_study,#seal_image_password,#approval_list_view_password,#seal_image_new_password,#yes').focus(function () {
                $('#settlement_letter_aria').hide();
            });
            $('#deployment_name,#name_printing,#settlement_title,#conclusion,#others,#reason,#case_study,#seal_image_password,#approval_list_view_password,#seal_image_new_password,#yes').focusout(function () {
                $('#settlement_letter_aria').show();
            });
        }else{

        }

        $("#settlement_title").focus();

        var settlement_mail_screen = $("#settlement_mail_screen").val();
        if (settlement_mail_screen == 1) {
            setTimeout(function () {
                $("#settlement_letter_choice4").trigger('click');
//                $("#settlement_letter_choice6").trigger('click');
            }, 100);

        }
        var president_seal_id = $("#president_seal_id").val();
        var on_hold = $("#on_hold").val();

        if(on_hold==1){
            $('.tblleft_under1,.tblleft_under,#share_settlement_form').css({
                'pointer-events': 'none'
            });
            document.getElementById('conclusion').contentEditable = false;
            document.getElementById('reason').contentEditable = false;
            document.getElementById('case_study').contentEditable = false;
            document.getElementById('others').contentEditable = false;
            $('#deployment_name').attr('readonly', true);
            $('#name_printing').attr('readonly', true);
            $('#settlement_title').attr('readonly', true);
            $('#conclusion').attr('readonly', true);
            $('#reason').attr('readonly', true);
            $('#case_study').attr('readonly', true);
            $('#others').attr('readonly', true);
            $('#file_name').attr('readonly', true);
            $('#delete_documents').addClass('decision_document_disable');
            $(".btn-upload").addClass('decision_document_disable');
            $("#hold_style_settlement").show();
//            return false;
        }
        if(president_seal_id!=0){
            document.getElementById('conclusion').contentEditable = false;
            document.getElementById('reason').contentEditable = false;
            document.getElementById('case_study').contentEditable = false;
            document.getElementById('others').contentEditable = false;
            $("#approval_seal_message_div").show();
//            return false;
        }

        if (navigator.userAgent.match(/Android/i)
            || navigator.userAgent.match(/webOS/i)
            || navigator.userAgent.match(/iPhone/i)
            || navigator.userAgent.match(/iPad/i)
            || navigator.userAgent.match(/iPod/i)
            || navigator.userAgent.match(/BlackBerry/i)
            || navigator.userAgent.match(/Windows Phone/i)
        ) {
            $("#video_div").hide();
        } else {
            $("#video_div").hide();
        }

        var settlement_id = $("#settlement_id").val();
        if (settlement_id == 0) {
            var name_printing = localStorage.getItem("name_printing");
            $("#name_printing").val(name_printing);
            var deployment_name = localStorage.getItem("deployment_name");
            $("#deployment_name").val(deployment_name);
        }
        var user_login_password = localStorage.getItem("user_login_password");
        $("#user_login_password").val(user_login_password);

        $(document).mouseup(function (e) {
            var eidt_email_partner_message = $("#eidt_email_partner_message");
            var incorrect_password_message = $("#incorrect_password_message");
            var seal_image_change_password_confirmation_message = $("#seal_image_change_password_confirmation_message");
            var delete_partner_confirmation_popup = $("#delete_partner_confirmation_popup");
            var delete_email_partner_message = $("#delete_email_partner_message");
            var delete_email_partner_message_confirm = $("#delete_email_partner_message_confirm");
            var edit_email_partner_message_confirm = $("#edit_email_partner_message_confirm");
            var add_email_partner_message_confirm = $("#add_email_partner_message_confirm");
            var password_exist_message = $("#password_exist_message");
            var settlement_title_empty_message = $("#settlement_title_empty_message");
            var save_settlement_letter_form_message = $("#save_settlement_letter_form_message");
            var delete_confirm_alert = $("#delete_confirm_alert");
            var invalid_partner_error_message = $("#invalid_partner_error_message");
            var already_exist_partner_error_message = $("#already_exist_partner_error_message");
            var textarea_exit_maxlength_error = $("#textarea_exit_maxlength_error");
            var done_configuration_seal_image_insert_message1 = $("#done_configuration_seal_image_insert_message1");
            var enter_settlement_title_message = $("#enter_settlement_title_message");
            var email_share_navi_message_aria = $("#email_share_navi_message_aria");
            var approval_seal_message_div = $("#approval_seal_message_div");
            var user_has_no_seal_message_div = $("#user_has_no_seal_message_div");
            var sharer_list = $(".sharer_list");
            var president_add_navi = $("#president_add_navi");

            if (!eidt_email_partner_message.is(e.target) && eidt_email_partner_message.has(e.target).length === 0) {
                eidt_email_partner_message.hide();
                $("#eidt_email_partner_message").removeClass('show').addClass('hide');
            }
            if (!incorrect_password_message.is(e.target) && incorrect_password_message.has(e.target).length === 0) {
                incorrect_password_message.hide();
            }
            if (!seal_image_change_password_confirmation_message.is(e.target) && seal_image_change_password_confirmation_message.has(e.target).length === 0) {
                seal_image_change_password_confirmation_message.hide();
            }
            if (!delete_partner_confirmation_popup.is(e.target) && delete_partner_confirmation_popup.has(e.target).length === 0) {
                delete_partner_confirmation_popup.hide();
            }
            if (!delete_email_partner_message.is(e.target) && delete_email_partner_message.has(e.target).length === 0) {
                delete_email_partner_message.hide();
            }
            if (!delete_email_partner_message_confirm.is(e.target) && delete_email_partner_message_confirm.has(e.target).length === 0) {
                delete_email_partner_message_confirm.hide();
            }
            if (!edit_email_partner_message_confirm.is(e.target) && edit_email_partner_message_confirm.has(e.target).length === 0) {
                edit_email_partner_message_confirm.hide();
            }
            if (!add_email_partner_message_confirm.is(e.target) && add_email_partner_message_confirm.has(e.target).length === 0) {
                add_email_partner_message_confirm.hide();
            }

            if (!password_exist_message.is(e.target) && password_exist_message.has(e.target).length === 0) {
                password_exist_message.hide();
            }
            if (!settlement_title_empty_message.is(e.target) && settlement_title_empty_message.has(e.target).length === 0) {
                settlement_title_empty_message.hide();
            }
            if (!save_settlement_letter_form_message.is(e.target) && save_settlement_letter_form_message.has(e.target).length === 0) {
                save_settlement_letter_form_message.hide();
            }
            if (!delete_confirm_alert.is(e.target) && delete_confirm_alert.has(e.target).length === 0) {
                delete_confirm_alert.hide();
                $("#delete_confirm_alert").removeClass('show').addClass('hide');
            }
            if (!invalid_partner_error_message.is(e.target) && invalid_partner_error_message.has(e.target).length === 0) {
                invalid_partner_error_message.hide();
            }
            if (!already_exist_partner_error_message.is(e.target) && already_exist_partner_error_message.has(e.target).length === 0) {
                already_exist_partner_error_message.hide();
            }
            if (!textarea_exit_maxlength_error.is(e.target) && textarea_exit_maxlength_error.has(e.target).length === 0) {
                textarea_exit_maxlength_error.hide();
            }
            if (!done_configuration_seal_image_insert_message1.is(e.target) && done_configuration_seal_image_insert_message1.has(e.target).length === 0) {
                done_configuration_seal_image_insert_message1.hide();
            }
            if (!enter_settlement_title_message.is(e.target) && enter_settlement_title_message.has(e.target).length === 0) {
                enter_settlement_title_message.hide();
            }
            if (!email_share_navi_message_aria.is(e.target) && email_share_navi_message_aria.has(e.target).length === 0) {
                $(".email_share_navi_message_aria").removeClass('show').addClass('hide');
            }
//            if (!approval_seal_message_div.is(e.target) && approval_seal_message_div.has(e.target).length === 0) {
//                approval_seal_message_div.hide();
//            }

            if (!user_has_no_seal_message_div.is(e.target) && user_has_no_seal_message_div.has(e.target).length === 0) {
                user_has_no_seal_message_div.hide();
            }
            if (!sharer_list.is(e.target) && sharer_list.has(e.target).length === 0) {
                sharer_list.hide();
            }
            if (!president_add_navi.is(e.target) && president_add_navi.has(e.target).length === 0) {
                president_add_navi.hide();
            }


        });


        $("#files").change(function () {
//            var filename = this.files[0].name;
            var filename = '';
            for (var i = 0; i < $("#files").get(0).files.length; ++i) {
                filename += $("#files").get(0).files[i].name + ' ';
            }
            $('#document_loader').show();
            $('#file_name').show();
            $('#file_name').text(filename);

            validate_settlement_form();
//            console.log(filename);
        });

        $("#add_seal_image").change(function () {
            var filename = this.files[0].name;
            $('#seal_image_name').show();
            $('#seal_image_name').text(filename);
//            console.log(filename);
        });

//        $("#add_crop_seal_image").change(function () {
//            var filename = this.files[0].name;
//            $('#crop_seal_image_name').show();
//            $('#crop_seal_image_name').text(filename);
////            console.log(filename);
//        });


        $('#conclusion, #others, #case_study, #reason').mouseup(function () {
//            $("#font_color_area").show();
            var id = $(this).attr('id');
            localStorage.setItem("editable_div_id", id);
            if (id != 'others')
                $('#font_color_area').hide();


//            $("#enter_comments_popup").show();
        });

        $("#close_settlement_letter_aria").click(function (event) {
            $("#settlement_letter_aria1").toggle(1000);
//            $("#text_change").toggleText("戻る","窓");

//            $(this).text(function(i, v){
//                return v === '窓' ? '戻る' : '窓'
//            });
            // $("#settlement_letter_aria").removeClass('show').addClass('hide');
        });

        $("#settlement_table_close").click(function (event) {
            var login_user_id2 = $("#login_user_id2").val();
//            alert(login_user_id2);
            $("#view_settlement_letter").removeClass("show").addClass("hide");
            $("#delete_confirm_alert").removeClass("show").addClass("hide");
            $("#settlement_letter_aria").show();
            $("#settlement_letter_aria").removeClass('hide').addClass('show');


            if(login_user_id2==126 || login_user_id2==123 || login_user_id2==124){
                $("#view_settlement_letter_admin").removeClass('hide').addClass('show');
                $("#settlement_letter_aria").removeClass('show').addClass('hide');
            }
            else{
                $("#view_settlement_letter_admin").removeClass("show").addClass("hide");
                $("#settlement_letter_aria").removeClass('hide').addClass('show');
            }


        });
        $("#settlement_table_close_admin").click(function (event) {
            var login_user_id2 = $("#login_user_id2").val();
//            alert(login_user_id2);
            $("#view_settlement_letter_admin").removeClass("show").addClass("hide");
            $("#delete_confirm_alert").removeClass("show").addClass("hide");
            $("#settlement_letter_aria").show();
            $("#settlement_letter_aria").removeClass('hide').addClass('show');

        });


        $("#settlement_letter_choice1").on('click', function (event) {
//            location.reload();
            self.location = $("#base_url").val() + 'index.php/wordapp/view_settlement_form/';
        });

//        $("#settlement_letter_choice8").on('click', function (event) {
//            $("#font_color_area").show();
//            var editable_div_id = localStorage.getItem('editable_div_id');
//            $('#' + editable_div_id).focus();
//        });

        $("#settlement_letter_choice7").on('click', function (event) {
//            if (id == 'settlement_letter_choice7') {
            $("#approval_list_view_password_form").show();
            $("#approval_list_view_password").val('');
            $("#approval_list_view_password").focus();
//                return false;
//            }
        });

        $("#settlement_letter_choice4,#settlement_letter_choice5,#settlement_letter_choice77,#settlement_letter_choice8").click(function (event) {
            event.preventDefault();
//            alert(this.id);
            var id = this.id;
            localStorage.setItem("settlement_letter_choice_id", id);
            var login_user_id2 = $("#login_user_id2").val();

            if (id == 'settlement_letter_choice8') {
                $("#font_color_area").show();
                var editor = document.getElementById('others');
                editor.focus();

//                var id = localStorage.getItem('editable_div_id');
//                var editor = document.getElementById(id);
//                window.focus();
//                editor.focus();
//                var sel = window.getSelection();
//                sel.selectAllChildren(editor);
//                localStorage.setItem("editable_div_id", id);
                return false;
            }

            $("#settlement_letter_aria").hide();
            $("#settlement_letter_aria").removeClass('show').addClass('hide');
            $("#view_settlement_letter").removeClass("hide").addClass("show");
            var back_one_step = $("#back_one_step").val(2);
            var login_user_id = $("#login_user_id").val();
            var created_by = $("#created_by").val();
            var is_share = $("#is_share").val();
            // alert(login_user_id);
            var start_from = 0;
            var word_list_limit = $("#word_limit_list").val();
            $("#settlement_table_close").focus();
            $("#start_list").val(0);
            if (id == 'settlement_letter_choice4') {
                var view_type = 4;
            } else if (id == 'settlement_letter_choice5') {
                var view_type = 5; // approval list of only created by login users
            } else if (id == 'settlement_letter_choice77') {
                var view_type = 7; // approval list of all users
            }

            var url = $("#base_url").val() + 'index.php/wordapp/get_all_settlement_data/';
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    login_user_id: login_user_id,
                    start_from: start_from,
                    view_type: view_type,
                    is_share: is_share,
                    created_by: created_by
                },
            })
                .done(function (html) {
//                    console.log(html+'==='+view_type);
//                    die();
                    $('#settlement_list').show();
                    document.getElementById('settlement_list').innerHTML = html;

                    if (id == 'settlement_letter_choice4') {
                        $('.span-title-list-files').text('決裁履歴');
                        $('#settlement_trash_folder').show();

                    }
                    if (id == 'settlement_letter_choice5') {
                        $('.span-title-list-files').text('決裁済（個別）');
                        $('#settlement_trash_folder').hide();
                    }
                    if (id == 'settlement_letter_choice77') {
                        $('.span-title-list-files').text('決裁済（全体）');
                        $('#settlement_trash_folder').hide();
                    }

                    $("td.settlement_title").each(function () {
                        var DELAY = 1000, clicks = 0, timer = null;
                        $(this).on("click", function () {

                            var settlement_id = $(this).children('.settlement_id').val();
                            var is_share = $(this).children('.is_share').val();
                            var president_seal_id = $(this).children('.president_seal_id').val();
                            clicks++;  //count clicks

                            if(president_seal_id==1){
                                $('td.settlement_title').css({"border": ""});
                                $('td.settlement_title').removeClass("checked_list");
                                $('td.settlement_title').removeClass("checked_list_president");
                                $(this).css({"border":"2px solid blue", "background-color":"lightpink"});
                                $(this).addClass("checked_list_president");
                            }else{
                                $('td.settlement_title').css({"border": ""});
                                $('td.settlement_title').removeClass("checked_list");
                                $('td.settlement_title').removeClass("checked_list_president");
                                $(this).addClass("checked_list");
                            }
                            if (clicks === 1) {
                                $("#select_settlement").removeClass('show').addClass('hide');
                                timer = setTimeout(function () {

                                    clicks = 0;  //after action performed, reset counter
                                    if (settlement_id !== undefined) {
                                        // alert(settlement_id);
                                        $(this).addClass("checked_list");
                                    } else {
                                        $('td.settlement_title').removeClass("checked_list");
                                    }
                                }, DELAY);

                            } else {
//                                alert('hi');die();
                                clearTimeout(timer);    //prevent single-click action
                                clicks = 0;             //after action performed, reset

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
                                var base_url = $("#base_url").val();
//                                var is_share = $("#is_share").val();

                                if (is_share == 1) {
                                    var share_this_settlement_id = 1;
                                } else {
                                    var share_this_settlement_id = 0;
                                }

                                var back_one_step = 2;
                                $("#view_settlement_letter").removeClass("hide").addClass("show");
                                if(login_user_id2==126 || login_user_id2==123 || login_user_id2==124){
                                    share_this_settlement_id=1;
                                    window.open(base_url + 'index.php/wordapp/view_settlement_form_2/' + settlement_id + '/' + share_this_settlement_id + '/' + back_one_step, "_self", style);

                                }else{
                                    window.open(base_url + 'index.php/wordapp/view_settlement_form_2/' + settlement_id + '/' + share_this_settlement_id + '/' + back_one_step, "_self", style);

                                }

                                // $.ajax({
                                //     url: "index.php/wordapp/get_settlement_data_by_id",
                                //     type: 'POST',
                                //     data: {settlement_id: settlement_id},
                                // })
                                //     .done(function (data) {
                                //         var post_data = JSON.parse(data);
                                //         $(" #settlement_id ").val(post_data.settlement_id)
                                //         // $("#view_settlement_letter").removeClass("show").addClass("hide");
                                //         alert('open settlement form page');
                                //
                                //
                                //         console.log("success");
                                //     })
                                //     .fail(function () {
                                //         console.log("error");
                                //     })
                                //     .always(function () {
                                //         console.log("complete");
                                //     });
                            }
                        });
                    });
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    var total_user_post = $("#total_settlement_data").val();
                    if (total_user_post < 30) {
                        $("#settlement_next_page").attr('disabled', 'disabled');
                    }
                    $("#settlement_previous_page").attr('disabled', 'disabled');
                    console.log("complete");
                });
        });

        $("#admin_settlement_letter_choice4,#admin_settlement_letter_choice5,#admin_settlement_letter_choice7").click(function (event) {
            event.preventDefault();
//            alert(this.id);
            var id = this.id;
            localStorage.setItem("settlement_letter_choice_id", id);

            if (id == 'settlement_letter_choice8') {
                $("#font_color_area").show();
                var editor = document.getElementById('others');
                editor.focus();

//                var id = localStorage.getItem('editable_div_id');
//                var editor = document.getElementById(id);
//                window.focus();
//                editor.focus();
//                var sel = window.getSelection();
//                sel.selectAllChildren(editor);
//                localStorage.setItem("editable_div_id", id);
                return false;
            }

            $("#settlement_letter_aria").hide();
            $("#settlement_letter_aria").removeClass('show').addClass('hide');
            $("#view_settlement_letter_admin").removeClass("hide").addClass("show");
            var back_one_step = $("#back_one_step").val(2);
            var login_user_id2 = $("#login_user_id2").val();
            var created_by = $("#created_by").val();
            var is_share = $("#is_share").val();
            // alert(login_user_id);
            var start_from = 0;
            var word_list_limit = $("#word_limit_list").val();
            $("#settlement_table_close").focus();
            $("#start_list").val(0);
            if (id == 'admin_settlement_letter_choice4') {
                var view_type = 4;
            } else if (id == 'admin_settlement_letter_choice5') {
                var view_type = 5; // approval list of only created by login users
            } else if (id == 'admin_settlement_letter_choice77') {
                var view_type = 7; // approval list of all users
            }

            var url = $("#base_url").val() + 'index.php/wordapp/get_userlist_for_admin/';
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    login_user_id: login_user_id2,
                    start_from: start_from,
                    view_type: view_type,
                    is_share: is_share,
                    created_by: created_by
                },
            })
                .done(function (html) {
//                    console.log(html);
//                    die();
                    document.getElementById('settlement_list_admin').innerHTML = html;

                    if (id == 'admin_settlement_letter_choice4') {
                        $('.span-title-list-files').text('決裁履歴 -ユーザー名一覧');
                    }
                    if (id == 'admin_settlement_letter_choice5') {
                        $('.span-title-list-files').text('決裁済（個別）-ユーザー名一覧');
                    }
                    if (id == 'admin_settlement_letter_choice7') {
                        $('.span-title-list-files').text('決裁済（全体）-ユーザー名一覧');
                    }

                    $("td.usersname").each(function () {
                        var DELAY = 1000, clicks = 0, timer = null;
                        $(this).on("click", function () {
                            var login_id = $(this).children('.user_id').val();
                            $('#settlement_list_admin').find("td.checked_list").removeClass('checked_list');
                            $(this).addClass("checked_list");
//                                alert(login_id);
                            $("#login_user_id").val(login_id);
                            get_all_settlement_data_for_admin(id);
                        });
                    });
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
//                return false;
        });
        function get_all_settlement_data_for_admin(admin_id) {
            if(admin_id=='admin_settlement_letter_choice4'){
                var id='settlement_letter_choice4';
            }
            if(admin_id=='admin_settlement_letter_choice5'){
                var id='settlement_letter_choice5';
            }
            if(admin_id=='admin_settlement_letter_choice77'){
                var id='settlement_letter_choice77';
            }
            localStorage.setItem("settlement_letter_choice_id", id);
            var login_user_id2 = $("#login_user_id2").val();


            if (id == 'settlement_letter_choice8') {
                $("#font_color_area").show();
                var editor = document.getElementById('others');
                editor.focus();

//                var id = localStorage.getItem('editable_div_id');
//                var editor = document.getElementById(id);
//                window.focus();
//                editor.focus();
//                var sel = window.getSelection();
//                sel.selectAllChildren(editor);
//                localStorage.setItem("editable_div_id", id);
                return false;
            }

            $("#settlement_letter_aria").hide();
            $("#settlement_letter_aria").removeClass('show').addClass('hide');
            $("#view_settlement_letter_admin").removeClass('show').addClass('hide');
            $("#view_settlement_letter").removeClass("hide").addClass("show");
            var back_one_step = $("#back_one_step").val(2);
            var login_user_id = $("#login_user_id").val();
            var created_by = $("#created_by").val();
            var is_share = $("#is_share").val();
            // alert(login_user_id);
            var start_from = 0;
            var word_list_limit = $("#word_limit_list").val();
            $("#settlement_table_close").focus();
            $("#start_list").val(0);
            if (id == 'settlement_letter_choice4') {
                var view_type = 4;
            } else if (id == 'settlement_letter_choice5') {
                var view_type = 5; // approval list of only created by login users
            } else if (id == 'settlement_letter_choice77') {
                var view_type = 7; // approval list of all users
            }

            var url = $("#base_url").val() + 'index.php/wordapp/get_all_settlement_data/';
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    login_user_id: login_user_id,
                    start_from: start_from,
                    view_type: view_type,
                    is_share: is_share,
                    created_by: created_by
                },
            })
                .done(function (html) {
//                    console.log(html);
//                    die();
                    $('#settlement_list').show();
                    document.getElementById('settlement_list').innerHTML = html;

                    if (id == 'settlement_letter_choice4') {
                        $('.span-title-list-files').text('決裁履歴');
                        $('#settlement_trash_folder').show();
                    }
                    if (id == 'settlement_letter_choice5') {
                        $('.span-title-list-files').text('決裁済（個別）');
                        $('#settlement_trash_folder').hide();
                    }
                    if (id == 'settlement_letter_choice77') {
                        $('.span-title-list-files').text('決裁済（全体）');
                        $('#settlement_trash_folder').hide();
                    }

                    var user_name=get_user_name(login_user_id);

                    $("td.settlement_title").each(function () {
                        var DELAY = 1000, clicks = 0, timer = null;
                        $(this).on("click", function () {

//                            var settlement_id = $(this).children('.settlement_id').val();
//                            var is_share = $(this).children('.is_share').val();
//                            clicks++;  //count clicks
//                            $('td.settlement_title').removeClass("checked_list");
//                            $(this).addClass("checked_list");
                            var settlement_id = $(this).children('.settlement_id').val();
                            var is_share = $(this).children('.is_share').val();
                            var president_seal_id = $(this).children('.president_seal_id').val();
                            clicks++;  //count clicks

                            if(president_seal_id==1){
                                $('td.settlement_title').css({"border": ""});
                                $('td.settlement_title').removeClass("checked_list");
                                $('td.settlement_title').removeClass("checked_list_president");
                                $(this).css({"border":"2px solid blue", "background-color":"lightpink"});
                                $(this).addClass("checked_list_president");
                            }else{
                                $('td.settlement_title').css({"border": ""});
                                $('td.settlement_title').removeClass("checked_list");
                                $('td.settlement_title').removeClass("checked_list_president");
                                $(this).addClass("checked_list");
                            }
                            if (clicks === 1) {
                                $("#select_settlement").removeClass('show').addClass('hide');
                                timer = setTimeout(function () {

                                    clicks = 0;  //after action performed, reset counter
                                    if (settlement_id !== undefined) {
                                        // alert(settlement_id);
                                        $(this).addClass("checked_list");
                                    } else {
                                        $('td.settlement_title').removeClass("checked_list");
                                    }
                                }, DELAY);

                            } else {
//                                alert('hi');die();
                                clearTimeout(timer);    //prevent single-click action
                                clicks = 0;             //after action performed, reset

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
                                var base_url = $("#base_url").val();
//                                var is_share = $("#is_share").val();

                                if (is_share == 1) {
                                    var share_this_settlement_id = 1;
                                } else {
                                    var share_this_settlement_id = 0;
                                }

                                var back_one_step = 2;
                                $("#view_settlement_letter").removeClass("hide").addClass("show");
                                if(login_user_id2==126 || login_user_id2==123 || login_user_id2==124){
                                    share_this_settlement_id=1;
                                    window.open(base_url + 'index.php/wordapp/view_settlement_form_2/' + settlement_id + '/' + share_this_settlement_id + '/' + back_one_step, "_self", style);

                                }else{
                                    window.open(base_url + 'index.php/wordapp/view_settlement_form_2/' + settlement_id + '/' + share_this_settlement_id + '/' + back_one_step, "_self", style);

                                }
                                // $.ajax({
                                //     url: "index.php/wordapp/get_settlement_data_by_id",
                                //     type: 'POST',
                                //     data: {settlement_id: settlement_id},
                                // })
                                //     .done(function (data) {
                                //         var post_data = JSON.parse(data);
                                //         $(" #settlement_id ").val(post_data.settlement_id)
                                //         // $("#view_settlement_letter").removeClass("show").addClass("hide");
                                //         alert('open settlement form page');
                                //
                                //
                                //         console.log("success");
                                //     })
                                //     .fail(function () {
                                //         console.log("error");
                                //     })
                                //     .always(function () {
                                //         console.log("complete");
                                //     });
                            }
                        });
                    });
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    var total_user_post = $("#total_settlement_data").val();
                    if (total_user_post < 30) {
                        $("#settlement_next_page").attr('disabled', 'disabled');
                    }
                    $("#settlement_previous_page").attr('disabled', 'disabled');
                    console.log("complete");
                });
        }

        function get_user_name(login_id) {
//            var base_url = $("#base_url").val();
            $.ajax({
                url: base_url + "index.php/wordapp/get_user_name",
                type: "POST",
                data: {user_id: login_id,},
                async: false,
                cache: false,
                dataType: "text",
                success: function (response, textStatus, jqXHR) {
                    var response_val = response.trim();
//                alert(response_val);die();
                    var response_val_array = response_val.split('#####');
                    var name = response_val_array[0];
                    var username = response_val_array[1];
                    if(name!='')
                        var user_name= name;
                    else
                        var user_name= username;

                    $('.usersname_text').text('['+user_name+']');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                    alert(textStatus);
                }
            });

        }


        $("#settlement_letter_choice6").click(function (event) {
            event.preventDefault();
            $("#load_settlement_list_sent_received_content").show();
            $("#email_navigation_message").removeClass('hide').addClass('show');
            $("#settlement_letter_aria").removeClass("show").addClass("hide");
            var base_url = $("#base_url").val();

            $.ajax({
                url: base_url + "index.php/wordapp/load_settlement_list_sent_received_page",
                type: "POST",
                data: {},
                async: false,
                cache: false,
                dataType: "text",
                success: function (response, textStatus, jqXHR) {
                    var response_val = response.trim();
//                alert(response_val);die();
                    $("#load_settlement_list_sent_received_content").html(response_val);
                    get_user_settlement_list_sent_received();
                    get_user_last_settlement_list_sent_received();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                    alert(textStatus);
                }
            });

        });

//        start share form with others
        $("#share_settlement_form").on('click', function (event) {
//            alert('hi');die();
            event.preventDefault();
            // Init Partner table
            var settlement_title = $("#settlement_title").val();
            var name_printing = $("#name_printing").val();

            if (settlement_title != '' && name_printing != '') {
                $("#enter_settlement_title_message").hide();

                multiple_partner_id = [];
                multiple_partner_name = [];
                $("#email_share_navi_user_list").removeClass('show').addClass('hide');
                $("#edit_partner_confirmation_popup").hide();
                var enable_email_multi_share = $("#enable_email_multi_share").val();
//            alert(enable_email_multi_share);
                if (enable_email_multi_share == 1) {
//                $("#table_of_partner tr").removeClass('enable_to_multi_share');
//                $("#enable_email_multi_share").val(0);
//                $("#email_multiple_share").addClass('btn-success');
//                $("#email_multiple_share").css("background-color", "#419641");
//                $("#email_share_navi_message_aria").removeClass('show').addClass('hide');
                } else {
                    $("#settlement_letter_aria").removeClass('show').addClass('hide');
                    $("#email_partner_message").removeClass('show').addClass('hide');
                    $("#table_of_partner tr").removeClass('active edit_partner');
                    $("#enable_email_multi_share").val(1);
                    $("#send_email_form_partner_addto").removeClass('btn-success');
                    $("#send_email_form_partner_addto").css("background-color", "yellow");
                    $("#email_share_navi_message_aria").removeClass('hide').addClass('show');
                }

//            $("#table_of_partner tr").removeClass('enable_to_multi_share');
                $("#settlement_letter_aria").hide();
//            $("#enable_email_multi_share").val(0);
//            $("#email_multiple_share").addClass('btn-success');
//            $("#email_multiple_share").css("background-color", "#419641");
//            $("#email_share_navi_message_aria").removeClass('show').addClass('hide');

                $('#table_of_partner').removeClass('hide').addClass('show');
//            $("#email_partner_message").removeClass('hide').addClass('show');
                $("#eidt_email_partner_message").removeClass('show').addClass('hide');
                $("#button_aria_share_form").show();
                $("#button_aria_share_email").hide();
//            $("#loader_partner_list").show();

                get_user_partners();
            } else {
                $('#document_loader').show();
//                $("#enter_settlement_title_message").show();
//                return false;
                validate_settlement_form(2);
            }


        });

        $("#close_partner").on('click', function (event) {
            event.preventDefault();
            $('#table_of_partner').removeClass('show').addClass('hide');
            $("#settlement_letter_aria").show();
            $("#settlement_letter_aria").removeClass('hide').addClass('show');
            var partner_share_enable = $("#partner_share_enable").val();
            if(partner_share_enable==2){
                location.reload();
            }

        });

        $("#seal_image").on('click', function (event) {
            event.preventDefault();
            window.open("http://www.hakusyu.com/webmtm/");
        });
        $("#forgot_seal_image_password_form_close").on('click', function (event) {
            event.preventDefault();
            $("#seal_image_change_password_form").show();
            $("#forgot_seal_image_password_form").hide();
        });

        $("#close_email_share_navi_user_list").on('click', function (event) {
            event.preventDefault();
            $("#email_share_navi_user_list").removeClass('show').addClass('hide');
        });

        $("#close_settlement_title_empty_message").on('click', function (event) {
            event.preventDefault();
            $("#settlement_title_empty_message").hide();
        });
        $("#close_approval_seal_message_div").on('click', function (event) {
            event.preventDefault();
            $("#approval_seal_message_div").hide();
        });
        $("#close_user_has_no_seal_message_div").on('click', function (event) {
            event.preventDefault();
            $("#user_has_no_seal_message_div").hide();
        });

        $("#approval_list_view_password_form_close").on('click', function (event) {
            event.preventDefault();
            $("#approval_list_view_password_form").hide();
        });

        $("#show_crop_image_popup").on('click', function (event) {
            event.preventDefault();
            $("#crop_seal_image_popup").show();
            $("#preview-crop-image").html("");
        });
        $("#close_font_color_area").on('click', function (event) {
            event.preventDefault();
            $("#font_color_area").hide();
        });
        $("#seal_image_change_password_form_step_2_close").on('click', function (event) {
            event.preventDefault();
            $("#seal_image_change_password_form").show();
            $("#seal_image_change_password_form_step_2").hide();
        });
        $(".decision_documents_iframe").on('click', function (event) {
            var doc_url=document.getElementById("decision_documents_url").href;
//            alert(doc_url);die();
            document.getElementById('myIframe').src =doc_url;

            $("#test_iframe").show();
            $("#settlement_letter_aria").removeClass('show').addClass('hide');
        });
        $("#close_crop_seal_image_popup").on('click', function (event) {
            event.preventDefault();
            $("#crop_seal_image_popup").hide();
            $("#preview-crop-image").html("");
            $("#final_cropped_seal_image").show();
//            var crop_image_name = $("#crop_image_name").attr('src');
//            alert(crop_image_name);
//            document.getElementById('final_cropped_seal_image').src=crop_image_name;
        });

        $("#close_enter_settlement_title_message").on('click', function (event) {
            event.preventDefault();
            $("#enter_settlement_title_message").hide();
        });
        $("#close_forgot_password_message").on('click', function (event) {
            event.preventDefault();
            $("#forgot_password_message").hide();
        });

        $("#delete_confirm_no_partner_button_settlement").on('click', function (event) {
            event.preventDefault();
            $("#delete_partner_confirmation_popup").hide();
        });
        $("#close_textarea_exit_maxlength_error").on('click', function (event) {
            event.preventDefault();
            $("#textarea_exit_maxlength_error").hide();
        });

        $("#configuration_seal_image_form_close").on('click', function (event) {
            event.preventDefault();
            $("#configuration_seal_image_form").hide();
        });
        $("#new_partner_registration_form_close").on('click', function (event) {
            event.preventDefault();
            $("#new_partner_registration_form").hide();
        });

        $("#settlement_table_trash_close").on('click', function (event) {
            event.preventDefault();
            $("#button_aria_trash").hide();
            $("#button_aria").show();
            $("#settlement_list_trash").hide();
            $("#settlement_letter_choice4").click();
            var login_user_id2 = $("#login_user_id2").val();
            if(login_user_id2==126 || login_user_id2==123 || login_user_id2==124)
                get_all_settlement_data_for_admin('admin_settlement_letter_choice4');
            else
                $("#settlement_letter_choice4").click();

        });

        $("#edit_confirm_no_partner_button_settlement").on('click', function (event) {
            event.preventDefault();
            $("#edit_partner_confirmation_popup").hide();
        });

        $("#close_settlement_letter_form").on('click', function (event) {
            event.preventDefault();
            var president_seal_id = $("#president_seal_id").val();
            localStorage.removeItem("name_printing");
            localStorage.removeItem("deployment_name");
            localStorage.removeItem("user_login_password");
            localStorage.removeItem("editable_div_id");
            localStorage.removeItem("settlement_letter_choice_id");
            localStorage.removeItem("page_count");

            window.location.href = $("#base_url").val() + "index.php/account/sign_out";
//            alert(president_seal_id);
//            var back_one_step = $("#back_one_step").val();
//            if (back_one_step == 2) {
//                if (president_seal_id == 0) {
//                    $("#settlement_letter_choice4").trigger('click');
//                } else {
//                    $("#settlement_letter_choice5").trigger('click');
//                }
//            } else {
//                window.close();
//                return false;
//            }

        });

        $("#close_password_exist_message").on('click', function (event) {
            event.preventDefault();
            $("#password_exist_message").hide();
        });

        $("#close_email_share_navi_message").on('click', function (event) {
            event.preventDefault();
            $("#email_share_navi_message_aria").removeClass('show').addClass('hide');
        });
        $("#close_invalid_partner_error_message").on('click', function (event) {
            event.preventDefault();
            $("#invalid_partner_error_message").hide();
        });
        $("#close_already_exist_partner_error_message").on('click', function (event) {
            event.preventDefault();
            $("#already_exist_partner_error_message").hide();
        });


        $("#close_edit_email_partner_message_confirm").on('click', function (event) {
            event.preventDefault();
            $("#edit_email_partner_message_confirm").hide();
        });
        $("#close_add_email_partner_message_confirm").on('click', function (event) {
            event.preventDefault();
            $("#add_email_partner_message_confirm").hide();
        });

        $("#close_configuration_seal_image_insert_message").on('click', function (event) {
            event.preventDefault();
            $("#done_configuration_seal_image_insert_message1").hide();
        });

        $("#close_delete_email_partner_message").on('click', function (event) {
            event.preventDefault();
            $("#delete_email_partner_message").hide();
        });

        $("#close_delete_documents_message_confirm").on('click', function (event) {
            event.preventDefault();
            $("#delete_documents_message_confirm").hide();
        });

        $("#close_incorrect_password_message").on('click', function (event) {
            event.preventDefault();
            $("#incorrect_password_message").hide();
        });

        $("#close_delete_email_partner_message_confirm").on('click', function (event) {
            event.preventDefault();
            $("#delete_email_partner_message_confirm").hide();
        });

        $("#close_seal_image_change_password_confirmation_message").on('click', function (event) {
            event.preventDefault();
            $("#seal_image_change_password_confirmation_message").hide();
        });

        $("#send_email_form_partner_addto").on('click', function (event) {
            event.preventDefault();
            var enable_email_multi_share = $("#enable_email_multi_share").val();
            $("#delete_email_partner_message").hide();
            $("#eidt_email_partner_message").removeClass('show').addClass('hide');
//            alert(enable_email_multi_share);
            if (enable_email_multi_share == 1) {

                $("#table_of_partner tr").removeClass('enable_to_multi_share1');
                $("#enable_email_multi_share").val(0);
                $("#send_email_form_partner_addto").addClass('btn-success');
                $("#send_email_form_partner_addto").css("background-color", "#419641");
                $("#email_share_navi_user_list").removeClass('show').addClass('hide');
            } else {
                $("#email_partner_message").removeClass('show').addClass('hide');
                $("#table_of_partner tr").removeClass('active edit_partner');
                $("#enable_email_multi_share").val(1);
                $("#send_email_form_partner_addto").removeClass('btn-success');
                $("#send_email_form_partner_addto").css("background-color", "yellow");
                $("#email_share_navi_message_aria").removeClass('hide').addClass('show');
            }
        });

        function get_user_partners() {
//            $("#new_partner_registration_form").hide();
            var user_id = $("#user_id").val();
            var base_url = $("#base_url").val();
            var url = base_url + 'index.php/emailing/get_user_partners';
            // alert(url);
            // return false;
            $.ajax({
                url: url,
                type: 'POST',
                beforeSend: function () {
                    $("#loader_partner_list").show();
                },
                data: JSON.stringify({
                    user_id: user_id,
                    partner_type: 1 // 1: as it is create from settlement/requisition form
                }),
                contentType: "application/json",
            })
                .done(function (data) {
//                    console.log(data);
//                    die();
                    $("#partner_container").html(data);
                    $("#email_share_navi_message_aria").removeClass('hide').addClass('show');
                    // $("#load_table_of_partner").html(data);
                    console.log("success");
                    $("#loader_partner_list").hide();
                    $("#settlement_letter_aria").removeClass("show").addClass("hide");


                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    $("#loader_partner_list").hide();
                    console.log("complete");
                });
        }


        var multiple_partner_id = [];
        var multiple_partner_name = [];
        $(document).delegate("#table_of_partner #partnerr_row", "click", function (event) {
            // $("#table_of_partner tr").live('click', function(event) {

            $("#table_of_partner tr").removeClass('active edit_partner danger');
            $("#share_email_selected_partner1").show();
            $("#share_email_selected_partner").hide();
//            var edit_partner_yes = $("#edit_partner_yes").val();
//            var delete_partner_yes = $("#delete_partner_yes").val();
//            if(edit_partner_yes==1 || delete_partner_yes==1)
//                $("#enable_email_multi_share").val(0);
//            else
//                $("#enable_email_multi_share").val(1);
            var email_multiple_share = $("#enable_email_multi_share").val();

            if (email_multiple_share == 1) {
                $("#email_partner_message").removeClass('show').addClass('hide');
                $("#table_of_partner tr").removeClass('active edit_partner');

                $("#send_email_form_partner_addto").removeClass('btn-success');
                $("#send_email_form_partner_addto").css("background-color", "yellow");
                $("#email_share_navi_message_aria").removeClass('show').addClass('hide');
//                $("#email_share_navi_message_aria").removeClass('hide').addClass('show');

                var this_partner_id = $(this).children('.partner_id').val();
                var share_partner_name = $(this).children('.share_partner_name').val();
                if (this_partner_id != undefined) {
                    if (jQuery.inArray(this_partner_id, multiple_partner_id) == -1) {
                        multiple_partner_id.push(this_partner_id);
                        multiple_partner_name.push(share_partner_name);

                        var enable_email_multi_share = $("#enable_email_multi_share").val();
                        if (enable_email_multi_share == 1) {
                            if (multiple_partner_name.length > 0) {
                                $("#email_share_navi_user_list").removeClass('hide').addClass('show');
                                var htmlSting = "";
                                for (var i = 0; i < multiple_partner_name.length; i++) {
                                    htmlSting += '<li id="'+multiple_partner_id[i]+'" class="pull-left" style="width: 50%">' + multiple_partner_name[i] + '</li>';
                                }
                                $("#share_multiple_partner_list").html(htmlSting);
                            }
                        }
                        // check by ahsan
                        $(this).addClass('enable_to_multi_share1');
                    }else{
                        $("#email_share_navi_message_aria").removeClass('hide').addClass('show');
                        if(multiple_partner_name.length == 1){
                            $("#email_share_navi_user_list").removeClass('show').addClass('hide');
                        }
                        var id_index = multiple_partner_id.indexOf(this_partner_id);
                        var name_index = multiple_partner_name.indexOf(share_partner_name);
                        if (id_index > -1) {
                            multiple_partner_id.splice(id_index, 1);
                            multiple_partner_name.splice(name_index, 1);
                        }
                        var htmlSting2 = "";
                        for (var i = 0; i < multiple_partner_name.length; i++) {
                            htmlSting2 += '<li id="'+multiple_partner_id[i]+'" class="pull-left" style="width: 50%">' + multiple_partner_name[i] + '</li>';
                        }
                        $("#share_multiple_partner_list").html(htmlSting2);
                        $(this).removeClass('enable_to_multi_share1');
                    }


                }

            } else {

//                $("#enable_email_multi_share").val(0);
                $(this).addClass('active edit_partner');
                var edit_partner_yes = $("#edit_partner_yes").val();
                var delete_partner_yes = $("#delete_partner_yes").val();
                var partner_id = $(".edit_partner").children('.partner_id').val();
                if($(".edit_partner .input_partner_name").val()!='')
                    var partner_name = $(".edit_partner .input_partner_name").val();
                else if($(".edit_partner .input_partner_mobile").val()!='')
                    var partner_name = $(".edit_partner .input_partner_mobile").val();
//                var partner_name = $(".edit_partner .input_partner_name").val();
                if (partner_id && edit_partner_yes == 1) {
                    $("#delete_email_partner_message").hide();
                    $("#edit_partner_confirmation_popup").show();
                    $("#eidt_email_partner_message").removeClass('show').addClass('hide');
                    $('#show_edit_partner_name').text(partner_name);
                }
                else if(partner_id && delete_partner_yes == 1){

                    $("#delete_partner_button_settlement").trigger('click');
                }
                else {
                    $("#edit_partner_confirmation_popup").hide();
                    $("#delete_partner_confirmation_popup").hide();
                }
            }
        });

//        $(document).delegate("#table_of_partner #partnerr_row", "dblclick", function (event) {
//
//            var this_partner_id = $(this).children('.partner_id').val();
//            var share_partner_name = $(this).children('.share_partner_name').val();
//            var id_index = multiple_partner_id.indexOf(this_partner_id);
//            var name_index = multiple_partner_name.indexOf(share_partner_name);
//            if (id_index > -1) {
//                multiple_partner_id.splice(id_index, 1);
//                multiple_partner_name.splice(name_index, 1);
//            }
//            var htmlSting2 = "";
//            for (var i = 0; i < multiple_partner_name.length; i++) {
//                htmlSting2 += '<li id="'+multiple_partner_id[i]+'" class="pull-left" style="width: 50%">' + multiple_partner_name[i] + '</li>';
//            }
//            $("#share_multiple_partner_list").html(htmlSting2);
//            $(this).removeClass('enable_to_multi_share1');
//
//        });


        $("#share_email_selected_partner1").on('click', function (event) {
            event.preventDefault();
            var base_url = $("#base_url").val();
            var email_id = $("#reply_mail_id").val();
            var login_user_id = $("#login_user_id").val();
            var settlement_id = $("#settlement_id").val();

//            var save_settlement_form_for_emailing = $("#save_settlement_form_for_emailing").val(1);
//            alert(settlement_id);die();


//            if (settlement_id == 0) {
//                if (settlement_title != '' || conclusion != '' || reason != '' || case_study != '' || others != '' || deployment_name != '' || name_printing != '') {
//                    var settlement_letter_form = document.getElementById("settlement_letter_form");
//                    var form_data = new FormData(settlement_letter_form);
//                    $.ajax({
//                        url: base_url + "index.php/wordapp/save_settlement_letter_form",
//                        data: form_data,
//                        cache: false,
//                        processData: false,
//                        contentType: false,
//                        type: 'POST',
//                        success: function (response) {
//                            var get_settlement_id = response.trim();
//                            var response_val = response.trim();
//                            var response_val_array = response_val.split('######');
//                            var get_settlement_id = response_val_array[0];
//                            var doc_exist = response_val_array[1];
//                            console.log('success');
////                            die();
//                            if (get_settlement_id > 0) {
//                                $("#settlement_id_email").val(get_settlement_id);
//
//                            } else {
//
//                            }
//
////                            console.log(get_settlement_id);die();
////                            $("#settlement_id_email").val(get_settlement_id);
//                        }
//                    });
//                }
//            }
//            die();

            setTimeout(function () {
//                if (settlement_id == 0) {
//                    var settlement_id2 = $("#settlement_id_email").val();
//                } else {
//                    var settlement_id2 = $("#settlement_id").val();
//                }
                var request_data = {
                    'sender_id': login_user_id,
                    'email_id': email_id,
                    'partners': toObject(multiple_partner_id),
                    'settlement_id': settlement_id
                };

                $.ajax({
                    url: base_url + "index.php/emailing/share_email_to_multiple_partner",
                    type: 'POST',
                    beforeSend: function () {
                        $(".ajax_email_load_aria").show();
                    },
                    data: JSON.stringify(request_data),
                    contentType: "application/json",
                })
                    .done(function (data) {
//                    alert(data);
//                    alert('送信が完了しました');
                        $("#close_partner").trigger('click');
//                    $("#success_email_message").removeClass('hide').addClass('show');
                        $("#table_of_partner").removeClass('show').addClass('hide');
                        location.reload();
//                    $("#table_of_partner").hide();
                        console.log("success");
//                    get_user_email();
//                    get_last_email();
                    })
                    .fail(function () {
                        console.log("error");
                    })
                    .always(function () {
                        console.log("complete");
                    });
            }, 1000);

        });

        function toObject(arr) {
            var rv = {};
            for (var i = 0; i < arr.length; ++i)
                rv[i] = arr[i];
            return rv;
        }

        $("#open_settlement_form").click(function () {
//            $("#delete_confirm_alert").removeClass('hide').addClass('show');
//            die();
            var settlement_id = $(".checked_list").children('.settlement_id').val();
            var is_share = $(".checked_list").children('.is_share').val();
            var settlement_title = $(".checked_list").text();
            var base_url = $("#base_url").val();
            var back_one_step = $("#back_one_step").val(2);
            $("#settlement_letter_aria").removeClass('hide').addClass('show');
            var login_user_id2 = $("#login_user_id2").val();

            //            alert($("#settlement_letter_choice4").val());
            if (settlement_id === undefined) {
                $("#select_settlement").removeClass('hide').addClass('show');
                $("#close_settlement").click(function (event) {
                    $("#select_settlement").removeClass('show').addClass('hide');
                    return false;
                });
                return false;
            } else {
                $("#select_settlement").removeClass('show').addClass('hide');
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
                var base_url = $("#base_url").val();
                if (is_share == 1) {
                    var share_this_settlement_id = 1;
                } else {
                    var share_this_settlement_id = 0;
                }
                var back_one_step = 2;
                $("#view_settlement_letter").removeClass("show").addClass("hide");
                if(login_user_id2==126 || login_user_id2==123 || login_user_id2==124){
                    share_this_settlement_id=1;
                    window.open(base_url + 'index.php/wordapp/view_settlement_form_2/' + settlement_id + '/' + share_this_settlement_id + '/' + back_one_step, "_self", style);

                }else{
                    window.open(base_url + 'index.php/wordapp/view_settlement_form_2/' + settlement_id + '/' + share_this_settlement_id + '/' + back_one_step, "_self", style);

                }
            }
        });


        $("#delete_settlement").click(function () {
//            $("#delete_confirm_alert").removeClass('hide').addClass('show');
//            die();
            var settlement_id = $(".checked_list").children('.settlement_id').val();
            var president_seal_id = $(".checked_list_president").children('.president_seal_id').val();
            var settlement_id_president = $(".checked_list_president").children('.settlement_id').val();
            var settlement_title = $(".checked_list").text();
            var settlement_title_president = $(".checked_list_president").text();
            var base_url = $("#base_url").val();
            if(president_seal_id == 1){
                settlement_id=settlement_id_president;
                settlement_title=settlement_title_president;
            }
//            alert(settlement_id+'=='+president_seal_id);
            if (settlement_id === undefined) {

//                if(president_seal_id == 1){
//                    $("#select_settlement").removeClass('hide').addClass('show');
//                    $("#select_title_warning_message").text('最終決裁書ので削除が出来ません');
//
//                }else{
                $("#select_settlement").removeClass('hide').addClass('show');

//                }
                $("#close_settlement").click(function (event) {
                    $("#select_settlement").removeClass('show').addClass('hide');
                    return false;
                });

                return false;
            } else {
                $("#delete_confirm_alert").removeClass('hide').addClass('show');
                document.getElementById('delete_settlement_title_show').innerHTML = settlement_title;


                $("#delete_settlement_close").click(function (event) {
                    $("#delete_confirm_alert").removeClass('show').addClass('hide');
                    return false;
                });


                ////////////////////////////////////////////



            }
        });
        $("#delete_confirm_settlement").click(function (event) {
            var login_user_id2 = $("#login_user_id2").val();
            var base_url = $("#base_url").val();
            var settlement_id = $(".checked_list").children('.settlement_id').val();
            var president_seal_id = $(".checked_list_president").children('.president_seal_id').val();
            var settlement_id_president = $(".checked_list_president").children('.settlement_id').val();
            var settlement_title = $(".checked_list").text();
            var settlement_title_president = $(".checked_list_president").text();
            if(president_seal_id == 1){
                settlement_id=settlement_id_president;
                settlement_title=settlement_title_president;
            }
//                    alert(settlement_title);
            $.ajax({
                url: base_url + "index.php/wordapp/delete_settlement",
                type: "POST",
                data: {
                    settlement_id: settlement_id
                },
                async: false,
                cache: false,
                dataType: "text",
                success: function (response, textStatus, jqXHR) {
                    var response_val = response.trim();
//                    alert(response_val);
                    if (response_val=='success') {
                        $("#delete_confirm_alert").removeClass('show').addClass('hide');
                        var settlement_letter_choice_id = localStorage.getItem("settlement_letter_choice_id");
                        if(login_user_id2==126 || login_user_id2==123 || login_user_id2==124){
                            if(settlement_letter_choice_id=='settlement_letter_choice4')
                                var id='admin_settlement_letter_choice4';
                            else if(settlement_letter_choice_id=='settlement_letter_choice5')
                                var id='admin_settlement_letter_choice5';
                            else if(settlement_letter_choice_id=='settlement_letter_choice77')
                                var id='admin_settlement_letter_choice77';
                            get_all_settlement_data_for_admin(id);
                        }else{
                            $("#" + settlement_letter_choice_id).trigger('click');
                        }

//                                window.location = base_url + 'index.php/wordapp/view_settlement_form/';
//                                $('#settlement_letter_choice4').trigger('click');
                    }


                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                    alert(textStatus);
                }
            });

        });


        $("#delete_partner_button_settlement").on('click', function (event) {

//            alert($('.enable_to_multi_share1').children('.partner_id').val());
            $("#table_of_partner tr").removeClass('enable_to_multi_share1');
            $("#enable_email_multi_share").val(0);
            $("#delete_partner_yes").val(1);
            $("#send_email_form_partner_addto").addClass('btn-success');
            $("#send_email_form_partner_addto").css("background-color", "#419641");
            $("#email_share_navi_user_list").removeClass('show').addClass('hide');
            $("#email_share_navi_message_aria").removeClass('show').addClass('hide');

            var partner_id = $(".edit_partner").children('.partner_id').val();
            if (partner_id === undefined) {
                $("#delete_email_partner_message").show();
                $("#eidt_email_partner_message").removeClass('show').addClass('hide');
            } else {
                if($(".edit_partner .input_partner_name").val()!='')
                    var partner_name = $(".edit_partner .input_partner_name").val();
                else if($(".edit_partner .input_partner_mobile").val()!='')
                    var partner_name = $(".edit_partner .input_partner_mobile").val();
//                alert(partner_name);
                $("#delete_partner_confirmation_popup").show();
//                $("#delete_email_partner_message_confirm").show();
                $("#delete_email_partner_message").hide();
                $('#show_delete_partner_name1').text(partner_name);
            }
//            alert(partner_id);
        });

        $("#settlement_trash_folder").click(function (event) {
            event.preventDefault();
//            alert('hi');
            $("#settlement_list_trash").show();
            $("#settlement_list").hide();
            $("#button_aria").hide();
            $("#button_aria_trash").show();
            var login_user_id2 = $("#login_user_id2").val();
            var login_user_id = $("#login_user_id").val();
            var created_by = $("#created_by").val();
            var is_share = $("#is_share").val();
            $('.span-title-list-files').text('ゴミ箱');
            // alert(login_user_id);
            var start_from = 0;
            var word_list_limit = $("#word_limit_list").val();
            var url = $("#base_url").val() + 'index.php/wordapp/get_all_settlement_data/';
            //check
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    login_user_id: login_user_id,
                    start_from: start_from,
                    view_type: 10, //trash view
                    is_share: is_share,
                    created_by: created_by
                },
            })
                .done(function (html) {
//alert(html);
                    document.getElementById('settlement_list_trash').innerHTML = html;

                    $("td.settlement_title").each(function () {
                        var DELAY = 1000, clicks = 0, timer = null;
                        $(this).on("click", function () {

                            var settlement_id = $(this).children('.settlement_id').val();
                            var is_share = $(this).children('.is_share').val();
                            var president_seal_id = $(this).children('.president_seal_id').val();
                            clicks++;  //count clicks

                            if(president_seal_id==1){
                                $('td.settlement_title').css({"border": ""});
                                $('td.settlement_title').removeClass("checked_list");
                                $('td.settlement_title').removeClass("checked_list_president");
                                $(this).css({"border":"2px solid blue", "background-color":"lightpink"});
                                $(this).addClass("checked_list_president");
                            }else{
                                $('td.settlement_title').css({"border": ""});
                                $('td.settlement_title').removeClass("checked_list");
                                $('td.settlement_title').removeClass("checked_list_president");
                                $(this).addClass("checked_list");
                            }
                            if (clicks === 1) {
                                $("#select_settlement").removeClass('show').addClass('hide');
                                timer = setTimeout(function () {

                                    clicks = 0;  //after action performed, reset counter
                                    if (settlement_id !== undefined) {
                                        // alert(settlement_id);
                                        $(this).addClass("checked_list");
                                    } else {
                                        $('td.settlement_title').removeClass("checked_list");
                                    }
                                }, DELAY);

                            } else {
//                                alert('hi');die();
                                clearTimeout(timer);    //prevent single-click action
                                clicks = 0;             //after action performed, reset

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
                                var base_url = $("#base_url").val();
//                                var is_share = $("#is_share").val();

                                if (is_share == 1) {
                                    var share_this_settlement_id = 1;
                                } else {
                                    var share_this_settlement_id = 0;
                                }

                                var back_one_step = 2;
                                $("#view_settlement_letter").removeClass("hide").addClass("show");
                                if(login_user_id2==126 || login_user_id2==123 || login_user_id2==124){
                                    share_this_settlement_id=1;
                                    window.open(base_url + 'index.php/wordapp/view_settlement_form_2/' + settlement_id + '/' + share_this_settlement_id + '/' + back_one_step, "_self", style);

                                }else{
                                    window.open(base_url + 'index.php/wordapp/view_settlement_form_2/' + settlement_id + '/' + share_this_settlement_id + '/' + back_one_step, "_self", style);

                                }

                                // $.ajax({
                                //     url: "index.php/wordapp/get_settlement_data_by_id",
                                //     type: 'POST',
                                //     data: {settlement_id: settlement_id},
                                // })
                                //     .done(function (data) {
                                //         var post_data = JSON.parse(data);
                                //         $(" #settlement_id ").val(post_data.settlement_id)
                                //         // $("#view_settlement_letter").removeClass("show").addClass("hide");
                                //         alert('open settlement form page');
                                //
                                //
                                //         console.log("success");
                                //     })
                                //     .fail(function () {
                                //         console.log("error");
                                //     })
                                //     .always(function () {
                                //         console.log("complete");
                                //     });
                            }
                        });
                    });
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
//                var total_user_post = $("#total_user_post").val();
//                if (total_user_post < 30) {
//                    $("#word_next_page").attr('disabled', 'disabled');
//                }
//                $("#word_previous_page").attr('disabled', 'disabled');
                    var total_user_post = $("#total_settlement_data").val();
                    if (total_user_post < 30) {
                        $("#settlement_next_page").attr('disabled', 'disabled');
                    }
                    $("#settlement_previous_page").attr('disabled', 'disabled');
                    console.log("complete");
                });

        });

        $("#settlement_restore_file").click(function () {
//            $("#delete_confirm_alert").removeClass('hide').addClass('show');
//            die();
            var settlement_id = $(".checked_list").children('.settlement_id').val();
            var president_seal_id = $(".checked_list_president").children('.president_seal_id').val();
            var settlement_id_president = $(".checked_list_president").children('.settlement_id').val();
            var settlement_title = $(".checked_list").text();
            var settlement_title_president = $(".checked_list_president").text();
            var base_url = $("#base_url").val();
            if(president_seal_id == 1){
                settlement_id=settlement_id_president;
                settlement_title=settlement_title_president;
            }else{

            }
            if (settlement_id === undefined) {
                $("#select_settlement").removeClass('hide').addClass('show');

                $("#close_settlement").click(function (event) {
                    $("#select_settlement").removeClass('show').addClass('hide');
                    return false;
                });

                return false;
            } else {
                $.ajax({
                    url: base_url + "index.php/wordapp/restore_settlement_from_trash",
                    type: "POST",
                    data: {
                        settlement_id: settlement_id
                    },
                    async: false,
                    cache: false,
                    dataType: "text",
                    success: function (response, textStatus, jqXHR) {
                        var response_val = response.trim();
//                            alert(response_val);die();
                        if (response_val) {
                            $("#settlement_trash_folder").click();
                        }


                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //if fails
                        alert(textStatus);
                    }
                });
            }
        });


        $("#delete_confirm_partner_button_settlement").on('click', function (event) {
            var partner_id = $(".edit_partner").children('.partner_id').val();
            var base_url = $("#base_url").val();
            $("#delete_partner_yes").val(0);
            $.ajax({
                url: base_url + "index.php/api/emailing/delete_partner",
                type: "POST",
                data: {
                    partner_id: partner_id
                },
                async: false,
                cache: false,
                dataType: "text",
                success: function (response, textStatus, jqXHR) {
                    var response_val = response.trim();
//                alert(response_val);die();
                    $('#delete_email_partner_message_confirm').show();
                    $('#delete_partner_confirmation_popup').hide();

                    var partner_name = $(".edit_partner .input_partner_name").val();
                    $('#show_delete_partner_name').text(partner_name);
//                        setTimeout(function () {
//                            $('#delete_email_partner_message_confirm').fadeOut(600);
//                        }, 5000);
                    $('#delete_email_partner_message').hide();
                    get_user_partners();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                    alert(textStatus);
                }
            });
//            alert(partner_id);
        });

//        $("#edit_partner_button_settlement_popup").on('click', function (event) {
//            $("#eidt_email_partner_message").removeClass('show').addClass('hide');
//        });

        $("#edit_confirm_partner_button_settlement").on('click', function (event) {
            $("#edit_partner_confirmation_popup").hide();
            var partner_id = $(".edit_partner").children('.partner_id').val();
            var partner_name = $(".edit_partner .input_partner_name").val();
            var partner_company = $(".edit_partner .input_partner_compay").val();
            var partner_mobile = $(".edit_partner .input_partner_mobile").val();
            $("#edit_partner_yes").val(0);

            // $("#email_partner_form").addClass('hide');
            // Hide List input field
            $(".input_partner_mobile").removeClass('show').addClass('hide');
            $(".input_partner_name").removeClass('show').addClass('hide');
            $(".input_partner_compay").removeClass('show').addClass('hide');


            // Show Input field
            $(".show_partner_mobile").removeClass('hide').addClass('show');
            $(".show_partner_name").removeClass('hide').addClass('show');
            $(".show_partner_company").removeClass('hide').addClass('show');

            $(".edit_partner .input_partner_name").removeClass('hide').addClass('show');
            $(".edit_partner .show_partner_name").removeClass('show').addClass('hide');

            $(".edit_partner .input_partner_compay").removeClass('hide').addClass('show');
            $(".edit_partner .show_partner_company").removeClass('show').addClass('hide');

            $(".edit_partner .input_partner_mobile").removeClass('hide').addClass('show');
            $(".edit_partner .show_partner_mobile").removeClass('show').addClass('hide');
        });

        $("#edit_partner_button_settlement").on('click', function (event) {
            event.preventDefault();
            $("#table_of_partner tr").removeClass('enable_to_multi_share1');
            $("#enable_email_multi_share").val(0);
            $("#edit_partner_yes").val(1);

            $("#send_email_form_partner_addto").addClass('btn-success');
            $("#send_email_form_partner_addto").css("background-color", "#419641");
            $("#email_share_navi_user_list").removeClass('show').addClass('hide');

            $("#delete_email_partner_message").hide();

            $("#eidt_email_partner_message").removeClass('hide').addClass('show');
            $("#email_share_navi_user_list").removeClass('show').addClass('hide');
            $("#email_share_navi_message_aria").removeClass('show').addClass('hide');

            $(".edit_partner").removeClass('active').addClass('danger');
            var partner_id = $(".edit_partner").children('.partner_id').val();
            var partner_name = $(".edit_partner .input_partner_name").val();
            if (partner_id) {
                $("#delete_email_partner_message").hide();
                $("#edit_partner_confirmation_popup").show();
                $("#eidt_email_partner_message").removeClass('show').addClass('hide');
                $('#show_edit_partner_name').text(partner_name);
            }
            die();
            var partner_name = $(".edit_partner .input_partner_name").val();
            var partner_company = $(".edit_partner .input_partner_compay").val();
            var partner_mobile = $(".edit_partner .input_partner_mobile").val();

            // $("#email_partner_form").addClass('hide');
            // Hide List input field
            $(".input_partner_mobile").removeClass('show').addClass('hide');
            $(".input_partner_name").removeClass('show').addClass('hide');
            $(".input_partner_compay").removeClass('show').addClass('hide');


            // Show Input field
            $(".show_partner_mobile").removeClass('hide').addClass('show');
            $(".show_partner_name").removeClass('hide').addClass('show');
            $(".show_partner_company").removeClass('hide').addClass('show');

            $(".edit_partner .input_partner_name").removeClass('hide').addClass('show');
            $(".edit_partner .show_partner_name").removeClass('show').addClass('hide');

            $(".edit_partner .input_partner_compay").removeClass('hide').addClass('show');
            $(".edit_partner .show_partner_company").removeClass('show').addClass('hide');

            $(".edit_partner .input_partner_mobile").removeClass('hide').addClass('show');
            $(".edit_partner .show_partner_mobile").removeClass('show').addClass('hide');

        });


        // start new partner add and edit
        var partner_form = $("#email_partner_form");
        partner_form.submit(function (event) {
            event.preventDefault();
//            alert('hi');
            var edit_partner_id = $("#edit_partner_id").val();
            var edit_partner_name = $("#edit_partner_name").val();
            var edit_partner_company = $("#edit_partner_company").val();
            var edit_partner_mobile = $("#edit_partner_mobile").val();
            var partner_name_edit = $(".input_partner_name").val();
            var partner_mobile_edit = $(".input_partner_mobile").val();

            var partner_name = $("#partner_name").val();
            var company = $("#company").val();
            var partner_mobile = $("#partner_mobile").val();
//             alert(partner_name)
            // if (partner_name != " " && partner_mobile != " ") {
            if (partner_name != " " || partner_mobile != " ") {
                save_partner1(1);
            }

            if (partner_name_edit != " " || partner_mobile_edit != " ") {
                save_edit_partner1();
            }

        });
        // end new partner add and edit

        $("#president_add_as_partner_button").click(function (event) {
            var partner_name = $("#new_partner_name").val('');
            var partner_mobile = $("#new_partner_mobile").val('');

            $("#new_partner_registration_form").show();
            $("#partner_registration_text").hide();
            $("#president_registration_text").show();

        });
        $("#add_new_email_partner").click(function (event) {
            var partner_name = $("#new_partner_name").val();
            var company = $("#new_partner_company").val();
            var partner_mobile = $("#new_partner_mobile").val();
            // alert(partner_name1)
            // if (partner_name != " " && partner_mobile != " ") {
            if (partner_name != " " || partner_mobile != " ") {
                save_partner1(2);
            }

        });

        function save_partner1(id) {
//            alert('hiSave'+id);die();
            var base_url = $("#base_url").val();
            var url = base_url + "index.php/api/emailing/save_partner";
            var api_key = $('#api_key').val();
            var user_id = $("#user_id").val();
            if (id == 1) {
                var partner_name = $("#partner_name").val();
//                var company = $("#company").val();
                var company = '';
                var partner_mobile = $("#partner_mobile").val();
            } else {
                var partner_name = $("#new_partner_name").val();
//                var company = $("#new_partner_company").val();
                var company = '';
                var partner_mobile = $("#new_partner_mobile").val();
            }
//            alert(partner_mobile);
//            if (partner_name != '') {
//                $("#add_email_partner_message_confirm").show();
//                $("#edit_email_partner_message_confirm").hide();
//
//            } else {
//                $("#add_email_partner_message_confirm").hide();
//                $("#edit_email_partner_message_confirm").show();
//            }

            if ((api_key != "") && (user_id != "") && (partner_name != undefined && partner_name != "") && (partner_mobile != "")) {

                $.ajax({
                    url: url,
                    cache: false,
                    type: 'POST',
                    beforeSend: function () {
                        $("#ajax_loading_aria").show();
                    },
                    data: JSON.stringify({
                        api_key: api_key,
                        user_id: user_id,
                        partner_name: partner_name,
                        company: company,
                        partner_mobile: partner_mobile,
                        partner_type: 1 // 1: as it is create from settlement/requisition form
                    }),
                    contentType: "application/json",
                })
                    .done(function (data) {
//                        alert(data);die();
                        $("#ajax_loading_aria").hide();
                        $("#new_partner_registration_form").hide();

//                        if(partner_mobile=='1010'){
//                            $("#president_add_navi").hide();
//                        }

//                        console.log(data);
//                        die();
                        var data = JSON.parse(data);
                        if (data.message == 'success') {
                            if (partner_name != '') {
                                $("#add_email_partner_message_confirm").show();

                                if(data.check_email_partners_president == 0 && partner_mobile!='saisyuukessaisya'){ //1010
                                    setTimeout(function () {
                                        $("#president_add_navi").show();
                                    }, 2000);
                                }else{
                                    $("#president_add_navi").hide();
                                }


                                $("#edit_email_partner_message_confirm").hide();

                            } else {
                                $("#add_email_partner_message_confirm").hide();
                                $("#edit_email_partner_message_confirm").show();
                            }
                            $("#email_share_navi_message_aria").show();
                            $("#new_partner_registration_form").hide();
                            get_user_partners();
                        } else if (data.message == 'invalid partner') {
                            $("#new_partner_registration_form").hide();
                            $("#invalid_partner_error_message").show();
                            $("#email_share_navi_message_aria").removeClass('show').addClass('hide');
                        } else if (data.message == 'ユーザー名既に存在します。') {
                            $("#new_partner_registration_form").hide();
                            $("#already_exist_partner_error_message").show();
                            $("#email_share_navi_message_aria").removeClass('show').addClass('hide');
                        }else {
//                            alert(data.message);
                            $("#partner_mobile").focus();
                            $(".form-group").addClass('has-error');
                        }
                        console.log("success");
                    })
                    .fail(function () {
                        $(".form-group").addClass('has-error');
                        console.log("error");
                    })
                    .always(function () {
                        $("#ajax_loading_aria").hide();
                        console.log("complete");
                    });
            } else {
                $("#new_partner_name").val('');
                $("#new_partner_company").val('');
                $("#new_partner_mobile").val('');

                $("#email_share_navi_message_aria").hide();
                $("#new_partner_registration_form").show();
                $("#partner_registration_text").show();
                $("#president_registration_text").hide();
            }
        }

        function save_edit_partner1() {
//            alert('hiE');die();
            $("#edit_partner_confirmation_popup").hide();
            var base_url = $("#base_url").val();
            var url = base_url + "index.php/api/emailing/save_edit_partner";
            var api_key = $('#api_key').val();
            var user_id = $("#user_id").val();

            var edit_partner_id = $(".edit_partner").children('.partner_id').val();
            var partner_name = $(".edit_partner .input_partner_name").val();
            var company = $(".edit_partner .input_partner_compay").val();
            var partner_mobile = $(".edit_partner .input_partner_mobile").val();

            if ((api_key != "") && (user_id != "") && (partner_name != undefined && partner_name != "") && (partner_mobile != "")) {

                $.ajax({
                    url: url,
                    cache: false,
                    type: 'POST',
                    beforeSend: function () {
                        $("#ajax_loading_aria").show();
                        $("#new_partner_registration_form").hide();
                    },
                    data: JSON.stringify({
                        api_key: api_key,
                        user_id: user_id,
                        partner_id: edit_partner_id,
                        partner_name: partner_name,
                        company: company,
                        partner_mobile: partner_mobile,
                        partner_type: 1 // 1: as it is create from settlement/requisition form
                    }),
                    contentType: "application/json",
                })
                    .done(function (data) {
                        $("#ajax_loading_aria").hide();
//                        $("#edit_email_partner_message_confirm").show();
//                        $("#add_email_partner_message_confirm").hide();
                        var data = JSON.parse(data);
                        if (data.message == 'success') {
                            $("#add_email_partner_message_confirm").hide();
                            $("#edit_email_partner_message_confirm").show();
                            $("#partner_edit_aria").addClass('hide').removeClass('show');
                            $("#new_partner_registration_form").hide();
                            get_user_partners();
                        } else if (data.message == 'invalid partner') {
                            $("#new_partner_registration_form").hide();
                            $("#invalid_partner_error_message").show();
                            $("#email_share_navi_message_aria").removeClass('show').addClass('hide');
                        } else {
//                            alert(data.message);
                            $("#partner_mobile").focus();
                            $(".form-group").addClass('has-error');
                        }
                        console.log("success");
                    })
                    .fail(function () {
                        $(".form-group").addClass('has-error');
                        console.log("error");
                    })
                    .always(function () {
                        $("#ajax_loading_aria").hide();
                        console.log("complete");
                    });
            } else {
//                $("#new_partner_registration_form").show();
            }
        }

    });

    function limitTextarea(textarea, maxLines, maxChar) {
//        var getHtml=document.querySelectorAll("span#test_dom");
//        for (var i2 = 0; i2 < getHtml.length; i2++) {
//            var str=getHtml[0].innerHTML;
//            alert(str);die();
//            if(str ==String.fromCharCode(160)){
//                var getHtml1 = getHtml[i2].innerHTML.replace('&nbsp;', '');
//                getHtml[i2].innerHTML=getHtml1;
//            }
//
//        }
//
//
//die();
        var president_seal_id = $("#president_seal_id").val();
        if(president_seal_id!=0){
            document.execCommand('delete');
            document.getElementById('conclusion').contentEditable = false;
            document.getElementById('reason').contentEditable = false;
            document.getElementById('case_study').contentEditable = false;
            document.getElementById('others').contentEditable = false;
            $("#approval_seal_message_div").show();
//            return false;
        }

        var lines = textarea.value.replace(/\r/g, '').split('\n'), lines_removed, char_removed, i;
        if (maxLines && lines.length > maxLines) {
            lines = lines.slice(0, maxLines);
            lines_removed = 1
            $("#textarea_exit_maxlength_error").show();
        }
        if (maxChar) {
            i = lines.length;
            while (i-- > 0) if (lines[i].length > maxChar) {
                lines[i] = lines[i].slice(0, maxChar);
                char_removed = 1
                $("#textarea_exit_maxlength_error").show();
            }
            if (char_removed || lines_removed) {
                textarea.value = lines.join('\n')
                $("#textarea_exit_maxlength_error").show();
            }

        }

    }

    function delete_decode_base64image_from_folder_for_ie() {

        var base_url = $("#base_url").val();
        var decoded_image_name_for_ie = $("#decoded_image_name_for_ie").val();
//                    alert(decoded_image_name_for_ie);
        $.ajax({
            url: base_url + "index.php/wordapp/delete_decode_base64image_from_folder_for_ie",
            type: "POST",
            data: {
                crop_image_name: decoded_image_name_for_ie
            },
            async: false,
            cache: false,
            dataType: "text",
            success: function (response, textStatus, jqXHR) {
                var response_val = response.trim();

            },
            error: function (jqXHR, textStatus, errorThrown) {
                //if fails
                alert(textStatus);
            }
        });
    }

    function js_word_count(obj) {
        var value = obj.value;
        var length = value.length;
//        alert(length);
        if (length > 300) {
            value = value.substring(0, 299);
            obj.value = value;
            length = 300;
        }
        var remain = 300 - length;
//        document.getElementById('content_remaining').innerHTML=""+remain+" characters remaining.";
        if (value.length == 300) {
            $("#textarea_exit_maxlength_error").show();
//            alert("300文字以上は書き込めません");
        }

//        alert(value.length);
    }

    //    function validate_settlement_form() {
    //        setTimeout(function () {
    //            submit_settlement_form();
    //        }, 1000);
    //    }


    function remove_all_placeholder() {
        var arr = $('.hidden_span');
        arr.css('visibility', 'hidden');
        $('#settlement_title').attr('placeholder', '');
        $('#conclusion').attr('placeholder', '');
        $('#reason').attr('placeholder', '');
        $('#case_study').attr('placeholder', '');
        $('#others').attr('placeholder', '');
    }

    function validate_settlement_form(id) {
        //alert("Hii");
        if(id==2){
            if($("#settlement_title").val()=='')
                var settlement_title = $("#settlement_title").val('件名がありません');
            else
                var settlement_title = $("#settlement_title").val();
            if($("#name_printing").val()=='')
                var name_printing = $("#name_printing").val('名前がありません');
            else
                var name_printing = $("#name_printing").val();

            var partner_share_enable = $("#partner_share_enable").val(2);

        }else{
            var settlement_title = $("#settlement_title").val();
            var name_printing = $("#name_printing").val();
            var deployment_name = $("#deployment_name").val();
            var settlement_id = $("#settlement_id").val();
        }


        if (settlement_id == 0) {
            localStorage.setItem("name_printing", name_printing);
            localStorage.setItem("deployment_name", deployment_name);
            var name_printing = localStorage.getItem("name_printing");
            var deployment_name = localStorage.getItem("deployment_name");
        }

//        console.log(settlement_title);
        var base_url = $("#base_url").val();
        if ($("#is_share").val() == 1)
            var share_this_settlement_id = 1;
        else
            var share_this_settlement_id = 0;
        var president_seal_id = $("#president_seal_id").val();

        if(president_seal_id!=0){
            document.getElementById('conclusion').contentEditable = false;
            document.getElementById('reason').contentEditable = false;
            document.getElementById('case_study').contentEditable = false;
            document.getElementById('others').contentEditable = false;
            $("#approval_seal_message_div").show();
//            return false;
        }

        if (settlement_title != '' && name_printing != '') {
            if (settlement_id == 0) {
                $('#share_settlement_form').prop('disabled', true);
                document.getElementById('conclusion').contentEditable = false;
                document.getElementById('reason').contentEditable = false;
                document.getElementById('case_study').contentEditable = false;
                document.getElementById('others').contentEditable = false;
                $('#document_loader').show();
            }
//            die();
//            alert("Hii");
//            setTimeout(function () {
            $("#settlement_title_empty_message").hide();
//            $("#approval_seal_message_div").hide();
            $("#settlement_title").removeClass('required_input');
            $("#name_printing").removeClass('required_input');
            //alert(isFormValid);
//            if (settlement_id == 0) {
//                $("#save_settlement_letter_form_message").show();
//            } else {
//                $("#edit_settlement_letter_form_message").show();
//            }


            var settlement_letter_form = document.getElementById("settlement_letter_form");
            var form_data = new FormData(settlement_letter_form);
//            var formData = new FormData($(this)[0]);
            form_data.append('conclusion', $('#conclusion').html());
            form_data.append('case_study', $('#case_study').html());
            form_data.append('reason', $('#reason').html());
            form_data.append('others', $('#others').html());
            $.ajax({
                url: base_url + "index.php/wordapp/save_settlement_letter_form",
                data: form_data,
                cache: false,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (response, textStatus, jqXHR) {

                    var response_val = response.trim();
//                    console.log(response_val);die();
                    var response_val_array = response_val.split('######');
                    var get_settlement_id = response_val_array[0];
                    var doc_exist = response_val_array[1];
//                    console.log('success');
//                            die();
                    if (get_settlement_id > 0) {
                        $("#settlement_id").val(get_settlement_id);

                    } else {

                    }
                    var settlement_id2 = $("#settlement_id").val();

                    var partner_share_enable2 = $("#partner_share_enable").val();
                    if(partner_share_enable2==2){
                        $('#document_loader').hide();
                        $("#share_settlement_form").trigger('click');
                    }else{
                        if (doc_exist == 1 && settlement_id2 > 0) {

                            $('#document_loader').hide();
                            window.location = base_url + 'index.php/wordapp/view_settlement_form/' + settlement_id2 + '/' + share_this_settlement_id;
                        } else {
                            $('#document_loader').hide();
                        }
                    }






//                    var settlement_id2 = $("#settlement_id").val();
//                    $("#save_settlement_letter_form_message").show();
//                        if (settlement_id2 == 0) {
//                            $("#save_settlement_letter_form_message").show();
//                        } else {
//                            $("#edit_settlement_letter_form_message").show();
//                        }


                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
//                    alert(textStatus);
                }
            });

//            setTimeout(function () {
//                $("#settlement_letter_form").submit();
//            }, 7000);

//            }, 1000);
        } else {
            if (settlement_title == '') {
                $("#settlement_title").addClass('required_input');

            } else {
                $("#settlement_title").removeClass('required_input');
            }
            if (name_printing == '') {
                $("#name_printing").addClass('required_input');

            } else {
                $("#name_printing").removeClass('required_input');
            }

            if (id == 1)
                $("#enter_settlement_title_message").hide();
            else
                $("#enter_settlement_title_message").hide();
            return false;
        }
//        if (share_this_settlement_id == 1) {
//            $(':input').attr('readonly', 'readonly');
//            return false;
//        }

    }


    function show_seal_image_password_form(id) {
//        alert(id);
        $("#seal_image_password_form").show();
//        $("#done_configuration_seal_image_insert_message1").show();
        var seal_image_type = $("#seal_image_type").val(id);
        if(id==1){
            $("#div_1").addClass("border_red").removeClass("border_white");
            $("#div_2").addClass("border_white").removeClass("border_red");
            $("#div_3").addClass("border_white").removeClass("border_red");
            $("#div_4").addClass("border_white").removeClass("border_red");
            $("#div_5").addClass("border_white").removeClass("border_red");
        }

        if(id==2){
            $("#div_2").addClass("border_red").removeClass("border_white");
            $("#div_1").addClass("border_white").removeClass("border_red");
            $("#div_3").addClass("border_white").removeClass("border_red");
            $("#div_4").addClass("border_white").removeClass("border_red");
            $("#div_5").addClass("border_white").removeClass("border_red");
        }
        if(id==3){
            $("#div_3").addClass("border_red").removeClass("border_white");
            $("#div_1").addClass("border_white").removeClass("border_red");
            $("#div_2").addClass("border_white").removeClass("border_red");
            $("#div_4").addClass("border_white").removeClass("border_red");
            $("#div_5").addClass("border_white").removeClass("border_red");
        }
        if(id==4){
            $("#div_4").addClass("border_red").removeClass("border_white");
            $("#div_1").addClass("border_white").removeClass("border_red");
            $("#div_3").addClass("border_white").removeClass("border_red");
            $("#div_2").addClass("border_white").removeClass("border_red");
            $("#div_5").addClass("border_white").removeClass("border_red");
        }
        if(id==5){
            $("#div_5").addClass("border_red").removeClass("border_white");
            $("#div_1").addClass("border_white").removeClass("border_red");
            $("#div_3").addClass("border_white").removeClass("border_red");
            $("#div_4").addClass("border_white").removeClass("border_red");
            $("#div_2").addClass("border_white").removeClass("border_red");
        }
        $("#seal_image_password").val('');
        $("#seal_image_password").focus();
    }

    function seal_image_password_form_close() {
        $("#seal_image_password_form").hide();
    }

    function change_seal_image(id) {
        var current_password = $("#seal_image_current_password").val();
        var new_password = $("#seal_image_new_password").val();
        var seal_image_type = $("#seal_image_type").val();
        var base_url = $("#base_url").val();

        if (id == 'change_seal_image') {
            $("#seal_image_change_password_confirmation_popup").show();
            $("#seal_image_password_form").hide();
        }
        if (id == 'change_seal_image_complete') {

//        alert(seal_image_type);die();
//        $('.wait_for_saving').show();

            $("#seal_image_new_password_step_2").val('');
            if (current_password != '' && new_password != '') {
                $("#seal_image_current_password").removeClass('required').addClass('pass_style');
                $("#seal_image_new_password").removeClass('required').addClass('pass_style');
                $.ajax({
                    url: base_url + "index.php/wordapp/change_seal_image_password",
                    type: "POST",
                    data: {
                        password: new_password,
                        current_password: current_password,
                        seal_image_type: seal_image_type,
                        change_seal_image_step_2: 1
                    },
                    async: false,
                    cache: false,
                    dataType: "text",
                    success: function (response, textStatus, jqXHR) {
                        var response_val = response.trim();
//                alert(response_val);die();
                        if (response_val == 2) {
                            $("#password_exist_message").show();
                        } else if (response_val == 3) {
                            $("#incorrect_password_message").show();
                            $("#incorrect_password_text").html('パスワードが間違っています。<br> または、印鑑の登録がありません。');
                        } else {
                            $("#seal_image_password_form_step_2").show();
                            $("#seal_image_password_form").hide();
                            $("#seal_image_change_password_form").hide();

//                            $('#seal_image_change_password_confirmation_message').show();
//                            $('#seal_image_password_form').hide();
//                            $("#seal_image_change_password_form").hide();

                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //if fails
                        alert(textStatus);
                    }
                });
            } else {
                $("#seal_image_current_password").removeClass('pass_style').addClass('required');
                $("#seal_image_new_password").removeClass('pass_style').addClass('required');

                return false;
            }
        }

        if (id == 'change_seal_image_complete1') {
            var new_password_step_2 = $("#seal_image_new_password_step_2").val();

            if (new_password_step_2 != '') {
                $("#seal_image_new_password_step_2").removeClass('required').addClass('pass_style');
                $.ajax({
                    url: base_url + "index.php/wordapp/change_seal_image_password",
                    type: "POST",
                    data: {
                        password: new_password,
                        current_password: current_password,
                        seal_image_type: seal_image_type
                    },
                    async: false,
                    cache: false,
                    dataType: "text",
                    success: function (response, textStatus, jqXHR) {
                        var response_val = response.trim();
//                alert(response_val);die();
                        if (response_val == 2) {
                            $("#password_exist_message").show();
                        } else if (response_val == 3) {
                            $("#incorrect_password_message").show();
                            $("#incorrect_password_text").html('パスワードが間違っています。<br> または、印鑑の登録がありません。');
                        } else {
                            $('#seal_image_change_password_confirmation_message').show();
                            $('#password_change_complete_text').text(new_password_step_2);
                            $('#seal_image_password_form').hide();
                            $("#seal_image_change_password_form").hide();
                            $("#seal_image_password_form_step_2").hide();

                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //if fails
                        alert(textStatus);
                    }
                });
            } else {
                $("#seal_image_new_password_step_2").removeClass('pass_style').addClass('required');
                return false;
            }
        }


        if (id == 'yes') {
//            $("#seal_image_current_password").val('');
            $("#seal_image_new_password").val('');

            $("#seal_image_change_password_form").show();
            $("#seal_image_change_password_confirmation_popup").hide();

            $.ajax({
                url: base_url + "index.php/wordapp/get_latest_seal_password_userwise",
                type: "POST",
                data: {},
                async: false,
                cache: false,
                dataType: "text",
                success: function (response, textStatus, jqXHR) {
                    var response_val = response.trim();
//                alert(response_val);die();
                    $("#seal_image_current_password").val(response_val);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                    alert(textStatus);
                }
            });

        }
        else if (id == 'no') {
            $("#seal_image_change_password_confirmation_popup").hide();
            $("#seal_image_password_form").show();
        }

    }

    function forgot_seal_image_password(id) {
        if (id == 'forgot_seal_image_password') {
            $("#forgot_seal_image_password_form").show();
            $("#seal_image_change_password_form").hide();
            $("#seal_image_forgot_password").focus();
        } else if (id == 'seal_image_forgot_password_done') {
            var seal_image_forgot_password = $("#seal_image_forgot_password").val();
            var user_login_password = $("#user_login_password").val();
            var base_url = $("#base_url").val();
            $.ajax({
                url: base_url + "index.php/wordapp/forgot_seal_image_password",
                type: "POST",
                data: {
                    seal_image_forgot_password: seal_image_forgot_password,
                    user_login_password: user_login_password
                },
                async: false,
                cache: false,
                dataType: "text",
                success: function (response, textStatus, jqXHR) {
                    var response_val = response.trim();
//                alert(response_val);die();
                    $('#forgot_password_message').show();
                    if (response_val == 3) { //old password not registered
                        document.getElementById('forgot_password_message_text').innerText = 'は、印鑑の登録がありません。';
                        $('#password_exist_message').hide();
                    } else if (response_val == 0) { //same password
                        $('#password_exist_message').show();
                        $('#forgot_password_message').hide();
                    } else { // success
//                        $('#forgot_password_message_text').show();
                        document.getElementById('forgot_password_message_text').innerText = '印鑑のパスワードを ' + seal_image_forgot_password + ' に変更しました。';
                        $('#forgot_seal_image_password_form').hide();
                        $('#password_exist_message').hide();
                        $("#seal_image_forgot_password").val('');

                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                    alert(textStatus);
                }
            });
        }
    }

    function close_div_msg() {
        $("#eidt_email_partner_message").removeClass('show').addClass('hide');
    }

    function seal_image_change_password_form_close() {
        $("#seal_image_change_password_form").hide();
        $("#seal_image_password_form_step_2").hide();
        $("#seal_image_password_form_step_2").hide();
    }

    function configuration_seal_image() {
        $("#configuration_seal_image_form").show();
        $("#add_seal_image_password").val('');
        $("#seal_image_name").text('');
    }

    function show_configuration_yesno_popup() {
//        alert($("#add_seal_image_password").val());
//        if ($("#add_seal_image_password").val() == '') {
//            $("#add_seal_image_password").removeClass('pass_style').addClass('required');
//        } else {
//        $("#add_seal_image_password").removeClass('required').addClass('pass_style');
//        $("#configuration_seal_image_confirmation_popup").show();
        $("#done_configuration_seal_image_insert_message").show();
        $("#configuration_seal_image_form").hide();
        $("#seal_image_password_form").hide();

        $.each([1, 2, 3, 4, 5], function (index, value) {
            $('#' + value).css('pointer-events', 'none');
        });


//        }


    }

    function check_if_password_exist() {
        var password = $("#add_seal_image_password").val();
        var seal_image_type = $("#seal_image_type").val();
        var base_url = $("#base_url").val();

//        setTimeout(function () {
        $.ajax({
            url: base_url + "index.php/wordapp/insert_new_seal_image_password",
            type: "POST",
            data: {add_password: password, seal_image_type: seal_image_type, check_pass: 1},
            async: false,
            cache: false,
            dataType: "text",
            success: function (response, textStatus, jqXHR) {
                var response_val = response.trim();
//                alert(response_val);die();
                if (response_val == 2) { // password already exist
//                        $("#configuration_seal_image_confirmation_popup").show();
                    $("#configuration_seal_image_form").show();
                    $("#password_exist_message").show();
                }
//                    if (response_val == 1) {
//                        $("#done_configuration_seal_image_insert_message").show();
//                    }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //if fails
                alert(textStatus);
            }
        });
//        }, 1000);
    }

    function done_configuration_seal_image_insert(id) {
        //        else if (id == 'yes') {
//
//            $("#configuration_seal_image_confirmation_popup").hide();
////            $("#configuration_seal_image_form").show();
//            $("#done_configuration_seal_image_insert_message").show();
//
//        }
//        else if (id == 'show_configuration_seal_image_form') {
//            $("#add_seal_image_password").val('');
//            $("#configuration_seal_image_form").show();
//            $("#done_configuration_seal_image_insert_message").hide();
//        }

        if (id == 'no') {
            $("#configuration_seal_image_confirmation_popup").hide();
            $("#crop_seal_image_popup").hide();
            $("#webcam_popup").hide();
//            document.getElementById('results').innerHTML = '';
        } else if (id == 'show_configuration_seal_image_form') { //change_seal_image_complete1
//            var add_password = $("#add_seal_image_password").val();
            var add_password = $("#user_login_password").val();
//            if (add_password == '') {
//                $("#add_seal_image_password").removeClass('pass_style').addClass('required');
//            } else {
//                $("#add_seal_image_password").removeClass('required').addClass('pass_style');
            var seal_image_type = $("#seal_image_type").val();
//            var file_data1 = $('#add_seal_image').prop('files')[0];
//                var file_data1 = document.getElementById('add_seal_image').files[0];

            if ($("#final_cropped_seal_image").attr('src') != 'undefined') {
                var crop_image_name1 = $("#final_cropped_seal_image").attr('src');
//                console.log(crop_image_name1);
            }
//            if ($("#add_seal_image")[0].files.length != 0) {
//                console.log('hi');
//                die();
//            } else {
//                console.log('err');
//                die();
//            }

            var form_data1 = new FormData();
//                form_data1.append('userfile', file_data1);
            form_data1.append("add_password", add_password);
            form_data1.append("seal_image_type", seal_image_type);
            form_data1.append("crop_image_name", crop_image_name1);
            var base_url = $("#base_url").val();
//            console.log(file_data1);die();
            $.ajax({
                url: base_url + "index.php/wordapp/insert_new_seal_image_password",
                type: "POST",
                data: form_data1,
                async: false,
                cache: false,
                processData: false,
                contentType: false,
                dataType: "text",
                success: function (response, textStatus, jqXHR) {
                    var response_val = response.trim();
//                console.log(response_val);die();
                    if (response_val == 2) { // password already exist
//                        $("#configuration_seal_image_confirmation_popup").show();
                        $("#configuration_seal_image_form").show();
                        $("#password_exist_message").show();
                    }
                    if (response_val == 1) {
//                            $("#done_configuration_seal_image_insert_message1").show();
                        $("#done_configuration_seal_image_insert_message").hide();
                        $("#show_configuration_seal_image_form").hide();
                        $("#crop_seal_image_popup").hide();
                        $("#configuration_seal_image_form").hide();
                        $("#webcam_popup").hide();
                        $("#add_seal_image_password").removeClass('required').addClass('pass_style');

                        location.reload();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                    alert(textStatus);
                }
            });
            if ((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
            {
                delete_decode_base64image_from_folder_for_ie();
            }

//            }
        }
    }

    function done_approval_list_view_password_form() {
        var given_password = $("#approval_list_view_password").val();
//        var user_login_password = localStorage.getItem("user_login_password");
        var user_login_password = 6571;
        var base_url = $("#base_url").val();
//        $('.wait_for_saving').show();

        if (given_password == user_login_password) {
            $("#incorrect_password_message").hide();
            $("#approval_list_view_password_form").hide();
            $("#settlement_letter_choice77").trigger('click');
        } else {
            $("#incorrect_password_message").show();
            $("#incorrect_password_text").text('パスワードが間違っています。');
        }
    }


    function done_seal_image() {
//        var search_text = document.getElementById("search_criteria").value;
        var password = $("#seal_image_password").val();
        var seal_image_type = $("#seal_image_type").val();
//        alert(seal_image_type);
        var base_url = $("#base_url").val();
//        $('.wait_for_saving').show();
        $.ajax({
            url: base_url + "index.php/wordapp/get_seal_image_password_wise",
            type: "POST",
            data: {
                password: password,
                seal_image_type: seal_image_type
            },
            async: false,
            cache: false,
            dataType: "text",
            success: function (response, textStatus, jqXHR) {
                var response_val = response.trim();
//                alert(response_val);
//                die();
                if (response_val < 0) {
                    $("#incorrect_password_message").show();
                    $("#incorrect_password_text").html('パスワードが間違っています。<br> または、印鑑の登録がありません。');
//                    alert('パスワードが間違っているか、イメージが存在しません');
                } else {
                    var response_val_array = response_val.split('#####');
                    var img = response_val_array[0];
                    var seal_image_type = response_val_array[1];
//                    alert(seal_image_type);
                    var get_seal_id = response_val_array[2];


//                    var get_seal_image_type = $("#seal_image_type").val();
//                    if(get_seal_image_type==6){
//
//                    }else{
                    var arr = $('.hidden_span');
                    arr.css('visibility', 'hidden');
//                    }
//                    $.each([1, 2, 3, 4, 5], function (index, value) {
//                        if (value != get_seal_image_type)
//                            $('#' + value).css('pointer-events', 'none');
//                    });

//                    $('#click_here_text').hide();
                    $('#settlement_title').attr('placeholder', '');
                    $('#conclusion').attr('placeholder', '');
                    $('#reason').attr('placeholder', '');
                    $('#case_study').attr('placeholder', '');
                    $('#others').attr('placeholder', '');
                    if (seal_image_type == 1) {
                        $("#president_seal_id").val(get_seal_id);
                        $('#deployment_name').attr('readonly', true);
                        $('#name_printing').attr('readonly', true);
                        $('#settlement_title').attr('readonly', true);
                        $('#conclusion').attr('readonly', true);
                        $('#reason').attr('readonly', true);
                        $('#case_study').attr('readonly', true);
                        $('#others').attr('readonly', true);
                        $('#file_name').attr('readonly', true);
                        $('#delete_documents').addClass('decision_document_disable');
                        $(".btn-upload").addClass('decision_document_disable');
                    }
                    if (seal_image_type == 2) {
                        $("#examination1_seal_id").val(get_seal_id);
//                        $(".btn-upload").removeClass('decision_document_disable');
                    }
                    if (seal_image_type == 3) {
                        $("#examination2_seal_id").val(get_seal_id);
                    }
                    if (seal_image_type == 4) {
                        $("#examination3_seal_id").val(get_seal_id);
                    }
                    if (seal_image_type == 5) {
                        $("#examination4_seal_id").val(get_seal_id);
                    }
                    if (seal_image_type == 6) {
                        $("#name_printing_seal_id").val(get_seal_id);
                    }
//                $('#click_here_text').hide();
                    $('#seal_image_password_form').hide();


//                $('#wait_for_saving').hide();
//
                    if (seal_image_type == 5) {
                        $('#' + seal_image_type).html('');
                        $('#' + seal_image_type).html(img);

                    } else {
                        $('#' + seal_image_type).html('');
                        $('#' + seal_image_type).html(img);

                    }

                    validate_settlement_form();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //if fails
                alert(textStatus);
            }
        });
    }

    function on_hold_form() {
        var settlement_id = $("#settlement_id").val();
        var base_url = $("#base_url").val();
//        $('.wait_for_saving').show();
        $.ajax({
            url: base_url + "index.php/wordapp/update_hold_status_settlement",
            type: "POST",
            data: {
                settlement_id: settlement_id
            },
            async: false,
            cache: false,
            dataType: "text",
            success: function (response, textStatus, jqXHR) {
                var response_val = response.trim();
//                alert(response_val);
//                die();

                var on_hold = $("#on_hold").val();

                if(response_val==1){
                    $('.tblleft_under1,.tblleft_under,#share_settlement_form').css({
                        'pointer-events': 'none'
                    });
                    document.getElementById('conclusion').contentEditable = false;
                    document.getElementById('reason').contentEditable = false;
                    document.getElementById('case_study').contentEditable = false;
                    document.getElementById('others').contentEditable = false;
                    $('#deployment_name').attr('readonly', true);
                    $('#name_printing').attr('readonly', true);
                    $('#settlement_title').attr('readonly', true);
                    $('#conclusion').attr('readonly', true);
                    $('#reason').attr('readonly', true);
                    $('#case_study').attr('readonly', true);
                    $('#others').attr('readonly', true);
                    $('#file_name').attr('readonly', true);
                    $('#delete_documents').addClass('decision_document_disable');
                    $(".btn-upload").addClass('decision_document_disable');
                    $("#hold_style_settlement").show();

//            return false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //if fails
                alert(textStatus);
            }
        });
    }

    function delete_decision_documents(document_id) {
        var document_encrypted_name = $("#document_encrypted_name").val();
//        alert(document_encrypted_name);die();
        var settlement_id = $("#settlement_id").val();
//        alert(settlement_id);
        var base_url = $("#base_url").val();
//        $('.wait_for_saving').show();
        $.ajax({
            url: base_url + "index.php/wordapp/delete_documents",
            type: "POST",
            data: {
                document_encrypted_name: document_encrypted_name,
                settlement_id: settlement_id,
                document_id: document_id
            },
            async: false,
            cache: false,
            dataType: "text",
            success: function (response, textStatus, jqXHR) {
                var response_val = response.trim();
//                alert(response_val);
//                die();
                $('#delete_documents_message_confirm').show();
//                setTimeout(function () {
//                    $('#delete_documents_message_confirm').fadeOut(600);
//                }, 5000);
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //if fails
                alert(textStatus);
            }
        });
    }

    function changeTextareaFontColor(colorcode) {
        var selection;
        if (window.getSelection) {
            selection = window.getSelection();
        } else if (document.selection) {
            selection = document.selection.createRange();
        }
        if (selection.toString() != '') {
            document.execCommand('forecolor', false, colorcode);
            $('#font_color_area').show();
            $('#others').focus();
//            var editable_div_id = localStorage.getItem('editable_div_id');
//            $('#' + editable_div_id).focus();
        } else {
            document.execCommand('forecolor', false, colorcode);
            $('#font_color_area').show();
            $('#others').focus();
//            var editable_div_id = localStorage.getItem('editable_div_id');
//            $('#' + editable_div_id).focus();
            document.execCommand('insertTEXT', false, ' ');
        }
    }

    function showFontColorArea(id) {
//        if(id==1){
//            $("#font_color_area").hide();
//            $("#enter_comments_popup").show();
//        }else{
//            $("#font_color_area").show();
//            $("#enter_comments_popup").hide();
//
//        }
    }

    function display_sharer_list(id,btn,e) {
//        var y = $(btn).parent().offset().top;
//        var window_top = $(window).scrollTop();
//        var mainEvent = sub ? sub : window.event;
//        alert(btn.pageX);
        var height = $('#sharer_list_'+id).height();
        var width = $('#sharer_list_'+id).width();
        //calculating offset for displaying popup message
        var leftVal=e.pageX-(width/2)+"px";
        var topVal=e.pageY-(height/2)+"px";
//        alert(height+'==='+width);

        $('#sharer_list_'+id).css({'top':topVal+15,'left':leftVal+15});
//        $('#sharer_list_'+id).css( 'left', e.pageX );
//        alert("This button click occurred at: X(" +
//            mainEvent.screenX + ") and Y(" + mainEvent.screenY + ")");


//        $('#sharer_list_'+id).show();
        $('#sharer_list_'+id).toggle();
        $('span.btn-success').removeClass("active_btn");
        $(btn).addClass("active_btn");
//        $('.btn-success').removeClass("active_btn");

    }


</script>

<div class="container">
    <div  style="width:100%; text-align: center;">
        <div class="row close_settlement_letter_form_btn" style="text-align: right;" id="close_settlement_letter_form_section">
            <div class="col-md-10 col-lg-10 col-sm-12 col-xs-12" style="padding: 0px;">
                <button type="button" class="btn btn-warning pull-right btn_table" id="close_settlement_letter_form"
                        onclick="window.close();return false;"
                        style="margin-right: 0px;">戻る
                    <!--            onclick="window.close();return false;"-->
                </button>
                <button type="button" class="btn btn-success pull-right btn_table" id="share_settlement_form"
                        style="margin-right: 5px;" onclick="">共有

                </button>
                <button type="button" id="new_settlement" class="btn btn-primary"
                        onclick='window.location.href = $("#base_url").val() + "index.php/wordapp/view_settlement_form/";'
                        style="margin-right: 5px; padding: 5px 20px;">新規
                </button>
                <?php if ((isset($is_share) && $is_share != 1) || !isset($settlement_id)) { ?>
                    <button type="button" id="done_settlement" class="btn btn-primary"
                            onclick="validate_settlement_form(1);"
                            style="margin-right: 5px; padding: 5px 20px;<?php echo $done_settlement_button; ?>">完了
                    </button>
                <?php } ?>
                <?php //if (isset($settlement_id)) { ?>
                <button type="button" id="on_hold_settlement" class="btn btn-primary"
                        onclick="on_hold_form();"
                        style="margin-right: 5px; padding: 5px 20px;<?php echo $done_settlement_button; ?>">保留
                </button>
                <?php //} ?>
            </div>
        </div>


        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-5 pull-right settlement_letter_aria" id="settlement_letter_aria"
             style="position: fixed; padding: 4px; border-radius: 2px; z-index:9999; right:10px; top:0;">
            <!--        <div class="col-lg-6" style="padding: 0; float:right">-->
            <!--            <button type="button" style="margin-bottom: 10px; margin-right: 0;"-->
            <!--                    class="btn btn-warning pull-right btn_keipro1" id="close_settlement_letter_aria">戻る</span>-->
            <!--            </button>-->
            <!--        </div>-->
            <!--        <div class="clearfix"></div>-->
            <div class="col-lg-12 settlement_letter_aria1_options underbox"
                 style="padding: 4px; border-radius: 3px;  border: 4px solid #000; opacity: 100%;"
                 id="settlement_letter_aria1">
                <!-- <div class="font_family_aria_parent">
                <div class="font_family_aria_child"> -->
                <table class="table table-bordered" style="margin-bottom: 0;">
                    <!--                <tr>-->
                    <!--                    <td id="settlement_letter_choice6" style="cursor: pointer;"><input style="cursor: pointer;"-->
                    <!--                                                                                       type="checkbox"-->
                    <!--                                                                                       name="settlement_letter_choice"-->
                    <!--                                                                                       value="view_requisition">-->
                    <!--                        決裁書（送受信）-->
                    <!--                    </td>-->
                    <!--                </tr>-->
                    <!--                <tr>-->
                    <!--                    <td id="settlement_letter_choice1" style="cursor: pointer;"><input style="cursor: pointer;"-->
                    <!--                                                                                       type="checkbox"-->
                    <!--                                                                                       name="settlement_letter_choice"-->
                    <!--                                                                                       value="purchase"> 物品購入-->
                    <!--                    </td>-->
                    <!--                </tr>-->
                    <!--                <tr>-->
                    <!--                    <td id="settlement_letter_choice2" style="cursor: pointer;"><input style="cursor: pointer;"-->
                    <!--                                                                                       type="checkbox"-->
                    <!--                                                                                       name="settlement_letter_choice"-->
                    <!--                                                                                       value="expenses"> 交通費-->
                    <!--                    </td>-->
                    <!--                </tr>-->
                    <!--                <tr>-->
                    <!--                    <td id="settlement_letter_choice3" style="cursor: pointer;"><input style="cursor: pointer;"-->
                    <!--                                                                                       type="checkbox"-->
                    <!--                                                                                       name="settlement_letter_choice"-->
                    <!--                                                                                       value="other"> その他-->
                    <!--                    </td>-->
                    <!--                </tr>-->

                    <tr>
                        <?php if ($login_user_id == 126 || $login_user_id == 123 || $login_user_id == 124) { ?>
                            <td id="admin_settlement_letter_choice4" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                                     type="checkbox"
                                                                                                     name="settlement_letter_choice"
                                                                                                     value="history"> 履歴
                            </td>
                        <?php } else {
                            ?>
                            <td id="settlement_letter_choice4" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                               type="checkbox"
                                                                                               name="settlement_letter_choice"
                                                                                               value="history"> 履歴
                            </td>
                        <?php }
                        ?>
                    </tr>
                    <tr>
                        <?php if ($login_user_id == 126 || $login_user_id == 123 || $login_user_id == 124) { ?>
                            <td id="admin_settlement_letter_choice5" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                                     type="checkbox"
                                                                                                     name="settlement_letter_choice"
                                                                                                     value="resolved"> 決裁済 (個別)
                            </td>
                        <?php } else {
                            ?>
                            <td id="settlement_letter_choice5" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                               type="checkbox"
                                                                                               name="settlement_letter_choice"
                                                                                               value="resolved"> 決裁済 (個別)
                            </td>
                        <?php }
                        ?>
                    </tr>
                    <tr>
                        <?php if ($login_user_id == 126 || $login_user_id == 123 || $login_user_id == 124) { ?>

                            <td id="admin_settlement_letter_choice7" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                                     type="checkbox"
                                                                                                     name="settlement_letter_choice"
                                                                                                     value="resolvedpass"> 決裁済 (全体)
                            </td>
                        <?php } else {
                            ?>
                            <td id="settlement_letter_choice7" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                               type="checkbox"
                                                                                               name="settlement_letter_choice"
                                                                                               value="resolvedpass"> 決裁済 (全体)
                            </td>
                        <?php }
                        ?>
                    </tr>
                    <tr style="display: none;">
                        <?php if ($login_user_id == 126 || $login_user_id == 123 || $login_user_id == 124) { ?>

                            <td id="admin_settlement_letter_choice77" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                                      type="checkbox"
                                                                                                      name="settlement_letter_choice"
                                                                                                      value="resolvedpass"> 決裁済 (全体)
                            </td>
                        <?php } else {
                            ?>
                            <td id="settlement_letter_choice77" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                                type="checkbox"
                                                                                                name="settlement_letter_choice"
                                                                                                value="resolvedpass"> 決裁済 (全体)
                            </td>
                        <?php }
                        ?>
                    </tr>
                    <tr>
                        <td unselectable="on" id="settlement_letter_choice8" style="cursor: pointer;"><input
                                    style="cursor: pointer;"
                                    type="checkbox"
                                    name="settlement_letter_choice"
                                    value="opinion"> 意見・コメント
                        </td>
                    </tr>
                    <tr>
                        <td id="webcam_configure" onclick="configure();" style="cursor: pointer;"><input
                                    style="cursor: pointer;"
                                    type="checkbox"
                                    name="settlement_letter_choice"
                                    value="purchase"> 印鑑・サイン撮影
                        </td>
                    </tr>

                </table>
                <!-- </div>
            </div>  -->
            </div>
            <div class="clearfix"></div>

        </div>

        <div class="row">
            <div class="col-md-10 col-lg-10 col-sm-12 col-xs-12" style="text-align: right; padding: 0px;">
                <?php
                if (isset($settlement_id)) {
                    $created_date_explode = explode(' ', $created_date);
                    $created_date_only = $created_date_explode[0];
                    $created_date_only_explode = explode('-', $created_date_only);
                    echo $created_date_only_explode[0] . '年' . $created_date_only_explode[1] . '月' . $created_date_only_explode[2] . '日';
                } else {
                    echo date('Y') . '年' . date('m') . '月' . date('d') . '日';
                }
                ?>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="text-align: center;">
                <p style="font-size: 20px;font-family: ms mincho, ｍｓ 明朝;">決裁書及びその他稟議書</p>
            </div>
        </div>
        <form class="settlement_letter_form" id="settlement_letter_form" name="settlement_letter_form" method="post"
              enctype="multipart/form-data"
              action="<?php echo base_url(); ?>index.php/wordapp/save_settlement_letter_form/">


            <div class="row" >
                <div class="col-md-7 col-lg-7 col-sm-9 col-xs-9 divL" style="text-align: center; ">

                    <table style="margin-bottom: 5px;" class="table_style tblleft" width="100%" cellpadding="0"
                           cellspacing="0">
                        <tr>
                            <td class="td_style" width="20%" align="center">最終<br>
                                決裁者
                            </td>
                            <td style="border-left:solid black 1px;" width="182" align="center">審　査</td>
                            <td style="border-left:solid black 1px;" width="20%" align="center">審　査</td>
                            <td style="border-left:solid black 1px;" width="20%" align="center">審　査</td>
                            <td style="border-left:solid black 1px;" width="20%" align="center">審　査</td>
                        </tr>
                        <tr>
                            <td align="center" width="20%"
                                onclick="show_seal_image_password_form(this.id);"
                                id="1" class="tblleft_under1 <?php if (isset($settlement_id)) if ($president_seal_id != 0) echo 'decision_document_disable'; ?>">
                                <div class="border_white" id="div_1" style="">
                                    <?php
                                    if (isset($settlement_id)) {
                                        if ($president_seal_id != 0) {
                                            ?>
                                            <img class="seal_iamge_brightness" height='50'
                                                 src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $president_seal_img; ?>"/>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <span class="hidden_span" id="click_here_text">ここをクリック</span>

                                        <?php
                                    }
                                    ?>
                                    <!--                                        <input class="input_style1" type="text" id="president_seal_img" name="president_seal_img">-->
                                </div>
                            </td>
                            <td align="center" width="20%"
                                style=""
                                onclick="show_seal_image_password_form(this.id);"
                                id="2" class="tblleft_under <?php if (isset($settlement_id)) if ($president_seal_id != 0) echo 'decision_document_disable'; ?>">
                                <div class="border_white" id="div_2" style="">
                                    <?php
                                    if (isset($settlement_id)) {
                                        if ($examination1_seal_id != 0) {
                                            ?>
                                            <img class="seal_iamge_brightness" height='50'
                                                 src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $examination1_seal_img; ?>"/>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <span class="hidden_span" id="click_here_text">ここをクリック</span>

                                        <?php
                                    }
                                    ?>

                                    <!--                                                <input-->
                                    <!--                                                        class="input_style1" type="text" id="examination1_seal_img"-->
                                    <!--                                                        name="examination1_seal_img">-->
                                </div>
                            </td>
                            <td align="center" class="tblleft_under td_style <?php if (isset($settlement_id)) if ($president_seal_id != 0) echo 'decision_document_disable'; ?>" width="20%"
                                style=""
                                onclick="show_seal_image_password_form(this.id);"
                                id="3">
                                <div class="border_white" id="div_3" style="">
                                    <!--                                                <input-->
                                    <!--                                                        class="input_style1" type="text" id="examination2_seal_img"-->
                                    <!--                                                        name="examination2_seal_img">-->
                                    <?php
                                    if (isset($settlement_id)) {
                                        if ($examination2_seal_id != 0) {
                                            ?>
                                            <img class="seal_iamge_brightness" height='50'
                                                 src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $examination2_seal_img; ?>"/>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <span class="hidden_span" id="click_here_text">ここをクリック</span>

                                        <?php
                                    }
                                    ?>
                                </div>
                            </td>
                            <td align="center" class="tblleft_under td_style <?php if (isset($settlement_id)) if ($president_seal_id != 0) echo 'decision_document_disable'; ?>" width="20%"
                                style=""
                                onclick="show_seal_image_password_form(this.id);"
                                id="4">
                                <div class="border_white" id="div_4" style="">
                                    <!--                                                <input-->
                                    <!--                                                        class="input_style1" type="text" id="examination3_seal_img"-->
                                    <!--                                                        name="examination3_seal_img">-->
                                    <?php
                                    if (isset($settlement_id)) {
                                        if ($examination3_seal_id != 0) {
                                            ?>
                                            <img class="seal_iamge_brightness" height='50'
                                                 src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $examination3_seal_img; ?>"/>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <span class="hidden_span" id="click_here_text">ここをクリック</span>

                                        <?php
                                    }
                                    ?>
                                </div>
                            </td>
                            <td align="center" class="tblleft_under td_style <?php if (isset($settlement_id)) if ($president_seal_id != 0) echo 'decision_document_disable'; ?>" width="20%"
                                style=""
                                onclick="show_seal_image_password_form(this.id);"
                                id="5">
                                <div class="border_white" id="div_5" style="">

                                    <!--                                                <input-->
                                    <!--                                                        class="input_style1" type="text" id="examination4_seal_img"-->
                                    <!--                                                        name="examination4_seal_img">-->
                                    <?php
                                    if (isset($settlement_id)) {
                                        if ($examination4_seal_id != 0) {
                                            ?>
                                            <img class="seal_iamge_brightness" height='50'
                                                 src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $examination4_seal_img; ?>"/>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <span class="hidden_span" id="click_here_text">ここをクリック</span>

                                        <?php
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    </table>



                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 tblright" style="text-align: center;">
                    <table border="0" cellpadding="3" cellspacing="2">
                        <tr>

                            <td class="tblright_data">
                                部署名<input autocomplete="off" maxlength="10" onBlur="validate_settlement_form();" class="input_style2"
                                          type="text"
                                          id="deployment_name"
                                          name="deployment_name"
                                          value="<?php if (isset($deployment_name)) echo $deployment_name; ?>" <?php if (isset($settlement_id)) {
                                    if ($president_seal_id != 0) {
                                        ?> readonly="true" <?php
                                    } else {

                                    }
                                }
                                ?>>
                                <hr>
                                <br>
                                氏名<input autocomplete="off" style="width: 45%;" maxlength="10" onBlur="validate_settlement_form();"
                                         class="input_style2 required_input"
                                         type="text"
                                         id="name_printing" name="name_printing"
                                         value="<?php if (isset($name_printing)) echo $name_printing; ?>" <?php if (isset($settlement_id)) {
                                    if ($president_seal_id != 0) {
                                        ?> readonly="true" <?php
                                    } else {

                                    }
                                }
                                ?>><span style="cursor: pointer;" id="6"
                                         onclick="show_seal_image_password_form(this.id);"><?php
                                    if (isset($settlement_id)) {
                                        if ($name_printing_seal_id != 0) {
                                            ?><img class="seal_iamge_brightness" style="margin-left:30px;" height='50'
                                                   src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $name_printing_seal_img; ?>"/>
                                            <?php
                                        } else {
                                            echo '<span style="float: right;">印</span>';
                                        }
                                    } else {
                                        ?><span style="float: right;">印</span><?php } ?></span>
                                <hr>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-lg-10 col-sm-12 col-xs-12" style="text-align: left;">


                    <input autocomplete="off" id="settlement_title" name="settlement_title"  type="text" onblur="validate_settlement_form();"
                           onKeyPress="remove_all_placeholder();" placeholder="タイトル"
                           class="s_title"
                           value="<?php if (isset($settlement_title)) echo $settlement_title; ?>" <?php if (isset($settlement_id)) {
                        if ($president_seal_id != 0) {
                            ?> readonly="true" <?php
                        } else {

                        }
                    }
                    ?>>



                    &nbsp;
                    <label for="files"
                           class="btn-upload btn-success bt"
                           style="<?php echo $decision_document_disable; ?>">
                        添付書類
                    </label><span style="display: none;" id="hold_style_settlement" class="hold_style_settlement">保留</span>
                    <span id="document_loader" style="display: none;">
                                            <img src="<?php echo base_url(); ?>resource/img/ajax/ajax_load_9.gif">
                                        </span>
                    <br>
                    <input name="files[]" id="files" style="display:none;" type="file" multiple>
                    <span style="display: none" id="file_name">file name</span>


                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-lg-10 col-sm-12 col-xs-12 tarea">
                    <table>
                        <tr>
                            <td colspan="4" valign="middle" bgcolor="#FFFFFF" align="left">
                                &nbsp;<?php
                                if (count($settlement_documents_info) > 0) {
                                    foreach ($settlement_documents_info as $key => $settlement_documents_infos) {
                                        $document_id = $settlement_documents_infos['document_id'];
                                        $document_name = $settlement_documents_infos['document_name'];
                                        $document_name_array = explode('.', $document_name);
                                        $document_type = $document_name_array[1];

                                        if (strtolower($document_type) == 'xls' || strtolower($document_type) == 'xlsx' || strtolower($document_type) == 'doc' || strtolower($document_type) == 'docx')
                                            $document_url = 'https://view.officeapps.live.com/op/embed.aspx?src=';
                                        else
                                            $document_url = '';

                                        if ($key == count($settlement_documents_info) - 1)
                                            $comma_separation = '';
                                        else
                                            $comma_separation = ' '; //,
                                        ?>
                                        <a id="link_decision_documents" href="<?php echo base_url(); ?>resource/img/decision_documents/<?php echo $settlement_documents_infos['document_encrypted_name']; ?>" download hidden></a>
                                        <a style="text-decoration: none;" class="decision_documents_iframe"
                                           id="decision_documents_url" target="iframe_a"
                                           href='<?php echo $document_url . base_url(); ?>resource/img/decision_documents/<?php echo $settlement_documents_infos['document_encrypted_name']; ?>'><?php echo $settlement_documents_infos['document_name'] . $comma_separation; ?></a>
                                        <?php if(isset($is_share))if ($is_share != 1) { ?>
                                            <input type="hidden" name="document_encrypted_name"
                                                   id="document_encrypted_name"
                                                   value="<?php if ($settlement_documents_infos['document_encrypted_name'] != '') echo $settlement_documents_infos['document_encrypted_name'];
                                                   else echo ''; ?>">
                                            <button style="<?php echo $delete_documents_button; ?>; margin-bottom: 3px; padding: 2px 7px;"
                                                    type="button"
                                                    id="delete_documents" class="btn btn-warning"
                                                    onclick="delete_decision_documents('<?php echo $document_id; ?>');">
                                                削除
                                            </button>&nbsp;

                                            <?php
                                        }
                                    } // end foreach loop
                                } else {

                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4">
                                <table class="table_style1" width="100%" style="margin-top: 0px;" cellpadding="0"
                                       cellspacing="0">
                                    <tr>
                                        <td width="50" rowspan="4" align="center"><br/><br/><br/> 決<br/> <br/>栽<br/><br/>
                                            事<br/><br/>項
                                        </td>
                                        <td style="border-left:solid black 1px; padding-left: 7px; padding-top: 7px;"
                                            width="1112"  colspan="3" valign="top">結論（目的）：
                                            <hr style="width:90%; margin-top: 7px; margin-bottom: 3px;">
                                            <div contenteditable
                                                 onKeyUp="limitTextarea(this, 8, 300)" cols="20"
                                                 rows="8"
                                                 maxlength="300" onBlur="validate_settlement_form();"
                                                 id="conclusion"
                                                 name="conclusion" class="input_style act"

                                                 <?php if (!isset($settlement_id)) { ?>placeholder="ここに入力してください" <?php
                                            }
                                            if (isset($settlement_id)) {
                                                if ($president_seal_id != 0) {
                                                    ?> readonly="true" <?php
                                                } else {

                                                }
                                            }
                                            ?>><?php if (isset($conclusion)) echo $conclusion; ?></div>
                                            <!--                                        <div id="content_remaining" style="text-align:center; width:71%; float: left;">600 characters remaining.</div>-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-left:solid black 1px; padding-left: 7px; padding-top: 7px;"
                                            colspan="3" valign="top">
                                            意見・コメント :
                                            <hr style="width:90%; margin-top: 7px; margin-bottom: 3px;">

                                            <div contenteditable onBlur="validate_settlement_form();"
                                                 class="input_style act" id="others"
                                                 name="others" maxlength="300"
                                                 onkeyup="limitTextarea(this, 8, 300)"
                                                 <?php if (!isset($settlement_id)) { ?>placeholder="ここに入力してください" <?php
                                            }
                                            if (isset($settlement_id)) {
                                                if ($president_seal_id != 0) {
                                                    ?> readonly="true" <?php
                                                } else {

                                                }
                                            }
                                            ?>><?php if (isset($others)) echo $others; ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-left:solid black 1px;border-top:solid black 1px; padding-left: 7px; padding-top: 7px;"
                                            colspan="3" valign="top">理由（手段）：
                                            <div contenteditable
                                                 onblur="validate_settlement_form();" class="input_style act"
                                                 id="reason" name="reason" maxlength="300"
                                                 onkeyup="limitTextarea(this, 8, 300)"
                                                 <?php if (!isset($settlement_id)) { ?>placeholder="ここに入力してください" <?php
                                            }
                                            if (isset($settlement_id)) {
                                                if ($president_seal_id != 0) {
                                                    ?> readonly="true" <?php
                                                } else {

                                                }
                                            }
                                            ?>><?php if (isset($reason)) echo $reason; ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-left:solid black 1px;border-top:solid black 1px; padding-left: 7px; padding-top: 7px;"
                                            colspan="3" valign="top">事例：
                                            <div contenteditable
                                                 onblur="validate_settlement_form();" class="input_style act"
                                                 id="case_study"
                                                 name="case_study"
                                                 maxlength="300"
                                                 onkeyup="limitTextarea(this, 8, 300)"
                                                 <?php if (!isset($settlement_id)) { ?>placeholder="ここに入力してください" <?php
                                            }
                                            if (isset($settlement_id)) {
                                                if ($president_seal_id != 0) {
                                                    ?> readonly="true" <?php
                                                } else {

                                                }
                                            }
                                            ?>><?php if (isset($case_study)) echo $case_study; ?></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!--                            <tr>-->
                        <!--                                <td colspan="4" align="right"><br/>-->
                        <!--                                    --><?php //if ($share_this_settlement_id != 1) {  ?>
                        <!--                                        <button type="button" id="done_settlement" class="btn btn-primary"-->
                        <!--                                                onclick="validate_settlement_form();"-->
                        <!--                                                style="-->
                        <?php //echo $done_settlement_button;  ?><!--">完了-->
                        <!--                                        </button>-->
                        <!--                                    --><?php //}  ?>
                        <!--                                </td>-->
                        <!--                            </tr>-->
                    </table>
                </div>

            </div>
            <table class="table-responsive" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td colspan="2" align="right">

                    </td>
                </tr>
            </table>

            <input type="hidden" id="settlement_id" name="settlement_id"
                   value="<?php if (isset($settlement_id)) echo $settlement_id;
                   else echo 0; ?>">
            <input type="hidden" id="is_deleted" name="is_deleted"
                   value="<?php if (isset($is_deleted)) echo $is_deleted;
                   else echo 0; ?>">
            <input type="hidden" id="created_by" name="created_by"
                   value="<?php if (isset($created_by)) echo $created_by;
                   else echo 0; ?>">
            <input type="hidden" id="is_share" name="is_share"
                   value="<?php if (isset($is_share)) echo $is_share;
                   else echo 0; ?>">
            <input type="hidden" id="settlement_id_email" name="settlement_id_email"
                   value="0">
            <input type="hidden" name="api_key" value="<?= base64_encode($this->config->item("api_key")) ?>"
                   id="api_key">

            <input type="hidden" name="reply_mail_id" id="reply_mail_id"
                   value=" ">
            <input type="hidden" id="draft_value" value="1" name="draft_value">
            <input type="hidden" name="drft_email_id" value="" id="drft_email_id">
            <input type="hidden" id="user_id" value="<?= base64_encode($this->session->userdata('account_id')) ?>"
                   name="user_id">
            <input type="hidden" name="base_url" id="base_url" value="<?= base_url() ?>">
            <input type="hidden" name="seal_image_type" id="seal_image_type" value="">
            <input type="hidden" name="president_seal_id" id="president_seal_id"
                   value="<?php if (isset($president_seal_id)) echo $president_seal_id;
                   else echo 0; ?>">
            <input type="hidden" name="on_hold" id="on_hold"
                   value="<?php if (isset($on_hold)) echo $on_hold;
                   else echo 0; ?>">
            <input type="hidden" name="examination1_seal_id" id="examination1_seal_id"
                   value="<?php if (isset($examination1_seal_id)) echo $examination1_seal_id;
                   else echo 0; ?>">
            <input type="hidden" name="examination2_seal_id" id="examination2_seal_id"
                   value="<?php if (isset($examination2_seal_id)) echo $examination2_seal_id;
                   else echo 0; ?>">
            <input type="hidden" name="examination3_seal_id" id="examination3_seal_id"
                   value="<?php if (isset($examination3_seal_id)) echo $examination3_seal_id;
                   else echo 0; ?>">
            <input type="hidden" name="examination4_seal_id" id="examination4_seal_id"
                   value="<?php if (isset($examination4_seal_id)) echo $examination4_seal_id;
                   else echo 0; ?>">
            <input type="hidden" name="name_printing_seal_id" id="name_printing_seal_id"
                   value="<?php if (isset($name_printing_seal_id)) echo $name_printing_seal_id;
                   else echo 0; ?>">
            <input type="hidden" id="login_user_id" name="login_user_id"
                   value="<?= $this->session->userdata('account_id'); ?>">
            <input type="hidden" id="login_user_id2" name="login_user_id2"
                   value="<?= $this->session->userdata('account_id'); ?>">
            <input type="hidden" id="save_settlement_form_for_emailing" name="save_settlement_form_for_emailing"
                   value="0">
            <input type="hidden" id="share_this_settlement_id" name="share_this_settlement_id"
                   value="<?php echo $share_this_settlement_id; ?>">
            <input type="hidden" id="back_one_step" name="back_one_step"
                   value="<?php if (isset($back_one_step)) echo $back_one_step;
                   else echo ''; ?>">
            <input type="hidden" id="edit_partner_yes" name="edit_partner_yes"
                   value="0">
            <input type="hidden" id="delete_partner_yes" name="delete_partner_yes"
                   value="0">
            <input type="hidden" id="decoded_image_name_for_ie" name="decoded_image_name_for_ie"
                   value="">
            <input type="hidden" id="user_login_password" name="user_login_password"
                   value="">
            <input type="hidden" id="settlement_mail_screen" name="settlement_mail_screen"
                   value="<?php if (isset($settlement_mail_screen)) echo $settlement_mail_screen;
                   else echo 0; ?>">

            <input type="hidden" id="partner_share_enable" name="partner_share_enable"
                   value="0">
        </form>
    </div>

</div>

<!-- start Font Color Area -->
<?php
//if (isset($settlement_id)) {
?>
<div class="font_color_area"
     style="overflow:hidden;width:18%; height:260px; right:1%; z-index: 9999; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #ffffff; display: none;"
     id="font_color_area">

    <div style="width:auto; text-align: right">
        <button type="button" class="btn btn-info btn_popup" id="close_font_color_area">戻る</button>
    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p>コメントが記入できます。
        </p>
        <p>色を変えられますので、選んでください。　

        </p>
        <span style="display: inline-block"><button
                    style="width: 50px; height: 50px; background-color: #000000; border: 1px solid #000000"
                    onclick="changeTextareaFontColor('#000000');"></button>
            <button style="width: 50px; height: 50px; background-color: #FF0000; border: 1px solid #ff0000"
                    onclick="changeTextareaFontColor('#ff0000');"></button>
            <button style="width: 50px; height: 50px; background-color: #0000FF; border: 1px solid #0000FF"
                    onclick="changeTextareaFontColor('#0000FF');"></button>
        </span>
        <span style="display: inline-block">
            <button style="width: 50px; height: 50px; background-color: #00FF00; border: 1px solid #00FF00"
                    onclick="changeTextareaFontColor('#00FF00');"></button>
            <button style="width: 50px; height: 50px; background-color: #00CC99; border: 1px solid #00CC99"
                    onclick="changeTextareaFontColor('#00CC99');"></button>
            <button style="width: 50px; height: 50px; background-color: #8B4513; border: 1px solid #8B4513"
                    onclick="changeTextareaFontColor('#8B4513');"></button>
            </span>
    </div>
</div>
<?php
//}
?>
<!-- end Font Color Area -->

<!-- start enter comments popup -->
<?php
if (isset($settlement_id)) {
    ?>
    <div class="enter_comments_popup"
         style="overflow:hidden;width:25%; height:160px; right:18%; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #CCFFCC; display: none"
         id="enter_comments_popup">

        <div style="width:auto; text-align: right">
            <span style=" margin-bottom: .35em;">コメントが記入できます。</span>
            <button type="button" class="btn btn-danger btn_popup" id="close_enter_comments_popup">戻る</button>
        </div>
        <div class="clearfix"></div>
        <div style="text-align: center">
            <p>色を変えられますので、選んでください。　

            </p>
            <p>
                <button type="button" id="yes" class="btn btn-light_green" onclick="showFontColorArea(2);"
                        style="border: 2px solid #46658C; margin-right: 10px;"> カラー
                </button>
                <button type="button" id="no" class="btn btn-light_blue" onclick=""
                        style="border: 2px solid #46658C; margin-right: 10px;"> 完了

                </button>
            </p>
        </div>
    </div>
    <?php
}
?>
<!-- end enter comments popup -->

<!-- start password form -->
<div class="password_form_notification pfn"
     style="overflow:hidden;width:26%; height:190px; right:0; bottom:15px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none;"
     id="seal_image_password_form">

    <div style="width:auto; text-align: right; margin-bottom: 5px;">

        <!-- Contextual button for informational alert messages -->
        <button type="button" class="btn btn-danger" onclick="seal_image_password_form_close();"
                id="seal_image_password_form_close"> 戻る
        </button>

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">パスワードを入力してください。</p>
        <input onkeydown="if (event.keyCode == 13) { done_seal_image();}" type="tel" id="seal_image_password"
               name="seal_image_password"
               style="background-color: #FFCCFF; border: 2px solid #446590; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; text-align: center; ime-mode: disabled"
               maxlength="4" placeholder="４ケタ">
        <p>
            <!--            btn btn-light_green-->
            <!--            <button type="button" id="configuration_seal_image" class="btn btn-success"-->
            <!--                    onclick="configuration_seal_image();"-->
            <!--                    style="border: 2px solid #46658C; margin-right: 10px;"> 登録設定-->
            <!--            </button>-->
            <button type="button" id="change_seal_image" class="btn btn-light_blue"
                    onclick="change_seal_image(this.id);"
                    style="border: 2px solid #46658C; margin-right: 10px;"> 変更

            </button>
            <button type="button" id="done_seal_image" class="btn btn-yellow" onclick="done_seal_image();"
                    style="border: 2px solid #46658C;"> 決定
            </button>
        </p>
    </div>
</div>
<!-- end password form -->


<!-- start password form step 2 -->
<div class="seal_password_form_step_2" style="overflow:hidden;width:30%; height:200px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="seal_image_password_form_step_2">
    <div style="width:auto; text-align: right">

        <button type="button" class="btn btn-danger"
                id="seal_image_change_password_form_step_2_close"> 戻る
        </button>

    </div>
    <div style="width:auto; text-align: left; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px;">
        パスワード変更　
    </div>
    <div class="clearfix"></div>
    <div style="text-align: left; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px;">
        新パスワード　
        <input type="tel" id="seal_image_new_password_step_2" name="seal_image_new_password_step_2"
               style="width:50%; background-color: #FFCCFF; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; margin-left: 18px; text-align: center; ime-mode: disabled"
               maxlength="4" placeholder="４ケタ" class="pass_style">
        <p style="text-align: center">
            <button type="button" id="change_seal_image_complete1" class="btn btn-yellow"
                    onclick="change_seal_image(this.id);"
                    style="border: 2px solid #46658C;"> 完了
            </button>
        </p>
    </div>
</div>
<!-- end password form step 2-->

<!-- start change password form -->
<div class="seal_image_change_password_popup" style="overflow:hidden;width:30%; height:180px; right:0; bottom:15px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="seal_image_change_password_form">
    <div style="width:auto; text-align: right">

        <button type="button" class="btn btn-danger" onclick="seal_image_change_password_form_close();"
                id="seal_image_change_password_form_close"> 戻る
        </button>

    </div>
    <div style="width:auto; text-align: left; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px;">
        パスワード変更　
    </div>
    <div class="clearfix"></div>
    <div style="text-align: left; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px;">
        <!--        現在のパスワード -->
        <input type="tel" id="seal_image_current_password" name="seal_image_current_password"
               style="display:none;width:50%; background-color: #B7DEE8; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; text-align: center; ime-mode: disabled"
               maxlength="4" placeholder="４ケタ" class="pass_style">
        <!--        <br>-->
        新パスワード　
        <input type="tel" id="seal_image_new_password" name="seal_image_new_password"
               style="width:50%; background-color: #FFCCFF; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; margin-left: 18px; text-align: center; ime-mode: disabled"
               maxlength="4" placeholder="４ケタ" class="pass_style">
        <p style="text-align: center">
            <!--            <button type="button" id="forgot_seal_image_password" class="btn btn-primary"-->
            <!--                    onclick="forgot_seal_image_password(this.id);"-->
            <!--                    style="border: 2px solid #46658C;"> 忘れた-->
            <!--            </button>-->
            <button type="button" id="change_seal_image_complete" class="btn btn-yellow"
                    onclick="change_seal_image(this.id);"
                    style="border: 2px solid #46658C;"> 完了
            </button>
        </p>
    </div>
</div>
<!-- end change password form -->

<!-- start forgot password form -->
<div style="overflow:hidden;width:30%; height:190px; right:0; bottom:15px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none;"
     id="forgot_seal_image_password_form">
    <div style="width:auto; text-align: left">
        <span style=" margin-bottom: .35em;font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px; text-align: left;"> パスワード変更　</span>
        <button type="button" class="btn btn-danger" id="forgot_seal_image_password_form_close" style="float: right;">
            戻る
        </button>
    </div>

    <div class="clearfix"></div>
    <div style="text-align: left; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px; margin-top: 20px; margin-left: 30px;">
        新パスワード　
        <input type="tel" id="seal_image_forgot_password" name="seal_image_forgot_password"
               style="width:50%; background-color: #FFCCFF; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; margin-left: 10px; text-align: center; ime-mode: disabled"
               maxlength="4" placeholder="４ケタ" class="pass_style">
        <p style="text-align: center">
            <button type="button" id="seal_image_forgot_password_done" class="btn btn-yellow"
                    onclick="forgot_seal_image_password(this.id);"
                    style="border: 2px solid #46658C;"> 完了
            </button>
        </p>
    </div>
</div>
<!-- end forgot password form -->

<!-- start change password confirmation message -->
<div class="seal_image_confirmation_message" style="overflow:hidden;width:30%; height:120px; right:0; bottom:15px; position: fixed; padding: 22px 10px 10px 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none;"
     id="seal_image_change_password_confirmation_message">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
            <!--            Password change completed-->
            <!--            パスワードの変更が完了しました-->
            印鑑のパスワードを <span id="password_change_complete_text"></span> に変更しました。

        </p>
        <p>
            <button type="button" id="close_seal_image_change_password_confirmation_message" class="btn btn-yellow"
                    style="border: 2px solid #46658C;"> 確認

            </button>
        </p>
    </div>
</div>
<!-- end change password confirmation message -->

<!-- start change password confirmation popup -->
<div class="password_confirmation_popup" style="overflow:hidden;width:20%; height:100px; right:0; bottom:15px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none;"
     id="seal_image_change_password_confirmation_popup">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;"> パスワードを変更しますか？</p>
        <p>
            <button type="button" id="yes" class="btn btn-light_green" onclick="change_seal_image(this.id);"
                    style="border: 2px solid #46658C; margin-right: 10px;"> はい
            </button>
            <button type="button" id="no" class="btn btn-light_blue" onclick="change_seal_image(this.id);"
                    style="border: 2px solid #46658C; margin-right: 10px;"> いいえ
            </button>
        </p>
    </div>
</div>
<!-- end change password confirmation popup -->

<!-- start save form data confirmation message -->
<div style="overflow:hidden;width:25%; height:50px; right:0; bottom:15px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="save_settlement_letter_form_message">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
            データが保存しました。
        </p>
        <!--        <p>-->
        <!--            <button type="button" id="close_save_settlement_letter_form_message" class="btn btn-light_green"-->
        <!--                    style="border: 2px solid #46658C; margin-right: 10px;"> 戻る-->
        <!--            </button>-->
        <!--        </p>-->
    </div>
</div>
<!-- end save form data confirmation message -->

<!-- start edit form data confirmation message -->
<div style="overflow:hidden;width:25%; height:100px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="edit_settlement_letter_form_message">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
            データが更新済みです。
        </p>
        <p>
            <button type="button" id="close_edit_settlement_letter_form_message" class="btn btn-light_green"
                    style="border: 2px solid #46658C; margin-right: 10px;"> 戻る
            </button>
        </p>
    </div>
</div>
<!-- end edit form data confirmation message -->

<!-- start incorrect password message -->
<div class="incorrect_password_message_sp" style="overflow:hidden;width:25%; z-index: 9999; height:130px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="incorrect_password_message">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p id="incorrect_password_text"
           style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
            パスワードが間違っています。<br>
            または、印鑑の登録がありません。
        </p>
        <p>
            <button type="button" id="close_incorrect_password_message" class="btn btn-light_green"
                    style="border: 2px solid #46658C; margin-right: 10px;"> 確認
            </button>
        </p>
    </div>
</div>
<!-- end incorrect password message -->

<!-- start forgot password message -->
<div style="overflow:hidden;width:27%; height:110px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none;"
     id="forgot_password_message">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p id="forgot_password_message_text"
           style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">

        </p>


        <p>
            <button type="button" id="close_forgot_password_message" class="btn btn-light_green"
                    style="border: 2px solid #46658C; margin-right: 10px;"> 確認
            </button>
        </p>
    </div>
</div>
<!-- end forgot password message -->

<!-- start configuration_seal_image form -->
<div style="overflow:hidden;width:30%; height:200px; right:335px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none;"
     id="configuration_seal_image_form">
    <div style="width:auto; text-align: right">

        <button type="button" class="btn btn-danger" onclick="configuration_seal_image_form_close();"
                id="configuration_seal_image_form_close"> 戻る
        </button>

    </div>
    <div style="width:auto; text-align: left; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px;">
        登録設定　
    </div>
    <div class="clearfix"></div>
    <div style="text-align: left; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px;">
        パスワード <input onkeypress="setTimeout(function () {
check_if_password_exist();
}, 1000);" type="tel" id="add_seal_image_password"
                     name="add_seal_image_password"
                     style="background-color: #B7DEE8; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; text-align: center; ime-mode: inactive"
                     maxlength="4" placeholder="４ケタ" class="pass_style ">
        <!--        <br>印鑑登録 <input type="text" id="seal_image" name="seal_image"-->
        <!--                        style="width:40%;background-color: #FFCCFF; border: 2px solid #446590; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; margin-left: 18px; text-align: center; ime-mode: inactive; cursor: pointer;"-->
        <!--                        placeholder="印鑑作成-->
        <!--">-->
        <img hspace="5" src="" id="final_cropped_seal_image" width="50" height="50" style="display: none">
        <!--        <br>-->
        <!--        <button class="btn-upload btn-success"-->
        <!--                id="show_crop_image_popup">編集-->
        <!--        </button>-->
        <!--        <button class="btn-upload btn-success"-->
        <!--                id="webcam_configure" onClick="configure()">撮影-->
        <!--        </button>-->
        <!--        <p style="text-align: center">-->

        <!--        </p>-->
        <p style="text-align: center">
            <button type="button" id="change_seal_image_complete1" class="btn btn-yellow"
                    onclick="done_configuration_seal_image_insert(this.id);"
                    style="border: 2px solid #46658C;"> 完了
            </button>
        </p>
    </div>
</div>
<!-- end configuration_seal_image form -->

<!-- start crop_seal_image popup -->
<div class="crop_seal_image_popup_res"
     style="overflow: hidden; z-index: 9999; width: 28%; height: 350px; right: 10px; bottom:300px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none;"
     id="crop_seal_image_popup">
    <div class="row" style="border:0px solid red; height: 300px;">
        <div class="col-md-12">
            <div class="row" style="border:0px solid red;">
                <div class="col-md-12 text-center">
                    <div id="upload-demo" style=""></div>
                    <div id="preview-crop-image" style="display: none;"></div>
                </div>
                <!--                <div class="col-md-4" style="padding:5%;"></div>-->
                <!---->
                <!--                <div class="col-md-3" style="">-->
                <!--                    <div id="preview-crop-image" style="background:#9d9d9d;width:200px;height:200px; text-align: center; padding-top: 76px;"></div>-->
                <!--                </div>-->
            </div>
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <strong class="camera-text">拡大・縮小して、イメージを決定してください。</strong>
                    <p style="margin-top: 10px;">
                        <button class="btn btn-success btn-upload-image">決定</button>
                        <button class="btn btn-light_blue" onclick="reset_webcam()">戻る</button>
                    </p>
                    <!--                    <label for="add_crop_seal_image"-->
                    <!--                           class="btn-upload btn-success" style="margin-left: 7px;">印鑑選択</label><input type="file"-->
                    <!--                                                                                                       id="add_crop_seal_image"-->
                    <!--                                                                                                       name="add_crop_seal_image"-->
                    <!--                                                                                                       style="display:none; font-size: 14px;"><span-->
                    <!--                            style="display: none; margin-left:5px;" id="crop_seal_image_name">crop image name</span>-->
                </div>
                <!--                <div class="col-md-1"></div>-->
                <!--                <div class="col-md-4">-->
                <!--                    <button class="btn-upload btn-success btn-upload-image">プレビュー 印紙アップロード</button>-->
                <!--                </div>-->
            </div>
            <!--            <div class="row" style="border:0px solid red;">-->
            <!--                <div class="col-md-12" style="text-align:center; margin-top: 7px;">-->
            <!--                    <button type="button" id="close_crop_seal_image_popup" class="btn btn-yellow"-->
            <!--                            style="border: 2px solid #46658C;"> 確認-->
            <!--                    </button>-->
            <!--                    <button type="button" onclick="reset_webcam()" id="return_webcam" class="btn btn-yellow"-->
            <!--                            style="border: 2px solid #46658C;">   戻る-->
            <!--                    </button>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </div>
</div>
<!-- end crop_seal_image popup -->

<!-- start configuration_seal_image confirmation popup -->
<div style="overflow:hidden;width:25%; height:100px; right:353px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="configuration_seal_image_confirmation_popup">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
            登録しますか？
        </p>
        <p>
            <button type="button" id="yes" class="btn btn-light_green"
                    onclick="done_configuration_seal_image_insert(this.id);"
                    style="border: 2px solid #46658C; margin-right: 10px;"> はい
            </button>
            <button type="button" id="no" class="btn btn-light_blue"
                    onclick="done_configuration_seal_image_insert(this.id);"
                    style="border: 2px solid #46658C; margin-right: 10px;"> いいえ
            </button>
        </p>
    </div>
</div>
<!-- end configuration_seal_image confirmation popup -->

<!-- start done_configuration_seal_image_insert message -->
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria image_insert_message"
     id="done_configuration_seal_image_insert_message"
     style="position: fixed;text-align: center; right: 370px; bottom: 10px; padding: 4px; display: none; width:20%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: pink;">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; padding-left: 0;color: black;">
                <li>
                    印鑑登録が完了しました。<br>　
                    決裁書を作成してください。
                    <!--                    登録が完了しました。-->
                </li>
                <!--                <li class="camera-text-confirm" style="margin-left: 27px;">本番で、最上段の捺印（サイン）場所に、<br>-->
                <!--                    パスワード入力すると捺印されます。-->
                <!--                </li>-->
            </ul>
            <button onclick="done_configuration_seal_image_insert(this.id);" id="show_configuration_seal_image_form"
                    class="btn btn-yellow btn-sm"
                    style="box-shadow: none; border: 2px solid blue;">確認

            </button>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria"
     id="done_configuration_seal_image_insert_message1"
     style="position: fixed; right: 245px; bottom: 10px; padding: 4px; display: none; width:30%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: pink;">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; color: black;">
                <li>印鑑を登録しました。　
                </li>
                <li>クリックした場所に、パスワードを入れると<br>印鑑が捺印されます。
                </li>
            </ul>
            <button id="close_configuration_seal_image_insert_message" class="btn btn-yellow btn-sm"
                    style="box-shadow: none; border: 2px solid blue; margin-left: 155px;">確認

            </button>
        </div>
    </div>
</div>
<!-- end done_configuration_seal_image_insert message -->

<!-- start password already exist message -->
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria password_exist_message_notif" id="password_exist_message"
     style="position: fixed; right: 335px; bottom: 10px; padding: 4px; display: none; width:30%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: pink;">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; text-align: center;color: black;">
                <li>既に使用済みです</li>
            </ul>
            <button id="close_password_exist_message" class="btn btn-yellow btn-sm"
                    style="box-shadow: none; border: 2px solid blue; margin-left: 155px; cursor: pointer;">確認

            </button>
        </div>
    </div>
</div>
<!-- end password already exist message -->

<!-- start settlement title empty message -->
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="settlement_title_empty_message"
     style="position: fixed; right: 245px; bottom: 10px; padding: 4px; display: none; width:30%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE;">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; text-align:center;color: black;">
                <li>タイトルを入力してください </li>
            </ul>
            <button id="close_settlement_title_empty_message" class="btn btn-yellow btn-sm"
                    style="box-shadow: none; border: 2px solid blue; margin-left: 155px;">確認

            </button>
        </div>
    </div>
</div>
<!-- end settlement title empty message -->

<!-- start settlement title empty message -->
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="approval_seal_message_div"
     style="position: fixed; right: 0px; bottom: 10px; padding: 0px; <?php echo $approval_seal_message_div; ?>; width:16%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px;text-align:center; border: 2px solid #446590; border-radius: 0.5em; background-color: #FFFF99;">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; text-align:center; padding-left: 0;font-size: 16px; color: black;">
                <li>最終決裁が完了しました</li>
                <!--                    最終決裁者が捺印した後は変更はできません　-->

            </ul>
            <!--            <button id="close_approval_seal_message_div" class="btn btn-yellow btn-sm"-->
            <!--                    style="box-shadow: none; border: 2px solid blue;">確認-->
            <!---->
            <!--            </button>-->
        </div>
    </div>
</div>
<!-- end settlement title empty message -->

<!-- start if user has no seal image message show -->
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="user_has_no_seal_message_div"
     style="position: fixed; right: 0; bottom: 10px; padding: 0px; <?php echo $user_has_no_seal_message_div; ?>; width:31%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: #FFEFFF; color: black;">
        <div class="panel-body" style="text-align:center">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; text-align:center; padding-left:0; font-size: 16px; color: black;">
                <li> 右上の【印鑑・サイン撮影】で登録をしてください</li>
            </ul>
            <button id="close_user_has_no_seal_message_div" class="btn btn-info btn-sm"
                    style="box-shadow: none; border: 2px solid blue; color: black; background-color: #DBEEF4; ">確認

            </button>
        </div>
    </div>
</div>
<!-- end if user has no seal image message show -->

<!-- start delete documents message -->
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="delete_documents_message_confirm"
     style="position: fixed; right: 245px; bottom: 10px; padding: 4px; display: none; width:20%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style: square; color: black;">
                <li>削除済みです。</li>
            </ul>
            <button id="close_delete_documents_message_confirm" class="btn btn-info btn-sm"
                    style="box-shadow: none; border: none; margin-left: 100px;">戻る
            </button>
        </div>
    </div>
</div>
<!-- end delete documents message -->

<!-- start delete settlement form popup -->
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right hide draggable_aria" id="delete_confirm_alert"
     style="position: fixed; z-index: 9999; right: 30px; bottom: 10px; padding: 4px;">

    <div class="panel panel-warning"
         style="margin-bottom: 2px; border: solid 2px #e74c3c; border-top: solid 7px #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <p style="font-size: 20px; font-weight: bold;">削除する決裁書: <span id="delete_settlement_title_show"></span></p>
            <br>
            <button style="margin-left: 0; box-shadow: none; border: none;" type="button" class="btn btn-danger"
                    id="delete_confirm_settlement">削 除
            </button>
            <button type="button" class="btn btn-success" style="box-shadow: none; border: none;"
                    id="delete_settlement_close">
                戻 る
            </button>
        </div>
    </div>
</div>
<!-- end delete settlement form popup -->

<!-- start enter settlement title message -->
<div class="col-lg-4 col-md-4 col-sm-4 draggable_aria close_aria enter_settlement_title"
     id="enter_settlement_title_message"
     style="position: fixed; right: 0; bottom: 10px; padding: 4px; display: none; width:30%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: pink; text-align: center;">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; text-align: center;color: black;">
                <li>タイトルを入力してください
                    <!--                    タイトルと氏名を入力してください。-->
                    <!--                    先ずはタイトルを入れてください。　-->
                </li>
            </ul>
            <button id="close_enter_settlement_title_message" class="btn btn-yellow btn-sm"
                    style="box-shadow: none; border: 2px solid blue; cursor: pointer;">確認

            </button>
        </div>
    </div>
</div>
<!-- end enter settlement title message -->

<!-- start enter settlement title message -->
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="textarea_exit_maxlength_error"
     style="position: fixed; right: 254px; bottom: 10px; padding: 4px; display: none; width:30%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: pink;">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; text-align: center;color: black;">
                <li>300文字以上は書き込めません　
                </li>
            </ul>
            <button id="close_textarea_exit_maxlength_error" class="btn btn-yellow btn-sm"
                    style="box-shadow: none; border: 2px solid blue; margin-left: 155px; cursor: pointer;">確認

            </button>
        </div>
    </div>
</div>
<!-- end enter settlement title message -->

<!-- start approval_list_view_password_form -->
<div class="password_form_notification"
     style="overflow:hidden;width:25%; height:180px; right:0; bottom:15px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #DBEEF4; display: none;"
     id="approval_list_view_password_form">

    <div style="width:auto; text-align: left">

        <span style="margin-bottom: .35em;font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px; text-align: left;"> 決裁書（全体）</span>
        <button type="button" class="btn btn-danger" onclick="seal_image_password_form_close();"
                id="approval_list_view_password_form_close" style="float: right;"> 戻る
        </button>

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center; margin-top: 20px;">
        パスワード &nbsp; <input onkeydown="if (event.keyCode == 13) { done_approval_list_view_password_form(); }" type="tel"
                            id="approval_list_view_password"
                            name="approval_list_view_password"
                            style="background-color: #FFCCFF; width: 40%; border: 2px solid #446590; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; text-align: center; ime-mode: disabled"
                            maxlength="4" placeholder="４ケタ">
        <p>
            <button type="button" id="done_approval_list_view_password_form" class="btn btn-yellow"
                    onclick="done_approval_list_view_password_form();"
                    style="border: 2px solid #46658C; margin-left: 15px;"> 完了
            </button>
        </p>
    </div>
</div>
<!-- end approval_list_view_password_form -->

<div style="overflow:hidden;width:100%; height:640px; right: 0px; bottom: 0px; display: none; position: fixed; padding: 10px; border: 2px solid #ababab; border-top-left-radius: 0.5em; border-top-right-radius: 0.5em; background-color: #FFF;"
     id="test_iframe">
    <button onclick="$('#test_iframe').hide();$('#settlement_letter_aria').removeClass('hide').addClass('show');" type="button" class="btn btn-warning pull-right btn_table"
            style="margin-left: 10px; margin-right: 300px">戻る
        <!--            -->
    </button>
    <button onclick="document.getElementById('link_decision_documents').click()" type="button" class="btn btn-success pull-right btn_table"
            style="margin-right: 0px;">保存
        <!--            -->
    </button>
    <iframe id="myIframe" name="iframe_a" style="border: 0;" src='' width='100%' height='100%' frameborder='0'>
        <p>Your browser does not support iframes.</p>
    </iframe>
</div>


<!-- start web cam section -->
<div style="overflow:hidden; border-radius: 0.5em; background-color: #EBF1DE; right:10px; bottom:5px; position: fixed; z-index: 9999; display: none;"
     id="webcam_popup">

    <div id="my_camera">
        <div class="select" style="display: none">
            <label for="audioSource">Audio input source: </label><select id="audioSource"></select>
        </div>

        <div class="select" style="display: none">
            <label for="audioOutput">Audio output destination: </label><select id="audioOutput"></select>
        </div>

        <!--        <div id="video_div" class="select">-->
        <!--            <select id="videoSource"></select>-->
        <!--        </div>-->
        <video width="320" height="240" muted="" autoplay="true" id="video">
        </video>
        <!--        <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>-->

    </div>
    <div id="canvas_div" style="display: none; text-align: center; width: 320px; height: 240px">
        <canvas id="canvas" height="220" width="180"></canvas>
    </div>
    <div id="results" style="text-align: center;"></div>
    <div id="webcam_text" style="text-align: center; margin: 7px 0px; color: black; font-size: 18.667px;">印鑑・サインを撮影してください。</div>
    <div style="text-align: center; margin: 7px 0px;">
        <p style="text-align: left; margin-left: 15px;"><span
                    style="display: none" id="crop_seal_image_name">crop image name</span></p>
        <label for="add_crop_seal_image"
               class="btn-upload btn-success" style="margin-bottom: 0px;">印鑑選択</label>
        <input type="file" id="add_crop_seal_image" name="add_crop_seal_image" style="display:none; font-size: 14px;">
        <input class="btn btn-success" type=button value="撮影" onClick="take_snapshot()">
        <input class="btn btn-success" type=button value="リセット" onClick="reset_webcam()">
        <button type="button" class="btn btn-danger" onclick="webcam_close();" id="webcam_close"> 戻る
        </button>
    </div>
</div>
<!-- end web cam section -->


<?php

$this->load->view('components/partner_registration');
?>

<?php
//        $this->load->view('components/settlement_letter_mail');
$this->load->view('components/view_settlement_letter');
?>
<?php
$this->load->view('components/settlement_list_sent_received_main');
?>
<?php
$this->load->view('components/user_list_for_admin_main');
?>
<script>
    var resize = $('#upload-demo').croppie({
        enableExif: true,
        enableOrientation: true,
        viewport: { // Default { width: 100, height: 100, type: 'square' }
            width: 90,
            height: 90,
            type: 'circle' //square
        },
        boundary: {
            width: 200,
            height: 200
        }
    });

    $('#add_crop_seal_image').on('change', function () {
        var filename = this.files[0].name;
        $('#crop_seal_image_name').show();
        $('#crop_seal_image_name').text(filename);

        var reader = new FileReader();
        reader.onload = function (e) {
            resize.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('seccess');

            });
            document.getElementById('results').innerHTML =
                '<img width="180" height="220" style="display: " id="imageprev" src="' + e.target.result + '"/>';
//                console.log(e.target.result); // base64 image
        }
//            console.log(this.files[0]); // file object
        reader.readAsDataURL(this.files[0]);

        $("#my_camera").hide();
        $("#canvas_div").hide();
        $("#results").show();
        $("#crop_seal_image_popup").show();

        $("#webcam_text").hide();
    });


    $('.btn-upload-image').on('click', function (ev) {
        resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (img) {
//                console.log(img);
            var html = '<img id="crop_image_name" src="' + img + '" />';
            $("#preview-crop-image").html(html);

            document.getElementById('final_cropped_seal_image').src = img;
//                $("#crop_seal_image_yesno_popup").show();
            show_configuration_yesno_popup();
        });
    });

    function configure() {
        $("#webcam_popup").show();
        $("#webcam_text").show();
        $("#my_camera").show();

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
            var facingmode_type='environment'; // back camera
        }else{
            var facingmode_type='user'; // front camera
        }
        var gum =
            navigator.mediaDevices.getUserMedia({video: {facingMode: {exact: facingmode_type}}})
                .then(stream => (video.srcObject = stream))
    .catch(e => log(e));
//        document.getElementById('results').innerHTML = '';
//        var base_url = $("#base_url").val();
//        var script = document.createElement("script");
//        script.type = "text/javascript";
//        script.src = base_url + "resource/js/html5_camera_main.js";
//        script.id = "script1";
//        document.getElementsByTagName("head")[0].appendChild(script);
    }

    var video = document.querySelector("#video");
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');

    function take_snapshot() {
        $("#my_camera").hide();
        $("#canvas_div").show();
        $("#crop_seal_image_popup").show();
//        console.log(video.videoHeight+','+video.videoWidth)
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        var dataURL = canvas.toDataURL();
        document.getElementById('results').innerHTML =
            '<img style="display: none" id="imageprev" src="' + dataURL + '"/>';

        $("#webcam_text").hide();

        var webcam_image_name = $("#imageprev").attr('src');
//        console.log(webcam_image_name);
        $('#upload-demo').croppie('bind', {
            url: webcam_image_name
//            url: 'resource/img/seal_images/examination1.jpg'
        }).then(function () {
            console.log('seccess');

        });
    }

    function webcam_close() {
        $("#webcam_popup").hide();
        $("#crop_seal_image_popup").hide();
        $("#canvas_div").hide();
        $("#results").hide();
        $('#crop_seal_image_name').hide('');
//        stream.getTracks().forEach(track => track.stop());

        var stream = video.srcObject;
        var tracks = stream.getTracks();

        tracks.forEach(function(track) {
            track.stop();
        });

        video.srcObject = null;

//        $('#script1').attr('src').remove();
//        document.getElementsByTagName('head')[0].removeChild(document.getElementsByTagName('head')[0].getElementsByTagName('script')[4]);

    }

    function reset_webcam() {
        $("#my_camera").show();
        $("#crop_seal_image_popup").hide();
        $("#done_configuration_seal_image_insert_message").hide();
        $("#done_configuration_seal_image_insert_message1").hide();
        $("#configuration_seal_image_form").hide();
        $("#canvas_div").hide();
        document.getElementById('results').innerHTML = '';

    }


</script>

<!--<script src="--><?php //echo base_url('resource/js/html5_camera_main.js'); ?><!--"></script>-->
