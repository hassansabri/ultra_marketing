<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li>All Countries</li>
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
                        <div class="well no-padding">


                            <fieldset>
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">
                                    <!-- widget options:
                                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
    
                                    data-widget-colorbutton="false"
                                    data-widget-editbutton="false"
                                    data-widget-togglebutton="false"
                                    data-widget-deletebutton="false"
                                    data-widget-fullscreenbutton="false"
                                    data-widget-custombutton="false"
                                    data-widget-collapsed="true"
                                    data-widget-sortable="false"
    
                                    -->
                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                        <h2>All Countries</h2>

                                    </header>

                                    <!-- widget div-->
                                    <div>

                                        <!-- widget edit box -->
                                        <div class="jarviswidget-editbox">
                                            <!-- This area used as dropdown edit box -->
                                        </div>
                                        <!-- end widget edit box -->
                                        <!-- widget content -->
                                        <div class="widget-body no-padding">
                                            <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                <tr>
                                                    <th data-class="expand">country Name</th>
                                                    <th data-hide="phone,tablet"><?php echo $this->lang->line("status"); ?></th>
                                                    <th data-hide=""><?php echo $this->lang->line("option"); ?></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                
                                                    if (sizeof($all_countries) > 0) { ?>
                                                        <?php foreach ($all_countries as $value) {  
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $value["country_name"]; ?></td>
                                                                <td>
                                                                    <span class="onoffswitch">
                                                                        <input class="onoffswitch-checkbox changestatuscountry" id="<?php echo $value['country_id'] ?>" type="checkbox" <?php if ($value["country_status"] == "1") { ?>checked="checked" value="1"<?php } else { ?>value='0'<?php } ?> >
                                                                        <label class="onoffswitch-label" for="<?php echo $value['country_id'] ?>"> 
                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo $this->lang->line("active"); ?>" data-swchoff-text="Disable"></span> 
                                                                            <span class="onoffswitch-switch"></span> 
                                                                        </label> 
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-primary">
                                                                            <?php echo $this->lang->line("dropdown"); ?>
                                                                        </button>
                                                                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li>
                                                                                <a href="<?php echo site_url(); ?>/countries/editcountry/<?php echo $value['country_id']; ?>">Edit country</a>
                                                                            </li>
                                                                           
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                    <?php } ?>
                                                </tbody>

                                            </table>

                                        </div>
                                        <!-- end widget content -->

                                    </div>
                                    <!-- end widget div -->

                                </div>
                            </fieldset>

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
   country.init();
</script>
<?php $this->load->view("common/footer"); ?>