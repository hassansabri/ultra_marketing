<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li>All</li>
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
        
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <div id="wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="well no-padding">


                            <fieldset>
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">
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
                                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                        <h2>All Complete Orders</h2>

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
                                                    <th data-class="expand">Invoice Number</th>
                                                    <th data-hide=""><?php echo $this->lang->line("option"); ?></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                
                                                    if (sizeof($all_complete_orders) > 0) { 
                                                      //  print_r($all_draft_orders);
                                                        ?>
                                                        
                                                        <?php foreach($all_complete_orders as $value) {  
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $value['order_number'] ?></td>
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
                                                                                <a href="<?php echo site_url(); ?>/orders/review/<?php echo $value['order_number']; ?>">Review Invoice</a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="<?php echo site_url(); ?>/orders/show_invoice/<?php echo $value['order_number']; ?>">Generate Invoice</a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="#" 
                                                                                   onclick="showCancelOrderModal(<?php echo $value['order_number']; ?>)"
                                                                                   class="text-danger">
                                                                                    <i class="fa fa-times"></i> Cancel Invoice
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

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
<!-- Cancel Order Modal -->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="cancelOrderModalLabel">Cancel Order</h4>
            </div>
            <form id="cancelOrderForm" method="post" action="">
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        <strong>Warning:</strong> Cancelling this order will restore the stock quantities. This action cannot be undone.
                    </div>
                    
                    <div class="form-group">
                        <label for="cancellation_reason">Cancellation Reason (Optional)</label>
                        <textarea class="form-control" id="cancellation_reason" name="cancellation_reason" rows="3" 
                                  placeholder="Please provide a reason for cancellation..."></textarea>
                    </div>
                    
                    <input type="hidden" id="order_number_to_cancel" name="order_number" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times"></i> Cancel Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
   orders.init();
   
   function showCancelOrderModal(orderNumber) {
       $('#order_number_to_cancel').val(orderNumber);
       $('#cancelOrderModal').modal('show');
   }
   
   // Handle form submission
   $('#cancelOrderForm').on('submit', function(e) {
       e.preventDefault();
       
       var orderNumber = $('#order_number_to_cancel').val();
       var reason = $('#cancellation_reason').val();
       
       // Submit via AJAX
       $.ajax({
           url: '<?php echo site_url("orders/cancel_order_ajax"); ?>',
           type: 'POST',
           data: {
               order_number: orderNumber,
               cancellation_reason: reason
           },
           dataType: 'json',
           success: function(response) {
               if (response.success) {
                   // Show success message and reload page
                   alert(response.message);
                   location.reload();
               } else {
                   alert('Error: ' + response.message);
               }
           },
           error: function() {
               alert('An error occurred while processing your request.');
           }
       });
       
       // Close modal
       $('#cancelOrderModal').modal('hide');
   });
</script>
<?php $this->load->view("common/footer"); ?>