<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            $this->load->view('admin/components/htmlheader');
        ?>  
        <!-- Custom Theme Style -->
        <link href="<?= base_url() ?>resource/build/css/app.css" rel="stylesheet">
        <link href="<?= base_url() ?>resource/build/css/bg-green-dark.css" rel="stylesheet">      
        <!-- Custom Theme Style -->
        <link href="<?= base_url() ?>resource/build/css/custom.min.css" rel="stylesheet">
        <style type="text/css">
            .nav > li.active{
                background: #2A3F54;
            }
            .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus{
                    background-color: #2b957a;
            }
            .nav-stacked > li + li{
                margin-top: 0px;
            }
            .panel {
                border-radius: 0px;
            }
            .table > thead > tr > th{
                padding: 2px 8px;
            }
            .btn_custom{
                padding: 2px 3px;
            }
        </style>
    </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <?php
                $this->load->view('admin/components/sidebar');
            ?>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
            <?php
                $this->load->view('admin/components/top_nav');
            ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">            
            <div class="page-title">
                <?php
                    $this->load->view('admin/components/page_title');
                ?>
            </div>
            <div class="clearfix"></div>
            
            <div class="row mt-lg">
                <div class="col-sm-3 col-md-3 col-xs-12">
                    <ul class="nav nav-pills nav-stacked navbar-custom-nav">
                        
                        <li>
                            <a href="<?= base_url('account/account_profile') ?>"> 
                                <i class="fa fa-user"></i>
                                <?= lang('website_profile') ?>
                            </a>
                        </li>
                        
                        <li class="active">
                            <a href="<?= base_url('account/account_settings') ?>">
                            <i class="fa fa-cog"></i>  
                            <?=lang('website_account')?></a>
                        </li>
                        
                        <li>
                            <a href="<?= base_url('account/account_password') ?>">
                                <i class="fa fa-unlock-alt"></i>
                                <?= lang('website_password') ?>
                            </a>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <div class="tab-content" style="border: 0; padding:0;">
                        
                        <div class="active" style="position: relative;">
                            <div class="panel panel-custom">
                                <!-- Default panel contents -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong><?= lang('settings_page_name'); ?> </strong>
                                        
                                    </div>
                                </div>
                                <div class="panel-body form-horizontal">
                                    <?php if (isset($settings_info))
                                    {
                                        ?>
                                    <div class="alert alert-success fade in">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <?php echo $settings_info; ?>
                                    </div>
                                        <?php } ?>

                                    

                                    <!-- <div class="well"><?php echo sprintf(lang('settings_privacy_statement'), anchor('page/privacy-policy', lang('settings_privacy_policy'))); ?></div> -->

                                    

                                    <?php echo form_open(uri_string(), 'class="form-horizontal" novalidate role="form"'); ?>

                                        <div class="item form-group <?php echo (form_error('settings_email') || isset($settings_email_error)) ? 'has-error' : ''; ?>">
                                            

                                            
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_email"><?php echo lang('settings_email'); ?></label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php echo form_input(array('name' => 'settings_email', 'id' => 'settings_email', 'class'=>'form-control col-md-7 col-xs-12', 'required'=> 'required', 'value' => set_value('settings_email') ? set_value('settings_email') : (isset($account->email) ? $account->email : ''), 'maxlength' => 160)); ?>
                                                <?php if (form_error('settings_email') || isset($settings_email_error))
                                                {
                                                ?>
                                                <span class="help-block">
                                                            <?php
                                                    echo form_error('settings_email');
                                                    echo isset($settings_email_error) ? $settings_email_error : '';
                                                    ?>
                                                            </span>
                                                <?php } ?>
                                            </div>

                                        </div>

                                        <div class="item form-group <?php echo (form_error('settings_fullname')) ? 'has-error' : ''; ?>">


                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_fullname"><?php echo lang('settings_fullname'); ?></label>

                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php echo form_input(array('name' => 'settings_fullname', 'id' => 'settings_fullname', 'class'=>'form-control', 'value' => set_value('settings_fullname') ? set_value('settings_fullname') : (isset($account_details->fullname) ? $account_details->fullname : ''), 'maxlength' => 160)); ?>
                                                <?php if (form_error('settings_fullname'))
                                            {
                                                ?>
                                                <span class="help-block">
                                                            <?php echo form_error('settings_fullname'); ?>
                                                            </span>
                                                <?php } ?>
                                            </div>

                                        </div>

                                        <div class="item form-group <?php echo (form_error('settings_firstname')) ? 'has-error' : ''; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_firstname"><?php echo lang('settings_firstname'); ?></label>

                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php echo form_input(array('name' => 'settings_firstname', 'id' => 'settings_firstname', 'class'=>'form-control', 'value' => set_value('settings_firstname') ? set_value('settings_firstname') : (isset($account_details->firstname) ? $account_details->firstname : ''), 'maxlength' => 80)); ?>
                                                <?php if (form_error('settings_firstname'))
                                            {
                                                ?>
                                                <span class="help-block">
                                                            <?php echo form_error('settings_firstname'); ?>
                                                            </span>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="item form-group <?php echo (form_error('settings_lastname')) ? 'has-error' : ''; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_lastname"><?php echo lang('settings_lastname'); ?></label>

                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php echo form_input(array('name' => 'settings_lastname', 'id' => 'settings_lastname', 'class'=>'form-control', 'value' => set_value('settings_lastname') ? set_value('settings_lastname') : (isset($account_details->lastname) ? $account_details->lastname : ''), 'maxlength' => 80)); ?>
                                                <?php if (form_error('settings_lastname'))
                                            {
                                                ?>
                                                <span class="help-block">
                                                            <?php echo form_error('settings_lastname'); ?>
                                                            </span>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="item form-group <?php echo isset($settings_dob_error) ? 'has-error' : ''; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_dateofbirth"><?php echo lang('settings_dateofbirth'); ?></label>

                                            <div class="form-inline col-md-6 col-sm-6 col-xs-12">
                                                <?php $m = $this->input->post('settings_dob_month') ? $this->input->post('settings_dob_month') : (isset($account_details->dob_month) ? $account_details->dob_month : ''); ?>
                                                <select name="settings_dob_month" class="form-control">
                                                    <option value=""><?php echo lang('dateofbirth_month'); ?></option>
                                                    <option value="1"<?php if ($m == 1) echo ' selected="selected"'; ?>><?php echo lang('month_jan'); ?></option>
                                                    <option value="2"<?php if ($m == 2) echo ' selected="selected"'; ?>><?php echo lang('month_feb'); ?></option>
                                                    <option value="3"<?php if ($m == 3) echo ' selected="selected"'; ?>><?php echo lang('month_mar'); ?></option>
                                                    <option value="4"<?php if ($m == 4) echo ' selected="selected"'; ?>><?php echo lang('month_apr'); ?></option>
                                                    <option value="5"<?php if ($m == 5) echo ' selected="selected"'; ?>><?php echo lang('month_may'); ?></option>
                                                    <option value="6"<?php if ($m == 6) echo ' selected="selected"'; ?>><?php echo lang('month_jun'); ?></option>
                                                    <option value="7"<?php if ($m == 7) echo ' selected="selected"'; ?>><?php echo lang('month_jul'); ?></option>
                                                    <option value="8"<?php if ($m == 8) echo ' selected="selected"'; ?>><?php echo lang('month_aug'); ?></option>
                                                    <option value="9"<?php if ($m == 9) echo ' selected="selected"'; ?>><?php echo lang('month_sep'); ?></option>
                                                    <option value="10"<?php if ($m == 10) echo ' selected="selected"'; ?>><?php echo lang('month_oct'); ?></option>
                                                    <option value="11"<?php if ($m == 11) echo ' selected="selected"'; ?>><?php echo lang('month_nov'); ?></option>
                                                    <option value="12"<?php if ($m == 12) echo ' selected="selected"'; ?>><?php echo lang('month_dec'); ?></option>
                                                </select>
                                                <?php $d = $this->input->post('settings_dob_day') ? $this->input->post('settings_dob_day') : (isset($account_details->dob_day) ? $account_details->dob_day : ''); ?>
                                                <select name="settings_dob_day" class="form-control">
                                                    <option value="" selected="selected"><?php echo lang('dateofbirth_day'); ?></option>
                                                    <?php for ($i = 1; $i < 32; $i ++) : ?>
                                                    <option value="<?php echo $i; ?>"<?php if ($d == $i) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                                <?php $y = $this->input->post('settings_dob_year') ? $this->input->post('settings_dob_year') : (isset($account_details->dob_year) ? $account_details->dob_year : ''); ?>
                                                <select name="settings_dob_year" class="form-control">
                                                    <option value=""><?php echo lang('dateofbirth_year'); ?></option>
                                                    <?php $year = mdate('%Y', now()); for ($i = $year; $i > 1900; $i --) : ?>
                                                    <option value="<?php echo $i; ?>"<?php if ($y == $i) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                                <?php if (isset($settings_dob_error))
                                            {
                                                ?>
                                                <span class="help-block">
                                                            <?php echo $settings_dob_error; ?>
                                                            </span>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="item form-group <?php echo (form_error('settings_gender')) ? 'has-error' : ''; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_gender"><?php echo lang('settings_gender'); ?></label>

                                             <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php $s = ($this->input->post('settings_gender') ? $this->input->post('settings_gender') : (isset($account_details->gender) ? $account_details->gender : '')); ?>
                                                <select name="settings_gender" class="form-control">
                                                    <option value=""><?php echo lang('settings_select'); ?></option>
                                                    <option value="m"<?php if ($s == 'm') echo ' selected="selected"'; ?>><?php echo lang('gender_male'); ?></option>
                                                    <option value="f"<?php if ($s == 'f') echo ' selected="selected"'; ?>><?php echo lang('gender_female'); ?></option>
                                                </select>
                                            </div>
                                        </div>

                                        <!--Added by sumon on 9-02-17-->
                                        <div class="form-group <?php echo (form_error('settings_skype_id')) ? 'error' : ''; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_skype_id"><?php echo lang('settings_skype_id'); ?></label>

                                             <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php $s = ($this->input->post('settings_skype_id') ? $this->input->post('settings_skype_id') : (isset($account_details->skype_id) ? $account_details->skype_id : '')); ?>
                                                <?php echo form_input(array('name' => 'settings_skype_id', 'id' => 'settings_skype_id', 'class'=>'form-control', 'value' => set_value('settings_skype_id') ? set_value('settings_skype_id') : (isset($account_details->skype_id) ? $account_details->skype_id : ''), 'maxlength' => 50)); ?>
                                            </div>
                                        </div>

                                        <div class="form-group <?php echo (form_error('settings_postalcode')) ? 'has-error' : ''; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_postalcode"><?php echo lang('settings_postalcode'); ?></label>

                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php echo form_input(array('name' => 'settings_postalcode', 'id' => 'settings_postalcode', 'class'=>'form-control', 'value' => set_value('settings_postalcode') ? set_value('settings_postalcode') : (isset($account_details->postalcode) ? $account_details->postalcode : ''), 'maxlength' => 40)); ?>
                                                <?php if (form_error('settings_postalcode'))
                                            {
                                                ?>
                                                <span class="help-block">
                                                            <?php echo form_error('settings_postalcode'); ?>
                                                            </span>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="form-group <?php echo (form_error('settings_country')) ? 'has-error' : ''; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_country"><?php echo lang('settings_country'); ?></label>

                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php $account_country = ($this->input->post('settings_country') ? $this->input->post('settings_country') : (isset($account_details->country) ? $account_details->country : '')); ?>
                                                <select id="settings_country" name="settings_country" class="form-control">
                                                    <option value=""><?php echo lang('settings_select'); ?></option>
                                                    <?php foreach ($countries as $country) : ?>
                                                    <option value="<?php echo $country->alpha2; ?>"<?php if ($account_country == $country->alpha2) echo ' selected="selected"'; ?>>
                                                        <?php echo $country->country; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group<?php echo (form_error('settings_language')) ? 'has-error' : ''; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_language"><?php echo lang('settings_language'); ?></label>

                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php $account_language = ($this->input->post('settings_language') ? $this->input->post('settings_language') : (isset($account_details->language) ? $account_details->language : '')); ?>
                                                <select id="settings_language" name="settings_language" class="form-control">
                                                    <option value=""><?php echo lang('settings_select'); ?></option>
                                                    <?php foreach ($languages as $language) : ?>
                                                    <option value="<?php echo $language->one; ?>"<?php if ($account_language == $language->one) echo ' selected="selected"'; ?>>
                                                        <?php echo $language->language; ?><?php if ($language->native && $language->native != $language->language) echo ' ('.$language->native.')'; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group <?php echo (form_error('settings_timezone')) ? 'has-error' : ''; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_timezone"><?php echo lang('settings_timezone'); ?></label>

                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php $account_timezone = ($this->input->post('settings_timezone') ? $this->input->post('settings_timezone') : (isset($account_details->timezone) ? $account_details->timezone : '')); ?>
                                                <select id="settings_timezone" name="settings_timezone" class="form-control">
                                                    <option value=""><?php echo lang('settings_select'); ?></option>
                                                    <?php foreach ($zoneinfos as $zoneinfo) : ?>
                                                    <option value="<?php echo $zoneinfo->zoneinfo; ?>"<?php if ($account_timezone == $zoneinfo->zoneinfo) echo ' selected="selected"'; ?>>
                                                        <?php echo $zoneinfo->zoneinfo; ?><?php if ($zoneinfo->offset) echo ' ('.$zoneinfo->offset.')'; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group <?php echo (form_error('settings_timezone')) ? 'has-error' : ''; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="settings_currency"><?php echo lang('settings_currency'); ?></label>

                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <?php $account_currency = ($this->input->post('settings_currency') ? $this->input->post('settings_currency') : (isset($account_details->currency) ? $account_details->currency : '')); ?>
                                                <select id="settings_currency" name="settings_currency" class="form-control">
                                                    <option value=""><?php echo lang('settings_select'); ?></option>
                                                    <?php foreach ($currencies as $currency) : ?>
                                                    <option value="<?php echo $currency->alpha; ?>"<?php if ($account_currency == $currency->alpha) echo ' selected="selected"'; ?>>
                                                        <?php echo $currency->alpha; ?><?php if ($currency->alpha) echo ' ('.$currency->currency.')'; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                          <div class="col-md-6 col-md-offset-3">
                                                <button type="submit" class="btn btn-success"><?php echo lang('settings_save'); ?></button>
                                            <button type="reset" class="btn btn-small">Cancel</button>
                                          </div>
                                        </div>

                                    <?php echo form_close(); ?>                                
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <?php echo lang('website_footer_text').' '.date("Y");?> 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <?php
        $this->load->view('admin/components/footer');
    ?>
    <!-- Custom -->
    <script src="<?= base_url() ?>resource/build/js/custom.min.js"></script>

  </body>
</html>