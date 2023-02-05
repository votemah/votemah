<?
set_time_limit(0);
ini_set('memory_limit', -1);

require '../autoload.php';
require 'function.php';

use \GuzzleHttp\Client;
use \DiDom\Document;

$client = new Client();
$document = new Document();

$url = 'https://superliga.rfs.ru';

$html = get_html($url, $client);
$document->loadHtml($html);
sleep(rand(1, 3));

$team_data = get_team($document, $client);

//СОХРАНЕНИЕ JSON

file_put_contents(
  '../../assets/data/team.json', json_encode($team_data, JSON_UNESCAPED_UNICODE)
);
// ОТПРАВКА JSON-ОТВЕТА
header('Content-type: application/json');
echo json_encode($team_data, JSON_UNESCAPED_UNICODE);
