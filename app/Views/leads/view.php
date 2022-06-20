<div class="page-title clearfix no-border no-border-top-radius no-bg">
    <h1>
        <?php echo app_lang('lead_details') . " - " . $lead_info->company_name ?>
    </h1>
</div>

<div id="page-content" class="clearfix page-wrapper">
    <ul data-bs-toggle="ajax-tab" class="nav nav-tabs scrollable-tabs no-border-top-radius" role="tablist">
        <li>
            <a role="presentation" href="<?php echo_uri("leads/company_info_tab/" . $lead_info->id); ?>"
                data-bs-target="#lead-info"> <?php echo app_lang('overview'); ?>
            </a>
        </li>
        <li>
            <a role="presentation" href="<?php echo_uri("leads/timeline/" . $lead_info->id); ?>"
                data-bs-target="#lead-timeline">
                <?php echo app_lang('lead'); ?> <?php echo app_lang('timeline'); ?>
            </a>
        </li>   
        <li>
            <a role="presentation" href="<?php echo_uri("leads/notes/" . $lead_info->id); ?>"
                data-bs-target="#lead-notes">
                <?php echo app_lang('comments'); ?>
            </a>
        </li>
        <li>
            <a role="presentation" href="<?php echo_uri("leads/literature/" . $lead_info->id); ?>"
                data-bs-target="#lead-literature">
                <?php echo app_lang('product_literature'); ?>
            </a>
        </li>
        <li>
            <a role="presentation" href="<?php echo_uri("leads/assessment/" . $lead_info->id); ?>"
                data-bs-target="#lead-assessment">
                <?php echo app_lang('assessment'); ?>
            </a>
        </li>
        <li>
            <a role="presentation" href="<?php echo_uri("leads/quotation/" . $lead_info->id); ?>"
                data-bs-target="#lead-quotation">
                <?php echo app_lang('quotation'); ?>
            </a>
        </li>

        <?php
        $hook_tabs = app_hooks()->apply_filters('app_filter_lead_details_ajax_tab', $lead_info->id);
        $hook_tabs = is_array($hook_tabs) ? $hook_tabs : array();
        foreach ($hook_tabs as $hook_tab) {
            ?>
        <li><a role="presentation" href="<?php echo get_array_value($hook_tab, 'url') ?>"
                data-bs-target="#<?php echo get_array_value($hook_tab, 'target') ?>"><?php echo get_array_value($hook_tab, 'title') ?></a>
        </li>
        <?php
        }
        ?>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade" id="lead-info"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-timeline"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-notes"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-literature"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-assessment"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-quotation"></div>
        <!-- <div role="tabpanel" class="tab-pane fade" id="lead-projects"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-files"></div> -->
        <!-- <div role="tabpanel" class="tab-pane fade" id="lead-contacts"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-estimates"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-proposals"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-estimate-requests"></div>
        <div role="tabpanel" class="tab-pane fade" id="lead-tickets"></div> -->
        <!-- <div role="tabpanel" class="tab-pane" id="lead-events" style="min-height: 300px"></div> -->
        <?php foreach ($hook_tabs as $hook_tab) { ?>
        <div role="tabpanel" class="tab-pane fade" id="<?php echo get_array_value($hook_tab, 'target') ?>"></div>
        <?php } ?>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    var tab = "<?php echo $tab; ?>";
    if (tab === "info") {
        $("[data-bs-target='#lead-info']").trigger("click");
    }

});
</script>