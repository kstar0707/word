<div class="modal fade modal-fullscreen incomeModal" id="incomeModal" tabindex="-1" role="dialog" aria-labelledby="incomeModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px; border: 0">
                <div class="col-md-6">
                    <h3 style="margin-top: 10px;">表計算<small>（損益表）</small></h3> 
                </div>
                <div class="col-md-6">
                     <span class="pull-right" style="padding: 10px;"><strong>: 円</strong></span>
                    <button type="button" id="" class="btn btn-default pull-right btn_table">単位</button>

                    <button type="button" id="btn-mail-0" class="btn btn-warning pull-right btn_table" data-dismiss="modal" aria-label="Close">戻る</button>
                    
                    <button type="button" id="delete_income_sheet" class="btn btn-danger pull-right btn_table"> 削除</button>
                </div>                
            </div>
                    
            <div class="modal-body" style="padding: 0">
                <div class="col-md-10 col-md-offset-1">
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
                                    <th rowspan="8" nowrap  style="width: 15px; padding: 5px; vertical-align: middle; font-size: 16px;"> 増 <br> 加 <!-- （ 収 入 ） --> </th>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">小計</th>
                                    <th><span id="subtotal_of_1"></span></th>
                                    <th><span id="subtotal_of_2"></span></th>
                                    <th><span id="subtotal_of_3"></span></th>
                                    <th><span id="subtotal_of_4"></span></th>
                                    <th><span id="subtotal_of_5"></span></th>
                                    <td><span id="subtotal_of_6"></span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th style="text-align: center;">原価</th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th style="text-align: center;">粗利</th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th rowspan="8" nowrap style="width: 15px; vertical-align: middle; font-size: 16px;"> 減 <br> 少 <!-- （経費） --> </th>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="" name="" value=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">小計</th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">差引</th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th rowspan="3" style="width: 15px; vertical-align: middle; font-size: 16px;">営<br>業<br>外</th>
                                    <th style="text-align: center;">収入</th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>

                                    <th style="text-align: center;">支出</th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>                                    
                                    <th style="text-align: center;">差引</th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="width: 15px; vertical-align: middle; font-size: 16px;"></th>                                  
                                    <th style="text-align: center;">合計</th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <th><input type="text" id="" name=""></th>
                                    <td><input type="text" id="" name=""></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</div>