<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?php if(!empty($site_name)){ echo $site_name; } ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/manager"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?php echo site_url(); ?>/manager/peserta_daftar" style="color: inherit; display: block; text-decoration: none;">
                <div class="info-box" style="cursor: pointer;">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Peserta</span>
                        <span class="info-box-number"><?php echo $total_siswa; ?></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </a>
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?php echo site_url(); ?>/manager/tes_daftar" style="color: inherit; display: block; text-decoration: none;">
                <div class="info-box" style="cursor: pointer;">
                    <span class="info-box-icon bg-green"><i class="fa fa-file-text-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Ujian</span>
                        <span class="info-box-number"><?php echo $total_ujian; ?></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </a>
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?php echo site_url(); ?>/manager/modul_soal" style="color: inherit; display: block; text-decoration: none;">
                <div class="info-box" style="cursor: pointer;">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-question-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Soal</span>
                        <span class="info-box-number"><?php echo $total_soal; ?></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </a>
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?php echo site_url(); ?>/manager/tes_hasil" style="color: inherit; display: block; text-decoration: none;">
                <div class="info-box" style="cursor: pointer;">
                    <span class="info-box-icon bg-red"><i class="fa fa-history"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Log Aktivitas</span>
                        <span class="info-box-number"><?php echo $total_log; ?></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </a>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Charts Row -->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Partisipasi Ujian (Top 10)</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart-container" style="position: relative; height:250px;">
                        <canvas id="partisipasiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Tren Aktivitas Ujian (7 Hari Terakhir)</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart-container" style="position: relative; height:250px;">
                        <canvas id="aktivitasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Tribute</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            Teruntuk Putri kami tercinta. Asyfiya Aniqa Putri, 28 Februari 2018 – 1 Maret 2018
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Perjanjian Penggunaan</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <dl>
                <dd>
                    Dengan menggunakan ZYA CBT, maka anda setuju untuk :
                    <ol>
                        <li>Tidak mengubah Nama Aplikasi Ujian Online <b>ZYA CBT</b> menjadi nama aplikasi lain</li>
                        <li>Tidak mengubah footer yang menunjukkan alamat website Aplikasi Ujian Online ZYA CBT</li>
                        <li>Tidak menjual Aplikasi Ujian Online ZYA CBT</li>
						<li>Tidak mengambil keuntungan dari Aplikasi Ujian Online ZYA CBT tanpa ijin</li>
                        <li>Tidak menghapus tribute dan Perjanjian Penggunaan</li>
                    </ol>
                    Semoga Aplikasi Ujian Online ZYA CBT dapat bermanfaat untuk kita semua.
                </dd>
            </dl>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
	<div class="callout callout-info">
    	<h4>Informasi</h4>
        <p>Ini adalah area administratif ZYA CBT, yang memiliki platform dan bahasa user-friendly untuk membuat, mengelola dan melaksanakan ujian online.</p>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <div class="box-title">Konfigurasi System</div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <b><u>Waktu Server</u></b>
                    <br />
                    <b><?php if(!empty($waktu_server)){ echo $waktu_server; } ?></b>
                    <br />
					<u>Timezone</u>
                    <br />
                    <b><?php if(!empty($timezone)){ echo $timezone; } ?></b>
                    <br />
                    Pastikan waktu server sesuai dengan waktu saat ini. Jika ada perbedaan, cek timezone server dan timezone di konfigurasi PHP.
                </div>
                <div class="col-md-4">
                    <b><u>Informasi Konfigurasi Upload PHP</u></b>
                    <br />
                    POST_MAX_SIZE = <?php if(!empty($post_max_size)){ echo $post_max_size; } ?>
                    <br />
                    UPLOAD_MAX_FILESIZE = <?php if(!empty($upload_max_filesize)){ echo $upload_max_filesize; } ?>
                </div>
                <div class="col-md-4">
                    <b><u>Folder Upload</u></b>
                    <br />
                    Folder "uploads" = <?php if(!empty($dir_public_uploads)){ echo $dir_public_uploads; } ?>
                    <br />
                    Folder "public/uploads" = <?php if(!empty($dir_uploads)){ echo $dir_uploads; } ?>
                    <br />
                    Pastikan kedua folder diatas memiliki nilai Writeable.
                </div>
            </div>
            <p>
            </p>
        </div>
    </div>
    <div class="box box-success box-solid">
		<div class="box-header with-border">
        	<h3 class="box-title">Petunjuk Penggunaan</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        	<dl>
        		<dt>Data Modul</dt>
                <dd>
                	Kelompok Data Modul digunakan untuk menambah modul, topik, dan soal. Serta digunakan untuk mengatur file dengan memanfaatkan File Manager.
                	<ol>
                		<li>Topik</li>
                		<li>Soal</li>
                		<li>Import Soal Word</li>
						<li>Import Soal Spreadsheet</li>
                		<li>Daftar Soal</li>
                		<li>File Manager</li>
                	</ol>
                </dd>
                <dt>Data Peserta</dt>
                <dd>
                	Kelompok Data Peserta digunakan untuk mengatur Peserta, dan Group.
                	<ol>
                		<li>Daftar Group</li>
                		<li>Daftar Peserta</li>
                		<li>Import Data Peserta</li>
						<li>Cetak Kartu</li>
						<li>Reset Login</li>
                	</ol>
                <dt>Data Tes</dt>
                <dd>
                	Kelompok Data Tes digunakan untuk mengatur Tes, mengevaluasi jawaban essay, dan melihat Hasil tes.
                	<ol>
                		<li>Tambah Tes</li>
                		<li>Daftar Tes</li>
                		<li>Evaluasi Tes</li>
                		<li>Hasil tes</li>
                		<li>Token</li>
                	</ol>
                </dd>
				<dt>Laporan</dt>
                <dd>
                	Laporan digunakan untuk menampilkan analisis butir soal, dan rekap hasil tes.
                	<ol>
                		<li>Analisis Butir Soal</li>
                        <li>Rekap Hasil Tes</li>
                	</ol>
                </dd>
                <dt>Tool</dt>
                <dd>
                    Kelompok Tool digunakan untuk membackup database, file pedukung soal, dan Export Import Data Soal
                    <ol>
                        <li>Backup Data</li>
                        <li>Export Import Soal</li>
                    </ol>
                </dd>
            </dl>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(function() {
    var rawLabels = <?php echo $partisipasi_labels; ?>;
    var rawData = <?php echo $partisipasi_data; ?>;
    
    var ctx1 = document.getElementById('partisipasiChart').getContext('2d');
    
    if (rawLabels.length === 0) {
        // Render a centered text info inside the canvas if no exams are registered yet
        ctx1.font = "14px sans-serif";
        ctx1.fillStyle = "#999";
        ctx1.textAlign = "center";
        ctx1.textBaseline = "middle";
        ctx1.fillText("Belum ada data partisipasi ujian", ctx1.canvas.width / 2, ctx1.canvas.height / 2);
    } else {
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: rawLabels,
                datasets: [{
                    label: 'Jumlah Peserta',
                    data: rawData,
                    backgroundColor: 'rgba(60,141,188,0.7)',
                    borderColor: 'rgba(60,141,188,1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }

    var ctx2 = document.getElementById('aktivitasChart').getContext('2d');
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: <?php echo $aktivitas_labels; ?>,
            datasets: [{
                label: 'Aktivitas Ujian',
                data: <?php echo $aktivitas_data; ?>,
                backgroundColor: 'rgba(221,75,57,0.1)',
                borderColor: 'rgba(221,75,57,1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
});
</script>