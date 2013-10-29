<?php

class Admin_model extends CI_Model {

    function view_logs() {
        $this->db->order_by('log_id', 'desc');
        $res = $this->db->get('tbl_log_manager');
        if ($res->num_rows() > 0) {
            return $res->result();
        }
    }

    function getlogUser($user_id) {
        $admin = $this->session->userdata('admin');
        $branch_id = $this->db->get_where('tbl_admin', array('admin_username' => $admin))->row()->branch_id;
        $res = mysql_query("SELECT username FROM tbl_users WHERE user_id = '$user_id' AND branch_id = '$branch_id' LIMIT 1");
        $row = mysql_fetch_row($res);
        return $row[0];
    }

    function delete_log() {
        $log_id = $this->uri->segment(3);
        mysql_query("DELETE FROM tbl_log_manager WHERE log_id = '$log_id'");
    }

    function admin_content() {
        $q = "select * from tbl_staticpages where staticpage_id=20";
        $res = mysql_query($q);
        if (mysql_num_rows($res) > 0) {
            return $res;
        }
        else
            return NULL;
    }

    function verifyLoginModel() {
        echo "Test";
    }

    function listAdmins() {
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->join('tbl_branch','tbl_admin.branch_id=tbl_branch.branch_id');
        $this->db->where('tbl_admin.user_type',1);
        return $this->db->get()->result();
    }

    function getAllBranches() {

        $admins = $this->db->get('tbl_admin')->result();

        foreach ($admins as $admin) {
            $bran[] = $admin->branch_id;
        }

       // if (!empty($bran)) {
         //   $this->db->where_not_in('branch_id', $bran);
         //   return $this->db->get('tbl_branch')->result();
        //} else {
            return $this->db->get('tbl_branch')->result();
        }
    

    function getBranchName($branchId) {
        $this->db->select('branch_name');
        return $this->db->get_where('tbl_branch', array('branch_id' => $branchId))->row();
    }

    function addAdmin() {
        $fullname = $this->input->post('admin_fullname');
        $username = $this->input->post('admin_username');
        $password = $this->input->post('admin_password');
        $email1 = $this->input->post('admin_email1');
        $email2 = $this->input->post('admin_email2');
        $contact = $this->input->post('admin_contact');
        $branchId = $this->input->post('branch_id');

        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;

        $data = array(
            'admin_fullname' => $fullname,
            'admin_username' => $username,
            'admin_password' => $password,
            'admin_email1' => $email1,
            'admin_email2' => $email2,
            'admin_contact' => $contact,
            'branch_id' => $branchId,
            'status' => $active
        );

        return $this->db->insert('tbl_admin', $data);
    }

    function editAdmin() {
        $id = $this->uri->segment(3);
        $fullname = $this->input->post('admin_fullname');
        $username = $this->input->post('admin_username');
        $password = $this->input->post('admin_password');
        $email1 = $this->input->post('admin_email1');
        $email2 = $this->input->post('admin_email2');
        $contact = $this->input->post('admin_contact');
        $branchId = $this->input->post('branch_id');

        if (isset($_POST['active'])) {
            $active = 1;
        }
        else
            $active = 0;

        $data = array(
            'admin_fullname' => $fullname,
            'admin_username' => $username,
            'admin_password' => $password,
            'admin_email1' => $email1,
            'admin_email2' => $email2,
            'admin_contact' => $contact,
            'branch_id' => $branchId,
            'status' => $active
        );
        $this->db->where('admin_id', $id);
        return $this->db->update('tbl_admin', $data);
    }

    function getAllAdminsByID() {
        $id = $this->uri->segment(3);

        return $this->db->get_where('tbl_admin', array('admin_id' => $id))->row();
    }

    function remove() {
        $id = $this->uri->segment(3);
        $this->db->delete('tbl_admin', array('admin_id' => $id));
    }

}

?>