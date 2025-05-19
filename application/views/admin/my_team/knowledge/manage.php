<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="no-margin"><?php echo _l('knowledge_items'); ?></h4>
                            </div>
                            <?php if (has_permission('my_team', '', 'create') || is_admin()) { ?>
                            <div class="col-md-6 text-right">
                                <a href="<?php echo admin_url('my_team/add_knowledge_item'); ?>" class="btn btn-info">
                                    <i class="fa fa-plus"></i> <?php echo _l('add_knowledge_item'); ?>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (!empty($knowledge_items)) { ?>
                                <div class="table-responsive">
                                    <table class="table dt-table">
                                        <thead>
                                            <tr>
                                                <th><?php echo _l('knowledge_base_article_title'); ?></th>
                                                <?php if ($is_manager) { ?>
                                                <th><?php echo _l('date_created'); ?></th>
                                                <?php } else { ?>
                                                <th><?php echo _l('manager'); ?></th>
                                                <th><?php echo _l('read_status'); ?></th>
                                                <?php } ?>
                                                <th><?php echo _l('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($knowledge_items as $item) { ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo admin_url('my_team/view_knowledge_item/' . $item['id']); ?>">
                                                        <?php echo $item['title']; ?>
                                                    </a>
                                                </td>
                                                <?php if ($is_manager) { ?>
                                                <td><?php echo _dt($item['date_created']); ?></td>
                                                <?php } else { ?>
                                                <td><?php echo $item['manager_name']; ?></td>
                                                <td>
                                                    <?php if (isset($item['is_read']) && $item['is_read'] == 1) { ?>
                                                    <span class="label label-success"><?php echo _l('read'); ?></span>
                                                    <span class="text-muted"><?php echo _dt($item['date_read']); ?></span>
                                                    <?php } else { ?>
                                                    <span class="label label-warning"><?php echo _l('unread'); ?></span>
                                                    <?php } ?>
                                                </td>
                                                <?php } ?>
                                                <td>
                                                    <a href="<?php echo admin_url('my_team/view_knowledge_item/' . $item['id']); ?>" class="btn btn-default btn-icon">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <?php if ($is_manager || is_admin()) { ?>
                                                    <a href="<?php echo admin_url('my_team/edit_knowledge_item/' . $item['id']); ?>" class="btn btn-default btn-icon">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                    <a href="<?php echo admin_url('my_team/delete_knowledge_item/' . $item['id']); ?>" class="btn btn-danger btn-icon _delete">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } else { ?>
                                <div class="alert alert-info">
                                    <?php echo _l('no_knowledge_items_found'); ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
$(function() {
    initDataTable('.table-knowledge-items', window.location.href);
});
</script>
</body>
</html> 