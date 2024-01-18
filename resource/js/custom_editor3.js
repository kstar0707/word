// Email Editor
tinymce.init({ 
    selector:'#email_content',
    theme : "simple",
    language : 'en',
    plugins: "searchreplace, pagebreak",
    body_class: 'my_class',
    content_css : 'https://keipro.dhaka10.dev.jacos.jp/dev/resource/tinymce/skins/lightgray/content.css',
    setup : function(ed) {
        $("#email_undo").on('click', function (e) {
            tinyMCE.execCommand('Undo');
            // tinyMCE.activeEditor.undoManager.undo();
        });

        $("#email_font_width").on('click', function (e) {
            tinyMCE.execCommand('Bold');
        });

        $("#email_font_1").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand("fontName", false, "ms mincho, ｍｓ 明朝");
            $("#font_2").removeClass('checked');
            $("#font_3").removeClass('checked');
            $("#font_4").removeClass('checked');
            $("#font_5").removeClass('checked');
            $("#font_1").addClass('checked');
            /* Act on the event */
        });

        $("#email_font_2").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand("fontName", false, "ms gothic, ｍｓ ゴシック");
            $("#font_1").removeClass('checked');
            $("#font_3").removeClass('checked');
            $("#font_4").removeClass('checked');
            $("#font_5").removeClass('checked');
            $("#font_2").addClass('checked');
            /* Act on the event */
        });

        $("#email_font_3").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand("fontName", false, "hg行書体,hgp行書体,cursive");
            $("#font_1").removeClass('checked');
            $("#font_2").removeClass('checked');
            $("#font_4").removeClass('checked');
            $("#font_5").removeClass('checked');
            $("#font_3").addClass('checked');
            /* Act on the event */
        });

        $("#email_font_4").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand("fontName", false, "hg丸ｺﾞｼｯｸm-pro,hg正楷書体-pro,ms ui gothic");
            $("#font_1").removeClass('checked');
            $("#font_2").removeClass('checked');
            $("#font_3").removeClass('checked');
            $("#font_5").removeClass('checked');
            $("#font_4").addClass('checked');
            /* Act on the event */
        });

        $("#email_font_5").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand("fontName", false, "hgp創英角ﾎﾟｯﾌﾟ体,hg創英角ﾎﾟｯﾌﾟ体");
            $("#font_1").removeClass('checked');
            $("#font_2").removeClass('checked');
            $("#font_3").removeClass('checked');
            $("#font_4").removeClass('checked');
            $("#font_5").addClass('checked');
        });                        
    } 
});
        
// Word app
tinymce.init({
    selector: '#doc_content',  // change this value according to your HTML
    theme : "simple",
    // language : 'en',
    // forced_root_block : 'p',
    force_p_newlines : true,
    plugins: "searchreplace",
    body_class: 'my_class',
    content_css : 'https://keipro.dhaka10.dev.jacos.jp/dev/resource/tinymce/skins/lightgray/content.css',
    setup : function(ed) {
        // Content Undo
        $("#undo").on('click', function (e) {
            tinyMCE.execCommand('Undo');
        });
        // Content Bold
        $("#font_width").on('click', function (e) {
            tinyMCE.execCommand('Bold', false, 'doc_content'); 
            // tinyMCE.execCommand('Bold');
        });

        // Search Replace
        $("#search_replace").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand('mce_search');
            /* Act on the event */
        });

        $("#font_1").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand("fontName", false, "ms mincho, ｍｓ 明朝");
            $("#font_2").removeClass('checked');
            $("#font_3").removeClass('checked');
            $("#font_4").removeClass('checked');
            $("#font_5").removeClass('checked');
            $("#font_1").addClass('checked');
            /* Act on the event */
        });

        $("#font_2").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand("fontName", false, "ms gothic, ｍｓ ゴシック");
            $("#font_1").removeClass('checked');
            $("#font_3").removeClass('checked');
            $("#font_4").removeClass('checked');
            $("#font_5").removeClass('checked');
            $("#font_2").addClass('checked');
            /* Act on the event */
        });

        $("#font_3").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand("fontName", false, "hg行書体,hgp行書体,cursive");
            $("#font_1").removeClass('checked');
            $("#font_2").removeClass('checked');
            $("#font_4").removeClass('checked');
            $("#font_5").removeClass('checked');
            $("#font_3").addClass('checked');
            /* Act on the event */
        });

        $("#font_4").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand("fontName", false, "hg丸ｺﾞｼｯｸm-pro,hg正楷書体-pro,ms ui gothic");
            $("#font_1").removeClass('checked');
            $("#font_2").removeClass('checked');
            $("#font_3").removeClass('checked');
            $("#font_5").removeClass('checked');
            $("#font_4").addClass('checked');
            /* Act on the event */
        });

        $("#font_5").on('click', function(event) {
            event.preventDefault();
            tinyMCE.execCommand("fontName", false, "hgp創英角ﾎﾟｯﾌﾟ体,hg創英角ﾎﾟｯﾌﾟ体");
            $("#font_1").removeClass('checked');
            $("#font_2").removeClass('checked');
            $("#font_3").removeClass('checked');
            $("#font_4").removeClass('checked');
            $("#font_5").addClass('checked');
            /* Act on the event */
        });

        $("#print_word").on('click', function(event) { 
            tinyMCE.execCommand('mcePrint');
        });

        
        
        ed.onClick.add(function(ed, evt) {
            $(".close_aria").addClass('hide').removeClass('show');
            // alert("Okau");
        }); 

      //   ed.onClick.add(function(ed, e) {
      //       alert("Click on Editor");
      //     console.debug('Editor was clicked: ' + e.target.nodeName);
      //     console.log('Editor was clicked: ' + e.target.nodeName);
      // });

        // Remove all nodes
        $("#full_screen_word").on('click', function(event) {
            event.preventDefault();
            // tinyMCE.execCommand("pagebreak", true, "<hr>");
            
        });
        ed.onChange.add(function(ed, evt) {
            save_autometically();
        }); 
        var lastKeypressTime = 0;
        ed.onKeyDown.add(function(ed, event) {

            var keyCode = event.keyCode;
            var delta = 1000;

            if (keyCode === 13) {

                var thisKeypressTime = new Date();
                thisKeypressTime = (thisKeypressTime.getTime());
                
                if ( thisKeypressTime - lastKeypressTime <= delta )
                {
                    console.log("dubble time");
                    thisKeypressTime = 0;
                }else{
                    lastKeypressTime = thisKeypressTime;
                    event.preventDefault();
                    event.stopPropagation();
                    var html_element = tinymce.activeEditor.selection.getStart();
                    var text_element = html_element.innerText;
                    
                    var sele = tinymce.activeEditor.selection.getNode();
                    
                    // editor.selection.getEnd();
                    console.log(sele)
                    // alert(sele);
                    return false;
                    for (var i = 0; i < 10; i++) {
                        if(html_element.substr(0,3)=="<p>") break;
                        html_element = text_element;
                    }
                    console.log(text_element);
                    // salert(html_element);
                   // tinymce.execCommand('mceInsertContent', false, '<span class="style_editor_default" style="font-weight:normal !important; font-size: 18px !important; font-family: ms mincho, ｍｓ 明朝 !important; color: #000;">&nbsp;</span>');
                    // tinymce.execCommand('mceInsertContent', false, '<span>&#8203;</span>');
                    
                    return false;
                    console.log("Single Time");
                }
            }
        });                       
    }            
});

var initStyle = function(){

    try{
        for(var i=0; i<10; i++){
            var html = editor.getSelection().getStartElement().$.outerHTML;
            var text = editor.getSelection().getStartElement().$.outerText;
            if(html.substr(0,3)=="<p>") break;
            editor.getSelection().getStartElement().$.outerHTML = text;
        }
        var sel = editor.getSelection();
        var range = sel.getRanges()[0];
        range.startOffset = 0;
        range.endOffset = 0;
        editor.getSelection().selectRanges([range])
    }catch(e){}
};
var removeStyles = function(){

    editor.insertHtml( "<span>&#8203;</span>" );
};

function set_editor_initialization() {
    
}

function save_autometically() {
    
    delay(function(){
        var post_id = $( "#post_id" ).val();
        var content = tinyMCE.activeEditor.getContent();
        var temp_title = strip(content);
        temp_title = temp_title.replace(/&nbsp;/gi,'');
        temp_title = temp_title.replace(/\n|\r/g, "").trim();
        
        var post_title = temp_title.substring(0,10);
        var base_url = $( "#base_url" ).val();
        var url = base_url+'index.php/wordapp/save';

        if (post_title.trim().length>0) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {post_id: post_id, post_title: post_title, post_details: content},
            })
            .done(function(data) {
                var post = JSON.parse(data);                       
                $("#post_id").val(post.post_id);
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            
            // $.post('index.php/wordapp/save', {post_id: post_id, post_title: title, post_details: content}, function(data) {
            //     var post = JSON.parse(data);
            //     $("#post_id").val(post.post_id);
            // });
        }
    }, 300 );
}

function word_font_color(color_code) {        
    tinyMCE.execCommand('ForeColor', false, color_code);
    // this.contentDocument.body.style.backgroundColor = 'red';
}

function find_replace() {
    alert("SearchReplace");
    tinyMCE.execCommand('SearchReplace');
}

function word_special_cherecter() {
    tinyMCE.execCommand('mceShowCharmap');
}

function word_cut() {
    tinyMCE.execCommand('cut');
    $("#font_cut_copy_aria").removeClass('hide').addClass('show');
}

function word_copy() {
    tinyMCE.execCommand('copy');
    $("#font_cut_copy_aria").removeClass('hide').addClass('show');
}

function return_close() {
    $('.close_aria').removeClass('show').addClass('hide');
    // $(".close_aria").hide();
}

function message_close() {
    $('.message_close_aria').removeClass('show').addClass('hide');
    // $(".close_aria").hide();
}

function change_font_size(font_size) {
    tinyMCE.execCommand("fontSize", false, font_size);
}

function strip(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();