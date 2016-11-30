    <div id="validationAlertModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="validationAlertName"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup </button>
                </div>
            </div>
        </div>
    </div>
    <div id="tableDetailModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" style="text-align:center;font-weight:bold;"><span id="tableName"></span></h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover dataTable" id="tableDetail">
                        <thead>
                            <th>Nama Fasilitas</th>
                            <th>Nama Peserta</th>
                            <th>Waktu Hadir</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup </button>
                </div>
            </div>
        </div>
    </div>
    <div id="addEditModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><span id="txtAddEditFacilityTitle"></span> Fasilitas</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Nama Fasilitas</label>
                                    <input id="txtAddEditFacilityName" class="form-control" type="text" maxlength="30">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Jenis Fasilitas</label>
                                    <select id="ddlAddEditFacilityType" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Grup</label>
                                    <select id="ddlAddEditFacilityGroup" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Fasilitas Dari</label>
                                    <select id="ddlAddEditFacilityFrom" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal </button>
                    <button id="btnAddEditFaciliy" class="btn btn-success" type="button" data-dismiss="modal">Simpan </button>
                </div>
            </div>
        </div>
    </div>
    <div id="participantFacilityModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Pengguna Fasilitas</h4></div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Peserta </label>
                                    <input id="txtParticipant" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Status </label>
                                    <select id="ddlStatusParticipant" class="form-control">
                                        <option value="0" selected="">Available</option>
                                        <option value="1" selected="">Booking</option>
                                        <option value="2">Check In</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal </button>
                    <button id="btnSaveParticipantFacility" class="btn btn-success" type="button" data-dismiss="modal">Simpan </button>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteCanvasModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Anda yakin menghapus Denah <span id="deleteSketchName"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tidak </button>
                    <button id="btnDeleteSketch" class="btn btn-success" type="button" data-dismiss="modal">Ya </button>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteFacilityModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Anda yakin menghapus Fasilitas <span id="deleteFacilityName"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tidak </button>
                    <button id="btnDeleteFacility" class="btn btn-success" type="button" data-dismiss="modal">Ya </button>
                </div>
            </div>
        </div>
    </div>
    <div id="uploadCanvasImageModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Upload Gambar</h4>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" name="formUpload" id="formUpload" method="post" action="">
                        <div class="form-group" >
                            <label class="control-label">Gambar</label>
                            <input id="ufUploadCanvasImage" type="file" name="userfile" accept="image/*" style="color: white;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                    <button id="btnSaveCanvasImage" class="btn btn-success" type="button" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Denah Acara</legend>
                </fieldset>
                <!--Canvas-->
                <div id="FullCanvas">
                    <div id="CanvasBorder" contenteditable>
                        <canvas id="canvasOne" width="600" height="400">
                        Your browser does not support HTML5 canvas.
                        </canvas>
                    </div>
                </div>
                <!-- <input id="uploadExcelTemplate" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none;"> -->
                <input id="uploadExcelTemplate" type="file" style="display:none;">
                <img src="../../assets/img/denah/default.jpg" id="imgBackgroundCanvas" style="display:none;"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="input-group input-group-denah">
                        <div class="input-group-btn">
                            <button id="btnPrevCanvas" class="btn btn-default" type="button"> <i class="fa fa-arrow-left"></i></button>
                            <?php if ($_SESSION['privilege'] == 1) { ?>
                                <button id="btnAddFacility" class="btn btn-default" type="button"> <i class="fa fa-sitemap"></i></button>
                            <?php } ?>
                            <button id="btnDownloadExcel" class="btn btn-default" type="button"> <i class="fa fa-download"></i></button>
                            <?php if ($_SESSION['privilege'] == 1) { ?>
                                <button id="btnUploadExcel" class="btn btn-default" type="button"> <i class="fa fa-upload"></i></button>
                            <?php } ?>
                        </div>
                        <input id="txtCanvasName"  class="form-control" type="text">
                        <div class="input-group-btn">
                            <?php if ($_SESSION['privilege'] == 1) { ?>
                                <button id="btnUploadCanvasImage" class="btn btn-default" type="button"> <i class="fa fa-image"></i></button>
                            <?php } ?>
                            <button id="btnPrintCanvas" class="btn btn-default" type="button"> <i class="fa fa-print"></i></button>
                            <?php if ($_SESSION['privilege'] == 1) { ?>
                                <button id="btnDeleteCanvasVerification" class="btn btn-default" type="button"> <i class="fa fa-trash"></i></button>
                            <?php } ?>
                            <button id="btnNextCanvas" class="btn btn-default" type="button"> <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table" id="tableInfo">
                        <thead>
                            <tr>
                                <th>Ringkasan Fasilitas</th>
                                <th>Keterangan Meja</th>
                                <th>Keterangan Kursi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <ul>
                                        <li>Meja &nbsp;
                                            <i class="fa fa-circle" style="color: #68ff6f"></i>&nbsp;<span id="count_parent_1">0</span> &nbsp;
                                            <i class="fa fa-circle" style="color: #fff222"></i>&nbsp;<span id="count_parent_2">0</span> &nbsp;
                                            <i class="fa fa-circle" style="color: #ff8b8b"></i>&nbsp;<span id="count_parent_3">0</span>
                                        </li>
                                        <li>Kursi &nbsp;
                                            <i class="fa fa-circle" style="color: #33cc00"></i>&nbsp;<span id="count_child_1">0</span> &nbsp;
                                            <i class="fa fa-circle" style="color: #ff8533"></i>&nbsp;<span id="count_child_2">0</span> &nbsp;
                                            <i class="fa fa-circle" style="color: #ff2b2b"></i>&nbsp;<span id="count_child_3">0</span>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="legend-points">
                                        <li><i class="fa fa-circle" style="color: #68ff6f"></i> &nbsp; Meja masih tersedia seluruh kursinya</li>
                                        <li><i class="fa fa-circle" style="color: #fff222"></i> &nbsp; Meja masih tersedia beberapa kursinya</li>
                                        <li><i class="fa fa-circle" style="color: #ff8b8b"></i> &nbsp; Meja sudah tidak tersedia kursinya</li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="legend-points">
                                        <li><i class="fa fa-circle" style="color: #33cc00"></i> &nbsp; Kursi masih tersedia</li>
                                        <li><i class="fa fa-circle" style="color: #ff8533"></i> &nbsp; Kursi sudah dipesan</li>
                                        <li><i class="fa fa-circle" style="color: #ff2b2b"></i> &nbsp; Kursi sudah ditempati</li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if ($_SESSION['privilege'] == 1) { ?>
                    <div class="panel-group" role="tablist" aria-multiselectable="true" id="accordionFacility">
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div id="canvas_container"></div>
</body>
<!-- JS untuk Canvas-->
<script src = "../../Assets/js/canvas.js"></script>
</html>
