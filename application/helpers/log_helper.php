<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function helper_log($tipe = "", $str = "")
{
    $CI = &get_instance();
    $CI->load->model('m_user');

    $user_data = $CI->m_user->get_by_username($CI->session->userdata('username'));

    // paramter
    $param['UserID'] = $user_data->UserID;
    $param['Tipe'] = $tipe;
    $param['Deskripsi'] = $str;

    //load model log
    $CI->load->model('m_log');

    //save to database
    $CI->m_log->save_log($param);
}
