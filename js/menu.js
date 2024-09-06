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

function openWindow(el) {
  let elName = document.getElementById(el);
  let isOpen = elName.classList.toggle('open');

  document.removeEventListener('click', handleClickOutside);

  if (isOpen) {
    setTimeout(() => {
      document.addEventListener('click', handleClickOutside);
    }, 0);
  }

  function handleClickOutside(event) {
    if (!elName.contains(event.target)) {
      elName.classList.remove('open');
      document.removeEventListener('click', handleClickOutside);
    }
  }
}

// function openMenu() {
//   let menu = document.getElementById('burgerMenu');
//   toggle(menu);

//   let iconClose = document.getElementById('burgerClose');
//   let iconOpen = document.getElementById('burgerOpen');

//   if (menu.style.display == 'none') {
//     iconClose.style.display = 'block';
//     iconOpen.style.display = 'none';
//   } else {
//     iconOpen.style.display = 'block';
//     iconClose.style.display = 'none'; 
//   }
// }

