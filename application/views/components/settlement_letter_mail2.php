<?php
if (isset($settlement_id)) {
    if ($president_seal_id != 0) {
        $decision_document_disable = 'pointer-events:none';
        $done_settlement_button = 'pointer-events:none';
        $delete_documents_button = 'pointer-events:none';
    } else {
        $decision_document_disable = '';
        $done_settlement_button = '';
        $delete_documents_button = '';
    }
} else {
    $decision_document_disable = 'pointer-events:none';
    $done_settlement_button = '';
    $delete_documents_button = '';
}

?>
<script src="<?php echo base_url('resource/js/jquery.min.js'); ?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/dist/css/bootstrap.min.css'); ?>"/>

<style>
    .share_mail > tbody > tr.active > td {
        background-color: yellow;
    }

    .share_mail > tbody > tr.danger > td {
        background-color: yellow;
    }

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
    }

    .btn-upload {
        /*display: inline-block;*/
        padding: 11px 12px 8px 12px;
        margin-bottom: 5px;
        font-size: 14px;
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
        font-size: 14px;
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
        #done_settlement, #close_settlement_letter_form, #close_settlement_letter_aria, #delete_documents, #settlement_letter_aria, #close_settlement_letter_form_section {
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

    .enable_to_multi_share1 {
        background-color: yellow;
    }

    #partnerr_row {
        cursor: pointer;
    }

    .decision_document_disable {
        pointer-events: none;
    }

</style>

<script>
    jQuery(document).ready(function ($) {

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
            var textarea_exit_maxlength_error = $("#textarea_exit_maxlength_error");

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
            if (!textarea_exit_maxlength_error.is(e.target) && textarea_exit_maxlength_error.has(e.target).length === 0) {
                textarea_exit_maxlength_error.hide();
            }


        });


        $("#files").change(function () {
            var filename = this.files[0].name;
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

        $("#close_settlement_letter_aria").click(function (event) {
            $("#settlement_letter_aria1").toggle(1000);
//            $("#text_change").toggleText("戻る","窓");

//            $(this).text(function(i, v){
//                return v === '窓' ? '戻る' : '窓'
//            });
            // $("#settlement_letter_aria").removeClass('show').addClass('hide');
        });

        $("#settlement_table_close").click(function (event) {
            $("#view_settlement_letter").removeClass("show").addClass("hide");
            $("#delete_confirm_alert").removeClass("show").addClass("hide");
            $("#settlement_letter_aria").show();
        });

        $("#settlement_letter_choice1").on('click', function (event) {
//            location.reload();
            self.location = $("#base_url").val() + 'index.php/wordapp/view_settlement_form/';
        });
        $("#settlement_letter_choice4,#settlement_letter_choice5").click(function (event) {
            event.preventDefault();
//            alert(this.id);
            var id = this.id;
            $("#settlement_letter_aria").hide();
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
            } else {
                var view_type = 5;
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
                    document.getElementById('settlement_list').innerHTML = html;

                    if (id == 'settlement_letter_choice4') {
                        $('.span-title-list-files').text('決裁履歴');
                    } else {
                        $('.span-title-list-files').text('決裁済');
                    }

                    $("td.settlement_title").each(function () {
                        var DELAY = 1000, clicks = 0, timer = null;
                        $(this).on("click", function () {
                            var settlement_id = $(this).children('.settlement_id').val();
                            var is_share = $(this).children('.is_share').val();
                            clicks++;  //count clicks
                            $('td.settlement_title').removeClass("checked");
                            $(this).addClass("checked");
                            if (clicks === 1) {
                                $("#select_settlement").removeClass('show').addClass('hide');
                                timer = setTimeout(function () {

                                    clicks = 0;  //after action performed, reset counter
                                    if (settlement_id !== undefined) {
                                        // alert(settlement_id);
                                        $(this).addClass("checked");
                                    } else {
                                        $('td.settlement_title').removeClass("checked");
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
                                $("#view_settlement_letter").removeClass("show").addClass("hide");
                                window.open(base_url + 'index.php/wordapp/view_settlement_form/' + settlement_id + '/' + share_this_settlement_id + '/' + back_one_step, "New Window", style);
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


//        start share form with others
        $("#share_settlement_form").on('click', function (event) {
//            alert('hi');die();
            event.preventDefault();
            // Init Partner table
            multiple_partner_id = [];
            multiple_partner_name = [];
            $("#email_share_navi_user_list").removeClass('show').addClass('hide');
            var enable_email_multi_share = $("#enable_email_multi_share").val();
//            alert(enable_email_multi_share);
            if (enable_email_multi_share == 1) {
//                $("#table_of_partner tr").removeClass('enable_to_multi_share');
//                $("#enable_email_multi_share").val(0);
//                $("#email_multiple_share").addClass('btn-success');
//                $("#email_multiple_share").css("background-color", "#419641");
//                $("#email_share_navi_message_aria").removeClass('show').addClass('hide');
            } else {
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
        });

        $("#close_partner").on('click', function (event) {
            event.preventDefault();
            $('#table_of_partner').removeClass('show').addClass('hide');
            $("#settlement_letter_aria").show();
        });

        $("#seal_image").on('click', function (event) {
            event.preventDefault();
            window.open("http://www.hakusyu.com/webmtm/");
        });

        $("#close_email_share_navi_user_list").on('click', function (event) {
            event.preventDefault();
            $("#email_share_navi_user_list").removeClass('show').addClass('hide');
        });

        $("#close_settlement_title_empty_message").on('click', function (event) {
            event.preventDefault();
            $("#settlement_title_empty_message").hide();
        });

        $("#close_enter_settlement_title_message").on('click', function (event) {
            event.preventDefault();
            $("#enter_settlement_title_message").hide();
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

        $("#edit_confirm_no_partner_button_settlement").on('click', function (event) {
            event.preventDefault();
            $("#edit_partner_confirmation_popup").hide();
        });

        $("#close_settlement_letter_form").on('click', function (event) {
            event.preventDefault();
            var president_seal_id = $("#president_seal_id").val();
//            alert(president_seal_id);
            var back_one_step = $("#back_one_step").val();
            if (back_one_step == 2) {
                if (president_seal_id == 0) {
                    $("#settlement_letter_choice4").trigger('click');
                } else {
                    $("#settlement_letter_choice5").trigger('click');
                }
            } else {
                window.close();
                return false;
            }

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
            $("#done_configuration_seal_image_insert_message").hide();
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
                    user_id: user_id
                }),
                contentType: "application/json",
            })
                .done(function (data) {
//                    alert(data);console.log(data);die();
                    $("#partner_container").html(data);
                    // $("#load_table_of_partner").html(data);
                    console.log("success");
                    $("#loader_partner_list").hide();

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
            var email_multiple_share = $("#enable_email_multi_share").val();

            if (email_multiple_share == 1) {

                var this_partner_id = $(this).children('.partner_id').val();
                var share_partner_name = $(this).children('.share_partner_name').val();
                if (this_partner_id != undefined) {
                    if (jQuery.inArray(this_partner_id, multiple_partner_id) == -1) {

                        multiple_partner_id.push(this_partner_id);
                        multiple_partner_name.push(share_partner_name);
                    }
                    var enable_email_multi_share = $("#enable_email_multi_share").val();
                    if (enable_email_multi_share == 1) {
                        if (multiple_partner_name.length > 0) {
                            $("#email_share_navi_user_list").removeClass('hide').addClass('show');
                            var htmlSting = "";
                            for (var i = 0; i < multiple_partner_name.length; i++) {
                                htmlSting += '<li class="pull-left" style="width: 50%">' + multiple_partner_name[i] + '</li>';
                            }
                            $("#share_multiple_partner_list").html(htmlSting);
                        }
                    }
                    $(this).addClass('enable_to_multi_share1');

                }

            } else {
                $(this).addClass('active edit_partner');
            }
        });

        $("#share_email_selected_partner1").on('click', function (event) {
            event.preventDefault();
            var base_url = $("#base_url").val();
            var email_id = $("#reply_mail_id").val();
            var login_user_id = $("#login_user_id").val();
            var settlement_id = $("#settlement_id").val();

            var deployment_name = $("#deployment_name").val();
            var name_printing = $("#name_printing").val();
            var settlement_title = $("#settlement_title").val();
            var conclusion = $("#conclusion").val();
            var reason = $("#reason").val();
            var case_study = $("#case_study").val();
            var others = $("#others").val();
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
            var settlement_id = $(".checked").children('.settlement_id').val();
            var settlement_title = $(".checked").text();
            var base_url = $("#base_url").val();
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
                $("#view_settlement_letter").removeClass("show").addClass("hide");
                window.open(base_url + 'index.php/wordapp/view_settlement_form/' + settlement_id, "New Window", style);

            }
        });


        $("#delete_settlement").click(function () {
//            $("#delete_confirm_alert").removeClass('hide').addClass('show');
//            die();
            var settlement_id = $(".checked").children('.settlement_id').val();
            var settlement_title = $(".checked").text();
            var base_url = $("#base_url").val();
//            alert($("#settlement_letter_choice4").val());
            if (settlement_id === undefined) {

                $("#select_settlement").removeClass('hide').addClass('show');
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

                $("#delete_confirm_settlement").click(function (event) {
//                    alert(settlement_title);die();
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
//                            alert(response_val);die();
                            if (response_val == 'success') {
                                $("#delete_confirm_alert").removeClass('show').addClass('hide');
                                window.location = base_url + 'index.php/wordapp/view_settlement_form/';
//                                $('#settlement_letter_choice4').trigger('click');
                            }


                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            //if fails
                            alert(textStatus);
                        }
                    });

                });


            }
        });


        $("#delete_partner_button_settlement").on('click', function (event) {
            $("#table_of_partner tr").removeClass('enable_to_multi_share1');
            $("#enable_email_multi_share").val(0);
            $("#send_email_form_partner_addto").addClass('btn-success');
            $("#send_email_form_partner_addto").css("background-color", "#419641");
            $("#email_share_navi_user_list").removeClass('show').addClass('hide');
            $("#email_share_navi_message_aria").removeClass('show').addClass('hide');

            var partner_id = $(".edit_partner").children('.partner_id').val();
            if (partner_id === undefined) {
                $("#delete_email_partner_message").show();
                $("#eidt_email_partner_message").removeClass('show').addClass('hide');
            } else {
                var partner_name = $(".edit_partner .input_partner_name").val();
                $("#delete_partner_confirmation_popup").show();
                $("#delete_email_partner_message").hide();
                $('#show_delete_partner_name').text(partner_name);
            }
//            alert(partner_id);
        });

        $("#delete_confirm_partner_button_settlement").on('click', function (event) {
            var partner_id = $(".edit_partner").children('.partner_id').val();
            var base_url = $("#base_url").val();
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
//            alert('hiSav');die();
            var base_url = $("#base_url").val();
            var url = base_url + "index.php/api/emailing/save_partner";
            var api_key = $('#api_key').val();
            var user_id = $("#user_id").val();
            if (id == 1) {
                var partner_name = $("#partner_name").val();
                var company = $("#company").val();
                var partner_mobile = $("#partner_mobile").val();
            } else {
                var partner_name = $("#new_partner_name").val();
                var company = $("#new_partner_company").val();
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
                        partner_mobile: partner_mobile
                    }),
                    contentType: "application/json",
                })
                    .done(function (data) {
//                        alert(data);die();
                        $("#ajax_loading_aria").hide();
//                        console.log(data);
//                        die();
                        var data = JSON.parse(data);
                        if (data.message == 'success') {
                            if (partner_name != '') {
                                $("#add_email_partner_message_confirm").show();
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
                $("#new_partner_name").val('');
                $("#new_partner_company").val('');
                $("#new_partner_mobile").val('');

                $("#email_share_navi_message_aria").hide();
                $("#new_partner_registration_form").show();
            }
        }

        function save_edit_partner1() {
//            alert('hi');die();
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
                    },
                    data: JSON.stringify({
                        api_key: api_key,
                        user_id: user_id,
                        partner_id: edit_partner_id,
                        partner_name: partner_name,
                        company: company,
                        partner_mobile: partner_mobile
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
                            get_user_partners();
                        } else if (data.message == 'invalid partner') {
                            $("#invalid_partner_error_message").show();
                            $("#email_share_navi_message_aria").removeClass('show').addClass('hide');
                        } else {
                            alert(data.message);
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
            }
        }

    });

    function limitTextarea(textarea, maxLines, maxChar) {

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


    function validate_settlement_form() {
        //alert("Hii");
        var settlement_title = $("#settlement_title").val();
        var name_printing = $("#name_printing").val();
        var settlement_id = $("#settlement_id").val();
//        console.log(settlement_title);
        var base_url = $("#base_url").val();
        if ($("#is_share").val() == 1)
            var share_this_settlement_id = 1;
        else
            var share_this_settlement_id = 0;
        var president_seal_id = $("#president_seal_id").val();

        if (settlement_title != '' && name_printing != '') {
//            alert("Hii");
//            setTimeout(function () {
            $("#settlement_title_empty_message").hide();
            //alert(isFormValid);
//            if (settlement_id == 0) {
//                $("#save_settlement_letter_form_message").show();
//            } else {
//                $("#edit_settlement_letter_form_message").show();
//            }


            var settlement_letter_form = document.getElementById("settlement_letter_form");
            var form_data = new FormData(settlement_letter_form);
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
                    if (doc_exist == 1 && settlement_id2 > 0) {
                        $('#document_loader').hide();
                        window.location = base_url + 'index.php/wordapp/view_settlement_form/' + settlement_id2 + '/' + share_this_settlement_id;
                    } else {
                        $('#document_loader').hide();
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
            $("#enter_settlement_title_message").show();
            return false;
        }
//        if (share_this_settlement_id == 1) {
//            $(':input').attr('readonly', 'readonly');
//            return false;
//        }

    }


    function show_seal_image_password_form(id) {
//        alert('hi');
        $("#seal_image_password_form").show();
        var seal_image_type = $("#seal_image_type").val(id);
        $("#seal_image_password").val('');
    }

    function seal_image_password_form_close() {
        $("#seal_image_password_form").hide();
    }

    function change_seal_image(id) {

        if (id == 'change_seal_image') {
            $("#seal_image_change_password_confirmation_popup").show();
            $("#seal_image_password_form").hide();
        }
        if (id == 'change_seal_image_complete') {
            var current_password = $("#seal_image_current_password").val();
            var new_password = $("#seal_image_new_password").val();
            var seal_image_type = $("#seal_image_type").val();
//        alert(seal_image_type);die();
            var base_url = $("#base_url").val();
//        $('.wait_for_saving').show();
            $.ajax({
                url: base_url + "index.php/wordapp/change_seal_image_password",
                type: "POST",
                data: {
                    password: new_password,
                    seal_image_type: seal_image_type
                },
                async: false,
                cache: false,
                dataType: "text",
                success: function (response, textStatus, jqXHR) {
                    var response_val = response.trim();
//                alert(response_val);die();
//                    alert('パスワードの変更が完了しました'); // Password change completed
                    $('#seal_image_change_password_confirmation_message').show();
//                    setTimeout(function () {
//                        $('#seal_image_change_password_confirmation_message').fadeOut(600);
//                    }, 5000);
                    $('#seal_image_password_form').hide();
                    $("#seal_image_change_password_form").hide();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                    alert(textStatus);
                }
            });
        }
        if (id == 'yes') {
            $("#seal_image_current_password").val('');
            $("#seal_image_new_password").val('');

            $("#seal_image_change_password_form").show();
            $("#seal_image_change_password_confirmation_popup").hide();
        }
        else if (id == 'no') {
            $("#seal_image_change_password_confirmation_popup").hide();
            $("#seal_image_password_form").show();
        }

    }

    function close_div_msg() {
        $("#eidt_email_partner_message").removeClass('show').addClass('hide');
    }

    function seal_image_change_password_form_close() {
        $("#seal_image_change_password_form").hide();
    }

    function configuration_seal_image() {
        $("#configuration_seal_image_form").show();
        $("#add_seal_image_password").val('');
        $("#seal_image_name").text('');
    }

    function show_configuration_yesno_popup() {
        $("#configuration_seal_image_confirmation_popup").show();
        $("#configuration_seal_image_form").hide();
        $("#seal_image_password_form").hide();

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
        if (id == 'no') {
            $("#configuration_seal_image_confirmation_popup").hide();
        } else if (id == 'yes') {

            $("#configuration_seal_image_confirmation_popup").hide();

            var add_password = $("#add_seal_image_password").val();
            var seal_image_type = $("#seal_image_type").val();
//            var file_data1 = $('#add_seal_image').prop('files')[0];
            var file_data1 = document.getElementById('add_seal_image').files[0];
            var form_data1 = new FormData();
            form_data1.append('userfile', file_data1);
            form_data1.append("add_password", add_password);
            form_data1.append("seal_image_type", seal_image_type);
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
//                alert(response_val);die();
                    if (response_val == 2) { // password already exist
//                        $("#configuration_seal_image_confirmation_popup").show();
                        $("#configuration_seal_image_form").show();
                        $("#password_exist_message").show();
                    }
                    if (response_val == 1) {
                        $("#done_configuration_seal_image_insert_message").show();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                    alert(textStatus);
                }
            });
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
//                alert(response_val);die();
                if (response_val < 0) {
                    $("#incorrect_password_message").show();
//                    alert('パスワードが間違っているか、イメージが存在しません');
                } else {
                    var response_val_array = response_val.split('#####');
                    var img = response_val_array[0];
                    var seal_image_type = response_val_array[1];
//                    alert(seal_image_type);
                    var get_seal_id = response_val_array[2];
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

    function delete_decision_documents() {
        var document_encrypted_name = $("#document_encrypted_name").val();
        var settlement_id = $("#settlement_id").val();
//        alert(settlement_id);
        var base_url = $("#base_url").val();
//        $('.wait_for_saving').show();
        $.ajax({
            url: base_url + "index.php/wordapp/delete_documents",
            type: "POST",
            data: {
                document_encrypted_name: document_encrypted_name,
                settlement_id: settlement_id
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
</script>

<div style="width:100%; text-align: center;">
    <p style="text-align: right" id="close_settlement_letter_form_section">
        <button type="button" class="btn btn-warning pull-right btn_table" id="close_settlement_letter_form" onclick="window.close();return false;"
                style="margin-right: 0px;">戻る
            <!--            onclick="window.close();return false;"-->
        </button>
        <button type="button" class="btn btn-success pull-right btn_table" id="share_settlement_form"
                style="margin-right: 5px;" onclick="">共有

        </button>
    </p>
    <p>
    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-8 pull-right settlement_letter_aria" id="settlement_letter_aria"
         style="position: fixed; padding: 4px; border-radius: 2px; z-index:9999; right:22px; bottom:5px;">
        <!--        <div class="col-lg-6" style="padding: 0; float:right">-->
        <!--            <button type="button" style="margin-bottom: 10px; margin-right: 0;"-->
        <!--                    class="btn btn-warning pull-right btn_keipro1" id="close_settlement_letter_aria">戻る</span>-->
        <!--            </button>-->
        <!--        </div>-->
        <!--        <div class="clearfix"></div>-->
        <div class="col-lg-12"
             style="padding: 0; padding: 4px; background-color: #FFFFFF; border-radius: 2px;  box-shadow: 1px 2px 2px 4px #ccc;"
             id="settlement_letter_aria1">
            <!-- <div class="font_family_aria_parent">
            <div class="font_family_aria_child"> -->
            <table class="table table-bordered" style="margin-bottom: 0;">
                <tr>
                    <td id="settlement_letter_choice1" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                       type="checkbox"
                                                                                       name="settlement_letter_choice"
                                                                                       value="purchase"> 物品購入
                    </td>
                </tr>
                <tr>
                    <td id="settlement_letter_choice2" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                       type="checkbox"
                                                                                       name="settlement_letter_choice"
                                                                                       value="expenses"> 交通費
                    </td>
                </tr>
                <tr>
                    <td id="settlement_letter_choice3" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                       type="checkbox"
                                                                                       name="settlement_letter_choice"
                                                                                       value="other"> その他
                    </td>
                </tr>
                <tr>
                    <td id="settlement_letter_choice4" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                       type="checkbox"
                                                                                       name="settlement_letter_choice"
                                                                                       value="history"> 履歴
                    </td>
                </tr>
                <tr>
                    <td id="settlement_letter_choice5" style="cursor: pointer;"><input style="cursor: pointer;"
                                                                                       type="checkbox"
                                                                                       name="settlement_letter_choice"
                                                                                       value="resolved"> 決裁済
                    </td>
                </tr>

            </table>
            <!-- </div>
        </div>  -->
        </div>
        <div class="clearfix"></div>
    </div>
    </p>
    <div style="width:795px;display: inline-block;">
        <form class="settlement_letter_form" id="settlement_letter_form" name="settlement_letter_form" method="post"
              enctype="multipart/form-data"
              action="<?php echo base_url(); ?>index.php/wordapp/save_settlement_letter_form/">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="right">
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
                    </td>
                    <td height="30" align="center">&nbsp;</td>
                </tr>
                <tr>
                    <td height="30" align="center" style="font-size: 28px;font-family: ms mincho, ｍｓ 明朝;">決　裁　書</td>
                    <td width="8%">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <table width="100%" border="0" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">
                            <tr>
                                <td height="80" colspan="2" align="center" valign="bottom" bgcolor="#FFFFFF">
                                    <table style="margin-bottom: 5px;" class="table_style" width="100%" cellpadding="0"
                                           cellspacing="0">
                                        <tr>
                                            <td class="td_style" width="20%" height="50" align="center">最終<br>
                                                決裁者
                                            </td>
                                            <td style="border-left:solid black 1px;" width="182" align="center">審　査</td>
                                            <td style="border-left:solid black 1px;" width="20%" align="center">審　査</td>
                                            <td style="border-left:solid black 1px;" width="20%" align="center">審　査</td>
                                            <td style="border-left:solid black 1px;" width="20%" align="center">審　査</td>
                                        </tr>
                                        <tr>
                                            <td align="center" width="20%" height="70"
                                                style="border-top:solid black 1px; cursor: pointer; font-size:14px;"
                                                onclick="show_seal_image_password_form(this.id);"
                                                id="1">
                                                <?php
                                                if (isset($settlement_id)) {
                                                    if ($president_seal_id != 0) {
                                                        ?>
                                                        <img height='50'
                                                             src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $president_seal_img; ?>"/>
                                                        <?php
                                                    } else {
                                                        echo '<span id="click_here_text">ここをクリック
</span>';
                                                    }
                                                } else {
                                                    ?>
                                                    <span id="click_here_text">ここをクリック</span>

                                                    <?php
                                                }
                                                ?>
                                                <!--                                        <input class="input_style1" type="text" id="president_seal_img" name="president_seal_img">-->
                                            </td>
                                            <td align="center" width="20%"
                                                style="border-left:solid black 1px;border-top:solid black 1px; cursor: pointer; font-size:14px;"
                                                onclick="show_seal_image_password_form(this.id);"
                                                id="2">
                                                <?php
                                                if (isset($settlement_id)) {
                                                    if ($examination1_seal_id != 0) {
                                                        ?>
                                                        <img height='50'
                                                             src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $examination1_seal_img; ?>"/>
                                                        <?php
                                                    } else {
                                                        echo '<span id="click_here_text">ここをクリック</span>';
                                                    }
                                                } else {
                                                    ?>
                                                    <span id="click_here_text">ここをクリック</span>

                                                    <?php
                                                }
                                                ?>

                                                <!--                                                <input-->
                                                <!--                                                        class="input_style1" type="text" id="examination1_seal_img"-->
                                                <!--                                                        name="examination1_seal_img">-->
                                            </td>
                                            <td align="center" class="td_style" width="20%"
                                                style="border-left:solid black 1px;border-top:solid black 1px; cursor: pointer; font-size:14px;"
                                                onclick="show_seal_image_password_form(this.id);"
                                                id="3">
                                                <!--                                                <input-->
                                                <!--                                                        class="input_style1" type="text" id="examination2_seal_img"-->
                                                <!--                                                        name="examination2_seal_img">-->
                                                <?php
                                                if (isset($settlement_id)) {
                                                    if ($examination2_seal_id != 0) {
                                                        ?>
                                                        <img height='50'
                                                             src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $examination2_seal_img; ?>"/>
                                                        <?php
                                                    } else {
                                                        echo '<span id="click_here_text">ここをクリック</span>';
                                                    }
                                                } else {
                                                    ?>
                                                    <span id="click_here_text">ここをクリック</span>

                                                    <?php
                                                }
                                                ?>                                            </td>
                                            <td align="center" class="td_style" width="20%"
                                                style="border-left:solid black 1px;border-top:solid black 1px; cursor: pointer; font-size:14px;"
                                                onclick="show_seal_image_password_form(this.id);"
                                                id="4"
                                            ">
                                            <!--                                                <input-->
                                            <!--                                                        class="input_style1" type="text" id="examination3_seal_img"-->
                                            <!--                                                        name="examination3_seal_img">-->
                                            <?php
                                            if (isset($settlement_id)) {
                                                if ($examination3_seal_id != 0) {
                                                    ?>
                                                    <img height='50'
                                                         src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $examination3_seal_img; ?>"/>
                                                    <?php
                                                } else {
                                                    echo '<span id="click_here_text">ここをクリック</span>';
                                                }
                                            } else {
                                                ?>
                                                <span id="click_here_text">ここをクリック</span>

                                                <?php
                                            }
                                            ?> </td>
                                            <td align="center" class="td_style" width="20%"
                                                style="border-left:solid black 1px;border-top:solid black 1px; cursor: pointer; font-size:14px;"
                                                onclick="show_seal_image_password_form(this.id);"
                                                id="5">

                                                <!--                                                <input-->
                                                <!--                                                        class="input_style1" type="text" id="examination4_seal_img"-->
                                                <!--                                                        name="examination4_seal_img">-->
                                                <?php
                                                if (isset($settlement_id)) {
                                                    if ($examination4_seal_id != 0) {
                                                        ?>
                                                        <img height='50'
                                                             src="<?php echo base_url(); ?>resource/img/seal_images/<?php echo $examination4_seal_img; ?>"/>
                                                        <?php
                                                    } else {
                                                        echo '<span id="click_here_text">ここをクリック</span>';
                                                    }
                                                } else {
                                                    ?>
                                                    <span id="click_here_text">ここをクリック</span>

                                                    <?php
                                                }
                                                ?>                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="1%" bgcolor="#FFFFFF">&nbsp;</td>
                                <td width="30%" bgcolor="#FFFFFF">
                                    部署名<input maxlength="10" onblur="validate_settlement_form();" class="input_style2"
                                              type="text"
                                              id="deployment_name"
                                              name="deployment_name"
                                              value="<?php if (isset($deployment_name)) echo $deployment_name; ?>" <?php if (isset($settlement_id)) {
                                        if ($president_seal_id != 0) { ?> readonly="true" <?php } else {
                                        }
                                    } ?>>
                                    <hr>
                                    <br>
                                    氏名<input style="width: 45%;" maxlength="10" onblur="validate_settlement_form();"
                                             class="input_style2"
                                             type="text"
                                             id="name_printing" name="name_printing"
                                             value="<?php if (isset($name_printing)) echo $name_printing; ?>" <?php if (isset($settlement_id)) {
                                        if ($president_seal_id != 0) { ?> readonly="true" <?php } else {
                                        }
                                    } ?>><span style="cursor: pointer;" id="6"
                                               onclick="show_seal_image_password_form(this.id);"><?php
                                        if (isset($settlement_id)) {
                                            if ($name_printing_seal_id != 0) {
                                                ?><img style="margin-left:30px;" height='50'
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

                            <tr id="document_loader" style="display: none;">
                                <td style="padding-left:580px;" colspan="4" align="left" bgcolor="#FFFFFF"><img
                                            src="<?php echo base_url(); ?>resource/img/ajax/ajax_load_9.gif"></td>
                            </tr>
                            <tr>
                                <td colspan="4" valign="middle" bgcolor="#FFFFFF" align="left"><input
                                            id="settlement_title" name="settlement_title" size="50" type="text"
                                            onblur="validate_settlement_form();"
                                            placeholder="タイトル"
                                            style="margin-left:3px; margin-bottom:5px; border: 2px solid black; padding: 7px;font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px; ime-mode:active;"
                                            value="<?php if (isset($settlement_title)) echo $settlement_title; ?>" <?php if (isset($settlement_id)) {
                                        if ($president_seal_id != 0) { ?> readonly="true" <?php } else {
                                        }
                                    } ?>>&nbsp;<?php if ($document_name != '') { ?>
                                        <a id="decision_documents_url" target="_blank"
                                           href='<?php echo base_url(); ?>resource/img/decision_documents/<?php echo $document_encrypted_name; ?>'><?php echo $document_name; ?></a>
                                        <?php if ($share_this_settlement_id != 1) { ?>
                                        <button style="<?php echo $delete_documents_button; ?>" type="button"
                                                id="delete_documents" class="btn btn-warning"
                                                onclick="delete_decision_documents();">削除
                                            </button><?php }
                                    } else { ?><label for="files"
                                                      class="btn-upload btn-success"
                                                      style="<?php echo $decision_document_disable; ?>">
                                            添付書類</label>
                                        <input name="files" id="files" style="display:none;" type="file"><span
                                                style="display: none" id="file_name">file name</span>
                                    <?php } ?>                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="table_style1" width="100%" style="margin-top: 0px;" cellpadding="0"
                                           cellspacing="0">
                                        <tr>
                                            <td width="50" rowspan="3" align="center"><br/><br/><br/> 決<br/> <br/>栽<br/><br/>
                                                事<br/><br/>項
                                            </td>
                                            <td style="border-left:solid black 1px; padding-left: 7px; padding-top: 7px;"
                                                width="1112" height="100" colspan="3" valign="top">結論（目的）：
                                                <hr style="width:90%; margin-top: 7px; margin-bottom: 3px;">
                                                <textarea onkeyup="limitTextarea(this,8,300)" cols="20" rows="8"
                                                          maxlength="300" onblur="validate_settlement_form();"
                                                          id="conclusion"
                                                          name="conclusion" class="input_style"

                                                          placeholder="ここに入れてください." <?php if (isset($settlement_id)) {
                                                    if ($president_seal_id != 0) { ?> readonly="true" <?php } else {
                                                    }
                                                } ?>><?php if (isset($conclusion)) echo $conclusion; ?></textarea>
                                                <!--                                        <div id="content_remaining" style="text-align:center; width:71%; float: left;">600 characters remaining.</div>-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border-left:solid black 1px;border-top:solid black 1px; padding-left: 7px; padding-top: 7px;"
                                                height="100" colspan="3" valign="top">理由（手段）：<textarea
                                                        onblur="validate_settlement_form();" class="input_style"
                                                        id="reason" name="reason" maxlength="300"
                                                        onkeyup="limitTextarea(this,8,300)"
                                                        placeholder="ここに入れてください." <?php if (isset($settlement_id)) {
                                                    if ($president_seal_id != 0) { ?> readonly="true" <?php } else {
                                                    }
                                                } ?>><?php if (isset($reason)) echo $reason; ?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td style="border-left:solid black 1px;border-top:solid black 1px; padding-left: 7px; padding-top: 7px;"
                                                height="100" colspan="3" valign="top">事例：<textarea
                                                        onblur="validate_settlement_form();" class="input_style"
                                                        id="case_study"
                                                        name="case_study"
                                                        maxlength="300"
                                                        onkeyup="limitTextarea(this,8,300)"
                                                        placeholder="ここに入れてください." <?php if (isset($settlement_id)) {
                                                    if ($president_seal_id != 0) { ?> readonly="true" <?php } else {
                                                    }
                                                } ?>><?php if (isset($case_study)) echo $case_study; ?></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="td_style" align="center">意<br/><br/>見</td>
                                            <td style="border-left:solid black 1px;border-top:solid black 1px; padding-left: 7px; padding-top: 7px;"
                                                height="100" colspan="3"><textarea onblur="validate_settlement_form();"
                                                                                   class="input_style" id="others"
                                                                                   name="others" maxlength="300"
                                                                                   onkeyup="limitTextarea(this,8,300)"
                                                                                   placeholder="ここに入れてください." <?php if (isset($settlement_id)) {
                                                    if ($president_seal_id != 0) { ?> readonly="true" <?php } else {
                                                    }
                                                } ?>><?php if (isset($others)) echo $others; ?></textarea></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"><br/>
                                    <?php if ($share_this_settlement_id != 1) { ?>
                                        <button type="button" id="done_settlement" class="btn btn-primary"
                                                onclick="validate_settlement_form();"
                                                style="<?php echo $done_settlement_button; ?>">完了
                                        </button>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <input type="hidden" id="settlement_id" name="settlement_id"
                   value="<?php if (isset($settlement_id)) echo $settlement_id; else echo 0; ?>">
            <input type="hidden" id="is_deleted" name="is_deleted"
                   value="<?php if (isset($is_deleted)) echo $is_deleted; else echo 0; ?>">
            <input type="hidden" id="created_by" name="created_by"
                   value="<?php if (isset($created_by)) echo $created_by; else echo 0; ?>">
            <input type="hidden" id="is_share" name="is_share"
                   value="<?php if (isset($is_share)) echo $is_share; else echo 0; ?>">
            <input type="hidden" id="settlement_id_email" name="settlement_id_email"
                   value="0">
            <input type="hidden" name="api_key" value="<?= base64_encode($this->config->item("api_key")) ?>"
                   id="api_key">
            <input type="hidden" name="document_encrypted_name" id="document_encrypted_name"
                   value="<?php if ($document_encrypted_name != '') echo $document_encrypted_name; else echo ''; ?>">
            <input type="hidden" name="reply_mail_id" id="reply_mail_id"
                   value=" ">
            <input type="hidden" id="draft_value" value="1" name="draft_value">
            <input type="hidden" name="drft_email_id" value="" id="drft_email_id">
            <input type="hidden" id="user_id" value="<?= base64_encode($this->session->userdata('account_id')) ?>"
                   name="user_id">
            <input type="hidden" name="base_url" id="base_url" value="<?= base_url() ?>">
            <input type="hidden" name="seal_image_type" id="seal_image_type" value="">
            <input type="hidden" name="president_seal_id" id="president_seal_id"
                   value="<?php if (isset($president_seal_id)) echo $president_seal_id; else echo 0; ?>">
            <input type="hidden" name="examination1_seal_id" id="examination1_seal_id"
                   value="<?php if (isset($examination1_seal_id)) echo $examination1_seal_id; else echo 0; ?>">
            <input type="hidden" name="examination2_seal_id" id="examination2_seal_id"
                   value="<?php if (isset($examination2_seal_id)) echo $examination2_seal_id; else echo 0; ?>">
            <input type="hidden" name="examination3_seal_id" id="examination3_seal_id"
                   value="<?php if (isset($examination3_seal_id)) echo $examination3_seal_id; else echo 0; ?>">
            <input type="hidden" name="examination4_seal_id" id="examination4_seal_id"
                   value="<?php if (isset($examination4_seal_id)) echo $examination4_seal_id; else echo 0; ?>">
            <input type="hidden" name="name_printing_seal_id" id="name_printing_seal_id"
                   value="<?php if (isset($name_printing_seal_id)) echo $name_printing_seal_id; else echo 0; ?>">
            <input type="hidden" id="login_user_id" name="login_user_id"
                   value="<?= $this->session->userdata('account_id'); ?>">
            <input type="hidden" id="save_settlement_form_for_emailing" name="save_settlement_form_for_emailing"
                   value="0">
            <input type="hidden" id="share_this_settlement_id" name="share_this_settlement_id"
                   value="<?php echo $share_this_settlement_id; ?>">
            <input type="hidden" id="back_one_step" name="back_one_step"
                   value="<?php if (isset($back_one_step)) echo $back_one_step; else echo ''; ?>">
        </form>

    </div>
</div>

<!-- start password form -->
<div style="overflow:hidden;width:25%; height:180px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="seal_image_password_form">

    <div style="width:auto; text-align: right">

        <!-- Contextual button for informational alert messages -->
        <button type="button" class="btn btn-danger" onclick="seal_image_password_form_close();"
                id="seal_image_password_form_close"> 戻る
        </button>

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
            パスワードを入力してください。</p>
        <input onkeydown="if (event.keyCode == 13) { done_seal_image();}" type="tel" id="seal_image_password"
               name="seal_image_password"
               style="background-color: #FFCCFF; border: 2px solid #446590; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; text-align: center; ime-mode: inactive"
               maxlength="4" placeholder="４ケタ">
        <p>
            <!--            btn btn-light_green-->
            <button type="button" id="configuration_seal_image" class="btn btn-success"
                    onclick="configuration_seal_image();"
                    style="border: 2px solid #46658C; margin-right: 10px;"> 登録設定
            </button>
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

<!-- start change password form -->
<div style="overflow:hidden;width:30%; height:230px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="seal_image_change_password_form">
    <div style="width:auto; text-align: right">

        <button type="button" class="btn btn-danger" onclick="seal_image_change_password_form_close();"
                id="seal_image_change_password_form_close"> 戻る
        </button>

    </div>
    <div style="width:auto; text-align: left; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px;">
        変更　
    </div>
    <div class="clearfix"></div>
    <div style="text-align: left; font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px;">
        現在のパスワード <input type="text" id="seal_image_current_password" name="seal_image_current_password"
                        style="background-color: #B7DEE8; border: 2px solid #446590; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; text-align: center; ime-mode: inactive"
                        maxlength="4" placeholder="４ケタ">
        新パスワード　
        <input type="text" id="seal_image_new_password" name="seal_image_new_password"
               style="background-color: #FFCCFF; border: 2px solid #446590; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; margin-left: 18px; text-align: center; ime-mode: inactive"
               maxlength="4" placeholder="４ケタ">
        <p style="text-align: center">
            <button type="button" id="change_seal_image_complete" class="btn btn-yellow"
                    onclick="change_seal_image(this.id);"
                    style="border: 2px solid #46658C;"> 変更
            </button>
        </p>
    </div>
</div>
<!-- end change password form -->

<!-- start change password confirmation message -->
<div style="overflow:hidden;width:25%; height:120px; right:254px; bottom:5px; position: fixed; padding: 22px 10px 10px 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none;"
     id="seal_image_change_password_confirmation_message">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
            <!--            Password change completed-->
            パスワードの変更が完了しました
        </p>
        <p>
            <button type="button" id="close_seal_image_change_password_confirmation_message" class="btn btn-yellow"
                    style="border: 2px solid #46658C;"> 戻る
            </button>
        </p>
    </div>
</div>
<!-- end change password confirmation message -->

<!-- start change password confirmation popup -->
<div style="overflow:hidden;width:25%; height:100px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="seal_image_change_password_confirmation_popup">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
            パスワードを変更しますか？　
        </p>
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
<div style="overflow:hidden;width:25%; height:50px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
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
<div style="overflow:hidden;width:25%; height:130px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="incorrect_password_message">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
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

<!-- start configuration_seal_image form -->
<div style="overflow:hidden;width:30%; height:270px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
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
}, 1000);" type="text" id="add_seal_image_password"
                     name="add_seal_image_password"
                     style="background-color: #B7DEE8; border: 2px solid #446590; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; text-align: center; ime-mode: inactive"
                     maxlength="4" placeholder="４ケタ">
        <br>印鑑登録 <input type="text" id="seal_image" name="seal_image"
                        style="background-color: #FFCCFF; border: 2px solid #446590; border-radius: 0.5em; padding: 7px; margin-bottom: 10px; margin-left: 18px; text-align: center; ime-mode: inactive; cursor: pointer;"
                        placeholder="印鑑作成
"><label for="add_seal_image"
         class="btn-upload btn-success" style="margin-left: 105px;">印鑑選択</label>
        <input type="file" id="add_seal_image" name="add_seal_image" style="display:none; font-size: 14px;"><span
                style="display: none" id="seal_image_name">image name</span>
        <p style="text-align: center">
            <button type="button" id="change_seal_image_complete" class="btn btn-yellow"
                    onclick="show_configuration_yesno_popup();"
                    style="border: 2px solid #46658C;"> 完了
            </button>
        </p>
    </div>
</div>
<!-- end configuration_seal_image form -->

<!-- start configuration_seal_image confirmation popup -->
<div style="overflow:hidden;width:25%; height:100px; right:254px; bottom:5px; position: fixed; padding: 10px; border: 2px solid #446590; border-radius: 0.5em; background-color: #EBF1DE; display: none"
     id="configuration_seal_image_confirmation_popup">

    <div style="width:auto; text-align: right">

    </div>
    <div class="clearfix"></div>
    <div style="text-align: center">
        <p style="color: black; font-family: ms mincho, ｍｓ 明朝; font-size: 16.666667px; font-weight: bold;">
            印鑑を登録しますか？　
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
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria"
     id="done_configuration_seal_image_insert_message"
     style="position: fixed; right: 245px; bottom: 10px; padding: 4px; display: none; width:30%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: pink;">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; ">
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
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="password_exist_message"
     style="position: fixed; right: 254px; bottom: 10px; padding: 4px; display: none; width:30%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: pink;">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; text-align: center;">
                <li>既に使用済みです　
                </li>
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
            <ul style="list-style:none; text-align:center">
                <li>タイトルを入力してください　
                </li>
            </ul>
            <button id="close_settlement_title_empty_message" class="btn btn-yellow btn-sm"
                    style="box-shadow: none; border: 2px solid blue; margin-left: 155px;">確認

            </button>
        </div>
    </div>
</div>
<!-- end settlement title empty message -->

<!-- start delete documents message -->
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="delete_documents_message_confirm"
     style="position: fixed; right: 245px; bottom: 10px; padding: 4px; display: none; width:20%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style: square; ">
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
            <p style="font-size: 20px; font-weight: bold;">削除する文章: <span id="delete_settlement_title_show"></span></p>
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
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 draggable_aria close_aria" id="enter_settlement_title_message"
     style="position: fixed; right: 254px; bottom: 10px; padding: 4px; display: none; width:30%;">

    <div class="panel panel-info"
         style="margin-bottom: 2px; border: 2px solid #446590; border-radius: 0.5em; background-color: pink;">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <ul style="list-style:none; text-align: center;">
                <li>タイトルと氏名を確認してください。
<!--                    先ずはタイトルを入れてください。　-->
                </li>
            </ul>
            <button id="close_enter_settlement_title_message" class="btn btn-yellow btn-sm"
                    style="box-shadow: none; border: 2px solid blue; margin-left: 155px; cursor: pointer;">確認

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
            <ul style="list-style:none; text-align: center;">
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
<?php

$this->load->view('components/partner_registration');
?>
<?php

//        $this->load->view('components/settlement_letter_mail');
$this->load->view('components/view_settlement_letter');
?>

