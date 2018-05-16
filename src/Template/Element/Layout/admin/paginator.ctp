<?php if ($this->Paginator->counter('{{count}}') > 0): ?>
    <div><?= $this->Paginator->counter(__('<strong>{{start}}-{{end}}</strong> ({{count}} kết quả)'))?></div>
    <?php if ($this->Paginator->counter('{{pages}}') > 1): ?>
        <ul class="pagination m-b-0 m-t-0">
            <?php 
                echo $this->Paginator->first('«');
                echo $this->Paginator->prev('‹');
                echo $this->Paginator->numbers(['modulus' => 6]);
                echo $this->Paginator->next('›');
                echo $this->Paginator->last('»');
            ?>
        </ul>
    <?php endif ?>
<?php endif ?>