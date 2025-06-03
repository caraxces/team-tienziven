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
                                <h4 class="no-margin"><?php echo _l('team_knowledge'); ?></h4>
                            </div>
                            <?php if (has_permission('my_team', '', 'create') || is_admin()) { ?>
                            <div class="col-md-4 text-right">
                                <a href="<?php echo admin_url('my_team/knowledge_item'); ?>" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> <?php echo _l('knowledge_add_article'); ?>
                                </a>
                                <a href="<?php echo admin_url('my_team/knowledge_categories'); ?>" class="btn btn-info mright5">
                                    <i class="fa fa-tag"></i> <?php echo _l('knowledge_categories'); ?>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Filter and search options -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select id="category_filter" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('knowledge_filter_by_category'); ?>">
                                        <option value=""><?php echo _l('knowledge_all_articles'); ?></option>
                                        <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" id="knowledge_search" class="form-control" placeholder="<?php echo _l('knowledge_search_articles'); ?>">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clearfix mtop15"></div>
                        
                        <!-- Knowledge items list -->
                        <div class="row">
                            <div class="col-md-12">
                                <div id="knowledge_items_container">
                                    <?php if (count($knowledge_items) > 0) { ?>
                                        <?php foreach ($knowledge_items as $item) { ?>
                                        <div class="knowledge-item" data-category="<?php echo $item['category_id']; ?>">
                                            <div class="knowledge-item-header">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h4 class="knowledge-item-title">
                                                            <a href="<?php echo admin_url('my_team/view_knowledge/' . $item['id']); ?>">
                                                                <?php echo $item['subject']; ?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <?php if ($item['category_id']) { 
                                                            $category = get_knowledge_category($item['category_id']);
                                                            if ($category) {
                                                        ?>
                                                        <span class="knowledge-category-badge">
                                                            <?php echo $category->name; ?>
                                                        </span>
                                                        <?php } } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="knowledge-item-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="text-muted">
                                                            <?php 
                                                            // Giới hạn nội dung hiển thị
                                                            $description = strip_tags($item['description']);
                                                            echo strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description; 
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="knowledge-item-footer">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <?php 
                                                        // Hiển thị thông tin về người tạo
                                                        $this->load->model('staff_model');
                                                        $creator = $this->staff_model->get($item['created_by']);
                                                        if ($creator) {
                                                            echo _l('knowledge_created_by') . ' ' . $creator->firstname . ' ' . $creator->lastname . ' - ' . time_ago($item['created_at']);
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <?php if ($item['attachment']) { ?>
                                                        <span class="text-muted mright5"><i class="fa fa-paperclip"></i></span>
                                                        <?php } ?>
                                                        
                                                        <a href="<?php echo admin_url('my_team/view_knowledge/' . $item['id']); ?>" class="btn btn-xs btn-info">
                                                            <?php echo _l('view'); ?>
                                                        </a>
                                                        
                                                        <?php if (has_permission('my_team', '', 'edit') || $item['created_by'] == get_staff_user_id() || is_admin()) { ?>
                                                        <a href="<?php echo admin_url('my_team/knowledge_item/' . $item['id']); ?>" class="btn btn-xs btn-default">
                                                            <?php echo _l('edit'); ?>
                                                        </a>
                                                        <?php } ?>
                                                        
                                                        <?php if (has_permission('my_team', '', 'delete') || $item['created_by'] == get_staff_user_id() || is_admin()) { ?>
                                                        <a href="<?php echo admin_url('my_team/delete_knowledge/' . $item['id']); ?>" class="btn btn-xs btn-danger _delete">
                                                            <?php echo _l('delete'); ?>
                                                        </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="text-center mtop30">
                                            <i class="fa fa-book fa-5x text-muted"></i>
                                            <h4 class="text-muted mtop15"><?php echo _l('knowledge_no_articles'); ?></h4>
                                            <?php if (has_permission('my_team', '', 'create') || is_admin()) { ?>
                                            <a href="<?php echo admin_url('my_team/knowledge_item'); ?>" class="btn btn-info mtop15">
                                                <i class="fa fa-plus"></i> <?php echo _l('knowledge_add_article'); ?>
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
    
    // Category filter
    $('#category_filter').on('change', function() {
        var categoryId = $(this).val();
        
        if (categoryId === '') {
            $('.knowledge-item').show();
        } else {
            $('.knowledge-item').hide();
            $('.knowledge-item[data-category="' + categoryId + '"]').show();
        }
    });
    
    // Search functionality
    $('#knowledge_search').on('keyup', function() {
        var search = $(this).val().toLowerCase();
        
        $('.knowledge-item').each(function() {
            var content = $(this).text().toLowerCase();
            $(this).toggle(content.indexOf(search) > -1);
        });
    });
});

/**
 * Get Knowledge Category
 * @param {int} id 
 * @return {object}
 */
function get_knowledge_category(id) {
    var categories = <?php echo json_encode($categories); ?>;
    for (var i = 0; i < categories.length; i++) {
        if (categories[i].id == id) {
            return categories[i];
        }
    }
    return null;
}
</script> 