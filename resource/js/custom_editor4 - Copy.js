// Email Editor
tinymce.init({
    selector: '#email_content',
    menubar: false,
    statusbar: false,
    branding: false,
    language: 'ja',
    body_class: 'email_editor',
    plugins: "print searchreplace charmap autoresize",
    autoresize_min_height: 480,
    toolbar: false,
    content_css: 'resource/tinymce/skins/lightgray/content.css',
    // content_css : 'https://keipro.dhaka10.dev.jacos.jp/dev/resource/tinymce/skins/lightgray/content.css',

    init_instance_callback: function (ed) {
        ed.execCommand("fontName", false, "ms mincho, �搾ｽ� 譏取悃");
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
// Word app
tinymce.init({
    selector: '#doc_content',  // change this value according to your HTML
    menubar: false,
    statusbar: false,
    branding: false,
    language: 'ja',
    body_class: 'my_class',
    plugins: "print searchreplace charmap image imagetools pagebreak autoresize table",
    autoresize_min_height: 825,
//    width: 780,
//    max_width: 500,
    toolbar: false,
    table_default_styles: {
        fontWeight: 'bold',
        border: '1px'
    },
    visual_table_class: 'custom_table',
    valid_child_elements: "td/th[a|#text]",
    // contextmenu: "link image inserttable | cell row column deletetable",
    content_css: 'resource/tinymce/skins/lightgray/content.css',
    // content_style: "p {line-height:100%}",
    // extended_valid_elements: "*[*]",
    setup: function (editor) {
        var DELAY = 400, clicks = 0, timer = null;

        editor.on('keydown', function (event) {

            if (event.keyCode == 13) {

                // prevent press enter on table cell
                var arr = tinymce.activeEditor.dom.select('td.amount_a_col1');
                if (arr != '') {
                    event.preventDefault();
                    event.stopPropagation();
                    return false;
                }

                // start another pagebreak function

                var p_tag_arr = tinymce.activeEditor.dom.select('p');
                var span_tag_arr = tinymce.activeEditor.dom.select('span');
                if(p_tag_arr!='') {
                    tinymce.activeEditor.dom.setStyle(tinymce.activeEditor.dom.select('p'), 'font-size', '14px');


                    var add_font_size = 0;
                    for (var i = 0; i < p_tag_arr.length; i++) {
                        var get_font_size = tinymce.activeEditor.dom.getStyle(tinymce.activeEditor.dom.select('p')[i], 'font-size', false);

                        if (get_font_size)
                            add_font_size += parseInt(get_font_size);
                    } //end for loop

                    // var tinymce_height = $(tinymce.activeEditor.getContainer()).height();
                    // alert(tinymce_height);
                    var val = autoPageBreak(add_font_size, 308);//413
                }
                // if(span_tag_arr!=''){
                //     var add_font_size = 0;
                //     for (var i = 0; i < p_tag_arr.length; i++) {
                //         var get_font_size = tinymce.activeEditor.dom.getStyle(tinymce.activeEditor.dom.select('span')[i], 'font-size', false);
                //
                //         if (get_font_size)
                //             add_font_size += parseInt(get_font_size);
                //     } //end for loop
                //
                //     var val = autoPageBreak(add_font_size, 42);
                // }
                // end another pagebreak function


                // Double Pressing Enter Key
                var apply_style = $("#apply_style").val();

                clicks++;
                // alert(clicks);
                if ((clicks == 1) && (apply_style == 1)) {
                    event.preventDefault();
                    event.stopPropagation();
                    // alert(apply_style+"======"+clicks);
                    // return false;
                    timer = setTimeout(function () {

                        $("#apply_style").val(0);
                        clicks = 0;  //after action performed, reset counter
                        var word_bold_mapping = $("#word_bold_mapping").val();
                        var font_family_mapping = $("#font_family_mapping").val();
                        var font_color_mapping = $("#font_color_mapping").val();
                        var font_color_code_mapping = $("#font_color_code_mapping").val();
                        var font_size_mapping = $("#font_size_mapping").val();
                        var font_size_number_mapping = $("#font_size_number_mapping").val();

                        if (word_bold_mapping == 1) {
                            $("#word_bold_mapping").val(0);
                            tinymce.get('doc_content').execCommand('Bold', false, 'doc_content');


                        }
                        if (font_family_mapping == 1) {
                            $("#font_1").removeClass('checked');
                            $("#font_2").removeClass('checked');
                            $("#font_3").removeClass('checked');
                            $("#font_4").removeClass('checked');
                            $("#font_5").removeClass('checked');
                            $("#font_1").addClass('checked');
                            tinymce.get('doc_content').execCommand("fontName", false, "ms mincho, �搾ｽ� 譏取悃");
                            $("#font_family_mapping").val(0);
                        }
                        if (font_color_mapping == 1) {

                            tinymce.get('doc_content').execCommand('ForeColor', false, font_color_code_mapping);
                            $("#font_color_mapping").val(0);
                        }
                        if (font_size_mapping == 1) {
                            $(".font_size").removeClass('checked');
                            $("#font_size_12").addClass('checked');
                            tinymce.get('doc_content').execCommand("fontSize", false, font_size_number_mapping);
                            // $("#font_size_number_mapping").val("16px");
                            $("#font_size_mapping").val(0);
                        }

                    }, DELAY);
                }

                else {
                    clearTimeout(timer);
                    clicks = 0;

                }

            }
            console.log('Editor was clicked');
        });

        // editor.execCommand("fontName", false, "ms mincho, �搾ｽ� 譏取悃");
        editor.on('change keyup paste redo undo', function (event) {
            var event_mapping = $("#event_mapping").val();
            console.log("Event Mapping No.: " + event_mapping);


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
                // save_autometically();
            }
        });
        editor.on('paste', function (event) {
            // alert($(tinyMCE.activeEditor.getContainer()).width());

            setTimeout(function() {
                // alert($(tinyMCE.activeEditor.getContainer()).height());
                var str = tinymce.activeEditor.getContent({format: 'raw'});
                var container_height = $(tinyMCE.activeEditor.getContainer()).height();
// alert(container_height);

                var final_height=container_height/826;
                if(final_height>1)
                rearrange(str,7000);


            }, 100);


        });
        editor.on('click', function (event) {

            var img = tinymce.activeEditor.selection.getNode();
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

            // end table cell calculation like excel sheet


            // $(".close_aria").addClass('hide').removeClass('show');
            $(".close_aria, .font_color_aria, #word_function_aria, #word_image_selection_message, #font_size_aria, .font_family_aria").addClass('hide').removeClass('show');
            $("#table_of_contantes").addClass('hide').removeClass('show');
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

    tinymce.get('doc_content').execCommand("fontName", false, font_name);
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
    tinymce.get('doc_content').execCommand('mcePrint');
}

function word_font_color(color_code) {
    $("#font_color_mapping").val(1);
    $("#apply_style").val(1);
    $("#font_color_code_mapping").val(color_code);
    tinymce.get('doc_content').execCommand('ForeColor', false, color_code);
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
    $("#apply_style").val(1);
    $("#font_size_number_mapping").val("16px");
    tinymce.get('doc_content').execCommand("fontSize", false, font_size);
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
    $("#email_font_size_number_mapping").val("16px");
    tinymce.get('email_content').execCommand("fontSize", false, font_size);
}

function save_autometically() {

    delay(function () {
        var post_id = $("#post_id").val();
        var content = tinyMCE.activeEditor.getContent();
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
                    $('.internet_connection_alert').slideUp(400);
                    console.log('success');
                })
                .fail(function (data, statusText, xhr) {
                    $('.internet_connection_alert').show().delay(750).slideDown(400);
                    console.log(xhr.status);
                    console.log(statusText);
                    $("#event_mapping").val(1);
                })
                .always(function (data, statusText, xhr) {
                    $("#event_mapping").val(1);
                    console.log(xhr.status);
                    console.log(statusText);
                    console.log("complete");
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
                    console.log('success');
                })
                .fail(function (data, statusText, xhr) {
                    $('.internet_connection_alert').show().delay(750).slideDown(400);
                    console.log('fail');
                    $("#event_mapping").val(1);
                })
                .always(function () {
                    console.log("complete");
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
    console.log(font_size + '===' + val);
    console.log($(tinyMCE.activeEditor.getContainer()).height());
    if (val < font_size) {
        autoPageBreak(font_size, val);
    }
}

function rearrange(text,length) {
    // alert(container_height);
    var	chunks = splitText(text, false,length);
    var value ='';
    for (var i = 0; i < chunks.length; i++) {

        // console.log(chunks[i]+'=======');

        // tinymce.activeEditor.insertContent('<!-- pagebreak -->');
            value += '<p>'+chunks[i]+'</p><!-- pagebreak -->';
    }
    tinymce.activeEditor.setContent(value);


}



function splitText(text, useRegex,length) {
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
                while (boundary <= textSize && text.charAt(boundary) != ' ') { boundary++; }
                chunks.push(text.substring(i, boundary));
            }
        }
    }
    return chunks;
}

var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();
