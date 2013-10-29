<?php $this->load->model('login_model');?>
<style>
    .chat_row1{width:200px; height:200px;float: left}
    .chat_row2{width:200px; height:200px; float: left }
    #admin_header{border: 1px solid; background-color: #004099; color: white; text-align: center}
    .online{border:1px solid; background-color: #00CC00; color: white; text-align: center}
</style>
<h1>Live Chat</h1>
<h5>Click to chat</h5>
<div class="seperator"></div>

<div class="chat_row1">
    <h3 id="admin_header">Online Trainees</h3>

<?php
			if($this->session->userdata('admin'))
			{
				$chatAdmins = $this->login_model->get_chat_admin_trainees();
			}
			if($chatAdmins != NULL)
			{
                           
				foreach($chatAdmins as $chatAdmin){
                                    
					?>
                    <br />
                    <a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $chatAdmin->session;?>')"><h4 class="online" ><?php echo strtoupper($chatAdmin->session);?></h4></a>
            
            
                    <?php
				
			}
                        }
			else
			{?>
			</br>
			<h4 style="text-align: center">No one available for chat</h4>
            <?php }
			?>
</div>

<div class="chat_row2">
    <h3 id="admin_header">Online Trainers</h3>

<?php
			if($this->session->userdata('admin'))
			{
				$chatAdmins = $this->login_model->get_chat_admin_trainers();
			}
			
			if($chatAdmins != NULL)
			{
                           
				foreach($chatAdmins as $chatAdmin){
                                    
					?>
                    <br />
                    <a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $chatAdmin->session;?>')"><h4 class="online" ><?php echo strtoupper($chatAdmin->session);?></h4></a>
            
            
                    <?php
				
			}
                        }
			else
			{?>
			</br>
                        <h4 style="text-align: center">No one available for chat</h4>
            <?php }
			?>
</div>