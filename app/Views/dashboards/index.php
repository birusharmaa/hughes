<div id="page-content" class="page-wrapper clearfix">

    <?php
    if (count($dashboards)) {
        echo view("dashboards/dashboard_header");
    }

    echo announcements_alert_widget();
    ?>

    <div class="row">
        <?php
        $widget_column = "3"; //default bootstrap column class
        $total_hidden = 0;

        if (!$show_attendance) {
            $total_hidden += 1;
        }

        if (!$show_event) {
            $total_hidden += 1;
        }

        if (!$show_timeline) {
            $total_hidden += 1;
        }

        //set bootstrap class for column
        if ($total_hidden == 1) {
            $widget_column = "4";
        } else if ($total_hidden == 2) {
            $widget_column = "6";
        } else if ($total_hidden == 3) {
            $widget_column = "12";
        }
        ?>

        <!-- 1.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Current Leads</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 2.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Leads in Process</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 3.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Product Literature Sent</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 4.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Assessment Received</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 5.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Quotation Sent</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 6.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Order Received</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 7.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Dispatch Sent</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 8.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Delivery Done</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 9.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Application In Progress</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 10.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Application Completed</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 11.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Payment Due</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- 12.WIDGET -->
        <div class="col-md-3 col-sm-6  widget-container">
            <a href="http://localhost/hughes/projects/all_tasks" class="white-link" >
                <div class="card dashboard-icon-widget">
                    <div class="card-body">
                        <div class="widget-icon bg-info">
                            <i data-feather="list" class="icon"></i>
                        </div>
                        <div class="widget-details">
                            <h1>0</h1>
                            <span>Payment Received</span>
                        </div>
                    </div>
                </div>
            </a> 
        </div>
        <!-- <?php if ($show_attendance) { ?>
            <div class="col-md-<?php echo $widget_column; ?> col-sm-6 widget-container">
                <?php
                echo clock_widget();
                ?>
            </div>
        <?php } ?> -->
        <!-- <div class="col-md-<?php echo $widget_column; ?> col-sm-6  widget-container">
            <?php
            echo my_open_tasks_widget();
            ?> 
        </div>

        <?php if ($show_event) { ?>
            <div class="col-md-<?php echo $widget_column; ?> col-sm-6  widget-container">
                <?php
                echo events_today_widget();
                ?> 
            </div>
        <?php } ?>

        <?php if ($show_timeline) { ?>
            <div class="col-md-<?php echo $widget_column; ?> col-sm-6  widget-container">
                <?php
                echo new_posts_widget();
                ?>  
            </div>
        <?php } ?> -->

    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 widget-container">
                    <?php
                    if ($show_income_vs_expenses) {
                        echo income_vs_expenses_widget();
                    } else {
                        echo my_task_stataus_widget();
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
            <?php if ($show_event) { ?>
                <div class="row">
                    <div class="col-md-12 widget-container">
                        <?php echo events_widget(); ?>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
            <div class="col-md-12 widget-container">
                    <?php echo sticky_note_widget(); ?>
                </div>
            </div>
        </div>
        </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        initScrollbar('#project-timeline-container', {
            setHeight: 965
        });

        //update dashboard link
        $(".dashboard-menu, .dashboard-image").closest("a").attr("href", window.location.href);

    });
</script>    

