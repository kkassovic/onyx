<div class="pure-g">
<div class="pure-u-1 pure-u-md-1-2">
        <h2><?php if (isset($header)) {echo $header;} else {echo "Chýba header";}?></h2>
        <?php if (isset($description)) {echo $description;} else {echo "";}?>
    </div>
    <div class="pure-u-1 pure-u-md-1-2">
        <br>
        <img class="pure-img" src="<?php if (isset ($image)) echo $image;?>">
    </div>
</div>