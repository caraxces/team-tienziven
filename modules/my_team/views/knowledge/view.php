<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="no-margin"><?php echo $item->subject; ?></h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <div class="btn-group">
                                    <a href="<?php echo admin_url('my_team/knowledge'); ?>" class="btn btn-default">
                                        <i class="fa fa-list"></i> <?php echo _l('back_to_list'); ?>
                                    </a>
                                    <?php if (staff_can('edit', 'my_team') && ($item->created_by == get_staff_user_id() || is_admin())) { ?>
                                    <a href="<?php echo admin_url('my_team/knowledge_item/' . $item->id); ?>" class="btn btn-info">
                                        <i class="fa fa-pencil"></i> <?php echo _l('general_edit'); ?>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Metadata -->
                        <div class="row mbot15">
                            <div class="col-md-6">
                                <div class="mtop5">
                                    <span class="bold"><?php echo _l('general_created_by'); ?>:</span>
                                    <?php echo isset($creator) ? $creator->firstname . ' ' . $creator->lastname : ''; ?>
                                </div>
                                <div class="mtop5">
                                    <span class="bold"><?php echo _l('general_created_at'); ?>:</span>
                                    <?php echo _dt($item->created_at); ?>
                                </div>
                                <?php if ($item->category_id && isset($category)) { ?>
                                <div class="mtop5">
                                    <span class="bold"><?php echo _l('knowledge_category'); ?>:</span>
                                    <?php echo $category->name; ?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <div class="mtop5">
                                    <span class="bold"><?php echo _l('general_visibility'); ?>:</span>
                                    <?php 
                                    if ($item->visibility == 'all') {
                                        echo '<span class="label label-success">' . _l('knowledge_visibility_all') . '</span>';
                                    } elseif ($item->visibility == 'departments') {
                                        echo '<span class="label label-info">' . _l('knowledge_visibility_departments') . '</span>';
                                    } else {
                                        echo '<span class="label label-default">' . _l('knowledge_visibility_private') . '</span>';
                                    }
                                    ?>
                                </div>
                                <?php if ($item->visibility == 'departments' && $item->visible_to_departments) { 
                                    $visible_departments = json_decode($item->visible_to_departments, true);
                                    if (is_array($visible_departments) && count($visible_departments) > 0) {
                                        $CI = &get_instance();
                                        $CI->load->model('departments_model');
                                        $departments = $CI->departments_model->get();
                                        $dept_names = [];
                                        
                                        foreach ($departments as $dept) {
                                            if (in_array($dept['departmentid'], $visible_departments)) {
                                                $dept_names[] = $dept['name'];
                                            }
                                        }
                                        
                                        if (count($dept_names) > 0) {
                                ?>
                                <div class="mtop5">
                                    <span class="bold"><?php echo _l('visible_to_departments'); ?>:</span>
                                    <?php echo implode(', ', $dept_names); ?>
                                </div>
                                <?php 
                                        }
                                    }
                                } 
                                ?>
                                <?php if ($item->attachment) { ?>
                                <div class="mtop5">
                                    <span class="bold"><?php echo _l('general_attachment'); ?>:</span>
                                    <a href="<?php echo admin_url('my_team/download_knowledge_attachment/' . $item->id); ?>">
                                        <i class="fa fa-paperclip"></i> <?php echo _l('download_attachment'); ?>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="hr-panel-heading" />
                                <div class="knowledge-content mtop15">
                                    <?php echo $item->content; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?> 