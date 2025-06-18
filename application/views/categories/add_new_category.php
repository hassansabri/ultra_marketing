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
                                <form id="adduser-form" method="post" action="<?php echo site_url(); ?>/categories/submitcategory/" class="" enctype="multipart/form-data">
                                    <fieldset>
                                        <?php if ($update == "yes") { ?>
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
                                        <div class="form-grop">
                                             <div class="col-md-4 custompdding" >
                                            <label> Category <?php echo $this->lang->line("name"); ?></label>
                                            <input name="category_name" id="category_name" class="form-control" type="text" value="<?php
                                            if (isset($_POST["category_name"])) {
                                                echo $_POST["category_name"];
                                            }
                                            ?>">
                                        </div>
                                    
                                        <div class="form-grou col-md-4">
                                            <label> Category Parent</label>
                                            <select class="form-control" name="parent_id" id="parent_id">
                                                <option value="0">Please Select</option>
                                                    <?php 
                                                
                                                    if (sizeof($all_categories) > 0) 
                                                     foreach ($all_categories as $value) {  ?>
                                            <option value="<?php echo $value['category_id'] ?>"><?php echo $value['category_name'] ?></option>
                                                              <?php } else { ?>

                                                    <?php } ?>
                                        </select>

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
<?php $this->load->view("common/footer"); ?>