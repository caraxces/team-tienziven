<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('add_knowledge_item'); ?></h4>
                        <hr class="hr-panel-heading" />
                        
                        <?php echo form_open(admin_url('my_team/add_knowledge_item')); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title"><?php echo _l('knowledge_base_article_title'); ?> *</label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="content"><?php echo _l('knowledge_base_article_content'); ?> *</label>
                                    <?php echo render_textarea('content', '', '', [], [], '', 'tinymce'); ?>
                                </div>
                                <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
                                <a href="<?php echo admin_url('my_team/knowledge'); ?>" class="btn btn-default pull-left"><?php echo _l('cancel'); ?></a>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
$(function() {
    appValidateForm($('form'), {
        title: 'required',
        content: 'required'
    });
});
</script>
</body>
</html> 