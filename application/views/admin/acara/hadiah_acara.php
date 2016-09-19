    
    <div id="insertUpdateModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="insertUpdateTitle">Tambah/Ubah Hadiah</h4>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" name="formPrize" id="formPrize" method="post" action="">
                        <div class="form-group">
                            <label class="control-label">Nama Hadiah</label>
                            <input class="form-control" type="text" id="prizeName">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Deskripsi</label>
                            <textarea class="form-control" id="prizeDescription"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Urutan</label>
                                    <input class="form-control" type="text" id="prizePriority">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Total Pemenang</label>
                                    <input class="form-control" type="text" id="totalWinner">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Gambar</label>
                                    <input type="file" name="userfile" id="prizeFile" class="input-file" data-placeholder="Gambar">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                    <button id="btnSavePrize" class="btn btn-success" type="button">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div id="imageModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="imageText"></h4>
                </div>
                <div class="modal-body">
                    <img class="img-responsive" src="" id="imagePrize">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div id="winnerModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="winnerText"></h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-condensed" id="winnerDataTable">
                                <thead>
                                    <tr>
                                        <th>Kode Kartu</th>
                                        <th>Nama Peserta</th>
                                        <th>Group</th>
                                    </tr>
                                </thead>
                                <tbody id="contentWinner">
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div id="settingModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Pengaturan Pemenang</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="radio">
                                <label class="control-label">
                                <input type="radio" name="settingWinner" id="rbParticipants" value="0">Berdasarkan Peserta</label>
                            </div>
                            <div class="templateParticipant">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="radio">
                                <label class="control-label">
                                <input type="radio" name="settingWinner" id="rbGroups" value="1">Berdasarkan Grup</label>
                            </div>
                            <ul class="list-group" disabled="">
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label class="control-label">
                                        <input type="checkbox" class="groups" value="1">VVIP</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label class="control-label">
                                        <input type="checkbox" class="groups" value="2">VIP</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label class="control-label">
                                        <input type="checkbox" class="groups" value="3">Keluarga</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label class="control-label">
                                        <input type="checkbox" class="groups" value="4">Teman</label>
                                    </div>
                                </li>
                                 <li class="list-group-item">
                                    <div class="checkbox">
                                        <label class="control-label">
                                        <input type="checkbox" class="groups" value="5">Tamu</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label class="control-label">
                                        <input type="checkbox" class="groups" value="6">Lainnya</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label class="control-label">
                                        <input type="checkbox" class="groups" value="7">Tambahan</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup</button>
                    <button id="btnSaveParticipantsOrGroups" class="btn btn-success" type="button">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="deleteTitle"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tidak</button>
                    <button id="btnDeletePrize" class="btn btn-success" type="button">Ya</button>
                </div>
            </div>
        </div>
    </div>
    <div id="messageModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="messageTitle"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup</button>
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
                <fieldset style="margin-top: 10px;">
                    <legend>Hadiah Acara</legend>
                </fieldset>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="prizeDataTable">
                        <thead>
                            <tr>
                                <th>Nama Hadiah</th>
                                <th>Gambar</th>
                                <th>Urutan</th>
                                <th>Total Pemenang</th>
                                <th>Pemenang</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="contentTable">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="active" colspan="6">
                                    <div class="btn-group" role="group">
                                        <button id="btnInsert" class="btn btn-primary" type="button">Tambah Hadiah</button>
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