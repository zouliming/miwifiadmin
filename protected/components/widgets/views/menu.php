<div id="nav">
    <div class="list">
        <ul>
            <?php
            $navCur = "";
            foreach($this->menuConfig as $key=>$info){
                    if($navCur=="" && $info['url']==$url){
                            $navCur = $info['class'];
                    }
            ?>
            <li class="<?php echo $info['class'];?>">
                <a href="<?php echo $info['url'];?>">
                    <i class="ico ico-nav-<?php echo $key+1;?>"></i>
                    <span><?php echo $info['title'];?></span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <script type="text/javascript">
            var navCurrent = '.<?php echo $navCur;?>';
    </script>
</div>