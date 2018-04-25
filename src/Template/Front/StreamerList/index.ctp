<style>
.streamer-info{
    max-height: 44px;
    overflow: hidden;
}
</style>
<div class="col-md-10 col-md-offset-1">
    <div class="row m-b-10">
        <a class="btn btn-outline btn-default btn-xs <?=($this->request->getQuery('tag')!=null)?:'btn-danger'?>" href="<?=$this->Url->build(['prefix'=>null,'controller'=>'StreamerList'])?>">Tất cả</a>
        <?php foreach($allTags as $tag):?>
        <a class="btn btn-outline btn-default btn-xs <?=($tag->name!=$this->request->getQuery('tag'))?:'btn-danger'?>" href="<?=$this->Url->build(['prefix'=>null,'controller'=>'StreamerList','?' => ['tag' => $tag->name],])?>"><?=$tag->name?></a>
        <?php endforeach;?>
    </div>
    <div class="row m-b-20">
        <?=$this->Form->create(null, ['type' => 'get']);?>
        <div class="input-group col-sm-4">
            <input type="text" name="nickname" class="form-control" placeholder="Nhập tên cần tìm vào đây">         
            <div class="input-group-btn">
                <button type="submit" class="btn waves-effect waves-light btn-info">Tìm</button>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <div class="row">
        <?php foreach($profiles as $profile):?>
        <div class="col-md-4 col-sm-4 m-b-40">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                <a href="<?=$this->Url->build(['prefix'=>null,'controller'=>'donate',$profile->user_id])?>"><img src="/img/default_avatar.jpg" alt="user" class="img-circle img-responsive"></a>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <h3 class="box-title m-b-0"><a href="<?=$this->Url->build(['prefix'=>null,'controller'=>'donate',$profile->user_id])?>"><?= h($profile->nickname ?: 'Chưa thiết lập nickname')?></a></h3> 
                    <p class="streamer-info">
                        <?php foreach($profile->social_providers as $social_provider){
                            if($social_provider->_joinData->public){?>
                                <a href="<?=h($social_provider->_joinData->reference)?>" alt="<?=$social_provider->name?>"><?=$social_provider->name?></a>
                            <?php }
                        }?>
                    </p>
                    <p>
                        <?php foreach ($profile->caster_tags as $caster_tag):?>
                        <a class="btn btn-outline btn-default btn-xs" href="<?=$this->Url->build(['prefix'=>null,'controller'=>'StreamerList','?' => ['tag' => $tag->name],])?>"><?=$caster_tag->name?></a>
                        <?php endforeach;?>
                    </p>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <ul class="pagination m-b-0 m-t-0 pull-right">
        <?php echo $this->Paginator->numbers();?>
    </ul>
</div>