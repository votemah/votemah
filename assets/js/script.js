document.addEventListener('DOMContentLoaded', () => {
  const btnUpdate = document.querySelector('.weather__button');
  const tableBody = document.querySelector('.weather-table tbody');
  // ОБНОВЛЯЕМ ДАННЫЕ И ТАБЛИЦУ БЕЗ ПЕРЕЗАГРУЗКИ
  btnUpdate.addEventListener('click', updateTable);
  async function updateTable(e) {
    e.preventDefault;
    btnUpdate.classList.add('_loading');
    tableBody.classList.add('_loading');
    try {
      let response = await fetch('/vendor/action/parse.php');
      if (response.ok) {
        let result = await response.json();
        alert('Обновление прошло успешно!');
        tableBody.innerHTML = toHtml(result);
        btnUpdate.classList.remove('_loading');
        tableBody.classList.remove('_loading');
      } else {
        alert(response.statusText);
        btnUpdate.classList.remove('_loading');
        tableBody.classList.remove('_loading');
      }
    } catch (error) {
      console.log(error);
      btnUpdate.classList.remove('_loading');
      tableBody.classList.remove('_loading');
    }
  }
  // ДЕКОДИРУЕМ ДАННЫЕ В HTML
  function toHtml(json) {
    let html = '';
    for (let k = 0; k < json.length; k++) {
      const key = json[k];
      html +=
        `<tr>
        <td>${key['date']}</td>
        <td>${key['name']}</td>
        <td>
          <div class="weather-table__img img">
            <img alt="weather icon" src="${key.icon_link}">
          </div>
        </td>
        <td>${key.temp_day}</td>
        <td>${key.temp_night}</td>
      </tr>`;
    }
    return html;
  }
})