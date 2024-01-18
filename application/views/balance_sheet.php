<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title><?php echo isset($title) ? $title : ""; ?></title>

    <meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=.5, maximum-scale=1, minimum-scale=.1, user-scalable=no" />


    <base href="<?php echo base_url(); ?>"/>

    <!-- <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.png"/> -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/dist/css/bootstrap.min.css'); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/dist/css/bootstrap-theme.min.css'); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/css/font-awesome.min.css'); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/css/custom.css'); ?>"/>
    <link rel="stylesheet" href="resource/css/jquery-confirm.min.css">
    <script src="<?php echo base_url('resource/js/jquery.min.js'); ?>"></script>

    <script src="<?php echo base_url('resource/dist/js/bootstrap.min.js'); ?>"></script>

    <script>
        function removeChar(item)
        {
            var val = item.value;
            //alert(val)
            val = val.replace(/[^0-9]/g, "");
            if (val == ' '){val = ''};
            item.value=val;
        }

        function totalAdd(name) {
            if(name==='amount_a_col1'){
                var arr = document.getElementsByName('amount_a_col1');
            }
            if(name==='amount_a_col2'){
                var arr = document.getElementsByName('amount_a_col2');
            }
            if(name==='amount_a_col3'){
                var arr = document.getElementsByName('amount_a_col3');
            }
            if(name==='amount_a_col4'){
                var arr = document.getElementsByName('amount_a_col4');
            }
            if(name==='amount_a_col5'){
                var arr = document.getElementsByName('amount_a_col5');
            }
            if(name==='amount_a_col6'){
                var arr = document.getElementsByName('amount_a_col6');
            }
            var tot=0;
            for(var i=0;i<arr.length;i++){
                if(parseInt(arr[i].value))
                    tot += parseInt(arr[i].value);
            }
//            alert(tot);
            if(name==='amount_a_col1') {
                var subtotal_of_c = tot - document.getElementById('subtotal_of_b').value;
                document.getElementById('subtotal_of_1').value = tot;
                document.getElementById('subtotal_of_c').value = subtotal_of_c;
            }
            if(name==='amount_a_col2') {
                var subtotal_of_c = tot - document.getElementById('subtotal_of_b_col2').value;
                document.getElementById('subtotal_of_2').value = tot;
                document.getElementById('subtotal_of_c_col2').value = subtotal_of_c;
            }
            if(name==='amount_a_col3') {
                var subtotal_of_c = tot - document.getElementById('subtotal_of_b_col3').value;
                document.getElementById('subtotal_of_3').value = tot;
                document.getElementById('subtotal_of_c_col3').value = subtotal_of_c;
            }
            if(name==='amount_a_col4') {
                var subtotal_of_c = tot - document.getElementById('subtotal_of_b_col4').value;
                document.getElementById('subtotal_of_4').value = tot;
                document.getElementById('subtotal_of_c_col4').value = subtotal_of_c;
            }
            if(name==='amount_a_col5') {
                var subtotal_of_c = tot - document.getElementById('subtotal_of_b_col5').value;
                document.getElementById('subtotal_of_5').value = tot;
                document.getElementById('subtotal_of_c_col5').value = subtotal_of_c;
            }
            if(name==='amount_a_col6') {
                var subtotal_of_c = tot - document.getElementById('subtotal_of_b_col6').value;
                document.getElementById('subtotal_of_6').value = tot;
                document.getElementById('subtotal_of_c_col6').value = subtotal_of_c;
            }
        }

        function totalAdd_D(name) {
//            alert(name);
            if(name==='amount_d_col1'){
                var arr = document.getElementsByName('amount_d_col1');
            }
            if(name==='amount_d_col2'){
                var arr = document.getElementsByName('amount_d_col2');
            }
            if(name==='amount_d_col3'){
                var arr = document.getElementsByName('amount_d_col3');
            }
            if(name==='amount_d_col4'){
                var arr = document.getElementsByName('amount_d_col4');
            }
            if(name==='amount_d_col5'){
                var arr = document.getElementsByName('amount_d_col5');
            }
            if(name==='amount_d_col6'){
                var arr = document.getElementsByName('amount_d_col6');
            }

            var tot=0;
            for(var i=0;i<arr.length;i++){
                if(parseInt(arr[i].value))
                    tot += parseInt(arr[i].value);
            }
//            alert(tot);
            if(name==='amount_d_col1') {
                console.log($('#subtotal_of_c').val());
                var subtotal_of_e = document.getElementById('subtotal_of_c').value - tot; //e=c-d
                document.getElementById('subtotal_of_d_col1').value = tot; //d
                document.getElementById('subtraction_of_d_col1').value = subtotal_of_e; //e
                document.getElementById('income_of_d_col1').value = document.getElementById('subtotal_of_1').value; // f; a=f
                document.getElementById('expenditure_of_d_col1').value = tot; // g; g=d
                var subtraction_of_h = document.getElementById('income_of_d_col1').value - document.getElementById('expenditure_of_d_col1').value; // h=f-g
                document.getElementById('subtractionE_of_d_col1').value = subtraction_of_h; // h
                var subtotal_of_i = subtotal_of_e - subtraction_of_h; // i=e-h
                document.getElementById('total_of_d_col1').value = subtotal_of_i;
            }

            if(name==='amount_d_col2') {
                var subtotal_of_e = document.getElementById('subtotal_of_c_col2').value - tot; //e=c-d
                document.getElementById('subtotal_of_d_col2').value = tot; //d
                document.getElementById('subtraction_of_d_col2').value = subtotal_of_e; //e
                document.getElementById('income_of_d_col2').value = document.getElementById('subtotal_of_2').value; // f; a=f
                document.getElementById('expenditure_of_d_col2').value = tot; // g; g=d
                var subtraction_of_h = document.getElementById('income_of_d_col2').value - document.getElementById('expenditure_of_d_col2').value; // h=f-g
                document.getElementById('subtractionE_of_d_col2').value = subtraction_of_h; // h
                var subtotal_of_i = subtotal_of_e - subtraction_of_h; // i=e-h
                document.getElementById('total_of_d_col2').value = subtotal_of_i;
            }

            if(name==='amount_d_col3') {
                var subtotal_of_e = document.getElementById('subtotal_of_c_col3').value - tot; //e=c-d
                document.getElementById('subtotal_of_d_col3').value = tot; //d
                document.getElementById('subtraction_of_d_col3').value = subtotal_of_e; //e
                document.getElementById('income_of_d_col3').value = document.getElementById('subtotal_of_3').value; // f; a=f
                document.getElementById('expenditure_of_d_col3').value = tot; // g; g=d
                var subtraction_of_h = document.getElementById('income_of_d_col3').value - document.getElementById('expenditure_of_d_col3').value; // h=f-g
                document.getElementById('subtractionE_of_d_col3').value = subtraction_of_h; // h
                var subtotal_of_i = subtotal_of_e - subtraction_of_h; // i=e-h
                document.getElementById('total_of_d_col3').value = subtotal_of_i;
            }

            if(name==='amount_d_col4') {
                var subtotal_of_e = document.getElementById('subtotal_of_c_col4').value - tot; //e=c-d
                document.getElementById('subtotal_of_d_col4').value = tot; //d
                document.getElementById('subtraction_of_d_col4').value = subtotal_of_e; //e
                document.getElementById('income_of_d_col4').value = document.getElementById('subtotal_of_4').value; // f; a=f
                document.getElementById('expenditure_of_d_col4').value = tot; // g; g=d
                var subtraction_of_h = document.getElementById('income_of_d_col4').value - document.getElementById('expenditure_of_d_col4').value; // h=f-g
                document.getElementById('subtractionE_of_d_col4').value = subtraction_of_h; // h
                var subtotal_of_i = subtotal_of_e - subtraction_of_h; // i=e-h
                document.getElementById('total_of_d_col4').value = subtotal_of_i;
            }
            if(name==='amount_d_col5') {
                var subtotal_of_e = document.getElementById('subtotal_of_c_col5').value - tot; //e=c-d
                document.getElementById('subtotal_of_d_col5').value = tot; //d
                document.getElementById('subtraction_of_d_col5').value = subtotal_of_e; //e
                document.getElementById('income_of_d_col5').value = document.getElementById('subtotal_of_5').value; // f; a=f
                document.getElementById('expenditure_of_d_col5').value = tot; // g; g=d
                var subtraction_of_h = document.getElementById('income_of_d_col5').value - document.getElementById('expenditure_of_d_col5').value; // h=f-g
                document.getElementById('subtractionE_of_d_col5').value = subtraction_of_h; // h
                var subtotal_of_i = subtotal_of_e - subtraction_of_h; // i=e-h
                document.getElementById('total_of_d_col5').value = subtotal_of_i;
            }

            if(name==='amount_d_col6') {
                var subtotal_of_e = document.getElementById('subtotal_of_c_col6').value - tot; //e=c-d
                document.getElementById('subtotal_of_d_col6').value = tot; //d
                document.getElementById('subtraction_of_d_col6').value = subtotal_of_e; //e
                document.getElementById('income_of_d_col6').value = document.getElementById('subtotal_of_6').value; // f; a=f
                document.getElementById('expenditure_of_d_col6').value = tot; // g; g=d
                var subtraction_of_h = document.getElementById('income_of_d_col6').value - document.getElementById('expenditure_of_d_col6').value; // h=f-g
                document.getElementById('subtractionE_of_d_col6').value = subtraction_of_h; // h
                var subtotal_of_i = subtotal_of_e - subtraction_of_h; // i=e-h
                document.getElementById('total_of_d_col6').value = subtotal_of_i;
            }
        }
    </script>
</head>
<body> 
    <div class="container-fluid" style="background-color: #ffffff;">
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-6">
                <h3 style="margin-top: 10px;">表計算<small>（損益表）</small></h3> 
            </div>
            <div class="col-md-6">
                 <span class="pull-right" style="padding: 10px;"><strong>: 円</strong></span>
                <button type="button" id="" class="btn btn-default pull-right btn_table">単位</button>

                <button type="button" id="btn-mail-0" class="btn btn-warning pull-right btn_table" onClick="javascript: setTimeout(window.close, 10);" aria-label="Close">戻る</button>
                
                <button type="button" id="delete_income_sheet" class="btn btn-danger pull-right btn_table"> 削除</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-bordered income-talbe" id="" style="margin-top: 0;">
                     <thead>
                         <tr>
                             <th style="width: 15px; vertical-align: middle; font-size: 16px;"></th>
                             <th nowrap>科目</th>
                             <?php
                             for ($i=1; $i <=6; $i++) { ?>
                             
                             <th><?= $i; ?></th>
                             <?php
                             }
                             ?>
                             <th width="10%" nowrap>備考</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <th rowspan="8" nowrap  style="width: 20px; padding: 15px; vertical-align: middle; font-size: 16px;">a 増 <br> 加 <!-- （ 収 入 ） --> </th>
                             <td><input type="text" id="ahsannnnn" name="" value="Ahsan"></td>
                             <td><input type="text" id="row1_col1" name="amount_a_col1" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row1_col2" name="amount_a_col2" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row1_col3" name="amount_a_col3" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row1_col4" name="amount_a_col4" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row1_col5" name="amount_a_col5" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row1_col6" name="amount_a_col6" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="row2_col1" name="amount_a_col1" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row2_col2" name="amount_a_col2" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row2_col3" name="amount_a_col3" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row2_col4" name="amount_a_col4" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row2_col5" name="amount_a_col5" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row2_col6" name="amount_a_col6" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="row3_col1" name="amount_a_col1" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row3_col2" name="amount_a_col2" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row3_col3" name="amount_a_col3" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row3_col4" name="amount_a_col4" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row3_col5" name="amount_a_col5" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row3_col6" name="amount_a_col6" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="row4_col1" name="amount_a_col1" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row4_col2" name="amount_a_col2" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row4_col3" name="amount_a_col3" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row4_col4" name="amount_a_col4" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row4_col5" name="amount_a_col5" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row4_col6" name="amount_a_col6" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="row5_col1" name="amount_a_col1" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row5_col2" name="amount_a_col2" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row5_col3" name="amount_a_col3" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row5_col4" name="amount_a_col4" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row5_col5" name="amount_a_col5" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row5_col6" name="amount_a_col6" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="row6_col1" name="amount_a_col1" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row6_col2" name="amount_a_col2" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row6_col3" name="amount_a_col3" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row6_col4" name="amount_a_col4" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row6_col5" name="amount_a_col5" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row6_col6" name="amount_a_col6" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="row7_col1" name="amount_a_col1" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row7_col2" name="amount_a_col2" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row7_col3" name="amount_a_col3" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row7_col4" name="amount_a_col4" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row7_col5" name="amount_a_col5" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="row7_col6" name="amount_a_col6" onblur="totalAdd(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <th style="text-align: center;">小計 a</th>
                             <th><input type="text" name="subtotal_of_1" id="subtotal_of_1" readonly="true"/><span id=""></span></th>
                             <th><input type="text" name="subtotal_of_2" id="subtotal_of_2" readonly="true"/><span id=""></span></th>
                             <th><input type="text" name="subtotal_of_3" id="subtotal_of_3" readonly="true"/><span id=""></span></th>
                             <th><input type="text" name="subtotal_of_4" id="subtotal_of_4" readonly="true"/><span id=""></span></th>
                             <th><input type="text" name="subtotal_of_5" id="subtotal_of_5" readonly="true"/><span id=""></span></th>
                             <th><input type="text" name="subtotal_of_6" id="subtotal_of_6" readonly="true"/><span id=""></span></th>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <th></th>
                             <th style="text-align: center;">原価 b</th>
                             <th><input type="text" id="subtotal_of_b" name="subtotal_of_b" value="200" onblur="totalAdd();" onKeyUp="removeChar(this);"></th>
                             <th><input type="text" id="subtotal_of_b_col2" name="subtotal_of_b_col2" value="200" onblur="totalAdd();" onKeyUp="removeChar(this);"></th>
                             <th><input type="text" id="subtotal_of_b_col3" name="subtotal_of_b_col3" value="200" onblur="totalAdd();" onKeyUp="removeChar(this);"></th>
                             <th><input type="text" id="subtotal_of_b_col4" name="subtotal_of_b_col4" value="200" onblur="totalAdd();" onKeyUp="removeChar(this);"></th>
                             <th><input type="text" id="subtotal_of_b_col5" name="subtotal_of_b_col5" value="200" onblur="totalAdd();" onKeyUp="removeChar(this);"></th>
                             <th><input type="text" id="subtotal_of_b_col6" name="subtotal_of_b_col6" value="200" onblur="totalAdd();" onKeyUp="removeChar(this);"></th>
                             <td></td>
                         </tr>
                         <tr>
                             <th></th>
                             <th style="text-align: center;">粗利 c=a-b</th>
                             <th><input type="text" id="subtotal_of_c" name="subtotal_of_c" readonly="true"></th>
                             <th><input type="text" id="subtotal_of_c_col2" name="subtotal_of_c_col2" readonly="true"></th>
                             <th><input type="text" id="subtotal_of_c_col3" name="subtotal_of_c_col3" readonly="true"></th>
                             <th><input type="text" id="subtotal_of_c_col4" name="subtotal_of_c_col4" readonly="true"></th>
                             <th><input type="text" id="subtotal_of_c_col5" name="subtotal_of_c_col5" readonly="true"></th>
                             <th><input type="text" id="subtotal_of_c_col6" name="subtotal_of_c_col6" readonly="true"></th>
                             <td></td>
                         </tr>

                         <tr>
                             <th colspan="7"></th>
                             <td colspan="2"></td>

                         </tr>

                         <tr>
                             <th rowspan="8" nowrap style="width: 15px; vertical-align: middle; font-size: 16px;">d 減 <br> 少 <!-- （経費） --> </th>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="amount_d_row1_col1" name="amount_d_col1" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row1_col2" name="amount_d_col2" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row1_col3" name="amount_d_col3" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row1_col4" name="amount_d_col4" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row1_col5" name="amount_d_col5" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row1_col6" name="amount_d_col6" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="amount_d_row2_col1" name="amount_d_col1" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row2_col2" name="amount_d_col2" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row2_col3" name="amount_d_col3" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row2_col4" name="amount_d_col4" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row2_col5" name="amount_d_col5" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row2_col6" name="amount_d_col6" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="amount_d_row3_col1" name="amount_d_col1" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row3_col2" name="amount_d_col2" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row3_col3" name="amount_d_col3" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row3_col4" name="amount_d_col4" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row3_col5" name="amount_d_col5" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row3_col6" name="amount_d_col6" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="amount_d_row4_col1" name="amount_d_col1" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row4_col2" name="amount_d_col2" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row4_col3" name="amount_d_col3" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row4_col4" name="amount_d_col4" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row4_col5" name="amount_d_col5" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row4_col6" name="amount_d_col6" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="amount_d_row5_col1" name="amount_d_col1" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row5_col2" name="amount_d_col2" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row5_col3" name="amount_d_col3" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row5_col4" name="amount_d_col4" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row5_col5" name="amount_d_col5" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row5_col6" name="amount_d_col6" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>
                         <tr>
                             <td><input type="text" id="" name="" value=""></td>
                             <td><input type="text" id="amount_d_row6_col1" name="amount_d_col1" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row6_col2" name="amount_d_col2" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row6_col3" name="amount_d_col3" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row6_col4" name="amount_d_col4" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row6_col5" name="amount_d_col5" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="amount_d_row6_col6" name="amount_d_col6" onblur="totalAdd_D(this.name);" onKeyUp="removeChar(this);"></td>
                             <td><input type="text" id="" name="" value=""></td>
                         </tr>


                         <tr>
                             <th style="text-align: center;">小計 d</th>
                             <th><input type="text" name="subtotal_of_d_col1" id="subtotal_of_d_col1" readonly="true"/></th>
                             <th><input type="text" name="subtotal_of_d_col2" id="subtotal_of_d_col2" readonly="true"/></th>
                             <th><input type="text" name="subtotal_of_d_col3" id="subtotal_of_d_col3" readonly="true"/></th>
                             <th><input type="text" name="subtotal_of_d_col4" id="subtotal_of_d_col4" readonly="true"/></th>
                             <th><input type="text" name="subtotal_of_d_col5" id="subtotal_of_d_col5" readonly="true"/></th>
                             <th><input type="text" name="subtotal_of_d_col6" id="subtotal_of_d_col6" readonly="true"/></th>
                             <td></td>
                         </tr>
                         <tr>
                             <th style="text-align: center;">差引 e=c-d</th>
                             <th><input type="text" name="subtraction_of_d_col1" id="subtraction_of_d_col1" readonly="true"/></th>
                             <th><input type="text" name="subtraction_of_d_col2" id="subtraction_of_d_col2" readonly="true"/></th>
                             <th><input type="text" name="subtraction_of_d_col3" id="subtraction_of_d_col3" readonly="true"/></th>
                             <th><input type="text" name="subtraction_of_d_col4" id="subtraction_of_d_col4" readonly="true"/></th>
                             <th><input type="text" name="subtraction_of_d_col5" id="subtraction_of_d_col5" readonly="true"/></th>
                             <th><input type="text" name="subtraction_of_d_col6" id="subtraction_of_d_col6" readonly="true"/></th>
                             <td></td>
                         </tr>
                         <tr>
                             <th rowspan="3" style="width: 15px; vertical-align: middle; font-size: 16px;">営<br>業<br>外</th>
                             <th style="text-align: center;">収入 f</th>
                             <th><input type="text" name="income_of_d_col1" id="income_of_d_col1" readonly="true"/></th>
                             <th><input type="text" name="income_of_d_col2" id="income_of_d_col2" readonly="true"/></th>
                             <th><input type="text" name="income_of_d_col3" id="income_of_d_col3" readonly="true"/></th>
                             <th><input type="text" name="income_of_d_col4" id="income_of_d_col4" readonly="true"/></th>
                             <th><input type="text" name="income_of_d_col5" id="income_of_d_col5" readonly="true"/></th>
                             <th><input type="text" name="income_of_d_col6" id="income_of_d_col6" readonly="true"/></th>
                             <td></td>
                         </tr>
                         <tr>

                             <th style="text-align: center;">支出 g</th>
                             <th><input type="text" name="expenditure_of_d_col1" id="expenditure_of_d_col1" readonly="true"/></th>
                             <th><input type="text" name="expenditure_of_d_col2" id="expenditure_of_d_col2" readonly="true"/></th>
                             <th><input type="text" name="expenditure_of_d_col3" id="expenditure_of_d_col3" readonly="true"/></th>
                             <th><input type="text" name="expenditure_of_d_col4" id="expenditure_of_d_col4" readonly="true"/></th>
                             <th><input type="text" name="expenditure_of_d_col5" id="expenditure_of_d_col5" readonly="true"/></th>
                             <th><input type="text" name="expenditure_of_d_col6" id="expenditure_of_d_col6" readonly="true"/></th>
                             <td></td>
                         </tr>
                         <tr>                                    
                             <th style="text-align: center;">差引 h=f-g</th>
                             <th><input type="text" name="subtractionE_of_d_col1" id="subtractionE_of_d_col1" readonly="true"/></th>
                             <th><input type="text" name="subtractionE_of_d_col2" id="subtractionE_of_d_col2" readonly="true"/></th>
                             <th><input type="text" name="subtractionE_of_d_col3" id="subtractionE_of_d_col3" readonly="true"/></th>
                             <th><input type="text" name="subtractionE_of_d_col4" id="subtractionE_of_d_col4" readonly="true"/></th>
                             <th><input type="text" name="subtractionE_of_d_col5" id="subtractionE_of_d_col5" readonly="true"/></th>
                             <th><input type="text" name="subtractionE_of_d_col6" id="subtractionE_of_d_col6" readonly="true"/></th>
                             <td></td>
                         </tr>
                         <tr>
                             <th style="width: 15px; vertical-align: middle; font-size: 16px;"></th>                                  
                             <th style="text-align: center;">合計 e-h</th>
                             <th><input type="text" name="total_of_d_col1" id="total_of_d_col1" readonly="true"/></th>
                             <th><input type="text" name="total_of_d_col2" id="total_of_d_col2" readonly="true"/></th>
                             <th><input type="text" name="total_of_d_col3" id="total_of_d_col3" readonly="true"/></th>
                             <th><input type="text" name="total_of_d_col4" id="total_of_d_col4" readonly="true"/></th>
                             <th><input type="text" name="total_of_d_col5" id="total_of_d_col5" readonly="true"/></th>
                             <th><input type="text" name="total_of_d_col6" id="total_of_d_col6" readonly="true"/></th>
                             <td></td>
                         </tr>
                     </tbody>
                    </table>
                </div>
            </div>            
        </div>
        
    </div>
    <script src="<?php echo base_url('resource/js/jquery-confirm.min.js'); ?>"></script>
    <script src="<?php echo base_url('resource/js/jquery-ui.min.js'); ?>"></script>
    
    <script src="<?php echo base_url('resource/js/profit_loss.js'); ?>"></script>
    



    
</body>
</html>