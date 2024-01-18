//////////////////////////////////
//
//    JS IM vje
//        by Genie (Umeda)
//
// depend jsim_common.js,roma.js,jsim.js,prototype.js
var JS_IM_vje = {
  methodName : "jsvje",
  version : "20190422",
  language : "Japanese",
  author : "Colspan",
  params : {
    displayString : '日',
    listBox : true,
    inlineInsertion : false
  },
  extension : {
    result : null,
    convert : function(){
      if( this.methodObj.inlineBuffer != "" ){ // 変換処理開始
        JS_IM_YahooAPI.VJE.convert( this.methodObj.inlineBuffer, this.methodObj );
      }
    },
    receive : function( data ){ // callback
      if( this.methodObj.phase != 'wait' ) return; // 待ち状態じゃなかったら無視する
      this.methodObj.phase = 'convert';
      this.result = data.Result;

      var segmentList = data.Result.SegmentList.Segment;
      var tempCandidate;
      var result = new Object();
      var segment;
      result.segments = new Array();
      result.targetSegment = 0;

      // 受け取ったJSONデータを扱いやすい配列に格納する
      if( segmentList.length ){ // segmentListが配列の時
        for(var i=0;i<segmentList.length;i++){
          tempCandidate = segmentList[i].CandidateList.Candidate;
          segment = new Object();
          if( typeof tempCandidate == 'string' ){
            segment.candidates = new Array();
            segment.candidates[0] = tempCandidate;
          }
          else{
            segment.candidates = tempCandidate;
          }
          segment.targetCandidateNum = 0;
          result.segments[i] = segment;
        }
      }
      else{ // segmentListが1つだけの文節だけを含み、配列ではないとき
        result.segments[0] = new Object();
        tempCandidate = segmentList.CandidateList.Candidate;
        if( typeof tempCandidate == 'string' ){
          result.segments[0].candidates = new Array();
          result.segments[0].candidates[0] = tempCandidate;
        }
        else{
          result.segments[0].candidates = tempCandidate;
        }
        result.segments[0].targetCandidateNum = 0;
      }
      result.targetSegmentNum = 0;
      this.result = result;

      // GUI更新
      this.methodObj.JS_IM_Obj.GUI.list.update( result.segments[ result.targetSegmentNum ].candidates );
      this.methodObj.JS_IM_Obj.GUI.buffer.update( this.generateSegmentsGUI() );
    },
    nextSegment : function(){
      if( this.result.targetSegmentNum < this.result.segments.length - 1 ) this.result.targetSegmentNum ++;
      return this.getCurrentSegment();
    },
    prevSegment : function(){
      if( this.result.targetSegmentNum > 0 ) this.result.targetSegmentNum --;
      return this.getCurrentSegment();
    },
    getCurrentSegment : function(){
      return this.result.segments[ this.result.targetSegmentNum ];
    },
    nextCandidate : function(){
      var segment = this.getCurrentSegment();
      segment.targetCandidateNum += 1 + segment.candidates.length;
      segment.targetCandidateNum %= segment.candidates.length;
    },
    prevCandidate : function(){
      var segment = this.getCurrentSegment();
      segment.targetCandidateNum += -1 + segment.candidates.length;
      segment.targetCandidateNum %= segment.candidates.length;
    },
    getCurrentCandidate : function(){
      var result = this.result;
      var segment = result.segments[ result.targetSegmentNum ];
      return segment.candidates[ segment.targetCandidateNum ];
    },
    getCurrentCandidateNum : function(){
      var result = this.result;
      var segment = result.segments[ result.targetSegmentNum ];
      return segment.targetCandidateNum;
    },
    getAllSegments : function(){
      var tempSegment;
      var segments = this.result.segments;
      var outputSegments = new Array();
      for(var i=0;i<segments.length;i++){
        tempSegment = segments[i];
        outputSegments[i] = tempSegment.candidates[ tempSegment.targetCandidateNum ];
      }
      return outputSegments;
    },
    acceptAllSegments : function(){
      return this.getAllSegments().join("");
    },
    generateSegmentsGUI : function(){
      var segments = this.getAllSegments();
      var targetSegmentNum = this.result.targetSegmentNum;
      var divElem = document.createElement("div");
      var spanElem,i;
      for( i = 0; i < segments.length; i++ ){
        spanElem = document.createElement("span");
        spanElem.innerHTML = segments[i];
        if( targetSegmentNum == i ){
          JS_IM_setClassName( spanElem, 'jsim_target_segment' );
        }
        divElem.appendChild( spanElem);
      }
      return divElem.innerHTML;
    }
  },
  init : function(){
    this.romajiBuffer = "";
    this.phase = 'input'; // available 'input','convert','convert_katakana','convert_hiragana','convert_romaji','wait',
  },
  callback : function( data ){
    return this.extension.receive( data );
  },
  accept : function(){
    var outputStr;
    if( this.phase == 'convert' ){
      outputStr = this.extension.acceptAllSegments();
    }
    else outputStr = this.inlineBuffer;
    this.phase = 'input';
    this.romajiBuffer = "";
    this.inlineBuffer = "";
    this.JS_IM_Obj.GUI.list.hide();
    this.JS_IM_Obj.GUI.buffer.hide();
    
    var rng = tinymce.activeEditor.selection.getRng(true);
		var txt = rng.startContainer.textContent;
		//if ( txt.substring(rng.startOffset, rng.startOffset + 1) == '' ) {
    // tinymce.activeEditor.focus();
    // $(document).trigger({type: 'keypress', which: 40, keyCode: 40});
    //}
    return outputStr;
  },
  process : function( keyStatus ){
    var outputStr = "";
    var JS_IM_Obj = this.JS_IM_Obj;
//    $( 'phase' ).value = this.phase;  // debug
    //var elemSelectionState = Caret.getCaretXY( JS_IM_Obj.imeBox );
    //JS_IM_Obj.GUI.buffer.setPosition( elemSelectionState[0], elemSelectionState[1] );
    
    /*
    //var startElement = tinymce.activeEditor.selection.getStart();
    var startElement = tinymce.activeEditor.selection.getRng().startContainer;
    var selRangeRect = tinymce.activeEditor.selection.getRng().getClientRects();
    var editorPos = $('#fixed-editor iframe').offset();
    
    if(Array.isArray(selRangeRect) && selRangeRect.length > 0 && typeof selRangeRect[0].left !== 'undefined')
      JS_IM_Obj.GUI.buffer.setPosition( editorPos.left + selRangeRect[0].left, editorPos.top + selRangeRect[0].top );
    else
    JS_IM_Obj.GUI.buffer.setPosition( editorPos.left + startElement.offsetLeft, editorPos.top + startElement.offsetTop );
    */
    
    var tinymcePosition = jQuery(tinymce.activeEditor.getContainer()).position();
    var toolbarPosition = jQuery(tinymce.activeEditor.getContainer()).find(".mceToolbar").first();
    var nodePosition = jQuery(tinymce.activeEditor.selection.getNode()).position();
    var textareaTop = 0;
    var textareaLeft = 0;
    if (tinymce.activeEditor.selection.getRng().getClientRects().length > 0) {
      textareaTop = tinymce.activeEditor.selection.getRng().getClientRects()[0].top;// + tinymce.activeEditor.selection.getRng().getClientRects()[0].height;
      textareaLeft = tinymce.activeEditor.selection.getRng().getClientRects()[0].left;
    } else {
      var selNode = tinymce.activeEditor.selection.getNode();
      var startElement = tinymce.activeEditor.selection.getRng().startContainer;
      textareaTop = nodePosition.top;// + parseInt(jQuery(selNode).css("font-size")) * 1.3;
      if(startElement.nodeName == "#text") {
        textareaLeft = nodePosition.left;
      } else {
        //textareaLeft = startElement.offsetLeft;
        textareaLeft = startElement.offsetLeft + (selNode.textContent || selNode.innerText || "").length * parseInt(jQuery(selNode).css("font-size")) * 0.95;
      }
    }
    var editorPos = $('#fixed-editor iframe').offset();
    JS_IM_Obj.GUI.buffer.setPosition( editorPos.left + textareaLeft, editorPos.top + textareaTop );

    switch( this.phase ){
      case 'input' : // 入力モード
        if( ! keyStatus.inputChar ) switch( keyStatus.inputCode ){
          case 27 : // ESC
            this.inlineBuffer = '';
            this.romajiBuffer = '';
            JS_IM_Obj.GUI.buffer.hide();
            return ''; // IEでフォームが初期化されるのを防ぐ
          break;
          // case 32 : // Space
          //   if( this.romajiBuffer == '' ) return null; // romajiBufferが空ならそのままスペースを入力する
          //   this.extension.convert(); // 変換開始
          //   this.phase = 'wait';
          //   return '';
          // break;
          case 10 : // Enter
          case 13 : // Enter
            if( this.romajiBuffer == "" ) return null;
            else return this.accept();
          break;
          case 118 : // F7
            this.inlineBuffer = roma2.katakana( this.romajiBuffer ).toString();
            return this.accept();
          break;
          case 117 : // F6
            return this.accept();
          break;
          case 33:case 34:case 35:case 36:case 37:case 38:case 39:case 40:case 45:case 46: //PAGE UP, PAGE DOWN, ARROW, HOME, END, INSERT, DEL
            return null;
          break;
        }
        if(keyStatus.inputCode >= 91 && keyStatus.inputCode <= 145) //NUMPAD, FN KEY
          return null;
        // 結合処理
        // if( JS_IM_Common.Browser.Gecko && !keyStatus.inputChar )
        //   keyStatus.inputChar = mapKeyPressToActualCharacter(keyStatus.shiftKey, keyStatus.inputCode); //or inputCode
        // if( keyStatus.inputChar /* != null */ ){
        //   this.romajiBuffer += keyStatus.inputChar.toLowerCase();
        //   this.inlineBuffer = roma2.hiragana(this.romajiBuffer).toString();
        //   JS_IM_Obj.GUI.buffer.update( this.inlineBuffer );
        //   return outputStr;
        // }
      break;
      case 'wait' : // コールバック待ち
        switch( keyStatus.inputCode ){
          case 27 : // ESC
            this.phase = 'input';
            JS_IM_Obj.GUI.buffer.update( this.inlineBuffer );
            JS_IM_Obj.GUI.list.hide();
            return ''; // inputに戻す
          break;
          case 32 : // Space
            this.extension.convert(); // 変換Retry
            return '';
          break;
          default :
            return ''; // 何も受け付けない
          break;
        }
      break;
      case 'convert' : // 変換動作中
        switch( keyStatus.inputCode ){
          case 27 : // ESC
            // TODO 取り消す
            this.phase = 'input';
            JS_IM_Obj.GUI.buffer.update( this.inlineBuffer )
            JS_IM_Obj.GUI.list.hide();
            return '';
          break;
          case 38 : // Up
            this.extension.prevCandidate();
            JS_IM_Obj.GUI.buffer.update( this.extension.generateSegmentsGUI() );
            JS_IM_Obj.GUI.list.prev();
          break;
          case 32 : // Space
          case 40 : // Down
            this.extension.nextCandidate();
            JS_IM_Obj.GUI.buffer.update( this.extension.generateSegmentsGUI() );
            JS_IM_Obj.GUI.list.next();
          break;
          case 37 : // Left
            JS_IM_Obj.GUI.list.update( this.extension.prevSegment().candidates );
            JS_IM_Obj.GUI.buffer.update( this.extension.generateSegmentsGUI() );
            JS_IM_Obj.GUI.list.setSelectedCandidateNum( this.extension.getCurrentCandidateNum() );
          break;
          case 39 : // Right
            JS_IM_Obj.GUI.list.update( this.extension.nextSegment().candidates );
            JS_IM_Obj.GUI.buffer.update( this.extension.generateSegmentsGUI() );
            JS_IM_Obj.GUI.list.setSelectedCandidateNum( this.extension.getCurrentCandidateNum() );
          break;
          case 118 : // F7
            this.inlineBuffer = roma2.katakana( this.romajiBuffer ).toString();
            return this.accept();
          break;
          case 119 : // F8
            this.inlineBuffer = roma2.hiragana( this.romajiBuffer ).toString();
            return this.accept();
          break;
          case 10 : // Enter
          case 13 : // Enter
          default : // 変換キー以外であれば確定して次へ
            outputStr = this.extension.acceptAllSegments();
            JS_IM_Obj.GUI.buffer.hide();
            this.accept();
            if( keyStatus.inputChar != null ){
              this.romajiBuffer += keyStatus.inputChar.toLowerCase();
              this.inlineBuffer = roma2.hiragana(this.romajiBuffer).toString();
            }
            return outputStr;
          break;
        }
        return '';
      break;
      default :
      break;
    }
  },
  backspace : function(){
    switch( this.phase ){
      case 'input' :
        if( this.romajiBuffer.length == 0 ) return false;
        var lastInlineBufferLength = this.inlineBuffer.length;
        while( lastInlineBufferLength == this.inlineBuffer.length ){
          this.romajiBuffer = this.romajiBuffer.substring(0,this.romajiBuffer.length-1);
          this.inlineBuffer = roma2.hiragana(this.romajiBuffer).toString();
        }
        this.JS_IM_Obj.GUI.buffer.update( this.inlineBuffer );
        this.JS_IM_Obj.GUI.list.hide();
        return true;
      break;
      case 'wait' :
      case 'convert' :
        this.phase = 'input';
        this.JS_IM_Obj.GUI.buffer.update( this.inlineBuffer );
        this.JS_IM_Obj.GUI.list.hide();
        return true;
      break;
    }
  }
}


var temp_YahooAPI_VJE = {
  callbackObj : null,
  lastRequestElem : null,
  onload : function( data ){
    try{
      return this.callbackObj.callback( data );
    }
    catch( e ){
      JS_IM_YahooAPI.retryRequest();
//      alert( '申し訳ありません。通信に問題がありました。数秒待ってから変換をやり直してください。現在この問題の原因を特定中です。' );
    }
  }
}
var JS_IM_YahooAPI = {
  //proxy : 'http://colspan.net/experiment/jsim/proxy/xml2json.cgi',
  proxy : window.location.origin + "/keipro2/index.php/wordapp/get_kanji_candidates",
  lastQuery : null,
  requestCount : 0,
  request : function( query ){
    this.lastQuery = query;
    this.requestCount ++;
//    window.status = this.requestCount; // debug
    try{
      var script = document.createElement('script');
      script.charset = 'UTF-8';
      script.src = this.proxy + '?' + query;
      document.body.appendChild(script);
    }
    catch( e ){
      // error
      alert("取得できません");
    }
  },
  retryRequest : function(){
    setTimeout( 'JS_IM_YahooAPI.request( "' + this.lastQuery + '" )', 200 );
  },
  VJE : {
    convert : function( str, callbackObj ){
      var query = 'sentence=' + str;
      JS_IM_YahooAPI.request( query );
      temp_YahooAPI_VJE.callbackObj = callbackObj;
    }
  }
}

/*
$.ajax({
  url: window.location.origin + "/keipro2/index.php/wordapp/get_kanji_candidates",
  type: "json",
  data: {},
  async: true,
  cache: false,
  dataType: "json",
  success: function (response, textStatus, jqXHR) {
    console.log(response);
  },
  error: function (jqXHR, textStatus, errorThrown) {
    alert(textStatus);
  }
});
*/

var caesarShift = function(str, amount) {

	// Wrap the amount
	if (amount < 0)
		return caesarShift(str, amount + 26);

	// Make an output variable
	var output = '';

	// Go through each character
	for (var i = 0; i < str.length; i ++) {

		// Get the character we'll be appending
		var c = str[i];

		// If it's a letter...
		if (c.match(/[a-z]/i)) {

			// Get its code
			var code = str.charCodeAt(i);

			// Uppercase letters
			if ((code >= 65) && (code <= 90))
				c = String.fromCharCode(((code - 65 + amount) % 26) + 65);

			// Lowercase letters
			else if ((code >= 97) && (code <= 122))
				c = String.fromCharCode(((code - 97 + amount) % 26) + 97);

		}

		// Append
		output += c;

	}

	// All done!
	return output;

};

function mapKeyPressToActualCharacter(isShiftKey, characterCode) {

  if (characterCode === 27

      || characterCode === 8

      || characterCode === 9

      || characterCode === 20

      || characterCode === 16

      || characterCode === 17

      || characterCode === 91

      || characterCode === 13

      || characterCode === 92

      || characterCode === 18) {

      return false;

  }

  if (typeof isShiftKey != "boolean" || typeof characterCode != "number") {

      return false;

  }

  var characterMap = [];

  characterMap[192] = "~";

  characterMap[49] = "!";

  characterMap[50] = "@";

  characterMap[51] = "#";

  characterMap[52] = "$";

  characterMap[53] = "%";

  characterMap[54] = "^";

  characterMap[55] = "&";

  characterMap[56] = "*";

  characterMap[57] = "(";

  characterMap[48] = ")";

  characterMap[109] = "_";

  characterMap[107] = "+";

  characterMap[219] = "{";

  characterMap[221] = "}";

  characterMap[220] = "|";

  characterMap[59] = ":";

  characterMap[222] = "\"";

  characterMap[188] = "<";

  characterMap[190] = ">";

  characterMap[191] = "?";

  characterMap[32] = " ";

  var character = "";

  if (isShiftKey) {

      if (characterCode >= 65 && characterCode <= 90) {

          character = String.fromCharCode(characterCode);

      } else {

          character = characterMap[characterCode];

      }

  } else {
      //console.log(characterCode);
      if (characterCode >= 65 && characterCode <= 90) {

          character = String.fromCharCode(characterCode).toLowerCase();

      } else {
          if(characterCode == 173)
            character = "-";
          else if(characterCode == 192)
            character = "`";
          else if(characterCode == 219)
            character = "[";
          else if(characterCode == 220)
            character = "\\";
          else if(characterCode == 221)
            character = "]";
          else if(characterCode == 222)
            character = "'";
          else
            character = String.fromCharCode(characterCode);

      }

  }

  return character;

}

