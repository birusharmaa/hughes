<div class="card">
    <div class="tab-title clearfix">
        <h4><?php echo app_lang('literature'); ?></h4>
        <div class="title-button-group">
            <?php echo modal_anchor(get_uri("leads/literature_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_literature'), array("class" => "btn btn-default", "title" => app_lang('add_literature'), "data-post-client_id" => $client_id)); ?>
        </div>
    </div>
    <!-- <div class="table-responsive">
        <table id="lead-table" class="display" cellspacing="0" width="100%">
        </table>
    </div> -->
</div>