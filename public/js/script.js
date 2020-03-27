// Menunggu page di load sepenuhnya
document.addEventListener('DOMContentLoaded', () => {
  const themeStylesheet = document.getElementById('theme');
  const themeToggle = document.getElementById('themeToggle');
  const modeLight = document.getElementById('modeLight');
  const modeDark = document.getElementById('modeDark');
  const navbar = document.getElementById('navbar');

  const classMode = ['btn','btn-light','rounded-pill'];
  const storedTheme = localStorage.getItem('theme');
  const storedNavbar = localStorage.getItem('navbar');
  const storedToggle = localStorage.getItem('toggle');


  if(storedTheme){
    themeStylesheet.href = storedTheme;
    navbar.classList.add(storedNavbar)
  }

  themeToggle.addEventListener('click', () => {
    // light -> dark
    if(themeStylesheet.href.includes('light')){
      themeStylesheet.href = 'css/dark.css';
      modeDark.classList.add(...classMode);
      modeLight.classList.remove(...classMode);
      navbar.classList.add('bg-dark');
      navbar.classList.remove('bg-light');
    }else{
      // dark -> light
      themeStylesheet.href = 'css/light.css';
      modeLight.classList.add(...classMode);
      modeDark.classList.remove(...classMode);
      navbar.classList.remove('bg-dark');
      navbar.classList.add('bg-light');
    }

    // save theme ke localstorage
    localStorage.setItem('theme', themeStylesheet.href);
    if(navbar.className.includes('bg-light')){
      localStorage.setItem('navbar', 'bg-light');
    }else{
      localStorage.setItem('navbar', 'bg-dark');
    }
  })

  // memberi animasi ke circle
  const smallCircles = document.querySelectorAll('.small-circle');
  smallCircles.forEach((circle,index) => {
    index += 1;
    let duration = index * 2;
    let delay = index * 1.5;
    circle.style.animationDuration = duration + 's';
    circle.style.aniamtionDelay = delay +'s';
  })

  // memberi animasi fade
  const fades = document.querySelectorAll('.fade');
  fades.forEach((fade,index) => {
    index+=1;
    let duration = index * 1;
    let delay = index * 2;
    fade.style.animationDuration = duration + 's';
    fade.style.aniamtionDelay = delay + 's';
  })
})