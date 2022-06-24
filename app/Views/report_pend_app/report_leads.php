<div id="page-content" class="page-wrapper clearfix">
    <div class="clearfix"> 

        <ul id="client-tabs" data-bs-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
            <li><a role="presentation" href="<?php echo_uri("reports/pending_reports_list/"); ?>"
                    data-bs-target="#pending_reports_list"><?php echo app_lang('report'); ?>|<?php echo app_lang('pending_reports'); ?></a></li>
        </ul>
        <div class="tab-content">
            <!-- <div role="tabpanel" class="tab-pane fade active" id="overview">
                <?php //echo view("reports/overview/index"); ?>
            </div> -->

            <div role="tabpanel" class="tab-pane fade" id="pending_reports_list"></div>
            <!-- <div role="tabpanel" class="tab-pane fade" id="contacts"></div> -->
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        var tab = "<?php echo $tab; ?>";
        if (tab === "pending_reports_list" || tab === "clients_list-has_open_projects") {
            $("[data-bs-target='#pending_reports_list']").trigger("click");

            window.selectedClientQuickFilter = window.location.hash.substring(1);
        } else if (tab === "contacts") {
            $("[data-bs-target='#contacts']").trigger("click");

            window.selectedContactQuickFilter = window.location.hash.substring(1);
        }
    }, 210);
});
</script>