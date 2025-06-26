lblMenu = document.querySelector('#lblMenu')
navbar = document.querySelector('#navbar')
icon = document.querySelector('#icon_menu')

lblMenu.addEventListener('click', ()=>{
    navbar.classList.toggle('active')
    icon.classList.toggle('ri-menu-line')
    icon.classList.toggle('ri-close-line')
})