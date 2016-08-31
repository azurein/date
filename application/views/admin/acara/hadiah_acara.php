
    <div id="addEditModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Tambah/Ubah Acara</h4></div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="control-label">Nama Hadiah</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Deskripsi</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Urutan </label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Total Pemenang</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Gambar </label>
                            <input type="file">
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
    <div id="imageModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Gambar Hadiah xxxxx xxxxx</h4></div>
                <div class="modal-body"><img class="img-responsive" src="../../assets/img/prize-sample.jpg"></div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup </button>
                </div>
            </div>
        </div>
    </div>
    <div id="winnerModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Pemenang Hadiah xxxxx xxxxx</h4></div>
                <div class="modal-body">
                    <form>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Kode Kartu</th>
                                        <th>Nama Peserta</th>
                                        <th>Grup </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>xxxxx xxxxx </td>
                                        <td>xxxxx xxxxx&nbsp; </td>
                                        <td>xxxxx</td>
                                    </tr>
                                    <tr>
                                        <td>xxxxx xxxxx&nbsp; </td>
                                        <td>xxxxx xxxxx&nbsp; </td>
                                        <td>xxxxx </td>
                                    </tr>
                                    <tr>
                                        <td>xxxxx xxxxx&nbsp; </td>
                                        <td>xxxxx xxxxx&nbsp; </td>
                                        <td>xxxxx </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup </button>
                </div>
            </div>
        </div>
    </div>
    <div id="settingModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Pengaturan Pemenang</h4></div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="radio">
                                <label class="control-label">
                                    <input type="radio">Berdasarkan Peserta</label>
                            </div>
                            <input class="form-control" type="text" disabled="">
                        </div>
                        <div class="form-group">
                            <div class="radio">
                                <label class="control-label">
                                    <input type="radio" checked="">Berdasarkan Grup</label>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label class="control-label">
                                            <input type="checkbox">VIP</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label class="control-label">
                                            <input type="checkbox">Keluarga</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label class="control-label">
                                            <input type="checkbox">Teman</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tutup </button>
                    <button class="btn btn-success" type="button" data-dismiss="modal">Simpan </button>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Anda yakin menghapus Hadiah xxxxx xxxxx?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tidak </button>
                    <button class="btn btn-success" type="button">Ya </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <fieldset>
                    <legend>Hadiah Acara</legend>
                </fieldset>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama Hadiah</th>
                                <th>Gambar</th>
                                <th>Urutan</th>
                                <th>Total Pemenang</th>
                                <th>Pemenang </th>
                                <th>Tindakan </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>xxxxx xxxxx </td>
                                <td> <i class="fa fa-image showImage"></i></td>
                                <td>xx </td>
                                <td>xx </td>
                                <td> <i class="fa fa-trophy showWinner"></i></td>
                                <td><i class="glyphicon glyphicon-cog showSetting"></i> <i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteButton"></i></td>
                            </tr>
                            <tr>
                                <td>xxxxx xxxxx </td>
                                <td> <i class="fa fa-image showImage"></i></td>
                                <td>xx </td>
                                <td>xx </td>
                                <td> <i class="fa fa-trophy showWinner"></i></td>
                                <td><i class="glyphicon glyphicon-cog showSetting"></i> <i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteButton"></i></td>
                            </tr>
                            <tr>
                                <td>xxxxx xxxxx </td>
                                <td> <i class="fa fa-image showImage"></i></td>
                                <td>xx </td>
                                <td>xx </td>
                                <td> <i class="fa fa-trophy showWinner"></i></td>
                                <td><i class="glyphicon glyphicon-cog showSetting"></i> <i class="glyphicon glyphicon-pencil editButton"></i><i class="glyphicon glyphicon-trash deleteButton"></i></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="active" colspan="7">
                                    <div class="btn-group" role="group">
                                        <button id="addButton" class="btn btn-primary" type="button">Tambah Hadiah</button>
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