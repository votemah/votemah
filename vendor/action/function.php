<?

use DiDom\Document;
use GuzzleHttp\Client;

function get_html($url, Client $client)
{
  $response = $client->get($url);
  return $response->getBody()->getContents();
}

function get_days(Document $document, Client $client)
{
  $days = $document->find('.forecast-briefly__day');
  for ($i = 0; $i < 10; $i++) {
    //echo 'День ' . $i . PHP_EOL;
    $date[$i] = $days[$i]->first('.time')->text();
    $name[$i] = $days[$i]->first('.forecast-briefly__name')->text();
    $icon_link[$i] = $days[$i]->first('img.icon')->attr('src');
    $temp_day[$i] = $days[$i]->find('.temp .temp__value')[0]->text();
    $temp_night[$i] = $days[$i]->find('.temp .temp__value')[1]->text();
    $array[$i] = [
      'date' => $date[$i],
      'name' => $name[$i],
      'icon_link' => 'https:' . $icon_link[$i],
      'temp_day' => $temp_day[$i],
      'temp_night' => $temp_night[$i],
    ];
  }
  return $array;
}
