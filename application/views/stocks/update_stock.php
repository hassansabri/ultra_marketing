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
                                    
                                    <?php  if ($all_brands) { ?>
                                                    <?php foreach ($all_brands as $value) { ?>
                                                  <?php if( in_array( $value['brand_id'],$brands_attribute_fk ) ){ ?>
                                                     <div class="values"><input type="text" value="<?php if( in_array( $value['brand_id'],$brands_attribute_fk ) ){ echo $value['brand_title']; } ?>" disabled/></div>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                <?php } ?>
                                     </div>
                                   <div class="main-div">
                                         <div class="sub-div">Grades</div>
                                    
                                    <?php  if ($all_grades) { ?>
                                                    <?php foreach ($all_grades as $value) { ?>
                                                  <?php if( in_array( $value['grade_id'],$grades_attribute_fk ) ){ ?>
                                                     <div class="values"><input type="text" value="<?php if( in_array( $value['grade_id'],$grades_attribute_fk ) ){ echo $value['grade_title']; } ?>" disabled/></div>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                <?php } ?>
                                     </div>
                                     <div class="main-div">
                                         <div class="sub-div">Models</div>
                                    
                                    <?php  if ($all_models) { ?>
                                                    <?php foreach ($all_models as $value) { ?>
                                                  <?php if( in_array( $value['model_id'],$models_attribute_fk ) ){ ?>
                                                     <div class="values"><input type="text" value="<?php if( in_array( $value['model_id'],$models_attribute_fk ) ){ echo $value['model_title']; } ?>" disabled/></div>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                <?php } ?>
                                     </div>
                                     <div class="main-div">
                                         <div class="sub-div">Sizes</div>
                                    
                                    <?php  if ($all_sizes) { ?>
                                                    <?php foreach ($all_sizes as $value) { ?>
                                                  <?php if( in_array( $value['size_id'],$sizes_attribute_fk ) ){ ?>
                                                     <div class="values"><input type="text" value="<?php if( in_array( $value['size_id'],$sizes_attribute_fk ) ){ echo $value['size_title']; } ?>" disabled/></div>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                <?php } ?>
                                     </div>
                                     <div class="main-div">
                                         <div class="sub-div">Types</div>
                                    
                                    <?php  if ($all_types) { ?>
                                                    <?php foreach ($all_types as $value) { ?>
                                                  <?php if( in_array( $value['type_id'],$types_attribute_fk ) ){ ?>
                                                     <div class="values"><input type="text" value="<?php if( in_array( $value['type_id'],$types_attribute_fk ) ){ echo $value['type_title']; } ?>" disabled/></div>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                <?php } ?>
                                     </div> 
                                     <div class="main-div">
                                         <div class="sub-div">Colours</div>
                                    
                                    <?php  if ($all_colours) { ?>
                                                    <?php foreach ($all_colours as $value) { ?>
                                                  <?php if( in_array( $value['colour_id'],$colours_attribute_fk ) ){ ?>
                                                     <div class="values"><input type="text" value="<?php if( in_array( $value['colour_id'],$colours_attribute_fk ) ){ echo $value['colour_title']; } ?>" disabled/></div>
                                                     <?php } ?>
                                                        
                                                    <?php } ?>
                                                <?php } ?>
                                     </div> 