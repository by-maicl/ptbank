// Pop-up
function showPopUp(message, type = true) {
    const popUp = document.createElement('div');
    popUp.classList.add('popUpRight');
  
    const popUpText = document.createElement('p');
    const progressBar = document.createElement('div');
    if (type) {
        popUpText.classList.add('popUpText');
        progressBar.classList.add('progressBar');
    } else {
        popUpText.classList.add('popUpTextFalse');
        progressBar.classList.add('progressBarFalse');
    }
    popUpText.innerHTML = message;
  
    popUp.appendChild(popUpText);
    popUp.appendChild(progressBar);
  
    document.body.appendChild(popUp);
  
    setTimeout(() => {
        popUp.classList.add('show');
    }, 10);
  
    progressBar.style.animation = 'progressBar 3s linear forwards';
  
    setTimeout(() => {
        popUp.classList.add('hide');
        setTimeout(() => {
            popUp.remove();
        }, 500);
    }, 3000);
  }