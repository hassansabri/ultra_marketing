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
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="myorder">
                        <div class="well">
                            <div class="widget-body">
                                <input class="tags"/><span><button class="btn btn-peimary" value="Add More"><i class="fa fa-plus"></i>Add More</button></span>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="myorder"></div> -->
                    
                </div>
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>

<script>
        const availableTags = [
      <?php 
         if (sizeof($all_items) > 0) { ?>
            <?php foreach ($all_items as $value) { ?>
            <?php  
            $title='';
            $brand_title = get_att_name($value['item_brand_fk'],'brands','brand_title',$type='brand');
            ?>
             { label:  "<?php echo $brand_title;  ?> / <?php echo $value['item_name']; ?>",
              value:  "<?php echo $value['item_id']; ?>"},
             <?php }
            
        }
        ?>
   ];
    orders.applyautocomoplete(availableTags);
    orders.init();
</script>
<?php $this->load->view("common/footer"); ?>
