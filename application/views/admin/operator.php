
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
                            <label>Nama Operator</label>
                            <input id="nameTxt" type="text" class="form-control" name="nameTxt" required>
                        </div>
                        <div class="form-group">
                            <label>Hak Akses</label>
                            <select id="privilegeDdl" class="form-control">
                                <option value="1">Admin</option>
                                <option value="2">Operator</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input id="usernameTxt" type="text" class="form-control" name="usernameTxt" autocomplete="new-username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="passwordTxt" type="text" class="form-control" name="passwordTxt" autocomplete="new-password" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <button id="saveButton" type="button" class="btn btn-success">Simpan</button>
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


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <fieldset>
                    <legend>Operator <i class="fa fa-refresh icon-refresh-animate"></i></legend>
                </fieldset>
                <!--
                <form>
                    <input id="search" class="form-control search" type="text" placeholder="Pencarian terkait Operator" autocomplete="off">
                </form>
                s-->

                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="operatorDataTable">
                        <thead>
                            <tr>
                                <th>Nama Operator</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Hak Akses</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="contentTable"></tbody>
                        <tfoot>
                            <tr>
                                <td class="active" colspan="5">
                                    <div class="btn-group" role="group">
                                        <button id="addButton" class="btn btn-primary" type="button">Tambah Operator</button>
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
