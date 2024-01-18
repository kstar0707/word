/*
Copyright 2017 Google Inc.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/

'use strict';

var videoElement = document.querySelector('video');
var audioSelect = document.querySelector('select#audioSource');
var videoSelect = document.querySelector('select#videoSource');

navigator.mediaDevices.enumerateDevices()
    .then(gotDevices).then(getStream).catch(handleError);
// console.log(getStream());
audioSelect.onchange = getStream;
videoSelect.onchange = getStream;

function gotDevices(deviceInfos) {
    for (var i = 0; i !== deviceInfos.length; ++i) {
        var deviceInfo = deviceInfos[i];
        var option = document.createElement('option');
        option.value = deviceInfo.deviceId;

        if (deviceInfo.kind === 'audioinput') {
            option.text = deviceInfo.label ||
                'microphone ' + (audioSelect.length + 1);
            audioSelect.appendChild(option);
        } else if (deviceInfo.kind === 'videoinput') {
            if (deviceInfo.label == 'camera 1, facing front')
                var option_text = '前面のカメラ';// front camera
            if (deviceInfo.label == 'camera 0, facing back')
                var option_text = '背面カメラ';// back camera
            option.text = option_text;
            // option.text = deviceInfo.label || 'camera ' +
            //     (videoSelect.length + 1);
            // alert(videoSelect.length+'========'+deviceInfo.label);
            videoSelect.appendChild(option);
        } else {
            console.log('Found one other kind of source/device: ', deviceInfo);
        }
    }

    var textToFind = '背面カメラ'; // back camera

    var videoSource = document.getElementById('videoSource');
    for (var i1 = 0; i1 < videoSource.options.length; i1++) {
        if (videoSource.options[i1].text === textToFind) {
            videoSource.selectedIndex = i1;
            break;
        }
    }
}

function getStream() {
    if (window.stream) {
        window.stream.getTracks().forEach(function (track) {
            track.stop();
        });
    }

    // if(videoSelect.value==''){
    var constraints = {
        audio: {
            deviceId: {exact: audioSelect.value}
        },
        video: {
            deviceId: {exact: videoSelect.value}
        }
    };
    // }else{
    //     var constraints = {
    //         "audio": false,
    //         "video": {
    //             width: 500,
    //             height: 375,
    //             facingMode: 'environment',
    //             // deviceId: { exact: videoDevices[1]  }
    //         }
    //     };
    // }


    navigator.mediaDevices.getUserMedia(constraints).then(gotStream).catch(handleError);
}

function gotStream(stream) {
    window.stream = stream; // make stream available to console
    videoElement.srcObject = stream;
}

function handleError(error) {
    console.log('Error: ', error);
}

