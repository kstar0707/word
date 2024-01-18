
<?php
    $total_partner = count($email_pertners);
    for ($i=0; $i <10 ; $i++) { 

    ?>  
    <tr>


        <td style="padding: 5px;"><?= $i+1; ?></td>
        <?php
        if (!empty($email_pertners[$i])) {?>
            <td><?= $email_pertners[$i]->partner_name.' / '.$email_pertners[$i]->company?></td>
            <td><?= $email_pertners[$i]->partner_mobile?></td>
        <?php
        }elseif ($total_partner==$i) {?>
            <form id="email_partner_form" action="javascript()" method="POST">
                
	                <td style="padding: 5px;">
	                	<div class="form-group" style="margin-bottom: 0">
		                    <input type="text" style="width: 50%; margin-right:1%; ime-mode:active" name="pertner_name" class="form-control input-sm pull-left has-error" id="partner_name" placeholder="お名前">
		                    <input type="text" style="width: 49%; ime-mode:active" class="form-control input-sm" name="pertner_company" id="company" placeholder="会社名">
		                </div>
	                </td>
	                <td style="padding: 5px; ime-mode:inactive" width="35%">
	                	<div class="form-group" style="margin-bottom: 0">
	                    	<input type="text" class="form-control input-sm" name="partner_mobile" id="partner_mobile" placeholder="電話番号">
	                    </div>
	                </td>
                
            </form>            
        <?php
        }else{?>
            <td style="padding: 5px;"></td>
            <td style="padding: 5px;" width="35%"></td>
        <?php
        }
        ?>
        
    </tr>
    <?php
    }
    ?>