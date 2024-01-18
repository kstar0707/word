<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head', array('title' => lang('forgot_password_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info"> 
            <div class="panel-heading">
                <?php echo lang('forgot_password_page_name'); ?>
            </div>
            <div>
                

        <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

        <p style="padding:5px" class=""><?php echo lang('forgot_password_instructions'); ?></p>

        <div style="padding:5px" class="input-group <?php echo (form_error('forgot_password_username_email') OR isset($forgot_password_username_email_error)) ? 'error' : ''; ?>">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <!--
            <label class="control-label" for="forgot_password_username_email"><?php echo lang('forgot_password_username_email'); ?></label>
            -->
            <?php
            $value = set_value('forgot_password_username_email') ? set_value('forgot_password_username_email') : (isset($account) ? $account->username : '');
            $value = str_replace(array('\'', '"'), ' ', $value);
            echo form_input(array(
            'name' => 'forgot_password_username_email',
            'id' => 'forgot_password_username_email',
            'class' => 'form-control',
            'placeholder' =>lang('forgot_password_username_email'),
            'value' => $value,
            'maxlength' => '80'
            )); ?>
                
        </div>
        <?php if (form_error('forgot_password_username_email') || isset($forgot_password_username_email_error))
            {
        ?>
        <p class="text-danger" style="padding:5px;">
        <?php
            echo form_error('forgot_password_username_email');
            echo isset($forgot_password_username_email_error) ? $forgot_password_username_email_error : '';
            ?>
        </p>
        <?php } ?>

        <?php if (isset($recaptcha)) : ?>
        <?php echo $recaptcha; ?>
        <?php if (isset($forgot_password_recaptcha_error)) : ?>
            <span class="field_error"><?php echo $forgot_password_recaptcha_error; ?></span>
            <?php endif; ?>
        <?php endif; ?>

        <div style="padding:5px;" class="clearfix">
            <button type="submit" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-send"></i> <?php echo lang('forgot_password_send_instructions'); ?></button>
            <?php 
            /*
            echo form_button(array(
            'type' => 'submit',
            'class' => 'btn btn-large pull-right',
            'content' => lang('forgot_password_send_instructions')
        )); 
            */
        ?>
        </div>
        <div class="clear"></div>
        <?php echo form_close(); ?>

            </div>
            <div style="padding:5px;" class="panel-footer">
                <a href="account/sign_in">Login</a> 
            </div>
        </div>
    </div>
</div>
<?php echo $this->load->view('footer'); ?>

</body>
</html>
