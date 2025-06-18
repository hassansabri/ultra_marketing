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
                                <form id="adduser-form" method="post" action="<?php echo site_url(); ?>/shops/updateshop/<?php echo $shop_detail[0]["shop_id"]; ?>" class="" enctype="multipart/form-data">
                                    <fieldset>
                                        <?php  if ($update == "yes") { ?>
                                            <?php if ($error == "yes") { ?>
                                                <div class="alert alert-danger fade in">
                                                    <button class="close" data-dismiss="alert">
                                                        ×
                                                    </button>
                                                    <i class="fa-fw fa fa-times"></i>
                                                    <strong>Error!</strong> <?php echo $msg; ?>
                                                </div>
                                            <?php } else { ?>
                                                <div class="alert alert-success fade in">
                                                    <button class="close" data-dismiss="alert">
                                                        ×
                                                    </button>
                                                    <i class="fa-fw fa fa-check"></i>
                                                    <strong>Success</strong> <?php echo $msg; ?>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <legend>
                                            <?php echo $this->lang->line("create_new"); ?>
                                        </legend>
                                        <div class="form-group">
                                            <label> Shop <?php echo $this->lang->line("name"); ?></label>
                                            <input name="shop_name" id="shop_name" class="form-control" type="text" value="<?php echo $shop_detail[0]["shop_name"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label> Shop owner</label>
                                            <input name="shop_owner" id="shop_owner" class="form-control" type="text" value="<?php
                                         echo $shop_detail[0]["shop_owner"];

                                            ?>">
                                        </div>
                                        <div class="form-group">
                                            <label> Shop Email</label>
                                            <input name="shop_email" id="shop_email " class="form-control" type="text" value="<?php
                                           echo $shop_detail[0]["shop_email"];
                                            ?>">
                                        </div>
                                        <div class="form-group">
                                            <label> Shop Number</label>
                                            <input name="shop_number" id="shop_number " class="form-control" type="text" value="<?php
                                         echo   $shop_detail[0]["shop_number"];
                                            ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4 custompdding" >
                                                <?php $countries =  getCountries(); ?>
                                            <label>select country</label>
                                            <select class="form-control" name="country_id" id="country_id">
                                                <option value="">Select Country</option>
                                                <?php if ($countries) { ?>
                                                    <?php foreach ($countries as $value) { ?>
                                                        <option <?php if($shop_detail[0]['shop_country'] == $value['country_id'])echo 'selected'; ?> value="<?php echo $value["country_id"]; ?>" ><?php echo $value["country_name"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            </div>
                                            <div class="col-md-4 custompdding">
                                            <label>select State</label>
                                            <select class="form-control" name="state" id="state1">
                                                     <?php $states =  getStates($shop_detail[0]['shop_country']); ?>
                                             <?php if ($states) { ?>
                                                    <?php foreach ($states as $value) { ?>
                                                        <option <?php if($shop_detail[0]['shop_state'] == $value['state_id'])echo 'selected'; ?> value="<?php echo $value["state_id"]; ?>" ><?php echo $value["state_name"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            
                                            </select>
                                            </div>
                                            <div class="col-md-4 custompdding">
                                            <label>select city</label>
                                            <select class="form-control" name="city" id="city_id">
                                               <?php $cities=getcities($shop_detail[0]['shop_country'],$shop_detail[0]['shop_state']);?>
                                               <?php if ($cities) { ?>
                                                    <?php foreach ($cities as $value) { ?>
                                                        <option <?php if($shop_detail[0]['shop_city'] == $value['city_id'])echo 'selected'; ?> value="<?php echo $value["city_id"]; ?>" ><?php echo $value["city_name"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                             
                                            </select>
                                            </div>
                                                <div class="form-group col-md-6 custompdding" >
                                                <label> Latitude</label>
                                                <input name="shop_latitude" id="us2-lat" class="form-control" type="text" value="<?php
                                                echo $shop_detail[0]["shop_latitude"];
                                                ?>">
                                            </div>
                                            </div>
                                                <div class="form-group col-md-6 custompdding" >
                                                <label> Longitude</label>
                                                <input name="shop_longitude" id="us2-lon" class="form-control" type="text" value="<?php
                                                 echo $shop_detail[0]["shop_longitude"];
                                                ?>">
                                            </div>
                                               </div>
                                                <div class="form-group" >
                                                <label> Address</label>
                                                     <input name="shop_address" id="us2-address" class="form-control" type="text" value="<?php
                                                echo $shop_detail[0]["shop_address"];
                                                ?>">
                                              
                                            </div>
                                        </div>
                                    </section>
                                    <fieldset>
                                 <input type="text" id="us2-lat"/>
                                    <input type="text" id="us2-lon"/>
                                     <div id="google_map" style="height: 500px;"></div>
                                    </fieldset>
                                    <div class="form-group">
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" value="sbmt" name="sbmt"/>
                                                    <button class="btn btn-default" type="submit">
                                                        <i class="fa fa-eye"></i>
                                                        <?php echo $this->lang->line("Submit"); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </fieldset>                                    
                                </form>
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
    $lat = $shop_detail[0]["shop_latitude"];
    $longni = $shop_detail[0]["shop_longitude"];
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