<table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                <tr>
                                                    <th data-class="expand">Item Name</th>
                                             
                                                    <!-- <th>brand</th>
                                                    <th>grade</th>
                                                    <th>Model</th>
                                                    <th>Size</th>
                                                    <th>Type</th>
                                                    <th>colour</th>
                                                    <th>Unit</th> -->
                                                    <th>Entry Date</th>
                                                    <th>stock Type</th>
                                                    <th>current balance</th>
                                                    <th>Balance</th>
                                                </tr>
                                                </thead>

                                                <tbody id="mylogs">
                                                    <?php $this->load->view("stocks/logs_values"); ?>
                                                </tbody>

                                            </table>