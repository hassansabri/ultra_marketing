<div class="demo-gallery">
    <ul id="" class="list-unstyled row lightgallery">
        <?php if (sizeof($images) > 0) { ?>
            <h1><?php echo $category; ?></h1>
            <?php foreach ($images as $value) { ?>
                <?php
                $ext = end((explode(".", $value["attachment_random_name"])));
                $branch_id = $this->utils->getBranchID($value['assign_id']);
                $branch_name = $this->utils->getBranchName($branch_id);
                $created_date = $this->utils->getSurveyTime($value['assign_id']);
                //$created_date = $this->utils->getSurveyStartDate($value['assign_id']);
                ?>
                <?php if ($ext != "mp3" && $ext != "mp4") { ?>
                    <li style="margin-bottom: 10px;" class="col-xs-6 col-sm-4 col-md-3" data-responsive="<?php echo base_url(); ?>/attachments/section/<?php echo $value["attachment_random_name"]; ?>" data-src="<?php echo base_url(); ?>/attachments/section/<?php echo $value["attachment_random_name"]; ?>" data-sub-html="<?php
                    echo $value["notes"] . '<br/><strong>Branch</strong> : ';
                    echo $branch_name;
                    echo "<br/>";
                    echo date('d/m/y h:i:s A', $created_date);
                    ?>">
                        <?php } else { ?>
                    <li style="margin-bottom: 10px;" class="col-xs-6 col-sm-4 col-md-3" data-responsive="<?php echo base_url(); ?>/attachments/section/audio.png" data-src="<?php echo base_url(); ?>/attachments/section/audio.png" data-sub-html="<?php
                    echo $value["notes"] . '<br/><strong>Branch</strong> : ';
                    echo $branch_name;
                    echo "<br/>";
                    echo date('d/m/y h:i:s A', $created_date);
                    echo "<br/>";
                    echo "<audio controls><source src='" . base_url() . "/attachments/section/" . $value["attachment_random_name"] . "' type='audio/mp3'></audio>"
                    ?>">
                        <?php } ?>

                    <a href="#">
                        <?php if ($ext != "mp3" && $ext != "mp4") { ?>
                            <img style="width: 250px;height: 150px;" class="img-responsive" src="<?php echo base_url(); ?>/attachments/section/<?php echo $value["attachment_random_name"]; ?>">
                        <?php } else { ?>
                            <img style="width: 250px;height: 150px;" class="img-responsive" src="<?php echo base_url(); ?>/attachments/section/audio.png">
                        <?php } ?>

                    </a>
                </li>

                <?php
            }
        }
        ?>

    </ul>
</div>


