
    <div id="confirmPopup" class="modal fade" role="dialog">
        <div class="modal-dialog fullscreen-modal">
            <div class="modal-content fullscreen-modal-content">
                <div class="modal-body">
                    Apakah Anda yakin mengacak ulang <span class="lottery-title">[Nama Hadiah XXXXXX]<span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger reshuffle-btn" data-dismiss="modal">Ya</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid prize-bg">
        <div class="row">
            <div id="container" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <fieldset>
                    <legend class="lottery-title">
                    <!--Undian Berhadiah Gelas Cantik-->
                    </legend>
                </fieldset>
                
                <!-- <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 lottery-col"><span class="label label-default winner-candidate">08xxxxxx321 - Nama Peserta</span></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 lottery-col"><span class="label label-default winner-candidate">08xxxxxx321 - Nama Peserta</span></div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 lottery-col"><span class="label label-default winner-candidate">08xxxxxx321 - Nama Peserta</span></div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lottery-col"><span class="label label-default winner-candidate">08xxxxxx321 - Nama Peserta</span></div>
                </div> -->
                <div id="rowT" class="row" style="display:none;"></div>
            </div>
        </div>
    </div>
    <footer class="navbar-fixed-bottom">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <button id="prev-prize" class="btn btn-link btn-lg lottery-btn" type="button"><i class="glyphicon glyphicon-chevron-left pull-left"></i> Hadiah Sebelumnya</button>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <button id="trigger-btn" class="btn btn-success btn-lg lottery-btn lottery-start" type="button">START</button>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <button id="next-prize" class="btn btn-link btn-lg lottery-btn" type="button">Hadiah Selanjutnya <i class="glyphicon glyphicon-chevron-right pull-right"></i></button>
            </div>
        </div>
    </footer>
</body>
</html>
