<?

use DiDom\Document;
use GuzzleHttp\Client;

function get_html($url, Client $client)
{
  $response = $client->get($url);
  return $response->getBody()->getContents();
}

function get_team(Document $document, Client $client)
{
  global $url;
  $table_row = $document->find('#tournaments-tables-table-0 .custom-table__row');
  for ($i = 0; $i < count($table_row); $i++) {
    //sleep(rand(1, 3));
    //echo 'Команда ' . $i . PHP_EOL;
    $id[$i] = trim($table_row[$i]->first('.custom-table__number')->text());
    $icon_link[$i] = trim($table_row[$i]->first('img.custom-table__img')->attr('src'));
    $team_name[$i] = trim($table_row[$i]->first('.custom-table__team-name')->text());
    $team_link[$i] = trim($table_row[$i]->first('a.custom-table__team')->attr('href'));
    $games[$i] = trim($table_row[$i]->find('.custom-table__var')[0]->text());
    $win[$i] = trim($table_row[$i]->find('.custom-table__var')[1]->text());
    $draw[$i] = trim($table_row[$i]->find('.custom-table__var')[2]->text());
    $lost[$i] = trim($table_row[$i]->find('.custom-table__var')[3]->text());

    get_players($document, $client, $url . $team_link[$i]);

    $array[$i] = [
      'id' => $id[$i],
      'icon_link' => $icon_link[$i],
      'name' => $team_name[$i],
      'team_link' => $url . $team_link[$i],
      'games' => $games[$i],
      'win' => $win[$i],
      'draw' => $draw[$i],
      'lost' => $lost[$i],
    ];
  }
  return $array;
}

function get_players(Document $document, Client $client, $team_url)
{
  global $url;
  static $team_id = 1;
  sleep(rand(1, 3));
  $players = get_html($team_url, $client);
  $document->loadHtml($players);
  $table_row = $document->find('div#tournament-application-players-approved table .table__row');
  for ($i=0; $i < count($table_row); $i++) {
    //echo 'Игрок '.$i.PHP_EOL;
    $number[$i] = trim($table_row[$i]->first('.table__cell--number')->text());
    $amplua[$i] = trim($table_row[$i]->first('.table__cell--amplua')->text());
    $name[$i] = trim($table_row[$i]->first('.table__player-name')->text());
    $img_link[$i] = trim($table_row[$i]->first('img.table__player-img')->attr('src'));
    $player_link[$i] = trim($table_row[$i]->first('a.table__player')->attr('href'));
    $birthday[$i] = trim($table_row[$i]->first('.table__cell--middle')->text());
    $games[$i] = trim($table_row[$i]->find('.table__cell--variable')[0]->text());
    $goals[$i] = trim($table_row[$i]->find('.table__cell--variable')[1]->text());
    $assists[$i] = trim($table_row[$i]->find('.table__cell--variable')[2]->text());
    $yellow_card[$i] = trim($table_row[$i]->find('.table__cell--variable')[3]->text());
    $red_card[$i] = trim($table_row[$i]->find('.table__cell--variable')[4]->text());
    // ПРОВЕРКА НА НАЛИЧИЕ https://superliga.rfs.ru
    $arr = explode('/', $img_link[$i]);
    if (!in_array('https:', $arr, true)){
      $http = $url.$img_link[$i];
    } else{
      $http = $img_link[$i];
    }

    $array[$i] = [
      'number' => $number[$i],
      'amplua' => $amplua[$i],
      'name' => $name[$i],
      'img_link' => $http,
      'player_link' => $url.$player_link[$i],
      'birthday' => $birthday[$i],
      'games' => $games[$i],
      'goals' => $goals[$i],
      'assists' => $assists[$i],
      'yellow_card' => $yellow_card[$i],
      'red_card' => $red_card[$i]
    ];
  }
  file_put_contents('../../assets/data/'.$team_id++.'.json', json_encode($array, JSON_UNESCAPED_UNICODE));
}
