import faker from 'faker';

/***************/
/* fakers      */
/***************/
faker.locale = 'fr'

const btn = document.getElementById('faker_button')
const input_field = document.getElementById('url_url')

if (btn !== undefined) {
    btn.addEventListener('click', (e) => {
        e.preventDefault()
        input_field.value = faker.internet.userName();
    })
}