<div id="sidebar" class="sidebar sidebar-grid -sidebar-transparent">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="<?php echo base_url("assets/img/gear-user.png"); ?>"></a>
                </div>
                <div class="info">
                    <?php echo $this->session->userdata("name"); ?>
                    <small><?php echo ucwords($this->session->userdata("acc_level")); ?></small>
                </div>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-header">Navigation Menu</li>
            <?php $menu = json_decode(file_get_contents($this->config->item("folder_secret", "my_config").$this->config->item("menu", "my_config")), TRUE); ?>
            <?php foreach ($menu as $key){ ?>
            <?php if(in_array(strtolower($this->session->userdata("acc_level")), explode("|", $key["roles"]))){ ?>
            <?php if(count($key["sub_menu"]) > 0){ ?>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="<?php echo $key["icon"]; ?>"></i>
                    <span><?php echo $key["title"]; ?></span>
                </a>
                <ul class="sub-menu">
                <?php foreach ($key["sub_menu"] as $key2){ ?>
                <?php if(in_array(strtolower($this->session->userdata("acc_level")), explode("|", $key2["roles"]))){ ?>
                <?php if(count($key2["sub_menu"]) > 0){ ?>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span><?php echo $key2["title"]; ?></span>
                        </a>
                        <ul class="sub-menu">
                        <?php foreach ($key2["sub_menu"] as $key3){ ?>
                        <?php if(in_array(strtolower($this->session->userdata("acc_level")), explode("|", $key3["roles"]))){ ?>
                            <li>
                                <a href="<?php echo $key3["href"] === "#" ? "#" : (preg_match("/^http.*/", $key3["href"]) ? $key3["href"] : base_url().$key3["href"]); ?>" target="<?php echo $key3["target"]; ?>" class="<?php echo $key3["class"]; ?>">
                                    <span><?php echo $key3["title"]; ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php } ?>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?php echo $key2["href"] === "#" ? "#" : (preg_match("/^http.*/", $key2["href"]) ? $key2["href"] : base_url().$key2["href"]); ?>" target="<?php echo $key2["target"]; ?>" class="<?php echo $key2["class"]; ?>">
                            <span><?php echo $key2["title"]; ?></span>
                        </a>
                    </li>
                <?php } ?>
                <?php } ?>
                <?php } ?>
                </ul>
            </li>
            <?php } else { ?>
            <li>
                <a href="<?php echo $key["href"] === "#" ? "#" : base_url().$key["href"]; ?>" target="<?php echo $key["target"]; ?>" class="<?php echo $key["class"]; ?>">
                    <i class="<?php echo $key["icon"]; ?>"></i>
                    <span><?php echo $key["title"]; ?></span>
                </a>
            </li>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </li>
        </ul>
    </div>
</div>
<div class="sidebar-bg"></div>
