<?php
$td_bg_style = 'style="background-color: lightpink;"';
$start = $start_from == "" ? 0 : $start_from;
$x = 10;
$y = 20;
$total_data = $total_settlement_data;
for ($i = 0; $i < 10; $i++) { ?>
    <tr>
        <input type="hidden" id="total_settlement_data" value="<?= $total_data ?>">
        <td nowrap="nowrap"><?= $start + $i + 1; ?></td>
        <td nowrap="nowrap" width="30%"
            class="usersname">
            <?php

            if ($start + $i < $total_data) {
                echo "<input type='hidden' name='user_id' id='user_id' class='user_id' value='" . $user_settlement_data[$i]->id . "'>";
                // echo strip_tags($user_settlement_data[$i]->settlement_title);
                if ($user_settlement_data[$i]->name != '')
                    $name = $user_settlement_data[$i]->name;
                else
                    $name = $user_settlement_data[$i]->username;

                if ($start + $i + 1 == 1)
                    $self = '(自分)';
                else
                    $self = '';
                $user_name = trim($name);
                $user_name = preg_replace("/\s|&nbsp;|&nb/", '', $user_name);
                echo $user_name . $self;
            }
            ?>
        </td>
        <td nowrap="nowrap"><?= $start + $x + $i + 1; ?></td>
        <td nowrap="nowrap" width="30%"
            class="usersname">

            <?php
            if ($start + $x + $i < $total_data) {
                echo "<input type='hidden' name='user_id' id='user_id' class='user_id' value='" . $user_settlement_data[$x + $i]->id . "'>";
                if ($user_settlement_data[$x + $i]->name != '')
                    $name = $user_settlement_data[$x + $i]->name;
                else
                    $name = $user_settlement_data[$x + $i]->username;
                $user_name = trim($name);
                $user_name = preg_replace("/\s|&nbsp;|&nb/", '', $user_name);

                echo $user_name;
                // echo mb_substr(strip_tags($user_settlement_data[$x+$i]->post_details), 0, 10);
            }
            ?>
        </td>
        <td nowrap="nowrap"><?= $start + $y + $i + 1; ?></td>
        <td nowrap="nowrap" width="30%"
            class="usersname">
            <?php

            if ($start + $y + $i < $total_data) {

                echo "<input type='hidden' name='user_id' id='user_id' class='user_id' value='" . $user_settlement_data[$y + $i]->id . "'>";
                if ($user_settlement_data[$y + $i]->name != '')
                    $name = $user_settlement_data[$y + $i]->name;
                else
                    $name = $user_settlement_data[$y + $i]->username;
                $user_name = trim($name);
                $user_name = preg_replace("/\s|&nbsp;|&nb/", '', $user_name);

                echo $user_name;
                // echo mb_substr(strip_tags($user_settlement_data[$y+$i]->post_details), 0, 10);

            }
            ?>

        </td>
    </tr>

    <?php
}
?>