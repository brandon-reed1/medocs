import faker from 'faker';

/***************/
/* fakers      */
/***************/
faker.locale = 'fr'

const btn = document.getElementById('faker_button')
const input_field = document.getElementById('url_url')

if (input_field.value === "") fakeIt()


if (btn !== undefined) {
    btn.addEventListener('click', (e) => {
        e.preventDefault()
        fakeIt()
    })
}

function fakeIt() {
    input_field.value = faker.name.firstName()+" "+faker.name.lastName();
}