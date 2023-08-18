<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Lottery Management
        <small>Add Lottery</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Lottery Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>admin/addNewLottery" method="post" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="fname">Lottery Type ID</label>
                                        <input type="number" class="form-control" id="lotterTypeId" placeholder="Enter Lottery Id" name="LotteryTypeId"  maxlength="128">
                                          
                                    </div>
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="fname">Lottery Name</label>
                                        <input type="text" class="form-control" id="lotteryName" placeholder="Last Name" name="LotteryName"  maxlength="128">
                                       
                                    </div>
                                </div>
                              
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">Min Lines</label>
                                        <input type="number" class="form-control" id="minLines" placeholder="Enter email" name="MinLines"  maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">Max Lines</label>
                                        <input type="Number" class="form-control" id="maxLines" placeholder="Password" name="MaxLines" maxlength="20">
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="NumberOfMainNumbers">NumberOfMainNumbers</label>
                                        <input type="number" class="form-control" id="NumberOfMainNumbers" placeholder="NumberOfMainNumbers" name="NumberOfMainNumbers" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="MinLines">MinSelectNumber</label>
                                        <input type="number" class="form-control" id="MinSelectNumber" placeholder="MinSelectNumber" name="MinSelectNumber" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="MaxLines">AmountOfMainNumbersToMatch</label>
                                        <input type="number" class="form-control" id="AmountOfMainNumbersToMatch" placeholder="	AmountOfMainNumbersToMatch" name="AmountOfMainNumbersToMatch" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="NumberOfLines">NumberOfLines</label>
                                        <input type="number" class="form-control" id="NumberOfLines" placeholder="NumberOfLines" name="NumberOfLines" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">AmountOfExtraNumbersToMatch</label>
                                        <input type="Number" class="form-control" id="AmountOfExtraNumbersToMatch" placeholder="AmountOfExtraNumbersToMatch" name="AmountOfExtraNumbersToMatch" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="NumberOfExtraNumbers">NumberOfExtraNumbers</label>
                                        <input type="number" class="form-control" id="NumberOfExtraNumbers" placeholder="NumberOfExtraNumbers" name="NumberOfExtraNumbers" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="MaxExtraNumbers">MaxExtraNumbers</label>
                                        <input type="number" class="form-control" id="MaxExtraNumbers" placeholder="MaxExtraNumbers" name="MaxExtraNumbers" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="MinExtraNumber">MinExtraNumber</label>
                                        <input type="number" class="form-control" id="MinExtraNumber" placeholder="MinExtraNumber" name="MinExtraNumber" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="DrawsPerWeek">DrawsPerWeek</label>
                                        <input type="Number" class="form-control" id="DrawsPerWeek" placeholder="DrawsPerWeek" name="DrawsPerWeek" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="DrawDaysWeekly">DrawDaysWeekly</label>
                                        <input type="number" class="form-control" id="DrawDaysWeekly" placeholder="DrawDaysWeekly" name="DrawDaysWeekly" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Jackpot">Jackpot</label>
                                        <input type="number" class="form-control" id="Jackpot" placeholder="Jackpot" name="Jackpot" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="DrawId">DrawId</label>
                                        <input type="number" class="form-control" id="DrawId" placeholder="DrawId" name="DrawId" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="DrawDate">DrawDate</label>
                                        <input type="date" class="form-control" id="DrawDate" placeholder="DrawDate" name="DrawDate" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mainNumber">IsMainPic</label>
                                        <input type="number" class="form-control" id="mainNumber" placeholder="IsMainPic" name="IsMainPic" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="LotteryCurrency">LotteryCurrency</label>
                                        <input type="text" class="form-control" id="LotteryCurrency" placeholder="LotteryCurrency" name="LotteryCurrency" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="LotteryCurrency2">LotteryCurrency2</label>
                                        <input type="text" class="form-control" id="LotteryCurrency2" placeholder="LotteryCurrency2" name="LotteryCurrency2" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="EvenLinesOnly">EvenLinesOnly</label>
                                        <input type="Number" class="form-control" id="EvenLinesOnly" placeholder="EvenLinesOnly" name="EvenLinesOnly" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="CountryCode">CountryCode</label>
                                        <input type="text" class="form-control" id="CountryCode" placeholder="CountryCode" name="CountryCode" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="CountryName">CountryName</label>
                                        <input type="text" class="form-control" id="CountryName" placeholder="CountryName" name="CountryName" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="PricePerShare">PricePerShare</label>
                                        <input type="number" class="form-control" id="PricePerShare" placeholder="PricePerShare" name="PricePerShare" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="PricePerLine">PricePerLine</label>
                                        <input type="Number" class="form-control" id="PricePerLine" placeholder="PricePerLine" name="PricePerLine" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="BrandId">BrandId</label>
                                        <input type="number" class="form-control" id="BrandId" placeholder="BrandId" name="BrandId" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Discount">Discount</label>
                                        <input type="number" class="form-control" id="Discount" placeholder="Discount" name="Discount" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Discount2">Discount2</label>
                                        <input type="number" class="form-control" id="Discount2" placeholder="Discount2" name="Discount2" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Price">Price</label>
                                        <input type="Number" class="form-control" id="Price" placeholder="Price" name="Price" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="VipPrice">VipPrice</label>
                                        <input type="number" class="form-control" id="VipPrice" placeholder="VipPrice" name="VipPrice" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="NumberOfDraws">NumberOfDraws</label>
                                        <input type="number" class="form-control" id="NumberOfDraws" placeholder="NumberOfDraws" name="NumberOfDraws" maxlength="10">
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
            <div class="col-md-3">
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>