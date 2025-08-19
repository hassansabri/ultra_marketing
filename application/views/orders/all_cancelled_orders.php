<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li>Cancelled Orders</li>
        </ol>
        <!-- end breadcrumb -->
    </div>
    <!-- END RIBBON -->
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- Flash Messages -->
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <h4><i class="fa fa-check-circle"></i> Success</h4>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('warning')): ?>
            <div class="alert alert-warning">
                <h4><i class="fa fa-exclamation-triangle"></i> Warning</h4>
                <?php echo $this->session->flashdata('warning'); ?>
            </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <h4><i class="fa fa-times-circle"></i> Error</h4>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        
        <!-- Cancellation Statistics Dashboard -->
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="widget bg-color-blue txt-color-white">
                    <div class="widget-body">
                        <div class="text-center">
                            <h2><?php echo isset($cancellation_stats['total_cancelled']) ? $cancellation_stats['total_cancelled'] : '0'; ?></h2>
                            <p>Total Cancelled Orders</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget bg-color-red txt-color-white">
                    <div class="widget-body">
                        <div class="text-center">
                            <h2><?php echo isset($cancellation_stats['cancelled_this_month']) ? $cancellation_stats['cancelled_this_month'] : '0'; ?></h2>
                            <p>Cancelled This Month</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget bg-color-orange txt-color-white">
                    <div="widget-body">
                        <div class="text-center">
                            <h2><?php echo isset($cancellation_stats['cancelled_today']) ? $cancellation_stats['cancelled_today'] : '0'; ?></h2>
                            <p>Cancelled Today</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget bg-color-green txt-color-white">
                    <div class="widget-body">
                        <div class="text-center">
                            <h2><?php echo isset($cancellation_stats['recent_cancellations']) ? $cancellation_stats['recent_cancellations'] : '0'; ?></h2>
                            <p>Last 7 Days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <div id="wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="well no-padding">


                            <fieldset>
                                <div class="jarviswidget jarviswidget-color-red" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">
                                    <!-- widget options:
                                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
    
                                    data-widget-colorbutton="false"
                                    data-widget-editbutton="false"
                                    data-widget-togglebutton="false"
                                    data-widget-deletebutton="false"
                                    data-widget-fullscreenbutton="false"
                                    data-widget-custombutton="false"
                                    data-widget-collapsed="true"
                                    data-widget-sortable="false"
    
                                    -->
                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-times-circle"></i> </span>
                                        <h2>Cancelled Orders</h2>

                                    </header>

                                    <!-- widget div-->
                                    <div>

                                        <!-- widget edit box -->
                                        <div class="jarviswidget-editbox">
                                            <!-- This area used as dropdown edit box -->
                                        </div>
                                        <!-- end widget edit box -->
                                        <!-- widget content -->
                                        <div class="widget-body no-padding">
                                            <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                <tr>
                                                    <th data-class="expand">Order Number</th>
                                                    <th data-hide="">Cancelled Date</th>
                                                    <th data-hide="">Stock Restored</th>
                                                    <th data-hide=""><?php echo $this->lang->line("option"); ?></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                                                                         <?php 
                                                
                                                     if (isset($all_cancelled_orders) && sizeof($all_cancelled_orders) > 0) { 
                                                       //  print_r($all_cancelled_orders);
                                                         ?>
                                                         
                                                         <?php foreach($all_cancelled_orders as $value) {  
                                                     ?>
                                                             <tr>
                                                                 <td><?php echo isset($value['order_number']) ? $value['order_number'] : 'N/A'; ?></td>
                                                                 <td><?php echo isset($value['cancelled_date']) ? date('Y-m-d H:i', strtotime($value['cancelled_date'])) : 'N/A'; ?></td>
                                                                 <td>
                                                                     <span class="label label-success">
                                                                         <i class="fa fa-check"></i> Yes
                                                                     </span>
                                                                 </td>
                                                                 <td>
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-primary">
                                                                            <?php echo $this->lang->line("dropdown"); ?>
                                                                        </button>
                                                                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li>
                                                                                <a href="<?php echo site_url(); ?>/orders/review/<?php echo $value['order_number']; ?>">Review Order</a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="<?php echo site_url(); ?>/orders/show_invoice/<?php echo $value['order_number']; ?>">View Invoice</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td colspan="5" class="text-center">No cancelled orders found</td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>

                                            </table>

                                        </div>
                                        <!-- end widget content -->

                                    </div>
                                    <!-- end widget div -->

                                </div>
                            </fieldset>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>
<script type="text/javascript">
   orders.init();
</script>
<?php $this->load->view("common/footer"); ?> 