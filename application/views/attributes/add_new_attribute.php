
                                        
                                    <?php 
                                    $brands_attribute_fk=array();
                                    $grades_attribute_fk=array();
                                    $models_attribute_fk=array();
                                    $sizes_attribute_fk=array();
                                    $types_attribute_fk=array();
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
                                 //    print_r($brands_attribute_fk);
                                     ?>
                                     <form id="sbmtatt" onsubmit="return false;">
                                         <div class="col-md-3 custompdding " >
                                            <label>select Brands</label>
                                            <select class="form-control js-example-basic-multiple" multiple name="brand_id[]" id="brand_id">
                                                
                                                <?php if ($all_brands) { ?>
                                                    <?php foreach ($all_brands as $value) { ?>
                                                        <option  value="<?php echo $value["brand_id"]; ?>" <?php if( in_array( $value['brand_id'],$brands_attribute_fk ) ){ ?> selected <?php } ?> ><?php echo $value["brand_title"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            </div>
                                             <div class="col-md-2 custompdding select2" >
                                            <label>select Grades</label>
                                            <select class="form-control js-example-basic-multiple" multiple name="grade_id[]" id="grade_id">
                                                
                                                <?php if ($all_grades) { ?>
                                                    <?php foreach ($all_grades as $value) { ?>
                                                        <option  value="<?php echo $value["grade_id"]; ?>" <?php if( in_array( $value['grade_id'],$grades_attribute_fk ) ){ ?> selected <?php } ?> ><?php echo $value["grade_title"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            </div>
                                             <div class="col-md-2 custompdding select" >
                                            <label>select Models</label>
                                            <select class="form-control js-example-basic-multiple" multiple name="model_id[]" id="model_id">
                                                
                                                <?php if ($all_models) { ?>
                                                    <?php foreach ($all_models as $value) { ?>
                                                        <option  value="<?php echo $value["model_id"]; ?>" <?php if( in_array( $value['model_id'],$models_attribute_fk ) ){ ?> selected <?php } ?>  ><?php echo $value["model_title"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            </div>
                                        <div class="col-md-2 custompdding" >
                                            <label>select Sizes</label>
                                            <select class="form-control js-example-basic-multiple select2" multiple name="size_id[]" id="size_id">
                                                
                                                <?php if ($all_sizes) { ?>
                                                    <?php foreach ($all_sizes as $value) { ?>
                                                        <option  value="<?php echo $value["size_id"]; ?>" <?php if( in_array( $value['size_id'],$sizes_attribute_fk ) ){ ?> selected <?php } ?>  ><?php echo $value["size_title"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 custompdding sect2" >
                                            <label>select Types</label>
                                            <select class="form-control js-example-basic-multiple select2" multiple name="type_id[]" id="type_id">
                                                
                                                <?php if ($all_types) { ?>
                                                    <?php foreach ($all_types as $value) { ?>
                                                        <option  value="<?php echo $value["type_id"]; ?>" <?php if( in_array( $value['type_id'],$types_attribute_fk ) ){ ?> selected <?php } ?>  ><?php echo $value["type_title"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <input value="<?php echo $itemid ?>" name="itemid" type="hidden"/>
                                            <div style="clear:both"></div>
                                         <button  class="btn btn-default" id="sc" type="submit">Add</button>
                                    </form>
                                     