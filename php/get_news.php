<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

require "simple_html_dom.php";

$html_vnex = file_get_html("https://vnexpress.net/");
$headlineTitles = $html_vnex->find('div[class=thumb_big] img' , 0)->alt;
$headlineLinks = $html_vnex->find('div[class=thumb_big] a' , 0)->href;

$newsList = $html_vnex->find('section[class=sidebar_home_1] article[data-campaign=ThuongVien] p[class=description] a');
$urls = [];
foreach ($newsList as $news) {
    $urls[] = [
        'title' =>  $news->title,
        'link' => $news->href
    ];
}
echo json_encode($urls, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);