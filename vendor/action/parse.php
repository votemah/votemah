<?
set_time_limit(0);
ini_set('memory_limit', -1);

require './../../libs/autoload.php';
require 'function.php';

use \GuzzleHttp\Client;
use \DiDom\Document;

$client = new Client();
$document = new Document();

$url = 'https://yandex.ru/pogoda/?via=hl';

$html = get_html($url, $client);
$document->loadHtml($html);
sleep(rand(1, 3));

$days_data = get_days($document, $client);

// СОХРАНЕНИЕ JSON
chmod('./../../assets/data/weather.json', 0755);
file_put_contents(
  './../../assets/data/weather.json', json_encode($days_data, JSON_UNESCAPED_UNICODE)
);
// ОТПРАВКА JSON-ОТВЕТА
header('Content-type: application/json');
echo json_encode($days_data, JSON_UNESCAPED_UNICODE);
