<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBktlR1Tj9LG2CeEhWtP_UpUggyoqGGLX0&callback=myMap"></script>

<?php  if(  uri_string()  == 'home'){ ?>

   <!-- <script src="<?php echo base_url();?>media/backend/js/sb-admin-datatables.min.js"></script>-->
   <!-- <script src="<?php echo base_url();?>media/backend/js/sb-admin-charts.js"></script>-->

<?php  } ?>


<?php if(  uri_string()  == 'statistic/mainpage/graph'){ ?>  

    <script src="<?php echo base_url();?>media/backend/vendor/canvasjs/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url();?>/media/backend/vendor/canvasjs/canvasjs.min.js"></script

<?php } ?>  