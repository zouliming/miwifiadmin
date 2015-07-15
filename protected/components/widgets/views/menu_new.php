<div class="sidebar">
    <ul>
        <?php
        $navCur = "";
        foreach ($this->menuConfig as $key => $info) {
                if ($navCur == "" && $info['url'] == $url) {
                        $navCur = $info['class'];
                }
                ?>
                <li class="<?php echo $info['class']; ?>">
                    <a href="<?php echo $info['url']; ?>">
                        <span><?php echo $info['title']; ?></span>
                    </a>
                </li>
        <?php } ?>
    </ul>
</div>
<script type="text/javascript">
        var navCurrent = '.<?php echo $navCur; ?>';
</script>