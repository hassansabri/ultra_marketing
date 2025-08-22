<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li><a href="<?php echo site_url(); ?>/orders/draftorders">Draft Orders</a></li>
            <li>Review Order</li>
        </ol>
        <!-- end breadcrumb -->
    </div>
    <!-- END RIBBON -->
    
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- Flash Messages -->
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="fa fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('stock_errors')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="fa fa-exclamation-triangle"></i> <strong>Stock Validation Failed:</strong>
                <ul style="margin-top: 10px; margin-bottom: 0;">
                    <?php foreach($this->session->flashdata('stock_errors') as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <div id="wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="well no-padding">
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                    <h2>Order Review - #<?php echo $order_number; ?></h2>
                                   <?php if($order_info[0]['order_status'] == 'draft') {?> 
                                    <div class="widget-toolbar">
                                        <a href="<?php echo site_url(); ?>/orders/editorder/<?php echo $order_number; ?>" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Edit Order
                                        </a>
                                   <?php }?>
                                        <a href="<?php echo site_url(); ?>/orders/draftorders" class="btn btn-default btn-sm" style="float:right">
                                            <i class="fa fa-arrow-left"></i> Back to Orders
                                        </a>
                                    </div>
                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="widget-body">
                                        <!-- Order Header Information -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4><i class="fa fa-building"></i> Company Information</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <?php if(isset($profile[0])): ?>
                                                            <p><strong>Company:</strong> <?php echo $profile[0]['shop_name']; ?></p>
                                                            <p><strong>Address:</strong> <?php echo $profile[0]['adress']; ?></p>
                                                            <p><strong>Phone:</strong> <?php echo $profile[0]['phone']; ?></p>
                                                            <p><strong>Email:</strong> <?php echo $profile[0]['email']; ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4><i class="fa fa-info-circle"></i> Order Information</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <p><strong>Invoice Number:</strong> <?php echo $order_number; ?></p>
                                                        <p><strong>Review Date:</strong> <?php echo date('l, F j, Y'); ?></p>
                                                        <p><strong>Total Items:</strong> <?php echo count($order_info); ?></p>
                                                         <p><strong>Packing Option:</strong> <?php echo $packing_info['packing_title']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Order Items -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4><i class="fa fa-shopping-cart"></i> Order Items</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <?php $index=0; if(isset($order_details) && count($order_details) > 0): ?>
                                                            <?php foreach($order_details as $item_id => $item_data): ?>
                                                                <div class="order-item" style="border: 1px solid #ddd; margin-bottom: 20px; padding: 15px; border-radius: 5px;">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5 style="color: #2c3e50; margin-bottom: 15px;">
                                                                                <i class="fa fa-cube"></i> 
                                                                                <?php echo $item_data['item_detail']['item_name']; ?>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                                                                                         <div class="row">
                                                                         <div class="col-md-6">
                                                                             <p><strong>Item Code:</strong> <?php echo $item_data['item_detail']['item_code']; ?></p>
                                                                             <p><strong>Description:</strong> <?php echo $item_data['item_detail']['item_description']; ?></p>
                                                                         </div>
                                                                         <div class="col-md-6">
                                                                             <p><strong>Status:</strong> 
                                                                                 <span">
                                                                                     <?php 
                                                                                      if(isset($order_info[$index]['order_status'])) echo $order_info[0]['order_status'];?>
                                                                                 </span>
                                                                             </p>
                                                                             <label for="price"><strong>price:</strong> 
                                                                                 <span" id="price">
                                                                                 <?php echo $order_info[$index]['order_price']; $index++;?>
                                                                                 </span>
                                                                             </label>
                                                                         </div>
                                                                     </div>

                                                                    <!-- Attributes Section -->
                                                                    <?php if(isset($item_data['attributes']) && count($item_data['attributes']) > 0): ?>
                                                                        <div class="attributes-section" style="margin-top: 15px;">
                                                                            <h6 style="color: #34495e; border-bottom: 1px solid #ecf0f1; padding-bottom: 5px;">
                                                                                <i class="fa fa-tags"></i> Attributes & Quantities
                                                                            </h6>
                                                                            
                                                                            <div class="row">
                                                                                <?php 
                                                                                $attribute_types = array(
                                                                                    'grade' => array('icon' => 'fa-star', 'title' => 'Grades'),
                                                                                    'model' => array('icon' => 'fa-car', 'title' => 'Models'),
                                                                                    'size' => array('icon' => 'fa-expand', 'title' => 'Sizes'),
                                                                                    'type' => array('icon' => 'fa-tag', 'title' => 'Types'),
                                                                                    'colour' => array('icon' => 'fa-palette', 'title' => 'Colours'),
                                                                                    'unit' => array('icon' => 'fa-cubes', 'title' => 'Units'),
                                                                                    'packing' => array('icon' => 'fa-box', 'title' => 'Packing')
                                                                                );
                                                                                
                                                                                foreach($attribute_types as $type => $type_info):
                                                                                    if(isset($item_data['attributes'][$type]) && count($item_data['attributes'][$type]) > 0):
                                                                                ?>
                                                                                    <div class="col-md-6 col-sm-12">
                                                                                        <div class="attribute-group" style="margin-bottom: 15px;">
                                                                                            <h6 style="color: #7f8c8d; margin-bottom: 8px;">
                                                                                                <i class="<?php echo $type_info['icon']; ?>"></i> <?php echo $type_info['title']; ?>
                                                                                            </h6>
                                                                                            <div class="table-responsive">
                                                                                                <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0;">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th>Quantity</th>
                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <?php foreach($item_data['attributes'][$type] as $attr): ?>
                                                                                                            <tr>
                                                                                                                <td>
                                                                                                                    <?php 
                                                                                                                    $name_field = $type . '_title';
                                                                                                                    echo isset($attr['detail'][$name_field]) ? $attr['detail'][$name_field] : 'N/A';
                                                                                                                    ?>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <span class="badge badge-primary" style="font-size: 12px;">
                                                                                                                        <?php echo $attr['quantity']; ?>
                                                                                                                    </span>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        <?php endforeach; ?>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php 
                                                                                    endif;
                                                                                endforeach; 
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="alert alert-info" style="margin-top: 15px;">
                                                                            <i class="fa fa-info-circle"></i> No attributes found for this item.
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <div class="alert alert-warning">
                                                                <i class="fa fa-exclamation-triangle"></i> No order details found.
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                                                                 <!-- Packing Summary -->
                                         <!-- <div class="row">
                                             <div class="col-md-12">
                                                 <div class="panel panel-info">
                                                     <div class="panel-heading">
                                                         <h4><i class="fa fa-box"></i> Packing Summary</h4>
                                                     </div>
                                                     <div class="panel-body">
                                                         <?php 
                                                         $total_packing_cost = 0;
                                                         $packing_items = array();
                                                         
                                                         if(isset($item_packing_info) && count($item_packing_info) > 0) {
                                                             foreach($item_packing_info as $packing) {
                                                                 if($packing['packing_cost'] > 0) {
                                                                     $total_packing_cost += $packing['packing_cost'];
                                                                     $packing_items[] = $packing;
                                                                 }
                                                             }
                                                         }
                                                         ?>
                                                         
                                                         <?php if(count($packing_items) > 0): ?>
                                                             <div class="table-responsive">
                                                                 <table class="table table-striped">
                                                                     <thead>
                                                                         <tr>
                                                                             <th>Item</th>
                                                                             <th>Packing Option</th>
                                                                             <th>Cost</th>
                                                                         </tr>
                                                                     </thead>
                                                                     <tbody>
                                                                         <?php foreach($packing_items as $packing): ?>
                                                                             <tr>
                                                                                 <td>
                                                                                     <?php 
                                                                                     $item_detail = $this->model_order->getitemdetail($packing['item_fk']);
                                                                                     echo isset($item_detail[0]['item_name']) ? $item_detail[0]['item_name'] : 'Item #' . $packing['item_fk'];
                                                                                     ?>
                                                                                 </td>
                                                                                 <td><?php echo $packing['packing_title']; ?></td>
                                                                                 <td>$<?php echo number_format($packing['packing_cost'], 2); ?></td>
                                                                             </tr>
                                                                         <?php endforeach; ?>
                                                                     </tbody>
                                                                     <tfoot>
                                                                         <tr class="info">
                                                                             <td colspan="2"><strong>Total Packing Cost:</strong></td>
                                                                             <td><strong>$<?php echo number_format($total_packing_cost, 2); ?></strong></td>
                                                                         </tr>
                                                                     </tfoot>
                                                                 </table>
                                                             </div>
                                                         <?php else: ?>
                                                             <p class="text-muted">No packing costs for this order.</p>
                                                         <?php endif; ?>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div> -->

                                         <!-- Action Buttons -->
                                         <div class="row">
                                             <div class="col-md-12 text-center">
                                                <div class="btn-group" style="margin-top: 20px;">
                                                    <?php if($order_info[0]['order_status'] == 'draft') {?> 
                                                        <a href="<?php echo site_url(); ?>/orders/editorder/<?php echo $order_number; ?>" class="btn btn-primary">
                                                            <i class="fa fa-edit"></i> Edit Order
                                                        </a>
                                                        <button type="button" class="btn btn-success" onclick="completeOrder('<?php echo $order_number; ?>')">
                                                            <i class="fa fa-check"></i> Complete Order & Deduct Stock
                                                        </button>
                                                     <?php } ?>
                                               <?php if($order_info[0]['order_status'] != 'draft') {?> 
                                                <a href="<?php echo site_url(); ?>/orders/show_invoice/<?php echo $order_number; ?>" class="btn btn-success">
                                                      <i class="fa fa-file-text"></i> Generate Invoice
                                                  </a>
                                                <?php } ?>
                                                  
                                                    <a href="<?php echo site_url(); ?>/orders/draftorders" class="btn btn-default">
                                                        <i class="fa fa-arrow-left"></i> Back to Orders
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end widget content -->
                                </div>
                                <!-- end widget div -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>

<style>
.order-item {
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.order-item:hover {
    background-color: #e9ecef;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.attribute-group table {
    font-size: 12px;
}

.attribute-group th {
    background-color: #f1f2f6;
    font-weight: 600;
    font-size: 11px;
    text-transform: uppercase;
}

.badge-primary {
    background-color: #3498db;
}

.panel-heading h4 {
    margin: 0;
    font-size: 16px;
}

.panel-heading i {
    margin-right: 8px;
}

.btn-group .btn {
    margin: 0 5px;
}

@media (max-width: 768px) {
    .btn-group .btn {
        margin: 5px;
        display: block;
        width: 100%;
    }
}
</style>

<script type="text/javascript">
$(document).ready(function() {
    // Initialize any necessary JavaScript functionality
    orders.init();
});

// Function to complete order with stock validation
function completeOrder(orderNumber) {
    if (confirm('Are you sure you want to complete this order? This will:\n\n1. Change order status to confirmed\n2. Deduct stock from inventory\n3. This action cannot be undone\n\nDo you want to proceed?')) {
        // Show loading indicator
        var button = event.target;
        var originalText = button.innerHTML;
        button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
        button.disabled = true;
        
        // Redirect to save method which will handle stock validation and deduction
        window.location.href = '<?php echo site_url(); ?>/orders/save/' + orderNumber;
    }
}

// Function to check stock availability before completing order
function checkStockBeforeCompletion(orderNumber) {
    // This function can be used for additional client-side stock checking if needed
    console.log('Checking stock availability for order: ' + orderNumber);
}
</script>

<?php $this->load->view("common/footer"); ?> 