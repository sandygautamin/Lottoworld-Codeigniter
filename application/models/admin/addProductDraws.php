<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Product Draws Management
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Draws Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>admin/addDraw" method="post" role="form">
                    <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="ProductId">ProductId </label>
                                        <select class="form-control" id="LotteryTypeId" name="data[ProductId]">
                                        <option value="1">1</option>
                                        <option value="3">3</option>
                                        </select>
                                    
                                    </div>
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="fname">Lottery Type Name</label>
                                        <select class="form-control" id="LotteryTypeId" name="data[LotteryTypeId]">
                                        <?php foreach($infos as $info){ ?>
                                            <option value="<?php echo $info->LotteryTypeId  ?>"><?php echo $info->LotteryName ?></option>
                                      <?php  }  ?>
                                           
                                            
                                           
                                        </select>
                                       
                                    </div>
                                </div>
                              
                                <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="data[IsSubcription]">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        IsSubcription
                                    </label>
                                </div>
                              
                                </div>
                            </div>

                            <button class="add_exp1">Add Row</button>
                            <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script>
            $(document).ready(function () {
                $(".add_exp1").click(function(){
                    $(".box-body").append('<div class="row" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(44, 125, 188, 0.05) 0px 0.25em 1em;margin-top:10px">'+
                                 '<div class="col-md-2" >'+
                                 '<h3>Line 1 :</h3></div>'+
                               ' <div class="col-md-2">'+
                                    '<div class="form-group">'+
                                        '<label for="cpassword">MinLines1</label>'+
                                        '<input type="number" class="form-control" id="MinLines" placeholder="MinLines" name="data[options][row1][MinLines]" maxlength="20">'+
                                    '</div>'+
                                '</div>'+
                              '  <div class="col-md-2">'+
                                  '  <div class="form-group">'+
                                        '<label for="cpassword">MaxLines1</label>'+
                                        '<input type="number" class="form-control" id="MaxLines" placeholder="MaxLines" name="data[options][row1][MaxLines]" maxlength="20">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<div class="form-group">'+
                                        '<label for="mobile">NumbersOfDraws1</label>'+
                                        '<input type="number" class="form-control" id="NumbersOfDraws" placeholder="NumbersOfDraws" name="data[options][row1][NumberOfDraws]"  maxlength="10">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-2">'+                        
                                    '<div class="form-group">'+
                                       ' <label for="Country">Discount1</label>'+
                                        '<input type="number" class="form-control" id="Discount" placeholder="Enter Discount" name="data[options][row1][Discount]" maxlength="128">'+   
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<div class="form-group">'+
                                       ' <label for="address">Weeks1</label>'+
                                        '<input type="number" class="form-control" id="Weeks" placeholder="Enter Weeks" name="data[options][row1][Weeks]"  maxlength="128">'+
                                    '</div>'+
                               ' </div>'+
                            '<button class="close" style="color:white;background:red">Delete</button></div><br>');      

                });

                $("body").on("click",".close",function(e){
       $(this).parents('.row').remove();
      //the above method will remove the user_data div
  });



            });


        </script>



                            <div class="row" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(44, 125, 188, 0.05) 0px 0.25em 1em;margin-top:10px">
                                 <div class="col-md-2" >
                                   
                                 <h3>Line 1 :</h3>
                                
                                </div>
                            
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cpassword">MinLines1</label>
                                        <input type="number" class="form-control" id="MinLines" placeholder="MinLines" name="data[options][row1][MinLines]" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cpassword">MaxLines1</label>
                                        <input type="number" class="form-control" id="MaxLines" placeholder="MaxLines" name="data[options][row1][MaxLines]" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="mobile">NumbersOfDraws1</label>
                                        <input type="number" class="form-control" id="NumbersOfDraws" placeholder="NumbersOfDraws" name="data[options][row1][NumberOfDraws]"  maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="Country">Discount1</label>
                                        <input type="number" class="form-control" id="Discount" placeholder="Enter Discount" name="data[options][row1][Discount]" maxlength="128">
                                            
                                    </div>
                                </div>
                              
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="address">Weeks1</label>
                                        <input type="number" class="form-control" id="Weeks" placeholder="Enter Weeks" name="data[options][row1][Weeks]"  maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(217, 161, 7, 0.2) 0px 0.25em 1em;margin-top:10px">
                                 <div class="col-md-2" >
                                   
                                        <h3>Line 2 :</h3>
                                
                                </div>
                            
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cpassword">MinLines2</label>
                                        <input type="number" class="form-control" id="MinLines2" placeholder="MinLines2" name="data[options][row2][MinLines]" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cpassword">MaxLines2</label>
                                        <input type="number" class="form-control" id="MaxLines" placeholder="MaxLines2" name="data[options][row2][MaxLines]" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="mobile">NumbersOfDraws2</label>
                                        <input type="number" class="form-control" id="NumbersOfDraws" placeholder="NumbersOfDraws2" name="data[options][row2][NumberOfDraws]"  maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="Country">Discount2</label>
                                        <input type="number" class="form-control" id="Discount" placeholder="Enter Discount" name="data[options][row2][Discount]" maxlength="128">
                                            
                                    </div>
                                </div>
                              
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="address">Weeks2</label>
                                        <input type="number" class="form-control" id="Weeks" placeholder="Enter Weeks" name="data[options][row2][Weeks]"  maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(44, 125, 188, 0.05) 0px 0.25em 1em;margin-top:10px">
                                 <div class="col-md-2" >
                                   
                                 <h3>Line 3 :</h3>
                                
                                </div>
                            
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cpassword">MinLines3</label>
                                        <input type="number" class="form-control" id="MinLines" placeholder="MinLines3" name="data[options][row3][MinLines]" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cpassword">MaxLines3</label>
                                        <input type="number" class="form-control" id="MaxLines" placeholder="MaxLines3" name="data[options][row3][MaxLines]" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="mobile">NumbersOfDraws3</label>
                                        <input type="number" class="form-control" id="NumbersOfDraws" placeholder="NumbersOfDraws3" name="data[options][row3][NumberOfDraws]"  maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="Country">Discount3</label>
                                        <input type="number" class="form-control" id="Discount" placeholder="Enter Discount3" name="data[options][row3][Discount]" maxlength="128">
                                            
                                    </div>
                                </div>
                              
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="address">Weeks3</label>
                                        <input type="number" class="form-control" id="Weeks" placeholder="Enter Weeks3" name="data[options][row3][Weeks]"  maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(217, 161, 7, 0.2) 0px 0.25em 1em;margin-top:10px">
                                 <div class="col-md-2" >
                                   
                                 <h3>Line 4 :</h3>
                                
                                </div>
                            
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cpassword">MinLines4</label>
                                        <input type="number" class="form-control" id="MinLines" placeholder="MinLines4" name="data[options][row4][MinLines]" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cpassword">MaxLines4</label>
                                        <input type="number" class="form-control" id="MaxLines" placeholder="MaxLines4" name="data[options][row4][MaxLines]" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="mobile">NumbersOfDraws4</label>
                                        <input type="number" class="form-control" id="NumbersOfDraws" placeholder="NumbersOfDraws4" name="data[options][row4][NumberOfDraws]"  maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-2">                                
                                    <div class="form-group">
                                        <label for="Country">Discount4</label>
                                        <input type="number" class="form-control" id="Discount" placeholder="Enter Discount4" name="data[options][row4][Discount]" maxlength="128">
                                            
                                    </div>
                                </div>
                              
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="address">Weeks4</label>
                                        <input type="number" class="form-control" id="Weeks" placeholder="Enter Weeks4" name="data[options][row4][Weeks]"  maxlength="128">
                                    </div>
                                </div>
                            </div>
                           
                           
                           
                            
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