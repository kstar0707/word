// Email Editor
tinymce.init({
    selector: '#email_content',
    auto_focus: "#email_content",
    menubar: false,
    statusbar: false,
    branding: false,
    language: 'ja',
    body_class: 'email_editor',
    plugins: "print searchreplace charmap autoresize",
    charmap: [
    ["160",""],["173",""],["34",""],["162",""],["8364",""],["163",""],["165",""],["169",""],["174",""],["8482",""],["8240",""],["181",""],["183",""],["8226",""],["8230",""],["8242",""],["8243",""],["167",""],["182",""],["223",""],["8249",""],["8250",""],["171",""],["187",""],["8216",""],["8217",""],["8220",""],["8221",""],["8218",""],["8222",""],["60",""],["62",""],["8804",""],["8805",""],["8211",""],["8212",""],["175",""],["8254",""],["164",""],["166",""],["168",""],["161",""],["191",""],["710",""],["732",""],["176",""],["8722",""],["177",""],["247",""],["8260",""],["215",""],["185",""],["178",""],["179",""],["188",""],["189",""],["190",""],["402",""],["8747",""],["8721",""],["8734",""],["8730",""],["8764",""],["8773",""],["8776",""],["8800",""],["8801",""],["8712",""],["8713",""],["8715",""],["8719",""],["8743",""],["8744",""],["172",""],["8745",""],["8746",""],["8706",""],["8704",""],["8707",""],["8709",""],["8711",""],["8727",""],["8733",""],["8736",""],["180",""],["184",""],["170",""],["186",""],["8224",""],["8225",""],["192",""],["193",""],["194",""],["195",""],["196",""],["197",""],["256",""],["198",""],["199",""],["200",""],["201",""],["202",""],["203",""],["274",""],["204",""],["205",""],["206",""],["207",""],["298",""],["208",""],["209",""],["210",""],["211",""],["212",""],["213",""],["214",""],["216",""],["332",""],["338",""],["352",""],["217",""],["218",""],["219",""],["220",""],["362",""],["221",""],["376",""],["562",""],["222",""],["224",""],["225",""],["226",""],["227",""],["228",""],["229",""],["257",""],["230",""],["231",""],["232",""],["233",""],["234",""],["235",""],["275",""],["236",""],["237",""],["238",""],["239",""],["299",""],["240",""],["241",""],["242",""],["243",""],["244",""],["245",""],["246",""],["248",""],["333",""],["339",""],["353",""],["249",""],["250",""],["251",""],["252",""],["363",""],["253",""],["254",""],["255",""],["563",""],["913",""],["914",""],["915",""],["916",""],["917",""],["918",""],["919",""],["920",""],["921",""],["922",""],["923",""],["924",""],["925",""],["926",""],["927",""],["928",""],["929",""],["931",""],["932",""],["933",""],["934",""],["935",""],["936",""],["937",""],["945",""],["946",""],["947",""],["948",""],["949",""],["950",""],["951",""],["952",""],["953",""],["954",""],["955",""],["956",""],["957",""],["958",""],["959",""],["960",""],["961",""],["962",""],["963",""],["964",""],["965",""],["966",""],["967",""],["968",""],["969",""],["8501",""],["982",""],["8476",""],["978",""],["8472",""],["8465",""],["8592",""],["8593",""],["8594",""],["8595",""],["8596",""],["8629",""],["8656",""],["8657",""],["8658",""],["8659",""],["8660",""],["8756",""],["8834",""],["8835",""],["8836",""],["8838",""],["8839",""],["8853",""],["8855",""],["8869",""],["8901",""],["8968",""],["8969",""],["8970",""],["8971",""],["9001",""],["9002",""],["9674",""],["9824",""],["9827",""],["9829",""],[0x2600, ''],[0x2601, ''],[0x2615, ''],[0x2618, '']
    ],
    autoresize_min_height: 480,
    toolbar: false,
    
    content_css: 'resource/tinymce/skins/lightgray/content.css',
    // content_css : 'https://keipro.dhaka10.dev.jacos.jp/dev/resource/tinymce/skins/lightgray/content.css',

    init_instance_callback: function (ed) {
        ed.execCommand("fontName", false, "ms mincho, ｍｓ 明朝");
        ed.execCommand("fontSize", false, "8");

        $("#email_undo").on('click', function (e) {
            tinymce.get('email_content').execCommand('Undo');
            // tinyMCE.activeEditor.undoManager.undo();
        });

        $("#email_font_width").on('click', function (e) {
            tinymce.get('email_content').execCommand('Bold');
        });


        // $("#email_font_color").on('click', function (event) {
        //     event.preventDefault();
        //     tinymce.get('email_content').execCommand('ForeColor', false, color_code);
        //     tinymce.get('email_content').execCommand("fontName", false, "hgp蜑ｵ闍ｱ隗抵ｾ趣ｾ滂ｽｯ�鯉ｾ滉ｽ�,hg蜑ｵ闍ｱ隗抵ｾ趣ｾ滂ｽｯ�鯉ｾ滉ｽ�");
        //     $("#font_1").removeClass('checked');
        //     $("#font_2").removeClass('checked');
        //     $("#font_3").removeClass('checked');
        //     $("#font_4").removeClass('checked');
        //     $("#font_5").addClass('checked');
        // });
    }


});

var event_value = 0;
var base_url = $("#base_url").val();
// var get_page_count_doc = localStorage.getItem("page_count");
// var plusNum = 1;
// var page_count_doc = Number(get_page_count_doc) + Number(plusNum);
var total_doc = '';
for (var i = 2; i <= 4; i++) {
    total_doc += '#doc_content' + i + ',';
}
total_doc = '#print_content,#doc_content,' + total_doc;
// total_doc = '#print_content,#doc_content';
total_doc = total_doc.replace(/,(\s+)?$/, '');

// Word app
tinymce.init({
    selector: total_doc,  // change this value according to your HTML
    // selector: '#doc_content',  // change this value according to your HTML
    auto_focus: "#doc_content",
    menubar: false,
    statusbar: false,
    branding: false,
    language: 'ja',
    body_class: 'my_class',
    character_class: 'ahsan_class',
    plugins: "print searchreplace charmap image imagetools pagebreak autoresize table noneditable paste link", //visualblocks
    paste_data_images: true,
    automatic_uploads: true,
    images_upload_handler: function (blobInfo, success, failure) {
        console.log(blobInfo);
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'index.php/wordapp/do_upload');
        xhr.onload = function(data) {
          var json;
          if (xhr.status != 200) {
            failure('HTTP Error: ' + xhr.status);
            return;
          }

          json = JSON.parse(xhr.responseText);
          console.log(json);
          var image_att_select = tinyMCE.activeEditor.dom.select("img[data-attr-screen='screen_image']");
          if($(image_att_select).hasClass("last_uploaded_image")){
            $("#word_uploaded_file_name").val(json.file_name);
            // $("#word_image_width").val('400');
            $("#default_autosaving_message").removeClass('show').addClass('hide');
            $("#screen_image_zooming").removeClass('hide').addClass('show');
        }         

          if (!json || typeof json.location != 'string') {
            failure('Invalid JSON: ' + xhr.responseText);
            return;
          }
          success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    },
    images_upload_base_path: 'uploads',
    images_upload_credentials: true,
    charmap: [
        ["160",""],["173",""],["34",""],["162",""],["8364",""],["163",""],["165",""],["169",""],["174",""],["8482",""],["8240",""],["181",""],["183",""],["8226",""],["8230",""],["8242",""],["8243",""],["167",""],["182",""],["223",""],["8249",""],["8250",""],["171",""],["187",""],["8216",""],["8217",""],["8220",""],["8221",""],["8218",""],["8222",""],["60",""],["62",""],["8804",""],["8805",""],["8211",""],["8212",""],["175",""],["8254",""],["164",""],["166",""],["168",""],["161",""],["191",""],["710",""],["732",""],["176",""],["8722",""],["177",""],["247",""],["8260",""],["215",""],["185",""],["178",""],["179",""],["188",""],["189",""],["190",""],["402",""],["8747",""],["8721",""],["8734",""],["8730",""],["8764",""],["8773",""],["8776",""],["8800",""],["8801",""],["8712",""],["8713",""],["8715",""],["8719",""],["8743",""],["8744",""],["172",""],["8745",""],["8746",""],["8706",""],["8704",""],["8707",""],["8709",""],["8711",""],["8727",""],["8733",""],["8736",""],["180",""],["184",""],["170",""],["186",""],["8224",""],["8225",""],["192",""],["193",""],["194",""],["195",""],["196",""],["197",""],["256",""],["198",""],["199",""],["200",""],["201",""],["202",""],["203",""],["274",""],["204",""],["205",""],["206",""],["207",""],["298",""],["208",""],["209",""],["210",""],["211",""],["212",""],["213",""],["214",""],["216",""],["332",""],["338",""],["352",""],["217",""],["218",""],["219",""],["220",""],["362",""],["221",""],["376",""],["562",""],["222",""],["224",""],["225",""],["226",""],["227",""],["228",""],["229",""],["257",""],["230",""],["231",""],["232",""],["233",""],["234",""],["235",""],["275",""],["236",""],["237",""],["238",""],["239",""],["299",""],["240",""],["241",""],["242",""],["243",""],["244",""],["245",""],["246",""],["248",""],["333",""],["339",""],["353",""],["249",""],["250",""],["251",""],["252",""],["363",""],["253",""],["254",""],["255",""],["563",""],["913",""],["914",""],["915",""],["916",""],["917",""],["918",""],["919",""],["920",""],["921",""],["922",""],["923",""],["924",""],["925",""],["926",""],["927",""],["928",""],["929",""],["931",""],["932",""],["933",""],["934",""],["935",""],["936",""],["937",""],["945",""],["946",""],["947",""],["948",""],["949",""],["950",""],["951",""],["952",""],["953",""],["954",""],["955",""],["956",""],["957",""],["958",""],["959",""],["960",""],["961",""],["962",""],["963",""],["964",""],["965",""],["966",""],["967",""],["968",""],["969",""],["8501",""],["982",""],["8476",""],["978",""],["8472",""],["8465",""],["8592",""],["8593",""],["8594",""],["8595",""],["8596",""],["8629",""],["8656",""],["8657",""],["8658",""],["8659",""],["8660",""],["8756",""],["8834",""],["8835",""],["8836",""],["8838",""],["8839",""],["8853",""],["8855",""],["8869",""],["8901",""],["8968",""],["8969",""],["8970",""],["8971",""],["9001",""],["9002",""],["9674",""],["9824",""],["9827",""],["9829",""],[0x2600, ''],[0x2601, ''],[0x2615, ''],[0x2618, '']
    ],
    autoresize_min_height: 1112, //1112,842

    height: 1112,
    width: 720,
    // max_width: 595,
    toolbar: false,
    table_default_styles: {
        fontWeight: 'bold',
        border: '1px'
    },
    visual_table_class: 'custom_table',
    valid_child_elements: "td/th[a|#text]",
    // contextmenu: "link image inserttable | cell row column deletetable",
    content_css: 'resource/tinymce/skins/lightgray/content.css?'+new Date().getTime()+', resource/css/tinymce.css?'+new Date().getTime(),
    // extended_valid_elements : "a[name|href|target|title|onclick|class], jbtag[id|class]",
    // content_style: "p {line-height:100%}",
    // extended_valid_elements: "*[*]",
    setup: function (editor) {

        var DELAY = 400, clicks = 0, timer = null;

        var vjeObj = null;
        //var jsim_vje = JS_IM_vje;
        vjeObj = new JS_IM( document.getElementById('doc_content'), JS_IM_vje );

        // tinymce.DOM.bind(document, 'keydown', function(e) {
        //     console.debug(e.keyCode);
        // });

        // editor.on('ExecCommand', function (event) {
        //     // window.close();die();
        //     event.preventDefault();
        //     // if (event.command === 'mcePrint') {
        //         tinymce.get('doc_content').execCommand('mcePrint');
        //     parent.tinymce.activeEditor.windowManager.close();
        //         // alert('Print');
        //         //
        //         // var base_url = $("#base_url").val();
        //         // window.open(base_url+'index.php/balance_sheet', "New Window", "height=600,width=1100, left=100, top=10");
        //     // }
        // });
        
        function setPageBreak() {
            // add page-break
            var mce_body = tinymce.activeEditor.getBody();
            var p_tag_arr = tinymce.activeEditor.dom.select('p');
            var sep_arr = [];
            //var span_tag_arr = tinymce.activeEditor.dom.select('span');
            if (p_tag_arr != '') {
                //tinymce.activeEditor.dom.setStyle(tinymce.activeEditor.dom.select('p'), 'font-size', '18.666667px');
                //mce_body.style.overflow = 'visible';
                $(mce_body).children('p.mceNonEditable').remove();
                var page_height = 0, page_number = 1, page_count = 0;
                for (var i = 0; i < p_tag_arr.length; i++) {
                    //var get_font_size = tinymce.activeEditor.dom.getStyle(tinymce.activeEditor.dom.select('p')[i], 'font-size', false);
                    //var p = $(tinymce.activeEditor.dom.select('p')[i]);
                    //page_height += p.height();
                    page_height += p_tag_arr[i].offsetHeight;
                    if(page_height > 1000) {
                        // console.log(page_height)
                        //var new_paragraph = tinymce.activeEditor.dom.add(tinymce.activeEditor.dom.select('p')[i], 'p', {class: 'mceNonEditable', style: style}, 'ページ ' + page_number + ' / ' + page_count);
                        sep_arr.push($('<p class="mceNonEditable page_separator" contentEditable="false">ページ '+page_number+' / '+'</p>').insertAfter(p_tag_arr[i]));
                        page_number++;
                        page_count++;
                        page_height = 0;

                        //tinymce.activeEditor.insertContent('<!-- pagebreak -->');
                    }
                }
                for (var j = 0; j < sep_arr.length; j++) {
                    $(sep_arr[j]).text($(sep_arr[j]).text()+page_count);
                }
                localStorage.setItem("page_count", page_count);
            
                // var tinymce_height = $(tinymce.activeEditor.getContainer()).height();
                // alert(tinymce_height);
                //var val = autoPageBreak(add_font_size, 306);//previous value 413
            }
            // console.log('setPageBreak:page_count='+page_count);
        }

        editor.on('keyup paste redo undo', function (event) {
            setPageBreak();
            if(event.keyCode == 8 || event.keyCode == 46) { //backspace, delete
                setPageBreak();
            }
            if (event.keyCode == 13) { //enter
                //selNode = tinymce.activeEditor.selection.getRng(true).startContainer;
                setPageBreak();
            }
        });
        editor.on('paste redo undo', function (event) {
            setPageBreak();
        });

        // editor.on('keypress', function (event) {
        //     setPageBreak();
        // });

        editor.on('keyup', function (event) {
            setPageBreak();
            if(event.keyCode == 13) {
                var rng = tinymce.activeEditor.selection.getRng(true);
				var txt = rng.startContainer.textContent;
				if ( (txt.substring(rng.startOffset - 1, rng.startOffset) == '') &&
                        (txt.substring(rng.startOffset, rng.startOffset + 1) == '') ) {
                
                    $("#font_1").removeClass('checked');
                    $("#font_2").removeClass('checked');
                    $("#font_3").removeClass('checked');
                    $("#font_4").removeClass('checked');
                    $("#font_5").removeClass('checked');
                    $("#font_1").addClass('checked');
                    tinymce.get('doc_content').execCommand("fontName", false, "ms mincho, ｍｓ 明朝");
                    $("#font_family_mapping").val(0);
                    
                    // change_font_size('18.666667px', 14);
                    tinymce.get('doc_content').execCommand('ForeColor', false, '#000000');

                    var curNode = tinymce.activeEditor.selection.getNode();
                    if(curNode.nodeName.toLowerCase() != 'p') //$(beforeNode).prop('tagName')
                        curNode = $(curNode).closest('p')[0];
                    
                    curNode.style.fontSize = $('#change_font_size').val();
                    //$(curNode).find('span[data-mce-style]').css({'font-weight':'normal', 'font-size':'18.6667px', 'color': '#000', 'font-family': 'ms mincho, ｍｓ 明朝'}).attr('data-mce-style',"font-family: 'ms mincho', 'ｍｓ 明朝'; font-size: 18.6667px; color: #000;");
                    $(curNode).html('<span style="color: rgb(0, 0, 0); font-weight: normal; font-family: &quot;ms mincho&quot;, &quot;ｍｓ 明朝&quot;;" data-mce-style="font-family: \'ms mincho\', \'ｍｓ 明朝\'; color: #000;"><br data-mce-bogus="1"></span>');
                }

            }
        });

        editor.on('keydown', function (event) {
            setPageBreak();
            var selNode = tinymce.activeEditor.selection.getNode();
            // if(!vjeObj) {
            //     vjeObj = new JS_IM( selNode, jsim_vje ); //tinymce.activeEditor.getBody()
            //     Caret.tinymce = tinymce;
            // } else if(vjeObj.imeBox != selNode) {
            //     //vjeObj.imeBox = selNode;
            //     vjeObj.initialize(selNode, jsim_vje);
            // }
            
            $(vjeObj.imeBox).trigger(event);

            if(event.keyCode == 13) {
              
                /*//detect to add empty line when enter
                var rng = editor.selection.getRng(true);
				var txt = rng.startContainer.textContent;
				//console.log("before cur pos = [" + txt.substring(rng.startOffset - 1, rng.startOffset) + "]");
                //console.log("after cur pos = [" + txt.substring(rng.startOffset, rng.startOffset + 1) + "]");
                if ( (txt.substring(rng.startOffset - 1, rng.startOffset) == '') &&
                        (txt.substring(rng.startOffset, rng.startOffset + 1) == '') ) {
                console.log('empty line !');
                }*/
                
                var rng = tinymce.activeEditor.selection.getRng(true);
                var txt = rng.startContainer.textContent;
                var endNode = tinymce.activeEditor.selection.getEnd();
                if (  txt.substring(rng.startOffset, rng.startOffset + 1).length != '' 
                    || ($(endNode).parent()[0].nodeName != "BODY" && ($(endNode).next().text() != '')/* || $(endNode).next('#text').length > 0  */)
                ) {
                    clicks = 0;
                    return;
                }

                // Double Pressing Enter Key
                var apply_style = $("#apply_style").val();

                // console.log('apply style:'+apply_style+'clll'+clicks);
                // if (apply_style == 0 && $("#font_size_mapping").val()==0) {
                //     alert('font_size_mapping0');
                //     $(tinymce.activeEditor.selection.getNode()).after("&nbsp;");
                //
                // }
                var content = tinyMCE.activeEditor.getContent();
                
                var temp_title = strip(content);
                temp_title = temp_title.replace(/&nbsp;/gi, '');
                temp_title = temp_title.replace(/\n|\r/g, "").trim();

                // var test = tinymce.activeEditor.selection.getNode().Element;
                var test = tinymce.activeEditor.selection.getEnd().innerHTML;
                test = strip(test);
                // test = test.replace(/&nbsp;/gi, '');
                // test = test.replace(/\n|\r/g, "").trim();
                
                if (temp_title !== "" || test !== "") {
                    clicks++;
                }

                if (test == "") {
                    clicks = 0;
                }
                
                // alert(test);
                // console.log('clicks='+clicks);
                // console.log('currentContent='+test);
                // console.log('apply_style='+apply_style);

                if ((clicks == 1)) { // && (apply_style == 1)
                    // alert("Ahsan Ullah");
                    //  event.preventDefault();
                     event.stopPropagation();
                    // alert(apply_style+"======"+clicks);
                    // return false;
                    
                    //console.log(beforeNode);

                    // var beforeNode = tinymce.activeEditor.selection.getNode();
                    // if(beforeNode.nodeName.toLowerCase() != 'p') //$(beforeNode).prop('tagName')
                    //     beforeNode = $(beforeNode).closest('p')[0];
                    
                    // var ed = tinymce.activeEditor;
                    // //add an empty span with a unique id
                    // var endId = tinymce.DOM.uniqueId();
                    // ed.dom.add(beforeNode, 'span', {'id': endId}, '');
                    // //console.log(beforeNode);
                    // //select that span
                    // var newNode = ed.dom.select('span#' + endId);
                    // ed.selection.select(newNode[0]);
                    // $(newNode[0]).css({'font-size':'18.6667px', 'color': '#000', 'font-family': 'ms mincho, ｍｓ 明朝'})
                    //                 .attr('data-mce-style',"font-family: 'ms mincho', 'ｍｓ 明朝'; font-size: 18.6667px; color: #000;")
                    //                 .html('<br data-mce-bogus="1">');
                                    
                    timer = setTimeout(function () {
                        //$("#word_bold_mapping").val(0);
                        $("#font_1").removeClass('checked');
                        $("#font_2").removeClass('checked');
                        $("#font_3").removeClass('checked');
                        $("#font_4").removeClass('checked');
                        $("#font_5").removeClass('checked');
                        $("#font_1").addClass('checked');
                        tinymce.get('doc_content').execCommand("fontName", false, "ms mincho, ｍｓ 明朝");
                        $("#font_family_mapping").val(0);
                        
                        // change_font_size('18.666667px', 14);
                        tinymce.get('doc_content').execCommand('ForeColor', false, '#000000');
                        
                        // var beforeNode = tinymce.activeEditor.selection.getNode();
                        // if(beforeNode.nodeName.toLowerCase() != 'p') //$(beforeNode).prop('tagName')
                        // beforeNode = $(beforeNode).closest('p')[0];


                        

                        
                        
                        //tinymce.activeEditor.selection.getRng().startOffset = beforeNode.innerText.length;
                        
                        //var newLineNode = $(beforeNode).next('p');
                        //console.log(newLineNode[0]);
                        //newLineNode.find('span[data-mce-style]').css({'font-weight':'normal', 'font-size':'18.6667px', 'color': '#000', 'font-family': 'ms mincho, ｍｓ 明朝'}).attr('data-mce-style',"font-family: 'ms mincho', 'ｍｓ 明朝'; font-size: 18.6667px; color: #000;");
                        // var strongNode = newLineNode.find('strong');
                        // if(strongNode.length) {
                        //     strongNode[0].outerHTML = '<br data-mce-bogus="1">';
                        // }

                     }, DELAY);
                 }
                 else {

                    // $("#font_1").removeClass('checked');
                    // $("#font_2").removeClass('checked');
                    // $("#font_3").removeClass('checked');
                    // $("#font_4").removeClass('checked');
                    // $("#font_5").removeClass('checked');
                    // $("#font_1").addClass('checked');
                    // tinymce.get('doc_content').execCommand("fontName", false, "ms mincho, ｍｓ 明朝");
                    // $("#font_family_mapping").val(0);
                    
                    // change_font_size('18.666667px', 14);
                    // tinymce.get('doc_content').execCommand('ForeColor', false, '#000000');

                    // var newLineNode = $(beforeNode).next('p');
                    // console.log(newLineNode[0]);
                    // newLineNode.find('span[data-mce-style]').css({'font-weight':'normal', 'font-size':'18.6667px', 'color': '#000', 'font-family': 'ms mincho, ｍｓ 明朝'}).attr('data-mce-style',"font-family: 'ms mincho', 'ｍｓ 明朝'; font-size: 18.6667px; color: #000;");
                    // var strongNode = newLineNode.find('strong');
                    // if(strongNode.length) {
                    //     strongNode[0].outerHTML = '<br data-mce-bogus="1">';
                    // }

                //     // alert('clik:' + clicks);
                //     // var e = $.Event("keypress");
                //     // $(".alt_keypress").trigger('click');
                //     // $(".shift_keypress").trigger('click');

                //     // $("#alt-n").trigger('click');
                //     // $(window).focus();
                //     // var car = tinymce.activeEditor.getContent({format: 'text'});
                //     // var car = tinymce.activeEditor.getContent({format: 'text'});
                //     // alert(car);
                //     // car = car.replace(/su/g, "ã™");
                //     //$("#font_size_14").addClass('checked');
                //     // $(tinymce.activeEditor.selection.getNode()).after('<span style="font-size:18.6667px;color:black; ime-mode: active; font-family: ms mincho, ｍｓ 明朝">&nbsp;</span>');
                //     // tinymce.get("doc_content").execCommand('mceInsertContent', false, '<span style="font-size:18.6667px;color:black; ime-mode: active; font-family: ms mincho, ｍｓ 明朝">test&nbsp;<br>test2</span>');
                //     // document.execCommand('insertHTML', false, '<span style="font-size:18.6667px;color:black; ime-mode: active; font-family: ms mincho, ｍｓ 明朝">&nbsp;</span>');

                     clearTimeout(timer);
                     clicks = 0;
                 }
            }
            else {
                //clicks = 0;
                if (/* event.keyCode == 37 ||  */event.keyCode <= 38) {
                    if($(tinymce.activeEditor.dom.getPrev(tinymce.activeEditor.selection.getNode(), '*')).hasClass('page_separator')) {
                        event.preventDefault();
                        event.stopPropagation();
                        return false;
                    }
                }
                else if (/* event.keyCode == 39 ||  */event.keyCode <= 40) {
                    if($(tinymce.activeEditor.dom.getNext(tinymce.activeEditor.selection.getNode(), '*')).hasClass('page_separator')) {
                        event.preventDefault();
                        event.stopPropagation();
                        return false;
                    }
                }
            }
            
            // console.log('Editor was keypressed');
            // console.log(event.keyCode);
        });

        // editor.execCommand("fontName", false, "ms mincho, ｍｓ 明朝");
        editor.on('change keyup paste redo undo', function (event) {
            if (event.type == 'paste') {
                $("#event_mapping").val(1);
            } 
            var event_mapping = $("#event_mapping").val();


            // var car = tinymce.activeEditor.getContent({format: 'text'});
            // tinymce.triggerSave();
            // $("#doc_content").val();
            // var pressedKey = String.fromCharCode(event.keyCode);
            // alert(pressedKey);
            // var $txt1 = $('#doc_content');
            // e.preventDefault();
            // if (pressedKey == 'a') {
            //     $txt1.val($txt1.val() + 'z');
            // }

            // var val=$("#doc_content").val();
            //
            // if (pressedKey == 'a') {
            //
            //     document.execCommand('insertHTML', false, 'あ');
            //
            // }


            // alert('hi');
            // alert(tinymce.activeEditor.selection.getNode().nodeName);
            // tinymce.activeEditor.dom.setStyle('add_custom_text', 'background-color', 'red');
            // tinyMCE.activeEditor.dom.setStyle(tinyMCE.activeEditor.dom.select('div'), 'background-color', 'red');
            if (tinymce.activeEditor.selection.getNode().nodeName.toLowerCase() === "img") {
                var img = tinymce.activeEditor.selection.getNode();
                // alert(img.width);
                // if(img.width==97){
                //     var image_width=img.width-50;
                // }else if(img.width>97){
                //     var image_width=img.width-201;
                // }else if(img.width>97){
                //     var image_width=img.width-201;
                // }


                var editor = tinymce.activeEditor;
                var tinymcePosition = $(editor.getContainer()).position();
                var toolbarPosition = $(editor.getContainer()).find(".mce-toolbar").first();
                var nodePosition = $(editor.selection.getNode()).position();


                if (img.id === 'img_diamond') {
                    // alert('hi');
                    if (img.width == 156) {
                        //alert('hi');
                        var left = nodePosition.left + 16;
                        var top = nodePosition.top + 70;
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'top', top + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'left', left + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'width', 'auto');
                    }
                    else if (img.width > 156 && img.width < 240) {
                        //alert('hi1');
                        var left = nodePosition.left + 50;
                        var top = nodePosition.top + 60;
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'top', top + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'left', left + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'width', 'auto');
                    }
                    else if (img.width < 156) {
                        //alert('hi2');
                        var left = nodePosition.left + 10;
                        var top = nodePosition.top + 30;
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'top', top + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'left', left + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'width', '50px');
                    }
                    else if (img.width > 256 && img.width < 350) {
                        //alert('hi3');
                        var left = nodePosition.left + 100;
                        var top = nodePosition.top + 130;
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'top', top + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'left', left + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'width', 'auto');
                    }
                    else if (img.width > 355) {
                        //alert('hi4');
                        var left = nodePosition.left + 200;
                        var top = nodePosition.top + 230;
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'top', top + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'left', left + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_diamond', 'width', 'auto');
                    }

                }

                if (img.id === 'img_rect') {
                    // alert('hi');
                    if (img.width == 100) {
                        var left = nodePosition.left + 16;
                        var top = nodePosition.top + 70;
                        tinymce.activeEditor.dom.setStyle('add_custom_text_rect', 'top', top + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_rect', 'left', left + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_rect', 'width', 'auto');
                    }
                    if (img.width > 100 && img.width < 340) {
                        var left = nodePosition.left + 116;
                        var top = nodePosition.top + 170;
                        tinymce.activeEditor.dom.setStyle('add_custom_text_rect', 'top', top + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_rect', 'left', left + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_rect', 'width', 'auto');
                    }
                    if (img.width < 100) {
                        var left = nodePosition.left + 10;
                        var top = nodePosition.top + 30;
                        tinymce.activeEditor.dom.setStyle('add_custom_text_rect', 'top', top + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_rect', 'left', left + 'px');
                        tinymce.activeEditor.dom.setStyle('add_custom_text_rect', 'width', '50px');
                    }

                }
            }

            if (event_mapping == 1) {
                $("#event_mapping").val(2);

                save_autometically();
            }

            setPageBreak();
        });

        editor.on('click', function (event) {
            var selNode = tinymce.activeEditor.selection.getNode();
            if($(selNode).hasClass('page_separator') || ($(selNode).attr('data-mce-bogus')=="all" && $(selNode).children('br').length > 0)) {
                tinymce.activeEditor.selection.select(tinymce.activeEditor.dom.select('p')[0]);
                event.preventDefault();
                event.stopPropagation();
                return false;
            }

            var img = tinymce.activeEditor.selection.getNode();
            var parent  = tinymce.activeEditor.dom.getParent(img,'span');
            var parent1  = tinymce.activeEditor.dom.getParent(img,'strong');
            var parent2  = tinymce.activeEditor.dom.getParent(parent1,'span');
            var get_parent2_font_size = tinymce.activeEditor.dom.getStyle(parent2, 'font-size', false);
            var get_font_size = tinymce.activeEditor.dom.getStyle(img, 'font-size', false);
            var get_parent_font_size = tinymce.activeEditor.dom.getStyle(parent, 'font-size', false);
            var get_single_node_font_size = tinymce.activeEditor.dom.getStyle(img, 'font-size', false)
            get_font_size=parseInt(get_font_size);
            get_parent_font_size=parseInt(get_parent_font_size);
            get_parent2_font_size=parseInt(get_parent2_font_size);
            get_single_node_font_size=parseInt(get_single_node_font_size);
            // console.log(get_parent2_font_size);
            // if (get_font_size == '10.666667px' || get_font_size == '10.6667px') {
            if (get_font_size == 10 || get_parent_font_size==10 || get_parent2_font_size==10 || get_single_node_font_size==10) {
                $(".font_size").removeClass('checked');
                $("#font_size_8").addClass('checked');
            } else if (get_font_size == 13 || get_parent_font_size==13 || get_parent2_font_size==13 || get_single_node_font_size==13) {
                $(".font_size").removeClass('checked');
                $("#font_size_10").addClass('checked');
            } else if (get_font_size == 16 || get_parent_font_size==16 || get_parent2_font_size==16 || get_single_node_font_size==16) {
                $(".font_size").removeClass('checked');
                $("#font_size_12").addClass('checked');
            } else if (get_font_size == 18 || get_parent_font_size==18 || get_parent2_font_size==18 || get_single_node_font_size==18) {
                $(".font_size").removeClass('checked');
                $("#font_size_14").addClass('checked');
            } else if (get_font_size == 21 || get_parent_font_size==21 || get_parent2_font_size==21 || get_single_node_font_size==21) {
                $(".font_size").removeClass('checked');
                $("#font_size_16").addClass('checked');
            } else if (get_font_size == 24 || get_parent_font_size==24 || get_parent2_font_size==24 || get_single_node_font_size==24) {
                $(".font_size").removeClass('checked');
                $("#font_size_18").addClass('checked');
            } else if (get_font_size == 26 || get_parent_font_size==26 || get_parent2_font_size==26 || get_single_node_font_size==26) {
                $(".font_size").removeClass('checked');
                $("#font_size_20").addClass('checked');
            } else if (get_font_size == 29 || get_parent_font_size==29 || get_parent2_font_size==29 || get_single_node_font_size==29) {
                $(".font_size").removeClass('checked');
                $("#font_size_22").addClass('checked');
            } else if (get_font_size == 32 || get_parent_font_size==32 || get_parent2_font_size==32 || get_single_node_font_size==32) {
                $(".font_size").removeClass('checked');
                $("#font_size_24").addClass('checked');
            } else if (get_font_size == 34 || get_parent_font_size==34 || get_parent2_font_size==34 || get_single_node_font_size==34) {
                $(".font_size").removeClass('checked');
                $("#font_size_26").addClass('checked');
            } else if (get_font_size == 37 || get_parent_font_size==37 || get_parent2_font_size==37 || get_single_node_font_size==37) {
                $(".font_size").removeClass('checked');
                $("#font_size_28").addClass('checked');
            } else if (get_font_size == 40 || get_parent_font_size==40 || get_parent2_font_size==40 || get_single_node_font_size==40) {
                $(".font_size").removeClass('checked');
                $("#font_size_30").addClass('checked');
            } else if (get_font_size == 42 || get_parent_font_size==42 || get_parent2_font_size==42 || get_single_node_font_size==42) {
                $(".font_size").removeClass('checked');
                $("#font_size_32").addClass('checked');
            } else if (get_font_size == 45 || get_parent_font_size==45 || get_parent2_font_size==45 || get_single_node_font_size==45) {
                $(".font_size").removeClass('checked');
                $("#font_size_34").addClass('checked');
            } else if (get_font_size == 48 || get_parent_font_size==48 || get_parent2_font_size==48 || get_single_node_font_size==48) {
                $(".font_size").removeClass('checked');
                $("#font_size_36").addClass('checked');
            } else if (get_font_size == NaN) {
                $(".font_size").removeClass('checked');
                $("#font_size_12").addClass('checked');
            }else{
                $(".font_size").removeClass('checked');
                $("#font_size_12").addClass('checked');
            }
            // console.log(tinymce.activeEditor.dom.getStyle(img, 'font-size', false));
            // alert(img.id);
            // test_function();
            if (img.id === 'canvasShapesImage') {
                $("#word_canvase_aria1").removeClass('hide').addClass('show');
                var canvas2 = new fabric.Canvas('WordCanvas1');

                //
                // // var img = tinymce.activeEditor.selection.getContent({format: "IMG"});
                // var newCanvas = document.createElement("canvas");
                // // console.log(newCanvas);
                // newCanvas.width = img.width;
                // newCanvas.height = img.height;
                // var ctx = newCanvas.getContext("2d");
                // ctx.drawImage(img, 0, 0);
                // var data = newCanvas.toDataURL("image/png");

                // var url = URL.createObjectURL(data);


                fabric.Image.fromURL(img.src, function (img) {
                    var oImg = img.set({left: 60, top: 60, angle: 0}).scale(0.9);
                    canvas2.add(oImg).renderAll();
                    canvas2.setActiveObject(oImg);
                    // var dataURL = canvas.toDataURL('png');
                    //  console.log(dataURL);
                });


                // var imgPng =tinymce.activeEditor.selection.getContent({format : "IMG"});
                // var dataURL = imgPng.toDataURL('svg');
                // $('#mceu_10').hide();
                // alert(tinymce.activeEditor.selection.getContent({format : "IMG"}));

            }

            // start table cell calculation like excel sheet

            //************ calculation for column1 ************
            var arr = tinymce.activeEditor.dom.select('td.amount_a_col1');
            if (arr != '') {
                var tot = 0;
                for (var i = 0; i < arr.length; i++) {
                    var value = arr[i].innerHTML.replace('&nbsp;', '');
                    value = comma_input(value);
                    tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td.amount_a_col1')[i], value);
                    value = arr[i].innerHTML.replace(',', '');

                    // console.log(value1);
                    if (value)
                        tot += parseInt(value);
                }
                //comma separator
                var tot1 = comma_input(tot);


                var tot_b = 0;
                var tot_b = tinymce.activeEditor.dom.select('td#subtotal_of_b')[0];
                tot_b = tot_b.innerHTML.replace('&nbsp;', '');
                // tot_b = tot_b.innerHTML.replace(',', '');

                //comma separator
                var comma_val = comma_input(tot_b);

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_b'), comma_val);

                var tot_b1 = tinymce.activeEditor.dom.select('td#subtotal_of_b')[0];
                tot_b1 = tot_b1.innerHTML.replace(',', '');
                var subtotal_of_c = tot - tot_b1; //a-b=c

                subtotal_of_c = comma_input(subtotal_of_c);//a-b=c

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_a'), tot1);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_c'), subtotal_of_c);


                //////////////////////////////////////
                var arr_d = tinymce.activeEditor.dom.select('td.amount_d_col1');
                var tot_d = 0;
                for (var i = 0; i < arr_d.length; i++) {
                    var value_d = arr_d[i].innerHTML.replace('&nbsp;', '');
                    value_d = comma_input(value_d);
                    tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td.amount_d_col1')[i], value_d);
                    value_d = arr_d[i].innerHTML.replace(',', '');
                    if (value_d)
                        tot_d += parseInt(value_d);
                }
                var tot_d1 = comma_input(tot_d);

                var income_of_d_col1 = 0;
                var income_of_d_col1 = tinymce.activeEditor.dom.select('td#income_of_d_col1')[0];
                income_of_d_col1 = income_of_d_col1.innerHTML.replace('&nbsp;', ''); //f
                income_of_d_col1 = comma_input(income_of_d_col1); //f

                var expenditure_of_d_col1 = 0;
                var expenditure_of_d_col1 = tinymce.activeEditor.dom.select('td#expenditure_of_d_col1')[0];
                expenditure_of_d_col1 = expenditure_of_d_col1.innerHTML.replace('&nbsp;', ''); //g
                expenditure_of_d_col1 = comma_input(expenditure_of_d_col1); //g

                var int_expenditure_of_d_col1 = tinymce.activeEditor.dom.select('td#expenditure_of_d_col1')[0];
                int_expenditure_of_d_col1 = int_expenditure_of_d_col1.innerHTML.replace(',', '');


                var subtotal_of_c = tinymce.activeEditor.dom.select('td#subtotal_of_c')[0];

                subtotal_of_c = subtotal_of_c.innerHTML.replace(',', '');
                var subtotal_of_c = subtotal_of_c - tot_d; // c-d=e
                var subtotal_of_c1 = comma_input(subtotal_of_c);
                // console.log(subtotal_of_c);

                var int_income_of_d_col1 = tinymce.activeEditor.dom.select('td#income_of_d_col1')[0];
                int_income_of_d_col1 = int_income_of_d_col1.innerHTML.replace(',', '');
                var subtractionE_of_d_col1 = int_income_of_d_col1 - int_expenditure_of_d_col1; //f-g=h;

                var comma_subtractionE_of_d_col1 = comma_input(subtractionE_of_d_col1); //f-g=h;
                var int_subtractionE_of_d_col1 = tinymce.activeEditor.dom.select('td#subtractionE_of_d_col1')[0]; //f-g=h;

                var total_of_d_col1 = subtotal_of_c - subtractionE_of_d_col1; //e-h
                total_of_d_col1 = comma_input(total_of_d_col1); //e-h
                // alert(income_of_d_col1);
                if (income_of_d_col1 == '' || expenditure_of_d_col1 == '') {
                    tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtractionE_of_d_col1'), 0);

                    tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#total_of_d_col1'), 0);
                } else {
                    tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtractionE_of_d_col1'), comma_subtractionE_of_d_col1);

                    tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#total_of_d_col1'), total_of_d_col1);
                }

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_d_col1'), tot_d1);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtraction_of_d_col1'), subtotal_of_c1);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#income_of_d_col1'), income_of_d_col1);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#expenditure_of_d_col1'), expenditure_of_d_col1);


                //************ calculation for column2 ************
                var arr2 = tinymce.activeEditor.dom.select('td.amount_a_col2');
                var tot2 = 0;
                for (var i2 = 0; i2 < arr2.length; i2++) {
                    var value2 = arr2[i2].innerHTML.replace('&nbsp;', '');
                    if (value2)
                        tot2 += parseInt(value2);
                }

                var tot_b2 = 0;
                var tot_b2 = tinymce.activeEditor.dom.select('td#subtotal_of_b_col2')[0];
                tot_b2 = tot_b2.innerHTML.replace('&nbsp;', '');

                var subtotal_of_c2 = tot2 - tot_b2; //a-b=c

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_a_col2'), tot2);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_c_col2'), subtotal_of_c2);


                //////////////////////////////////////
                var arr_d2 = tinymce.activeEditor.dom.select('td.amount_d_col2');
                var tot_d2 = 0;
                for (var i2 = 0; i2 < arr_d2.length; i2++) {
                    var value_d2 = arr_d2[i2].innerHTML.replace('&nbsp;', '');
                    if (value_d2)
                        tot_d2 += parseInt(value_d2);
                }

                var subtotal_of_c2 = subtotal_of_c2 - tot_d2; // c-d=e

                var income_of_d_col2 = 0;
                var income_of_d_col2 = tinymce.activeEditor.dom.select('td#income_of_d_col2')[0];
                income_of_d_col2 = income_of_d_col2.innerHTML.replace('&nbsp;', ''); //f

                var expenditure_of_d_col2 = 0;
                var expenditure_of_d_col2 = tinymce.activeEditor.dom.select('td#expenditure_of_d_col2')[0];
                expenditure_of_d_col2 = expenditure_of_d_col2.innerHTML.replace('&nbsp;', ''); //g

                var subtractionE_of_d_col2 = income_of_d_col2 - expenditure_of_d_col2; //f-g=h; f=a,g=d
                var total_of_d_col2 = subtotal_of_c2 - subtractionE_of_d_col2; //e-h

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_d_col2'), tot_d2);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtraction_of_d_col2'), subtotal_of_c2);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#income_of_d_col2'), income_of_d_col2);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#expenditure_of_d_col2'), expenditure_of_d_col2);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtractionE_of_d_col2'), subtractionE_of_d_col2);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#total_of_d_col2'), total_of_d_col2);

                //************ calculation for column3 ************
                var arr3 = tinymce.activeEditor.dom.select('td.amount_a_col3');
                var tot3 = 0;
                for (var i3 = 0; i3 < arr3.length; i3++) {
                    var value3 = arr3[i3].innerHTML.replace('&nbsp;', '');
                    if (value3)
                        tot3 += parseInt(value3);
                }

                var tot_b3 = 0;
                var tot_b3 = tinymce.activeEditor.dom.select('td#subtotal_of_b_col3')[0];
                tot_b3 = tot_b3.innerHTML.replace('&nbsp;', '');

                var subtotal_of_c3 = tot3 - tot_b3; //a-b=c

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_a_col3'), tot3);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_c_col3'), subtotal_of_c3);


                //////////////////////////////////////
                var arr_d3 = tinymce.activeEditor.dom.select('td.amount_d_col3');
                var tot_d3 = 0;
                for (var i3 = 0; i3 < arr_d3.length; i3++) {
                    var value_d3 = arr_d3[i3].innerHTML.replace('&nbsp;', '');
                    if (value_d3)
                        tot_d3 += parseInt(value_d3);
                }

                var subtotal_of_c3 = subtotal_of_c3 - tot_d3; // c-d=e

                var income_of_d_col3 = 0;
                var income_of_d_col3 = tinymce.activeEditor.dom.select('td#income_of_d_col3')[0];
                income_of_d_col3 = income_of_d_col3.innerHTML.replace('&nbsp;', ''); //f

                var expenditure_of_d_col3 = 0;
                var expenditure_of_d_col3 = tinymce.activeEditor.dom.select('td#expenditure_of_d_col3')[0];
                expenditure_of_d_col3 = expenditure_of_d_col3.innerHTML.replace('&nbsp;', ''); //g
                var subtractionE_of_d_col3 = income_of_d_col3 - expenditure_of_d_col3; //f-g=h; f=a,g=d
                var total_of_d_col3 = subtotal_of_c3 - subtractionE_of_d_col3; //e-h

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_d_col3'), tot_d3);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtraction_of_d_col3'), subtotal_of_c3);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#income_of_d_col3'), income_of_d_col3);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#expenditure_of_d_col3'), expenditure_of_d_col3);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtractionE_of_d_col3'), subtractionE_of_d_col3);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#total_of_d_col3'), total_of_d_col3);

                //************ calculation for column4 ************
                var arr4 = tinymce.activeEditor.dom.select('td.amount_a_col4');
                var tot4 = 0;
                for (var i4 = 0; i4 < arr4.length; i4++) {
                    var value4 = arr4[i4].innerHTML.replace('&nbsp;', '');
                    if (value4)
                        tot4 += parseInt(value4);
                }

                var tot_b4 = 0;
                var tot_b4 = tinymce.activeEditor.dom.select('td#subtotal_of_b_col4')[0];
                tot_b4 = tot_b4.innerHTML.replace('&nbsp;', '');

                var subtotal_of_c4 = tot4 - tot_b4; //a-b=c

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_a_col4'), tot4);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_c_col4'), subtotal_of_c4);


                //////////////////////////////////////
                var arr_d4 = tinymce.activeEditor.dom.select('td.amount_d_col4');
                var tot_d4 = 0;
                for (var i4 = 0; i4 < arr_d4.length; i4++) {
                    var value_d4 = arr_d4[i4].innerHTML.replace('&nbsp;', '');
                    if (value_d4)
                        tot_d4 += parseInt(value_d4);
                }

                var subtotal_of_c4 = subtotal_of_c4 - tot_d4; // c-d=e

                var income_of_d_col4 = 0;
                var income_of_d_col4 = tinymce.activeEditor.dom.select('td#income_of_d_col4')[0];
                income_of_d_col4 = income_of_d_col4.innerHTML.replace('&nbsp;', ''); //f

                var expenditure_of_d_col4 = 0;
                var expenditure_of_d_col4 = tinymce.activeEditor.dom.select('td#expenditure_of_d_col4')[0];
                expenditure_of_d_col4 = expenditure_of_d_col4.innerHTML.replace('&nbsp;', ''); //g
                var subtractionE_of_d_col4 = income_of_d_col4 - expenditure_of_d_col4; //f-g=h; f=a,g=d
                var total_of_d_col4 = subtotal_of_c4 - subtractionE_of_d_col4; //e-h

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_d_col4'), tot_d4);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtraction_of_d_col4'), subtotal_of_c4);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#income_of_d_col4'), income_of_d_col4);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#expenditure_of_d_col4'), expenditure_of_d_col4);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtractionE_of_d_col4'), subtractionE_of_d_col4);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#total_of_d_col4'), total_of_d_col4);

                //************ calculation for column5 ************
                var arr5 = tinymce.activeEditor.dom.select('td.amount_a_col5');
                var tot5 = 0;
                for (var i5 = 0; i5 < arr5.length; i5++) {
                    var value5 = arr5[i5].innerHTML.replace('&nbsp;', '');
                    if (value5)
                        tot5 += parseInt(value5);
                }

                var tot_b5 = 0;
                var tot_b5 = tinymce.activeEditor.dom.select('td#subtotal_of_b_col5')[0];
                tot_b5 = tot_b5.innerHTML.replace('&nbsp;', '');

                var subtotal_of_c5 = tot5 - tot_b5; //a-b=c

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_a_col5'), tot5);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_c_col5'), subtotal_of_c5);


                //////////////////////////////////////
                var arr_d5 = tinymce.activeEditor.dom.select('td.amount_d_col5');
                var tot_d5 = 0;
                for (var i5 = 0; i5 < arr_d5.length; i5++) {
                    var value_d5 = arr_d5[i5].innerHTML.replace('&nbsp;', '');
                    if (value_d5)
                        tot_d5 += parseInt(value_d5);
                }

                var subtotal_of_c5 = subtotal_of_c5 - tot_d5; // c-d=e

                var income_of_d_col5 = 0;
                var income_of_d_col5 = tinymce.activeEditor.dom.select('td#income_of_d_col5')[0];
                income_of_d_col5 = income_of_d_col5.innerHTML.replace('&nbsp;', ''); //f

                var expenditure_of_d_col5 = 0;
                var expenditure_of_d_col5 = tinymce.activeEditor.dom.select('td#expenditure_of_d_col5')[0];
                expenditure_of_d_col5 = expenditure_of_d_col5.innerHTML.replace('&nbsp;', ''); //g
                var subtractionE_of_d_col5 = income_of_d_col5 - expenditure_of_d_col5; //f-g=h; f=a,g=d
                var total_of_d_col5 = subtotal_of_c5 - subtractionE_of_d_col5; //e-h

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_d_col5'), tot_d5);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtraction_of_d_col5'), subtotal_of_c5);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#income_of_d_col5'), income_of_d_col5);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#expenditure_of_d_col5'), expenditure_of_d_col5);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtractionE_of_d_col5'), subtractionE_of_d_col5);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#total_of_d_col5'), total_of_d_col5);


                //************ calculation for column6 ************
                var arr6 = tinymce.activeEditor.dom.select('td.amount_a_col6');
                var tot6 = 0;
                for (var i6 = 0; i6 < arr6.length; i6++) {
                    var value6 = arr6[i6].innerHTML.replace('&nbsp;', '');
                    if (value6)
                        tot6 += parseInt(value6);
                }

                var tot_b6 = 0;
                var tot_b6 = tinymce.activeEditor.dom.select('td#subtotal_of_b_col6')[0];
                tot_b6 = tot_b6.innerHTML.replace('&nbsp;', '');

                var subtotal_of_c6 = tot6 - tot_b6; //a-b=c

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_a_col6'), tot6);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_c_col6'), subtotal_of_c6);


                //////////////////////////////////////
                var arr_d6 = tinymce.activeEditor.dom.select('td.amount_d_col6');
                var tot_d6 = 0;
                for (var i6 = 0; i6 < arr_d6.length; i6++) {
                    var value_d6 = arr_d6[i6].innerHTML.replace('&nbsp;', '');
                    if (value_d6)
                        tot_d6 += parseInt(value_d6);
                }

                var subtotal_of_c6 = subtotal_of_c6 - tot_d6; // c-d=e

                var income_of_d_col6 = 0;
                var income_of_d_col6 = tinymce.activeEditor.dom.select('td#income_of_d_col6')[0];
                income_of_d_col6 = income_of_d_col6.innerHTML.replace('&nbsp;', ''); //f

                var expenditure_of_d_col6 = 0;
                var expenditure_of_d_col6 = tinymce.activeEditor.dom.select('td#expenditure_of_d_col6')[0];
                expenditure_of_d_col6 = expenditure_of_d_col6.innerHTML.replace('&nbsp;', ''); //g
                var subtractionE_of_d_col6 = income_of_d_col6 - expenditure_of_d_col6; //f-g=h; f=a,g=d
                var total_of_d_col6 = subtotal_of_c6 - subtractionE_of_d_col6; //e-h

                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtotal_of_d_col6'), tot_d6);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtraction_of_d_col6'), subtotal_of_c6);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#income_of_d_col6'), income_of_d_col6);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#expenditure_of_d_col6'), expenditure_of_d_col6);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#subtractionE_of_d_col6'), subtractionE_of_d_col6);
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('td#total_of_d_col6'), total_of_d_col6);
            }
            var node = editor.selection.getContent({format : 'text'});
            var nodeEl = editor.selection.getContent();


            if (node.length>0) {                
                $(".btn-warning, .btn-danger").focus();
            } else {
                if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    $(".btn_keipro").removeAttr("disabled");
                    $(".close_aria, .font_color_aria, #word_function_aria, #word_image_selection_message, #font_size_aria, .font_family_aria").addClass('hide').removeClass('show');
                    $("#table_of_contantes").addClass('hide').removeClass('show');
                }
            }
            
           
        });
        // editor.on('touchstart', function (event) {
            // var node = editor.selection.getContent({format : 'text'});
            // console.log(node);
            // $(".btn_keipro").removeAttr("disabled");
            // $(".close_aria, .font_color_aria, #word_function_aria, #word_image_selection_message, #font_size_aria, .font_family_aria").addClass('hide').removeClass('show');
            // $("#table_of_contantes").addClass('hide').removeClass('show');
        // });
        editor.on('touchend', function(event) {

            var node = editor.selection.getContent({format : 'text'});
            if (node.length>0) {
                // editor.dom.addClass(editor.selection.getNode(), 'scrollTop');
                // $(tinymce.activeEditor.getBody()).find('.scrollTop').get(0).scrollIntoView();
                // Removes a class from all paragraphs in the active editor
                // editor.dom.removeClass(editor.dom.select('p, span'), 'scrollTop');
                // $(".btn-warning, .btn-danger, #font_family").focus();
                $("#font_family").focus()
            } else {
                $(".btn_keipro").removeAttr("disabled");
                $(".close_aria, .font_color_aria, #word_function_aria, #word_image_selection_message, #font_size_aria, .font_family_aria").addClass('hide').removeClass('show');
                $("#table_of_contantes").addClass('hide').removeClass('show');
            }
        });
    }
});

function comma_input(val) {
    // skip for arrow keys
    var result = val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    return result;
}

function insertAtCursor(myField, myValue) {
    //IE support
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = myValue;
    }
    // Microsoft Edge
    else if (window.navigator.userAgent.indexOf("Edge") > -1) {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;

        myField.value = myField.value.substring(0, startPos) + myValue
            + myField.value.substring(endPos, myField.value.length);

        var pos = startPos + myValue.length;
        myField.focus();
        myField.setSelectionRange(pos, pos);
    }
    //MOZILLA and others
    else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value = myField.value.substring(0, startPos)
            + myValue
            + myField.value.substring(endPos, myField.value.length);
    } else {
        myField.value += myValue;
    }
}

function change_font_family(font_name) {
    event.preventDefault();
    $("#font_family_mapping").val(1);
    $("#apply_style").val(1);
    $("#font_1").removeClass('checked');
    $("#font_2").removeClass('checked');
    $("#font_3").removeClass('checked');
    $("#font_4").removeClass('checked');
    $("#font_5").removeClass('checked');
    $("#font_size_mapping").val(1);
    $("#font_color_mapping").val(1);
    $("#font_color_code_mapping").val("#000000");
    $("#font_size_number_mapping").val("18.666667px");
    var checked_font = "font_1";
    if (font_name == "ms gothic, ｍｓ ゴシック") {
        checked_font = "font_2"
    }
    if (font_name == "hg行書体,hgp行書体,cursive") {
        checked_font = "font_3";
    }
    if (font_name == "hg丸ｺﾞｼｯｸm-pro,hg正楷書体-pro,ms ui gothic") {
        checked_font = "font_4";
    }
    if (font_name == "hgp創英角ﾎﾟｯﾌﾟ体,hg創英角ﾎﾟｯﾌﾟ体") {
        checked_font = "font_5";
    }
    $("#change_font_family").val(font_name);
    // if (! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        tinymce.get('doc_content').execCommand("fontName", false, font_name);
        $("#close_family_aria").focus();
    // }
    $("#" + checked_font).addClass('checked');
}

function word_undo() {
    tinymce.get('doc_content').execCommand('Undo');
}

function font_width() {
    $("#word_bold_mapping").val(1);
    $("#apply_style").val(1);
    tinymce.get('doc_content').execCommand('Bold', false, 'doc_content');
}



function print_word() {
    if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('[data-toggle="popover"]').popover('hide');
        tinymce.activeEditor.execCommand('mcePrint');
    }else{
        $('[data-toggle="popover"]').popover('hide');
        tinymce.activeEditor.execCommand('mcePrint');
    }
    

    // sel_content = tinymce.activeEditor.selection.getContent();
    // $('.print-preview-paper-size').val("A4");
    // html2pdf();
}


/*Start Saif Programming Update*/

function CountPagesPDF(url){
    var count = 0;
    var pdfjsLib = window['pdfjs-dist/build/pdf'];

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

    // Asynchronous download of PDF
    var loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(function(pdf) {
        count = pdf.numPages;
        $("#pp-navi-page-count").text(count);
    }, function (reason) {
        console.error(reason);
    });

}

function html2pdf(size = 'A4', partial=0){
    var body ='';
    if(partial==0){body = tinymce.get('doc_content').getContent();}
    else { body = sel_content;}
    var base_url = $("#base_url").val();
    var aurl = base_url + "tcpdf/bin/generatepdf.php";

    $.ajax({
        url: aurl,
        type: 'POST',
        data: { body: body, size: size },
        dataType: 'json',
        cache: false,
        beforeSend: function(){
            $("#print-preview-popup").show();
            $(".print-preview-pdfcontent").hide();
            $(".print-preview-pdfcontent").attr('src', "");
            $(".print-pdf-loading").show();
        },
        success: function (resp) {
            // console.log(resp);
            $(".print-preview-pdfcontent").show();
            $(".print-pdf-loading").hide();

            if(resp.status=='success')
            {
                url = base_url+'tcpdf/bin/'+ resp.url + '#toolbar=0&navpanes=0';
                $(".print-preview-pdfcontent").attr('src', url);
                CountPagesPDF(url);
            }
        },
        error: function (x,t,e) {
            console.log(x);
        }
    });
}

function custom_print(size='a4',partial=0) {
    var doc = new jsPDF('p','mm',size);
    var fileName = 'a4.pdf';
    if(partial==0)
        var stringHtml = tinymce.get('doc_content').getContent();
    else
        var stringHtml = sel_content;

    stringHtml = '<html lang="jp"><head><meta charset="utf-8"><style>@font-face {font-family: "ms mincho"; src: url("MSMINCHO.TTF") format("truetype"); font-weight: normal;}</style></head><body style="font-family : \'ms mincho\'">下左右中大</body>';



    //doc.addFont('NotoSansCJKjp-Regular.ttf', 'NotoSansCJKjp', 'normal');
    //doc.setFont('NotoSansCJKjp');
    doc.fromHTML(stringHtml, 15, 15, {'width': 180});
    // doc.fromHTML("<h2>見出し表示</h2>", 15, 15, {'width': 180});
    var url = doc.output('bloburl', {filename: fileName}) + '#toolbar=0&navpanes=0';
    $(".print-preview-pdfcontent").attr('src', url);
    $("#print-preview-popup").show();
    CountPagesPDF(url);
}


var sel_content = '';
var page_size = 'a4';



//Sidebar btn Partial Print
$(document).on("click", ".print-preview-selection", function() {
    $(".pp-navi-partial").fadeIn();
});

//Sidebar btn Page Count
$(document).on("click", ".print-preview-pagecount", function() {
    $(".pp-navi").fadeIn();
});

//Sidebar btn Print out
$(document).on("click", ".print-preview-printout", function() {
    tinymce.activeEditor.execCommand('mcePrint');
    // $(".pp-navi-finish").fadeIn();
    // var url = $(".print-preview-pdfcontent").attr('src');
    // printJS(url);
});

$(document).on("click", ".pp-navi-cancel", function() {
    $(this).parents(".pp-navi").fadeOut();
});

$(document).on("click", ".pp-navi-success", function() {
    $(this).parents(".pp-navi").fadeOut();
    $(".print-preview-printout").removeAttr('disabled');
});

$(document).on("click", ".pp-navi-partial-cancel", function() {
    $(this).parents(".pp-navi-partial").fadeOut();
    //custom_print(page_size);
    html2pdf(page_size);
});

$(document).on("click", ".pp-navi-partial-success", function() {
    $(this).parents(".pp-navi-partial").fadeOut();
    //custom_print(page_size,1);
    html2pdf(page_size,1);
});

//Sidebar btn Cancel
$(document).on("click", ".print-preview-cancel", function() {
    $(".pp-navi").hide();
    $(".pp-navi-finish").hide();
    $(".pp-navi-partial").hide();
    $(this).parents("#print-preview-popup").fadeOut();
});

$(document).on("change", ".print-preview-paper-size", function(){
    page_size = $(this).val();
    if(page_size=='' || page_size==undefined)
        return;
    else {
        html2pdf(page_size);
    }
});



/*End Saif Programming*/



function word_font_color(color_code) {
    $("#font_color_mapping").val(1);
    $("#apply_style").val(1);
    $("#font_color_code_mapping").val("#000000");
    $("#word_font_color").val(color_code);
    // if (! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $("#font_color_code_mapping").val(color_code);
        // Alerts the currently selected elements node name
        var nodTag = tinyMCE.activeEditor.selection.getNode();   
        
        
        if (nodTag.nodeName.toLowerCase() === "span" || nodTag.nodeName.toLowerCase() === "font"){ 
            $(nodTag).attr('color', "");
            var style = $(nodTag).attr('style');
            if (typeof style !== 'undefined'){
                var style_list = style.split(';');
                var newStyle = "";
                for (var i = 0; i <style_list.length; i++) {
                    if (style_list[i] != 'color') {
                        newStyle += style_list[i]+";";
                    }                
                }
                $(nodTag).attr('style', newStyle)
            }
            
        }
        tinymce.get('doc_content').execCommand('ForeColor', false, color_code);
        $("#close_font_color_aria").focus();
    // }
    
}

function find_replace() {
    tinymce.get('doc_content').execCommand('searchreplace');
}

function word_special_cherecter() {
    tinymce.get('doc_content').execCommand('mceShowCharmap');
}

function word_cut() {
    tinyMCE.execCommand('cut');
    $("#font_cut_copy_aria").removeClass('hide').addClass('show');
    $("#word_function_aria").removeClass('show').addClass('hide');
    $("#close_copy_cut_aria").focus();
    $("#font_cut_copy_aria_show").val(1);
}

function word_copy() {
    tinyMCE.execCommand('copy');
    $("#font_cut_copy_aria").removeClass('hide').addClass('show');
    $("#word_function_aria").removeClass('show').addClass('hide');
    $("#close_copy_cut_aria").focus();
    $("#font_cut_copy_aria_show").val(1);
}

function return_close() {
    $('.close_aria').removeClass('show').addClass('hide');
    // $(".close_aria").hide();
}

function message_close() {
    $('.message_close_aria').removeClass('show').addClass('hide');
    // $(".close_aria").hide();
}

function change_font_size(font_size, font_size_number) {

    $(".font_size").removeClass('checked');
    $('#font_size_' + font_size_number).addClass('checked');
    $("#font_size_mapping").val(1);
    $("#font_color_mapping").val(1);
    $("#apply_style").val(1);
    $("#font_size_number_mapping").val("18.666667px");
    $("#font_color_code_mapping").val("#000000");
    $("#change_font_size").val(font_size);
    // if (! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $("#change_font_size").val(font_size);
        tinymce.get('doc_content').execCommand("fontSize", false, font_size);
        $("#close_font_size_aria").focus();
    // }
    // tinymce.get('doc_content').execCommand("fontSize", false, font_size);
    // tinymce.get('doc_content2').execCommand("fontSize", false, font_size);
    // tinymce.get('doc_content3').execCommand("fontSize", false, font_size);
    // tinymce.get('doc_content4').execCommand("fontSize", false, font_size);
    // tinymce.get('doc_content5').execCommand("fontSize", false, font_size);
}

// Start Email Functions
function email_font_color(color_code) {
    tinymce.get('email_content').execCommand('ForeColor', false, color_code);
}

function email_change_font_family(font_name) {
    event.preventDefault();
    // $("#font_family_mapping").val(1);
    // $("#apply_style").val(1);
    $("#email_font_1").removeClass('checked');
    $("#email_font_2").removeClass('checked');
    $("#email_font_3").removeClass('checked');
    $("#email_font_4").removeClass('checked');
    $("#email_font_5").removeClass('checked');
    var checked_font = "email_font_1";
    if (font_name == "ms gothic, ｍｓ ゴシック") {
        checked_font = "email_font_2"
    }
    if (font_name == "hg行書体,hgp行書体,cursive") {
        checked_font = "email_font_3";
    }
    if (font_name == "hg丸ｺﾞｼｯｸm-pro,hg正楷書体-pro,ms ui gothic") {
        checked_font = "email_font_4";
    }
    if (font_name == "hgp創英角ﾎﾟｯﾌﾟ体,hg創英角ﾎﾟｯﾌﾟ体") {
        checked_font = "email_font_5";
    }
    tinymce.get('email_content').execCommand("fontName", false, font_name);
    $("#" + checked_font).addClass('checked');
}

function email_change_font_size(font_size, font_size_number) {
    $(".email_font_size").removeClass('checked');
    $('#email_font_size_' + font_size_number).addClass('checked');
    $("#email_font_size_mapping").val(1);
    $("#email_font_size_number_mapping").val("18.666667px");
    tinymce.get('email_content').execCommand("fontSize", false, font_size);
}

function save_autometically() {
    delay(function () {
        var post_id = $("#post_id").val();
        // var content = tinymce.activeEditor.getContent();
        var content = '';
        var get_page_count = localStorage.getItem("page_count");

        
        content = tinymce.activeEditor.getContent();
        var temp_title = strip(content);
        temp_title = temp_title.replace(/&nbsp;/gi, '');
        temp_title = temp_title.replace(/\n|\r/g, "").trim();
        var post_title = temp_title.substring(0, 10);
        var base_url = $("#base_url").val();
        var url = base_url + 'index.php/wordapp/save';

        if (post_title.trim().length > 0) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {post_id: post_id, post_title: post_title, post_details: content},
            })

            .done(function (data, statusText, xhr) {
                var post = JSON.parse(data);                
                $('#post_id').attr('value', post.post_id);
                $('#current_open_file').attr('value', post.post_id);
                $('.internet_connection_alert').slideUp(400);
                console.log('save success');
            })
            .fail(function (data, statusText, xhr) {
                $('.internet_connection_alert').show().delay(750).slideDown(400);
                // console.log(xhr.status);
                // console.log(statusText);
                $("#event_mapping").val(1);
            })
            .always(function (data, statusText, xhr) {
                $("#event_mapping").val(1);
                // console.log(xhr.status);
                // console.log(statusText);
                // console.log("complete");
            });
        } else {
            $.ajax({
                url: 'index.php/wordapp/delete_post',
                type: 'POST',
                data: {post_id: post_id},
            })
                .done(function (data) {
                    if (data == 'success') {
                        $("#post_id").val("");
                    }
                    $('.internet_connection_alert').slideUp(400);
                    // console.log('success');
                })
                .fail(function (data, statusText, xhr) {
                    $('.internet_connection_alert').show().delay(750).slideDown(400);
                    // console.log('fail');
                    $("#event_mapping").val(1);
                })
                .always(function () {
                    // console.log("complete");
                    $("#event_mapping").val(1);
                });
        }
    }, 1000);
}

function strip(html) {
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
}

function autoPageBreak(font_size, val) {
    var val = val * 2;

    if (font_size == val) {
        tinymce.activeEditor.insertContent('<!-- pagebreak -->');
    }
    // console.log(font_size + '===' + val);
    // console.log($(tinyMCE.activeEditor.getContainer()).height());
    if (val < font_size) {
        autoPageBreak(font_size, val);
    }
}

function rearrange1(str) {
    // tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('p'), 'xdbsdb');
    var len = str.length;
    // if ((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
    // {
    //     var text_cut = 1188;
    // }
    // else {
    var text_cut = 1500;
    // }
    var loop = len / text_cut;
//        document.write(loop);
//        document.write('<br>');
    var final = "";
    for (var i = 0; i <= loop; i++) {
//            document.write( str.slice( i*3000, (i*3000)+3000) );
//            document.write('<div style="width:99%;border-bottom: 1px solid #ccc;"></div>');

        var vv = str.slice(i * text_cut, (i * text_cut) + text_cut);

        // var vv1='<div style="width:99%;border: 1px dashed #000; margin: 10px 0; height: 5px;"></div>';
        final += '<div id="paginatedText"><div class="page" style="padding: 0; width: 650px;min-height: 864px; height: 864px; word-wrap: break-word;">' + vv + '</div><div class="mce-pagebreak"></div> </div>';
        // final +=final;
        // tinymce.execCommand('mceInsertContent', false, final);
        // document.write(final);
    }
    // document.write(final);
    tinymce.activeEditor.setContent('');
    tinymce.activeEditor.setContent(final);

    // tinymce.execCommand('mceInsertContent', false, final);
}

function rearrange(text, length) {
    // alert(container_height);
    var chunks = splitText(text, false, length);
    var value = '';
    for (var i = 0; i < chunks.length; i++) {

        // console.log(chunks[i]+'=======');

        // tinymce.activeEditor.insertContent('<!-- pagebreak -->');
        value += '<div id="paginatedText"><div class="page">' + chunks[i] + '</div><div class="mce-pagebreak"></div></div>';
    }
    tinymce.activeEditor.setContent('');
    tinymce.activeEditor.setContent(value);
    // tinymce.execCommand('mceInsertContent', false, value);


}


function splitText(text, useRegex, length) {
    var chunkSize = length;//container_height/2;
    var chunks = [], i, textSize, boundary = 0;
    if (useRegex) {
        var regex = new RegExp('.{1,' + chunkSize + '}\\b', 'g');
        chunks = text.match(regex) || [];
    } else {
        for (i = 0, textSize = text.length; i < textSize; i = boundary) {
            boundary = i + chunkSize;
            if (boundary <= textSize && text.charAt(boundary) == ' ') {
                chunks.push(text.substring(i, boundary));
            } else {
                while (boundary <= textSize && text.charAt(boundary) != ' ') {
                    boundary++;
                }
                chunks.push(text.substring(i, boundary));
            }
        }
    }
    return chunks;
}

function paginateText(text) {

    var containsJapanese = text.match(/[\u3000-\u303f\u3040-\u309f\u30a0-\u30ff\uff00-\uff9f\u4e00-\u9faf\u3400-\u4dbf]/);

    if (containsJapanese)
        var result = text.toString().match(/.{12}/g).join(' ');
    else
        result = text;

    // var textArray1 = result.match(/(<[^>]*>|\w+)/g).join(',');
    //  var textArray = textArray1.split(',');
    var textArray = result.split(' '); // makes the text to an array of words
    // console.log(textArray);die();
    createPage(); // creates the first page
    for (var i = 0; i < textArray.length; i++) { // loops through all the words
        // console.log(textArray[i]+'===='+i);
        var success = appendToLastPage(textArray[i]); // tries to fill the word in the last page
        if (!success) { // checks if word could not be filled in last page
            createPage(); // create new empty page
            appendToLastPage(textArray[i]); // fill the word in the new last element
        }
    }
    // die();
}

function createPage() {
    tinymce.activeEditor.dom.setStyle(tinymce.activeEditor.dom.select('p'), 'display', 'none');

    var paginatedText = tinymce.activeEditor.dom.add(tinymce.activeEditor.getBody(), 'div', {id: 'paginatedText'}, '');

    var page = document.createElement("div"); // creates new html element
    var page_break = document.createElement("div"); // creates new html element
    page.setAttribute("class", "page"); // appends the class "page" to the element
    page.setAttribute("style", "padding: 0; width: 650px;min-height: 864px; height: 864px; word-wrap: break-word;"); // appends the class "page" to the element
    page_break.setAttribute("class", "mce-pagebreak"); // appends the class "page" to the element
    paginatedText.appendChild(page);
    paginatedText.appendChild(page_break);
    // var ff = tinymce.activeEditor.dom.select('div.page')[0];
    // console.log(ff.innerHTML.replace('style="display: none;" data-mce-style="display: none;"&gt;', ''));

}

function appendToLastPage(word) {

    var page = tinymce.activeEditor.dom.select('div.page')[tinymce.activeEditor.dom.select('div.page').length - 1];
    var pageText = page.innerHTML; // gets the text from the last page
    page.innerHTML += word + " "; // saves the text of the last page
    // console.log(page.innerHTML);
    if (page.offsetHeight < page.scrollHeight) { // checks if the page overflows (more words than space)
        page.innerHTML = pageText; //resets the page-text
        return false; // returns false because page is full
    } else {
        return true; // returns true because word was successfully filled in the page
    }
}
function paginatedTextOnPaste(id, page_count, text_content, text_content_length, k, i, containsJapanese, text_content_length1) {
    alert('hi');
    var value = '';
    var final_text = '';
    var k = 0 + k;
    // console.log(i + '===' + page_count);

    for (var j = k; j < text_content_length; j++) {
        if (containsJapanese) {
            final_text += text_content[j];
        } else {
            var text1 = text_content[j] + ' ';
            text1 = text1.replace('nbsp', ' ');
            final_text += text1;
        }
    }
    tinymce.editors[id].setContent(final_text);

    if (i == page_count) {
        var last_div_content = tinymce.editors[i].getContent();

        last_div_content = last_div_content.substring(0, last_div_content.indexOf("undefined"));
        if (last_div_content != '')
            tinymce.editors[i].setContent(last_div_content);
    }


    // var pp = $(tinymce.editors['doc_content'].getContainer()).height();
    // var pp1 = $(tinymce.editors[id].getContainer()).height();
    // console.log(pp + '-----height----' + pp1);
    localStorage.setItem("page_count", page_count);
    if (i < page_count) {
        var next_div_id = id + 1;
        var text_content_length = j + text_content_length1;
        console.log(j + '-----here--------' + text_content_length);
        var k = j;
        var i = i + 1;
        $('#fixed_editor' + i).show();
        // $('#page_count' + i).text('PAGE ' + i + ' OF ' + page_count);
        $('#page_count' + i).text('ページ ' + i + ' / ' + page_count);


        paginatedTextOnPaste(i, page_count, text_content, text_content_length, k, i, containsJapanese, text_content_length1);

    }
}
function paginatedText9999(id, page_count, text_content, text_content_length, k, i, containsJapanese, text_content_length1) {
    var value = '';
    var final_text = '';
    var k = 0 + k;
    console.log(i + '===' + page_count);

    // for (var j = k; j < text_content_length; j++) {
    //     if (containsJapanese) {
    //         final_text += text_content[j];
    //     } else {
    //         var text1 = text_content[j] + ' ';
    //         text1 = text1.replace('nbsp', ' ');
    //         final_text += text1;
    //     }
    // }
    // tinymce.editors[id].setContent(final_text);

    // if (i == page_count) {
    //     var last_div_content = tinymce.editors[i].getContent();
    //
    //     last_div_content = last_div_content.substring(0, last_div_content.indexOf("undefined"));
    //     if (last_div_content != '')
    //         tinymce.editors[i].setContent(last_div_content);
    // }


    // var pp = $(tinymce.editors['doc_content'].getContainer()).height();
    // var pp1 = $(tinymce.editors[id].getContainer()).height();
    // console.log(pp + '-----height----' + pp1);
    localStorage.setItem("page_count", page_count);
    if (i < page_count) {
        var next_div_id = id + 1;
        // var text_content_length = j + text_content_length1;
        // console.log(j + '-----here--------' + text_content_length);
        // var k = j;
        var i = i + 1;
        $('#fixed_editor' + i).show();
        tinymce.get('doc_content'+i).getBody().focus();
        // $('#page_count' + i).text('PAGE ' + i + ' OF ' + page_count);
        $('#page_count' + i).text('ページ ' + i + ' / ' + page_count);


        paginatedText9999(i, page_count, text_content, text_content_length, k, i, containsJapanese, text_content_length1);

    }
}

var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();