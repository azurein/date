
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
                            <label>Nama Peserta</label>
                            <div class="row">
                                <div class="col-md-3 col-xs-12">
                                    <select id="titleDdl" class="form-control"></select>
                                </div>
                                <div class="col-md-9 col-xs-12">
                                    <input id="participantName" type="text" class="form-control" name="participantName">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9 col-xs-12">
                                    <label>Grup</label>
                                    <select id="groupDdl" class="form-control"></select>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <label>Follower</label>
                                    <input id="participantFollower" type="text" class="form-control" name="participantFollower">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Diwakilkan Oleh</label>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <input id="participantDelegate" type="text" class="form-control" name="participantDelegate" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <button id="saveButton" type="button" class="btn btn-success" data-dismiss="modal">Simpan</button>
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

    <div id="resetCardModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="resetName"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                    <button id="resetButton" type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
                </div>
            </div>
        </div>
    </div>

    <div id="messageModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="message"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
                </div>
                <p id="scanned-QR"></p>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <fieldset>
                    <legend>Peserta <i class="fa fa-refresh icon-refresh-animate"></i></legend>
                </fieldset>
                <!--                                
                <form>
                    <input id="search" class="form-control search" type="text" placeholder="Pencarian terkait peserta" autocomplete="off">
                </form> 
                s-->

                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="participantDataTable">
                        <thead>
                            <tr>
                                <th>Kode Kartu</th>
                                <th>Nama Peserta</th>
                                <th>Group </th>
                                <th> <i class="fa fa-users"></i></th>
                                <th>Status Kehadiran</th>
                                <th>Tindakan </th>
                            </tr>
                        </thead>
                        <tbody id="contentTable"></tbody>
                        <tfoot>
                            <tr>
                                <td class="active" colspan="5">
                                    <div class="btn-group" role="group">
                                        <button id="addButton" class="btn btn-primary" type="button">Tambah Peserta</button>
                                        <label id="importButton" class="btn btn-success" type="button">
                                            Import Excel
                                            <input id="importInput" name="userfile" type="file" style="display:none;">
                                        </label>
                                        <button id="exportButton" class="btn btn-success" type="button">Export Excel</button>
                                    </div>
                                </td>

                                <td class="summary-right active">
                                    Hadir: <span id="totalVerified">0</span>
                                    <span class="summary-spacing"></span>
                                    Tidak Hadir: <span id="totalUnverified">0</span>
                                    <span class="summary-spacing"></span>
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