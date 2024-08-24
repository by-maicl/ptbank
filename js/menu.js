// Отправка ajax на сервер об изменении статуса уведомлений (просмотрено)
function sendAjaxRequest() {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', "../pages/updNotification.php", true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Обробка успішної відповіді
        var response = xhr.responseText;
        console.log(response);
      } else {
        // Обробка помилки
        console.error('Помилка: ' + xhr.status);
      }
    }
  };

  xhr.send();
}

document.addEventListener("DOMContentLoaded", function () {
  var bellHidden = document.getElementById("bellHidden");
  var bellHiddenButt = document.getElementById("bellHiddenButt");

  bellHiddenButt.addEventListener("click", function () {
    bellHidden.style.display = "none";
  });
});

function toggle(el) {
  el.style.display = (el.style.display == 'none') ? 'block' : 'none';
}

function openNotif(el) {
  let elName = document.getElementById(el);
  elName.classList.toggle('open');
}
