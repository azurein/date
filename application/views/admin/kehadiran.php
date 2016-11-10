
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
                                <div class="form-group"><label>Pendamping </label>
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
                                <div class="form-group"><label>Pendamping </label>
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
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <fieldset>
                    <legend>Kehadiran <i class="fa fa-refresh"></i></legend>
                </fieldset>
                <!--
                <form>
                    <input id="search" class="form-control search" type="text" placeholder="Pencarian terkait kehadiran">
                </form>
                -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="verification-log">
                        <thead>
                            <tr>
                                <th>Kode Kartu</th>
                                <th>Nama Peserta</th>
                                <th>Waktu Hadir</th>
                                <th>Nama Operator</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="contentTable"></tbody>
                        <tfoot>
                            <tr>
                                <td class="active" colspan="4">
                                    <!--<div class="btn-group" role="group">
                                        <button class="btn btn-success" type="button">Import Excel</button>
                                        <button class="btn btn-success" type="button">Export Excel</button>
                                    </div> -->
                                    <button class="btn btn-success" type="button" id="exportButton" >Export Excel</button>
                                </td>
                                <td class="summary-right active">
                                    Total peserta terverifikasi:
                                    <span id="totalVerified">0</span> / <span id="totalParticipant">0</span>
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
