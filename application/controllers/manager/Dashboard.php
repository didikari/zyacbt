<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Member_Controller {
    function __construct(){
		parent:: __construct();
	}
    
    public function index(){
        $this->load->helper('form');
        $data['nama'] = $this->access->get_nama();

        $data['post_max_size'] = ini_get('post_max_size');
        $data['upload_max_filesize'] = ini_get('upload_max_filesize');
        $data['waktu_server'] = date('Y-m-d H:i:s');
		$data['timezone'] = date_default_timezone_get();

        $dir1 = './public/uploads/';
        $dir2 = './uploads/';

        $data['dir_public_uploads'] = 'Not Writeable';
        if(is_writable($dir1)){
        	$data['dir_public_uploads'] = 'Writeable';
        }

        $data['dir_uploads'] = 'Not Writeable';
        if(is_writable($dir2)){
        	$data['dir_uploads'] = 'Writeable';
        }

        // 1. Total Counts for InfoBoxes
        $data['total_siswa'] = $this->db->count_all('cbt_user');
        $data['total_ujian'] = $this->db->count_all('cbt_tes');
        $data['total_soal'] = $this->db->count_all('cbt_soal');
        $data['total_log'] = $this->db->count_all('cbt_tes_user_log');

        // 2. Query Exam Participation (Top 10)
        $q_partisipasi = $this->db->query("
            SELECT t.tes_nama, COUNT(tu.tesuser_id) AS total 
            FROM cbt_tes t 
            LEFT JOIN cbt_tes_user tu ON t.tes_id = tu.tesuser_tes_id 
            GROUP BY t.tes_id 
            ORDER BY total DESC 
            LIMIT 10
        ");
        $partisipasi_labels = array();
        $partisipasi_data = array();
        foreach ($q_partisipasi->result() as $row) {
            $partisipasi_labels[] = $row->tes_nama;
            $partisipasi_data[] = (int)$row->total;
        }

        // 3. Query Daily Exam Activity Trend (Last 7 Days)
        $aktivitas_labels = array();
        $aktivitas_data = array();
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $formatted_date = date('d M', strtotime($date));
            $aktivitas_labels[$date] = $formatted_date;
            $aktivitas_data[$date] = 0;
        }
        
        $q_aktivitas = $this->db->query("
            SELECT DATE(tesslog_time) AS tanggal, COUNT(*) AS total
            FROM cbt_tes_user_log
            WHERE tesslog_time >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            GROUP BY DATE(tesslog_time)
        ");
        foreach ($q_aktivitas->result() as $row) {
            if (isset($aktivitas_data[$row->tanggal])) {
                $aktivitas_data[$row->tanggal] = (int)$row->total;
            }
        }

        $data['partisipasi_labels'] = json_encode($partisipasi_labels);
        $data['partisipasi_data'] = json_encode($partisipasi_data);
        $data['aktivitas_labels'] = json_encode(array_values($aktivitas_labels));
        $data['aktivitas_data'] = json_encode(array_values($aktivitas_data));

        $this->template->display_admin('manager/dashboard_view', 'Dashboard', $data);
    }
	
	function password(){
        $this->load->library('form_validation');
        
		$this->form_validation->set_rules('password-old', 'Password Lama','required|strip_tags');
		$this->form_validation->set_rules('password-new', 'Password Baru','required|strip_tags');
        $this->form_validation->set_rules('password-confirm', 'Confirm Password','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
			$old = $this->input->post('password-old', TRUE);
			$new = $this->input->post('password-new', TRUE);
			$confirm = $this->input->post('password-confirm', TRUE);
			
			$username = $this->access->get_username();
			
			if($this->users_model->check_user_password($username, $old)){
				if($new==$confirm){
					$this->users_model->change_password($username, $new);
					$status['status'] = 1;
					$status['error'] = '';
				}else{
					$status['status'] = 0;
					$status['error'] = 'Kedua password baru tidak sama';
				}
			}else{
				$status['status'] = 0;
				$status['error'] = 'Password Lama tidak Sesuai';
			}
        }else{
            $status['status'] = 0;
            $status['error'] = validation_errors();
        }
        
        echo json_encode($status);
    }
}