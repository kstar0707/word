jQuery(document).ready(function ($) {
//     $('textarea.tinymce').tinymce({
//         script_url : 'resource/tiny_mce/tiny_mce.js',
// });


    var restore_post_ids = [];
    var open_file_id = $("#current_open_file").val();
    $("#show_table_of_content").click(function (event) {
        event.preventDefault();
        $("#table_of_contantes").removeClass("hide").addClass("show");
        var login_user_id = $("#login_user_id").val();
        var start_from = 0;
        var word_list_limit = $("#word_limit_list").val();

        $("#table_close").focus();
        $("#word_start_list").val(0);

        var url = $("#base_url").val() + 'index.php/wordapp/get_user_post/';
        //check
        $.ajax({
            url: url,
            type: 'POST',
            data: {login_user_id: login_user_id, start_from: start_from},
        })
        .done(function (data) {
            var response = JSON.parse(data);
            $("#total_user_post").val(response.total_user_post);            
            var x = 10;
            var y = 20;
            var htmlData = "";
            for (var i = 0; i < 10; i++) {
                var extra_class = "";
                var open_file = "";
                htmlData += "<tr>";
                    htmlData += '<td nowrap="nowrap">'+ (start_from+i+1) +'</td>';
                    if ((start_from+i) < response.total_user_post) {
                        if (restore_post_ids.indexOf(response.user_posts[i].post_id) !== -1) {
                            extra_class ="recent_restore";
                        }else{
                            extra_class = "";
                        }
                        if (open_file_id==response.user_posts[i].post_id) {
                            $("#current_open_file").val(response.user_posts[i].post_id);
                            open_file = "open_file";
                        }else{
                            open_file = "";
                        }
                        htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="content_title '+extra_class+' '+open_file+'">';
                    
                        htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[i].post_id+"'>";
                        htmlData += response.user_posts[i].post_title;
                    
                        htmlData += '</td>';
                    }else{
                        htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="">';
                        htmlData += '</td>';
                    }
                    htmlData += '<td nowrap="nowrap">'+ (start_from+i+x+1) +'</td>';
                    if ((start_from+x+i) < response.total_user_post) {
                        if (restore_post_ids.indexOf(response.user_posts[x+i].post_id) !== -1) {
                            extra_class ="recent_restore";
                        }else{
                            extra_class = "";
                        }
                        if (open_file_id==response.user_posts[x+i].post_id) {
                            $("#current_open_file").val(response.user_posts[x+i].post_id);
                            open_file = "open_file";
                        }else{
                            open_file = "";
                        }
                        htmlData += '<td nowrap="nowrap" width="30%" class="content_title  '+extra_class+' '+open_file+'">';
                    
                        htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[x+i].post_id+"'>";
                        htmlData += response.user_posts[x+i].post_title;
                    
                        htmlData += '</td>';
                    }else{
                        htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="">';
                        htmlData += '</td>';
                    }
                    htmlData += '<td nowrap="nowrap">'+ (start_from+i+y+1) +'</td>';
                    if ((start_from+y+i) < response.total_user_post) {
                        if (restore_post_ids.indexOf(response.user_posts[y+i].post_id) !== -1) {
                            extra_class ="recent_restore";
                        }else{
                            extra_class = "";
                        }
                        if (open_file_id==response.user_posts[y+i].post_id) {
                            $("#current_open_file").val(response.user_posts[y+i].post_id);
                            open_file = "open_file";
                        }else{
                            open_file = "";
                        }
                        htmlData += '<td nowrap="nowrap" width="30%" class="content_title '+extra_class+' '+open_file+'">';

                        htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[y+i].post_id+"'>";
                        htmlData += response.user_posts[y+i].post_title;                 
                        htmlData += '</td>';
                    }else{
                        htmlData += '<td nowrap="nowrap" width="30%" class="">';
                        htmlData += '</td>';
                    }
                htmlData += '</tr>';
            }
            // document.getElementById("trash_post_list").innerHTML = data
            $('#post_list').html(htmlData);
            // document.getElementById('post_list').innerHTML = html;
            $("td.content_title").each(function () {
                var DELAY = 1000, clicks = 0, timer = null;
                $(this).on("click", function () {
                    var post_id = $(this).children('.word_id').val();
                    
                    clicks++;  //count clicks
                    $('td.content_title').removeClass("checked");
                    $('td.content_title').removeClass('checked_row_restore');
                    $(this).addClass("checked");
                    if (clicks === 1) {
                        timer = setTimeout(function () {
                            clicks = 0;  //after action performed, reset counter
                            if (post_id !== undefined) {
                                $(this).addClass("checked");
                            } else {
                                $('td.content_title').removeClass("checked");
                            }
                        }, DELAY);
                    } else {
                        $(".btn_keipro").removeAttr("disabled");
                        clearTimeout(timer);    //prevent single-click action
                        clicks = 0;             //after action performed, reset
                        $.ajax({
                            url: "index.php/wordapp/get_post_by_id",
                            type: 'POST',
                            data: {post_id: post_id},
                        })
                        .done(function (data) {
                            tinymce.get('doc_content').undoManager.clear();
//                                    tinymce.activeEditor.undoManager.clear();
                            var post_data = JSON.parse(data);
                            open_file_id = post_id;
                            $("#current_open_file").val(post_data.post_id);
                            $(" #post_id ").val(post_data.post_id)
                            $("#table_of_contantes").removeClass("show").addClass("hide");

                            tinyMCE.get('doc_content').setContent(post_data.post_details);
                            tinymce.execCommand('mceFocus',false,'doc_content');
                            // tinymce.get('doc_content').getBody().focus();
                            console.log("success");
                        })
                        .fail(function () {
                            console.log("error");
                        })
                        .always(function () {
                            console.log("complete");
                        });
                    }
                });
            });
        })
        .fail(function () {
            console.log("error");
        })
        .always(function (data) {
        // console.log(response);
        var total_user_post = $("#total_user_post").val();
        // if (total_user_post< 30) {
        //         $("#word_next_page").attr('disabled', 'disabled');
        //     }
        //     $("#word_previous_page").attr('disabled', 'disabled');
        //     console.log("complete");
        });
    });

    $("#destroy_session,#destroy_session1").click(function (event) {
        localStorage.removeItem("name_printing");
        localStorage.removeItem("deployment_name");
        localStorage.removeItem("user_login_password");
        localStorage.removeItem("editable_div_id");
        localStorage.removeItem("settlement_letter_choice_id");
        localStorage.removeItem("page_count");

        window.location.href = $("#base_url").val() + "index.php/account/sign_out";

    });
    $("#table_close").click(function (event) {
        $("#table_of_contantes").removeClass("show").addClass("hide");
        $("#delete_confirm_alirt").removeClass("show").addClass("hide");

    });
    $("#trash_table_close").click(function (event) {
        $("#table_of_trash_files").removeClass("show").addClass("hide");
        $("#permanent_delete_confirm_alirt").removeClass("show").addClass("hide");
        $("#restore_confirm_alirt").removeClass("show").addClass("hide");
        $("#table_of_contantes").removeClass("hide").addClass("show");
        $("#show_table_of_content").click();
    });
    $("#doc_content").click(function (event) {
        $("#table_of_contantes").removeClass("show").addClass("hide");
    });


    $(".got_to_table_of_content").click(function (event) {

        $("#table_of_trash_files").removeClass("show").addClass("hide");
        $("#table_of_contantes").removeClass("hide").addClass("show");
        $("#show_table_of_content").click();
        // restore_post_ids = [];
    });

    // $('.alt_keypress').click(function(e){
    //     var code = $(this).data('code');
    //     // zEvent.ctrlKey  &&  zEvent.altKey
    //     $('#doc_content').trigger(
    //         jQuery.Event( 'keypress', { keyCode: code, which: code } )
    //     );
    //     $('#console').text('code: '+code);
    // });
    // $('.shift_keypress').click(function(e){
    //     var code = $(this).data('code');
    //     $('#doc_content').trigger(
    //         jQuery.Event( 'keypress', { keyCode: code, which: code } )
    //     );
    //     $('#console1').text('code: '+code);
    // });


    $("#settlement_letter_choice4, #settlement_letter_choice4").click(function (event) {
        event.preventDefault();
        $("#settlement_letter_aria").hide();
        $("#view_settlement_letter").removeClass("hide").addClass("show");
        var login_user_id = $("#login_user_id").val();
        // alert(login_user_id);
        var start_from = 0;
        var word_list_limit = $("#word_limit_list").val();
        $("#settlement_table_close").focus();
        $("#start_list").val(0);
        var url = $("#base_url").val() + 'index.php/wordapp/get_all_settlement_data/';
        //check
        $.ajax({
            url: url,
            type: 'POST',
            data: {login_user_id: login_user_id, start_from: start_from},
        })
            .done(function (html) {

                document.getElementById('settlement_list').innerHTML = html;
                $("td.settlement_title").each(function () {
                    var DELAY = 1000, clicks = 0, timer = null;
                    $(this).on("click", function () {
                        var settlement_id = $(this).children('.settlement_id').val();
                        clicks++;  //count clicks
                        $('td.settlement_title').removeClass("checked");
                        $(this).addClass("checked");
                        if (clicks === 1) {

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
                            $("#view_settlement_letter").removeClass("show").addClass("hide");
                            window.open(base_url + 'index.php/wordapp/view_settlement_form/' + settlement_id, "New Window", style);
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
    $("#settlement_table_close").click(function (event) {
        $("#view_settlement_letter").removeClass("show").addClass("hide");
    });

    $("#user_management").click(function (event) {
        if ((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1) {
            var style = 'height=650,width=1600, left=100, top=5, scrollbars=yes, resizable=1';
        }
        else if (navigator.userAgent.indexOf("Chrome") != -1) {
            var style = 'height=650,width=1600, left=100, top=5, toolbar=yes, scrollbars=yes, menubar=yes, resizable=1,status=0';
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
        window.open(base_url + 'index.php/account/manage_users/manage_user_new/', "_blank", style);
    });

    $("#create_new_doc").click(function (event) {
        event.preventDefault();
        $("#blanck_document_message").removeClass('hide').addClass('show');
        // location.reload();
        // tinymce.get('doc_content').getBody().focus(); // for auto focusing on tinymce editor when click
        

    });

   $("#close_blanck_document_btn").on('click', function()
   {
        tinymce.get('doc_content').undoManager.clear();
        var post_id = $("#post_id").val();
        // Get the HTML contents of the currently active editor
        // var content = tinyMCE.activeEditor.getContent();
        tinymce.get('doc_content').focus();
        var content = '';
        var get_page_count = localStorage.getItem("page_count");

        if (get_page_count != null) {
            var plus_num = 1;
            var page_count = Number(get_page_count) + Number(plus_num);

            for (var i = 0; i < page_count; i++) {
                var content_array = tinymce.editors[i].getContent();
                content += content_array;
            }
            console.log(content);
        } else {
            var content = tinyMCE.activeEditor.getContent();
        }
        $("#create_new_doc").focus();
        
        var temp_title = strip(content);        
        temp_title = temp_title.replace(/&nbsp;/gi, '');
        temp_title = temp_title.replace(/\n|\r/g, "").trim();
        
        var post_title = temp_title.substring(0, 15);
        if (post_title.length < 1) {
            tinymce.get('doc_content').focus();
            $("#close_blanck_document_btn").focus();
            $("#blanck_document_message").removeClass('show').addClass('hide');

            return false;
        } else {
            $.ajax({
                url: "index.php/wordapp/save",
                type: 'POST',
                data: {post_id: post_id, post_title: post_title, post_details: content}
            })
                .done(function (response) {
                    var post = JSON.parse(response);
                    if (post.message == 'success') {
                        console.log(post.message);
                        $('#post_id').attr('value', '');
                        $("#post_id").val("");

                        if (get_page_count != null) {
                            for (var i = 1; i < page_count; i++) {
                                tinymce.editors[i].setContent('');
                            }
                        } else {
                            tinymce.activeEditor.setContent('');
                        }
                        location.reload();

                        tinymce.get('doc_content').focus();
                    }
                    // console.log("success");
                })
                .fail(function (response) {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
        }       

   })

    $("#open_file").click(function () {
        tinymce.get('doc_content').undoManager.clear();
        var post_id = $(".checked").children('.word_id').val();
        if (post_id === undefined) {
            $("#select_document").removeClass('hide').addClass('show');
            $("#close_select").click(function (event) {
                $("#select_document").removeClass('show').addClass('hide');
                return false;
            });
            return false;
        } else {
            $(".btn_keipro").removeAttr("disabled");
            $.ajax({
                url: "index.php/wordapp/get_post_by_id",
                type: 'POST',
                data: {post_id: post_id},
            })
            .done(function (data) {
                var post_data = JSON.parse(data);
                $(" #post_id ").val(post_data.post_id)
                open_file_id = post_data.post_id;
                $("#current_open_file").val(post_data.post_id);
                $("#table_of_contantes").removeClass("show").addClass("hide");
                tinyMCE.get('doc_content').setContent(post_data.post_details);
                tinymce.execCommand('mceFocus',false,'doc_content');
                console.log("success");
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
        }

    });

    $("#trash_folder").click(function (event) {
        event.preventDefault();
        $("#table_of_trash_files").removeClass("hide").addClass("show");
        var login_user_id = $("#login_user_id").val();
        var start_from = 0;
        var word_list_limit = $("#word_limit_list").val();
        $("#trash_table_close").focus();
        $("#word_start_list").val(0);
        var url = $("#base_url").val() + 'index.php/wordapp/get_user_trash_post/';
        //check
        $.ajax({
            url: url,
            type: 'POST',
            data: {login_user_id: login_user_id, start_from: start_from},
        })
        .done(function (data) {

            var response = JSON.parse(data);

            var x = 10;
            var y = 20;
            var htmlData = "";
            for (var i = 0; i < 10; i++) {
                    htmlData += "<tr>";
                        htmlData += '<td nowrap="nowrap">'+ (start_from+i+1) +'</td>';
                        htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="content_title">';
                        if ((start_from+i) < response.total_user_post) {
                            htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[i].post_id+"'>";
                            htmlData += response.user_posts[i].post_title;
                        }
                        htmlData += '</td>';
                        htmlData += '<td nowrap="nowrap">'+ (start_from+i+x+1) +'</td>';
                        htmlData += '<td nowrap="nowrap" width="30%" class="content_title">';
                        if ((start_from+x+i) < response.total_user_post) {
                            htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[x+i].post_id+"'>";
                            htmlData += response.user_posts[x+i].post_title;
                        }
                        htmlData += '</td>';
                        htmlData += '<td nowrap="nowrap">'+ (start_from+i+y+1) +'</td>';
                        htmlData += '<td nowrap="nowrap" width="30%" class="content_title">';
                        if ((start_from+y+i) < response.total_user_post) {
                            htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[y+i].post_id+"'>";
                            htmlData += response.user_posts[y+i].post_title;
                        }
                        htmlData += '</td>';
                    htmlData += '</tr>';
            }
            // document.getElementById("trash_post_list").innerHTML = data
            $('#trash_post_list').html(htmlData);
        })
        .fail(function () {
            console.log("error");
        })
        .always(function (data) {
            var response = JSON.parse(data);
            // console.log(response);
            // var total_user_post = $("#total_user_post").val();
            // if (response.total_user_post < 30) {
            //     $("#word_next_page").attr('disabled', 'disabled');
            // }
            // $("#word_previous_page").attr('disabled', 'disabled');
            // console.log("complete");
        });
    });

    var multiple_post_id = [];
    $(document).delegate("#trash_post_list .content_title", "click", function (event) {
        // alert("Okay");
        // return false;
        var post_id = $(this).children('.word_id').val();
        // var post_id = $(this).attr('att-post-id');
        if (post_id != undefined) {
            if (jQuery.inArray(post_id, multiple_post_id) == -1) {
                multiple_post_id.push(post_id);
                $(this).addClass('checked_row_restore');
            } else {
                $("#email_share_navi_message_aria").removeClass('hide').addClass('show');
                if (multiple_partner_name.length == 1) {
                    $("#email_share_navi_user_list").removeClass('show').addClass('hide');
                }
                var id_index = multiple_post_id.indexOf(post_id);
                if (id_index > -1) {
                    multiple_post_id.splice(id_index, 1);
                }
                $(this).removeClass('checked_row_restore');
            }
        }
    });

    $("#restore_file").on('click', function (event) {
        event.preventDefault();
        var post_title = $(".content_title.checked_row_restore").text();
        if (multiple_post_id.length>0) {
            $("#restore_title").text(post_title);
            $("#restore_confirm_alirt").removeClass('hide').addClass('show');
        } else {
            $("#restore_select_document").removeClass('hide').addClass('show');
            $("#restore_close_select").click(function (event) {
                $("#restore_select_document").removeClass('show').addClass('hide');
                return false;
            });
        }
    });

    $("#restore_delete_close").click(function(event) {
        /* Act on the event */
        $("#restore_title").text('');
        $("#restore_confirm_alirt").removeClass('show').addClass('hide');
    });
    
    $("#restore_confirm").click(function(event) {
        /* Act on the event */
        var post_title = $(".content_title.checked_row_restore").text();
        
        var base_url = $("#base_url").val();
        $("#restore_title").text('');
        $("#restore_confirm_alirt").removeClass('show').addClass('hide');
        setTimeout(function () {
            var request_data = {
                'post_ids': toObject(multiple_post_id)
            };

            $.ajax({
                url: base_url + "index.php/wordapp/restore_post_files",
                type: 'POST',
                beforeSend: function () {
                    $(".ajax_email_load_aria").show();
                },
                data: JSON.stringify(request_data),
                contentType: "application/json",
            })
            .done(function (data) {
                $("#trash_folder").click();
                restore_post_ids = multiple_post_id;
                multiple_post_id = [];
                console.log(restore_post_ids);
                $("#restored_title").text(post_title);
                $("#deleted_file_restored").addClass('show').removeClass('hide');
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
        }, 1000);
    });

    $("#permanent_delete_file").click(function (event) {
        event.preventDefault();
        
        var post_title = $(".content_title.checked_row_restore").text();

       if (multiple_post_id.length>0) {
            $("#permanent_delete_title").text(post_title);
            $("#permanent_delete_confirm_alirt").removeClass('hide').addClass('show');
        } else {
            $("#restore_select_document").removeClass('hide').addClass('show');
            $("#restore_close_select").click(function (event) {
                $("#restore_select_document").removeClass('show').addClass('hide');
                return false;
            });
        }

        return false;
        
            

    });

    $("#permanent_delete_close").click(function(event) {
        /* Act on the event */
        $("#permanent_delete_confirm_alirt").removeClass('show').addClass('hide');
    });

    $("#permanent_delete_confirm").click(function(event) {
        /* Act on the event */
        var post_title = $(".content_title.checked_row_restore").text();
        var base_url = $("#base_url").val();
        $("#permanent_delete_confirm_alirt").removeClass('show').addClass('hide');
        $("#permanent_file_title").text(post_title);
        setTimeout(function () {
            var request_data = {
                'post_ids': toObject(multiple_post_id)
            };
            $.ajax({
                url: base_url + "index.php/wordapp/permanent_delete_post_files",
                type: 'POST',
                beforeSend: function () {
                    $(".ajax_email_load_aria").show();
                },
                data: JSON.stringify(request_data),
                contentType: "application/json",
            })
            .done(function (data) {
                
                $("#trash_folder").click();
                $("#permanent_file_deleted").removeClass('hide').addClass('show')
                multiple_post_id = [];
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
        }, 1000);
    });


    $("#delete_file").click(function () {
        var post_id = $(".checked").children('.word_id').val();
        var post_title = $(".content_title.checked").text();
        if (post_id === undefined) {

            $("#select_document").removeClass('hide').addClass('show');
            $("#close_select").click(function (event) {
                $("#select_document").removeClass('show').addClass('hide');
                return false;
            });
            return false;
        } else {
            document.getElementById('delete_title_show').innerHTML = post_title;
            $("#delete_confirm_alirt").removeClass('hide').addClass('show');
            $("#delete_close").click(function (event) {
                $("#delete_confirm_alirt").removeClass('show').addClass('hide');
                return false;
            });

            var login_user_id = $("#login_user_id").val();
            $("#delete_confirm").click(function (event) {
                $("#deletedss_file_title").text(post_title);
                $.post('index.php/wordapp/delete_post', {post_id: post_id}, function (data) {
                    if (data == 'success') {
                        $("#delete_confirm_alirt").removeClass('show').addClass('hide');
                        $("#table_of_contantes").removeClass("hide").addClass("show");
                        
                        $("#deleted_file_deleted").removeClass('hide').addClass('show')
                        if ($("#post_id").val() == post_id) {
                            $("#doc_content").val("");
                            tinyMCE.activeEditor.setContent('');
                            $("#post_id").val("");
                        }
                        var url = $("#base_url").val() + 'index.php/wordapp/get_user_post/' + login_user_id;
                        // alert(url)
                        // return false;
                        $.ajax({
                            url: url,
                            type: 'POST',
                            beforeSend: function () {
                                $("#ajax_loading_aria").show();
                            },
                            data: {login_user_id: login_user_id},
                        })
                        .done(function (data) {
                            var response = JSON.parse(data);
                            var start_from = 0;
                            var x = 10;
                            var y = 20;
                            var htmlData = "";
                            for (var i = 0; i < 10; i++) {
                                var extra_class = "";
                                var open_file = "";
                                    htmlData += "<tr>";
                                        htmlData += '<td nowrap="nowrap">'+ (start_from+i+1) +'</td>';
                                        if ((start_from+i) < response.total_user_post) {
                                            if (restore_post_ids.indexOf(response.user_posts[i].post_id) !== -1) {
                                                extra_class ="recent_restore";
                                            }
                                            if (open_file_id==response.user_posts[i].post_id) {
                                                open_file = "open_file";
                                            }else{
                                                open_file = "";
                                            }
                                            htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="content_title '+extra_class+' '+open_file+'">';
                                        
                                            htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[i].post_id+"'>";
                                            htmlData += response.user_posts[i].post_title;
                                        
                                            htmlData += '</td>';
                                        }
                                        htmlData += '<td nowrap="nowrap">'+ (start_from+i+x+1) +'</td>';
                                        if ((start_from+x+i) < response.total_user_post) {
                                            if (restore_post_ids.indexOf(response.user_posts[x+i].post_id) !== -1) {
                                                extra_class ="recent_restore";
                                            }
                                            if (open_file_id==response.user_posts[x+i].post_id) {
                                                open_file = "open_file";
                                            }else{
                                                open_file = "";
                                            }
                                            htmlData += '<td nowrap="nowrap" width="30%" class="content_title  '+extra_class+' '+open_file+'">';
                                        
                                            htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[x+i].post_id+"'>";
                                            htmlData += response.user_posts[x+i].post_title;
                                        
                                            htmlData += '</td>';
                                        }
                                        htmlData += '<td nowrap="nowrap">'+ (start_from+i+y+1) +'</td>';
                                        if ((start_from+y+i) < response.total_user_post) {
                                            if (restore_post_ids.indexOf(response.user_posts[y+i].post_id) !== -1) {
                                                extra_class ="recent_restore";
                                            }else{
                                                extra_class ="";
                                            }
                                            if (open_file_id==response.user_posts[y+i].post_id) {
                                                open_file = "open_file";
                                            }else{
                                                open_file = "";
                                            }
                                            htmlData += '<td nowrap="nowrap" width="30%" class="content_title '+extra_class+' '+open_file+'">';

                                            htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[y+i].post_id+"'>";
                                            htmlData += response.user_posts[y+i].post_title;
                                       
                                            htmlData += '</td>';
                                        }
                                    htmlData += '</tr>';
                            }
                            // document.getElementById("trash_post_list").innerHTML = data
                            $('#post_list').html(htmlData);
                            // $("#ajax_loading_aria").hide();
                            // document.getElementById('post_list').innerHTML = html;
                            $("td.content_title").each(function () {
                                var DELAY = 300, clicks = 0, timer = null;
                                $(this).on("click", function () {
                                    var post_id = $(this).children('.word_id').val();
                                    clicks++;  //count clicks
                                    $('td.content_title').removeClass("checked");
                                    $(this).addClass("checked");
                                    if (clicks === 1) {

                                        timer = setTimeout(function () {

                                            clicks = 0;  //after action performed, reset counter
                                            if (post_id !== undefined) {
                                                // alert(post_id);
                                                $(this).addClass("checked");
                                            } else {
                                                $('td.content_title').removeClass("checked");
                                            }
                                        }, DELAY);

                                    } else {
                                        clearTimeout(timer);    //prevent single-click action
                                        clicks = 0;
                                        $.ajax({
                                            url: "index.php/wordapp/get_post_by_id",
                                            type: 'POST',
                                            data: {post_id: post_id},
                                        })
                                        .done(function (data) {
                                            var post_data = JSON.parse(data);
                                            $(" #post_id ").val(post_data.post_id)
                                            open_file_id = post_data.post_id;
                                            $("#current_open_file").val(post_data.post_id);
                                            $("#table_of_contantes").removeClass("show").addClass("hide");
                                            tinyMCE.get('doc_content').setContent(post_data.post_details);

                                            console.log("success");
                                        })
                                        .fail(function () {
                                            console.log("error");
                                        })
                                        .always(function () {
                                            console.log("complete");
                                        });
                                    }
                                });
                            });
                        })
                        .fail(function () {
                            console.log("error");
                        })
                        .always(function () {
                            console.log("complete");
                        });
                    }
                });
            });

        }
    });

    $("#email_close").click(function (event) {
        $(" .email_main_modal ").modal('hide');
        // $("#emailing_aria").hide();
    });

    


    $("#font_size").click(function (event) {
        event.preventDefault();
        $(".multiple_navi").removeClass('show').addClass('hide');
        $("#font_size_aria").removeClass('hide').addClass('show');
        $("#font_family_aria").removeClass('show').addClass('hide');
        $('.font_size').removeClass('checked');
        // console.log(elements);
        // var flag = false;
        // for(var i = 0; i < elements.length; i ++) {
        //     if(elements[i].className.search('checked') >= 0) {
        //         flag = true;
        //     }
        // }
        // if(!flag) {
        //     $('#font_size_14').addClass('checked');
        // }
        var font_size = $('#change_font_size').val();
        switch(font_size) {
            case '10.666667px':
                $('#font_size_8').addClass('checked');
                break;
            case '13.333333px':
                $('#font_size_10').addClass('checked');
                break;
            case '16px':
                $('#font_size_12').addClass('checked');
                break;
            case '18.666667px':
                $('#font_size_14').addClass('checked');
                break;
            case '21.333333px':
                $('#font_size_16').addClass('checked');
                break;
            case '24px':
                $('#font_size_18').addClass('checked');
                break;
            case '26.666667px':
                $('#font_size_20').addClass('checked');
                break;
            case '29.333333px':
                $('#font_size_22').addClass('checked');
                break;
            case '32px':
                $('#font_size_24').addClass('checked');
                break;
            case '34.666667px':
                $('#font_size_26').addClass('checked');
                break;
            case '37.333333px':
                $('#font_size_28').addClass('checked');
                break;
            case '40px':
                $('#font_size_30').addClass('checked');
                break;
            case '42.666667px':
                $('#font_size_32').addClass('checked');
                break;
            case '45.333333px':
                $('#font_size_34').addClass('checked');
                break;
            case '48px':
                $('#font_size_36').addClass('checked');
                break;
        }
        $("#close_font_size_aria").focus();
    });

    $("#shapes").click(function (event) {
        $(".multiple_navi").removeClass('show').addClass('hide');
        $("#shapes_area").removeClass('hide').addClass('show');
        $("#close_shapes_area").focus();
    });
    $("#close_shapes_area").click(function (event) {
        $("#shapes_area").removeClass('show').addClass('hide');
    });


    $("#email_font_size").click(function (event) {
        $(".multiple_navi").removeClass('show').addClass('hide');
        $("#email_font_size_aria").removeClass('hide').addClass('show');
    });

    $("#close_font_size_aria").click(function (event) {
        $("#font_size_aria").removeClass('show').addClass('hide');
        var change_font_size = $("#change_font_size").val();
        // if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        //     tinymce.get('doc_content').execCommand("fontSize", false, change_font_size);
        // }
        
    });
    $("#email_close_font_size_aria").click(function (event) {
        $("#email_font_size_aria").removeClass('show').addClass('hide');
    });

    $("#font_family").click(function (event) {
        event.preventDefault();
        $(".multiple_navi").removeClass('show').addClass('hide');
        $("#font_family_aria").removeClass('hide').addClass('show');
        $("#font_size_aria").removeClass('show').addClass('hide');

        $("#close_family_aria").focus();
    });

    $("#settlement_letter").click(function (event) {
        $("#settlement_letter_aria").show(1000);
        // $("#settlement_letter_aria").removeClass('hide').addClass('show');
        // $("#close_settlement_letter_aria").focus();
    });

    $("#close_settlement_letter_aria").click(function (event) {
        $("#settlement_letter_aria").hide(1000);
        // $("#settlement_letter_aria").removeClass('show').addClass('hide');
    });

    $("#email_font_family").click(function (event) {

        $("#email_font_family_aria").removeClass('hide').addClass('show');
    });


    $("#close_family_aria").click(function (event) {
        $("#font_family_aria").removeClass('show').addClass('hide');
        // var change_font_family = $("#change_font_family").val();
        // if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        //     tinymce.get('doc_content').execCommand("fontName", false, change_font_family);
        // }
    });

    $("#email_close_family_aria").click(function (event) {
        $("#email_font_family_aria").removeClass('show').addClass('hide');
    });

    $("#word_function").click(function (event) { 
        event.preventDefault();       
        $(".multiple_navi").removeClass('show').addClass('hide');
        $("#word_function_aria").removeClass('hide').addClass('show');
        $("#close_function_aria").focus();
    });

    $("#show_table_of_content, #create_new_doc, #font_family, #font_size, #inserImage, #word_function").click(function(event) {
        event.preventDefault();
        $(".btn_keipro").attr('disabled', 'disabled');
        $('[data-toggle="popover"]').popover('hide');
    });
    $(".btn-warning, .btn-danger").click(function(event) {
        $(".btn_keipro").removeAttr("disabled");
    });
    $("#email_function").click(function (event) {
        $("#email_function_aria").removeClass('hide').addClass('show');
    });

    $("#email_color").click(function (event) {
        $("#email_font_color_aria").removeClass('hide').addClass('show');
        $("#email_function_aria").removeClass('show').addClass('hide');
    });

    $("#close_copy_cut_aria").click(function (event) {
        $("#font_cut_copy_aria").removeClass('show').addClass('hide');
        $("#word_function_aria").removeClass('hide').addClass('show');
        $("#font_cut_copy_aria_show").val(0);
    });

    $("#word_color").click(function (event) {
        $("#show_color_popup").val(1)
        $("#font_color_aria").removeClass('hide').addClass('show');
        $("#word_function_aria").removeClass('show').addClass('hide');
    });

    $("#close_font_color_aria").click(function (event) {
        $("#show_color_popup").val(0)
        $("#font_color_aria").removeClass('show').addClass('hide');
        $("#word_function_aria").removeClass('hide').addClass('show');
        // $("#word_font_color").val();
    });

    $(document).mouseup(function (e) {
        var container = $("#word_function_aria");
        $(".close_aria").addClass('hide').removeClass('show');
    });


    $("#close_function_aria").on('click', function (event) {
        event.preventDefault();
        $("#word_function_aria").removeClass('show').addClass('hide');
        // if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        //     tinymce.get('doc_content').execCommand('ForeColor', false, $("#word_font_color").val());
        // }        
    });

    $("#email_close_function_aria").on('click', function (event) {
        event.preventDefault();
        $("#email_function_aria").removeClass('show').addClass('hide');
    });

    // $(".draggable_aria").draggable();

    $("#emailing").on('click', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var params = [
            'height=600',
            'width=1200',
            'top=20',
            'left=100'
        ].join(',');
        newwindow = window.open(url, 'name', params);
        if (window.focus) {
            newwindow.focus()
        }
        return false;
    });

    // Delete Email
    $("#delete_email").on('click', function (event) {
        event.preventDefault();

        $("#email_delete_confirmation_aria").removeClass('hide').addClass("show");
        var email_subject = $("#email_detail_subject").text();

        $('#delete_email_title').html(email_subject);
        // $("#email_delete_confirmation").focus();
        /* Act on the event */
    });

    // cancel_email_delete_confirmation

    $("#cancel_email_delete_confirmation").on('click', function (event) {
        event.preventDefault();
        $("#email_delete_confirmation_aria").removeClass('show').addClass("hide");
        /* Act on the event */
    });

    // Delete Email
    $("#email_delete_confirmation").click(function (event) {
        event.preventDefault();

        var get_event = $(this);
        var api_key = $("#api_key").val();
        var user_id = $("#user_id").val();
        var email_id = $("#reply_mail_id").val();

        var selected = [email_id];

        var reply_mail_id = selected;

        var base_url = $("#base_url").val();
        var url = base_url + 'index.php/api/emailing/delete_email';
        $.ajax({
            url: url,
            type: 'POST',
            beforeSend: function () {
                $(".ajax_email_load_aria").show();
            },
            data: JSON.stringify({
                api_key: api_key,
                user_id: user_id,
                email_ids: reply_mail_id
            }),
            contentType: "application/json",
        })
            .done(function (data) {
                var data = JSON.parse(data);
                if (data.success == 1) {
                    $("#email_delete_confirmation_aria").removeClass('show').addClass("hide");
                    get_user_email()
                    get_last_email();
                }
                console.log("success");
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });

    });

    // var partner_form = $("#email_partner_form");
    // partner_form.submit(function (event) {
    //     event.preventDefault();
    //     var edit_partner_id = $("#edit_partner_id").val();
    //     var edit_partner_name = $("#edit_partner_name").val();
    //     var edit_partner_company = $("#edit_partner_company").val();
    //     var edit_partner_mobile = $("#edit_partner_mobile").val();
    //     var partner_name_edit = $(".input_partner_name").val();
    //     var partner_mobile_edit = $(".input_partner_mobile").val();
    //
    //     var partner_name = $("#partner_name").val();
    //     var company = $("#company").val();
    //     var partner_mobile = $("#partner_mobile").val();
    //     // alert(partner_name1)
    //     // if (partner_name != " " && partner_mobile != " ") {
    //     if (partner_name != " " || partner_mobile != " ") {
    //         save_partner();
    //     }
    //     if (partner_name_edit != " " || partner_mobile_edit != " ") {
    //         save_edit_partner();
    //     }
    //
    // });

    $("#partner_add").click(function (event) {
        event.preventDefault();
        var partner_form = $("#email_partner_form");

        var edit_partner_id = $("#edit_partner_id").val();
        var edit_partner_name = $("#edit_partner_name").val();
        var edit_partner_company = $("#edit_partner_company").val();
        var edit_partner_mobile = $("#edit_partner_mobile").val();
        var partner_name_edit = $(".input_partner_name").val();
        var partner_mobile_edit = $(".input_partner_mobile").val();

        var partner_name = $("#partner_name").val();
        // var company = $("#company").val();
        var company = '';
        var partner_mobile = $("#partner_mobile").val();
        // alert(partner_name1)
        // if (partner_name != " " && partner_mobile != " ") {
        if (partner_name != " " || partner_mobile != " ") {
            save_partner(1);
        }
        if (partner_name_edit != " " || partner_mobile_edit != " ") {
            save_edit_partner();
        }
    });

    $("#quick_new_email").click(function (event) {
        event.preventDefault();
        $('#new_mail').trigger('click');
    });

    $('#emailSendingModal').on('hidden.bs.modal', function () {
        $(".email_main_modal").modal('show');
    });

    $("#new_mail").click(function (event) {
        event.preventDefault();
        tinymce.get('email_content').focus();
        $("#receiver_name").val("");
        $("#receiver_mobile").val("");
        $("#subject").val("");
        $("#drft_email_id").val("");
        $("#draft_value").val(1);
        tinyMCE.get('email_content').setContent('');
        $(".email_main_modal").modal('hide');
        $('#emailSendingModal').modal('show');
    });

    $("#new_email_close_button").click(function (event) {
        event.preventDefault();
        $('#emailSendingModal').hide();
        $("#emailing_aria_button").trigger('click');
    });

//     var email_form = $("#email_send_form");
//     email_form.submit(function (event) {
//         event.preventDefault();
//
//         var base_url = $("#base_url").val();
//
//         var url = base_url + "index.php/api/emailing/send";
//         var api_key = $('#api_key').val();
//         var user_id = $("#user_id").val();
//         var receiver_name = $("#receiver_name").val();
//         var receiver_mobile = $("#receiver_mobile").val();
//         var subject = $("#subject").val();
//
//         var drft_email_id = $("#drft_email_id").val();
//         if (drft_email_id == "") {
//             drft_email_id = "";
//         }
//
//         var content = tinyMCE.get('email_content').getContent();
//
//         var drft = 0;
//         if ((api_key != "") && (user_id != "") && (receiver_name != "") && (receiver_mobile != "") && (content != "")) {
//
//             $.ajax({
//                 url: url,
//                 type: 'POST',
//                 beforeSend: function () {
//                     $(".ajax_email_load_aria").show();
//                 },
//                 data: JSON.stringify({
//                     email_id: drft_email_id,
//                     api_key: api_key,
//                     user_id: user_id,
//                     receiver_name: receiver_name,
//                     receiver_mobile: receiver_mobile,
//                     subject: subject,
//                     content: content,
//                     drft: drft
//                 }),
//                 contentType: "application/json",
//             })
//                 .done(function (data) {
// //                alert(data);
// //                $.alert("Okay");
// //                $("#email_send_success_message").addClass('show').removeClass('hide');
// //                return false;
//                     $(".ajax_email_load_aria").hide();
//                     $("#draft_value").val(0);
//                     var audio = new Audio('notification_sound.mp3');
//                     audio.play();
//                     $("#success_email_message").removeClass('hide').addClass('show');
// //                $( "#success_email_message" ).fadeOut( "slow" );
//                     $('#emailSendingModal').modal('hide');
//                     get_user_email();
//                     get_last_email();
//                     console.log("success");
//                 })
//                 .fail(function () {
//                     console.log("error");
//                 })
//                 .always(function () {
//                     $(".ajax_email_load_aria").hide();
//                     console.log("complete");
//                 });
//         }
//
//     });


    $('#send').click(function (e) {
        e.preventDefault();
        var email_form = $("#email_send_form");
        // alert('hi');
        // event.preventDefault();
        $("#preloader_email").show();
        var base_url = $("#base_url").val();

        var url = base_url + "index.php/api/emailing/send";
        var api_key = $('#api_key').val();
        var user_id = $("#user_id").val();

        var receiver_name = $("#receiver_name").val();
        var receiver_mobile = $("#receiver_mobile").val();
        var subject = $("#subject").val();

        var drft_email_id = $("#drft_email_id").val();
        if (drft_email_id == "") {
            drft_email_id = "";
        }

        var content = tinyMCE.get('email_content').getContent();

        var drft = 0;
        if ((api_key != "") && (user_id != "") && (receiver_name != "") && (receiver_mobile != "") && (content != "")) {

            $.ajax({
                url: url,
                type: 'POST',
                beforeSend: function () {
                    $(".ajax_email_load_aria").show();
                },
                data: JSON.stringify({
                    email_id: drft_email_id,
                    api_key: api_key,
                    user_id: user_id,
                    receiver_name: receiver_name,
                    receiver_mobile: receiver_mobile,
                    subject: subject,
                    content: content,
                    drft: drft
                }),
                contentType: "application/json",
            })
                .done(function (data) {
                    // alert(data);console.log(data);die();
//                $.alert("Okay");
//                $("#email_send_success_message").addClass('show').removeClass('hide');
//                return false;

                    var data = JSON.parse(data);

                    $(".ajax_email_load_aria").hide();
                    $("#draft_value").val(0);

                    if (data.message == 'invalid partner') {
                        $("#preloader_email").hide();
                        $("#email_invalid_partner_error_message").removeClass('hide').addClass('show');

                    } else {
                        $("#preloader_email").hide();
                        $("#success_email_message").removeClass('hide').addClass('show');
//                $( "#success_email_message" ).fadeOut( "slow" );
                        $('#emailSendingModal').modal('hide');
//                         $('#emailSendingModal').hide();
                        get_user_email();
                        get_last_email();
                        console.log("success");

                    }
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    $(".ajax_email_load_aria").hide();
                    $("#preloader_email").hide();
                    console.log("complete");
                });
        }
    });


    $('#emailSendingModal').on('hidden.bs.modal', function () {
        var draft_value = $("#draft_value").val();
        if (draft_value == 1) {
            save_email_as_drft()
        }
    });

    // Save Email as Draft
    function save_email_as_drft() {
        var base_url = $("#base_url").val();

        var url = base_url + "index.php/api/emailing/send";
        var api_key = $('#api_key').val();
        var user_id = $("#user_id").val();
        var receiver_name = $("#receiver_name").val();
        var receiver_mobile = $("#receiver_mobile").val();
        var subject = $("#subject").val();
        var drft = 1;
        var drft_email_id = $("#drft_email_id").val();
        var content = tinyMCE.get('email_content').getContent();

        if ((api_key != "") && (user_id != "") && ((content != "")) || (content != "")) {
            $.ajax({
                url: url,
                type: 'POST',
                beforeSend: function () {
                    $(".ajax_email_load_aria").show();
                },
                data: JSON.stringify({
                    email_id: drft_email_id,
                    api_key: api_key,
                    user_id: user_id,
                    receiver_name: receiver_name,
                    receiver_mobile: receiver_mobile,
                    subject: subject,
                    content: content,
                    drft: drft
                }),
                contentType: "application/json",
            })
                .done(function (data) {

                    var data = JSON.parse(data);
                    get_user_draft_email();
                    $("#drft_email_id").val(data.email_id);
                    $(".ajax_email_load_aria").hide();
                    console.log("success");
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    $(".ajax_email_load_aria").hide();
                    console.log("complete");
                });
        }
    }


    $("#emailing_aria_button, #view_email_main_modal").click(function (event) {
        event.preventDefault();
        $(".email_main_modal").modal('show');
        // $("#emailing_aria").show();
        $("#email_navigation_message").removeClass('hide').addClass('show');
        setTimeout(function () {
            $("#most_uses").trigger('click');
        }, 1000);

        // get_user_email();
        // get_last_email();

    });

    function get_user_email() {
        var user_id = $("#user_id").val();
        var base_url = $("#base_url").val();
        var url = base_url + 'index.php/emailing/get_user_email';
        var start_from = 0;
        var end_to = 30;
        // alert(url);
        // return false;
        $.ajax({
            url: url,
            type: 'POST',
            beforeSend: function () {
                $("#email_list").html('<center>読み込み中。。。待って下さい <img src="resource/img/ajax/ajax_load_4.gif"></center>');
                // $(".ajax_email_load_aria").show();
            },
            data: JSON.stringify({
                user_id: user_id,
                start_from: start_from,
                end_to: end_to
            }),
            contentType: "application/json",
        })
            .done(function (data) {
                // console.log(data);die();

                var response_val_array = data.split('######');
                var html_data = response_val_array[0];
                var settlement_id = response_val_array[1];
                $("#email_list").html(html_data);
                // if (settlement_id != '-9999999') {
                //     $('#text_settlement_id').html(settlement_id);
                //     $("#view_settlement_form_yes_no_popup").show();
                // } else {
                //     $("#view_settlement_form_yes_no_popup").hide();
                // }

                // console.log(data);
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
    }

    $("#create_pertner").on('click', function (event) {
        event.preventDefault();
        // Init Partner table
        multiple_partner_id = [];
        multiple_partner_name = [];
        $("#table_of_partner tr").removeClass('enable_to_multi_share');
        $("#enable_email_multi_share").val(0);
        $("#email_multiple_share").addClass('btn-success');
        $("#email_multiple_share").css("background-color", "#419641");
        $("#email_share_navi_message_aria").removeClass('show').addClass('hide');

        $('#table_of_partner').removeClass('hide').addClass('show');
        $("#email_partner_message").removeClass('hide').addClass('show');
        get_user_partners();
    });

    $("#close_pertner").on('click', function (event) {
        event.preventDefault();
        $('#table_of_partner').removeClass('show').addClass('hide');
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
                $(".ajax_email_load_aria").show();
            },
            data: JSON.stringify({
                user_id: user_id,
                partner_type: 0 // 0: as it is create from normal email form
            }),
            contentType: "application/json",
        })
            .done(function (data) {
                $("#partner_container").html(data);
                // $("#load_table_of_partner").html(data);
                console.log("success");
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
    }


    function save_partner(id) {
        var base_url = $("#base_url").val();

        var url = base_url + "index.php/api/emailing/save_partner";
        var api_key = $('#api_key').val();
        var user_id = $("#user_id").val();
        if (id == 1) {
            var partner_name = $("#partner_name").val();
            // var company = $("#company").val();
            var company = '';
            var partner_mobile = $("#partner_mobile").val();
        } else {
            var partner_name = $("#new_partner_name").val();
            // var company = $("#new_partner_company").val();
            var company = '';
            var partner_mobile = $("#new_partner_mobile").val();
        }

        if ((api_key != "") && (user_id != "") && (partner_name != "") && (partner_mobile != "")) {
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
                    partner_type: 0 // 0: as it is create from normal email form
                }),
                contentType: "application/json",
            })
                .done(function (data) {
                    $("#ajax_loading_aria").hide();
                    // console.log(data);
                    // die();
                    var data = JSON.parse(data);
                    if (data.message == 'success') {
                        get_user_partners();
                    } else if (data.message == 'invalid partner') {
                        // $("#email_invalid_partner_error_message").show();
                        $("#email_invalid_partner_error_message").removeClass('hide').addClass('show');
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
        else {
            $("#new_partner_name").val('');
            $("#new_partner_company").val('');
            $("#new_partner_mobile").val('');

            $("#email_share_navi_message_aria").hide();
            $("#new_partner_registration_form").show();
        }
    }

    $("#scroll_to_bottom").click(function () {
        $('html, body').animate({scrollTop: $(document).height()}, 1200);
    })

    $(document).delegate(".show_email_details", "click", function (event) {
        event.preventDefault();

        var get_event = $(this);
        var email_id = $(this).attr("href");
        var api_key = $("#api_key").val();
        var user_id = $("#user_id").val();
        var base_url = $("#base_url").val();
        var url = base_url + 'index.php/api/emailing/email_details';

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
                email_id: email_id
            }),
            contentType: "application/json",
        })
            .done(function (data) {
                // alert(data);
                // console.log(data);
                // die();
                $("#ajax_loading_aria").hide();

                var data = JSON.parse(data);

                if (data.seen == 1) {
                    get_event.closest('.warning').removeClass('unseen').addClass('seen');
                }
                if (data.success == 1) {
                    // alert(data.email_details.email_id);
                    var email_subject = data.email_details.subject;
// alert(email_subject);die();
                    if (email_subject != null) {
                        email_subject = data.email_details.subject;
                    } else {
                        // email_subject = data.settlement_title;
                    }

                    $("#reply_mail_id").val(data.email_details.email_id);
                    var decode_user_id = b64DecodeUnicode(user_id);
                    // alert(decode_user_id);
                    var sender_name = data.email_details.sender_name;

                    if (sender_name != null) {
                        var sender_name = data.email_details.sender_name;
                    }
                    if (decode_user_id == data.email_details.created_by) {
                        $("#reply_mail").removeClass('show').addClass('hide');

                        document.getElementById('email_sender_and_receiver').innerHTML = data.email_details.receiver_name + "(" + data.email_details.receiver_mobile + ")";
                    } else {
                        $("#reply_mail").removeClass('hide').addClass('show');
                        document.getElementById('email_sender_and_receiver').innerHTML = sender_name + "(" + data.email_details.sender_mobile + ")";
                    }

                    if (data.email_details.drft == 1) {
                        $("#edit_draft_mail").removeClass('hide').addClass('show');
                    }

                    $('#email_create_date').text(data.japan_date);
                    $('#email_content_detail').html(data.email_details.content);
                    $('#email_detail_subject').text(email_subject);
                    // $('#view_email_settlement_id').html(data.settlement_id);
                    //
                    // if (data.only_settlement_id != '') {
                    //     $('#text_settlement_id').html(data.only_settlement_id);
                    //     var text_settlement_id = $("#text_settlement_id").text(data.only_settlement_id);
                    //     $("#view_settlement_form_yes_no_popup").show();
                    // } else {
                    //     $("#view_settlement_form_yes_no_popup").hide();
                    // }
                }
                console.log('success');
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                $("#ajax_loading_aria").hide();
                console.log("complete");
            });
        /* Act on the event */
    });


    // Emailing Jquery JavaScript

    $("#reply_mail").click(function (event) {
        event.preventDefault();

        var email_id = $("#reply_mail_id").val();
        var api_key = $("#api_key").val();
        var user_id = $("#user_id").val();
        var base_url = $("#base_url").val();
        $("#drft_email_id").val("");
        var url = base_url + 'index.php/api/emailing/email_details';
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
                email_id: email_id
            }),
            contentType: "application/json",
        })
            .done(function (data) {

                $('#emailSendingModal').modal('show');
                $(".email_main_modal").modal('hide');
                $("#ajax_loading_aria").hide();
                // console.log(data);
                var data = JSON.parse(data);

                // alert(data.seen);
                var decode_user_id = b64DecodeUnicode(user_id);
                // alert(decode_user_id);
                if (decode_user_id == data.email_details.created_by) {
                    $("#receiver_name").val(data.email_details.receiver_name);
                    $("#receiver_mobile").val(data.email_details.receiver_mobile);
                } else {
                    $("#receiver_name").val(data.email_details.sender_name);
                    $("#receiver_mobile").val(data.email_details.sender_mobile);
                }
                var reply_subject = data.email_details.subject;
                reply_subject = reply_subject.replace("応答:", "");

                // alert(data.email_details.email_id);

                // if(reply_subject!=null){
                //     reply_subject = reply_subject;
                // }else{
                //     reply_subject = data.settlement_title;
                // }

                $("#subject").val("応答: " + reply_subject);
                var email_reply_content = "<br><hr>送信者:" + data.email_details.sender_name + "(" + data.email_details.sender_mobile + ")<br>" +
                    "日付: " + data.japan_date + "<br>" +
                    "用件: " + reply_subject + "<br><br>"
                    + data.email_details.content;
                tinyMCE.get('email_content').setContent(email_reply_content);

                console.log("success");
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                $("#ajax_loading_aria").hide();
                console.log("complete");
            });
        // $("#content").val(reply_mail_content);
    });

    function b64DecodeUnicode(str) {
        // Going backwards: from bytestream, to percent-encoding, to original string.
        return decodeURIComponent(atob(str).split('').map(function (c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
    }

    // Draft List

    $("#btn-drafts").on('click', function (event) {
        event.preventDefault();
        $("#edit_draft_mail").removeClass('hide').addClass('show');
        $("#reply_mail").removeClass('show').addClass('hide');
        $("#delete_email").removeClass('show').addClass('hide');
        get_user_draft_email();
        get_last_draft_email();
    });

    function get_user_draft_email() {
        var user_id = $("#user_id").val();
        var base_url = $("#base_url").val();
        var url = base_url + 'index.php/emailing/get_user_draft_email';
        var start_from = 0;
        var end_to = 30;
        // alert(url);
        // return false;
        $.ajax({
            url: url,
            type: 'POST',
            beforeSend: function () {
                $("#email_list").html('<center>読み込み中。。。待って下さい <img src="resource/img/ajax/ajax_load_4.gif"></center>');
                // $(".ajax_email_load_aria").show();
            },
            data: JSON.stringify({
                user_id: user_id,
                start_from: start_from,
                end_to: end_to
            }),
            contentType: "application/json",
        })
            .done(function (data) {
                // alert(data);
                $("#email_list").html(data);

                // alert(data);
                console.log("success");
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
    }

    $("#btn-filter").on('click', function (event) {
        event.preventDefault();
        $(this).hide();
        $("#most_uses").show();
        // $("#edit_draft_mail").removeClass('show').addClass('hide');
        // $("#email_inbox_title").innerText = "逶ｸ謇句�蛻･荳隕ｧ";
        // 直近順一覧
        // 直近順一覧
        // 相手先別一覧
        $("#email_inbox_title").text("直近順一覧");
        $("#delete_email").removeClass('hide').addClass('show');
        get_user_email();
        get_last_email();
        /* Act on the event */
    });

    $("#most_uses").on('click', function (event) {
        event.preventDefault();
        $(this).hide();
        $("#btn-filter").show();
        $("#delete_email").removeClass('hide').addClass('show');
        // $("#btn-filter").addClass('show').removeClass('hide');
        // $("#edit_draft_mail").removeClass('show').addClass('hide');
        $("#email_inbox_title").text("相手先別一覧");
        var user_id = $("#user_id").val();
        var base_url = $("#base_url").val();
        var url = base_url + 'index.php/emailing/get_partner_wise_email';
        var start_from = 0;
        var end_to = 30;
        // alert(url);
        // return false;
        $.ajax({
            url: url,
            type: 'POST',
            beforeSend: function () {
                $("#email_list").html('<center>読み込み中。。。待って下さい <img src="resource/img/ajax/ajax_load_4.gif"></center>');
                // $(".ajax_email_load_aria").show();
            },
            data: JSON.stringify({
                user_id: user_id,
                start_from: start_from,
                end_to: end_to
            }),
            contentType: "application/json",
        })
            .done(function (data) {
                // alert(data);
                get_last_email_of_partner();
                $("#email_list").html(data);

                // alert(data);
                console.log(data);
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
    });

    // Edit draft Email
    $(document).delegate("#edit_draft_mail", "click", function (event) {
        event.preventDefault();

        $('#emailSendingModal').modal('show');
        $(".email_main_modal").modal('hide');
        $("#draft_value").val(1);
        var email_id = $("#reply_mail_id").val();
        var api_key = $("#api_key").val();
        var user_id = $("#user_id").val();
        var base_url = $("#base_url").val();

        var url = base_url + 'index.php/api/emailing/email_details';
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
                email_id: email_id
            }),
            contentType: "application/json",
        })
            .done(function (data) {

                $("#ajax_loading_aria").hide();
                var data = JSON.parse(data);
                // alert(data);die();
                $("#drft_email_id").val(data.email_details.email_id);
                $("#receiver_name").val(data.email_details.receiver_name);
                $("#subject").val(data.email_details.subject);
                $("#receiver_mobile").val(data.email_details.receiver_mobile);

                tinyMCE.get('email_content').setContent(data.email_details.content);

                console.log(data);
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                $("#ajax_loading_aria").hide();
                console.log("complete");
            });
        // $("#content").val(reply_mail_content);
    });


    // Delete Draft Email
    $("#delete_draft_email").on('click', function (event) {
        event.preventDefault();
        var drft_email_id = $("#drft_email_id").val();
        if (drft_email_id < 1) {
            $("#draft_value").val(0);
            $("#emailSendingModal").modal("hide");
            get_user_email();
        } else {
            var api_key = $("#api_key").val();
            var user_id = $("#user_id").val();
            var base_url = $("#base_url").val();

            var url = base_url + 'index.php/api/emailing/delete';
            $.ajax({
                url: url,
                type: 'POST',
                data: JSON.stringify({
                    api_key: api_key,
                    user_id: user_id,
                    email_id: drft_email_id
                }),
                contentType: "application/json",
            })
                .done(function (data) {
                    var data = JSON.parse(data);
                    if (data.success == 1) {
                        get_user_draft_email();
                        get_last_draft_email();
                        $("#draft_value").val(0);
                        $("#emailSendingModal").modal("hide");
                    }
                    console.log("success");
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
        }

    });

    var multiple_partner_id = [];
    var multiple_partner_name = [];
    $(document).delegate("#table_of_partner #partnerr_row", "click", function (event) {
        // $("#table_of_partner tr").live('click', function(event) {

        $("#table_of_partner tr").removeClass('active edit_partner danger');
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
                $(this).addClass('enable_to_multi_share');

            }

        } else {
            $(this).addClass('active edit_partner');
        }
    });

    $(document).delegate(".enable_to_multi_share", "click", function (event) {
        $(this).removeClass('enable_to_multi_share');
        var share_partner_name = $(this).children('.share_partner_name').val();
        var this_partner_id = $(this).children('.partner_id').val();

        multiple_partner_id = $.grep(multiple_partner_id, function (value) {
            return value != this_partner_id;
        });

        multiple_partner_name = $.grep(multiple_partner_name, function (value) {
            return value != share_partner_name;
        });
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
    });

    $("#edit_partner_button").on('click', function (event) {
        event.preventDefault();
        $("#eidt_email_partner_message").removeClass('hide').addClass('show');

        $(".edit_partner").removeClass('active').addClass('danger');
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

    function save_edit_partner() {
        var base_url = $("#base_url").val();
        var url = base_url + "index.php/api/emailing/save_edit_partner";
        var api_key = $('#api_key').val();
        var user_id = $("#user_id").val();

        var edit_partner_id = $(".edit_partner").children('.partner_id').val();
        var partner_name = $(".edit_partner .input_partner_name").val();
        var company = $(".edit_partner .input_partner_compay").val();
        var partner_mobile = $(".edit_partner .input_partner_mobile").val();
        // alert(partner_name);

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
                    partner_mobile: partner_mobile,
                    partner_type: 0 // 0: as it is create from normal email form
                }),
                contentType: "application/json",
            })
                .done(function (data) {
                    $("#ajax_loading_aria").hide();
                    var data = JSON.parse(data);
                    if (data.message == 'success') {
                        $("#partner_edit_aria").addClass('hide').removeClass('show');
                        get_user_partners();
                    } else if (data.message == 'invalid partner') {
                        // $("#invalid_partner_error_message").show();
                        $("#email_invalid_partner_error_message").removeClass('hide').addClass('show');

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


    function toObject(arr) {
        var rv = {};
        for (var i = 0; i < arr.length; ++i)
            rv[i] = arr[i];
        return rv;
    }


    $("#select_all").click(function () {
        $(".email_select").prop('checked', $(this).prop('checked'));
    });

    $("#select_draft_all").click(function () {
        $(".draft_email_select").prop('checked', $(this).prop('checked'));
    });


    $("#btn_delete_email").on('click', function (event) {
        event.preventDefault();
        $("#delete_multiple_email_confirmation_aria").removeClass('hide').addClass('show');

    });


    $("#delete_multiple_email_confirmation").click(function (event) {

        var selected = [];
        $('.email_select:checkbox:checked').each(function () {
            selected.push($(this).attr('value'));
        });

        var select_email_id = selected;

        var url = $("#base_url").val() + 'index.php/api/emailing/delete_email';
        var api_key = $('#api_key').val();
        var user_id = $("#user_id").val();
        if (selected.length > 0) {
            $.ajax({
                url: url,
                type: 'POST',
                beforeSend: function () {
                    $("#ajax_loading_aria").show();
                },
                data: JSON.stringify({
                    api_key: api_key,
                    user_id: user_id,
                    email_ids: select_email_id
                }),
                contentType: "application/json"
            })
                .done(function (data) {
                    get_user_email();
                    get_last_email();
                    console.log('success');
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
        }
    });

    function get_last_email() {

        var user_id = $("#user_id").val();
        var api_key = $("#api_key").val();
        var base_url = $("#base_url").val();
        var email_id = $("#reply_mail_id").val();
        // alert(email_id);die();
        var url = base_url + 'index.php/api/emailing/show_last_email_details';
        $.ajax({
            url: url,
            type: 'POST',
            data: JSON.stringify({
                api_key: api_key,
                user_id: user_id,
                email_id: email_id
            }),
            contentType: "application/json",
        })
            .done(function (data) {
                // alert(data);
                var data = JSON.parse(data);

                if (data.success == 1) {
                    // alert(data.email_details.email_id);
                    var email_subject = data.last_email.subject;
// alert(email_subject);die();
                    if (email_subject != null) {
                        email_subject = data.last_email.subject;
                    } else {
                        // email_subject = data.settlement_title;
                    }

                    $("#reply_mail_id").val(data.last_email.email_id);
                    var decode_user_id = b64DecodeUnicode(user_id);
                    // alert(decode_user_id);
                    $("#edit_draft_mail").removeClass('show').addClass('hide');
                    if (data.last_email.email_id) {
                        $("#email_details_button_aria").removeClass('hide').addClass('show');
                    }
                    if (decode_user_id == data.last_email.created_by) {
                        $("#reply_mail").removeClass('show').addClass('hide');


                        // $("#edit_draft_mail").removeClass('show').addClass('hide');
                        $("#email_sender_and_receiver").text(data.last_email.receiver_name + "(" + data.last_email.receiver_mobile + ")");
                    } else {
                        $("#reply_mail").removeClass('hide').addClass('show');
                        // $("#edit_draft_mail").removeClass('show').addClass('hide');
                        $("#email_sender_and_receiver").text(data.last_email.sender_name + "(" + data.last_email.sender_mobile + ")");
                    }

                    $("#email_create_date").text(data.japan_date);
                    $("#email_content_detail").html(data.last_email.content);
                    $('#email_detail_subject').text(email_subject);
                    // $('#view_email_settlement_id').html(data.settlement_id);
                    // if (data.only_settlement_id != '') {
                    //     $('#text_settlement_id').html(data.only_settlement_id);
                    //     $("#view_settlement_form_yes_no_popup").show();
                    // } else {
                    //     $("#view_settlement_form_yes_no_popup").hide();
                    // }
                }
                console.log('success');
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });

    }

    function get_last_email_of_partner() {

        var user_id = $("#user_id").val();
        var api_key = $("#api_key").val();
        var base_url = $("#base_url").val();
        var url = base_url + 'index.php/emailing/get_most_partner_last_email';
        $.ajax({
            url: url,
            type: 'POST',
            data: JSON.stringify({
                api_key: api_key,
                user_id: user_id,
            }),
            contentType: "application/json",
        })
            .done(function (data) {
                // console.log(data);
                // die();
                // return false;
                var data = JSON.parse(data);
                // console.log(data.success)
                if (data.success == 1) {
                    $("#edit_draft_mail").removeClass('show').addClass('hide');
                    $("#reply_mail_id").val(data.email_id);
                    var decode_user_id = b64DecodeUnicode(user_id);
                    // alert(decode_user_id);
                    if (data.email_id) {
                        $("#email_details_button_aria").removeClass('hide').addClass('show');
                    }
                    if (decode_user_id == data.created_by) {
                        $("#reply_mail").removeClass('show').addClass('hide');
                        // $("#edit_draft_mail").removeClass('show').addClass('hide');
                        $("#email_sender_and_receiver").text(data.receiver_name);
                    } else {
                        $("#reply_mail").removeClass('hide').addClass('show');
                        // $("#edit_draft_mail").removeClass('show').addClass('hide');
                        $("#email_sender_and_receiver").text(data.sender_name + "(" + data.sender_mobile + ")");
                    }

                    $("#email_create_date").text(data.created_at);
                    $("#email_content_detail").html(data.content);
                    $('#email_detail_subject').text(data.subject);
                }
                console.log('success');
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });

    }

    function get_last_draft_email() {
        var user_id = $("#user_id").val();
        var api_key = $("#api_key").val();
        var base_url = $("#base_url").val();
        var url = base_url + 'index.php/api/emailing/show_last_draft_email_details';
        $.ajax({
            url: url,
            type: 'POST',
            data: JSON.stringify({
                api_key: api_key,
                user_id: user_id,
            }),
            contentType: "application/json",
        })
            .done(function (data) {
                // console.log(data);
                // return false;
                var data = JSON.parse(data);
                if (data.success == 1) {
                    $("#reply_mail_id").val(data.last_email.email_id);
                    var decode_user_id = b64DecodeUnicode(user_id);
                    // alert(decode_user_id);
                    if (data.last_email.email_id) {
                        $("#email_details_button_aria").removeClass('hide').addClass('show');
                    }
                    if (decode_user_id == data.last_email.created_by) {
                        $("#reply_mail").removeClass('show').addClass('hide');
                        // $("#edit_draft_mail").removeClass('show').addClass('hide');
                        $("#email_sender_and_receiver").text(data.last_email.receiver_name + "(" + data.last_email.receiver_mobile + ")");
                    } else {
                        $("#reply_mail").removeClass('hide').addClass('show');
                        // $("#edit_draft_mail").removeClass('show').addClass('hide');
                        $("#email_sender_and_receiver").text(data.last_email.sender + "(" + data.last_email.sender_mobile + ")");
                    }

                    $("#email_create_date").text(data.japan_date);
                    $("#email_content_detail").html(data.last_email.content);
                    $('#email_detail_subject').text(data.last_email.subject);
                }
                console.log('success');
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });

    }

    // Auto Suggest for Emaril Receiver Mobile
    $("#receiver_mobile").keyup(function () {
        var login_user_id = $("#login_user_id").val();
        $("#suggesstion-box").hide();
        var url = $("#base_url").val() + 'index.php/emailing/partner_mobile_auto_sugg';
        $.ajax({
            type: "POST",
            url: url,
            data: {partner_mobile: $(this).val(), user_id: login_user_id},
            beforeSend: function () {
                $("#receiver_mobile").css("background", "#FFF url(resource/img/ajax/ajax_load_9.gif) no-repeat 220px");
            },
            success: function (data) {
                // alert(data);
                console.log(data);
                $("#mobile_suggesstion-box").show();
                $("#mobile_suggesstion-box").html(data);
                $("#receiver_mobile").css("background", "#FFF");
            }
        });
    });

    $(document).delegate(".partner_mobile_auto_click", "click", function (event) {
        event.preventDefault();
        var receiver_name = $(this).attr('data');
        var receiver_mobile = $(this).attr('id');
        if ($("#receiver_name").val() == "") {
            $("#receiver_name").val(receiver_name);
        }
        $("#receiver_mobile").val(receiver_mobile);
        $("#mobile_suggesstion-box").hide();
        $("#subject").focus();
    });

    // Auto Suggest for Emaril Receiver Name
    $("#receiver_name").keyup(function () {
        var login_user_id = $("#login_user_id").val();
        $("#mobile_suggesstion-box").hide();
        var url = $("#base_url").val() + 'index.php/emailing/partner_auto_sugg';
        $.ajax({
            type: "POST",
            url: url,
            data: {partner_name: $(this).val(), user_id: login_user_id},
            beforeSend: function () {
                $("#receiver_name").css("background", "#FFF url(resource/img/ajax/ajax_load_9.gif) no-repeat 220px");
            },
            success: function (data) {
                // alert(data);
                console.log(data);
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#receiver_name").css("background", "#FFF");
            }
        });
    });

    $(document).delegate(".partner_auto_click", "click", function (event) {
        event.preventDefault();
        var receiver_name = $(this).attr('data');
        var receiver_mobile = $(this).attr('id');

        $("#receiver_name").val(receiver_name);
        $("#receiver_mobile").val(receiver_mobile);
        $("#suggesstion-box").hide();
        $("#subject").focus();
    });

    function strip(html) {
        var tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || "";
    }

    $("#btn_introduce").on('click', function (event) {
        event.preventDefault();
        $("#table_of_introducer").removeClass('hide').addClass('show');
        $("#none_introducer").click(function (event) {
            $("input[id='introducer_name']").attr('disabled', true);
            $("input[id='introducer_number']").attr('disabled', true);
        });
        $("#has_introducer").click(function (event) {
            $("input[id='introducer_name']").attr('disabled', false);
            $("input[id='introducer_number']").attr('disabled', false);
        });
        // get_introducer_referee();
        // $.alert("Okay");
    });

    var introducer_form = $("#introducer_form");
    introducer_form.submit(function (event) {
        event.preventDefault();
        // Authentication Information
        var base_url = $("#base_url").val();

        var url = base_url + "index.php/api/emailing/save_introducer_referee";
        var api_key = $('#api_key').val();
        var user_id = $("#user_id").val();
        // Form Information
        var referee_name = $("#referee_name").val();
        var referee_number = $("#referee_number").val();
        var introducer_name = $("#introducer_name").val();
        var introducer_number = $("#introducer_number").val();

        if ((api_key != "") && (user_id != "") && (referee_number != "")) {
            $.ajax({
                url: url,
                cache: false,
                type: 'POST',
                data: JSON.stringify({
                    api_key: api_key,
                    user_id: user_id,
                    referee_name: referee_name,
                    referee_number: referee_number,
                    introducer_name: introducer_name,
                    introducer_number: introducer_number
                }),
                contentType: "application/json",
            })
                .done(function (data) {
                    var data = JSON.parse(data);
                    if (data.success == 1) {
                        // $("#referee_name").val("");
                        // $("#referee_number").val("");
                        $("#introducer_name").val("");
                        $("#introducer_number").val("");
                        $("#table_of_introducer").removeClass('show').addClass('hide');
                        // get_introducer_referee();
                    } else if (data.success == 2) {
                        $("#table_of_introducer").removeClass('show').addClass('hide');
                    }
                    console.log("success");
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
        }

    });


    function get_introducer_referee() {
        // Authentication Information
        var base_url = $("#base_url").val();

        var url = base_url + "index.php/api/emailing/get_introducer_referee";
        var api_key = $('#api_key').val();
        var user_id = $("#user_id").val();
        if ((api_key != "") && (user_id != "")) {
            $.ajax({
                url: url,
                cache: false,
                type: 'POST',
                data: JSON.stringify({
                    api_key: api_key,
                    user_id: user_id
                }),
                contentType: "application/json",
            })
                .done(function (data) {
                    var data = JSON.parse(data);
                    if (data.success == 1) {

                        var introducer_referee = data.introducer_referee;
                        var indroducer_referee_table = document.getElementById("indroducer_referee_table");
                        indroducer_referee_table.innerHTML = "";
                        for (var i = 0; i <= introducer_referee.length; i++) {

                            indroducer_referee_table.innerHTML = indroducer_referee_table.innerHTML + "<tr><td width='50%'>" + introducer_referee[i].referee_name + "</td><td width='50%'>" + introducer_referee[i].referee_number + "</td><tr>";
                        }
                        // alert("Okay");
                        // var indroducer_referee = data.introducer_referee;
                        // introducer_referee.forEach(foreach_function);
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

    $("#close_introducer").on('click', function (event) {
        event.preventDefault();
        $("#table_of_introducer").removeClass('show').addClass('hide');
    });

    $("#account_setting-btn").on('click', function (event) {
        event.preventDefault();
        $("#account_settingModal").modal("show");
    });

    // Email Image Inserton
    $("#btn-mail-images").on('click', function (event) {
        event.preventDefault();
        $("#image_selection_message").removeClass('hide').addClass('show');
    });

    $("#email_upload_image").click(function (event) {
        event.preventDefault();
        tinymce.get('email_content').focus();
        $('#email_imgupload').trigger('click');
    });

    $("#close_email_image_selection").on('click', function (event) {
        event.preventDefault();

        $("#image_selection_message").removeClass('show').addClass('hide');
    });


    $('#email_imgupload').change(function (event) {
        event.preventDefault();
        $("#image_selection_message").removeClass('show').addClass('hide');
        $("#image_past_message").removeClass('hide').addClass('show');
        email_startUpload();
        // alert("Okay");
    });

    $("#cursor_ok").on('click', function (event) {
        event.preventDefault();
        $("#image_past_message").removeClass('show').addClass('hide');
        $("#image_past_confirmation").removeClass('hide').addClass('show');
        /* Act on the event */
    });

    $("#cursor_colse").on('click', function (event) {
        event.preventDefault();

        $("#image_past_message").removeClass('show').addClass('hide');
        /* Act on the event */
    });

    $("#image_paste_ok").on('click', function (event) {
        event.preventDefault();
        var file_name = $("#uploaded_file_name").val();
        // alert(file_name);
        var raw_name = file_name.split(".");
        $("#image_past_confirmation").removeClass('show').addClass('hide');
        tinymce.execCommand('mceInsertContent', false, '<img width="400" style="margin: 5px 10px; float:left; overflow: hidden !important;" align="middle" id="' + raw_name[0] + '" src="uploads/' + file_name + '">');

        $("#image_zooming").removeClass('hide').addClass('show');
    });

    $("#image_paste_close").on('click', function (event) {
        event.preventDefault();
        $("#image_past_confirmation").removeClass('show').addClass('hide');
    });

    $("#image_zooming_close").on('click', function (event) {
        event.preventDefault();
        $("#image_zooming").removeClass('show').addClass('hide');
    });

    function email_startUpload() {
        var base_url = $("#base_url").val();

        var file_data = $('#email_imgupload').prop('files')[0];
        var form_data = new FormData();
        form_data.append('userfile', file_data);

        var url = base_url + "index.php/emailing/email_image_upload";
        if ($("#email_imgupload").val() != "") {
            $.ajax({
                url: url,
                method: 'POST',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
            })
                .done(function (data) {
                    var data = JSON.parse(data);
                    $("#uploaded_file_name").val(data.upload_data.file_name);
                    console.log(data.upload_data.file_name);
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });

        } else {
            $.alert("Please select picture")
        }
    }

    $("#image_zoom_btn").on("click", function (event) {
        event.preventDefault();
        var last_image_name = $("#uploaded_file_name").val();
        var last_image_id = last_image_name.split(".");
        image_zooming(last_image_id[0]);
    })

    $("#image_small_btn").on("click", function (event) {
        event.preventDefault();
        var last_image_name = $("#uploaded_file_name").val();
        var last_image_id = last_image_name.split(".");
        image_smalling(last_image_id[0]);
    })


    function image_zooming(image_id) {
        var image_id = tinyMCE.activeEditor.dom.select('#' + image_id);
        var current_image_width = $("#email_image_width").val();
        var replace_image_width = parseInt(current_image_width) + 50;
        $(image_id[0]).attr('width', replace_image_width);
        $("#email_image_width").val(replace_image_width);
        if (current_image_width > 850) {
            $("#image_zoom_btn").attr('disabled', "disabled");
        }

        // if (current_image_width<900) {
        // 	$("#image_zoom_btn").attr('disabled', "false");
        // }
    }

    function image_smalling(image_id) {
        var image_id = tinyMCE.activeEditor.dom.select('#' + image_id);
        var current_image_width = $("#email_image_width").val();
        var replace_image_width = parseInt(current_image_width) - 50;
        $(image_id[0]).attr('width', replace_image_width);
        $("#email_image_width").val(replace_image_width);
        // if (current_image_width<200) {
        // 	$("#image_small_btn").attr('disabled', "disabled");
        // }
    }

    $("#image_width_completed").on('click', function (event) {
        event.preventDefault();
        $("#image_upload_completed").removeClass('hide').addClass('show');
        $("#image_zooming").removeClass('show').addClass('hide');

    });

    $("#image_upload_completed_close").on('click', function (event) {
        event.preventDefault();

        $("#image_upload_completed").removeClass('show').addClass('hide');
    });


    // Word Picture Insertion
    $("#inserImage").on('click', function (event) {
        event.preventDefault();
        $(".multiple_navi").removeClass('show').addClass('hide');
        $("#word_image_selection_message").removeClass('hide').addClass('show');
        $("#font_family_aria").removeClass('show').addClass('hide');
        $("#font_size_aria").removeClass('show').addClass('hide');
        $("#word_image_selection_message").removeClass('hide').addClass('show');
        $("#close_word_image_selection").focus();
    });
    $("#close_word_image_selection").on('click', function (event) {
        event.preventDefault();

        $("#word_image_selection_message").removeClass('show').addClass('hide');
    });

    $("#word_upload_image").click(function (event) {
        event.preventDefault();
        $('#word_imgupload').trigger('click');
    });

    $('#word_imgupload').change(function (event) {
        event.preventDefault();
        $("#word_image_selection_message").removeClass('show').addClass('hide');
        startUpload();
        // alert("Okay");
    });

    $("#word_cursor_ok").on('click', function (event) {
        event.preventDefault();
        $("#word_image_past_message").removeClass('show').addClass('hide');
        $("#word_image_past_confirmation").removeClass('hide').addClass('show');
        /* Act on the event */
    });

    $("#word_cursor_colse").on('click', function (event) {
        event.preventDefault();
        $("#word_imgupload").val('');
        $("#word_image_past_message").removeClass('show').addClass('hide');
        $("#word_image_selection_message").removeClass('hide').addClass('show');
        /* Act on the event */
    });


    $("#word_image_paste_ok").on('click', function (event) {
        event.preventDefault();
        var file_name = $("#word_uploaded_file_name").val();
        var raw_name = file_name.split(".");
        $("#word_image_past_confirmation").removeClass('show').addClass('hide');
        tinymce.execCommand('mceInsertContent', false, '<img width="400" style="margin: 5px 10px; float:left; overflow: hidden !important;" align="middle" id="' + raw_name[0] + '" src="uploads/' + file_name + '"> ');
        // tinymce.execCommand('mceInsertContent', false, '&nbsp');

        $("#word_image_zooming").removeClass('hide').addClass('show');
        /* Act on the event */
    });

    $("#word_image_paste_colse").on('click', function (event) {
        event.preventDefault();
        $("#word_image_past_confirmation").removeClass('show').addClass('hide');
        $("#word_image_past_message").removeClass('hide').addClass('show');
    });

    // $("#word_image_zooming_close").on('click', function (event) {

    //     event.preventDefault();
    //     $("#word_image_zooming").removeClass('show').addClass('hide');
    //     $("#word_image_past_confirmation").removeClass('hide').addClass('show');
    // });

    function startUpload() {
        var base_url = $("#base_url").val();
        // var base_url = $( "#email_imgupload" ).val();

        var file_data = $('#word_imgupload').prop('files')[0];
        var form_data = new FormData();
        form_data.append('userfile', file_data);
        // alert(form_data[0]);
        // return false;
        var url = base_url + "index.php/emailing/email_image_upload";

        if ($("#word_imgupload").val() != "") {
            $.ajax({
                url: url,
                method: 'POST',
                beforeSend: function () {
                    $("#ajax_loading_aria").removeClass('hide').addClass('show');
                },
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
            })
            .done(function (data) {
                var data = JSON.parse(data);
                if (data.error.length>0) {
                    $("#word_imgupload").val('')
                    $("#word_image_upload_error_message").html(data.error);
                    $("#word_image_upload_error").removeClass('hide').addClass('show');
                } else {
                    $("#word_imgupload").val('')
                    $("#word_image_past_message").removeClass('hide').addClass('show');
                    $("#word_uploaded_file_name").val(data.upload_data.file_name);
                }
                
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                $("#ajax_loading_aria").removeClass('show').addClass('hide');
                console.log("complete");
            });

        } else {
            $.alert("Please select picture")
        }

    }

    $("#return_image_upload_for_error").on('click', function(event) {
        event.preventDefault();
        $("#word_image_upload_error").removeClass('show').addClass('hide');
        $("#word_image_selection_message").removeClass('hide').addClass('show');
    });

    $("#word_image_zoom_btn").on("click", function (event) {
        event.preventDefault();
        var last_image_name = $("#word_uploaded_file_name").val();
        var last_image_id = last_image_name.split(".");
        word_image_zooming(last_image_id[0]);
    })

    $("#word_screen_image_zoom_btn").on("click", function (event) {
        event.preventDefault();
        var image_class = tinyMCE.activeEditor.dom.select('.last_uploaded_image');
        // var current_image_width = $("#word_image_width").val();
        var realWidth = $(image_class).attr('width');
        $(image_class).removeAttr("height");
        var replace_image_width = parseInt(realWidth) + 50;
        
        $("#word_image_small_btn").removeClass('disabled');
        if (realWidth > 600) {
            $("#word_image_zoom_btn").addClass('disabled');
        }else{
            $(image_class).attr('width', replace_image_width);
            $("#word_image_width").val(replace_image_width);
        }
    })

    $("#word_image_small_btn").on("click", function (event) {
        event.preventDefault();
        var last_image_name = $("#word_uploaded_file_name").val();
        var last_image_id = last_image_name.split(".");
        word_image_smalling(last_image_id[0]);
    })

    $("#word_screen_image_small_btn").on("click", function (event) {
        event.preventDefault();
        var image_class = tinyMCE.activeEditor.dom.select('.last_uploaded_image');
        $(image_class).removeAttr("height");
        // var current_image_width = $("#word_image_width").val();
        var realWidth = $(image_class).attr('width');
        var replace_image_width = parseInt(realWidth) - 50;
        $("#word_image_zoom_btn").removeClass('disabled');
        // alert(replace_image_width);
        if (realWidth<50) {
            $("#word_image_small_btn").addClass('disabled');
        } else {
            $(image_class).attr('width', replace_image_width);
            $("#word_image_width").val(replace_image_width);
        }
    })


    function word_image_zooming(image_id) {
        var image_id = tinyMCE.activeEditor.dom.select('#' + image_id);
        var current_image_width = $("#word_image_width").val();

        var replace_image_width = parseInt(current_image_width) + 50;
        
        $("#word_image_small_btn").removeClass('disabled');
        if (current_image_width > 600) {
            $("#word_image_zoom_btn").addClass('disabled');
        }else{
            $(image_id[0]).attr('width', replace_image_width);
            $("#word_image_width").val(replace_image_width);
        }
    }

    function word_image_smalling(image_id) {
        var image_id = tinyMCE.activeEditor.dom.select('#' + image_id);
        var current_image_width = $("#word_image_width").val();
        var replace_image_width = parseInt(current_image_width) - 50;
        $("#word_image_zoom_btn").removeClass('disabled');
        // alert(replace_image_width);
        if (replace_image_width<50) {

            $("#word_image_small_btn").addClass('disabled');
        } else {
            $(image_id[0]).attr('width', replace_image_width);
            $("#word_image_width").val(replace_image_width);
        }
    }

    $("#word_image_width_completed").on('click', function (event) {
        event.preventDefault();
        $("#word_image_width").val('400');
        $("#word_image_zoom_btn").removeClass('disabled');
        $("#word_image_small_btn").removeClass('disabled');
        $("#word_image_upload_completed").removeClass('hide').addClass('show');
        $("#word_image_zooming").removeClass('show').addClass('hide');

    });

    $("#word_screen_image_width_completed").on('click', function (event) {
        event.preventDefault();
        $("#word_image_width").val('400');
        $("#word_screen_image_zoom_btn").removeClass('disabled');
        $("#word_screen_image_small_btn").removeClass('disabled');
        $(".btn_keipro").removeAttr("disabled");
        var image_att_select = tinyMCE.activeEditor.dom.select("img[data-attr-screen='screen_image']");
        $(image_att_select).removeClass('last_uploaded_image');
        // $("#word_image_upload_completed").removeClass('hide').addClass('show');
        $("#screen_image_zooming").removeClass('show').addClass('hide');

    });

    $("#word_image_upload_completed_close").on('click', function (event) {
        event.preventDefault();
        $("#word_image_upload_completed").removeClass('show').addClass('hide');
    });


    //    Work on Word pagenasion
    $("#word_next_page").on('click', function (event) {
        event.preventDefault();
        // $("#table_of_contantes").removeClass("hide").addClass("show");
        var login_user_id = $("#login_user_id").val();
        var start_from = $("#word_start_list").val();
        var word_list_limit = $("#word_limit_list").val();
        var total_user_post = $("#total_user_post").val();
        if (parseInt(start_from)+30 > total_user_post) {
           return false;
        } 
        start_from = parseInt(start_from) + 30;
        
        $("#word_start_list").val(start_from);

        var url = $("#base_url").val() + 'index.php/wordapp/get_user_post/';

        $.ajax({
            url: url,
            type: 'POST',
            beforeSend: function () {
                $("#ajax_loading_aria").removeClass('hide').addClass('show');
            },
            data: {login_user_id: login_user_id, start_from: start_from, list_limit: word_list_limit}
        })
        .done(function (data) {
            var response = JSON.parse(data);
            var x = 10;
            var y = 20;
            var htmlData = "";
            for (var i = 0; i < 10; i++) {
                var extra_class = "";
                    htmlData += "<tr>";
                        htmlData += '<td nowrap="nowrap">'+ (start_from+i+1) +'</td>';
                        if ((start_from+i) < response.total_user_post) {
                            if (restore_post_ids.indexOf(response.user_posts[i].post_id) !== -1) {
                            extra_class ="recent_restore";
                            }else{
                                extra_class = "";
                            }
                            if (open_file_id==response.user_posts[i].post_id) {
                                open_file = "open_file";
                            }else{
                                open_file = "";
                            }
                            htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="content_title '+extra_class+' '+open_file+'">';
                        
                            htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[i].post_id+"'>";
                            htmlData += response.user_posts[i].post_title;
                        
                            htmlData += '</td>';
                        }else{
                            htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="">';
                            htmlData += '</td>';
                        }
                        htmlData += '<td nowrap="nowrap">'+ (start_from+i+x+1) +'</td>';
                        if ((start_from+x+i) < response.total_user_post) {
                            if (restore_post_ids.indexOf(response.user_posts[x+i].post_id) !== -1) {
                            extra_class ="recent_restore";
                            }else{
                                extra_class = "";
                            }
                            if (open_file_id==response.user_posts[x+i].post_id) {
                                open_file = "open_file";
                            }else{
                                open_file = "";
                            }
                            htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="content_title '+extra_class+' '+open_file+'">';
                            htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[x+i].post_id+"'>";
                            htmlData += response.user_posts[x+i].post_title;
                        
                                htmlData += '</td>';
                        }else{
                            htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="">';
                            htmlData += '</td>';
                        }
                        htmlData += '<td nowrap="nowrap">'+ (start_from+i+y+1) +'</td>';
                        if ((start_from+y+i) < response.total_user_post) {
                            if (restore_post_ids.indexOf(response.user_posts[y+i].post_id) !== -1) {
                            extra_class ="recent_restore";
                            }else{
                                extra_class = "";
                            }
                            if (open_file_id==response.user_posts[y+i].post_id) {
                                open_file = "open_file";
                            }else{
                                open_file = "";
                            }
                            htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="content_title '+extra_class+' '+open_file+'">';
                            htmlData += response.user_posts[y+i].post_title;
                        
                            htmlData += '</td>';
                        }else{
                            htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="">';
                            htmlData += '</td>';
                        }
                    htmlData += '</tr>';
            }
            // document.getElementById("trash_post_list").innerHTML = data
            $('#post_list').html(htmlData);
            // $("#ajax_loading_aria").hide();
            // document.getElementById('post_list').innerHTML = html;
            $("td.content_title").each(function () {
                var DELAY = 300, clicks = 0, timer = null;
                $(this).on("click", function () {
                    var post_id = $(this).children('.word_id').val();
                    clicks++;  //count clicks
                    $('td.content_title').removeClass("checked");
                    $(this).addClass("checked");
                    if (clicks === 1) {

                        timer = setTimeout(function () {

                            clicks = 0;  //after action performed, reset counter
                            if (post_id !== undefined) {
                                // alert(post_id);
                                $(this).addClass("checked");
                            } else {
                                $('td.content_title').removeClass("checked");
                            }
                        }, DELAY);

                    } else {
                        clearTimeout(timer);    //prevent single-click action
                        clicks = 0;             //after action performed, reset
                        $.ajax({
                            url: "index.php/wordapp/get_post_by_id",
                            type: 'POST',
                            data: {post_id: post_id},
                        })
                            .done(function (data) {
                                var post_data = JSON.parse(data);
                                $("#post_id ").val(post_data.post_id);
                                open_file_id = post_data.post_id;
                                $("#current_open_file").val(post_data.post_id);
                                $("#table_of_contantes").removeClass("show").addClass("hide");
                                tinyMCE.get('doc_content').setContent(post_data.post_details);
                                tinymce.execCommand('mceFocus',false,'doc_content');
                                console.log("success");
                            })
                            .fail(function () {
                                console.log("error");
                            })
                            .always(function () {
                                console.log("complete");
                            });
                    }
                });
            });
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
            $("#ajax_loading_aria").removeClass('show').addClass('hide');
        });
    });

    $("#word_previous_page").on('click', function (event) {
        event.preventDefault();
        // $("#table_of_contantes").removeClass("hide").addClass("show");
        var login_user_id = $("#login_user_id").val();
        var start_from = $("#word_start_list").val();
        var word_list_limit = $("#word_limit_list").val();
        var total_user_post = $("#total_user_post").val();

        if (start_from < 1) {
            return false;
            // $('#word_previous_page').attr('disabled', 'disabled');
        } 
        if (word_list_limit == "") {
            start_from = 0;
            word_list_limit = 30;
            $("#word_start_list").val(0);
            $("#word_limit_list").val(30);
        } else {
            start_from = parseInt(start_from) - 30;
            word_list_limit = parseInt(word_list_limit) - 30;
            $("#word_limit_list").val(word_list_limit);
            $("#word_start_list").val(start_from);
        }

        

        var url = $("#base_url").val() + 'index.php/wordapp/get_user_post/';
        $.ajax({
            url: url,
            type: 'POST',
            beforeSend: function () {
                $("#ajax_loading_aria").removeClass('hide').addClass('show');
            },
            data: {login_user_id: login_user_id, start_from: start_from, list_limit: word_list_limit},
        })
        .done(function (data) {
            var response = JSON.parse(data);

        var x = 10;
        var y = 20;
        var htmlData = "";
        for (var i = 0; i < 10; i++) {
            var extra_class = "";
                htmlData += "<tr>";
                    htmlData += '<td nowrap="nowrap">'+ (start_from+i+1) +'</td>';
                    if ((start_from+i) < response.total_user_post) {
                        if (restore_post_ids.indexOf(response.user_posts[i].post_id) !== -1) {
                            extra_class ="recent_restore";
                        }else{
                            extra_class = "";
                        }
                        if (open_file_id==response.user_posts[i].post_id) {
                            open_file = "open_file";
                        }else{
                            open_file = "";
                        }
                        htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="content_title '+extra_class+' '+open_file+'">';
                    
                        htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[i].post_id+"'>";
                        htmlData += response.user_posts[i].post_title;
                    
                        htmlData += '</td>';
                    }else{
                        htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="">';
                        htmlData += '</td>';
                    }
                    htmlData += '<td nowrap="nowrap">'+ (start_from+i+x+1) +'</td>';
                    if ((start_from+x+i) < response.total_user_post) {
                        if (restore_post_ids.indexOf(response.user_posts[x+i].post_id) !== -1) {
                            extra_class ="recent_restore";
                        }else{
                            extra_class = "";
                        }
                        if (open_file_id==response.user_posts[x+i].post_id) {
                            open_file = "open_file";
                        }else{
                            open_file = "";
                        }
                        htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="content_title '+extra_class+' '+open_file+'">';
                        
                        
                            htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[x+i].post_id+"'>";
                            htmlData += response.user_posts[x+i].post_title;
                       
                        htmlData += '</td>';
                     }else{
                        htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="">';
                        htmlData += '</td>';
                    }
                    htmlData += '<td nowrap="nowrap">'+ (start_from+i+y+1) +'</td>';
                    if ((start_from+y+i) < response.total_user_post) {
                        if (restore_post_ids.indexOf(response.user_posts[y+i].post_id) !== -1) {
                            extra_class ="recent_restore";
                        }else{
                            extra_class = "";
                        }
                        if (open_file_id==response.user_posts[y+i].post_id) {
                            open_file = "open_file";
                        }else{
                            open_file = "";
                        }
                        htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="content_title '+extra_class+' '+open_file+'">';
                    
                        htmlData += "<input type='hidden' name='word_id' id'word_id' class='word_id' value='"+response.user_posts[y+i].post_id+"'>";
                        htmlData += response.user_posts[y+i].post_title;
                    
                        htmlData += '</td>';
                    }else{
                        htmlData += '<td nowrap="nowrap" att-post-id="" width="30%" class="">';
                        htmlData += '</td>';
                    }
                htmlData += '</tr>';
        }
        // document.getElementById("trash_post_list").innerHTML = data
        $('#post_list').html(htmlData);
            // $("#ajax_loading_aria").hide();
            // document.getElementById('post_list').innerHTML = html;
            $("td.content_title").each(function () {
                var DELAY = 300, clicks = 0, timer = null;
                $(this).on("click", function () {
                    var post_id = $(this).children('.word_id').val();
                    clicks++;  //count clicks
                    $('td.content_title').removeClass("checked");
                    $(this).addClass("checked");
                    if (clicks === 1) {

                        timer = setTimeout(function () {

                            clicks = 0;  //after action performed, reset counter
                            if (post_id !== undefined) {
                                // alert(post_id);
                                $(this).addClass("checked");
                            } else {
                                $('td.content_title').removeClass("checked");
                            }
                        }, DELAY);

                    } else {
                        clearTimeout(timer);    //prevent single-click action
                        clicks = 0;             //after action performed, reset
                        $.ajax({
                            url: "index.php/wordapp/get_post_by_id",
                            type: 'POST',
                            data: {post_id: post_id},
                        })
                            .done(function (data) {
                                var post_data = JSON.parse(data);
                                $(" #post_id ").val(post_data.post_id)
                                $("#table_of_contantes").removeClass("show").addClass("hide");
                                open_file_id = post_data.post_id;
                                $("#current_open_file").val(post_data.post_id);
                                tinyMCE.get('doc_content').setContent(post_data.post_details);
                                tinymce.execCommand('mceFocus',false,'doc_content');
                                console.log("success");
                            })
                            .fail(function () {
                                console.log("error");
                            })
                            .always(function () {
                                console.log("complete");
                            });
                    }
                });
            });
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
            $("#ajax_loading_aria").removeClass('show').addClass('hide');
        });
    });


    $(document).mouseup(function (e) {

        var tynimce_specialCar = $("#mceu_4");
        if (!tynimce_specialCar.is(e.target) && tynimce_specialCar.has(e.target).length === 0) {
            $("#mceu_11").trigger('click');
        }

        var table_of_contantes = $("#table_of_contantes");

        // if the target of the click isn't the container nor a descendant of the container
        // if (!table_of_contantes.is(e.target) && table_of_contantes.has(e.target).length === 0) {
        //     table_of_contantes.removeClass('show').addClass('hide');
        // }

        // var font_family_aria = $("#font_family_aria");
        // if (!font_family_aria.is(e.target) && font_family_aria.has(e.target).length === 0) {
        //     font_family_aria.removeClass('show').addClass('hide');
        // }

        // var font_size_aria = $("#font_size_aria");
        // if (!font_size_aria.is(e.target) && font_size_aria.has(e.target).length === 0) {
        //     font_size_aria.removeClass('show').addClass('hide');
        // }

        // var word_image_selection_message = $("#word_image_selection_message");
        // if (!word_image_selection_message.is(e.target) && word_image_selection_message.has(e.target).length === 0) {
        //     word_image_selection_message.removeClass('show').addClass('hide');
        // }

        // var word_function_aria = $("#word_function_aria");
        // if (!word_function_aria.is(e.target) && word_function_aria.has(e.target).length === 0) {
        //     word_function_aria.removeClass('show').addClass('hide');
        // }

        // var font_color_aria = $("#font_color_aria");
        // if (!font_color_aria.is(e.target) && font_color_aria.has(e.target).length === 0) {
        //     font_color_aria.removeClass('show').addClass('hide');
        //     var show_color_popup = $("#show_color_popup").val()
        //     if (show_color_popup == 1) {
        //         $("#show_color_popup").val(0)
        //         $("#word_function_aria").removeClass('hide').addClass('show');
        //     }
        // }

        var word_canvase_aria = $("#word_canvase_aria");
        if (!word_canvase_aria.is(e.target) && word_canvase_aria.has(e.target).length === 0) {
            word_canvase_aria.removeClass('show').addClass('hide');
        }

        var shapes_area = $("#shapes_area");
        if (!shapes_area.is(e.target) && shapes_area.has(e.target).length === 0) {
            shapes_area.removeClass('show').addClass('hide');
        }

        var table_of_partner = $("#table_of_partner");
        if (!table_of_partner.is(e.target) && table_of_partner.has(e.target).length === 0) {
            table_of_partner.removeClass('show').addClass('hide');
        }

        var email_share_navi_user_list = $("#email_share_navi_user_list");
        if (!email_share_navi_user_list.is(e.target) && email_share_navi_user_list.has(e.target).length === 0) {
            email_share_navi_user_list.removeClass('show').addClass('hide');
        }

    });

    // $(document).mouseup(function (e){

    // 	if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    // 		 var body = $(".my_class");
    // 		// if the target of the click isn't the container nor a descendant of the container
    // 		if (!body.is(e.target) && body.has(e.target).length === 0)
    // 		{
    // 		    tinymce.execCommand('mceFocus', false, 'doc_content');           
    // 		}
    // 	}

    // });

    $("#internet_connection_alert_close").on('click', function (event) {
        event.preventDefault();
        $('.internet_connection_alert').slideUp(400);
    });

    $('body').keypress(function (e) {
        var key = e.which;
        if (key == 13) {
            $(".draggable_aria").removeClass('show').addClass('hide');
            $(".font_size_aria").removeClass('show').addClass('hide');
            $(".font_family_aria").removeClass('show').addClass('hide');
            $("#blanck_document_message").removeClass('show').addClass('hide');
            // $(".draggable_aria").removeClass('show').addClass('hide');
        }
    });

    $(document).keypress(function (e) {
        if (e.which == 13) {
            $(".close_aria, .font_color_aria, #word_function_aria, #word_image_selection_message, #font_size_aria, .font_family_aria, #font_cut_copy_aria").addClass('hide').removeClass('show');
            $("#table_of_contantes").addClass('hide').removeClass('show');
        }
    });

    $("#email_multiple_share").on('click', function (event) {
        event.preventDefault();
        var enable_email_multi_share = $("#enable_email_multi_share").val();
        if (enable_email_multi_share == 1) {
            $("#table_of_partner tr").removeClass('enable_to_multi_share');
            $("#enable_email_multi_share").val(0);
            $("#email_multiple_share").addClass('btn-success');
            $("#email_multiple_share").css("background-color", "#419641");
            $("#email_share_navi_message_aria").removeClass('show').addClass('hide');
        } else {
            $("#table_of_partner tr").removeClass('active edit_partner');
            $("#enable_email_multi_share").val(1);
            $("#email_multiple_share").removeClass('btn-success');
            $("#email_multiple_share").css("background-color", "yellow");
            $("#email_share_navi_message_aria").removeClass('hide').addClass('show');
        }
    });

    $("#share_multiple_button").on('click', function (event) {
        event.preventDefault();
        if (multiple_partner_name.length > 0) {
            $("#email_share_navi_user_list").removeClass('hide').addClass('show');
            var htmlSting = "";

            for (var i = 0; i < multiple_partner_name.length; i++) {
                htmlSting += '<li class="pull-left">' + multiple_partner_name[i] + '</li>';
            }
            $("#share_multiple_partner_list").html(htmlSting);

        }
    });

    $("#share_email_selected_partner").on('click', function (event) {
        event.preventDefault();
        var base_url = $("#base_url").val();
        var email_id = $("#reply_mail_id").val();
        var login_user_id = $("#login_user_id").val();
        var settlement_id = 0;
        var request_data = {
            'sender_id': login_user_id,
            'email_id': email_id,
            'partners': toObject(multiple_partner_id),
            'settlement_id': settlement_id // use when settlement/requisition from sharing
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
                $("#close_pertner").trigger('click');
                $("#success_email_message").removeClass('hide').addClass('show');
                console.log("success");
                get_user_email();
                get_last_email();
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });

    });

    // Send Email from Partner List
    $("#send_email_form_partner").on('click', function (event) {
        event.preventDefault();
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
        } else {
            $("#receiver_name").val("");
            $("#receiver_mobile").val("");
            $("#subject").val("");
            tinyMCE.get('email_content').setContent('');
            var partner_name = $(".edit_partner").find('.input_partner_name').val();
            var partner_mobile = $(".edit_partner").find('.input_partner_mobile').val();
            if (partner_mobile !== undefined) {
                $("#email_close").trigger("click");
                $("#emailSendingModal").modal("show");
                $("#receiver_name").val(partner_name);
                $("#receiver_mobile").val(partner_mobile);
                $("#subject").focus();
            } else {
                $("#select_partner").removeClass('hide').addClass('show');
                $("#close_select").click(function (event) {
                    $("#select_partner").removeClass('show').addClass('hide');
                    return false;
                });

            }
        }


    });

    $("#close_email_share_navi_user_list").on('click', function (event) {
        event.preventDefault();
        $("#email_share_navi_user_list").removeClass('show').addClass('hide');
    });

    function toObject(arr) {
        var rv = {};
        for (var i = 0; i < arr.length; ++i)
            rv[i] = arr[i];
        return rv;
    }

    $("#settlement_letter_choice1").on('click', function (event) {
        // alert(this.id);
        event.preventDefault();
        var id = this.id;
        if (id == 'settlement_letter_choice1') {
            if ((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1) {
                var style = 'height=650,width=1600, left=100, top=5, scrollbars=yes, resizable=1';
            }
            else if (navigator.userAgent.indexOf("Chrome") != -1) {
                var style = 'height=600,width=1600, left=0, top=0, scrollbars=yes, resizable=1,fullscreen=yes';
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
            window.open(base_url + 'index.php/wordapp/view_settlement_form', "New Window", style);

            // $('#table_of_settlement_letter_mail').removeClass('hide').addClass('show');
            // $("#settlement_letter_aria").hide();
        } else {

        }
    });
    $("#close_settlement_letter_form").on('click', function (event) {
        event.preventDefault();
        $('#table_of_settlement_letter_mail').removeClass('show').addClass('hide');
    });
    // $('#img_rect').resizable();
    $("#diamond_shape").click(function (event) {
        // tinymce.activeEditor.insertContent('<img border="0" id="btn-shapes-design" width="156" height="155" style=" " src="resource/img/shapes/diamond.png" />');
        tinymce.activeEditor.insertContent('<img border="0" id="img_diamond" width="156" height="155" style=" " src="resource/img/shapes/diamond.png" />');

    });
    $("#arrows_shape").click(function (event) {
        tinymce.activeEditor.insertContent('<img  id="img_arrow" width="200" height="14" style=" " src="resource/img/shapes/arrow.png" />');

    });
    $("#rect_shape").click(function (event) {
        tinymce.activeEditor.insertContent('<img border="1" id="img_rect" width="100" height="100" style=" " src="resource/img/shapes/rect.png" />');

    });
    $("#add_text").click(function (event) {

        if (tinymce.activeEditor.selection.getNode().nodeName.toLowerCase() === "img") {
            var img = tinymce.activeEditor.selection.getNode();
            // alert(img.width);
            // var image_width=img.width-50;
            var editor = tinymce.activeEditor;
            var tinymcePosition = $(editor.getContainer()).position();
            var toolbarPosition = $(editor.getContainer()).find(".mce-toolbar").first();
            var nodePosition = $(editor.selection.getNode()).position();
            if (img.id === 'img_diamond') {
                var left = nodePosition.left + 16;
                var top = nodePosition.top + 78;
                $(tinymce.activeEditor.selection.getNode()).before('<div id="add_custom_text_diamond" style="position: absolute;left:' + left + 'px;top:' + top + 'px;">&nbsp;テキストを追加&nbsp;</div>');
            }
            if (img.id === 'img_rect') {
                var left = nodePosition.left;
                var top = nodePosition.top + 34;
                $(tinymce.activeEditor.selection.getNode()).before('<div id="add_custom_text_rect" style="position: absolute;left:' + left + 'px;top:' + top + 'px;">&nbsp;テキストを追加&nbsp;</div>');
            }

            // $(tinymce.activeEditor.selection.getNode()).before('<div class="add_custom_text" style="position: absolute;left:'+left+'px;top:'+top+'px;"><input type="text" value="add text"></div>');
            // $(tinymce.activeEditor.selection.getNode()).before('<div id="add_custom_text" style="position: absolute;left:'+left+'px;top:'+top+'px;">&nbsp;テキストを追加&nbsp;</div>');
            // $(tinymce.activeEditor.selection.getNode()).before('<div class="add_custom_text" style="position: absolute;left:'+left+'px;top:'+top+'px;width:'+image_width+'px;border:1px solid #ccc;height: auto;">&nbsp;テキストを追加&nbsp;</div>');


        }
    });

    $("#add_new_email_partner").click(function (event) {
        var partner_name = $("#new_partner_name").val();
        // var company = $("#new_partner_company").val();
        var company = '';
        var partner_mobile = $("#new_partner_mobile").val();
        // alert(partner_name1)
        // if (partner_name != " " && partner_mobile != " ") {
        if (partner_name != " " || partner_mobile != " ") {
            save_partner(2);
        }

    });

    $("#new_partner_registration_form_close").on('click', function (event) {
        event.preventDefault();
        $("#new_partner_registration_form").hide();
    });

    $("#print_word").click(function(event) {
        event.preventDefault();
        if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            $('[data-toggle="popover"]').popover('hide');
            tinymce.activeEditor.execCommand('mcePrint');
            window.scrollTo(0, 0);
        }else{
            $('[data-toggle="popover"]').popover('hide');
            tinymce.activeEditor.execCommand('mcePrint');
        }
    });

    // Screen Capture API
    const videoElem = document.getElementById("screenSharingVideo");
    const startElem = document.getElementById("startCapture");
    const stopElem = document.getElementById("videoSharingScreen_close");

    // Options for getDisplayMedia()

    var displayMediaOptions = {
        video: {
            cursor: ["motion", "always"]
        },
        audio: false,
    };
    // Set event listeners for the start and stop buttons
    startElem.addEventListener("click", function(evt) {
        evt.preventDefault();
        startCapture();
    }, false);

    stopElem.addEventListener("click", function(evt) {
        firstStopCapture();
    }, false);

    async function startCapture() {
        $("#word_image_selection_message").removeClass("show").addClass("hide");
        try {
            videoElem.srcObject = await navigator.mediaDevices.getDisplayMedia(displayMediaOptions);
            let tracks = videoElem.srcObject.getTracks();
            if (tracks.length>0) {
                $("#word_image_selection_message").removeClass("show").addClass("hide");
                $("#videoSharingScreen").removeClass("hide").addClass("show");
            }      
        } catch(err) {
            console.log(err);
            $(".btn_keipro").removeAttr("disabled");
            $("#videoSharingScreen").removeClass("show").addClass("hide");
            $("#word_image_selection_message").removeClass("hide").addClass("show");
            // console.error("Error: " + err);
        }
    }

    function firstStopCapture(evt) {
        $("#videoSharingScreen").removeClass("show").addClass("hide");
        $("#word_image_selection_message").removeClass("hide").addClass("show");
        let tracks = videoElem.srcObject.getTracks();

        tracks.forEach(track => track.stop());
        videoElem.srcObject = null;        
    }

    $("#videoImageInsert").click(function(event) {
        event.preventDefault();
        capture(event)
    });

    function capture(event) {  
        $("#screenSharingVideo").removeClass("show").addClass("hide");       
        $("#screenSharingCanvas").removeClass("hide").addClass("show");       
        var canvas = document.getElementById('screenSharingCanvas');     
        var video = document.getElementById('screenSharingVideo');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        // canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);  
        canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);  
        canvas.toBlob(function(blob) {
            var newImg = document.createElement('img');

            var img    = canvas.toDataURL("image/jpeg");

            newImg.src = img;
            tinymce.get('doc_content').focus();
            tinymce.execCommand('mceInsertContent', false, ' <img width="340" style="margin: 5px 10px; float:left; overflow: hidden !important;" data-attr-screen="screen_image" class="last_uploaded_image" align="middle" src="' + img + '"> ');
            stopCapture(event);

            $("#screenSharingVideo").removeClass("hide").addClass("show");       
            $("#screenSharingCanvas").removeClass("show").addClass("hide");
            // document.body.appendChild(newImg);
        });
        function stopCapture(evt) {

            $("#videoSharingScreen").removeClass("show").addClass("hide");
            // $("#word_image_selection_message").removeClass("hide").addClass("show");
            let tracks = videoElem.srcObject.getTracks();

            tracks.forEach(track => track.stop());
            videoElem.srcObject = null;        
        }
    }

    if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $("#startCapture").addClass('hide');
    }
    
});

