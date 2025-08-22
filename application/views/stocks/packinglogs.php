<table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                <tr>
                                                    <th data-class="expand">Item Name</th>
                                                    <th>Entry Date</th>
                                                    <th>stock Type</th>
                                                    <th>Use</th>
                                                    <th>current balance</th>
                                                </tr>
                                                </thead>

                                                <tbody id="mylogs">
                                                    <?php $this->load->view("stocks/packing_logs_values"); ?>
                                                </tbody>

                                            </table>