<?php defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model("m_produk");
        $this->load->model("m_log");
        if ($this->session->userdata('status') != 'login' || $this->session->userdata('username') == null) redirect(base_url('login'));
    }

    public function index()
    {
        $data['title'] = 'Cajero - Log ' . $this->session->userdata('username');
        $data['username'] = $this->session->userdata('username');
        if ($this->session->userdata('kelas') == 1) {
            $data['logs'] = $this->m_log->get_query("SELECT L.*, U.Username FROM log AS L INNER JOIN user AS U ON L.UserID = U.UserID ORDER BY L.Waktu ASC");
        } else {
            $user = $this->m_user->get_by_username($data['username']);
            $data['logs'] = $this->m_log->get_query_by_user_id("SELECT L.*, U.Username FROM log AS L INNER JOIN user AS U ON L.UserID = U.UserID WHERE L.UserID = " . $user->UserID . " ORDER BY L.Waktu ASC");
        }

        $this->load->view('components/vc_head', $data);
        $this->load->view('components/vc_wrapper', $data);
        $this->load->view('v_log', $data);
        $this->load->view('components/vc_modal_logout');
        $this->load->view('components/vc_footer');
        $this->load->view('components/vc_end');
    }

    public function log_download()
    {
        helper_log("unduh", "mengunduh log aktivitas");
        $file_path = FCPATH . "logs/" . $this->session->userdata('username') . ".log";
        $file = fopen($file_path, "w") or die("Unable to open file!");

        // $type = filetype(FCPATH . "logs/" . $this->session->userdata('username') . ".txt");

        if ($this->session->userdata('kelas') == 1) {
            $logs = $this->m_log->get_query("SELECT L.*, U.Username FROM log AS L INNER JOIN user AS U ON L.UserID = U.UserID ORDER BY L.Waktu ASC");
        } else {
            $logs = $this->m_log->get_query_by_user_id("SELECT L.*, U.Username FROM log AS L INNER JOIN user AS U ON L.UserID = U.UserID WHERE L.UserID = " . $this->session->userdata('username') . " ORDER BY L.Waktu ASC");
        }

        $count = 0;
        fwrite($file, "NO\tTIME\t\t\tUSER\t\tTYPE\t\tDESCRIPTION\n");
        foreach ($logs as $log) {
            $count++;
            fwrite($file, $count . "\t" . $log->Waktu . "\t" . $log->Username . "\t\t" . $log->Tipe . "\t\t" . $log->Deskripsi . "\n");
        };
        fclose($file);

        // Send file headers
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment;filename=" . date("Y/m/d H:i:s") . "-" . $this->session->userdata('username') . ".log");
        header("Content-Transfer-Encoding: binary");
        header('Pragma: no-cache');
        header('Expires: 0');
        // Send the file contents.
        // set_time_limit(0);
        readfile($file_path);
    }
}
