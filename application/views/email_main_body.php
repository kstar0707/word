
<div class="col-lg-10 col-md-10 col-sm-10" style="margin-bottom: 20px;">


    <span id="title-list-mail-0" style="color: green; font-weight: bold;">送受信</span><br>
    <span id="title-list-mail" style="color: green; font-weight: bold;"> <span id="email_inbox_title">直近順一覧</span> </span>   
    
    <button class="btn btn-success btn_keipro" style="display: none;" id="btn-filter">相手先</button>
    <button class="btn btn-success btn_keipro" id="most_uses">相手先別</button>
    <button class="btn btn-success btn_keipro" id="new_mail">新規</button>
    <button id="create_pertner" class="btn  btn-success btn_keipro">登録・共有</button>
    <button id="btn-drafts" class="btn btn-success btn_keipro">下書き</button>
    <button id="btn-zoom" class="btn btn-success btn_keipro">拡大</button>
    <button id="btn_delete_email" class="btn btn-warning btn_keipro">
        
        削除
    </button>
    
    <button id="email_close" class="btn btn-danger btn_keipro">戻る</button>
    
</div>  
<div style="margin-bottom: 20px;" class="col-lg-2 col-md-2 col-sm-2">   
    <br>       <br>   
     
    <button id="btn_introduce" class="btn btn-info pull-right btn_keipro">紹介</button>
</div>
<div class="container">
    
    <div class="row">
        <div class="col-md-12 hide" id="success_email_message">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                送信が完了しました
            </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 wrapper" style="padding: 0">
            
                
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
                        <table class="table table-hover" id="email_list"  >

                            <tr>
                                <th colspan="6">
                                    <center><img src="<?= base_url("resource/img/ajax/ajax_load_8.gif") ?>"></center>
                                </th>
                            </tr>                 

                        </table>
                    </div>
                    
                </div>
                
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="email_details">
                <div class="emal_header">
                    <?php               
                    if (!empty($user_emails)) {
                       $month = date('m', strtotime($user_emails[0]->created_at));
                       $email_date = date('d', strtotime($user_emails[0]->created_at));
                       $email_day = date('D', strtotime($user_emails[0]->created_at));
                       $email_time = date('h:i', strtotime($user_emails[0]->created_at));
                       $email_event = date('A', strtotime($user_emails[0]->created_at));
                       $am_pm = "";
                       if ($email_event=="PM") {
                           $am_pm = "午後";
                       }else{
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
                                <input type="hidden" name="reply_mail_id" id="reply_mail_id" value="<?= (!empty($user_emails))? $user_emails[0]->email_id:'' ?>">
                                <input type="hidden" name="reply_mail_mobile" id="reply_mail_mobile" value="<?= (!empty($user_emails))? $user_emails[0]->sender_mobile:'' ?>">
                                
                                <input type="hidden" name="reply_mail_subject" id="reply_mail_subject" value="<?= (!empty($user_emails))? $user_emails[0]->subject:'' ?>">
                                <span id="email_create_date">
                                    
                                </span>
                                
                            </p>
                        </div>
                        
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left: 0; padding-top: 10px;">
                            <i class="fa fa-file-text"></i> 
                            <span id="email_detail_subject">

                            </span>                                
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 hide" id="email_details_button_aria" style="padding: 0">

                            <!-- Edit Draft_mail -->
                            <button id="edit_draft_mail" type="button" class="btn btn-info pull-right hide btn_table">
                                <i class="fa fa-pencil-square-o"></i>
                                更新
                            </button>
                            <!-- Reply Mail -->
                            <button id="reply_mail" type="button" class="btn btn-warning pull-right show btn_table">
<!--                                <i class="fa fa-reply"></i>-->
                                返信・確認
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
                        <p class="email_content_detail" id="email_content_detail">

                        </p>                        
                    </div>                   
                    
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Email Navigation Message-->

<div class="col-lg-5 col-md-5 col-sm-5 col-xs-7 pull-right draggable_aria message_close_aria close_aria" id="email_navigation_message" style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">
    
    <div class="panel panel-info" style="margin-bottom: 2px; border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <!-- <h4><i style="color: #f1c40f" class="fa fa-warning"></i> </h4> -->
            <h4><i class="fa fa-info-circle"></i> 左の表から返信相手を選んでください。</h4>
             <p>
                 <button type="button" id="quick_new_email" style="" class="btn btn-success btn_keipro">新規</button>
                 ボタンから新規メールができます。
             </p>
             <p>
                 <button type="button" style="" class="btn btn-success btn_keipro">相手先 </button>
                 ボタンから相手先別に 送受信履歴が確認できます。
             </p>
        </div>
    </div>
</div>

<!-- Email email_delete_confirmation -->
<div class="pull-right hide draggable_aria" id="email_delete_confirmation_aria" style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">
    
    <div class="panel panel-danger" style="margin-bottom: 2px; border: solid 2px #e74c3c; border-top: solid 7px #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <h5>
                用件 ： <span id="delete_email_title"></span> のメールを削除しますか<i style="color: #e74c3c" class="fa fa-question"></i>
            </h5>
            <br>
            <center>
               <button type="button" id="email_delete_confirmation" class="btn btn-danger btn-sm">はい</button>
               <button type="button" id="cancel_email_delete_confirmation" class="btn btn-info btn-sm"><small style="font-size: 12px;">いいえ</small></button>

            </center>
        </div>
    </div>
</div>

<!-- delete_multiple_email_confirmation_aria -->

<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right hide draggable_aria close_aria" id="delete_multiple_email_confirmation_aria" style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">
    
    <div class="panel panel-danger" style="margin-bottom: 2px; border: solid 2px #e74c3c; border-top: solid 7px #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div class="panel-body">
            <h4>
                選択されたメールを削除しますか<i style="color: #e74c3c" class="fa fa-question"></i>
            </h4>
            <br>
            <center>
                <button type="button" id="delete_multiple_email_confirmation" class="btn btn-danger btn-sm">はい</button>
                <button type="button" id="cancel_delete_multiple_email_confirmation" class="btn btn-info btn-sm"><small style="font-size: 12px;">いいえ</small></button>
            </center>
        </div>
    </div>
</div>
