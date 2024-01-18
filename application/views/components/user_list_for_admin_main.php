<style>
    .table_of_contantes .button_aria {
        margin-bottom: 10px;
        padding: 0;
    }

    .popup_button {
        height: 40px;
        margin: 0 15px 10px 0;
        padding: 6px;
        min-width: 80px;
        border-radius: 10px;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    #word_function_aria .btn {
    }

    .table_of_contantes .button_aria .btn {
    }

    /*Table of parter*/

    .table_of_partner {

        position: fixed;
        right: 20px;
        bottom: 2px;
        height: 570px !important;
        padding: 10px;
        border: 2px solid #ababab;
        border-top-left-radius: 0.5em;
        border-top-right-radius: 0.5em;
        background-color: #FFF;
    }

    .table_of_partner .table-bordered > tbody > tr > td {
        padding: 5px !important;
    }

    .btn_keipro1 {

        height: 40px;
        margin: 0 20px 10px 0;
        padding: 6px;
        min-width: 80px;
        border-radius: 10px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    .btn_popup {
        height: 40px;
        margin: 0 20px 10px 0;
        padding: 6px;
        min-width: 80px;
        border-radius: 10px;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    .btn_scpecial {
        height: 40px;
        margin: 0 20px 10px 0;
        padding: 6px;
        min-width: 80px;
        border-radius: 10px;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    .btn_table {
        height: 40px;
        margin: 0 20px 10px 0;
        padding: 6px;
        min-width: 80px;
        border-radius: 10px;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    /*.checked {*/
        /*background-color: #DDDDDF;*/
    /*}*/
</style>
<?php
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
    $height = '700px';
    $bottom = '150px';
} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) {//For Supporting IE 11
    $height = '700px';
    $bottom = '150px';
} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) {
    $height = '640px';
    $bottom = '70px';
} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE) {
    $height = '640px';
    $bottom = '70px';
} else {
    $height = '640px';
    $bottom = '70px';
}
?>

<div style="overflow:hidden;width:100%; height:<?php echo $height; ?>; right: 0px; bottom: 0px; position: fixed; padding: 10px; border: 2px solid #ababab; border-top-left-radius: 0.5em; border-top-right-radius: 0.5em; background-color: #FFF;"
     class="col-md-8 pull-right hide draggable_aria" id="view_settlement_letter_admin">


    <div style="padding: 0px;" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 title_aria">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding: 10px 0px">
            <strong><span class="span-title-list-files"
                          style="border: 0px red dashed; font-size: 20px; padding:0px 20px 0px 5px;"> </span>
        </div><!--直近順に表示-->
        <div style="padding: 0px; margin-top: 10px;" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <strong>
                <!--                <p>目次変更は文章を押し訂正します。</p>-->
            </strong>
        </div>

    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 button_aria">

        <!-- Contextual button for informational alert messages -->
        <button type="button" class="btn btn-danger btn_table pull-right" id="settlement_table_close_admin"> 戻る</button>
        <input value="ユーザー名：検索バー" class="btn btn-primary btn_table pull-right" type="text" name="search" id="search">
    </div>
    <div class="clearfix"></div>

    <div style="padding: 0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 word_table_content_scroll_prant">
        <div class="word_table_content_scroll_child">
            <table class="table table-bordered content_tale_rasponsive" id="settlement_list_admin"
                   style="font-size: 18px; color: #000;">

            </table>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>

<!--    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right hide draggable_aria" id="delete_confirm_alert"-->
<!--         style="position: fixed; right: 30px; bottom: 10px; padding: 4px; z-index: 9999">-->
<!---->
<!--        <div class="panel panel-warning"-->
<!--             style="margin-bottom: 2px; border: solid 2px #e74c3c; border-top: solid 7px #e74c3c; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">-->
<!--            <div class="panel-body">-->
<!--                <p style="font-size: 20px; font-weight: bold;">削除する文章: <span id="delete_settlement_title_show"></span>-->
<!--                </p>-->
<!--                <br>-->
<!--                <button style="margin-left: 0; box-shadow: none; border: none;" type="button" class="btn btn-danger"-->
<!--                        id="delete_confirm_settlement">削 除-->
<!--                </button>-->
<!--                <button type="button" class="btn btn-default" style="box-shadow: none; border: none;"-->
<!--                        id="delete_settlement_close">-->
<!--                    戻 る-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="col-md-3 col-sm-3 col-xs-4 pull-right hide draggable_aria close_aria" id="select_settlement"
         style="position: fixed; right: 30px; bottom: 10px; padding: 4px;">

        <div class="panel panel-warning"
             style="margin-bottom: 2px; border: solid 2px #f1c40f; border-top: solid 7px #f1c40f; box-shadow: 0 2px 6px rgba(0,0,0,0.2);text-align:center">
            <div class="panel-body">
                <h4><i style="color: #f1c40f" class="fa fa-warning"></i>目次を選択してください。</h4>
                <button id="close_settlement" class="btn btn-warning " style="box-shadow: none; border: none;">確認
                </button>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

</div>


