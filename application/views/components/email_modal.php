<div class="modal modal-fullscreen" id="emailSendingModal" tabindex="-1" role="dialog" aria-labelledby="emailSendingModal">
    <!--<div style="display: none; background-color: white; position:absolute; overflow: hidden; width: 100%; height: 100%; right: 0; bottom:0; left: 0; top: 0;"  id="emailSendingModal" >-->

    <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
        <div class="modal-content" style="padding-top: 10px;">

            <form class="form-horizontal" method="post" id="email_send_form">
                <input type="hidden" name="api_key" value="<?= base64_encode($this->config->item("api_key")) ?>" id="api_key">
                <input type="hidden" id="draft_value" value="1" name="draft_value">
                <input type="hidden" name="drft_email_id" value="" id="drft_email_id">
                <input type="hidden" id="user_id" value="<?= base64_encode($this->session->userdata('account_id')) ?>" name="user_id">
                <input type="hidden" id="base_url" value="<?= base_url() ?>" name="base_url">
                <fieldset>
                    <div class="modal-header">

                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 pull-right">
                            <span class="display_error" style="display: none;">
                                <p class="text-danger">An error ocoured</p>
                            </span>
                            <span class="ajax_email_load_aria hide" id="ajax_email_load_aria" style="">
                                <br>
                                <img src="<?= base_url("resource/img/ajax/ajax_load_8.gif") ?>">
                            </span>

                            <button type="button" id="btn-mail-0" class="btn btn-warning pull-right btn_table" data-dismiss="modal" aria-label="Close">戻る</button>
                            <!--                            <button type="button" id="new_email_close_button" class="btn btn-warning pull-right btn_table">戻る</button>-->
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                            <button type="button" id="btn-mail-images" class="btn btn-success pull-right btn_table"><i class="fa fa-paperclip"></i> 添付</button>
                            <button type="submit" id="send" class="btn btn-success pull-right btn_table">発信</button>
                            <button type="button" id="delete_draft_email" class="btn btn-warning pull-right btn_table"><i class="fa fa-trash"></i> 削除</button>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 pull-left">
                            <table width="100%" class="table" style="margin: 0">
                                <tr>
                                    <td width="15%" style="border: none;" nowrap="nowrap">
                                        <label class="control-label" for="name">相手先名</label>
                                    </td>
                                    <td width="35%" style="border: none;">
                                        <div class="">
                                            <input id="receiver_name" style="ime-mode:active" required="" name="name" autocomplete="off" type="text" placeholder="相手先名" class="form-control input-sm">

                                            <div id="suggesstion-box"></div>
                                        </div>
                                    </td>
                                    <td style="border: none;" nowrap="nowrap">
                                        <label class="control-label" for="mobile">携帯番号</label>
                                    </td>
                                    <td style="border: none;">
                                        <div class="">
                                            <input id="receiver_mobile" style="ime-mode:active" name="receiver_mobile" type="text" autocomplete="off" placeholder="携帯番号" class="form-control input-sm">
                                            <div id="mobile_suggesstion-box"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none;">
                                        <label class="control-label" for="subject">用件</label>
                                    </td>
                                    <td colspan="3" style="border: none;">
                                        <div class="">
                                            <input id="subject" name="subject" type="text" placeholder="書かなくてもOK"  style="ime-mode:active" class="col-lg-11 col-md-11 col-sm-10 col-xs-12 form-control input-sm">

                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="preloader_email" style="display:none; text-align:center;;"><img
                                src="<?php echo base_url(); ?>resource/img/ajax/ajax_load_9.gif"></div>
                    <div class="modal-body">

                        <dir class="col-lg-11 col-md-11 col-sm-10 col-xs-10" style="margin: 0">
                            <textarea class="form-control" id="email_content" name="email_content"></textarea>
                        </dir>
                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 pull-right">
                            <!-- Japanies -->

                            <button type="button" class="btn btn-success pull-right btn_keipro" id="email_undo" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="復元<br>誤って消去した文字を復元します。" data-placement="left" data-trigger="hover">復元</button>

                            <button type="button" id="" class="btn btn-success pull-right btn_keipro" role="button" data-toggle="popover" data-container="body" data-html="true" title="" data-content="拡大<br>全画面に拡大出来、2度押すと元に戻ります。" data-placement="left" data-trigger="hover">拡大</button>


                            <button type="button" class="btn btn-success pull-right btn_keipro" id="email_font_width" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="太字<br>黒塗りした文字を、太字に修飾します。" data-placement="left" data-trigger="hover">太 字</button>
                            <button type="button" class="btn btn-success pull-right btn_keipro" id="email_font_family" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="書体<br>明朝体・・・などの書体を変更します。
        " data-placement="left" data-trigger="hover">書 体</button>
                            <button type="button" class="btn btn-success pull-right btn_keipro" id="email_font_size" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="サイズ<br>黒塗りした文字を、文字の大きさを拡大・縮小します。
        " data-placement="left" data-trigger="hover">サイズ</button>


                            <button  type="button" class="btn btn-success pull-right btn_keipro"  data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="表計算<br>。。。。。" data-placement="left" data-trigger="hover">表計算</button>

                            <button type="button" id="btn-mail-images" class="btn btn-success pull-right btn_keipro">挿し絵</button>
                            <button type="button" class="btn btn-success pull-right btn_keipro" id="email_function" data-html="true" role="button" data-toggle="popover" data-container="body" title="" data-content="機能<br>多くの機能があり、選択して使用します。ご確認ください。
        " data-placement="left" data-trigger="hover">機能</button>
                            <a href="<?= base_url('index.php/account/sign_out') ?>"  data-html="true" class="btn btn-success pull-right  btn_keipro" role="button" data-toggle="popover" data-container="body" title="" data-content="終了<br>全てを終了します。自動保存で安心です。" data-placement="left" data-trigger="hover">終了</a>
                        </div>
                    </div>
                </fieldset>
            </form>
            <div class="col-md-2 col-sm-3 col-xs-12 pull-right hide draggable_aria" id="email_font_family_aria" style="position: fixed; right: 0px; bottom: 0px; padding: 4px;">

                <div class="panel panel-info" style="margin-bottom: 2px; border: 2px solid #eee;">
                    <div class="panel-body">
                        <button type="button" class="btn btn-info pull-right btn_popup" id="email_close_family_aria">戻る</button>
                        <table class="table table-bordered" style="margin-bottom: 0;">
                            <tr>
                                <td id="email_font_1" onclick="email_change_font_family('ms mincho, ｍｓ 明朝')" class="checked">ＭＳ明朝</td>
                            </tr>
                            <tr>
                                <td id="email_font_2" onclick="email_change_font_family('ms gothic, ｍｓ ゴシック')" class="">ＭＳ ゴシック</td>
                            </tr>
                            <tr>
                                <td id="email_font_3" onclick="email_change_font_family('hg行書体,hgp行書体,cursive')" class="">HG 行書体</td>
                            </tr>
                            <tr>
                                <td id="email_font_4" onclick="email_change_font_family('hg丸ｺﾞｼｯｸm-pro,hg正楷書体-pro,ms ui gothic')" class="">HG丸ｺﾞｼｯｸM-PRO</td>
                            </tr>
                            <tr>
                                <td id="email_font_5" onclick="email_change_font_family('hgp創英角ﾎﾟｯﾌﾟ体,hg創英角ﾎﾟｯﾌﾟ体')" class="">HGS創英角ﾎﾟｯﾌﾟ体</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Email Font Size -->
            <div class="col-md-2 col-sm-2 col-xs-12 pull-right hide draggable_aria" id="email_font_size_aria" style="position: fixed; right: 0px; bottom: 0px; padding: 4px;">

                <div class="panel panel-info" style="margin-bottom: 2px; border: 2px solid #eee;">
                    <div class="panel-body">
                        <button type="button" class="btn btn-info pull-right btn_popup" id="email_close_font_size_aria">戻る</button>
                        <table class="table table-bordered" id="font-size-popup-table" style="margin: 0;">
                            <input type="hidden" id="email_font_size_mapping" value="0" name="font_size_mapping">
                            <input type="hidden" id="email_font_size_number_mapping" value="16px" name="font_size_number_mapping">
                            <tr>
                                <td onclick="email_change_font_size('10.666667px',8)" class="email_font_size" id="email_font_size_8">8</td>
                                <td onclick="email_change_font_size('13.333333px',10)" class="email_font_size" id="email_font_size_10">10</td>
                                <td onclick="email_change_font_size('16px',12)" class="email_font_size checked" id="email_font_size_12">12</td>
                            </tr>
                            <tr>
                                <td onclick="email_change_font_size('18.666667px',14)" class="email_font_size" id="email_font_size_14">14</td>
                                <td onclick="email_change_font_size('21.333333px',16)" class="email_font_size" id="email_font_size_16">16</td>
                                <td onclick="email_change_font_size('24px',18)" class="email_font_size" id="email_font_size_18">18</td>
                            </tr>
                            <tr>
                                <td onclick="email_change_font_size('26.666667px',20)" class="email_font_size" id="email_font_size_20">20</td>
                                <td onclick="email_change_font_size('29.333333px',22)" class="email_font_size" id="email_font_size_22">22</td>
                                <td onclick="email_change_font_size('32px',24)" class="email_font_size" id="email_font_size_24">24</td>
                            </tr>
                            <tr>
                                <td onclick="email_change_font_size('34.666667px',26)" class="email_font_size" id="email_font_size_26">26</td>
                                <td onclick="email_change_font_size('37.333333px',28)" class="email_font_size" id="email_font_size_28">28</td>
                                <td onclick="email_change_font_size('40px',30)" class="email_font_size" id="email_font_size_30">30</td>
                            </tr>
                            <tr>
                                <td onclick="email_change_font_size('42.666667px',32)" class="email_font_size" id="email_font_size_32">32</td>
                                <td onclick="email_change_font_size('45.333333px',34)" class="email_font_size" id="email_font_size_34">34</td>
                                <td onclick="email_change_font_size('48px',36)" class="email_font_size" id="email_font_size_36">36</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Email Function Aria -->
            <div class="col-md-4 col-sm-4 col-xs-12 pull-right hide draggable_aria" id="email_function_aria" style="position: fixed; right: 0px; bottom: 0px; padding: 4px;">

                <div class="panel panel-info" style="margin-bottom: 2px; border: 2px solid #eee;">
                    <div class="col-md-12" style="background-color: #FFFFFF; padding: 5px">
                        <button type="button" id="email_close_function_aria" class="btn btn-warning pull-right popup_button" id="close-app" title="戻る">戻る</button>
                    </div>
                    <div class="col-md-12 panel-body">
                        <button class="btn btn-info popup_button" id="btn-note-cut">絵・図</button>
                        <button type="button" onclick="word_special_cherecter()" class="btn btn-info popup_button" title="記号">記号</button>
                        <button class="btn btn-info popup_button" onclick="word_cut()" id="btn-note-cut">移 動</button>
                        <button class="btn btn-info popup_button" onclick="word_copy()" id="btn-note-copy">複 写</button>

                        <!-- <button id="" type="button" class="btn btn-info" title="辞書">辞書</button> -->
                        <button type="button" class="btn btn-info popup_button" title="文例">文例</button>
                        <button type="button" class="btn btn-info popup_button" id="email_color" title="カラー">カラー</button>

                        <button type="button" onclick="find_replace()" class="btn btn-info popup_button" title="見出">見出</button>
                        <button type="button" id="print_word" class="btn btn-info popup_button" title="印刷">印刷</button>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <!-- Font Color Aria -->
            <div class="col-md-2 col-sm-2 col-xs-3 pull-right hide draggable_aria close_aria" id="email_font_color_aria" style="position: fixed; right: 0px; bottom: 0px; padding: 4px;">

                <div class="panel panel-info" style="margin-bottom: 2px; border: 2px solid #eee;">
                    <div class="panel-body">
                        <button type="button" onclick="return_close()" class="btn btn-info pull-right btn_popup" id="close_font_color_aria">戻る</button>
                        <table class="table table-bordered">
                            <tr>
                                <td onclick="email_font_color('#000000')" style="background-color: #000000; width: 60px; height: 60px; border: 5px solid #fff;"></td>
                                <td onclick="email_font_color('#FF0000')" style="background-color: #FF0000; width: 60px; height: 60px; border: 5px solid #fff;"></td>
                                <td onclick="email_font_color('#0000FF')" style="background-color: #0000FF; width: 60px; height: 60px; border: 5px solid #fff;"></td>
                            </tr>
                            <tr>
                                <td onclick="email_font_color('#00FF00')" style="background-color: #00FF00; width: 60px; height: 60px; border: 5px solid #fff;"></td>
                                <td onclick="email_font_color('#00CC99')" style="background-color: #00CC99; width: 60px; height: 60px; border: 5px solid #fff;"></td>
                                <td onclick="email_font_color('#8B4513')" style="background-color: #8B4513; width: 60px; height: 60px; border: 5px solid #fff;"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Image Selection message -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 pull-right hide draggable_aria" id="image_selection_message" style="position: fixed; right: 210px; bottom: 5px; padding: 4px;">

                <div class="panel panel-warning" style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                    <div class="panel-body">
                        <div class="col-md-12" style="padding: 0">
                            <p class="pull-left" style="font-size: 18px;">
                                何を挿入しますか？
                            </p>
                            <button style="margin-left: 2px;" id="close_email_image_selection" class="btn btn-default pull-right btn_popup">戻る</button>
                        </div>
                        <div class="col-md-12" style="padding: 0">
                            <form method="post" id="email_image_upload_form" enctype="multipart/form-data" action="#">
                                <input type="hidden" name="uploaded_file_name" id="uploaded_file_name" value="">
                                <input type="hidden" name="email_image_width" id="email_image_width" value="400">
                                <input type="file" name="email_imgupload" id="email_imgupload" style="display:none"/>
                                <button class="btn btn-success btn-sm pull-left" id="email_upload_image" style="margin-left: 0" title="写真・画像">写真・画像</button>

                            </form>

                            <button class="btn btn-success btn-sm pull-right btn_popup" id="upload_pdf" title="エクセル">エクセル</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cursor Confermation -->

            <!-- start partner is not registered error message -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 hide pull-right email_invalid_partner_error_message close_aria"
                 id="email_invalid_partner_error_message" style="position: fixed; right: 210px; bottom: 10px; padding: 4px;">

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

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 pull-right hide draggable_aria" id="image_past_message" style="position: fixed; right: 210px; bottom: 5px; padding: 4px;">

                <div class="panel panel-warning" style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                    <div class="panel-body">
                        <p style="font-size: 18px;">
                            どこに貼り付けますか？ <br>
                            カーソルで指定し、位置を決めて下さい。
                        </p>
                        <button class="btn btn-success btn_popup" id="cursor_ok" title="位置決定">位置決定</button>
                        <button class="btn btn-success btn_popup" id="cursor_colse" title=" 戻る"> 戻る</button>
                    </div>
                </div>
            </div>
            <!-- Image Past Confirmation -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 pull-right hide draggable_aria" id="image_past_confirmation" style="position: fixed; right: 210px; bottom: 5px; padding: 4px;">

                <div class="panel panel-warning" style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                    <div class="panel-body">
                        <p style="font-size: 18px;">
                            この場所にしますか？ <br>
                        </p>
                        <button class="btn btn-success btn_popup" id="image_paste_ok" title="はい">はい</button>
                        <button class="btn btn-success btn_popup" id="image_paste_close" title="いいえ"> いいえ</button>
                    </div>
                </div>
            </div>

            <!-- Image Zoom -->
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 pull-right hide draggable_aria" id="image_zooming" style="position: fixed; right: 210px; bottom: 5px; padding: 4px;">

                <div class="panel panel-warning" style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                    <div class="panel-body">
                        <div class="col-md-12" style="padding: 0">
                            <p class="pull-left" style="font-size: 18px;">
                                サイズを選んで下さい。
                            </p>
                            <button id="image_zooming_close" style="margin-left: 2px;" class="btn btn-default pull-right btn_popup">戻る</button>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button style="margin-left: 0px;" class="btn btn-success btn_popup" id="image_zoom_btn" title="拡大"><i class="fa fa-search-plus"></i> 拡大</button>
                            <button style="margin-left: 10px;" class="btn btn-success btn_popup" id="image_small_btn" title="縮小"><i class="fa fa-search-minus"></i> 縮小</button>
                            <button style="margin-left: 10px;" class="btn btn-success btn_popup" id="image_width_completed" title="完了"> 完了</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Image Upload Completed -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pull-right hide draggable_aria close_aria" id="image_upload_completed" style="position: fixed; right: 210px; bottom: 5px; padding: 4px;">

                <div class="panel panel-warning" style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                    <div class="panel-body">
                        <div class="col-md-12" style="padding: 0">
                            <p class="pull-left" style="font-size: 18px;">
                                貼り付けが完了しました。
                            </p>
                            <button id="image_upload_completed_close" style="margin-left: 2px;" class="btn btn-default pull-right btn_popup" autofocus="true" title="確認">確認</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
