<?php
include('../Controller/Main.php');
$main = new Main();
$articles = $main->getArticles();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<div class="tab">
    <button class="tablinks" onclick="tabChange(event, 'Delfi')">Delfi</button>
    <button class="tablinks" onclick="tabChange(event, '15min')">15min</button>
    <div style="float: right;">
        <form target="_top" action="scraper.php">
            <button type="submit">Gauti naujausius straipsnius</button>
        </form>
    </div>
</div>

<div id="Delfi" class="tabcontent">
    <?php foreach($articles AS $key => $article) :
        if($article['website_name'] == 'delfi') {?>
            <div style="display: flex; margin-bottom: 20px;">
                <div>
                    <a style="text-decoration: none; color: black;" target="_blank" href="<?php echo $article['url'];?>">
                        <img src="<?php echo $article['img_url'];?>">
                    </a>
                </div>
                <div style="padding-left: 15px;">
                    <a style="text-decoration: none; color: black;" target="_blank" href="<?php echo $article['url'];?>">
                        <h4 style="margin: 0;">
                            <?php echo $article['title'];?>
                        </h4>
                        <p style="margin: 10px 0 10px 0; font-size: 14px">
                            <?php echo $article['body'];?>
                        </p>
                        <span style="font-size: 14px">
                            Skaitymo laikas: <?php echo $article['reading_time'];?>
                        </span>
                    </a>
                </div>
            </div>
        <?php }
    endforeach; ?>
</div>

<div id="15min" class="tabcontent">
    <?php foreach($articles AS $key => $article) :
        if($article['website_name'] == '15min') {?>
            <div style="display: flex; margin-bottom: 20px;">
                <div>
                    <a style="text-decoration: none; color: black;" target="_blank" href="<?php echo $article['url'];?>">
                        <img style="width: 205px;" src="<?php echo $article['img_url'];?>">
                    </a>
                </div>
                <div style="padding-left: 15px;">
                    <a style="text-decoration: none; color: black;" target="_blank" href="<?php echo $article['url'];?>">
                        <h4 style="margin: 0;">
                            <?php echo $article['title'];?>
                        </h4>
                        <p style="margin: 10px 0 10px 0; font-size: 14px">
                            <?php echo $article['body'];?>
                        </p>
                        <span style="font-size: 14px">
                            Skaitymo laikas: <?php echo $article['reading_time'];?>
                        </span>
                    </a>
                </div>
            </div>
        <?php }
    endforeach; ?>
</div>

<script>
    function tabChange(evt, tab) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tab).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

</body>
</html>
