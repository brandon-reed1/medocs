/**
 *
 * @type {HTMLElement}
 * @author novitz jean-philippe <novitz@gmail.com>
 * @description slide up qr hidden qr code
 */

const qr_btn = document.getElementById('qr-cta-btn')
const qr_container = document.getElementById('qr-cta')

if (qr_btn !== undefined && qr_container !== undefined) {
    qr_btn.addEventListener('click', (e) => {
        qr_container.classList.toggle('show')
        qr_btn.classList.toggle('bg-primary')
        qr_btn.classList.toggle('bg-danger')
        qr_btn.classList.toggle('less')
    })
}

