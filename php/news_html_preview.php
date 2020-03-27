<?php

header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *");
require "simple_html_dom.php";

$html = file_get_html(str_replace("beta.","", $_GET['url']));

$title = $html->find("meta[name=its_title]", 0)->content;
$img = $html->find("meta[name=twitter:image]",0)->content;
$time = $html->find("span[class=time left]",0)->innertext;
$des = $html->find("meta[name=twitter:description]",0)->content;
$des1 = $html->find(" p[class=Normal]",0)->innertext;
$title = str_replace('\\','',$title);

?>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lexend+Deca&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style type="text/css">

    body {
        margin : 0;
    }
    #news{
        width : 98%;
        margin : 0 auto;
        height: auto
    }
    #menu-news{
        float : left;
        width : 40%;
        height : auto;
        padding : 1em;

    }
    .accordion{

        padding : 1em;
        width : 60%;
        float : right ;
        height : auto;
    }
    .card-img-top{
        display: block;
        max-width:550px;
        max-height:350px;
        width: auto;
        height: auto;
    }
    li {
        list-style-type : none;
        font-size : 18px;
    }
    ul {
        font-size : 15px;
    }
    #imgbg{
        background-image: url("bg.png");
    }
    .card-title{
        font-family: Lexend Deca ;
        font-size : 30px;
    }
    .card-text{
        font-family: Roboto ;
        font-size : 20px;
    }

</style>
<section>
    <figure >
        <div class='card' id='card_img' style=' margin: auto;  position: relative;'>
            <img src='logo1.png' style='position:absolute; margin-top : 25px; margin-left:30px ; height : 65px'/>
            <div id='imgbg' style='width: 100%; height: auto; display: flex;'>
                <img class='card-img-top'  style='height: auto; max-width: 100%; margin: auto;' src='<?php echo $img ?>'>
            </div>
            <div class='card-body' id='bg_body'>
                <h5 class='card-title'><?php echo $title ?></h5>
                <p class='card-text' ><?php echo $des ?> <?php echo $des1 ?> </p>
                <p style='font-family: Roboto '><?php echo $time ?> || Đội SVTN khoa Công nghệ Thông Tin</p>
            </div>
        </div>
    </figure>
</section>
