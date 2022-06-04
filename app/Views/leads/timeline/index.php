
<div class="row mt20" style="max-height:380px; overflow-y:auto;">
    <?php
        foreach($timelines as $timeline){
    ?>
    <div class="col-md-12">
        <div class="card">
            <div class="d-flex border-bottom mb-3">
                <div class="flex-shrink-0 ms-2 me-2 mt-3">
                    <span class="avatar avatar-xs">
                        <img src="<?=base_url();?>/assets/images/avatar.jpg">
                    </span>
                </div>
                <div class="p-2 w-100">
                    <div class="card-title">
                        <a href="javascript:void(0);" class="dark strong">
                            <?=$timeline['agent'];?>
                        </a>
                        <small>
                            <span class="text-off"><?=$timeline['date'];?>
                            </span>
                        </small>
                    </div>
                    <p>
                        <span class="badge <?php 
                            if($timeline['type'] == "add"){
                            echo "badge-info";
                            }else if($timeline['type'] == "update"){
                            echo "badge-warning";
                            }else if($timeline['type'] == "convert"){
                            echo "badge-success";
                            }
                        ?>"><?=$timeline['title'];?></span>
                    </p>
                    <p>
                        <?=$timeline['description'];?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>