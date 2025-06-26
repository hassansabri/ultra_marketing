 <?php 
                                    $brands_attribute_fk=array();
                                    $grades_attribute_fk=array();
                                    $models_attribute_fk=array();
                                    $sizes_attribute_fk=array();
                                    $types_attribute_fk=array();
                                    $colours_attribute_fk=array();
									$units_attribute_fk = array();
                                    foreach($get_item_brands as $value){
                                        $brands_attribute_fk[] = $value['attribute_fk'];
                                         
                                    }
                                    
                                    foreach($get_item_grades as $value){
                                        $grades_attribute_fk[] = $value['attribute_fk'];
                                    }
                                    foreach($get_item_models as $value){
                                        $models_attribute_fk[] = $value['attribute_fk'];
                                    }
                                    foreach($get_item_sizes as $value){
                                    $sizes_attribute_fk[] = $value['attribute_fk'];
                                    }
                                    foreach($get_item_types as $value){
                                        $types_attribute_fk[] = $value['attribute_fk'];
                                    }
                                    foreach($get_item_colours as $value){
                                        $colours_attribute_fk[] = $value['attribute_fk'];
                                    }
									foreach($get_item_units as $value){
                                        $units_attribute_fk[] = $value['attribute_fk'];
                                    }
                                 //    print_r($brands_attribute_fk);
                                     ?>
 <div class="main-div">
 	<div class="sub-div">Brand</div>
 	<?php  if ($all_brands) { ?>
 	<select id="brand" name="brand" class="form-control show" atttype="brand">
 		<option value="0">Please Select</option>
 		<?php foreach ($all_brands as $value) { ?>
 		<?php if( in_array( $value['brand_id'],$brands_attribute_fk ) ){ ?>
 		<option value="<?php if( in_array( $value['brand_id'],$brands_attribute_fk ) ){ echo $value['brand_id']; } ?>">
 			<?php echo $value['brand_title'];?></option>
 		<?php } ?>

 		<?php } ?>
 	</select>
 	<?php } ?>

 </div>
 <div class="main-div">
 	<div class="sub-div">Grades</div>

 	<?php  if ($all_grades) { ?>
 	<select id="grade" name="grade" class="form-control show" atttype="grade">
 		<option value="0">Please Select</option>
 		<?php foreach ($all_grades as $value) { ?>
 		<?php if( in_array( $value['grade_id'],$grades_attribute_fk ) ){ ?>
 		<option value="<?php if( in_array( $value['grade_id'],$grades_attribute_fk ) ){ echo $value['grade_id']; } ?>">
 			<?php echo $value['grade_title'];?></option>
 		<?php } ?>

 		<?php } ?>
 	</select>
 	<?php } ?>
 </div>
 <div class="main-div">
 	<div class="sub-div">Models</div>

 	<?php  if ($all_models) { ?>
 	<select id="model" name="model" class="form-control show" atttype="model">
 		<option value="0">Please Select</option>
 		<?php foreach ($all_models as $value) { ?>
 		<?php if( in_array( $value['model_id'],$models_attribute_fk ) ){ ?>
 		<option value="<?php if( in_array( $value['model_id'],$models_attribute_fk ) ){ echo $value['model_id']; } ?>">
 			<?php echo $value['model_title'];?></option>
 		<?php } ?>

 		<?php } ?>
 	</select>
 	<?php } ?>
 </div>
 <div class="main-div">
 	<div class="sub-div">Sizes</div>

 	<?php  if ($all_sizes) { ?>
 	<select id="size" name="size" class="form-control show"  atttype="size">
 		<option value="0">Please Select</option>
 		<?php foreach ($all_sizes as $value) { ?>
 		<?php if( in_array( $value['size_id'],$sizes_attribute_fk ) ){ ?>
 		<option value="<?php if( in_array( $value['size_id'],$sizes_attribute_fk ) ){ echo $value['size_id']; } ?>">
 			<?php echo $value['size_title'];?></option>
 		<?php } ?>

 		<?php } ?>
 	</select>
 	<?php } ?>
 </div>
 <div class="main-div">
 	<div class="sub-div">Types</div>

 	<?php  if ($all_types) { ?>
 	<select id="type" name="type" class="form-control show"  atttype="type">
 		<option value="0">Please Select</option>
 		<?php foreach ($all_types as $value) { ?>
 		<?php if( in_array( $value['type_id'],$types_attribute_fk ) ){ ?>
 		<option value="<?php if( in_array( $value['type_id'],$types_attribute_fk ) ){ echo $value['type_id']; } ?>">
 			<?php echo $value['type_title'];?></option>
 		<?php } ?>

 		<?php } ?>
 	</select>
 	<?php } ?>
 </div>
 <div class="main-div">
 	<div class="sub-div">Colours</div>

 	<?php  if ($all_colours) { ?>
 	<select id="colour" name="colour" class="form-control show" atttype="colour">
 		<option value="0">Please Select</option>
 		<?php foreach ($all_colours as $value) { ?>
 		<?php if( in_array( $value['colour_id'],$colours_attribute_fk ) ){ ?>
 		<option
 			value="<?php if( in_array( $value['colour_id'],$colours_attribute_fk ) ){ echo $value['colour_id']; } ?>">
 			<?php echo $value['colour_title'];?></option>
 		<?php } ?>

 		<?php } ?>
 	</select>
 	<?php } ?>
 </div>
 </div>
 <div class="main-div">
 	<div class="sub-div">units</div>

 	<?php  if ($all_units) { ?>
 	<select id="unit" name="unit" class="form-control show" atttype="unit">
 		<option value="0">Please Select</option>
 		<?php foreach ($all_units as $value) { ?>
 		<?php if( in_array( $value['unit_id'],$units_attribute_fk ) ){ ?>
 		<option
 			value="<?php if( in_array( $value['unit_id'],$units_attribute_fk ) ){ echo $value['unit_id']; } ?>">
 			<?php echo $value['unit_title'];?></option>
 		<?php } ?>

 		<?php } ?>
 	</select>
 	<?php } ?>
 </div>
 </div>
 <div class="main-div">
	<div class="sub-div">
			Logs
	</div>
	<div ></div>
	<?php $this->load->view("stocks/logs"); ?>
	</div>
 <div class="main-div">
	<div class="sub-div">
			Actions
	</div>
	<div class="row">
		<div class="col-md-1" >
			<div class="form-group" id="brand-id">
            </div>
		</div>
		<div class="col-md-1" >
			<div class="form-group" id="grade-id">
            </div>
		</div>
		<div class="col-md-1" >
			<div class="form-group" id="model-id">
            </div>
		</div>
		<div class="col-md-1">
			<div class="form-group" id="size-id">
            </div>
		</div>
		<div class="col-md-1">
			<div class="form-group" id="type-id">
            </div>
		</div>
		<div class="col-md-1">
			<div class="form-group" id="colour-id">
            </div>
		</div>
		<div class="col-md-1">
			<div class="form-group" id="unit-id">
            </div>
		</div>
		<div class="col-md-1">
			<div class="form-group" id="">
				<input placeholder="Entry Date" type="text" name="entry_date" id="entry_date" style="width:100%"/>
            </div>
		</div>
		<div class="col-md-1">
			<div class="form-group" id="">
				<select name="stock_type" class="form-control" id="stock_type">
					<option value="0">Please Select</option>
					<option value="opening_balance">Opening Balance</option>
					<option value="stock_addition">Stock Addition</option>
				</select>
            </div>
		</div>
		<div class="col-md-1">
				<input placeholder="balance" type="text" name="quantity" id="balance" style="width:100%" />
		</div>
		<div class="col-md-2">
			<div class="form-group" id="">
				<button class="btn btn-default" onclick="stock.check();">
                    <i class="fa fa-eye"></i>check
                </button>/<button class="btn btn-default" onclick="stock.add();">
                    <i class="fa fa-plus"></i>Add
                </button>
            </div>
		</div>
		<div style="clear:both"></div>
	</div>
 </div>