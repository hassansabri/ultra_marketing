<div class="main-div" style="">
 	<div class="sub-div"><?php echo $item_detail[0]['item_name']?></div>
</div>
<div>
<!-- <div class="col-md-3">
    
    <select class="form-control show">
        <option value="0">Please Select</option>
        <optgroup label="Brand">
            <?php if($brands){?>
                <?php foreach($brands as $value){?>    
                    <option atttype="brand" value="<?php echo $value['brand_id']; ?>"><?php echo $value['brand_title'];?></option>                
                <?php } ?>
                <?php } ?>
            </optgroup>
    <optgroup label="Grade">
        <?php if($grades){?>
            <?php foreach($grades as $value){?>    
                <option atttype="grade" value="<?php echo $value['grade_id']; ?>"><?php echo $value['grade_title'];?></option>                
                <?php } ?>
                <?php } ?>
            </optgroup>
            <optgroup label="Model">
        <?php if($models){?>
            <?php foreach($models as $value){?>    
                    <option atttype="model" value="<?php echo $value['model_id']; ?>"><?php echo $value['model_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                </optgroup>
                <optgroup label="Size">
                    <?php if($sizes){?>
                <?php foreach($sizes as $value){?>    
                    <option atttype="size" value="<?php echo $value['size_id']; ?>"><?php echo $value['size_title'];?></option>                
                    <?php } ?>
            <?php } ?>
    </optgroup>
    <optgroup label="Type">
        <?php if($types){?>
                <?php foreach($types as $value){?>    
                    <option atttype="type" value="<?php echo $value['type_id']; ?>"><?php echo $value['type_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                </optgroup>
    <optgroup label="Colour">
        <?php if($colours){?>
                <?php foreach($colours as $value){?>    
                    <option atttype="colour" value="<?php echo $value['colour_id']; ?>"><?php echo $value['colour_title'];?></option>                
                    <?php } ?>
                    <?php } ?>
                </optgroup>
    <optgroup label="Unit">
        <?php if($units){ ?>
            <?php foreach($units as $value){?>    
                <option atttype="unit" value="<?php echo $value['unit_id']; ?>"><?php echo $value['unit_title'];?></option>                
                <?php } ?>
                <?php } ?>
            </optgroup>
        </select>
    </div>    
    </div> -->
    <div style="clear:both"></div>
<div id="append">
    <!-- <div class="col-md-2 hidee" id="brand-div">
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


</div> -->
    <div class="col-md-2 hidee" id="grade-div">
<lable>Grade</lable>
    <div>
        <!-- <select class="form-control">
            <option value="0">Please Select</option>
            <?php if($grades){?>
                <?php foreach($grades as $value){?>    
                    <option value="<?php echo $value['grade_id']; ?>"><?php echo $value['grade_title'];?></option>                
                    <?php } ?>
            <?php } ?>
        </select> -->
        <?php if($grades){?>
            <?php foreach($grades as $value){?>    
                            <span><?php echo $value['grade_title'];?></span>
                <input type="text" placeholder="grade" name="gradevalue[]" style="width:100%;" value="0" />
                <?php } ?>
        <?php } ?>
        <div id="grade-input">
        </div>
        <div style="clear:both"></div>
    
    </div>
    </div>
    <div class="col-md-2 hidee"id="model-div">
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
                        <input type="text" name="modelvalue[]" style="width:100%;" value="0" />
                        <?php } ?>
                        <?php } ?>
                <div id="model-input">
                </div>
                <div style="clear:both"></div>
                
    </div>
</div>
    <div class="col-md-2 hidee"id="size-div">
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
                <input type="text" name="sizevalue[]" style="width:100%;" value="0" />
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
                        <input type="text" name="typevalue[]" style="width:100%;" />
                        <?php } ?>
                        <?php } ?>
                        <div id="type-input">
                            </div>
                            <div style="clear:both"></div>
                            
                        </div>
                    </div>
                    <div class="col-md-2 hidee" id="unit-div">
                        <lable>units</lable>
                        <div>
                            <!-- <select class="form-control">
                                <option value="0">Please Select</option>
                                <?php if($units){ ?>
                                    <?php foreach($units as $value){?>    
                                        <option value="<?php echo $value['unit_id']; ?>"><?php echo $value['unit_title'];?></option>                
                                        <?php } ?>
                                        <?php } ?>
                                    </select> -->
                                    <?php if($units){ ?>
                                        <?php foreach($units as $value){?>    
                                            <!-- <option value="<?php echo $value['unit_id']; ?>"><?php echo $value['unit_title'];?></option>                 -->
                                            <span><?php echo $value['unit_title'];?></span>
                                            <input type="text" name="unitvalue[]" style="width:100%;" />
                                            <?php } ?>
                                            <?php } ?>
                        <div id="unit-input">
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
                <input type="text" name="colourvalue[]" style="width:100%;" />
                <?php } ?>
        <?php } ?>
    <div id="colour-input">
                        </div>
                        <div style="clear:both"></div>
    </div>
</div>
</div>