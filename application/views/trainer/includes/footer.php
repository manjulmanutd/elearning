</div><!--wrapper-->

<div class="footer">
<?php $footer=$this->site_conf_model->getPageFooter();?>    
<?php echo $footer->footer_title?> - Copyright © 
<a href="http://<?php echo $footer->footer_link;?>"><?php echo $footer->footer_copyright;?></a> 
</div>

</body>
</html>