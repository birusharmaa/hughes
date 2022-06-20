
<div class="row mt20" style="max-height:380px; overflow-y:auto;">
    <div class="col-md-12">
        <div class="card">
            <div class="d-flex border-bottom mb-3">
                <div class="flex-shrink-0 ms-2 me-2 mt-3">
                    <span class="avatar avatar-xs">
                        <img src="<?= base_url(); ?>/assets/images/avatar.jpg">
                    </span>
                </div>
                <div class="p-2 w-100">
                    <div class="card-title">
                        <a href="javascript:void(0);" class="dark strong">
                            <?= $timelines[0]['first_name']; ?>
                        </a>
                        <small>
                                <span class="text-off"><?= $timelines[0]['created_date']; ?>
                                </span>
                            </small>

                    </div>
                    <p>
                        <?= $timelines[0]['name_of_contact_person']; ?>
                        
                    </p>
                    <p>
                        <span class="badge badge-success">New Lead Created</span>
                    </p>

                </div>
            </div>
        </div>
    </div>



    <?php
    foreach ($timelines as $timeline) {
    ?>
        <div class="col-md-12">
            <div class="card">
                <div class="d-flex border-bottom mb-3">
                    <div class="flex-shrink-0 ms-2 me-2 mt-3">
                        <span class="avatar avatar-xs">
                            <img src="<?= base_url(); ?>/assets/images/avatar.jpg">
                        </span>
                    </div>
                    <div class="p-2 w-100">
                        <div class="card-title">
                            <a href="javascript:void(0);" class="dark strong">
                                <?= $timeline['first_name']; ?>

                            </a>
                            <small>
                                <span class="text-off"><?= $timeline['change_date_time']; ?>
                                </span>
                            </small>

                        </div>
                        <p>
                            <?= $timeline['page']; ?>
                        </p>
                        <p>
                            <?= $timeline['log_type']; ?>
                            <span class="badge <?php
                                                if ($timeline['status'] == "Created") {
                                                    echo "badge-success";
                                                } else if ($timeline['status'] == "Assessment Sent") {
                                                    echo "badge-success";
                                                } else if ($timeline['status'] == "Literature Sent") {
                                                    echo "badge-success";
                                                } else if ($timeline['status'] == "Quotation Sent") {
                                                    echo "badge-success";
                                                } else if ($timeline['status'] == "Updated") {
                                                    echo "badge-warning";
                                                } else if ($timeline['status'] == "deleted") {
                                                    echo "badge-danger";
                                                }
                                                ?>"><?= $timeline['status']; ?></span>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>