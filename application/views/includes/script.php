<script type="text/javascript" src="{assets}js/jquery.min.js"></script>
<script type="text/javascript" src="{assets}bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{assets}js/plugin/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript" src="{assets}js/plugin/BootstrapFormHelpers/js/bootstrap-formhelpers.min.js"></script>
<script type="text/javascript" src="{assets}js/jquery-ui.js"></script>
<script type="text/javascript" src="{assets}js/plugin/fabric.min.js"></script>
<script type="text/javascript" src="{assets}js/plugin/jquery-minicolors-master/jquery.minicolors.js"></script>
<script type="text/javascript" src="{assets}js/plugin/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript" src="{assets}js/plugin/BootstrapFormHelpers/js/bootstrap-formhelpers.min.js"></script>
<script type="text/javascript" src="{assets}js/filereader.js"></script>
<script type="text/javascript" src="{assets}js/qrcodelib.js"></script>
<script type="text/javascript" src="{assets}js/webcodecamjquery.js"></script>
<script type="text/javascript" src="{assets}js/dataTables.min.js"></script>
<script type="text/javascript" src="{assets}js/localemoment.js"></script>
<script type="text/javascript" src="{assets}js/datetimepicker.full.js"></script>
<script type="text/javascript" src="{assets}js/webfont.js"></script>
<script type="text/javascript" src="{assets}js/scripts.js"></script>
<script type="text/javascript" src="{assets}js/page/{page}.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $.getScript("{assets}js/mainjquery.js");
    });
</script>

<script>
	var BASE_URL = "<?=base_url()?>";
    var ASSETS_URL = "{assets}";
</script>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D.A.T.E</title>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="<?php echo base_url(); ?>kehadiran">D.A.T.E </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown">
                        <a id="titleAcara" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">Acara <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="<?php echo base_url(); ?>acara/denah_acara">Denah</a></li>
                            <li role="presentation"><a href="<?php echo base_url(); ?>acara/kartu_acara">Kartu</a></li>
                            <li role="presentation"><a href="<?php echo base_url(); ?>acara/hadiah_acara">Hadiah</a></li>
                            <li role="presentation"><a href="<?php echo base_url(); ?>acara/pengaturan_acara">Pengaturan</a></li>
                        </ul>
                    </li>
                    <li class="main-menu" role="presentation"><a href="<?php echo base_url(); ?>peserta">Peserta</a></li>                
                    <li class="main-menu" role="presentation"><a href="<?php echo base_url(); ?>kehadiran"> Kehadiran</a></li>
                    <li class="main-menu" role="presentation"><a href="<?php echo base_url(); ?>undian">Undian</a></li>
                    <li class="main-menu" role="presentation"><a href="<?php echo base_url(); ?>operator">Operator</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Selamat datang, Admin <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li id="lastupdate" role="presentation"><a href="<?php echo base_url(); ?>update">Update Terakhir</a></li>
                            <li role="presentation"><a href="#">Keluar </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>