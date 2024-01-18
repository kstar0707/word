<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1"> -->
<meta content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no' name='viewport'>
<!-- <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86"> -->
<meta name="mobile-web-app-capable" content="yes">



<title><?php echo isset($title) ? $title : ""; ?></title>


<base href="<?php echo base_url(); ?>"/>

<!-- <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.png"/> -->
<link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/dist/css/bootstrap.min.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/dist/css/bootstrap-theme.min.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/css/font-awesome.min.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/css/custom.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().RES_DIR; ?>/css/custom.css?id=<?php echo rand(0,10000)?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().RES_DIR; ?>/css/word_responsive.css?id=<?php echo rand(0,10000)?>">

<link type="text/css" rel="stylesheet" href="<?php echo base_url('resource/css/email_modal.css'); ?>"/>


<link rel="stylesheet" href="resource/css/jquery-confirm.min.css">
<script src="<?php echo base_url('resource/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('resource/dist/js/bootstrap.min.js'); ?>"></script>



<script>

 "use strict";
	
	jQuery(document).ready(function($) {
		// Wordapp Jquery And JavaScript

		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			
	        $("#left_content_aria").removeClass('show').addClass('hide');
	        
	       /* if ($(window).width() < 650) {
	        	$("#doc_content_maindiv").removeClass('col-lg-8 col-md-10 col-sm-10').addClass('col-lg-10 col-md-10 col-sm-10');
	        }else{

	       $("#doc_content_maindiv").removeClass('col-lg-8 col-md-10 col-sm-10 ').addClass('col-lg-10 col-md-10 col-sm-10 ');
	        }*/

	    }
	});





// hide -- bar active----

	(function( win ){
	var doc = win.document;
	
	// If there's a hash, or addEventListener is undefined, stop here
	if(!win.navigator.standalone && !location.hash && win.addEventListener ){
		//scroll to 1
		win.scrollTo( 0, 1 );
		var scrollTop = 1,
			getScrollTop = function(){
				return win.pageYOffset || doc.compatMode === "CSS1Compat" && doc.documentElement.scrollTop || doc.body.scrollTop || 0;
			},
		
			//reset to 0 on bodyready, if needed
			bodycheck = setInterval(function(){
				if( doc.body ){
					clearInterval( bodycheck );
					scrollTop = getScrollTop();
					win.scrollTo( 0, scrollTop === 1 ? 0 : 1 );
				}	
			}, 15 );
		
		win.addEventListener( "load", function(){
			setTimeout(function(){
				//at load, if user hasn't scrolled more than 20 or so...
				if( getScrollTop() < 40 ){
					//reset to hide addr bar at onload
					win.scrollTo( 0, scrollTop === 1 ? 0 : 1 );
				}
			}, 0);
		}, false );
	}
})( this );



// window resize script
	function simulateClick(id) {
		  var event = new MouseEvent('click', {
		    'view': window,
		    'bubbles': true,
		    'cancelable': true
		  });

		  var elem = document.getElementById(id); 

		  return elem.dispatchEvent(event);
	}


</script>



