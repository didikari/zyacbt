<div class="container">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
    		Konfirmasi Tes
            <small>Silahkan periksa kembali data tes yang akan diikuti</small>
        </h1>
	</section>

	<!-- Main content -->
    <section class="content">
        <?php echo form_open($url.'/mulai_tes','id="form-konfirmasi-tes"  class="form-horizontal"'); ?>
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Konfirmasi Data Tes</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="box-body no-padding">
                    <div id="form-pesan"></div>
                    <input type="hidden" name="tes-id" id="tes-id" value="<?php if(!empty($tes_id)){ echo $tes_id; } ?>">
                    <table class="table table-striped">
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Nama Peserta : </td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($nama)){ echo $nama; } ?></b></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Tes : </td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($tes_nama)){ echo $tes_nama; } ?></b></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Waktu : </td>
                            <td style="vertical-align: middle;"><?php if(!empty($tes_waktu)){ echo $tes_waktu; } ?></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td></td>
                            <td style="vertical-align: middle;text-align: right;">Poin Dasar : </td>
                            <td style="vertical-align: middle;"><?php if(!empty($tes_poin)){ echo $tes_poin; } ?></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td></td>
                            <td style="vertical-align: middle;text-align: right;">Poin Maksimal : </td>
                            <td style="vertical-align: middle;"><?php if(!empty($tes_max_score)){ echo $tes_max_score; } ?></td>
                            <td></td>
                        </tr>
                        <?php if(!empty($tes_token)){ echo $tes_token; } ?>
                  </table>
                  
                  <div class="well text-center" style="margin-top: 15px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 4px;">
                        <h4 style="margin-top: 0; margin-bottom: 15px;"><i class="fa fa-camera"></i> Verifikasi Foto Kehadiran (Selfie)</h4>
                        <div style="position: relative; display: inline-block; margin-bottom: 10px;">
                            <video id="webcam-preview" autoplay playsinline width="320" height="240" style="background: #333; border: 2px solid #ccc; border-radius: 4px; display: inline-block;"></video>
                            <canvas id="photo-canvas" width="320" height="240" style="display: none; border: 2px solid #00a65a; border-radius: 4px;"></canvas>
                        </div>
                        <br/>
                        <button type="button" class="btn btn-info" id="btn-capture-photo"><i class="fa fa-circle"></i> Ambil Foto</button>
                        <button type="button" class="btn btn-warning" id="btn-retake-photo" style="display: none;"><i class="fa fa-refresh"></i> Ulangi Foto</button>
                        <input type="hidden" name="user-photo" id="user-photo" value="">
                        <div id="camera-status-msg" style="margin-top: 10px; font-weight: bold; color: #dd4b39;">Menginisialisasi kamera...</div>
                  </div>
            </div><!-- /.box-body -->
            <div class="box-body">
                <button type="submit" id="btn-tambah-simpan" class="btn btn-primary pull-right">Kerjakan</button>
            </div>
        </div><!-- /.box -->
        </form>
    </section><!-- /.content -->
</div><!-- /.container -->

<script type="text/javascript">
    $(function () {
        var webcamStream = null;
        var video = document.getElementById('webcam-preview');
        var canvas = document.getElementById('photo-canvas');
        var captureBtn = document.getElementById('btn-capture-photo');
        var retakeBtn = document.getElementById('btn-retake-photo');
        var userPhotoInput = document.getElementById('user-photo');
        var statusMsg = document.getElementById('camera-status-msg');
        var submitBtn = document.getElementById('btn-tambah-simpan');

        // Disable submit button initially
        submitBtn.disabled = true;

        // Start webcam stream if mediaDevices is supported (requires HTTPS or localhost)
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: { width: 320, height: 240 } })
                .then(function(stream) {
                    webcamStream = stream;
                    video.srcObject = stream;
                    statusMsg.innerHTML = '<span style="color: #f39c12;"><i class="fa fa-info-circle"></i> Kamera siap. Silakan klik "Ambil Foto".</span>';
                })
                .catch(function(err) {
                    console.error("Webcam error: ", err);
                    statusMsg.innerHTML = '<span style="color: #dd4b39;"><i class="fa fa-exclamation-triangle"></i> Kamera tidak terdeteksi atau izin ditolak. Mohon aktifkan kamera Anda untuk mengikuti ujian.</span>';
                });
        } else {
            statusMsg.innerHTML = '<span style="color: #dd4b39;"><i class="fa fa-exclamation-triangle"></i> Akses kamera ditolak karena koneksi tidak aman. Ujian ini wajib menggunakan koneksi HTTPS atau localhost dengan kamera aktif.</span>';
            submitBtn.disabled = true;
        }

        // Capture photo
        $(captureBtn).click(function() {
            if (webcamStream) {
                var context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, 320, 240);
                var dataURL = canvas.toDataURL('image/jpeg');
                userPhotoInput.value = dataURL;

                // Stop video stream preview
                video.style.display = 'none';
                canvas.style.display = 'inline-block';

                captureBtn.style.display = 'none';
                retakeBtn.style.display = 'inline-block';

                statusMsg.innerHTML = '<span style="color: #00a65a;"><i class="fa fa-check-circle"></i> Foto berhasil diambil. Anda siap memulai ujian!</span>';
                submitBtn.disabled = false;
            }
        });

        // Retake photo
        $(retakeBtn).click(function() {
            userPhotoInput.value = '';
            canvas.style.display = 'none';
            video.style.display = 'inline-block';

            retakeBtn.style.display = 'none';
            captureBtn.style.display = 'inline-block';

            statusMsg.innerHTML = '<span style="color: #f39c12;"><i class="fa fa-info-circle"></i> Kamera aktif. Silakan klik "Ambil Foto".</span>';
            submitBtn.disabled = true;
        });

        $('#form-konfirmasi-tes').submit(function(){
            // Stop webcam stream tracks if active
            if (webcamStream) {
                webcamStream.getTracks().forEach(function(track) {
                    track.stop();
                });
            }
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/mulai_tes",
                    type:"POST",
                    data:$('#form-konfirmasi-tes').serialize(),
                    cache: false,
                    timeout: 60000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html('');
                            window.open("<?php echo site_url(); ?>/tes_kerjakan/index/"+obj.tes_id, "_self");
                        }else if(obj.status==2){
                            window.open("<?php echo site_url().'/'.$url; ?>/", "_self");
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    },
                    statusCode: {
                        500: function(respon) {
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err('Terjadi kesalahan pada persiapan Tes. Silahkan hubungi petugas.'));
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menyiapkan Tes, Halaman akan di Refresh !");
                            setInterval(function() {
                                window.location.reload();
                            }, 4000);
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                            setInterval(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    }
            });
            return false;
        });
    });
</script>