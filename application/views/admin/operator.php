
    <div id="addEditModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="addEditTitle" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Nama Operator</label>
                            <input id="nameTxt" type="text" class="form-control" name="nameTxt" required>
                        </div>
                        <div class="form-group">
                            <label>Hak Akses</label>
                            <select id="privilegeDdl" class="form-control">
                                <option value="1">Admin</option>
                                <option value="2">Operator</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input id="usernameTxt" type="text" class="form-control" name="usernameTxt" autocomplete="new-username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="passwordTxt" type="text" class="form-control" name="passwordTxt" autocomplete="new-password" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <button id="saveButton" type="button" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="deleteName"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                    <button id="deleteButton" type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                 <div class="panel-group" role="tablist" aria-multiselectable="true" id="accordion-2">
                     <div class="panel panel-default">
                         <div class="panel-heading" role="tab">
                             <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion-2" aria-expanded="false" href="#accordion-2 .item-1">Scan via QR Scanner</a></h4>
                         </div>
                         <div class="panel-collapse collapse in item-1" role="tabpanel">
                             <div class="well" >
                                 <form id="scannerFormQr">
                                     <label>Kode</label>
                                     <input type="text" id="scannerInputQr" class="form-control" autocomplete="off" autofocus>
                                 </form>
                             </div>
                         </div>
                     </div>
                     <div class="panel panel-default">
                         <div class="panel-heading" role="tab">
                             <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion-2" aria-expanded="false" href="#accordion-2 .item-2">Scan via Camera</a></h4>
                         </div>
                         <div class="panel-collapse collapse item-2" role="tabpanel">
                             <div class="well" >
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
                                     <input id="threshold" onchange="Page.changeThreshold();" type="range" min="0" max="512" value="0"><br>
                                     <label id="sharpness-value" width="100">Sharpness: off</label>
                                     <input id="sharpness" onchange="Page.changeSharpness();" type="checkbox"><br>
                                     <label id="grayscale-value" width="100">grayscale: off</label>
                                     <input id="grayscale" onchange="Page.changeGrayscale();" type="checkbox"><br>
                                     <label id="flipVertical-value" width="100">Flip Vertical: off</label>
                                     <input id="flipVertical" onchange="Page.changeVertical();" type="checkbox"><br>
                                     <label id="flipHorizontal-value" width="100">Flip Horizontal: off</label>
                                     <input id="flipHorizontal" onchange="Page.changeHorizontal();" type="checkbox"><br>
                                 </div>
                                 <p id="scanned-QR"></p>
                             </div>
                         </div>
                     </div>
                 </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <fieldset>
                    <legend>Operator <i class="fa fa-refresh icon-refresh-animate"></i></legend>
                </fieldset>
                <!--
                <form>
                    <input id="search" class="form-control search" type="text" placeholder="Pencarian terkait Operator" autocomplete="off">
                </form>
                s-->

                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="operatorDataTable">
                        <thead>
                            <tr>
                                <th>Nama Operator</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Hak Akses</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="contentTable"></tbody>
                        <tfoot>
                            <tr>
                                <td class="active" colspan="5">
                                    <div class="btn-group" role="group">
                                        <button id="addButton" class="btn btn-primary" type="button">Tambah Operator</button>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer></footer>
</body>

</html>
