
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Product Draws Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/addProductDraws"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
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
                    <h3 class="box-title">Product Draws List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>admin/productDrawsList" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table id="customers"  class="table table-hover">
                    <tr>
                    
                        <th> Id </th>
                        <th>Product Id</th>
                        <th>Lottery Name</th>
                        <th>IsSubscription</th>
                       
                        <th> Action </th>
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
                        <td>Product <?php echo $record->ProductId ?></td>
                        <td><?php echo $record->LotteryName ?></td>
                        <td><?php echo $record->IsSubscription ?></td>
                        
                   
                        <td><a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/editDraws/'.$record->product_draws_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger deleteUser" href="<?php echo base_url().'admin/deleteDraw/'.$record->product_draws_id; ?>" data-userid="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a></td>

                      
                        
                       
                       
                        
                        <!--td><?php //echo date("d-m-Y", strtotime($record->createdDtm)) ?></td-->
                        
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $links;  ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

