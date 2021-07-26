/* ************************* */
/* ***** LATERAL MENU ****** */
/****************************/

var menus = document.querySelectorAll("#menu, #sidebar-menu")
var sidebar = document.getElementById("sidebar")
var contentLogo = document.getElementById('content-logo')

for (var menu of menus) {
    menu.addEventListener('click', () => {
        if (sidebar.classList.contains('show')) {
            sidebar.classList.remove('show')
            if (contentLogo.classList.contains('hide')) {
                contentLogo.classList.remove('hide')
            }
        } else {
            sidebar.classList.add('show')
            if (!contentLogo.classList.contains('hide')) {
                contentLogo.classList.add('hide')
            }

        }
    })
}