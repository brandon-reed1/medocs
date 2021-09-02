const show_btn = document.getElementById('qr-cta-show')
const hide_btn = document.getElementById('qr-cta-hide')
const qr_container = document.getElementById('qr-cta')

if (show_btn !== undefined)
{
    show_btn.addEventListener('click', (e)=>{
        qr_container.classList.add('show')
        show_btn.classList.add('hide')
        hide_btn.classList.toggle('hide')
    })
}

if (hide_btn !== undefined)
{
    hide_btn.addEventListener('click', (e)=>{
        qr_container.classList.toggle('show')
        show_btn.classList.toggle('hide')
        hide_btn.classList.toggle('hide')
    })
}

