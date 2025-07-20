<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li>All Orders</li><li><?php echo $this->lang->line("create_new"); ?></li>
        </ol>
        <!-- end breadcrumb -->
    </div>
    <!-- END RIBBON -->
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- Error Messages -->
        <?php if ($this->session->flashdata('validation_errors')): ?>
            <div class="alert alert-danger">
                <h4>Please fix the following errors:</h4>
                <ul>
                    <?php foreach ($this->session->flashdata('validation_errors') as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('stock_errors')): ?>
            <div class="alert alert-warning">
                <h4>Stock Issues:</h4>
                <ul>
                    <?php foreach ($this->session->flashdata('stock_errors') as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <div id="wrapper">
                    <script>
        const availableTags1 = [
   ];
   console.log(availableTags1);
</script>
                    <form method="post" action="<?php echo site_url(); ?>/orders/draft_order" class="" enctype="multipart/form-data" id="orderForm" novalidate>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="myorder">
                        <div class="well">
                            <div class="widget-body">
                                <?php $order_number = rand(0000,9999); ?>
                                 <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="myorder">
                                     Type Item Name : <input class="tags"/><span> 
                                
                                </div>
                                 <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="myorder">
                                
                                     Order Number : <input type="text" name="order_number" id="order_number" value="<?php echo $order_number ?>"/></span>
                                </div>
                                 <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="myorder">
                                
                                     Shop : <select id="shopid" name="shopid" class="form-control" required>
                                         <option value="">Please select a shop</option>
                                          <?php if ($all_shops) { ?>
                                                         <?php foreach ($all_shops as $value) { ?>
                                                             <option  value="<?php echo $value["shop_id"]; ?>" ><?php echo $value["shop_name"]; ?></option>
                                                         <?php } ?>
                                                     <?php } ?>
                                     </select>
                                     <span class="error-message" id="shop-error" style="color: red; display: none;">Please select a shop</span>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
				<div class="form-actions">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" value="sbmt" name="sbmt" />
							<button class="btn btn-default" type="submit">
								<i class="fa fa-eye"></i>
								<?php echo $this->lang->line("Submit"); ?>
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
                    <!-- <div id="myorder"></div> -->
                    
                </div>
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>

<script>
        const availableTags = [
      <?php 
         if (sizeof($all_items) > 0) { ?>
            <?php foreach ($all_items as $value) { ?>
            <?php  
            $title='';
            $brand_title = get_att_name($value['item_brand_fk'],'brands','brand_title',$type='brand');
            ?>
             { label:  "<?php echo $brand_title;  ?> / <?php echo $value['item_name']; ?>",
              value:  "<?php echo $value['item_id']; ?>"},
             <?php }
            
        }
        ?>
   ];
    orders.applyautocomoplete(availableTags,false,<?php echo $order_number ?>);
    orders.init();
</script>
<?php $this->load->view("common/footer"); ?>
