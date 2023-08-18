

<div class="content-wrapper">
<?php  
    // echo "<pre>";
    // print_r($Info);
    // echo "</pre>";die;
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Product Draws Management
        <small>Edit Draws </small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Draws Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url().'admin/editDraws2/'.$Info->id; ?>" method="post" role="form">
                    <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="ProductId">ProductId </label>
                                        <input type="text" class="form-control" id="ProductId" placeholder="ProductId" name="data[ProductId]" value="<?php echo $Info->ProductId; ?>" maxlength="128" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="fname">Lottery Type Name</label>
                                        <select class="form-control" id="LotteryTypeId" name="data[LotteryTypeId]" disabled>
                                        <?php foreach($infos as $info){
                                            $selected = ($info->LotteryTypeId == $Info->LotteryTypeId) ? 'selected="selected"' : '';
                                            echo "<option value='$info->LotteryTypeId'" . $selected . ">" . $info->LotteryName . "</option>";
                                             ?>
                                            
                                           
                                      <?php  }  ?>
                                           
                                            
                                           
                                        </select>
                                       
                                    </div>
                                </div>
                              
                                <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  value="1" <?php echo ($Info->IsSubscription ==1) ? 'checked' : '' ?>  name="data[IsSubcription]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        IsSubcription
                                    </label>
                                </div>
                              
                                </div>
                            </div>



                                            <?php 
                                            $a = 1;
                                            $max = 1;
                                            $min = 1;
                                            $num = 1;
                                            $dis = 1;
                                            $week = 1;
                                            
                                            foreach($Information as $inform) { ?>
                            <div class="row" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(217, 161, 7, 0.2) 0px 0.25em 1em;margin-top:10px">
                                 <div class="col-md-2" >
                                   
                                 <h3>Line <?php echo $a++;  ?> :</h3>
                                
                                </div>
                            
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cpassword">MinLines4</label>
                                        <input type="number" class="form-control" id="MinLines" placeholder="MinLines4" name="data[options][row<?php echo $min++;  ?>][MinLines]" value="<?php echo $inform->MinLines;  ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cpassword">MaxLines4</label>
                                        <input type="number" class="form-control" id="MaxLines" placeholder="MaxLines4" name="data[options][row<?php echo $max++;  ?>][MaxLines]" value="<?php echo $inform->MaxLines;  ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="mobile">NumbersOfDraws4</label>
                                        <input type="number" class="form-control" id="NumbersOfDraws" placeholder="NumbersOfDraws4" name="data[options][row<?php echo $num++;  ?>][NumberOfDraws]" value="<?php echo $inform->NumberOfDraws;  ?>"  maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="Country">Discount4</label>
                                        <input type="number" class="form-control" id="Discount" placeholder="Enter Discount4" name="data[options][row<?php echo $dis++;  ?>][Discount]" value="<?php echo $inform->Discount;  ?>" maxlength="128">
                                            
                                    </div>
                                </div>
                              
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="address">Weeks4</label>
                                        <input type="number" class="form-control" id="Weeks" placeholder="Enter Weeks4" name="data[options][row<?php echo $week++;  ?>][Weeks]" value="<?php echo $inform->Weeks;  ?>"  maxlength="128">
                                    </div>
                                </div>
                            </div>
                           
                           



                            
                                            <?php  } ?>
                            
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>