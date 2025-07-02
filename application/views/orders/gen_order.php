<div class="main-div" style="">
 	<div class="sub-div"><?php echo $item_detail[0]['item_name']?></div>
</div>
<div>
<div class="col-md-3">
    
    <select class="form-control show">
        <option value="0">Please Select</option>
        <optgroup label="Brand">
            <?php if($brands){?>
                <?php foreach($brands as $value){?>    
                    <option attttype="brand" value="<?php echo $value['brand_id']; ?>"><?php echo $value['brand_title'];?></option>                
                <?php } ?>
                <?php } ?>
            </optgroup>
    <optgroup label="Grade">
        <?php if($grades){?>
            <?php foreach($grades as $value){?>    
                <option attttype="grade" value="<?php echo $value['grade_id']; ?>"><?php echo $value['grade_title'];?></option>                
                <?php } ?>
                <?php } ?>
            </optgroup>
            <optgroup label="Model">
        <?php if($models){?>
            <?php foreach($models as $value){?>    
                    <option attttype="model" value="<?php echo $value['model_id']; ?>"><?php echo $value['model_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                </optgroup>
                <optgroup label="Size">
                    <?php if($sizes){?>
                <?php foreach($sizes as $value){?>    
                    <option attttype="size" value="<?php echo $value['size_id']; ?>"><?php echo $value['size_title'];?></option>                
                    <?php } ?>
            <?php } ?>
    </optgroup>
    <optgroup label="Type">
        <?php if($types){?>
                <?php foreach($types as $value){?>    
                    <option attttype="type" value="<?php echo $value['type_id']; ?>"><?php echo $value['type_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                </optgroup>
    <optgroup label="Colour">
        <?php if($colours){?>
                <?php foreach($colours as $value){?>    
                    <option attttype="colour" value="<?php echo $value['colour_id']; ?>"><?php echo $value['colour_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                </optgroup>
    <optgroup label="Unit">
        <?php if($units){ ?>
            <?php foreach($units as $value){?>    
                <option attttype="unit" value="<?php echo $value['unit_id']; ?>"><?php echo $value['unit_title'];?></option>                
                <?php } ?>
                <?php } ?>
            </optgroup>
        </select>
    </div>    
    </div>
    <div style="clear:both"></div>
<div id="append">
    <div class="col-md-2 hide" id="brand-div">
<lable>Brand</lable>
<div>
    
    <select class="form-control">
        <option value="0">Please Select</option>
        <?php if($brands){?>
            <?php foreach($brands as $value){?>    
                <option value="<?php echo $value['brand_id']; ?>"><?php echo $value['brand_title'];?></option>                
                <?php } ?>
        <?php } ?>
    </select>
        <div id="brand-detail">
            <span id="brand-title"></span>
        </div>
        <div id="brand-input">
            <input type="text" name="brandvalue[]" style="width:100%;" />
        </div>

    </div>
    <div style="clear:both"></div>


</div>
    <div class="col-md-2 hide" id="grade-div">
<lable>Grade</lable>
    <div>
        
        <select class="form-control">
            <option value="0">Please Select</option>
            <?php if($grades){?>
                <?php foreach($grades as $value){?>    
                    <option value="<?php echo $value['grade_id']; ?>"><?php echo $value['grade_title'];?></option>                
                    <?php } ?>
            <?php } ?>
        </select>
        <div id="grade-input">
            <input type="text" name="gradevalue[]" style="width:100%;" />
        </div>
        <div style="clear:both"></div>
    
    </div>
    </div>
    <div class="col-md-2 hide"id="model-div">
<lable>Models</lable>
    <div>
        
        <select class="form-control">
            <option value="0">Please Select</option>
            <?php if($models){?>
                <?php foreach($models as $value){?>    
                    <option value="<?php echo $value['model_id']; ?>"><?php echo $value['model_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                </select>
                <div id="model-input">
                    <input type="text" name="modelvalue[]" style="width:100%;" />
                </div>
                <div style="clear:both"></div>
                
    </div>
</div>
    <div class="col-md-2 hide"id="size-div">
<lable>Sizes</lable>
    <div>
        
        <select class="form-control">
            <option value="0">Please Select</option>
            <?php if($sizes){?>
                <?php foreach($sizes as $value){?>    
                    <option value="<?php echo $value['size_id']; ?>"><?php echo $value['size_title'];?></option>                
                    <?php } ?>
            <?php } ?>
        </select>
        <div id="size-input">
            <input type="text" name="sizevalue[]" style="width:100%;" />
        </div>
    <div style="clear:both"></div>
</div>
</div>
<div class="col-md-2 hide" id="type-div">
    <lable>Types</lable>
    <div>
        <select class="form-control">
            <option value="0">Please Select</option>
            
            <?php if($types){?>
                <?php foreach($types as $value){?>    
                    <option value="<?php echo $value['type_id']; ?>"><?php echo $value['type_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                    
                </select>
                <div id="type-input">
                    <input type="text" name="typevalue[]" style="width:100%;" />
                </div>
                <div style="clear:both"></div>
                
            </div>
        </div>
        <div class="col-md-2 hide" id="unit-div">
            <lable>units</lable>
            <div>
                <select class="form-control">
                    <option value="0">Please Select</option>
                    <?php if($units){ ?>
                        <?php foreach($units as $value){?>    
                            <option value="<?php echo $value['unit_id']; ?>"><?php echo $value['unit_title'];?></option>                
                            <?php } ?>
                            <?php } ?>
                        </select>
                        <div id="unit-input">
                            <input type="text" name="unitvalue[]" style="width:100%;" />
                        </div>
                        <div style="clear:both"></div>
    
    </div>
</div>
    <div class="col-md-2 hide" id="colour-div">
<lable>colours</lable>
    <div>
        <select class="form-control">
            <option value="0">Please Select</option>
            <?php if($colours){?>
                <?php foreach($colours as $value){?>    
                    <option value="<?php echo $value['colour_id']; ?>"><?php echo $value['colour_title'];?></option>                
                    <?php } ?>
            <?php } ?>
        </select>
    <div id="colour-input">
                            <input type="text" name="colourvalue[]" style="width:100%;" />
                        </div>
                        <div style="clear:both"></div>
    </div>
</div>
</div>