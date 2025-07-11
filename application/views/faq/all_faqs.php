<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li>FAQ Management</li>
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
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-faq-1" data-widget-deletebutton="false" data-widget-editbutton="false">
                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-question-circle"></i> </span>
                                        <h2>FAQ List</h2>
                                        <a href="<?php echo site_url('faq/addfaq'); ?>" class="btn btn-primary pull-right" style="margin-top:8px;margin-right:10px;">Add FAQ</a>
                                    </header>
                                    <div>
                                        <div class="jarviswidget-editbox"></div>
                                        <div class="widget-body no-padding">
                                            <table class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Question</th>
                                                        <th>Answer</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($all_faqs)) { foreach ($all_faqs as $faq) { ?>
                                                        <tr>
                                                            <td><?php echo $faq['id']; ?></td>
                                                            <td><?php echo htmlspecialchars($faq['question']); ?></td>
                                                            <td><?php echo htmlspecialchars($faq['answer']); ?></td>
                                                            <td>
                                                                <a href="<?php echo site_url('faq/editfaq/' . $faq['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                                                                <a href="<?php echo site_url('faq/deletefaq/' . $faq['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this FAQ?');">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php }} else { ?>
                                                        <tr><td colspan="4">No FAQs found.</td></tr>
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
<?php $this->load->view("common/footer"); ?> 