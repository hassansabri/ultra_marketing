<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li>FAQ Management</li><li>Add FAQ</li>
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
                                <form method="post" action="<?php echo site_url('faq/submitfaq'); ?>">
                                    <fieldset>
                                        <legend>Add FAQ</legend>
                                        <div class="form-group">
                                            <label for="question">Question</label>
                                            <input type="text" class="form-control" id="question" name="question" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="answer">Answer</label>
                                            <textarea class="form-control" id="answer" name="answer" rows="4" required></textarea>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success">Add FAQ</button>
                                            <a href="<?php echo site_url('faq/index'); ?>" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </fieldset>
                                </form>
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
<?php $this->load->view("common/footer"); ?> 