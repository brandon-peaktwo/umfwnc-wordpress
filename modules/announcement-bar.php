<?php
$show_announcement_bar = get_field("show_announcement_bar");
$announcement_bar_content = get_field("announcement_bar_content");
$announcement_bar_cta = get_field("announcement_bar_cta");

if($show_announcement_bar && $announcement_bar_content) :
?>

        <div id="top-announcement-bar" class="<?= $show_announcement_bar ? "active" : null; ?>">
            <div class="container">
                <div class="columns">
                    <div class="column content-side">
                        <div class="wysiwyg">
                            <div class="content"><?= $announcement_bar_content; ?></div>
                        </div>
                    </div>
                    <div class="column btn-side">
                        <a class="banner-btn" href="<?= $announcement_bar_cta['url']; ?>"><?= $announcement_bar_cta['title']; ?></a>
                    </div>
                </div>
            </div>
        </div>


<?php endif; ?>