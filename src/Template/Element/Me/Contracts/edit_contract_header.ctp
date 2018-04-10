<?php
    $navigation = [
        ['title' => 'Nhập thông tin', 'active' => null],
        ['title' => 'Kiểm tra', 'active' => null],
    ];
    for ($i = 0; $i <= $stepNo; $i++) {
        $navigation[$i]['active'] = 'active';
    }
?>

<div class="chain-action">
    <ul>
        <?php foreach ($navigation as $item): ?>
            <li style="width: 50%" class="<?= $item['active'] ?>"></li>
        <?php endforeach ?>
    </ul>
</div>