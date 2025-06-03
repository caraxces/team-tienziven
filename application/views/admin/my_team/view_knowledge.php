<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">
                            <?php echo $knowledge->subject; ?>
                            <?php if ($knowledge->category_id) { 
                                $category = get_knowledge_category($knowledge->category_id);
                                if ($category) {
                            ?>
                            <span class="label label-default mright5"><?php echo $category->name; ?></span>
                            <?php } } ?>
                        </h4>
                        <hr class="hr-panel-heading" />
                        
                        <div class="tc-content">
                            <?php echo $knowledge->description; ?>
                        </div>
                        
                        <?php if (!empty($knowledge->attachment)) { ?>
                        <hr class="hr-panel-heading" />
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="bold"><?php echo _l('knowledge_attachments'); ?></h5>
                                <div class="attachments">
                                    <div class="attachment">
                                        <div class="pull-right">
                                            <a href="<?php echo admin_url('my_team/download_knowledge_attachment/' . $knowledge->id); ?>" class="btn btn-success pull-left">
                                                <i class="fa fa-cloud-download"></i>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="media-heading mtop10">
                                                <a href="<?php echo admin_url('my_team/download_knowledge_attachment/' . $knowledge->id); ?>"><?php echo $knowledge->attachment; ?></a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('knowledge_article_information'); ?></h4>
                        <hr class="hr-panel-heading" />
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table no-margin">
                                    <tbody>
                                        <tr>
                                            <td class="bold"><?php echo _l('knowledge_article_visibility'); ?></td>
                                            <td>
                                                <?php
                                                switch ($knowledge->visibility) {
                                                    case 'all':
                                                        echo _l('knowledge_article_visibility_all');
                                                        break;
                                                    case 'departments':
                                                        echo _l('knowledge_article_visibility_departments');
                                                        break;
                                                    case 'staff':
                                                        echo _l('knowledge_article_visibility_staff');
                                                        break;
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php if ($knowledge->visibility == 'departments' && !empty($knowledge->departments)) { 
                                            $departments = unserialize($knowledge->departments);
                                        ?>
                                        <tr>
                                            <td class="bold"><?php echo _l('departments'); ?></td>
                                            <td>
                                                <?php
                                                $dnames = [];
                                                if (is_array($departments)) {
                                                    $CI = &get_instance();
                                                    $CI->load->model('departments_model');
                                                    foreach ($departments as $d) {
                                                        $dep = $CI->departments_model->get($d);
                                                        if ($dep) {
                                                            $dnames[] = $dep->name;
                                                        }
                                                    }
                                                }
                                                echo implode(', ', $dnames);
                                                ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php if ($knowledge->visibility == 'staff' && !empty($knowledge->staff)) { 
                                            $staff_members = unserialize($knowledge->staff);
                                        ?>
                                        <tr>
                                            <td class="bold"><?php echo _l('staff_members'); ?></td>
                                            <td>
                                                <?php
                                                $snames = [];
                                                if (is_array($staff_members)) {
                                                    $CI = &get_instance();
                                                    $CI->load->model('staff_model');
                                                    foreach ($staff_members as $s) {
                                                        $stf = $CI->staff_model->get($s);
                                                        if ($stf) {
                                                            $snames[] = $stf->firstname . ' ' . $stf->lastname;
                                                        }
                                                    }
                                                }
                                                echo implode(', ', $snames);
                                                ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td class="bold"><?php echo _l('knowledge_created_by'); ?></td>
                                            <td>
                                                <?php
                                                $CI = &get_instance();
                                                $CI->load->model('staff_model');
                                                $creator = $CI->staff_model->get($knowledge->created_by);
                                                echo $creator ? $creator->firstname . ' ' . $creator->lastname : '-';
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bold"><?php echo _l('knowledge_created_at'); ?></td>
                                            <td><?php echo _dt($knowledge->created_at); ?></td>
                                        </tr>
                                        <?php if ($knowledge->updated_at) { ?>
                                        <tr>
                                            <td class="bold"><?php echo _l('knowledge_updated_at'); ?></td>
                                            <td><?php echo _dt($knowledge->updated_at); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if (has_knowledge_edit_permission($knowledge->id) || has_knowledge_delete_permission($knowledge->id)) { ?>
                        <hr class="hr-panel-heading" />
                        <div class="btn-group">
                            <?php if (has_knowledge_edit_permission($knowledge->id)) { ?>
                            <a href="<?php echo admin_url('my_team/knowledge_item/' . $knowledge->id); ?>" class="btn btn-default btn-sm">
                                <i class="fa fa-pencil"></i> <?php echo _l('edit'); ?>
                            </a>
                            <?php } ?>
                            <?php if (has_knowledge_delete_permission($knowledge->id)) { ?>
                            <a href="<?php echo admin_url('my_team/delete_knowledge/' . $knowledge->id); ?>" class="btn btn-danger btn-sm _delete">
                                <i class="fa fa-remove"></i> <?php echo _l('delete'); ?>
                            </a>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
$(function() {
    // Load custom CSS
    var customCSS = document.createElement('link');
    customCSS.rel = 'stylesheet';
    customCSS.type = 'text/css';
    customCSS.href = site_url + 'application/views/admin/my_team/assets/css/my_team.css';
    document.head.appendChild(customCSS);
});
</script> 