
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
