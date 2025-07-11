<div>
    <div id="abcdiv" class="m<?php echo $item_detail[0]['item_id']?>">
        
        </div>
        <div class="main-div" style="">
            <div class="sub-div"><?php echo $item_detail[0]['item_name']?><input class="number iq<?php echo $item_detail[0]['item_id']?>" placeholder="item quantity" style="color: #000;" name="item_qty[]" type="number" min="1" value="1"/><input style="color: #000;cursor: not-allowed;" name="item_ids[]" type="hidden" value="<?php echo $item_detail[0]['item_id']?>"/></div>
            </div>
        <div class="col-md-2 hidee" id="grade-div">
            <lable>Grade</lable>
            <div>

                <?php if($grades){?>
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

					<!-- <select class="form-control">
            <option value="0">Please Select</option>
            <?php if($models){?>
                <?php foreach($models as $value){?>    
                    <option value="<?php echo $value['model_id']; ?>"><?php echo $value['model_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                </select> -->
					<?php if($models){?>
					<?php foreach($models as $value){?>
					<!-- <option value="<?php echo $value['model_id']; ?>"><?php echo $value['model_title'];?></option>                 -->
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

					<!-- <select class="form-control">
            <option value="0">Please Select</option>
            <?php if($sizes){?>
                <?php foreach($sizes as $value){?>    
                    <option value="<?php echo $value['size_id']; ?>"><?php echo $value['size_title'];?></option>                
                    <?php } ?>
            <?php } ?>
        </select> -->
					<?php if($sizes){?>
					<?php foreach($sizes as $value){?>
					<!-- <option value="<?php echo $value['size_id']; ?>"><?php echo $value['size_title'];?></option>                 -->
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
					<!-- <select class="form-control">
            <option value="0">Please Select</option>
            
            <?php if($types){?>
                <?php foreach($types as $value){?>    
                    <option value="<?php echo $value['type_id']; ?>"><?php echo $value['type_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                    
                </select> -->
					<?php if($types){?>
					<?php foreach($types as $value){?>
					<!-- <option value="<?php echo $value['type_id']; ?>"><?php echo $value['type_title'];?></option>                 -->
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
					<!-- <select class="form-control">
            <option value="0">Please Select</option>
            <?php if($colours){?>
                <?php foreach($colours as $value){?>    
                    <option value="<?php echo $value['colour_id']; ?>"><?php echo $value['colour_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                </select> -->
					<?php if($colours){?>
					<?php foreach($colours as $value){?>
					<!-- <option value="<?php echo $value['colour_id']; ?>"><?php echo $value['colour_title'];?></option>                 -->
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