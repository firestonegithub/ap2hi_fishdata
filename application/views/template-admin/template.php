<!DOCTYPE html>
<html lang="en">
<?php

        $user = $this->auth->get_data_session();

        $ci = get_instance();

        $ci->load->config('session');
       
    ?>
<head>
 
   <?php $this->load->view('template-admin/metadata');?>
 
 </head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

  <?php $this->load->view('template-admin/sidebar');?>

  <div class="content-wrapper">
    
    <?php  $this->load->view($content);?>
  
    
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © <?php echo $ci->config->item('app_name').' '.date('Y');  ?></small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    

    <?php  $this->load->view("template-admin/script");?>

  </div>
</body>

</html>
