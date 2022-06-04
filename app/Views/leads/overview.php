<div id="page-content" class="page-wrapper clearfix">
    <ul class="nav nav-tabs bg-white title" role="tablist">
        <li class="title-tab">
            <h4 class="pl15 pt10 pr15"><?php echo app_lang("leads"); ?></h4>
        </li>

        <?php echo view("leads/tabs", array("active_tab" => "leads_overview")); ?>

        <div class="tab-title clearfix no-border">
            <div class="title-button-group">
                <?php echo modal_anchor(get_uri("leads/import_leads_modal_form"), "<i data-feather='upload' class='icon-16'></i> " . app_lang('import_leads'), array("class" => "btn btn-default", "title" => app_lang('import_leads'))); ?>
                <?php echo modal_anchor(get_uri("leads/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_lead'), array("class" => "btn btn-default", "title" => app_lang('add_lead'))); ?>
            </div>
        </div>
    </ul>

    <div class="row mt20">
        <?php
                $leads = [
                    [
                        "title" => "total_leads",
                        "icon" => "users",
                        "color" => "primary",
                        "value" => $total_lead,
                    ],
                    [
                        "title" => "leads_progress",
                        "icon" => "clock",
                        "color" => "warning",
                        "value" => $progress_lead,
                    ],
                    [
                        "title" => "total_leads_converted",
                        "icon" => "check-circle",
                        "color" => "green",
                        "value" => $convert_lead,
                    ],
                    [
                        "title" => "total_leads_lost",
                        "icon" => "x-circle",
                        "color" => "danger",
                        "value" => $lost_lead,
                    ]
                ];
                foreach ($leads as $lead) {
            ?>
        <div class="col-md-3 widget-container">
            <div class="card dashboard-icon-widget">
                <div class="card-body">
                    <div class="widget-icon bg-<?= $lead['color'] ?>">
                        <i data-feather='<?= $lead['icon'] ?>' class='icon'></i>
                    </div>
                    <div class="widget-details">
                        <h1>
                            <?= $lead['value'] ?>
                        </h1>
                        <span><?php echo app_lang($lead['title']); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>