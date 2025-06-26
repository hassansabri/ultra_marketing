<table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                <tr>
                                                    <th data-class="expand">Item Name</th>
                                             
                                                    <th>brand</th>
                                                    <th>grade</th>
                                                    <th>Model</th>
                                                    <th>Size</th>
                                                    <th>Type</th>
                                                    <th>colour</th>
                                                    <th>Unit</th>
                                                    <th>stock Type</th>
                                                    <th>Balance</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                
                                                    if (sizeof($all_logs) > 0) { ?>
                                                        <?php foreach ($all_logs as $value) {  
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $value["item_fk"]; ?></td>
                                                                <td><?php echo $value["brand_fk"]; ?></td>
                                                                <td><?php echo $value["grade_fk"]; ?></td>
                                                                <td><?php echo $value["model_fk"]; ?></td>
                                                                <td><?php echo $value["size_fk"]; ?></td>
                                                                <td><?php echo $value["type_fk"]; ?></td>
                                                                <td><?php echo $value["colour_fk"]; ?></td>
                                                                <td><?php echo $value["unit_fk"]; ?></td>
                                                                <td><?php echo $value["stock_type"]; ?></td>
                                                                <td><?php echo $value["balance"]; ?></td>
                                                                
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                    <?php } ?>
                                                </tbody>

                                            </table>