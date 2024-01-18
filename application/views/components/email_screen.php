<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//date_default_timezone_set('Asia/Tokyo');
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <?php $this->load->view('components/head'); ?>

    <?php


    if (preg_match('/(?i)msie [10]/', $_SERVER['HTTP_USER_AGENT'])) {

        ?>
        <!--  if IE = 10 -->
        <script src="<?= base_url('resource/tiny_mce/tiny_mce.js?cachebuster=123') ?>"></script>
        <script src="<?= base_url('resource/js/custom_editor3.js') ?>"></script>
    <?php
    }else{
    ?>
        <script src="<?= base_url('resource/tinymce/tinymce.min.js') ?>"></script>
        <script src="<?= base_url('resource/js/custom_editor4.js') ?>"></script>

        <?php
    }

    ?>


</head>

<body style="padding-top: 0; margin-top: 0; background-color: white;">
<!--loader for copy/paste on editor-->
<div id="preloader"
     style="position: fixed; left: 0; top: 0; z-index: 999; width: 100%; height: 100%; overflow: visible; background: transparent url('resource/img/ajax/ajax_load_6.gif') no-repeat center center;">

</div>

<button style="display: none;" id="emailing_aria_button" data-html="true" class="btn btn-success btn_keipro" role="button"
        data-toggle="popover" data-container="body" title=""
        data-content="メール<br>ペーパーレス促進のため、共有が出来ます。。" data-placement="left" data-trigger="hover">メール
</button>
<input type="hidden" name="base_url" id="base_url" value="<?= base_url(); ?>">

<?php
$this->load->view('components/email_modal');
?>
<?php
$this->load->view('components/email_main_modal');
?>

<script src="<?php echo base_url('resource/js/custom.js'); ?>"></script>


</body>

</html>
<script>
    jQuery(document).ready(function ($) {
//            $("#emailing_aria_button").hide();
        setTimeout(function () {
            $('#preloader').fadeOut('slow', function () {
                $(this).remove();
                $("#emailing_aria_button").trigger('click');
            });
        }, 300);

        $("#email_close").click(function (event) {
            window.location.href = $("#base_url").val() + "index.php/account/sign_out";

            // $(" .email_main_modal ").modal('hide');
            // $("#emailing_aria").hide();
        });

    });
</script>
