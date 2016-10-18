
    <div id="addEditModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="addEditTitle">Tambah/Ubah Acara</h4></div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Nama Acara</label>
                                    <input id="EventText" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Jenis Acara</label>
                                    <select id="EventTypeDdl" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Waktu Mulai </label>
                                    <input id="StartDate" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Waktu Selesai </label>
                                    <input id="EndDate" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Alamat </label>
                            <textarea id="AddressText" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Kota </label>
                                    <select id="CityDdl" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Jumlah Peserta</label>
                                    <input id="ParticipantText" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal </button>
                    <button id="saveButton" class="btn btn-success" type="button">Simpan </button>
                </div>
            </div>
        </div>
    </div>
    <div id="souvenirModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Souvenir </h4></div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <form id="souvenirForm">
                            <table id="souvenirTable" class="table table-striped table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Nama Souvenir</th>
                                        <th>Jumlah Souvenir</th>
                                        <th>Tindakan </th>
                                    </tr>
                                </thead>
                                <tbody id="contentSouvenir"></tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup </button>
                    <button id="saveSouvenirButton" class="btn btn-success" type="button" data-dismiss="modal">Simpan </button>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="deleteName">Anda yakin menghapus Acara?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tidak </button>
                    <button id="deleteEventButton" class="btn btn-success" type="button">Ya </button>
                </div>
            </div>
        </div>
    </div>
    <div id="activateModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tidak </button>
                    <button id="changeStatusButton" class="btn btn-success" type="button">Ya </button>
                </div>
            </div>
        </div>
    </div>
    <div id="forbidModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Sudah ada acara yang aktif</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup </button>
                </div>
            </div>
        </div>
    </div>
    <div id="warningModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Silahkan aktifkan salah satu acara untuk operasional.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup </button>
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
                    <legend> Pengaturan Acara</legend>
                </fieldset>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="eventDataTable">
                        <thead>
                            <tr>
                                <th class="col-md-2">Nama Acara</th>
                                <th class="col-md-1">Jenis Acara</th>
                                <th class="col-md-4">Lokasi </th>
                                <th class="col-md-1">Durasi (menit) </th>
                                <th class="col-md-1">Jumlah Undangan </th>
                                <th class="col-md-1">Aktif </th>
                                <th class="col-md-2">Tindakan </th>
                            </tr>
                        </thead>
                        <tbody id="contentTable"></tbody>
                        <tfoot>
                            <tr>
                                <td class="active" colspan="7">
                                    <div class="btn-group" role="group">
                                        <?php
                                        if ($_SESSION['privilege'] == 1) { ?>
                                        <button class="btn btn-primary" type="button" id="addButton">Tambah Acara</button>
                                        <?php
                                        } ?>
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
