<?php if($post->title): ?>
<div class="post-title">
    <?php echo $this->getTitleLink($post, $title_css) ?>
</div>
<?php endif; ?>
<?php if($post->content): ?>
<div class="entry-content"><?php echo $post->content ?></div>
<?php endif; ?>