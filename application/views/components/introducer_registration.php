<div class="alert alert-warning col-lg-5 hide col-md-5 col-sm-5 col-xs-8 pull-right table_of_introducer draggable_aria" id="table_of_introducer" style="z-index: 100;
 position: fixed; box-shadow: 0 2px 6px rgba(0,0,0,0.2);border: solid 2px #4AB9DA; border-top: solid 7px #4AB9DA;">
        
        <form id="introducer_form" action="javascript()" method="POST">
            
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <h3>被紹介者登録画面</h3>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 pull-right" style="padding: 0">
                    <button type="button" class="btn btn-info pull-right" id="close_introducer">戻る</button>
                    
                </div> 
            <table class="table" style="margin-bottom: -1px">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <label class="col-md-2 control-label" for="radios">紹介元</label>
                              <div class="col-md-8"> 
                                <label class="radio-inline" for="has_introducer">
                                  <input type="radio" name="radios" id="has_introducer" value="1" checked="checked">
                                   有り
                                </label> 
                                <label class="radio-inline" for="none_introducer">
                                  <input type="radio" name="radios" id="none_introducer" value="2">
                                   なし
                                </label> 
                                
                              </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <div class="col-md-3" style="padding: 0;">本人氏名</div>
                            <div class="col-md-9" style="padding: 0;">
                                <input style="ime-mode: active;" type="text" placeholder="本人氏名" id="referee_name" value="<?= $account->fullname; ?>" class="form-control input-sm" name="referee_name">                            
                            </div>  
                        </td>
                        <td width="50%">
                            <div class="col-md-3" style="padding: 0">
                                被紹介者
                            </div>
                            <div class="col-md-9" style="padding: 0;">
                                <input style="ime-mode: active;" placeholder="被紹介者" type="text" id="introducer_name" class="form-control input-sm" name="introducer_name">                            
                            </div> 
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="col-md-3" style="padding: 0">
                                携帯
                            </div>
                            <div class="col-md-9" style="padding: 0">
                                <input style="ime-mode: inactive;" required="required" type="text" id="referee_number" placeholder="携帯" value="<?= $account->username ?>" class="form-control input-sm" name="referee_number">
                            </div>
                            <!-- <div class="col-md-12">携帯 <?= $account->username ?></div> -->
                        </td>
                        <td>
                            <div class="col-md-3" style="padding: 0">
                                携帯
                            </div>
                            <div class="col-md-9" style="padding: 0">
                                <input style="ime-mode: inactive;" placeholder="携帯" type="text" id="introducer_number" class="form-control input-sm" name="introducer_number">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-success pull-right" id="save_introducer_button">完了</button> 
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <!-- <table class="table table-bordered" id="indroducer_referee_table">

            </table> -->
            
        </form>
</div>
        

    <!-- ・相手先をクリックして登録情報を変更できます。<br>・相手先名と電話番号を変更してから登録ボタンを押して<br>・ください。 -->