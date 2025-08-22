 <?php 
                                                
                                                    if (sizeof($all_logs) > 0) { 
                                                        $length = count($all_logs);
                                                        $counter = 0; 
                                                        $cb = 0; 
                                                        ?>
                                                        <?php foreach ($all_logs as $value) {  
                                                                $counter++;
                                                    ?>
                                                            <tr>
                                                                <td><?php 
                                                                echo $val = getpackingtitle($value["packing_fk"]); ?></td>
                                                                <td><?php echo $value["entry_date"]; ?></td>
                                                                <td><?php echo $value["stock_type"]; ?></td>
                                                                <td><?php echo $value["balance"]; ?></td>
                                                                <td><?php 
                                                                if($value["stock_type"]=='stock_deduction'){
                                                                    
                                                                    $cb=$cb-$value["balance"];
                                                                }else{
                                                                    $cb=$cb+$value["balance"];

                                                                }
                                                                    // This is the last iteration
                                                                    echo $cb; 
                                                                    
                                                                     
                                                                         ?>
                                                                </td>
                                                                
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                    <?php } ?>