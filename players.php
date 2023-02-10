<?
  if (isset($_GET['id'])){
    $data = json_decode(file_get_contents('assets/data/'.$_GET['id'].'.json'), JSON_OBJECT_AS_ARRAY);
  }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Игроки</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="players">
    <div class="players__container container">
      <div class="team__row">
        <h1 class="team__title title">Игроки</h1>
        <button class="team__button button">
          <i class="team__icon icon">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 286.052 286.052" style="enable-background:new 0 0 512 512" xml:space="preserve">
              <g>
                <path d="M78.493 143.181H62.832v-.125c0-43.623 34.809-80.328 79.201-80.122 21.642.098 41.523 8.841 55.691 23.135l25.843-24.931c-20.864-21.043-49.693-34.049-81.534-34.049-63.629 0-115.208 51.955-115.298 116.075h-15.84c-9.708 0-13.677 6.49-8.823 14.437l33.799 33.504c6.704 6.704 10.736 6.91 17.646 0l33.799-33.504c4.854-7.939.876-14.42-8.823-14.42zm205.485-13.945-33.799-33.433c-6.892-6.892-11.156-6.481-17.637 0l-33.799 33.433c-4.854 7.929-.894 14.419 8.814 14.419h15.635c-.25 43.337-34.943 79.72-79.183 79.514-21.633-.089-41.505-8.814-55.691-23.099l-25.843 24.896c20.873 21.007 49.702 33.996 81.534 33.996 63.432 0 114.869-51.579 115.28-115.298h15.867c9.716-.009 13.676-6.508 8.822-14.428z" fill="#021b31" data-original="#3db39e"></path>
              </g>
            </svg>
          </i>
          Обновить
        </button>
      </div>
      <div class="team-table__wrapper">
        <table class="team-table">
          <thead>
            <tr>
              <th rowspan='2'>#</th>
              <th rowspan='2'>Амплуа</th>
              <th class="team-table__link" rowspan='2' colspan="2">Игрок</th>
              <th rowspan='2'>День рождения</th>
              <th rowspan='2'>Игры</th>
              <th rowspan="2">Голы</th>
              <th rowspan="2">Пенальти</th>
              <th rowspan="2">Жёлтые карточки</th>
              <th rowspan="2">Красные карточки</th>
          </thead>
          <tbody>
            <? 
            for ($i = 0; $i < count($data); $i++) { ?>
              <tr>
                <td><?= $data[$i]['number'] ?></td>
                <td><?= $data[$i]['amplua'] ?></td>
                <td class="team-table__link" colspan="2">
                  <a target='_blank' href="<?= $data[$i]['player_link'] ?>">
                    <div class="team-table__img img">
                      <img alt="team icon" src="<?= $data[$i]['img_link'] ?>">
                    </div>
                    <p><?= $data[$i]['name'] ?></p>
                  </a>
                </td>
                <td><?= $data[$i]['birthday'] ?></td>
                <td><?= $data[$i]['games'] ?></td>
                <td><?= $data[$i]['goals'] ?></td>
                <td><?= $data[$i]['assists'] ?></td>
                <td><?= $data[$i]['yellow_card'] ?></td>
                <td><?= $data[$i]['red_card'] ?></td>
              </tr>
            <? } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="assets/js/script.js"></script>
</body>

</html>