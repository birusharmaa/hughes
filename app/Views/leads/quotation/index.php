<div class="card">
    <div class="tab-title clearfix">
        <h4><?php echo app_lang('quotation'); ?></h4>
        <div class="title-button-group">
            <?php echo modal_anchor(get_uri("leads/quotation_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_quotation'), array("class" => "btn btn-default", "title" => app_lang('add_quotation'), "data-post-client_id" => $client_id)); ?>
        </div>
    </div>
    <!-- <div class="table-responsive">
        <table id="lead-table" class="display" cellspacing="0" width="100%">
        </table>
    </div> -->
</div>