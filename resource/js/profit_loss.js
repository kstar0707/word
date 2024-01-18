jQuery(document).ready(function($) {
	// Income Sheet
    $("#income_sheet_btn").on('click', function(event) {
    	event.preventDefault();
    	var base_url = $("#base_url").val();
    	window.open(base_url+'index.php/balance_sheet', "New Window", "height=600,width=1100, left=100, top=10");
    });

    $(".income-talbe>input[type='text']").blur(function(event) {
    	alert("Okay")
    });
    
});
