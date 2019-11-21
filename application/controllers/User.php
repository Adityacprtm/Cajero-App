<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data['title'] = 'Cajero - User ' . $this->session->userdata('username');
        $data['username'] = $this->session->userdata('username');
        $data['user'] = $this->m_user->get_by_username($this->session->userdata('username'));

        $this->load->view('components/vc_head', $data);
        $this->load->view('components/vc_wrapper', $data);
        $this->load->view('v_user', $data);
        $this->load->view('components/vc_modal_logout');
        $this->load->view('components/vc_modal_delete');
        $this->load->view('components/vc_footer');
        $this->load->view('components/vc_end');
    }

    public function users()
    {
        if ($this->session->userdata('kelas') != 1) redirect(base_url('user'));

        $data['title'] = 'Cajero - List User';
        $data['username'] = $this->session->userdata('username');

        $this->load->view('components/vc_head', $data);
        $this->load->view('components/vc_wrapper', $data);
        $this->load->view('v_list_user', $data);
        $this->load->view('components/vc_modal_logout');
        $this->load->view('components/vc_footer');
        $this->load->view('components/vc_end');
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            if ($this->input->post("nama-depan") && $this->input->post("nama-belakang")) {
                $data['NamaDepan'] = $this->input->post("nama-depan");
                $data['NamaBelakang'] = $this->input->post("nama-belakang");
                if ($this->m_user->update_profil($data, $this->input->post('user-id'))) {
                    helper_log("edit", "mengubah profil");
                    $this->session->set_flashdata('success', 'Profil user berhasil diubah');
                    redirect(base_url('user'));
                }
            }
            $this->session->set_flashdata('error', 'Profil tidak boleh kosong!');
            redirect(base_url('user'));
        } else {
            redirect(base_url('user'));
        }
    }

    public function password()
    {
        if (isset($_POST['submit'])) {
            if ($this->input->post("password") == $this->input->post("repassword")) {
                $new_password['Password'] = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
                if ($this->m_user->update_password($new_password, $this->input->post('user-id'))) {
                    helper_log("edit", "mengubah password");
                    $this->session->set_flashdata('success', 'Password berhasil diubah');
                    redirect(base_url('user'));
                }
                $this->session->set_flashdata('error', 'Oops! telah terjadi kesalahan');
                redirect(base_url('user'));
            } else {
                $this->session->set_flashdata('error', 'Password tidak sama!');
                redirect(base_url('user'));
            }
        } else {
            redirect(base_url('user'));
        }
    }

    public function delete($username = null)
    {
        if (!isset($username)) redirect(base_url('user'));

        if ($this->session->userdata('username') != $username || !$this->session->userdata('username')) show_error('Forbidden!', 403);

        if ($this->m_user->delete($username)) {
            helper_log("delete", "menghapus akun");
            $this->session->sess_destroy();
            redirect(base_url('login'));
        }
    }

    public function approve($id = null)
    {
        if (!isset($id) || $this->session->userdata('kelas') != 1) redirect(base_url('user'));

        $user = $this->m_user->get_by_id($id);
        $data['Status'] = 1;

        if ($this->m_user->update_profil($data, $user->UserID)) {
            helper_log("apprv", "menyetujui akun username " . $user->Username);
            $this->session->set_flashdata('success', 'Akun <strong>' . $user->Username . '</strong> telah disetujui');
            redirect(base_url('user/users'));
        }
    }

    public function decline($id = null)
    {
        if (!isset($id) || $this->session->userdata('kelas') != 1) redirect(base_url('user'));

        $user = $this->m_user->get_by_id($id);
        $data['Status'] = 3;

        if ($this->m_user->update_profil($data, $user->UserID)) {
            helper_log("decln", "menolak akun username " . $user->Username);
            $this->session->set_flashdata('success', 'Akun <strong>' . $user->Username . '</strong> ditolak');
            redirect(base_url('user/users'));
        }
    }

    public function wait($id = null)
    {
        if (!isset($id) || $this->session->userdata('kelas') != 1) redirect(base_url('user'));

        $user = $this->m_user->get_by_id($id);
        $data['Status'] = 2;

        if ($this->m_user->update_profil($data, $user->UserID)) {
            helper_log("wait", "mengubah status Menunggu akun username " . $user->Username);
            $this->session->set_flashdata('success', 'Akun <strong>' . $user->Username . '</strong> berstatus menunggu');
            redirect(base_url('user/users'));
        }
    }
}
