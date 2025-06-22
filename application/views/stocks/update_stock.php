 <?php 
                                    $brands_attribute_fk=array();
                                    $grades_attribute_fk=array();
                                    $models_attribute_fk=array();
                                    $sizes_attribute_fk=array();
                                    $types_attribute_fk=array();
                                    $colours_attribute_fk=array();
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
                                 //    print_r($brands_attribute_fk);
                                     ?>
                                     <div class="main-div">
                                         <div class="sub-div">Brand</div>
                                    <div style="text-align:left;">
                                        <span>Title</span>
                                    </div>
                                    <?php  if ($all_brands) { ?>
                                        <select id="brand" name="brand" class="form-control">
                                            <option value="">Please Select</option>
                                                    <?php foreach ($all_brands as $value) { ?>
                                                  <?php if( in_array( $value['brand_id'],$brands_attribute_fk ) ){ ?>
                                                    <option value="<?php if( in_array( $value['brand_id'],$brands_attribute_fk ) ){ echo $value['brand_id']; } ?>"><?php echo $value['brand_title'];?></option>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                </select>
                                                    <?php } ?>
                                                
                                     </div>
                                   <div class="main-div">
                                         <div class="sub-div">Grades</div>
                                    
                                    <?php  if ($all_grades) { ?>
                                                    <select id="grade" name="grade" class="form-control">
                                            <option value="">Please Select</option>
                                                    <?php foreach ($all_grades as $value) { ?>
                                                  <?php if( in_array( $value['grade_id'],$grades_attribute_fk ) ){ ?>
                                                    <option value="<?php if( in_array( $value['grade_id'],$grades_attribute_fk ) ){ echo $value['grade_id']; } ?>"><?php echo $value['grade_title'];?></option>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                </select>
                                                <?php } ?>
                                     </div>
                                     <div class="main-div">
                                         <div class="sub-div">Models</div>
                                    
                                    <?php  if ($all_models) { ?>
                                                    <select id="model" name="model" class="form-control">
                                            <option value="">Please Select</option>
                                                    <?php foreach ($all_models as $value) { ?>
                                                  <?php if( in_array( $value['model_id'],$models_attribute_fk ) ){ ?>
                                                    <option value="<?php if( in_array( $value['model_id'],$models_attribute_fk ) ){ echo $value['model_id']; } ?>"><?php echo $value['model_title'];?></option>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                </select>
                                                <?php } ?>
                                     </div>
                                     <div class="main-div">
                                         <div class="sub-div">Sizes</div>
                                    
                                    <?php  if ($all_sizes) { ?>
                                                    <select id="size" name="size" class="form-control">
                                            <option value="">Please Select</option>
                                                    <?php foreach ($all_sizes as $value) { ?>
                                                  <?php if( in_array( $value['size_id'],$sizes_attribute_fk ) ){ ?>
                                                    <option value="<?php if( in_array( $value['size_id'],$sizes_attribute_fk ) ){ echo $value['size_id']; } ?>"><?php echo $value['size_title'];?></option>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                </select>
                                                <?php } ?>
                                     </div>
                                     <div class="main-div">
                                         <div class="sub-div">Types</div>
                                    
                                    <?php  if ($all_types) { ?>
                                                    <select id="type" name="type" class="form-control">
                                            <option value="">Please Select</option>
                                                    <?php foreach ($all_types as $value) { ?>
                                                  <?php if( in_array( $value['type_id'],$types_attribute_fk ) ){ ?>
                                                    <option value="<?php if( in_array( $value['type_id'],$types_attribute_fk ) ){ echo $value['type_id']; } ?>"><?php echo $value['type_title'];?></option>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                </select>
                                                <?php } ?>
                                     </div> 
                                     <div class="main-div">
                                         <div class="sub-div">Colours</div>
                                    
                                    <?php  if ($all_colours) { ?>
                                                 <select id="colour" name="colour" class="form-control">
                                            <option value="">Please Select</option>
                                                    <?php foreach ($all_colours as $value) { ?>
                                                  <?php if( in_array( $value['colour_id'],$colours_attribute_fk ) ){ ?>
                                                    <option value="<?php if( in_array( $value['colour_id'],$colours_attribute_fk ) ){ echo $value['colour_id']; } ?>"><?php echo $value['colour_title'];?></option>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                </select>
                                                <?php } ?>
                                     </div> 