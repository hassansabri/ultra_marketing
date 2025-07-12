<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li>Units Management</li>
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
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-units-1" data-widget-deletebutton="false" data-widget-editbutton="false">
                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-cubes"></i> </span>
                                        <h2>Units List</h2>
                                        <a href="<?php echo site_url('units/addunit'); ?>" class="btn btn-primary pull-right" style="margin-top:8px;margin-right:10px;">Add Unit</a>
                                    </header>
                                    <div>
                                        <div class="jarviswidget-editbox"></div>
                                        <div class="widget-body no-padding">
                                            <table class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Unit Title</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($all_units)) { foreach ($all_units as $unit) { ?>
                                                        <tr>
                                                            <td><?php echo $unit['unit_id']; ?></td>
                                                            <td><?php echo htmlspecialchars($unit['unit_title']); ?></td>
                                                            <td>
                                                                <span class="onoffswitch">
                                                                    <input class="onoffswitch-checkbox changestatusunits" id="<?php echo $unit['unit_id'] ?>" type="checkbox" <?php if ($unit["status"] == "1") { ?>checked="checked" value="1"<?php } else { ?>value='0'<?php } ?> >
                                                                    <label class="onoffswitch-label" for="<?php echo $unit['unit_id'] ?>"> 
                                                                        <span class="onoffswitch-inner" data-swchon-text="Active" data-swchoff-text="Inactive"></span> 
                                                                        <span class="onoffswitch-switch"></span> 
                                                                    </label> 
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo site_url('units/editunit/' . $unit['unit_id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                                                                <a href="<?php echo site_url('units/deleteunit/' . $unit['unit_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this unit?');">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php }} else { ?>
                                                        <tr><td colspan="4">No units found.</td></tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
    units.init();
</script>
<?php $this->load->view("common/footer"); ?> 