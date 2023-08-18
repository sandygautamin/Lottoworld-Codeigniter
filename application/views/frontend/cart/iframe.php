<div class="modal fade" id="myModal" role="dialog " data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
       
      <div class="modal-body" style="padding:0px;">
   
      
          
      <!--  Specifying iframe parameters -->
          <style type="text/css">
              #widget-container iframe {
                  width: 100%;
                  height: 100%;
                  border:none;
              }
          </style>
    
      <!-- Placing iframe with widget on page -->
      <div id="widget-container" style="width: 100%"></div>
      <!--  Sending parameters to widget -->
      
    <input type="hidden" name="config" value="<?php echo json_encode($config);?>">
      </div>
      
    </div>
    
  </div>
</div>
<script type="text/javascript">
    var configObj = <?php echo json_encode($config) ?>;
    console.log(configObj);
    EPayWidget.run(configObj);
</script>

