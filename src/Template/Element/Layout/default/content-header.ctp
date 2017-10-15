<section class="content-header">
    <h1>
    <?php 
        $title = $this->ContentHeader->title('h1');
        if ($title !== null) {
            echo $title;
        }
    ?>
    </h1>
</section>