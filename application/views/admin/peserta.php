
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><img class="img-responsive" src="assets/img/qr.png"></div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <fieldset>
                    <legend> Peserta</legend>
                </fieldset>
                <form>
                    <input class="form-control search" type="text" placeholder="Pencarian terkait peserta">
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Kode Kartu</th>
                                <th>Nama Peserta</th>
                                <th>Grup </th>
                                <th> <i class="fa fa-users"></i></th>
                                <th>Status Kehadiran</th>
                                <th>Tindakan </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>xxxxx </td>
                                <td>Ms. xxxxx xxxxx</td>
                                <td>xxxxx </td>
                                <td>xx </td>
                                <td>Hadir </td>
                                <td> <i class="glyphicon glyphicon-pencil"></i><i class="glyphicon glyphicon-trash"></i></td>
                            </tr>
                            <tr>
                                <td>xxxxx </td>
                                <td>Ms. xxxxx xxxxx </td>
                                <td>xxxxx </td>
                                <td>xx </td>
                                <td>Belum hadir</td>
                                <td> <i class="glyphicon glyphicon-pencil"></i><i class="glyphicon glyphicon-trash"></i></td>
                            </tr>
                            <tr>
                                <td>xxxxx </td>
                                <td>Mr. xxxxx xxxxx&nbsp; </td>
                                <td>xxxxx </td>
                                <td>xx </td>
                                <td>Belum hadir</td>
                                <td> <i class="glyphicon glyphicon-pencil"></i><i class="glyphicon glyphicon-trash"></i></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="active" colspan="6">
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary" type="button">Tambah Peserta</button>
                                        <button class="btn btn-success" type="button">Import Excel</button>
                                        <button class="btn btn-success" type="button">Export Excel</button>
                                    </div>
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
    <div class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Anda yakin menghapus Peserta Mr. xxxxx xxxxx?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Tidak </button>
                    <button class="btn btn-success" type="button">Ya </button>
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
                        <div class="form-group"><span class="label label-default">Nama Peserta</span>
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
                                <div class="form-group"><span class="label label-default">Grup </span>
                                    <select class="form-control">
                                        <option value="2" selected="">VIP</option>
                                        <option value="3">Family</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group"><span class="label label-default">Follower </span>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><span class="label label-default">Diwakilkan oleh</span>
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
                        <div class="form-group"><span class="label label-default">Nama Peserta</span>
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
                                <div class="form-group"><span class="label label-default">Grup </span>
                                    <select class="form-control">
                                        <option value="2" selected="">VIP</option>
                                        <option value="3">Family</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group"><span class="label label-default">Follower </span>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><span class="label label-default">Diwakilkan oleh</span>
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

</body>

</html>