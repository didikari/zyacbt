<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZYA CBT
 * Audit Trail Model for Student Exam Activities
 */
class Cbt_tes_user_log_model extends CI_Model {
    public $table = 'cbt_tes_user_log';

    public function __construct() {
        parent::__construct();
        
        // Auto-migration: check if table exists, if not, create it
        if (!$this->db->table_exists($this->table)) {
            $this->load->dbforge();
            
            $fields = array(
                'tesslog_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'tesslog_tesuser_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'unsigned' => TRUE
                ),
                'tesslog_action' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'tesslog_info' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'tesslog_ip' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 45
                ),
                'tesslog_ua' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                'tesslog_time' => array(
                    'type' => 'TIMESTAMP',
                    'null' => FALSE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('tesslog_id', TRUE);
            $this->dbforge->add_key('tesslog_tesuser_id');
            $this->dbforge->create_table($this->table);
            
            // Set default CURRENT_TIMESTAMP to tesslog_time
            $this->db->query("ALTER TABLE `cbt_tes_user_log` MODIFY `tesslog_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        }
    }

    function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function insert_log($tesuser_id, $action, $info = '') {
        $data = array(
            'tesslog_tesuser_id' => $tesuser_id,
            'tesslog_action' => $action,
            'tesslog_info' => $info,
            'tesslog_ip' => $this->input->ip_address(),
            'tesslog_ua' => $this->input->user_agent()
        );
        return $this->save($data);
    }

    function get_by_tesuser_id($tesuser_id) {
        $this->db->where('tesslog_tesuser_id', $tesuser_id)
                 ->from($this->table)
                 ->order_by('tesslog_id', 'ASC');
        return $this->db->get();
    }

    function get_datatable($start, $rows, $tesuser_id) {
        $this->db->where('tesslog_tesuser_id', $tesuser_id)
                 ->from($this->table)
                 ->order_by('tesslog_id', 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
    }

    function get_datatable_count($tesuser_id) {
        $this->db->select('COUNT(*) AS hasil')
                 ->where('tesslog_tesuser_id', $tesuser_id)
                 ->from($this->table);
        return $this->db->get();
    }
}
