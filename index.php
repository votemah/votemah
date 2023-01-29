<?
require __DIR__ . '/vendor/autoload.php';

use DiDom\Document;
// ЯНДЕКС-ПОГОДА
$url = 'https://yandex.ru/pogoda/?via=hl';
$document = new Document($url, true);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="weather">
    <div class="weather__container container">
      <h1 class="weather__title title">Парсинг Яндекс.Погоды</h1>
      <div class="weather__wrapper">
        <table class="weather-table">
          <thead>
            <tr>
              <th class="weather-table__day" rowspan='2'>Число</th>
              <th class="weather-table__name" rowspan='2'>День недели</th>
              <th rowspan='2'>Погода</th>
              <th colspan="2">Температура</th>
            <tr>
              <td>Днём</td>
              <td>Ночью</td>
            </tr>
          </thead>
          <tbody>
            <? $days = $document->find('.forecast-briefly__day');
            for ($i = 0; $i < 10; $i++) { ?>
              <tr>
                <td><?= $days[$i]->first('.time') ?></td>
                <td><?= $days[$i]->first('.forecast-briefly__name') ?></td>
                <td>
                  <div class="weather-table__img img">
                    <?= $days[$i]->first('img.icon') ?>
                  </div>
                </td>
                <td><?= $days[$i]->find('.temp .temp__value')[0] ?></td>
                <td><?= $days[$i]->find('.temp .temp__value')[1] ?></td>
              </tr>
            <? } ?>
          </tbody>
          <tfoot></tfoot>
        </table>
      </div>
    </div>
  </div>
</body>

</html>