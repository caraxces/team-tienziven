<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div id="vueApp">
            <div class="row">
                <div class="col-md-12">
                    <div class="tw-block md:tw-hidden">
                        <?php $this->load->view('admin/projects/stats'); ?>
                    </div>
                    <div class="_buttons">
                        <div class="md:tw-flex md:tw-items-center">
                            <?php if (staff_can('create', 'projects')) { ?>
                            <a href="<?= admin_url('projects/project'); ?>"
                                class="btn btn-primary pull-left display-block mright5">
                                <i class="fa-regular fa-plus tw-mr-1"></i>
                                <?= _l('new_project'); ?>
                            </a>
                            <button id="btn_import_csv" class="btn btn-success pull-left display-block mright5">
                                <i class="fa fa-file-csv tw-mr-1"></i>
                                <?= _l('import_csv'); ?>
                            </button>
                            <button id="btn_download_sample" class="btn btn-info pull-left display-block mright5">
                                <i class="fa fa-download tw-mr-1"></i>
                                <?= _l('download_sample'); ?>
                            </button>
                            <?php } ?>
                            <a href="<?= admin_url('projects/gantt'); ?>"
                                data-toggle="tooltip"
                                data-title="<?= _l('project_gant'); ?>"
                                class="btn btn-default btn-with-tooltip sm:!tw-px-3">
                                <i class="fa fa-align-left" aria-hidden="true"></i>
                            </a>
                            <div class="tw-hidden md:tw-block md:tw-ml-6 rtl:md:tw-mr-6">
                                <?php $this->load->view('admin/projects/stats'); ?>
                            </div>
                            <div class="ltr:tw-ml-auto rtl:tw-mr-auto">
                                <app-filters
                                    id="<?= $table->id(); ?>"
                                    view="<?= $table->viewName(); ?>"
                                    :rules="extra.projectsRules || <?= app\services\utilities\Js::from($this->input->get('status') ? $table->findRule('status')->setValue([(int) $this->input->get('status')]) : []); ?>"
                                    :saved-filters="<?= $table->filtersJs(); ?>"
                                    :available-rules="<?= $table->rulesJs(); ?>">
                                </app-filters>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel_s tw-mt-2">
                        <div class="panel-body">
                            <div class="panel-table-full">
                                <?= form_hidden('custom_view'); ?>
                                <?php $this->load->view('admin/projects/table_html'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/projects/copy_settings'); ?>

<!-- CSV Import Modal -->
<div class="modal fade" id="csvImportModal" tabindex="-1" role="dialog" aria-labelledby="csvImportModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="csvImportModalLabel"><?= _l('import_projects_from_csv'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <strong><?= _l('import_instructions'); ?></strong>
                            <ol>
                                <li><?= _l('download_sample_first'); ?></li>
                                <li><?= _l('fill_required_fields'); ?></li>
                                <li><?= _l('make_sure_format_correct'); ?></li>
                                <li><?= _l('save_as_csv_utf8'); ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <?php echo form_open_multipart(admin_url('projects/import_csv'), ['id' => 'csv-import-form']); ?>
                
                <div class="form-group">
                    <label for="csv_file" class="control-label"><?= _l('choose_csv_file'); ?></label>
                    <input type="file" name="csv_file" id="csv_file" class="form-control" required accept=".csv">
                    <small class="text-muted"><?= _l('max_file_size_3mb'); ?></small>
                </div>
                
                <div class="form-group">
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" name="has_header" id="has_header" checked>
                        <label for="has_header"><?= _l('csv_file_has_header_row'); ?></label>
                    </div>
                    <small class="text-muted"><?= _l('first_row_column_names'); ?></small>
                </div>
                
                <div class="form-group">
                    <label><strong><?= _l('required_fields'); ?></strong></label>
                    <ul>
                        <li><code>name</code> - <?= _l('project_name_field'); ?></li>
                        <li><code>clientid</code> - <?= _l('client_id_field'); ?></li>
                    </ul>
                </div>
                
                <div class="form-group">
                    <label><strong><?= _l('other_important_fields'); ?></strong></label>
                    <ul>
                        <li><code>start_date</code> - <?= _l('format_yyyy_mm_dd'); ?> (e.g., 2023-10-01)</li>
                        <li><code>deadline</code> - <?= _l('format_yyyy_mm_dd'); ?> (e.g., 2023-12-31)</li>
                        <li><code>status</code> - 1=<?= _l('project_status_1'); ?>, 2=<?= _l('project_status_2'); ?>, 3=<?= _l('project_status_3'); ?>, 4=<?= _l('project_status_4'); ?>, 5=<?= _l('project_status_5'); ?></li>
                        <li><code>billing_type</code> - fixed_rate <?= _l('or'); ?> hourly_rate</li>
                    </ul>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" id="modal_btn_download_sample" class="btn btn-info btn-block">
                            <i class="fa fa-download"></i> <?= _l('download_sample'); ?>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-upload"></i> <?= _l('import'); ?>
                        </button>
                    </div>
                </div>
                
                <?php echo form_close(); ?>
                
                <div class="csv-upload-results hide mtop15">
                    <div class="panel_s">
                        <div class="panel-heading">
                            <h4 class="panel-title"><?= _l('import_results'); ?></h4>
                        </div>
                        <div class="panel-body">
                            <div class="result-success alert alert-success hide"></div>
                            <div class="result-error alert alert-danger hide"></div>
                            <div class="result-warning alert alert-warning hide"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered import-results-table hide">
                                    <thead>
                                        <tr>
                                            <th><?= _l('project_name'); ?></th>
                                            <th><?= _l('import_status'); ?></th>
                                            <th><?= _l('error_details'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="debug-info hide mtop15">
                                <div class="panel_s">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><?= _l('debug_info'); ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <pre id="debug-output" style="max-height: 300px; overflow: auto;"></pre>
                                    </div>
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
        initDataTable('.table-projects', admin_url + 'projects/table', undefined, undefined, {},
            <?= hooks()->apply_filters('projects_table_default_order', json_encode([5, 'asc'])); ?>
        );

        init_ajax_search('customer', '#clientid_copy_project.ajax-search');
        
        // CSV Import Modal
        $('#btn_import_csv').on('click', function() {
            $('#csvImportModal').modal('show');
        });
        
        // Handle Sample Template Download (from modal)
        $('#modal_btn_download_sample').on('click', function() {
            window.location.href = admin_url + 'projects/download_import_sample';
        });
        
        // Handle Sample Template Download (main button)
        $('#btn_download_sample').on('click', function() {
            window.location.href = admin_url + 'projects/download_import_sample';
        });
        
        // Handle CSV Import Form Submit
        $('#csv-import-form').on('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            var $form = $(this);
            var $resultsContainer = $('.csv-upload-results');
            var $successResult = $resultsContainer.find('.result-success');
            var $errorResult = $resultsContainer.find('.result-error');
            var $warningResult = $resultsContainer.find('.result-warning');
            var $resultsTable = $resultsContainer.find('.import-results-table');
            var $resultsTableBody = $resultsTable.find('tbody');
            var $debugInfo = $resultsContainer.find('.debug-info');
            var $debugOutput = $debugInfo.find('#debug-output');
            
            $successResult.addClass('hide').html('');
            $errorResult.addClass('hide').html('');
            $warningResult.addClass('hide').html('');
            $resultsTable.addClass('hide');
            $resultsTableBody.html('');
            $debugInfo.addClass('hide');
            $debugOutput.html('');
            
            $form.find('button[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> ' + "<?= _l('importing'); ?>");
            
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $form.find('button[type="submit"]').prop('disabled', false).html('<i class="fa fa-upload"></i> ' + "<?= _l('import'); ?>");
                    
                    if (response) {
                        $resultsContainer.removeClass('hide');
                        
                        if (response.success) {
                            $successResult.removeClass('hide').html(response.success);
                        }
                        
                        if (response.error) {
                            $errorResult.removeClass('hide').html(response.error);
                        }
                        
                        if (response.warning) {
                            $warningResult.removeClass('hide').html(response.warning);
                        }
                        
                        if (response.results && response.results.length > 0) {
                            $resultsTable.removeClass('hide');
                            
                            $.each(response.results, function(i, item) {
                                var statusClass = item.success ? 'success' : 'danger';
                                var statusText = item.success ? "<?= _l('imported'); ?>" : "<?= _l('not_imported'); ?>";
                                
                                $resultsTableBody.append(
                                    '<tr>' +
                                    '<td>' + item.name + '</td>' +
                                    '<td><span class="label label-' + statusClass + '">' + statusText + '</span></td>' +
                                    '<td>' + (item.error || '') + '</td>' +
                                    '</tr>'
                                );
                            });
                        }
                        
                        // Show debugging information if available
                        if (response.debug_info) {
                            $debugInfo.removeClass('hide');
                            $debugOutput.html(JSON.stringify(response.debug_info, null, 2));
                        }
                        
                        // If import was successful, refresh the projects table
                        if (response.success && !response.error) {
                            setTimeout(function() {
                                $('.table-projects').DataTable().ajax.reload(null, false);
                            }, 3000);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    $form.find('button[type="submit"]').prop('disabled', false).html('<i class="fa fa-upload"></i> ' + "<?= _l('import'); ?>");
                    $resultsContainer.removeClass('hide');
                    $errorResult.removeClass('hide').html('<?= _l('error_occurred'); ?>: ' + error);
                }
            });
        });
    });
</script>
</body>

</html>