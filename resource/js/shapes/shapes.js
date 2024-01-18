jQuery(document).ready(function ($) {
    $("#btn-shapes-design").click(function (event) {
        event.preventDefault();
        $("#word_canvase_aria").removeClass('hide').addClass('show');
        // var base_url = $("#base_url").val();
        // var script = document.createElement("script");
        // script.type = "text/javascript";
        // script.src = base_url+"resource/js/jquery-ui.min.js";
        // script.onload = function(){
        //     alert("Script is ready!");
        //
        // };
        // var cc=document.body.appendChild(script);
        // console.log(cc);

    });


    $("#btn-shapes-table").click(function (event) {
        var table_content = '<table class="custom_table" id="custom_table" width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#333" style="border:1px solid #333;">\n' +
            '  <tr>\n' +
            '    <td width="8%" bgcolor="#FFFFFF" class="ime_on">&nbsp;</td>\n' +
            '    <td width="14%" align="center" bgcolor="#99FF99" class="ime_on">科目</td>\n' +
            '    <td width="11%" align="center" bgcolor="#99FF99">1</td>\n' +
            '    <td width="11%" align="center" bgcolor="#99FF99">2</td>\n' +
            '    <td width="11%" align="center" bgcolor="#99FF99">3</td>\n' +
            '    <td width="10%" align="center" bgcolor="#99FF99">4</td>\n' +
            '    <td width="10%" align="center" bgcolor="#99FF99">5</td>\n' +
            '    <td width="9%" align="center" bgcolor="#99FF99">6</td>\n' +
            '    <td width="16%" align="center" bgcolor="#99FF99" class="ime_on">備考</td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="8%" rowspan="4" align="center" valign="middle" bgcolor="#99FF99" class="ime_on">(a)<br> 増<br>加<br><span style="writing-mode:tb-rl;t-webkit-transform:rotate(90deg);t-moz-transform:rotate(90deg);t-o-transform: rotate(90deg);">（</span><br>収<br>入<br><span style="writing-mode:tb-rl;t-webkit-transform:rotate(90deg);t-moz-transform:rotate(90deg);t-o-transform: rotate(90deg);">）</span></td>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_a_col1_row0" class="amount_a_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_a_col2" class="amount_a_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_a_col3" class="amount_a_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_a_col4" class="amount_a_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_a_col5" class="amount_a_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="amount_a_col6" class="amount_a_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_a_col1_row1" class="amount_a_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_a_col2" class="amount_a_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_a_col3" class="amount_a_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_a_col4" class="amount_a_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_a_col5" class="amount_a_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="amount_a_col6" class="amount_a_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_a_col1" class="amount_a_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_a_col2" class="amount_a_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_a_col3" class="amount_a_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_a_col4" class="amount_a_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_a_col5" class="amount_a_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="amount_a_col6" class="amount_a_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  \n' +
            '  <tr>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on">小計　a,</td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_a" class="subtotal_of_a" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_a_col2" class="subtotal_of_a_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_a_col3" class="subtotal_of_a_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtotal_of_a_col4" class="subtotal_of_a_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtotal_of_a_col5" class="subtotal_of_a_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="subtotal_of_a_col6" class="subtotal_of_a_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="8%"  bgcolor="#99FF99" class="ime_on"></td>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on">原価  b</td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_b" class="subtotal_of_b" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_b_col2" class="subtotal_of_b_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_b_col3" class="subtotal_of_b_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtotal_of_b_col4" class="subtotal_of_b_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtotal_of_b_col5" class="subtotal_of_b_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="subtotal_of_b_col6" class="subtotal_of_b_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="8%"  bgcolor="#99FF99" class="ime_on"></td>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on">粗利 a-b=c</td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_c" class="subtotal_of_c" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_c_col2" class="subtotal_of_c_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_c_col3" class="subtotal_of_c_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtotal_of_c_col4" class="subtotal_of_c_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtotal_of_c_col5" class="subtotal_of_c_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="subtotal_of_c_col6" class="subtotal_of_c_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  \n' +
            '  <tr>\n' +
            '    <td width="8%" rowspan="5" align="center" bgcolor="#99FF99" class="ime_on">(d)<br> 減<br>少<br><span style="writing-mode:tb-rl;t-webkit-transform:rotate(90deg);t-moz-transform:rotate(90deg);t-o-transform: rotate(90deg);">（</span><br>経<br>費<br><span style="writing-mode:tb-rl;t-webkit-transform:rotate(90deg);t-moz-transform:rotate(90deg);t-o-transform: rotate(90deg);">）</span></td>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_d_col1" class="amount_d_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_d_col2" class="amount_d_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_d_col3" class="amount_d_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_d_col4" class="amount_d_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_d_col5" class="amount_d_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="amount_d_col6" class="amount_d_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_d_col1" class="amount_d_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_d_col2" class="amount_d_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_d_col3" class="amount_d_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_d_col4" class="amount_d_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_d_col5" class="amount_d_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="amount_d_col6" class="amount_d_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="14%"  bgcolor="#99FF99" class="ime_on"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_d_col1" class="amount_d_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_d_col2" class="amount_d_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="amount_d_col3" class="amount_d_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_d_col4" class="amount_d_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="amount_d_col5" class="amount_d_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="amount_d_col6" class="amount_d_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on">小計　d,</td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_d_col1" class="subtotal_of_d_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_d_col2" class="subtotal_of_d_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtotal_of_d_col3" class="subtotal_of_d_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtotal_of_d_col4" class="subtotal_of_d_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtotal_of_d_col5" class="subtotal_of_d_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="subtotal_of_d_col6" class="subtotal_of_d_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on">差引　c-d=e</td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtraction_of_d_col1" class="subtraction_of_d_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtraction_of_d_col2" class="subtraction_of_d_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtraction_of_d_col3" class="subtraction_of_d_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtraction_of_d_col4" class="subtraction_of_d_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtraction_of_d_col5" class="subtraction_of_d_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="subtraction_of_d_col6" class="subtraction_of_d_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="8%" rowspan="3" align="center" bgcolor="#99FF99" class="ime_on">営<br>\n' +
            '    業<br>外</td>\n' +
            '    <td width="14%"  bgcolor="#99FF99" class="ime_on">収入　f,</td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="income_of_d_col1" class="income_of_d_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="income_of_d_col2" class="income_of_d_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="income_of_d_col3" class="income_of_d_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="income_of_d_col4" class="income_of_d_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="income_of_d_col5" class="income_of_d_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="income_of_d_col6" class="income_of_d_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="14%"  bgcolor="#99FF99" class="ime_on">支出　g,</td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="expenditure_of_d_col1" class="expenditure_of_d_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="expenditure_of_d_col2" class="expenditure_of_d_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="expenditure_of_d_col3" class="expenditure_of_d_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="expenditure_of_d_col4" class="expenditure_of_d_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="expenditure_of_d_col5" class="expenditure_of_d_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="expenditure_of_d_col6" class="expenditure_of_d_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="14%"  bgcolor="#99FF99" class="ime_on">差引　f-g=h</td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtractionE_of_d_col1" class="subtractionE_of_d_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtractionE_of_d_col2" class="subtractionE_of_d_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="subtractionE_of_d_col3" class="subtractionE_of_d_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtractionE_of_d_col4" class="subtractionE_of_d_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="subtractionE_of_d_col5" class="subtractionE_of_d_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="subtractionE_of_d_col6" class="subtractionE_of_d_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '  <tr>\n' +
            '    <td width="8%"  bgcolor="#99FF99" class="ime_on"></td>\n' +
            '    <td width="14%" bgcolor="#99FF99" class="ime_on">合計 e-h</td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="total_of_d_col1" class="total_of_d_col1" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="total_of_d_col2" class="total_of_d_col2" align="right"></td>\n' +
            '    <td width="11%" bgcolor="#FFFFFF" id="total_of_d_col3" class="total_of_d_col3" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="total_of_d_col4" class="total_of_d_col4" align="right"></td>\n' +
            '    <td width="10%" bgcolor="#FFFFFF" id="total_of_d_col5" class="total_of_d_col5" align="right"></td>\n' +
            '    <td width="9%" bgcolor="#FFFFFF" id="total_of_d_col6" class="total_of_d_col6" align="right"></td>\n' +
            '    <td width="16%" bgcolor="#FFFFFF" align="center" class="ime_on"></td>\n' +
            '  </tr>\n' +
            '</table>\n';
        tinymce.get('doc_content').focus();
        tinymce.execCommand('mceInsertContent', false, table_content);
        if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            $("#word_function_aria").removeClass('show').addClass('hide');
        }
    });

//	var canvas = new fabric.Canvas('WordCanvas');
    var canvas = this.__canvas = new fabric.Canvas('WordCanvas');
    fabric.Object.prototype.transparentCorners = true;
    // var canvas11 = new fabric.Canvas('WordCanvas1');

    var text_content = "文字を入力してください。";
    var text_content1 = "";

    // start of change text color
    addHandler('text_color_picker', function (obj) {
        setStyle(obj, 'fill', this.value);
    }, 'onchange');

    addHandler('back_color_picker', function (obj) {
        setStyle(obj, 'textBackgroundColor', this.value);
    }, 'onchange');

    function setStyle(object, styleName, value) {
        if (object.setSelectionStyles && object.isEditing) {
            var style = {};
            style[styleName] = value;
            object.setSelectionStyles(style).setCoords();
        }
        else {
            object[styleName] = value;
        }
        canvas.renderAll();
    };

    function getStyle(object, styleName) {
        return (object.getSelectionStyles && object.isEditing)
            ? object.getSelectionStyles()[styleName]
            : object[styleName];
    }

    function addHandler(id, fn, eventName) {
        document.getElementById(id)[eventName || 'onclick'] = function () {
            var el = this;
            if (obj = canvas.getActiveObject()) {
                fn.call(el, obj);
                canvas.renderAll();
            }
        };
    }

    // end of change text color

    // start of change font size
    $("#text_font_size").change(onFontSizeChanged);

    function onFontSizeChanged() {
        var newFontSize = $(this).val();
        var activeObject = canvas.getActiveObject();
        if (activeObject.setSelectionStyles && activeObject.isEditing) {
            var style = {};
            style["fontSize"] = newFontSize;
            activeObject.setSelectionStyles(style);
        } else {
            activeObject["fontSize"] = newFontSize;
        }

        canvas.renderAll();

    }

    // end of change font size

    $("#shape_bg_color_picker").change(onShapeBackgroundColorChanged);

    function onShapeBackgroundColorChanged() {
        var color_code = $(this).val();
        canvas.getActiveObject().set("fill", color_code);
        // canvas.getActiveObject().set("stroke", color_code);
        canvas.renderAll();
        return false;
    }

    $("#shape_line_color_picker").change(onShapeLineColorChanged);

    function onShapeLineColorChanged() {
        var color_code = $(this).val();
        // canvas.getActiveObject().set("fill", color_code);
        canvas.getActiveObject().set("stroke", color_code);
        canvas.getActiveObject().set("strokeWidth", 1);
        canvas.renderAll();
        return false;
    }


    // $("#dimond-squere").click(function(event) {
    // 	event.preventDefault();
    //
    // 	// create a rectangle with angle=45
    // 	var rect = new fabric.Rect({
    //        left: 200,
    // 	    top: 50,
    // 	    fill: '#DAF4AD',
    // 	    width: 200,
    // 	    height: 200,
    // 	    angle: 45
    // 	});
    //
    //    var iTextBox = new fabric.IText("Hello Aasan Ullah",{
    //        left: 100,
    // 	    top: 170,
    // 	    fill: '#fff',
    // 	    height: 100
    //    });
    //
    //    var dimondText = [rect, iTextBox];
    //
    //    var madeRectText = new fabric.Group(dimondText);
    //    canvas.add(madeRectText);
    // });


    // function onObjectSelected(e) {
    //     // console.log(e.target.get('type'));
    //     var obj = canvas.getActiveObject();
    //     // alert(obj.left + "," + obj.top);
    //     var left=obj.left-110;
    //     var top=obj.top+100;
    //     var object_type=e.target.get('type');
    //     if(object_type=='rect'){
    //         var text = new fabric.Textbox(text_content, {
    //             left: left,
    //             top: top,
    //             backgroundColor: '#DAF4AD',
    //             border: 2,
    //             width: 200,
    //             centeredRotation: true,
    //             centeredScaling: false,
    //             fontFamily:  ["ms mincho", "ｍｓ 明朝"],
    //             fontSize: 20,
    //             strokeWidth:10
    //
    //         });
    //         canvas.add(text);
    //         canvas.sendToBack(rect);
    //     }
    // }
    // canvas.on('object:selected', onObjectSelected);

    // mouse event
    // fabric.util.addListener(canvas.upperCanvasEl, 'dblclick', function(e) {
    //     if (canvas.findTarget(e)) {
    //         const objType = canvas.findTarget(e).type;
    //         if (objType === 'rect') {
    //             alert('double clicked on a image!');
    //             var text1 = new fabric.Textbox(text_content1, {
    //                 left: 95,
    //                 top: 175,
    //                 backgroundColor: '#DAF4AD',
    //                 border: 0,
    //                 width: 200,
    //                 centeredRotation: true,
    //                 centeredScaling: false,
    //                 fontFamily:  ["ms mincho", "ｍｓ 明朝"],
    //                 fontSize: 20,
    //                 strokeWidth:10
    //
    //             });
    //             canvas.add(text1);
    //         }
    //     }
    // });

    $("#dimond-squere1,#dimond-squere").click(function (event) {
        event.preventDefault();

        var canvas11 = new fabric.Canvas('WordCanvas1');
        var from_button = $(this).attr('from_button');
        // alert(from_button);
        if (from_button == 1) { // open image edit mode on canvas

            var rect = new fabric.Rect({
                left: 200,
                top: 50,
                fill: '#fff',
                stroke: '#000',
                strokeWidth: .5,
                width: 200,
                height: 200,
                angle: 45
            });
            canvas11.add(rect);
        } else {
            // create a rectangle with angle=45
            var rect = new fabric.Rect({
                left: 200,
                top: 50,
                fill: '#fff',
                stroke: '#000',
                strokeWidth: .5,
                width: 200,
                height: 200,
                angle: 45
            });
            canvas.add(rect);
            canvas.sendToBack(rect);

            // var text1 = new fabric.Textbox(text_content1, {
            //     left: 95,
            //     top: 175,
            //     backgroundColor: '#fff',
            //     border: 0,
            //     width: 200,
            //     centeredRotation: true,
            //     centeredScaling: false,
            //     fontFamily: ["ms mincho", "ｍｓ 明朝"],
            //     fontSize: 20,
            //     strokeWidth: 10
            //
            // });
            // canvas.add(text1);
        }


    });

    $("#shape-rectangle").click(function (event) {
        event.preventDefault();

        // create a rectangle with angle=45
        var rect = new fabric.Rect({
            left: 200,
            top: 50,
            fill: '#fff',
            stroke: '#000',
            strokeWidth: .5,
            width: 200,
            height: 200
        });
        canvas.add(rect);


    });

    $("#addText").click(function (event) {
        event.preventDefault();
        var text = new fabric.Textbox(text_content, {
            left: 50,
            top: 100,
            backgroundColor: '#fff',
            border: 2,
            width: 200,
            centeredRotation: true,
            centeredScaling: false,
            fontFamily: ["ms mincho", "ｍｓ 明朝"],
            fontSize: 20,
            strokeWidth: 10

        });
        canvas.add(text);

    });


    canvas.on("text:editing:entered", clearText);

    function clearText(e) {
        if (e.target.type === "textbox") {
            if (e.target.text == "文字を入力してください。") {
                e.target.text = "";

            }
            ;
        }
    }

    $("#line-shape-arrows").on("click", function (event) {
        event.preventDefault();

        var triangle = new fabric.Triangle({
            width: 10,
            height: 15,
            fill: 'red',
            left: 235,
            top: 65,
            angle: 90
        });

        var line = new fabric.Line([50, 100, 200, 100], {
            left: 75,
            top: 70,
            strokeDashArray: [5, 5],
            stroke: 'red'
        });

        var objs = [line, triangle];

        var alltogetherObj = new fabric.Group(objs);
        canvas.add(alltogetherObj);

    });

    $("#shapesSaveClose1,#shapesSaveClose").click(function (event) {
        event.preventDefault();
        var base_url = $("#base_url").val();
        // alert(base_url);die();
        $(".word_canvase_aria").removeClass('show').addClass('hide');
        $(".word_canvase_aria1").removeClass('show').addClass('hide');
        $(".word_function_aria").removeClass('show').addClass('hide');
        var api_key = $("#api_key").val();
        var url = base_url + 'index.php/api/wordapp/save_shapes';

        var from_button = $(this).attr('from_button');

        if (from_button == 1) { // open image edit mode on canvas
            var new_canvas = document.getElementById('WordCanvas1');
            // var new_canvas = new fabric.Canvas('WordCanvas1');
            var ctx = new_canvas.getContext('2d');
            // crop image
            var w = new_canvas.width,
                h = new_canvas.height,
                pix = {x: [], y: []},
                imageData = ctx.getImageData(0, 0, new_canvas.width, new_canvas.height),
                x, y, index;

            for (y = 0; y < h; y++) {
                for (x = 0; x < w; x++) {
                    index = (y * w + x) * 4;
                    if (imageData.data[index + 3] > 0) {

                        pix.x.push(x);
                        pix.y.push(y);

                    }
                }
            }
            pix.x.sort(function (a, b) {
                return a - b
            });
            pix.y.sort(function (a, b) {
                return a - b
            });
            var n = pix.x.length - 1;
            if (n == -1) {
                alert('Please Draw Something and Then Save.');
            }
            w = pix.x[n] - pix.x[0];
            h = pix.y[n] - pix.y[0];

            var cut = ctx.getImageData(pix.x[0], pix.y[0], w, h);

            new_canvas.width = w;
            new_canvas.height = h;
            ctx.putImageData(cut, 0, 0);
            var dataURL = new_canvas.toDataURL('png');
        } else {
            var objs = [];
            //get all the objects into an array
            objs = canvas._objects.filter(function (obj) {
                return obj;
            });
            var alltogetherObj = new fabric.Group(objs);
            var dataURL = alltogetherObj.toDataURL('png');
        }
        // alert(dataURL);   
        if (dataURL=="data:,") {
            return false;
        } else {
            $.ajax({
                url: url,
                type: 'POST',
                data: JSON.stringify({
                    api_key: api_key,
                    image_data: dataURL
                }),
                contentType: "application/json",
            })
            .done(function (data) {
                if (data != 'error') {
                    tinymce.get('doc_content').focus();
                    tinymce.execCommand('mceInsertContent', false, '<img  id="canvasShapesImage" src="' + data + '"> ');
                    if (from_button == 1) {
                        document.getElementById('WordCanvas1').width = 750;
                        document.getElementById('WordCanvas1').height = 500;
                        $("#word_canvase_aria1").removeClass('show').addClass('hide');
                        var canvas2 = document.getElementById('WordCanvas1');
                        canvas2.clear();
                    } else {
                        document.getElementById('text_font_size').selectedIndex = 0;

                        $("#word_canvase_aria").removeClass('show').addClass('hide');
                        // var canvas22 = new fabric.Canvas('WordCanvas');
                        canvas.clear();
                    }
                }
                console.log("success");
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
        }
        
    });

    $("#delete-shapes").click(function (event) {
        event.preventDefault();

        var activeObject = canvas.getActiveObject(),
            activeGroup = canvas.getActiveGroup();
        if (activeObject) {
            if (confirm('Are you sure to delete this?')) {
                canvas.remove(activeObject);
            }
        }
        else if (activeGroup) {
            if (confirm('Are you sure to delete all?')) {
                var objectsInGroup = activeGroup.getObjects();
                canvas.discardActiveGroup();
                objectsInGroup.forEach(function (object) {
                    canvas.remove(object);
                });
            }
        }


        // var activeObject = canvas.getActiveObject();
        // activeGroup = canvas.getActiveGroup();
        // if (activeObject) {
        // 	canvas.remove(activeObject);
        // }
    });

    $("#word_shape_aria_close").click(function (event) {
        event.preventDefault();
        $("#word_canvase_aria").removeClass('show').addClass('hide');
    });

    $("#word_shape_aria_close1").click(function (event) {
        event.preventDefault();
        $("#word_canvase_aria1").removeClass('show').addClass('hide');
    });
    $("#word_shape_aria_close_print").click(function (event) {
        event.preventDefault();
        $("#print_aria").removeClass('show').addClass('hide');
    });

    $("#close_settlement_letter_form").on('click', function (event) {
        event.preventDefault();
        $('#close_blank_document_pagination_error').removeClass('show').addClass('hide');
    });


    $("#print_word222222222").click(function (event) {
        var html_string = tinymce.activeEditor.getContent();
        var doc_content2_height = $(tinymce.editors['doc_content2'].getContainer()).height();

        var value = '';
        $("#print_aria").removeClass('hide').addClass('show');
        $("#word_function_aria").removeClass('show').addClass('hide');

        if (html_string == '') {
            $(".print_word").addClass('disable_button');
            value = '<p style="text-align: center;font-family: ms mincho, ｍｓ 明朝; font-size: 18.666667px;">あなたは何も印刷する必要はありません</p>';
        } else {
            // $(tinymce.activeEditor.getBody()).find('p').css('background','yellow');
            // tinymce.editors['print_content'].getBody().style.backgroundColor = '#000';
            $(".print_word").removeClass('disable_button');
            var get_page_count = localStorage.getItem("page_count");
            var plus_num = 1;

            if (doc_content2_height == 0) { //if click print button without page separation
                var page_count = 2;
                get_page_count = 1;
            } else {
                var page_count = Number(get_page_count) + Number(plus_num);
            }
            console.log(get_page_count + '==page_count==' + page_count);
            for (i = 1; i < page_count; i++) {
                if (i == get_page_count) {
                    var pgbrk_span = 'none';
                } else {
                    var pgbrk_span = '';
                }
                var content = tinymce.editors[i].getContent();
                value += '<div style="width:778px; border: 1px solid #fff;padding: 10px 0px 0px 1px; margin-bottom: 0px; background-color: white">' + content + '<span id="' + i + '" style="display:' + pgbrk_span + '"><!-- pagebreak --></span></div>';
            }
            value = '<div style="width:780px; background-color: #DDDDDF;padding: 6px 7px 6px 4px;">' + value + '</div>';
        }
        tinymce.editors['print_content'].setContent(value);
    });


    // start paging test function
    $("#pagingTest").click(function (event) {
        tinymce.get('doc_content').getBody().focus();
        var html_string = tinymce.activeEditor.getContent();
        if (html_string == '') {
            $("#blank_document_pagination_error").removeClass('hide').addClass('show');
            $("#close_blank_document_pagination_error").focus();
        }

        var text_content = tinymce.activeEditor.getContent({format: 'raw'});
// alert(text_content);die();
        var containsJapanese = text_content.match(/[\u3000-\u303f\u3040-\u309f\u30a0-\u30ff\uff00-\uff9f\u4e00-\u9faf\u3400-\u4dbf]/);
        if (containsJapanese)
            var text_content_array = text_content.match(/(<[^>]*>|\w+|[\u30a0-\u30ff\u3040-\u309f\u3005-\u3006\u30e0-\u9fcf]+|["%&():;@\-',.!?=/]|[「」’％＆”。、！？（）])/g);
        //     var text_content_array = text_content;
        else
            var text_content_array = text_content.match(/(<[^>]*>|\w+)/g);

        // console.log(text_content_array);
        var container_height = $(tinymce.activeEditor.getContainer()).height();

        var page_count = Math.ceil(container_height / 1112);
        localStorage.setItem("page_count", page_count);

        // console.log(container_height+'===='+text_content_array.length);

        var text_content_length = Math.ceil(text_content_array.length / page_count);
        // text_content_length = text_content_length+1;
        var text_content_length1 = text_content_length;
        var final_text = '';
        var limit = 50;

        for (var j = 0; j < text_content_length; j++) {
            if (containsJapanese) {
                final_text += text_content_array[j];
            } else {
                var text1 = text_content_array[j] + ' ';
                text1 = text1.replace('nbsp', ' ');
                final_text += text1;
            }
            // if (j == limit) {
            //     // tinymce.editors['doc_content'].setContent(final_text+'<!-- pagebreak -->');
            //     tinymce.editors['doc_content'].setContent(final_text);
            //     var pp = $(tinymce.editors['doc_content'].getContainer()).height();
            //     // alert(pp);
            //     limit = limit * 2;
            //     if (pp > 835) {
            //         break;
            //     }else{
            //         continue;
            //     }
            //
            //
            //
            //
            // }

        }
        tinymce.editors['doc_content'].setContent(final_text);
        // alert(j);
        // var j = text_content_length;
        // var text_content_length1 = j;
        // die();
        if (page_count > 1) {
            // console.log(container_height);
            // var page_count =page_count+1;
            // $('#page_count1').text('PAGE 1 OF ' + page_count);
            $('#page_count1').text('ページ 1 / ' + page_count);
            paginatedText(2, page_count, text_content_array, text_content_length, 0, 1, containsJapanese, text_content_length1);
        }

        //  for (var j = 2; j <= 5; j++) {
        //      $('#fixed_editor'+j).show();
        //
        // }

        // str = '<div id="content" style="width: 650px; line-height: 20px">'+str+'</div>';
        // tinymce.execCommand('mceInsertContent', false, str);
        // tinymce.activeEditor.setContent(str);
        // setTimeout(function () {
        // var page = tinymce.activeEditor.dom.select('div#content')[tinymce.activeEditor.dom.select('div#content').length - 1];
        // var container_height = $(tinyMCE.activeEditor.getContainer()).height();
        // var getLineHeight = tinymce.activeEditor.dom.getStyle(tinymce.activeEditor.dom.select('div#content'), 'line-height', false);
        // var lineHeight = parseInt(getLineHeight);
        // var lines = page.offsetHeight / lineHeight;
        //  lines = parseInt(lines);
        // console.log(container_height);
        // alert(lines+'---------'+container_height);

        // if(lines>35){
        // if(container_height>842){
        // $(tinymce.activeEditor.selection.getNode()).after("<!-- pagebreak -->")
        // tinymce.activeEditor.insertContent('<!-- pagebreak -->');
        // paginateText(str);
        //         }
        // }, 100);

        // alert(lines);
    });
    // end paging test function

});

function paginatedText(id, page_count, text_content, text_content_length, k, i, containsJapanese, text_content_length1) {
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

    if (i < page_count) {
        var next_div_id = id + 1;
        var text_content_length = j + text_content_length1;
        console.log(j + '-----here--------' + text_content_length);
        var k = j;
        var i = i + 1;
        $('#fixed_editor' + i).show();
        // $('#page_count' + i).text('PAGE ' + i + ' OF ' + page_count);
        $('#page_count' + i).text('ページ ' + i + ' / ' + page_count);


        paginatedText(i, page_count, text_content, text_content_length, k, i, containsJapanese, text_content_length1);

    }
}

// function showSettlementLetterForm(id) {
//     tinymce.get('doc_content').getBody().focus(); // for auto focusing on tinymce editor when click
//     var checkBox = document.getElementById("settlement_letter_choice1");
//     var today = new Date();
//     var dd = today.getDate();
//     var mm = today.getMonth() + 1; //January is 0!
//     var yyyy = today.getFullYear();
//
//     if (dd < 10) {
//         dd = '0' + dd
//     }
//
//     if (mm < 10) {
//         mm = '0' + mm
//     }
//
//     today = yyyy + '年' + mm + '月' + dd + '日';
//
//     // if (checkBox.checked == true){
//     if (id == 1) {
//         if (checkBox.checked == true) {
//             document.getElementById("settlement_letter_choice2").checked = false;
//             document.getElementById("settlement_letter_choice3").checked = false;
//             // alert('hi');
//             var form_content = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="right">' + today + '</td><td height="30" align="center">&nbsp;</td></tr><tr><td height="30" align="center">決　裁　書</td><td width="8%">&nbsp;</td></tr><tr><td colspan="2" align="right"><table width="100%" border="0" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF"><tr><td colspan="2" rowspan="2" align="center" valign="bottom" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="2" bgcolor="#CCCCCC" style="border:2px solid black;"><tr><td width="178" align="center" bgcolor="#FFFFFF">社　　長</td> <td width="176" align="center" bgcolor="#FFFFFF">審　査</td><td width="175" align="center" bgcolor="#FFFFFF">審　査</td><td width="192" align="center" bgcolor="#FFFFFF">審　査</td><td width="173" align="center" bgcolor="#FFFFFF">審　査</td></tr><tr> <td width="178" height="100" bgcolor="#FFFFFF" style="-ms-word-break: break-all; word-break: break-all;word-break: break-word;">&nbsp;</td><td bgcolor="#FFFFFF" width="178" style="-ms-word-break: break-all; word-break: break-all;word-break: break-word;">&nbsp;</td> <td bgcolor="#FFFFFF" width="178" style="-ms-word-break: break-all; word-break: break-all;word-break: break-word;">&nbsp;</td><td bgcolor="#FFFFFF" width="178" style="-ms-word-break: break-all; word-break: break-all;word-break: break-word;">&nbsp;</td><td bgcolor="#FFFFFF" width="178" style="-ms-word-break: break-all; word-break: break-all;word-break: break-word;">&nbsp;</td> </tr> </table></td><td width="2%" rowspan="2" bgcolor="#FFFFFF">&nbsp;</td><td width="21%" rowspan="2" bgcolor="#FFFFFF">部署名<hr><br>氏名<hr></td><td width="5%" height="63" valign="bottom" bgcolor="#FFFFFF">印</td> </tr><tr><td valign="bottom" bgcolor="#FFFFFF">&nbsp;</td> </tr><tr><td colspan="5"><table width="100%" border="0" cellpadding="3" cellspacing="2" bgcolor="#CCCCCC" style="border:2px solid black;border-radius:10px;"><tr><td width="170" rowspan="3" align="center" bgcolor="#FFFFFF"> <br /><br /><br />  決<br /> <br />栽<br /><br />  事<br/><br /> 項</td> <td width="1112" height="100" colspan="3" valign="top" bgcolor="#FFFFFF">結論（目的）：</td> </tr> <tr><td height="100" colspan="3" valign="top" bgcolor="#FFFFFF">理由（手段）：</td></tr><tr><td height="100" colspan="3" valign="top" bgcolor="#FFFFFF">事例：</td>  </tr><tr><td align="center" bgcolor="#FFFFFF">意<br/><br/>見</td><td height="100" colspan="3" bgcolor="#FFFFFF">&nbsp;</td></tr></table></td></tr> <tr><td colspan="5" align="right"><br /><button type="button" id="done_settlement" class="btn btn-primary"> 完了</button></td> </tr></table></td></tr></table>';
//
//             tinymce.execCommand('mceInsertContent', false, form_content);
//         }
//     } else {
//
//     }
// }