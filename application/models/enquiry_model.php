<?php

class Enquiry_model extends CI_Model{
    
    function getAllBranches(){
        
       return $this->db->get('tbl_branch')->result();
    }
    function makeEnquiry(){
        
        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $branchId = $this->input->post('branch_id');
        $enquiry_message = $this->input->post('enquiry_message');
        
        $admin = $this->db->get_where('tbl_admin',array('branch_id'=>$branchId))->result();
        
        foreach ($admin as $adm) {

                $emailList[] = $adm->email;
            }
          
        $this->load->library('email');
            $email_config = Array(
                'mailtype' => 'html'
            );

            $this->email->initialize($email_config);
            $this->email->from('noreply@work-experience.tdanda.co.uk', 'Work Experience');
            $this->email->to($email);
            $this->email->subject("Enquiry Submitted");
            $this->email->message("Hi".$fullname."<br><br>
            Your Enquiry Message: ".$enquiry_message." has been recieved. We will contact you soon. <br><br><br>
                Thanks");
            $this->email->send();
            
            $this->email->from('noreply@work-experience.tdanda.co.uk', 'Work Experience');
            $this->email->to($emailList);
            $this->email->subject("Enquiry Recieved");
            $this->email->message("Hello Admin<br/><br/>
            Your have recieved an Enquiry Message. <br/> 
            Enquiry Details: 
            Name: ".$fullname."<br/>
            Enquiry Message: ".$enquiry_message." <br/><br/><br/>
                Thanks <br/>
                Tdanda.co.uk");
            
            $this->email->send();
            
    }
}
?>
