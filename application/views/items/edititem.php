<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li>All Items</li><li>update</li>
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
                                <form id="adduser-form" method="post" action="<?php echo site_url(); ?>/items/updateitem/<?php echo $item_detail[0]["item_id"]; ?>" class="" enctype="multipart/form-data">
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
                                      Update
                                        </legend>
                                        <div class="form-group">
                                            <label> Item <?php echo $this->lang->line("name"); ?></label>
                                            <input name="item_name" id="item_name" class="form-control" type="text" value="<?php echo $item_detail[0]["item_name"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label> Item code</label>
                                            <input name="item_code" id="item_code " class="form-control" type="text" value="<?php echo $item_detail[0]["item_code"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label> Item Weight</label>
                                            <input name="item_weight" id="item_weight " class="form-control" type="text" value="<?php echo $item_detail[0]["item_weight"]; ?>">
                                        </div>
                                          <div class="form-group">
                                            <label> Item Expire Date</label>
                                            <input name="item_expire_date" id="item_expire_date" class="form-control" type="text" value="<?php echo $item_detail[0]["item_expire_date"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4 custompdding" >
                                            <label>select category</label>
                                            <select class="form-control" name="parent_id" id="parent_id">
                                                <option value="0">Select Category</option>
                                                <?php if ($all_categories) { ?>
                                                    <?php foreach ($all_categories as $value) { ?>
                                                        <option <?php if($item_detail[0]['item_cat_fk'] == $value['category_id'])echo 'selected'; ?> value="<?php echo $value["category_id"]; ?>" ><?php echo $value["category_name"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            </div>
                                          
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4 custompdding" >
                                            <label>select Brand</label>
                                            <select class="form-control" name="brand_id" id="brand_id">
                                                <option value="0">Select Brand</option>
                                                <?php if ($all_brands) { ?>
                                                    <?php foreach ($all_brands as $value) { ?>
                                                        <option <?php if($item_detail[0]['item_brand_fk'] == $value['brand_id'])echo 'selected'; ?> value="<?php echo $value["brand_id"]; ?>" ><?php echo $value["brand_title"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            </div>
                                          
                                        </div>
                                        </div>
                                                <div class="form-group" >
                                                <label> Item Description</label>
                                                <textarea rows="10" name="item_description" id="item_description" class="form-control" ><?php echo $item_detail[0]["item_description"]; ?></textarea>
                                                
                                            </div>
                                            </div>
                                        </div>
                                                
                                    </section>
                                  
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
<script type="text/javascript">
    items.init();
</script>
<?php $this->load->view("common/footer"); ?>