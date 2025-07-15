<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li><a href="<?php echo site_url(); ?>/profile">All Profiles</a></li>
            <li>Edit Profile</li>
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
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Edit Company Profile</h2>
                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="widget-body">
                                        <?php if(isset($profile_detail) && !empty($profile_detail)): ?>
                                            <form id="profile-form" class="smart-form" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <div class="row">
                                                        <section class="col col-6">
                                                            <label class="label">Shop/Company Name <span class="text-danger">*</span></label>
                                                            <label class="input">
                                                                <i class="icon-append fa fa-building"></i>
                                                                <input type="text" name="shop_name" placeholder="Enter shop/company name" 
                                                                       value="<?php echo $profile_detail['shop_name']; ?>" required>
                                                            </label>
                                                        </section>
                                                        <section class="col col-6">
                                                            <label class="label">Contact Person Name <span class="text-danger">*</span></label>
                                                            <label class="input">
                                                                <i class="icon-append fa fa-user"></i>
                                                                <input type="text" name="name" placeholder="Enter contact person name" 
                                                                       value="<?php echo $profile_detail['name']; ?>" required>
                                                            </label>
                                                        </section>
                                                    </div>

                                                    <div class="row">
                                                        <section class="col col-6">
                                                            <label class="label">Email Address <span class="text-danger">*</span></label>
                                                            <label class="input">
                                                                <i class="icon-append fa fa-envelope"></i>
                                                                <input type="email" name="email" placeholder="Enter email address" 
                                                                       value="<?php echo $profile_detail['email']; ?>" required>
                                                            </label>
                                                        </section>
                                                        <section class="col col-6">
                                                            <label class="label">Phone Number <span class="text-danger">*</span></label>
                                                            <label class="input">
                                                                <i class="icon-append fa fa-phone"></i>
                                                                <input type="text" name="phone" placeholder="Enter phone number" 
                                                                       value="<?php echo $profile_detail['phone']; ?>" required>
                                                            </label>
                                                        </section>
                                                    </div>

                                                    <div class="row">
                                                        <section class="col col-12">
                                                            <label class="label">Address <span class="text-danger">*</span></label>
                                                            <label class="textarea">
                                                                <i class="icon-append fa fa-map-marker"></i>
                                                                <textarea name="adress" rows="3" placeholder="Enter complete address" required><?php echo $profile_detail['adress']; ?></textarea>
                                                            </label>
                                                        </section>
                                                    </div>

                                                    <div class="row">
                                                        <section class="col col-6">
                                                            <label class="label">Company Logo</label>
                                                            <label class="input">
                                                                <i class="icon-append fa fa-image"></i>
                                                                <input type="file" name="logo" accept="image/*" onchange="previewImage(this)">
                                                            </label>
                                                            <div class="note">
                                                                <strong>Note:</strong> Supported formats: JPG, JPEG, GIF, PNG. Max size: 2MB
                                                            </div>
                                                            <?php if(isset($profile_detail['logo']) && $profile_detail['logo'] != ''): ?>
                                                                <div class="note">
                                                                    <strong>Current Logo:</strong> <?php echo $profile_detail['logo']; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </section>
                                                        <section class="col col-6">
                                                            <div id="logo-preview" style="display: none;">
                                                                <label class="label">New Logo Preview</label>
                                                                <div style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; text-align: center;">
                                                                    <img id="preview-img" src="" alt="Logo Preview" style="max-width: 200px; max-height: 150px;">
                                                                </div>
                                                            </div>
                                                            <?php if(isset($profile_detail['logo']) && $profile_detail['logo'] != ''): ?>
                                                                <div id="current-logo">
                                                                    <label class="label">Current Logo</label>
                                                                    <div style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; text-align: center;">
                                                                        <img src="<?php echo base_url(); ?>images/<?php echo $profile_detail['logo']; ?>" 
                                                                             alt="Current Logo" style="max-width: 200px; max-height: 150px;">
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </section>
                                                    </div>
                                                </fieldset>

                                                <footer>
                                                    <button type="submit" name="sbmt" value="sbmt" class="btn btn-primary">
                                                        <i class="fa fa-save"></i> Update Profile
                                                    </button>
                                                    <a href="<?php echo site_url(); ?>/profile" class="btn btn-default">
                                                        <i class="fa fa-times"></i> Cancel
                                                    </a>
                                                </footer>
                                            </form>
                                        <?php else: ?>
                                            <div class="alert alert-danger">
                                                <i class="fa fa-exclamation-triangle"></i> Profile not found or invalid profile ID.
                                            </div>
                                            <a href="<?php echo site_url(); ?>/profile" class="btn btn-default">
                                                <i class="fa fa-arrow-left"></i> Back to Profiles
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <!-- end widget content -->
                                </div>
                                <!-- end widget div -->
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

<script type="text/javascript">
$(document).ready(function() {
    // Form validation
    $('#profile-form').validate({
        rules: {
            shop_name: {
                required: true,
                minlength: 2
            },
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 10
            },
            adress: {
                required: true,
                minlength: 10
            }
        },
        messages: {
            shop_name: {
                required: "Please enter shop/company name",
                minlength: "Shop name must be at least 2 characters long"
            },
            name: {
                required: "Please enter contact person name",
                minlength: "Name must be at least 2 characters long"
            },
            email: {
                required: "Please enter email address",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Please enter phone number",
                minlength: "Phone number must be at least 10 digits"
            },
            adress: {
                required: "Please enter address",
                minlength: "Address must be at least 10 characters long"
            }
        },
        errorElement: 'span',
        errorClass: 'help-block',
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
});

// Image preview function
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview-img').attr('src', e.target.result);
            $('#logo-preview').show();
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#logo-preview').hide();
    }
}
</script>

<style>
.smart-form .input input[type="file"] {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #fff;
}

.smart-form .note {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

#logo-preview, #current-logo {
    margin-top: 20px;
}

.has-error .input {
    border-color: #a94442;
}

.help-block {
    color: #a94442;
    font-size: 12px;
    margin-top: 5px;
}
</style>

<?php $this->load->view("common/footer"); ?> 