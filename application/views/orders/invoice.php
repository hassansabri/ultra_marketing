<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li>All Shops</li><li><?php echo $this->lang->line("create_new"); ?></li>
        </ol>
        <!-- end breadcrumb -->
    </div>
    <!-- END RIBBON -->
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <div id="wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="well">
                            <div class="widget-body">
								<div class="invoice-box">
									<table cellpadding="0" cellspacing="0"  class="">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img
										src="<?Php site_url()?>/assets/img/invoicelogo.png"
										style="width: 100%; max-width: 300px"
									/>
								</td>

								<td>
									Invoice #: 123<br />
									Created: <?php echo date('l, F j, Y')?><br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
								<?php echo $profile[0]['adress']?>
								</td>

								<td>
									
									John Doe<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>

					<td>Check #</td>
				</tr>

				<tr class="details">
					<td>Check</td>

					<td>1000</td>
				</tr>

				<tr class="heading">
					<td>Items
						
					</td>

					<td>Price</td>
				</tr>

				<tr class="item">
					<td class="invoice-item">Website design
						<div>
                                    <?php 
                                    $brands_attribute_fk=array();
                                    $grades_attribute_fk=array();
                                    $models_attribute_fk=array();
                                    $sizes_attribute_fk=array();
                                    $types_attribute_fk=array();
                                    $colours_attribute_fk=array();
                                    $units_attribute_fk=array();
                                    
                                    // foreach($get_item_units as $value){
                                    //     $units_attribute_fk[] = $value['attribute_fk'];
                                         
                                    // }
                                    // foreach($get_item_brands as $value){
                                    //     $brands_attribute_fk[] = $value['attribute_fk'];
                                         
                                    // }
                                    
                                    // foreach($get_item_grades as $value){
                                    //     $grades_attribute_fk[] = $value['attribute_fk'];
                                    // }
                                    // foreach($get_item_models as $value){
                                    //     $models_attribute_fk[] = $value['attribute_fk'];
                                    // }
                                    // foreach($get_item_sizes as $value){
                                    // $sizes_attribute_fk[] = $value['attribute_fk'];
                                    // }
                                    // foreach($get_item_types as $value){
                                    //     $types_attribute_fk[] = $value['attribute_fk'];
                                    // }
                                    // foreach($get_item_colours as $value){
                                    //     $colours_attribute_fk[] = $value['attribute_fk'];
                                    // }
                                 //    print_r($brands_attribute_fk);
                                     ?>
                                     <form id="sbmtatt" onsubmit="return false;">
                                         <div class="col-md-2 custompdding " >
                                            <label class="invoice-att-title">Brands</label>
                                            
                                            </div>
                                        <div class="col-md-2 custompdding" >
                                            <label class="invoice-att-title">Sizes</label>
                                            
                                        </div>
                                        <div class="col-md-2 custompdding sect2" >
                                            <label class="invoice-att-title">Types</label>
                                            
                                        </div>
                                        <div class="col-md-2 custompdding sect2" >
                                            <label class="invoice-att-title">Colour</label>
                                            
                                        </div>
                                        <div class="col-md-2 custompdding sect2" >
                                            <label class="invoice-att-title">Units</label>
                                            
                                        </div>
										     <div class="col-md-2 custompdding select2" >
                                            <label class="invoice-att-title">Grades</label>
                                            
                                            </div>
                                             <div class="col-md-2 custompdding select" >
                                            <label class="invoice-att-title">Models</label>
                                           
                                            </div>
                                        <!-- <input value="<?php echo $itemid ?>" name="itemid" type="hidden"/> -->
                                            <div style="clear:both"></div>
                                         <button  class="btn btn-default" id="sc" type="submit">Add</button>
                                    </form>
                                     
						</div>
					</td>

					<td>$300.00</td>
				</tr>

				<tr class="total">
					<td></td>

					<td>Total: $385.00</td>
				</tr>
			</table>
								</div>
                                
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>
<?php
    $lat =  31.41986;
    $longni = 74.25348;
    $radius = 50;
    ?>
    <script src="<?php echo base_url(); ?>assets/js/locationpicker.jquery.min.js"></script>
<script>
    shops.init();

       $(document).ready(function () {
        $('#google_map').locationpicker({
            location: {
                latitude: <?php echo $lat; ?>,
                longitude: <?php echo $longni; ?>
            },
            radius: <?php echo $radius; ?>,
            zoom: 19,
            scrollwheel: false,
            enableAutocomplete: true,
            inputBinding: {
        latitudeInput: $('#us2-lat'),
        longitudeInput: $('#us2-lon'),
       // radiusInput: $('#us2-radius'),
        locationNameInput: $('#us2-address')
    },
    enableAutocomplete: true,
        });
    });
</script>
<?php $this->load->view("common/footer"); ?>