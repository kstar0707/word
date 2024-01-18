<style>
    .tooltip_main {
        position: relative;
        display: inline-block;
    }

    .tooltip_main .tooltiptext {
        visibility: hidden;
        width: 150px;
        background-color: lawngreen;
        color: #000;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        top: 80%;
        left: 75%;
        margin-left: -60px;
        margin-top: -105px;
    }

    .sharer_list {
        display: none;
        width: 18%;
        height: auto;
        background-color: #60DE72;
        color: #000;
        text-align: left;
        border-radius: 6px;
        padding: 5px 3px 50px 20px;
        position: absolute;
        z-index: 9999;
        /*top: 80%;*/
        /*left: 75%;*/
        margin-left: 60px;
        /*margin-top: -75px;*/
        /*overflow-y: scroll;*/
    }
    .active_btn{
        border: 2px solid red;
    }

    /*.table_settlement > tbody > tr:nth-child(even) {*/
    /*background: #D4ECF9; !*#C5E4F4*!*/
    /*}*/

    /*.table-bordered>tbody>tr:nth-child(even){*/
    /*background: green !important;*/
    /*}*/

    /*.tooltip_main .tooltiptext::after {*/
    /*content: "";*/
    /*position: absolute;*/
    /*bottom: 100%;*/
    /*left: 50%;*/
    /*margin-left: -5px;*/
    /*border-width: 5px;*/
    /*border-style: solid;*/
    /*border-color: transparent transparent black transparent;*/
    /*}*/

    .tooltip_main:hover .tooltiptext {
        visibility: visible;
    }

    /*.tooltip_main {*/
    /*!*position: relative;*!*/
    /*display: inline;*/
    /*}*/
    /*.tooltip-wrapper {*/
    /*position: absolute;*/
    /*visibility: hidden;*/
    /*}*/
    /*.tooltip_main:hover .tooltip-wrapper {*/
    /*visibility: visible;*/
    /*!*opacity: 0.7;*!*/
    /*!*top: 30px;*!*/
    /*!*left: 50%;*!*/
    /*!*margin-left: -76px;*!*/
    /*!* z-index: 999; defined above with value of 5 *!*/
    /*}*/

    /*.tooltiptext {*/
    /*display: block;*/
    /*position: relative;*/
    /*top: 2em;*/
    /*right: 100%;*/
    /*width: 150px;*/
    /*!*margin-left: -76px;*!*/
    /*color: #FFFFFF;*/
    /*background-color: lawngreen;*/
    /*padding: 5px 0;*/
    /*text-align: center;*/
    /*border-radius: 6px;*/
    /*}*/

</style>

<?php
function get_japanese_format_date($date_time)
{
    $month = date('m', strtotime($date_time));
    $email_date = date('d', strtotime($date_time));
    $email_day = date('D', strtotime($date_time));
    $email_time = date("H:i", strtotime($date_time));
//    $email_time = date('h:i', strtotime($date_time));
//    $email_event = date('A', strtotime($date_time));
//    $am_pm = "";
//    if ($email_event == "PM") {
//        $am_pm = "午後";
//    } else {
//        $am_pm = "午前";
//    }

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

//    $japan_date = $month . '月' . $email_date . '日(' . $jaDay . ')' . $email_time . $am_pm;
    $japan_date = $month . '月' . $email_date . '日(' . $jaDay . ')' . $email_time . "時";
    return $japan_date;
}

$td_bg_style = 'style="background-color: lightpink;"';
$get_td_bg_style = ' ';
$start = $start_from == "" ? 0 : $start_from;
$x = 10;
$y = 20;
$total_data = $total_settlement_data;
//echo "<pre>";
//print_r($receiver_list_from_email_by_sender_name);
if ($view_type == 4) {
    ?>
    <tr style="font-size: 14px;">
        <th width="17%" nowrap="true"><i class="fa fa-clock-o"></i> 日時</th>
        <th width="7%" nowrap="true"><i class="fa fa-user"></i> 氏名</th>
        <th width="2%" nowrap="true">&nbsp;</th>
        <th width="21%"><i class="fa fa-clipboard"></i> タイトル</th>
        <th style="background-color: #ddd; width: 1%"></th>

        <th width="17%" nowrap="true"><i class="fa fa-clock-o"></i> 日時</th>
        <th width="7%" nowrap="true"><i class="fa fa-user"></i> 氏名</th>
        <th width="2%" nowrap="true">&nbsp;</th>
        <th width="28%"><i class="fa fa-clipboard"></i> タイトル</th>
        <th style="background-color: #ddd; width: 1%"></th>

        <!--        <th width="15%" nowrap="true"><i class="fa fa-clock-o"></i> 日時</th>-->
        <!--        <th width="7%" nowrap="true"> <i class="fa fa-user"></i> 氏名</th>-->
        <!--        <th colspan="2" width="20%"><i class="fa fa-clipboard"></i> タイトル</th>-->
        <!--        <th style="background-color: #ddd;"></th>-->
    </tr>
    <tr id="1">
        <?php

        $i = 0;
        $j = 0;
        $k = -1;
        $color = '';
        foreach ($user_settlement_data as $users_settlement_data) {
            $i++;
            $j++;
            $k = $k + $j;

//            echo "<pre>";
//            print_r($all_decision_documents);
//                if($j==1 && $j==2){
//                    $color="#EBF7DD";
//                }else{
//                    $color="#FF0000";
//                }


            if ($users_settlement_data->president_seal_id != 0) {
                $get_td_bg_style = $td_bg_style;
            } else {
            }
            if ($j % 2 == 0) {
                if ($k % 2 == 0)
                    $color = '#EBF8C0';
                else
                    $color = '#FFFFFF';
            } else {
                if ($k % 2 == 0)
                    $color = '#D4ECF9';
                else
                    $color = '#FFFFFF';
            }
            ?>
            <input type="hidden" id="total_settlement_data" value="<?= $total_data ?>">
            <td bgcolor="<?php echo $color; ?>" width="17%"
                class="settlement_title checked_list_president" <?php echo $get_td_bg_style; ?> >
                <?php
                //                echo '<span style="color:blue; font-size: 14px;">(' . $j . ':' . $k . ')</span> '; //serial number
                echo "<input type='hidden' name='settlement_id' id='settlement_id' class='settlement_id' value='" . $users_settlement_data->settlement_id . "'>";
                echo "<input type='hidden' name='is_share' id='is_share' class='is_share' value='" . $users_settlement_data->is_share . "'>";
                echo "<input type='hidden' name='president_seal_id' id='president_seal_id' class='president_seal_id' value='" . $users_settlement_data->president_seal_id . "'>";
                if (isset($users_settlement_data->receiver_id))
                    echo $date = get_japanese_format_date($users_settlement_data->created_at);
                else
                    echo $date = get_japanese_format_date($users_settlement_data->created_at);
                ?>
            </td>
            <td bgcolor="<?php echo $color; ?>" width="7%"
                class="settlement_title checked_list_president" <?php echo $get_td_bg_style; ?> >
                <?php
                echo "<input type='hidden' name='settlement_id' id='settlement_id' class='settlement_id' value='" . $users_settlement_data->settlement_id . "'>";
                echo "<input type='hidden' name='is_share' id='is_share' class='is_share' value='" . $users_settlement_data->is_share . "'>";
                echo "<input type='hidden' name='president_seal_id' id='president_seal_id' class='president_seal_id' value='" . $users_settlement_data->president_seal_id . "'>";

                ?>
<!--                <span class="tooltip_main">-->
                <?php

                //                if (isset($users_settlement_data->receiver_name))
                //                    echo $users_settlement_data->receiver_name;
                //                else
                //                    echo '';
                //                if ($users_settlement_data->is_share == 1) {
                if ($this->session->userdata('account_id') == $users_settlement_data->created_by) {
                    $name1 = $name;
                    echo $name;
                } else {
//                        if($users_settlement_data->is_share==1){
                    if (isset($users_settlement_data->sender_name)) {
                        $name1 = $users_settlement_data->sender_name;
                        echo $users_settlement_data->sender_name;
                    } else {

                    }
//                        }

                }
                //                }
                ?>
<!--                </span>-->
            </td>
            <td width="5%">
                <span onclick="display_sharer_list(this.id,this,event);" id="<?php echo $j; ?>" style="font-size: 14px;padding: 4px 6px;" class="btn btn-success">共有</span>
                <div class="sharer_list" id="sharer_list_<?php echo $j; ?>">
                            <?php
                            echo '申請者 : ' . $name1 . '<br>';
                            //                            echo count($receiver_list_from_email_by_sender_names);
                            foreach ($receiver_list_from_email_by_sender_name as $receiver_list_from_email_by_sender_names) {

                                if ($users_settlement_data->settlement_id == $receiver_list_from_email_by_sender_names['settlement_id']) {
                                    if($receiver_list_from_email_by_sender_names['receiver_name']=='社長' || $receiver_list_from_email_by_sender_names['receiver_name']=='1010'){
                                        $sharer_title='決裁者';
                                    }else{
                                        $sharer_title='共有者';
                                    }
//                                    echo count($receiver_list_from_email_by_sender_names);
                                    echo $sharer_title.' : ' . $receiver_list_from_email_by_sender_names['receiver_name'] . '<br>';
                                }

                            }
                            ?>
                    </div>
            </td>
            <td bgcolor="<?php echo $color; ?>" width="21%" class="settlement_title" <?php echo $get_td_bg_style; ?> >

                <?php
                echo "<input type='hidden' name='settlement_id' id='settlement_id' class='settlement_id' value='" . $users_settlement_data->settlement_id . "'>";
                echo "<input type='hidden' name='is_share' id='is_share' class='is_share' value='" . $users_settlement_data->is_share . "'>";
                echo "<input type='hidden' name='president_seal_id' id='president_seal_id' class='president_seal_id' value='" . $users_settlement_data->president_seal_id . "'>";
                // echo strip_tags($user_settlement_data[$i]->settlement_title);
                $settlement_title = trim($users_settlement_data->settlement_title);
                //                if ($users_settlement_data->document_name != '') {
                ////                            $document_name = $user_settlement_data[$i]->document_name;
                //                    $document_name = '<i style="color: blue;" class="fa fa-paperclip"></i> ';
                //                } else {
                //                    $document_name = '';
                //                }



                if (in_array($users_settlement_data->settlement_id, explode(',',$all_decision_documents))) {
                    $document_name = '<i style="color: blue;" class="fa fa-paperclip"></i> ';
                } else {
                    $document_name = '';
                }

                $settlement_title = preg_replace("/\s|&nbsp;|&nb/", '', $settlement_title);
                if (mb_strlen($settlement_title) > 12) {
                    $settlement_title = mb_substr($settlement_title, 0, 12) . '...';
                } else {

                }

                echo '<div style="position:absolute; z-index:1; margin-left: 5px;">' . $document_name . $settlement_title . '</div>';

                ?>

                <?php if ($users_settlement_data->on_hold == 1) { ?>
                    <div class="hold_style">保</div>
                <?php } ?>
            </td>
            <td width="1%" style="background-color: #ddd;"></td>

            <?php

            if ($i == 2) { // 2 items in a row. Edit this to get more or less items on a row


                echo '</tr><tr id="' . $j . '" >';
                $i = 0;
            }

        }
        ?>
    </tr>

    <tr>
        <td colspan="10"></td>
    </tr>
    <?php
} // end first if
else {
    for ($i = 0; $i < 10; $i++) { ?>
        <tr>
            <input type="hidden" id="total_settlement_data" value="<?= $total_data ?>">
            <td nowrap="nowrap"><?= $start + $i + 1; ?></td>
            <td nowrap="nowrap" width="30%"
                class="settlement_title" <?php if ($start + $i < $total_data && $view_type == 4) {
                if ($user_settlement_data[$i]->president_seal_id != 0) {
                    echo $td_bg_style;
                } else {
                }
            } ?>>
                <?php

                if ($start + $i < $total_data) {
                    echo "<input type='hidden' name='settlement_id' id='settlement_id' class='settlement_id' value='" . $user_settlement_data[$i]->settlement_id . "'>";
                    echo "<input type='hidden' name='is_share' id='is_share' class='is_share' value='" . $user_settlement_data[$i]->is_share . "'>";
                    // echo strip_tags($user_settlement_data[$i]->settlement_title);
                    $settlement_title = trim($user_settlement_data[$i]->settlement_title);
//                    if ($user_settlement_data[$i]->document_name != '') {
////                            $document_name = $user_settlement_data[$i]->document_name;
//                        $document_name = '<i style="color: blue;" class="fa fa-paperclip"></i> ';
//                    } else {
//                        $document_name = '';
//                    }
                    if (in_array($user_settlement_data[$i]->settlement_id, explode(',',$all_decision_documents))) {
                        $document_name = '<i style="color: blue;" class="fa fa-paperclip"></i> ';
                    } else {
                        $document_name = '';
                    }
                    $settlement_title = preg_replace("/\s|&nbsp;|&nb/", '', $settlement_title);
                    if (mb_strlen($settlement_title) > 12) {
                        $settlement_title = mb_substr($settlement_title, 0, 12) . '...';
                    } else {

                    }
                    echo $document_name . $settlement_title;
                }
                ?>
            </td>
            <td nowrap="nowrap"><?= $start + $x + $i + 1; ?></td>
            <td nowrap="nowrap" width="30%"
                class="settlement_title" <?php if ($start + $x + $i < $total_data && $view_type == 4) {
                if ($user_settlement_data[$x + $i]->president_seal_id != 0) {
                    echo $td_bg_style;
                } else {
                }
            } ?>>

                <?php

                if ($start + $x + $i < $total_data) {
                    echo "<input type='hidden' name='settlement_id' id='settlement_id' class='settlement_id' value='" . $user_settlement_data[$x + $i]->settlement_id . "'>";
                    echo "<input type='hidden' name='is_share' id='is_share' class='is_share' value='" . $user_settlement_data[$x + $i]->is_share . "'>";
                    $se_title = trim($user_settlement_data[$x + $i]->settlement_title);
                    $se_title = preg_replace("/\s|&nbsp;|&nb/", '', $se_title);
//                    if ($user_settlement_data[$x + $i]->document_name != '') {
////                            $document_name = $user_settlement_data[$x+$i]->document_name;
//                        $document_name = '<i style="color: blue;" class="fa fa-paperclip"></i> ';
//                    } else {
//                        $document_name = '';
//                    }
                    if (in_array($user_settlement_data[$x + $i]->settlement_id, explode(',',$all_decision_documents))) {
                        $document_name = '<i style="color: blue;" class="fa fa-paperclip"></i> ';
                    } else {
                        $document_name = '';
                    }
                    echo $document_name . $se_title;
                    // echo mb_substr(strip_tags($user_settlement_data[$x+$i]->post_details), 0, 10);
                }
                ?>
            </td>
            <td nowrap="nowrap"><?= $start + $y + $i + 1; ?></td>
            <td nowrap="nowrap" width="30%"
                class="settlement_title" <?php if ($start + $y + $i < $total_data && $view_type == 4) {
                if ($user_settlement_data[$y + $i]->president_seal_id != 0) {
                    echo $td_bg_style;
                } else {
                }
            } ?>>
                <?php

                if ($start + $y + $i < $total_data) {

                    echo "<input type='hidden' name='settlement_id' id='settlement_id' class='settlement_id' value='" . $user_settlement_data[$y + $i]->settlement_id . "'>";
                    echo "<input type='hidden' name='is_share' id='is_share' class='is_share' value='" . $user_settlement_data[$y + $i]->is_share . "'>";
                    $last_title = trim($user_settlement_data[$y + $i]->settlement_title);
                    $last_title = preg_replace("/\s|&nbsp;|&nb/", '', $last_title);
//                    if ($user_settlement_data[$y + $i]->document_name != '') {
////                            $document_name = $user_settlement_data[$y+$i]->document_name;
//                        $document_name = '<i style="color: blue;" class="fa fa-paperclip"></i> ';
//                    } else {
//                        $document_name = '';
//                    }
                    if (in_array($user_settlement_data[$y + $i]->settlement_id, explode(',',$all_decision_documents))) {
                        $document_name = '<i style="color: blue;" class="fa fa-paperclip"></i> ';
                    } else {
                        $document_name = '';
                    }
                    echo $document_name . $last_title;
                    // echo mb_substr(strip_tags($user_settlement_data[$y+$i]->post_details), 0, 10);

                }
                ?>

            </td>
        </tr>

        <?php
    }
}
?>
