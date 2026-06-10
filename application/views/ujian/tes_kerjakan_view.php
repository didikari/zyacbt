<div class="container">
	<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tes : <?php if(!empty($tes_name)){ echo $tes_name; } ?>
        </h1>
        <div class="breadcrumb">
            <img src="<?php echo base_url(); ?>public/images/zoom.png" style="cursor: pointer;" height="20" onclick="zoomnormal()" title="Klik ukuran font normal" />&nbsp;&nbsp;
            <img src="<?php echo base_url(); ?>public/images/zoom.png" style="cursor: pointer;" height="26" onclick="zoombesar()" title="Klik ukuran font lebih besar" />
        </div>
    </section>

	<!-- Main content -->
    <section class="content">
    	<div class="row">
        <?php echo form_open('tes_kerjakan/simpan_jawaban','id="form-kerjakan"')?>
            <input type="hidden" name="tes-id" id="tes-id" value="<?php if(!empty($tes_id)){ echo $tes_id; } ?>">
            <input type="hidden" name="tes-user-id" id="tes-user-id" value="<?php if(!empty($tes_user_id)){ echo $tes_user_id; } ?>">
            <input type="hidden" name="tes-soal-id" id="tes-soal-id" value="<?php if(!empty($tes_soal_id)){ echo $tes_soal_id; } ?>">
            <input type="hidden" name="tes-soal-nomor" id="tes-soal-nomor"  value="<?php if(!empty($tes_soal_nomor)){ echo $tes_soal_nomor; } ?>">
            <input type="hidden" name="tes-soal-jml" id="tes-soal-jml" value="<?php if(!empty($tes_soal_jml)){ echo $tes_soal_jml; } ?>">
            <input type="hidden" name="tes-soal-ragu" id="tes-soal-ragu" value="<?php if(!empty($tes_ragu)){ echo $tes_ragu; } ?>">
    		<div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Soal <span id="judul-soal"><?php if(!empty($tes_soal_nomor)){ echo 'ke '.$tes_soal_nomor; } ?></span></h3>
                    <div class="box-tools pull-right">
                        <div class="pull-right">
                            <div id="sisa-waktu"></div>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <style>
                        #isi-tes-soal {
                            -webkit-user-select: none;
                            -moz-user-select: none;
                            -ms-user-select: none;
                            user-select: none;
                        }
                        #isi-tes-soal textarea, #isi-tes-soal input[type="text"] {
                            -webkit-user-select: text;
                            -moz-user-select: text;
                            -ms-user-select: text;
                            user-select: text;
                        }
                    </style>
                    <div id="isi-tes-soal" style="font-size: 15px;">
                        <?php if(!empty($tes_soal)){ echo $tes_soal; } ?>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" class="btn btn-default <?php if(!empty($tes_soal_nomor) && $tes_soal_nomor==1){ echo "hide"; } ?>" id="btn-sebelumnya">Soal Sebelumnya</button>&nbsp;&nbsp;&nbsp;
                    <div class="btn btn-warning" id="btn-ragu" onclick="ragu()">
                        <input type="checkbox" style="width:10px;height:10px;" name="btn-ragu-checkbox" id="btn-ragu-checkbox" <?php if(!empty($tes_ragu)){ echo "checked"; } ?> /> Ragu-ragu
                    </div>&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-default <?php if(!empty($tes_soal_nomor) && !empty($tes_soal_jml) && $tes_soal_nomor==$tes_soal_jml){ echo "hide"; } ?>" id="btn-selanjutnya">Soal Selanjutnya</button>
                </div>
            </div><!-- /.box -->
        </form>
    	</div>
        <div class="row">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Soal</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php if(!empty($tes_daftar_soal)){ echo $tes_daftar_soal; } ?>
                    <p class="help-block">Soal yang sudah dijawab akan berwarna Biru.</p>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default pull-right" id="btn-hentikan">Hentikan Tes</button>
                </div>
            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->

    <div class="modal" style="max-height: 100%;overflow-y: auto;" id="modal-hentikan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/hentikan_tes','id="form-hentikan"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Konfirmasi Hentikan Tes</div>
                </div>
                <div class="modal-body" >
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan"></div>
                            <div class="callout callout-info">
                                <p>Apakah anda yakin mengakhiri mata uji ini ?
								<br />Jawaban Tes yang sudah selesai tidak dapat diubah.
								</p>
								
                            </div>
                            <div class="form-group">
                                <label>Nama Tes</label>
                                <input type="hidden" name="hentikan-tes-id" id="hentikan-tes-id" >
                                <input type="hidden" name="hentikan-tes-user-id" id="hentikan-tes-user-id" >
                                <input type="text" class="form-control" id="hentikan-tes-nama" name="hentikan-tes-nama" readonly>
                            </div>

                            <div class="form-group">
                                <label>Keterangan Soal</label>
                                <input type="text" class="form-control" id="hentikan-dijawab" name="hentikan-dijawab" readonly>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="hentikan-centang" name="hentikan-centang" value="1"> Centang dan klik tombol Hentikan Tes.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="box-footer">
					<button type="submit" id="tambah-simpan" class="btn btn-primary">Hentikan Tes</button>
					<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
				</div>
            </div>
        </div>

    </form>
    </div>

    <!-- Anti-Cheat Overlay -->
    <div id="cheat-overlay" style="display: block; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 17, 23, 0.95); z-index: 9999999; flex-direction: column; align-items: center; justify-content: center; color: #fff; text-align: center; font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); display: flex;">
        <div style="background: rgba(30, 41, 59, 0.7); padding: 40px 30px; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1); max-width: 520px; width: 90%; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
            <div style="font-size: 64px; color: #ef4444; margin-bottom: 20px; animation: pulse 2s infinite;">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <h2 style="font-size: 26px; font-weight: 700; margin: 0 0 12px 0; color: #fff; letter-spacing: -0.5px;">Mode Ujian Wajib Layar Penuh</h2>
            <p style="font-size: 15px; color: #94a3b8; line-height: 1.6; margin: 0 0 30px 0;">
                Untuk menjaga integritas dan keamanan ujian, Anda diwajibkan mengerjakan soal dalam mode layar penuh (fullscreen). Menolak atau keluar dari mode ini akan dicatat sebagai pelanggaran.
            </p>
            <button onclick="requestFullscreenMode()" style="background: #10b981; color: #fff; border: none; padding: 14px 32px; font-size: 16px; font-weight: 600; border-radius: 8px; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4); outline: none;">
                <i class="fa fa-arrows-alt"></i> &nbsp; Masuk Layar Penuh & Lanjutkan Ujian
            </button>
        </div>
    </div>
    <style>
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        #cheat-overlay button:hover {
            background: #059669 !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6) !important;
        }
        #cheat-overlay button:active {
            transform: translateY(1px);
        }
    </style>
</div><!-- /.container -->

<script type="text/javascript">
    function saveAnswerLocal(tessoal_id, answerVal) {
        var testUserId = $('#tes-user-id').val();
        var backupKey = 'cbt_answers_' + testUserId;
        var answers = JSON.parse(localStorage.getItem(backupKey) || '{}');
        
        answers[tessoal_id] = {
            'tes-id': $('#tes-id').val(),
            'tes-user-id': testUserId,
            'tes-soal-id': tessoal_id,
            'tes-soal-nomor': $('#tes-soal-nomor').val(),
            'soal-jawaban': answerVal,
            'synced': false,
            'timestamp': Date.now()
        };
        
        localStorage.setItem(backupKey, JSON.stringify(answers));
    }

    function markAnswerSynced(tessoal_id) {
        var testUserId = $('#tes-user-id').val();
        var backupKey = 'cbt_answers_' + testUserId;
        var answers = JSON.parse(localStorage.getItem(backupKey) || '{}');
        
        if (answers[tessoal_id]) {
            answers[tessoal_id].synced = true;
            localStorage.setItem(backupKey, JSON.stringify(answers));
        }
    }

    function syncOfflineAnswers() {
        var testUserId = $('#tes-user-id').val();
        var backupKey = 'cbt_answers_' + testUserId;
        var answers = JSON.parse(localStorage.getItem(backupKey) || '{}');
        
        var unsyncedIds = [];
        for (var id in answers) {
            if (answers.hasOwnProperty(id) && !answers[id].synced) {
                unsyncedIds.push(id);
            }
        }
        
        if (unsyncedIds.length === 0) {
            $('#sync-status-indicator').hide();
            return;
        }
        
        if ($('#sync-status-indicator').length === 0) {
            $('#sisa-waktu').after('<div id="sync-status-indicator" class="pull-right" style="margin-right: 15px; color: #f39c12;"><i class="fa fa-refresh fa-spin"></i> Mensinkronisasi jawaban...</div>');
        } else {
            $('#sync-status-indicator').show();
        }
        
        var idToSync = unsyncedIds[0];
        var dataToSync = answers[idToSync];
        
        $.ajax({
            url: "<?php echo site_url().'/'.$url; ?>/simpan_jawaban",
            type: "POST",
            data: {
                'tes-id': dataToSync['tes-id'],
                'tes-user-id': dataToSync['tes-user-id'],
                'tes-soal-id': dataToSync['tes-soal-id'],
                'tes-soal-nomor': dataToSync['tes-soal-nomor'],
                'soal-jawaban': dataToSync['soal-jawaban']
            },
            cache: false,
            timeout: 5000,
            success: function(respon) {
                var obj = $.parseJSON(respon);
                if (obj.status == 1) {
                    markAnswerSynced(idToSync);
                    $('#btn-soal-' + dataToSync['tes-soal-nomor']).removeClass('btn-default btn-warning').addClass('btn-primary');
                    syncOfflineAnswers();
                } else if (obj.status == 2) {
                    localStorage.removeItem(backupKey);
                    window.location.reload();
                }
            },
            error: function() {
                // Silence error, retry next time
            }
        });
    }

    function showConnectionNotification(isOnline) {
        var bar = $('#connection-bar');
        if (bar.length === 0) {
            $('body').append('<div id="connection-bar" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 99999; text-align: center; padding: 12px; font-weight: bold; font-size: 14px; color: #fff; display: none; box-shadow: 0 2px 5px rgba(0,0,0,0.2); transition: all 0.3s ease;"></div>');
            bar = $('#connection-bar');
        }
        if (isOnline) {
            bar.css('background-color', '#00a65a')
               .html('<i class="fa fa-check-circle"></i> Koneksi internet terhubung kembali. Sinkronisasi jawaban...')
               .slideDown();
            setTimeout(function() {
                bar.slideUp();
            }, 3000);
        } else {
            bar.css('background-color', '#dd4b39')
               .html('<i class="fa fa-exclamation-triangle"></i> Koneksi internet terputus! Anda tetap dapat menjawab, jawaban disimpan aman secara lokal.')
               .slideDown();
        }
    }

    // Register offline / online network event listeners
    window.addEventListener('offline', function() {
        showConnectionNotification(false);
    });
    window.addEventListener('online', function() {
        showConnectionNotification(true);
        syncOfflineAnswers();
    });

    // Check initial network state
    $(function() {
        if (!navigator.onLine) {
            showConnectionNotification(false);
        }
    });

    function isFullscreen() {
        return !!(document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement);
    }

    function requestFullscreenMode() {
        var element = document.documentElement;
        if (element.requestFullscreen) {
            element.requestFullscreen();
        } else if (element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) {
            element.webkitRequestFullscreen();
        } else if (element.msRequestFullscreen) {
            element.msRequestFullscreen();
        }
    }

    function force_hentikan_tes() {
        var testId = $('#tes-id').val();
        var testUserId = $('#tes-user-id').val();
        var storageKey = 'cbt_warning_count_' + testUserId;
        
        localStorage.removeItem(storageKey);
        $("#modal-proses").modal('show');
        
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_tes_info/' + testId, function(data) {
            if (data.data == 1) {
                $('#hentikan-tes-id').val(data.tes_id);
                $('#hentikan-tes-user-id').val(data.tes_user_id);
                $('#hentikan-tes-nama').val(data.tes_nama);
                $('#hentikan-centang').prop("checked", true);
                
                $.ajax({
                    url: "<?php echo site_url().'/'.$url; ?>/hentikan_tes",
                    type: "POST",
                    data: $('#form-hentikan').serialize(),
                    cache: false,
                    timeout: 10000,
                    success: function(respon) {
                        var obj = $.parseJSON(respon);
                        $("#modal-proses").modal('hide');
                        alert("Ujian Anda telah dihentikan secara otomatis oleh sistem karena terdeteksi melakukan kecurangan (pindah tab/aplikasi/keluar fullscreen sebanyak 3 kali).");
                        window.location.reload();
                    },
                    error: function() {
                        $("#modal-proses").modal('hide');
                        window.location.reload();
                    }
                });
            } else {
                $("#modal-proses").modal('hide');
                window.location.reload();
            }
        });
    }

    var lastViolationTime = 0;
    function recordViolation(reason) {
        var now = Date.now();
        if (now - lastViolationTime < 1000) {
            return;
        }
        lastViolationTime = now;
        
        var testUserId = $('#tes-user-id').val();
        var storageKey = 'cbt_warning_count_' + testUserId;
        var count = parseInt(localStorage.getItem(storageKey) || '0') + 1;
        localStorage.setItem(storageKey, count);
        
        // Kirim log kecurangan ke server
        $.ajax({
            url: "<?php echo site_url().'/'.$url; ?>/update_log_kecurangan",
            type: "POST",
            data: {
                'tes-user-id': testUserId,
                'violation-count': count
            },
            cache: false,
            success: function() {
                // Berhasil mencatat ke server
            }
        });
        
        if (count >= 3) {
            force_hentikan_tes();
        } else {
            alert("Peringatan Kecurangan!\n\nAnda terdeteksi " + reason + ".\nPelanggaran: " + count + "/3.\nJika mencapai 3 kali, ujian akan dihentikan secara otomatis.");
        }
    }

    window.cbt_initialized = false;

    function handleFullscreenChange() {
        if (isFullscreen()) {
            $('#cheat-overlay').fadeOut();
            if (!window.cbt_initialized) {
                window.cbt_initialized = true;
            }
        } else {
            $('#cheat-overlay').fadeIn();
            if (window.cbt_initialized) {
                recordViolation("keluar dari mode layar penuh (fullscreen)");
            }
        }
    }

    $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', handleFullscreenChange);

    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'hidden') {
            if (window.cbt_initialized) {
                recordViolation("berpindah tab atau keluar dari browser");
            }
        }
    });
    function zoombesar(){
        $('#isi-tes-soal').css("font-size", "140%");
        $('#isi-tes-soal').css("line-height", "140%");
    }

    function zoomnormal(){
        $('#isi-tes-soal').css("font-size", "15px");
        $('#isi-tes-soal').css("line-height", "110%");
    }

    function ragu(){
        $("#modal-proses").modal('show');

        $.ajax({
            url:'<?php echo site_url().'/'.$url; ?>/get_tes_soal_by_tessoal/'+$('#tes-soal-id').val(),
            type:"POST",
            cache: false,
            timeout: 10000,
            success:function(respon){
                var data = $.parseJSON(respon);
                if(data.data==1){
                    // Mengubah nilai ragu-ragu di database
                    if($('#tes-soal-ragu').val()==0){
                        var ragu=1;
                    }else{
                        var ragu=0;
                    }
                    $.ajax({
                            url:'<?php echo site_url().'/'.$url; ?>/update_tes_soal_ragu/'+$('#tes-soal-id').val()+'/'+ragu,
                            type:"POST",
                            cache: false,
                            timeout: 5000,
                            success:function(respon){
                                var data = $.parseJSON(respon);
                                if(data.data==1){
                                    notify_success('Jawaban Ragu-ragu berhasil diubah');
                                }
                            },
                            error: function(xmlhttprequest, textstatus, message) {
                                if(textstatus==="timeout") {
                                    $("#modal-proses").modal('hide');
                                    notify_error("Gagal mengubah Soal, Silahkan Refresh Halaman");
                                }else{
                                    $("#modal-proses").modal('hide');
                                    notify_error(textstatus);
                                }
                            }
                    });

                    // Mengubah warna daftar soal dan checkbox pada tombol ragu-ragu
                    if(data.tessoal_dikerjakan==1){
                        if($('#tes-soal-ragu').val()==0){
                            // Membuat menjadi ragu-ragu
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-primary');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-warning');
                            $('#btn-ragu-checkbox').prop("checked", true);
                            $('#tes-soal-ragu').val(1);
                        }else{
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-warning');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-primary');
                            $('#btn-ragu-checkbox').prop("checked", false);
                            $('#tes-soal-ragu').val(0);
                        }
                    }else{
                        if($('#tes-soal-ragu').val()==0){
                            // Membuat menjadi ragu-ragu
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-default');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-warning');
                            $('#btn-ragu-checkbox').prop("checked", true);
                            $('#tes-soal-ragu').val(1);
                        }else{
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-warning');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-default');
                            $('#btn-ragu-checkbox').prop("checked", false);
                            $('#tes-soal-ragu').val(0);
                        }
                    }
                }
                $("#modal-proses").modal('hide');
            },
            error: function(xmlhttprequest, textstatus, message) {
                if(textstatus==="timeout") {
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal mengubah soal, Silahkan Refresh Halaman");
                }else{
                    $("#modal-proses").modal('hide');
                    notify_error(textstatus);
                }
            }
        });
    }

    function soal(tessoal_id){
        $("#modal-proses").modal('show');
        $.ajax({
            url:'<?php echo site_url().'/'.$url; ?>/get_soal_by_tessoal/'+tessoal_id+'/'+$('#tes-user-id').val(),
            type:"POST",
            cache: false,
            timeout: 10000,
            success:function(respon){
                var data = $.parseJSON(respon);
                if(data.data==1){
                    $('#tes-soal-id').val(data.tes_soal_id);
                    $('#tes-soal-nomor').val(data.tes_soal_nomor);
                    $('#isi-tes-soal').html(data.tes_soal);
                    $('#tes-soal-ragu').val(data.tes_ragu);
                    $('#judul-soal').html('ke '+data.tes_soal_nomor);

                    if(data.tes_ragu==0){
                        // Menghilangkan checkbox ragu-ragu
                        $('#btn-ragu-checkbox').prop("checked", false);
                    }else{
                        // Menambah checkbox ragu-ragu
                        $('#btn-ragu-checkbox').prop("checked", true);
                    }

                    // Pre-fill answer if we have unsynced backup
                    var testUserId = $('#tes-user-id').val();
                    var backupKey = 'cbt_answers_' + testUserId;
                    var answers = JSON.parse(localStorage.getItem(backupKey) || '{}');
                    if (answers[data.tes_soal_id] && !answers[data.tes_soal_id].synced) {
                        var localVal = answers[data.tes_soal_id]['soal-jawaban'];
                        var radioInput = $('input[name="soal-jawaban"][value="' + localVal + '"]');
                        if (radioInput.length > 0) {
                            radioInput.prop('checked', true);
                        } else {
                            $('#soal-jawaban').val(localVal);
                        }
                    }

                    // menghilangkan tombol sebelum jika soal di nomor1
                    // dan menghilangkan tombol selanjutnya jika disoal terakhir
                    var tes_soal_nomor = parseInt($('#tes-soal-nomor').val());
                    var tes_soal_jml = parseInt($('#tes-soal-jml').val());
                    var tes_soal_tujuan = data.tes_soal_nomor;
                    if(tes_soal_tujuan==1){
                        $('#btn-sebelumnya').addClass('hide');
                        $('#btn-selanjutnya').removeClass('hide');
                    }else if(tes_soal_tujuan==tes_soal_jml){
                        $('#btn-sebelumnya').removeClass('hide');
                        $('#btn-selanjutnya').addClass('hide');
                    }else{
                        $('#btn-sebelumnya').removeClass('hide');
                        $('#btn-selanjutnya').removeClass('hide');
                    }

                }else if(data.data==2){
                    window.location.reload();
                }
                $("#modal-proses").modal('hide');
            },
            error: function(xmlhttprequest, textstatus, message) {
                if(textstatus==="timeout") {
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal mengambil Soal, Silahkan Refresh Halaman");
                }else{
                    $("#modal-proses").modal('hide');
                    notify_error(textstatus);
                }
            }
        });
    }

    function audio(status){
        var audio_player_status = $('#audio-player-status').val();
        var audio_player_update = $('#audio-player-update').val();
        if(status==1){
            if(audio_player_update==0){
                $('#audio-player-update').val('1');
                /**
                 * Update status audio jika pemutaran audio dibatasi
                 */
                $.getJSON('<?php echo site_url().'/'.$url; ?>/update_status_audio/'+$('#tes-soal-id').val(), function(data){
                    if(data.data==1){
                        notify_success(data.pesan);
                    }
                });
            }
        }
        
        if(audio_player_status==0){
            $('#audio-player-status').val('1');
            $('#audio-player').trigger('play');
            $('#audio-player-judul').html('Pause');
            $('#audio-player-judul-logo').removeClass('fa-play');
            $('#audio-player-judul-logo').addClass('fa-pause');
        }else{
            $('#audio-player-status').val('0');
            $('#audio-player').trigger('pause');
            $('#audio-player-judul').html('Play');
            $('#audio-player-judul-logo').removeClass('fa-pause');
            $('#audio-player-judul-logo').addClass('fa-play');
        }
    }

    function audio_ended(status){
        if(status==1){
            $('#audio-control').addClass('hide');
        }else{
            $('#audio-player-status').val('0');
            $('#audio-player-judul').html('Play');
            $('#audio-player-judul-logo').removeClass('fa-pause');
            $('#audio-player-judul-logo').addClass('fa-play');
        }
    }

    function jawab(){
        $('#form-kerjakan').submit();
    }

    function hentikan_tes(){
        $("#modal-proses").modal('show');
        $('#hentikan-centang').prop("checked", false);
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_tes_info/'+$('#tes-id').val(), function(data){
            if(data.data==1){
                $('#hentikan-tes-id').val(data.tes_id);
                $('#hentikan-tes-user-id').val(data.tes_user_id);
                $('#hentikan-tes-nama').val(data.tes_nama);
                $('#hentikan-dijawab').val(data.tes_dijawab+" dijawab. "+data.tes_blum_dijawab+" belum dijawab.");
                $('#hentikan-belum-dijawab').val(data.tes_blum_dijawab);


                $("#modal-hentikan").modal('show');
            }else{
                window.location.reload();
            }
            $("#modal-proses").modal('hide');
        });
    }

    function soal_navigasi(navigasi){
        var tes_soal_nomor = parseInt($('#tes-soal-nomor').val());
        var tes_soal_jml = parseInt($('#tes-soal-jml').val());
        var tes_soal_tujuan = tes_soal_nomor+navigasi;

        if((tes_soal_tujuan>=1 && tes_soal_tujuan<=tes_soal_jml)){
            $('#btn-soal-'+tes_soal_tujuan).trigger('click');
        }
    }

    $(function () {
        // Proteksi Konten Ujian: Disable Copy, Cut, Paste, Klik Kanan, dan Keyboard Shortcuts
        $(document).on('contextmenu', function(e) {
            e.preventDefault();
            alert("Fitur Klik Kanan dinonaktifkan untuk menjaga keamanan ujian.");
            return false;
        });

        $(document).on('copy', function(e) {
            e.preventDefault();
            alert("Fitur Menyalin (Copy) teks ujian dinonaktifkan.");
            return false;
        });

        $(document).on('cut', function(e) {
            e.preventDefault();
            alert("Fitur Memotong (Cut) teks ujian dinonaktifkan.");
            return false;
        });

        $(document).on('paste', function(e) {
            if ($(e.target).is('textarea') || $(e.target).is('input[type="text"]')) {
                return true;
            }
            e.preventDefault();
            alert("Fitur Menempel (Paste) dinonaktifkan.");
            return false;
        });

        $(document).on('dragstart drop', function(e) {
            if ($(e.target).is('textarea') || $(e.target).is('input[type="text"]')) {
                return true;
            }
            e.preventDefault();
            return false;
        });

        $(document).keydown(function(e) {
            var isCtrlCmd = e.ctrlKey || e.metaKey;
            
            // F12 key (Inspect Element)
            if (e.keyCode === 123) {
                e.preventDefault();
                return false;
            }
            
            // Ctrl+Shift+I / Cmd+Opt+I (Inspect Element)
            if (isCtrlCmd && e.shiftKey && e.keyCode === 73) {
                e.preventDefault();
                return false;
            }
            
            // Ctrl+C / Cmd+C (Copy)
            if (isCtrlCmd && e.keyCode === 67) {
                e.preventDefault();
                alert("Fitur Menyalin (Copy) dinonaktifkan.");
                return false;
            }
            
            // Ctrl+V / Cmd+V (Paste) in non-input areas
            if (isCtrlCmd && e.keyCode === 86) {
                if ($(e.target).is('textarea') || $(e.target).is('input[type="text"]')) {
                    return true;
                }
                e.preventDefault();
                alert("Fitur Menempel (Paste) dinonaktifkan.");
                return false;
            }
            
            // Ctrl+U / Cmd+U (View Source)
            if (isCtrlCmd && e.keyCode === 85) {
                e.preventDefault();
                return false;
            }
            
            // Ctrl+P / Cmd+P (Print Screen / Print)
            if (isCtrlCmd && e.keyCode === 80) {
                e.preventDefault();
                alert("Fitur Cetak (Print) dinonaktifkan selama ujian.");
                return false;
            }
        });

        var sisa_detik = <?php if(!empty($detik_sisa)){ echo $detik_sisa; } ?>;
        setInterval(function() {
            var sisa_menit = Math.round(sisa_detik/60);
            sisa_detik = sisa_detik-1;
            $("#sisa-waktu").html("Sisa Waktu : "+sisa_menit+" menit");

            if(sisa_detik<1){
                var testUserId = $('#tes-user-id').val();
                localStorage.removeItem('cbt_warning_count_' + testUserId);
                localStorage.removeItem('cbt_answers_' + testUserId);
                window.location.reload();
            }
        }, 1000);

        $('#btn-sebelumnya').click(function(){
            soal_navigasi(-1);
        });

        $('#btn-selanjutnya').click(function(){
            soal_navigasi(1);
        });

        $('#btn-hentikan').click(function(){
            hentikan_tes();
        });
        /**
         * Submit form soal saat sudah menjawab
         */
        $('#form-kerjakan').submit(function(){
            $("#modal-proses").modal('show');
            
            // Get current tessoal ID
            var tessoalId = $('#tes-soal-id').val();
            // Get current answer value
            var answerVal = '';
            var radioAnswer = $('input[name="soal-jawaban"]:checked');
            if (radioAnswer.length > 0) {
                answerVal = radioAnswer.val();
            } else {
                answerVal = $('#soal-jawaban').val() || '';
            }
            
            // Save locally first with synced = false
            saveAnswerLocal(tessoalId, answerVal);

            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/simpan_jawaban",
                    type:"POST",
                    data:$('#form-kerjakan').serialize(),
                    cache: false,
                    timeout: 10000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            notify_success(obj.pesan);
                            $('#btn-soal-'+obj.nomor_soal).removeClass('btn-default');
                            $('#btn-soal-'+obj.nomor_soal).removeClass('btn-warning');
                            $('#btn-soal-'+obj.nomor_soal).addClass('btn-primary');
                            
                            // Mark as synced locally
                            markAnswerSynced(tessoalId);
                        }else if(obj.status==2){
                            var testUserId = $('#tes-user-id').val();
                            localStorage.removeItem('cbt_warning_count_' + testUserId);
                            localStorage.removeItem('cbt_answers_' + testUserId);
                            window.location.reload();
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        $("#modal-proses").modal('hide');
                        notify_info("Jawaban disimpan offline secara lokal di browser dan akan disinkronisasikan otomatis saat jaringan stabil.");
                    }
            });
            return false;
        });

        /**
         * Submit form hentikan tes
         */
        $('#form-hentikan').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hentikan_tes",
                    type:"POST",
                    data:$('#form-hentikan').serialize(),
                    cache: false,
                    timeout: 10000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            var testUserId = $('#tes-user-id').val();
                            localStorage.removeItem('cbt_warning_count_' + testUserId);
                            localStorage.removeItem('cbt_answers_' + testUserId);
                            window.location.reload();
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menghentikan Tes, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });

        $( document ).ready(function() {
            if (!isFullscreen()) {
                $('#cheat-overlay').show();
            } else {
                $('#cheat-overlay').hide();
                window.cbt_initialized = true;
            }
            syncOfflineAnswers();
            setInterval(syncOfflineAnswers, 10000);
        });
    });
</script>