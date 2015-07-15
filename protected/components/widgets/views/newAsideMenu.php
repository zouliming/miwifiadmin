<div class="asidebar">
    <ul>
            <?php foreach ($menu as $k => $v) { ?>
                <li class="">
                    <a href="#!<?php echo $k; ?>">
                        <span><?php echo $v['label']; ?></span>
                    </a>
                </li>
        <?php } ?>
    </ul>
</div>