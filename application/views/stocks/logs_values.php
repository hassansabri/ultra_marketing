 <?php 
                                                
                                                    if (sizeof($all_logs) > 0) { ?>
                                                        <?php foreach ($all_logs as $value) {  
                                                    ?>
                                                            <tr>
                                                                <td><?php 
                                                                echo $val = get_item_name($value["item_fk"]); ?></td>
                                                                <td><?php
                                                                $val = get_att_name($value["brand_fk"],'brands','brand_title','brand');
                                                                echo $val; ?></td>
                                                                <td><?php
                                                                $val = get_att_name($value["grade_fk"],'grades','grade_title','grade');
                                                                echo $val; ?></td>
                                                                <td><?php
                                                                $val = get_att_name($value["model_fk"],'models','model_title','model');
                                                                echo $val; ?></td>
                                                                <td><?php
                                                                $val = get_att_name($value["size_fk"],'sizes','size_title','size');
                                                                echo $val; ?></td>
                                                                <td><?php
                                                                $val = get_att_name($value["type_fk"],'types','type_title','type');
                                                                echo $val; ?></td>
                                                                <td><?php
                                                                $val = get_att_name($value["colour_fk"],'colours','colour_title','colour');
                                                                echo $val; ?></td>
                                                                <td><?php
                                                                $val = get_att_name($value["unit_fk"],'units','unit_title','unit');
                                                                echo $val; ?></td>
                                                                <td><?php echo $value["stock_type"]; ?></td>
                                                                <td><?php echo $value["balance"]; ?></td>
                                                                
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                    <?php } ?>