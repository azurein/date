    <div id="validationAlertModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="validationAlertName"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Ya </button>
                </div>
            </div>
        </div>
    </div>
    <div id="addEditModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><span id="txtAddEditFacilityTitle"></span> Fasilitas</h4></div>
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
                </fieldset><!-- <img class="img-responsive" src="../../assets/img/denah-sample.jpg"></div> -->
                <!--Canvas-->
                <div id="FullCanvas">
                    <div id="CanvasBorder" contenteditable>
                        <canvas id="canvasOne" width="1200" height="800">
                        Your browser does not support HTML5 canvas.
                        </canvas>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="input-group input-group-denah">
                        <div class="input-group-btn">
                            <button id="btnPrevCanvas" class="btn btn-default" type="button"> <i class="fa fa-arrow-left"></i></button>
                            <button id="btnAddFacility" class="btn btn-default" type="button"> <i class="fa fa-sitemap"></i></button>
                            <button class="btn btn-default" type="button"> <a href="../../uploads/template_fasilitas.xlsx" target="_blank"><i class="fa fa-download"></i></a></button>
                            <button class="btn btn-default" type="button"> <i class="fa fa-upload"></i></button>
                        </div>
                        <input id="txtCanvasName"  class="form-control" type="text">
                        <div class="input-group-btn">
                            <button id="btnUploadCanvasImage" class="btn btn-default" type="button"> <i class="fa fa-image"></i></button>
                            <button id="btnDeleteCanvasVerification" class="btn btn-default" type="button"> <i class="fa fa-trash"></i></button>
                            <button id="btnNextCanvas" class="btn btn-default" type="button"> <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel-group" role="tablist" aria-multiselectable="true" id="accordionFacility">
                    <!--<div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            <h4 class="text-warning panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordionFacility" aria-expanded="false" href="#accordionFacility .item-1">Meja 1 - VIP</a>
                                <span class="collapse-action">
                                    <i class="glyphicon glyphicon-plus addButton"></i>
                                    <i class="glyphicon glyphicon-pencil editButton"></i>
                                    <i class="glyphicon glyphicon-trash deleteFacilityButton"></i>
                                </span>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse in item-1" role="tabpanel">
                            <div class="panel-body"><span><a href="#" class="participantFacilityButton">Kursi 1A - 18912312319 Robin Cosamas </a></span><span class="collapse-action"><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i></span></div>
                            <div class="panel-body"><span><a href="#" class="participantFacilityButton">Kursi 1B - Available</a></span><span class="collapse-action"><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i></span></div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            <h4 class="text-success panel-title">
                                <span class="collapse-action">
                                    <i class="glyphicon glyphicon-plus addButton"></i>
                                    <i class="glyphicon glyphicon-pencil editButton"></i>
                                    <i class="glyphicon glyphicon-trash deleteFacilityButton"></i>
                                </span>
                                <a role="button" data-toggle="collapse" data-parent="#accordionFacility" aria-expanded="false" href="#accordionFacility .item-2">Meja 2 - Keluarga</a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse item-2" role="tabpanel">
                            <div class="panel-body"><span><a href="#" class="participantFacilityButton">Kursi 2A - Available </a></span><span class="collapse-action"><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i></span></div>
                            <div class="panel-body"><span><a href="#" class="participantFacilityButton">Kursi 2B - Available </a></span><span class="collapse-action"><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i></span></div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            <h4 class="text-danger panel-title"><span class="collapse-action"><i class="glyphicon glyphicon-plus addButton"></i><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i></span><a role="button" data-toggle="collapse" data-parent="#accordionFacility" aria-expanded="true" href="#accordionFacility .item-3">Meja 3 - Teman</a></h4></div>
                        <div class="panel-collapse collapse item-3" role="tabpanel">
                            <div class="panel-body"><span> <a href="#">Kursi 3A - 18912312320 Agustinus Dios </a></span><span class="collapse-action"><i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteFacilityButton"></i></span></div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <footer></footer>
</body>
<!-- JS untuk Canvas-->
<script src = "../../Assets/js/Canvas.js"></script>
</html>
