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
                    <form method="post" action="<?php echo site_url(); ?>/orders/draft_order_updater/<?php echo $order_number; ?>" class="" enctype="multipart/form-data" id="orderForm">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="myorder">
                        <div class="well">
                            <div class="widget-body">
                                 <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                     Type Item Name : <input class="tags"/><span> 

                                 </div>
                                 <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                     Order Number : <input type="text" name="order_number" id="order_number" value="<?php echo $order_number; ?>"/></span>

                                 </div>
                                
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                    Shop : <select id="shopid" name="shopid" class="form-control" required>
                                        <option value="">Please select a shop</option>
                                        <?php if (isset($all_shops) && $all_shops) { ?>
                                            <?php foreach ($all_shops as $value) { ?>
                                                <option value="<?php echo $value["shop_id"]; ?>" <?php echo (isset($current_shop_id) && $current_shop_id == $value["shop_id"]) ? 'selected' : ''; ?>><?php echo $value["shop_name"]; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <span class="error-message" id="shop-error" style="color: red; display: none;">Please select a shop</span>
                                </div>
                            </div>
</div>
                                <div>
     <?php 
     foreach($order_info as $oi){ ?>

<div id="abcdiv" class="m<?php echo $oi['item_id']?>">
    <div class="main-div" >
        <div class="sub-div" style="position:relative;"><?php $itemname=get_item_name($oi['item_id']); echo $itemname;?>
        <input class="number iq<?php echo $oi['item_id']?>" placeholder="item quantity" style="color: #000;" name="item_qty[]" type="number" min="1" value="<?php echo isset($oi['order_quantity']) ? $oi['order_quantity'] : 1; ?>"/>
      <input class="number" placeholder="item price" style="color: #000;" name="item_price[]" value="<?php echo isset($oi['order_price']) ? $oi['order_price'] : 0; ?>"/>
        <select name="packing_option_<?php echo $oi['item_id']; ?>" class="packing-select" data-item-id="<?php echo $oi['item_id']; ?>" style="color: #000;">
            <option value="">Select packing option</option>
            <?php if (isset($all_packing_options) && $all_packing_options) { ?>
                <?php foreach ($all_packing_options as $option) { ?>
                    <option value="<?php echo $option["packing_id"]; ?>" <?php if($oi['packing_id'] == $option['packing_id'])echo 'selected'; ?>>
                        <?php echo $option["packing_title"]; ?> 
                    
                    </option>
                <?php } ?>
            <?php } ?>
        </select>
        <span class="cross-span" onclick="orders.remove_order('<?php echo $oi['item_id']?>','<?php echo $order_number; ?>');"><i class="fa fa-remove"></i></span>
                 <input style="color: #000;cursor: not-allowed;" name="item_ids[]" type="hidden" value="<?php echo $oi['item_id']?>"/></div>
                </div>
             <div class="col-md-2 hidee" id="grade-div">
                 <lable>Grade</lable>
                 <div>
     
                     <?php if(isset($grades[$oi['item_id']])){
                         ?>
                         
                     <?php foreach($grades[$oi['item_id']] as $value2){?>
                     <span><?php echo $value2['grade_title'];?></span>
                     <input class="number gengrade" type="text" placeholder="grade" name="grade-<?php echo $value2['grade_id'] ?>-<?php echo $oi['item_id']; ?>" style="width:100%;"
                         value="<?php echo isset($existing_values[$oi['item_id']]['grade'][$value2['grade_id']]) ? $existing_values[$oi['item_id']]['grade'][$value2['grade_id']] : '0'; ?>" />
                     <?php } ?>
                     <?php } ?>
                     <div id="grade-input">
                     </div>
                     <div style="clear:both"></div>
     
                 </div>
             </div>
     
                 <div class="col-md-2 hidee" id="model-div">
                     <lable>Models</lable>
                     <div>
                         <?php  if(isset($models[$oi['item_id']])){
                          //   print_r($models);?>
                         <?php foreach($models[$oi['item_id']] as $value2){?>
                     <span><?php echo $value2['model_title'];?></span>
                         <input class="number" type="text" name="model-<?php echo $value2['model_id'] ?>-<?php echo $oi['item_id']; ?>" style="width:100%;"
                          value="<?php echo isset($existing_values[$oi['item_id']]['model'][$value2['model_id']]) ? $existing_values[$oi['item_id']]['model'][$value2['model_id']] : '0'; ?>" />
                         <?php } ?>
                         <?php } ?>
                         <div id="model-input">
                         </div>
                         <div style="clear:both"></div>
     
                     </div>
                 </div>
                 <div class="col-md-2 hidee" id="size-div">
                     <lable>Sizes</lable>
                     <div>
                         <?php if(isset($sizes[$oi['item_id']])){?>
                         <?php foreach($sizes[$oi['item_id']] as $value2){?>
                         <span><?php echo $value2['size_title'];?></span>
                         <input class="number" type="text" name="size-<?php echo $value2['size_id'] ?>-<?php echo $oi['item_id']; ?>" style="width:100%;" value="<?php echo isset($existing_values[$oi['item_id']]['size'][$value2['size_id']]) ? $existing_values[$oi['item_id']]['size'][$value2['size_id']] : '0'; ?>" />
                         <?php } ?>
                         <?php } ?>
                         <div id="size-input">
                         </div>
                         <div style="clear:both"></div>
                     </div>
                 </div>
                 <div class="col-md-2 hidee" id="type-div">
                     <lable>Types</lable>
                     <div>
                         <?php if(isset($types[$oi['item_id']])){
                             ?>
                         <?php foreach($types[$oi['item_id']] as $value2){?>
                         <span><?php echo $value2['type_title'];?></span>
                         <input class="number" type="text" name="type-<?php echo $value2['type_id'] ?>-<?php echo $oi['item_id']; ?>" style="width:100%;" value="<?php echo isset($existing_values[$oi['item_id']]['type'][$value2['type_id']]) ? $existing_values[$oi['item_id']]['type'][$value2['type_id']] : '0'; ?>" />
                         <?php } ?>
                         <?php } ?>
                         <div id="type-input">
                         </div>
                         <div style="clear:both"></div>
     
                     </div>
                 </div>
                 <div class="col-md-2 hidee" id="colour-div">
                     <lable>colours</lable>
                     <div>
                         <?php if(isset($colours[$oi['item_id']])){?>
                             <?php foreach($colours[$oi['item_id']] as $value){?>
                         <span><?php echo $value['colour_title'];?></span>
                         <input class="number" type="text" name="colour-<?php echo $value['colour_id'] ?>-<?php echo $oi['item_id']; ?>" style="width:100%;" value="<?php echo isset($existing_values[$oi['item_id']]['colour'][$value['colour_id']]) ? $existing_values[$oi['item_id']]['colour'][$value['colour_id']] : '0'; ?>" />
                             <?php } ?>
                         <?php } ?>
                         <div id="colour-input">
                         </div>
                         <div style="clear:both"></div>
                     </div>
                 </div>
                 
         </div>
         
        </div>
        <?php }
         ?>                               
                            
                    </div>
                    </div>
                    <div class="form-group">
				<div class="form-actions">
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-default" type="button" id="of">
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
    orders.applyautocomoplete(availableTags,'1',<?php echo $order_number; ?>);
    orders.init();
</script>
<?php $this->load->view("common/footer"); ?>
