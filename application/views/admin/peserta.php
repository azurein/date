
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
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><img class="img-responsive" src="assets/img/qr.png"></div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <fieldset>
                    <legend>Kelola Peserta</legend>
                </fieldset>
                <form>
                    <input id="search" class="form-control search" type="text" placeholder="Pencarian terkait peserta" autocomplete="off">
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
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
                                <td class="active" colspan="6">
                                    <!-- <form id="x" method="POST" action="http://localhost:88/peserta/index.php/Kelola_peserta/upload" enctype="multipart/form-data" accept-charset="UTF-8"> -->
                                    <div class="btn-group" role="group">
                                        <button id="addButton" class="btn btn-primary" type="button">Tambah Peserta</button>
                                        <label id="importButton" class="btn btn-success" type="button">
                                            Import Excel
                                            <input id="importInput" name="userfile" type="file" style="display:none;">
                                        </label>
                                        <!-- <input id="importInput" name="userfile" type="file"> -->
                                        <button id="exportButton" class="btn btn-success" type="button">Export Excel</button>
                                    </div>
                                    <!-- </form> -->
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <nav class="pagination">
                    <ul class="pagination">
                        <li><a aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                        <li><a>1</a></li>
                        <li><a>2</a></li>
                        <li><a>3</a></li>
                        <li><a>4</a></li>
                        <li><a>5</a></li>
                        <li><a aria-label="Next"><span aria-hidden="true">»</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <footer></footer>
</body>

</html>