<div>
    <div id="abcdiv" class="m<?php echo $item_detail[0]['item_id']?>">
        
		
		<div class="main-div" style="">
            <div class="sub-div"><?php echo $item_detail[0]['item_name']?>&nbsp;<i class="shopLastPrice fa fa-info" style="cursor:pointer;width: 15px;font-weight: bold;"></i>
			<input style="color: #000;cursor: not-allowed;" name="item_ids[]" type="hidden" value="<?php echo $item_detail[0]['item_id']?>"/>
			<input class="number iq<?php echo $item_detail[0]['item_id']?>" placeholder="item quantity" style="color: #000;max-width:15%" name="item_qty[]" type="number" min="1" value="1"/>
			<input class="number" placeholder="item price" style="color: #000;max-width:15%" name="item_price[]" value=""/>
			<select name="packing_option_<?php echo $item_detail[0]['item_id']; ?>" class="packing-select" data-item-id="<?php echo $item_detail[0]['item_id']; ?>" style="color: #000;">
				<option value="">Select packing option</option>
				<?php if (isset($all_packing_options) && $all_packing_options) { ?>
					<?php foreach ($all_packing_options as $option) { ?>
						<option value="<?php echo $option["packing_id"]; ?>">
							<?php echo $option["packing_title"]; ?> 
						
						</option>
					<?php } ?>
				<?php } ?>
			</select>
			<span><input class='number' type="number" id="packing_quantity" name="packing_quantity[]" placeholder="packing quantity" style="color: #000;max-width:15%;"/></span>
			
                <span id="limit_<?php echo $item_detail[0]['item_id'];?>" style="display:none"><input class='number' type="number" id="bigpolythenelimit" name="bigpolythenelimit[]" placeholder="big polythene default limit 10" style="color: #000;max-width:20%;"/></span>
			<span class="cross-span" onclick="orders.remove_order('<?php echo $item_detail[0]['item_id']?>','<?php echo $order_number; ?>');"><i class="fa fa-remove"></i></span>
		</div>
            </div>
        <div class="col-md-2 hidee" id="grade-div">
            <lable>Grade</lable>
            <div>

                <?php if(isset($grades)){?>
                <?php foreach($grades as $value){?>
                <span><?php echo $value['grade_title'];?></span>
                <input class="number gengrade" type="text" placeholder="grade" name="grade-<?php echo $value['grade_id'] ?>-<?php echo $item_detail[0]["item_id"]; ?>" style="width:100%;"
                    value="0" />
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

		
					<?php if(isset($models)){?>
					<?php foreach($models as $value){?>
					<span><?php echo $value['model_title'];?></span>
					<input class="number" type="text" name="model-<?php echo $value['model_id'] ?>-<?php echo $item_detail[0]["item_id"]; ?>" style="width:100%;" value="0" />
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

					<?php if(isset($sizes)){?>
					<?php foreach($sizes as $value){?>
					<span><?php echo $value['size_title'];?></span>
					<input class="number" type="text" name="size-<?php echo $value['size_id'] ?>-<?php echo $item_detail[0]["item_id"]; ?>" style="width:100%;" value="0" />
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
					<?php if(isset($types)){?>
					<?php foreach($types as $value){?>
					<span><?php echo $value['type_title'];?></span>
					<input class="number" type="text" name="type-<?php echo $value['type_id'] ?>-<?php echo $item_detail[0]["item_id"]; ?>" style="width:100%;" value="0" />
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
					
					<?php if(isset($colours)){?>
					<?php foreach($colours as $value){?>
					<span><?php echo $value['colour_title'];?></span>
					<input class="number" type="text" name="colour-<?php echo $value['colour_id'] ?>-<?php echo $item_detail[0]["item_id"]; ?>" style="width:100%;" value="0" />
					<?php } ?>
					<?php } ?>
					<div id="colour-input">
					</div>
					<div style="clear:both"></div>
				</div>
			</div>
			</div>
	</div>

</div>
<script>
// Packing options data
var packingOptions = <?php echo json_encode(isset($all_packing_options) ? $all_packing_options : array()); ?>;
// Handle item-specific packing option selection
$(document).on('change', '.packing-select', function() {
    var selectedValue = $(this).val();
    var itemId = $(this).data('item-id');
    var descriptionDiv = $('#packing_desc_' + itemId);
    var descText = descriptionDiv.find('.desc-text');
    if (selectedValue) {
        var selectedOption = packingOptions.find(function(option) {
            return option.packing_id == selectedValue;
        });
        if (selectedOption && selectedOption.packing_description) {
            descText.text(selectedOption.packing_description);
            descriptionDiv.show();
        } else {
            descriptionDiv.hide();
        }
    } else {
        descriptionDiv.hide();
    }
});
</script>