<div>
    <div id="abcdiv" class="m<?php echo $item_detail[0]['item_id']?>">
        
		
		<div class="main-div" style="">
            <div class="sub-div"><?php echo $item_detail[0]['item_name']?>
			<input style="color: #000;cursor: not-allowed;" name="item_ids[]" type="hidden" value="<?php echo $item_detail[0]['item_id']?>"/>
			<input class="number iq<?php echo $item_detail[0]['item_id']?>" placeholder="item quantity" style="color: #000;" name="item_qty[]" type="number" min="1" value="1"/>
			<input class="number" placeholder="item price" style="color: #000;" name="item_price[]" value=""/>
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