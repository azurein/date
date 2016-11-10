
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
                            <label>Kontak</label>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <input id="participantContact" type="text" class="form-control" name="participantContact">
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
                                    <label>Pendamping</label>
                                    <input id="participantFollower" type="number" class="form-control" name="participantFollower">
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
                    <!-- <div class="checkbox pull-left"><label><input id="participantConfirm" type="checkbox" name="participantConfirm" />Konfirmasi</label></div> -->
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

    <div id="facilityModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="facilityTitle" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <table id="facilityTable" class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Ruang</th>
                                <th>Grup</th>
                                <th>Meja</th>
                                <th>Kursi</th>
                            </tr>
                        </thead>
                        <tbody id="contentFacility"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
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

    <div id="messageModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="message"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
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
                                <th>Kontak</th>
                                <th>Group </th>
                                <th> <i class="fa fa-users"></i></th>
                                <th>Waktu Hadir</th>
                                <th>Konfirmasi</th>
                                <th>Tindakan </th>
                            </tr>
                        </thead>
                        <tbody id="contentTable"></tbody>
                        <tfoot>
                            <tr>
                                <td class="active" colspan="7">
                                    <div class="btn-group" role="group">
                                        <?php
                                        if ($_SESSION['privilege'] == 1) { ?>
                                        <button id="addButton" class="btn btn-primary" type="button">Tambah Peserta</button>
                                        <label id="importButton" class="btn btn-success" type="button">
                                            Import Excel
                                            <input id="importInput" name="userfile" type="file" style="display:none;">
                                        </label>
                                        <?php
                                        } ?>
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
