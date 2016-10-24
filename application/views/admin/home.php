
    <div class="modal fade" role="dialog" tabindex="-1" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="deleteName"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tidak </button>
                    <button class="btn btn-success" type="button" id="deleteButton" data-dismiss="modal">Ya </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Tambah Peserta</h4></div>
                <div class="modal-body">
                    <form>
                        <div class="form-group"><label>Nama Peserta</label>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <select class="form-control">
                                        <option value="1" selected="">Mr.</option>
                                        <option value="2">Ms.</option>
                                    </select>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <div class="form-group"><label>Grup </label>
                                    <select class="form-control">
                                        <option value="2" selected="">VIP</option>
                                        <option value="3">Family</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group"><label>Undangan </label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label>Diwakilkan oleh</label>
                            <input class="form-control" type="text">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal </button>
                    <button class="btn btn-success" type="button">Simpan </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Ubah Peserta</h4></div>
                <div class="modal-body">
                    <form>
                        <div class="form-group"><label>Nama Peserta</label>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <select class="form-control">
                                        <option value="1" selected="">Mr.</option>
                                        <option value="2">Ms.</option>
                                    </select>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                <div class="form-group"><label>Grup </label>
                                    <select class="form-control">
                                        <option value="2" selected="">VIP</option>
                                        <option value="3">Family</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group"><label>Undangan </label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label>Diwakilkan oleh</label>
                            <input class="form-control" type="text">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal </button>
                    <button class="btn btn-success" type="button">Simpan </button>
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
                                <form id="scannerFormQr2">
                                    <label>Kode</label>
                                    <input type="text" id="scannerInputQr2" class="form-control" autocomplete="off" autofocus>
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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <ul class="nav nav-tabs">
                    <li id="tab-menu1" class="active"><a data-toggle="tab" href="#menu1">Verifikasi</a></li>
                    <li id="tab-menu2"><a data-toggle="tab" href="#menu2">Daftar ditempat</a></li>
                </ul><br>
                <div class="tab-content">
                    <div id="menu1" class="tab-pane fade in active">
                        <form id="scannerFormQr">
                            <input type="text" id="scannerInputQr" class="form-control" autocomplete="off" style="display: none;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <label>Nama Peserta</label>
                                        <input id="participantName1" type="text" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label>Kontak</label>
                                        <input id="participantContact1" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 col-xs-12">
                                        <label>Grup</label>
                                        <input id="groupName" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <label>Undangan</label>
                                        <input id="participantFollower1" type="number" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <label>Jumlah Souvenir</label>
                                        <input id="totalSouvenir" type="number" class="form-control" name="totalSouvenir" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h4>Fasilitas</h4>
                                <table class="table table-striped table-hover" id="listFacilityTable">
                                    <thead>
                                        <tr>
                                            <th>Ruang</th>
                                            <th>Grup</th>
                                            <th>Meja</th>
                                            <th>Kursi</th>
                                            <th>Penempatan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listFacilityContent"></tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <h4>Mewakilkan</h4>
                                <table class="table table-striped table-hover" id="listRepresentationTable">
                                    <thead>
                                        <tr>
                                            <th>Kode Kartu</th>
                                            <th>Nama Peserta</th>
                                            <th>Kontak</th>
                                            <th>Diwakilkan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listRepresentationContent"></tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <button id="scannerFormQrSubmit" type="submit" class="btn btn-success">Verifikasi</button>
                            </div>
                        </form>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <form id="onTheSpotForm">
                            <div class="form-group">
                                <label>Nama Peserta</label>
                                <div class="row">
                                    <div class="col-md-3 col-xs-12">
                                        <select id="titleDdl" class="form-control"></select>
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <input id="participantName2" type="text" class="form-control" name="participantName2" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kontak</label>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <input id="participantContact2" type="text" class="form-control" name="participantContact2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 col-xs-12">
                                        <label>Grup</label>
                                        <select id="groupDdl" class="form-control"></select>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <label>Undangan</label>
                                        <input id="participantFollower2" type="number" class="form-control" name="participantFollower2" required>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <label>Jumlah Souvenir</label>
                                        <input id="totalSouvenir2" type="number" class="form-control" name="totalSouvenir2" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button id="checkFacilityBtn" type="button" class="btn btn-info">Cek Ketersediaan</button>
                            </div>
                            <div class="form-group">
                                <table class="table table-striped table-hover" id="listFacilityTable">
                                    <thead>
                                        <tr>
                                            <th>Ruang</th>
                                            <th>Grup</th>
                                            <th>Meja</th>
                                            <th>Kursi</th>
                                            <th>Penempatan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listFacilityContent2"></tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <button id="onTheSpotFormSubmit" type="submit" class="btn btn-success">Daftar dan Verifikasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer></footer>
</body>

</html>
