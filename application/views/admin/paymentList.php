<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> User Payments
       
      </h1>
    </section>
    <section class="content">
     
        <div class="row">
            <div class="col-md-12">
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
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Users Payments List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>admin/paymentList" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText"  class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table id="customers" class="table table-bordered table-hover ">
                    <tr class="shadow-sm">
                        <th>Sr.No.</th>
                        <th >User Name</th>
                        <th >Transaction</th>
                        <th >Date</th>
                        <th >Amount</th>
                        <th >Lottery</th>
                       
                       
                        
                    </tr>
                    <?php
                    $key=1;

                        // echo "<pre>";
                        // print_r($userRecords);
                        // echo "</pre>";

                    if(!empty($userRecords))
                    {
                      
                        foreach($userRecords as  $record)
                        {
                    ?>
                    <tr>
                            <td><?php echo $key++  ?></td>
                        <td><?php echo $record->fname." ".$record->lname ?></td>
                        <td><?php echo $record->token ?></td>
                        <td><?php echo $record->created ?></td>
                        <td><?php echo $record->amount ?></td>
                        <td><?php echo $record->lottery_type ?></td>
                       
                        
                        <!--td><?php //echo date("d-m-Y", strtotime($record->createdDtm)) ?></td-->
                        
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    </table>
                     
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  
                    <p><?php echo $links; ?></p>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

