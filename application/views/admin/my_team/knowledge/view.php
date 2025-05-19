<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="no-margin"><?php echo $item->title; ?></h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="<?php echo admin_url('my_team/knowledge'); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('back_to_knowledge_items'); ?>
                                </a>
                                <?php if (!$already_read) { ?>
                                <a href="<?php echo admin_url('my_team/mark_knowledge_read/' . $item->id); ?>" class="btn btn-success">
                                    <i class="fa fa-check"></i> <?php echo _l('mark_as_read'); ?>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <i class="fa fa-user-circle"></i> <?php echo _l('author'); ?>: <?php echo $item->manager_name; ?>
                                            </div>
                                            <div class="pull-right">
                                                <i class="fa fa-calendar"></i> <?php echo _dt($item->date_created); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body tc-content">
                                        <?php echo $item->content; ?>
                                    </div>
                                </div>
                                
                                <?php if ($already_read) { ?>
                                <div class="alert alert-success">
                                    <i class="fa fa-check-circle"></i> <?php echo _l('you_already_read_this_item'); ?> <?php echo _dt($already_read); ?>
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
</body>
</html> 