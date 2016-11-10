
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
                                    <?php if ($_SESSION['privilege'] == 1) { ?>
                                    <div class="btn-group" role="group">
                                        <button id="btnInsert" class="btn btn-primary" type="button">Tambah Hadiah</button>
                                    </div>
                                    <?php } ?>
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
