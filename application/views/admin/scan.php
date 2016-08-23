<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WebCodeCamJS</title>
</head>
<body>
 
    <div class="container" id="QR-Code">
        <div class="panel-body text-center">
            <div class="col-md-12">
                <div class="well" style="position: relative;display: inline-block;">
                    <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
                    <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                    <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                    <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                    <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>                                        

                    <div class="well">
                        <div class="row">
                            <div class="col-xs-8">
                                <select class="form-control" id="camera-select" style="height: 25px;"></select>                                
                            </div>
                            <div class="col-xs-4">
                                <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-play"></span></button>
                                <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"></span></button>
                            </div>
                        </div>
                        <br>
                        <label id="zoom-value" width="100">Zoom: 2</label>
                        <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20">
                        <label id="brightness-value" width="100">Brightness: 0</label>
                        <input id="brightness" onchange="Page.changeBrightness();" type="range" min="0" max="128" value="0">
                        <label id="contrast-value" width="100">Contrast: 0</label>
                        <input id="contrast" onchange="Page.changeContrast();" type="range" min="-128" max="128" value="0">
                        <label id="threshold-value" width="100">Threshold: 0</label>
                        <input id="threshold" onchange="Page.changeThreshold();" type="range" min="0" max="512" value="0">
                        <label id="sharpness-value" width="100">Sharpness: off</label>
                        <input id="sharpness" onchange="Page.changeSharpness();" type="checkbox">
                        <label id="grayscale-value" width="100">grayscale: off</label>
                        <input id="grayscale" onchange="Page.changeGrayscale();" type="checkbox">
                        <br>
                        <label id="flipVertical-value" width="100">Flip Vertical: off</label>
                        <input id="flipVertical" onchange="Page.changeVertical();" type="checkbox">
                        <label id="flipHorizontal-value" width="100">Flip Horizontal: off</label>
                        <input id="flipHorizontal" onchange="Page.changeHorizontal();" type="checkbox">
                    </div>
                </div>
                <p id="scanned-QR"></p>
            </div>
        </div>
    </div>
</body>
</html>