// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add("login", (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add("drag", { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add("dismiss", { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite("visit", (originalFn, url, options) => { ... })

Cypress.Commands.add("login", (email, password) => {
    cy.route('get', '/api/data/user/*').as('api_user_get');
    cy.route('post', '/api/data/user/*').as('api_user_post');
    cy.visit(Cypress.env("APP_URL"));
    cy.get('#login').click();
    cy.get('#email').type(email);
    cy.get('#password').type(password);
    cy.get('#submit').click();
    cy.wait('@api_user_get');
    cy.wait('@api_user_post');
});

/**
 * Converts Cypress fixtures, including JSON, to a Blob. All file types are
 * converted to base64 then converted to a Blob using Cypress
 * expect application/json. Json files are just stringified then converted to
 * a blob (prevents issues with invalid string decoding).
 * @param {String} fileUrl - The file url to upload
 * @param {String} type - content type of the uploaded file
 * @return {Promise} Resolves with blob containing fixture contents
 */
function getFixtureBlob(fileUrl, type) {
    return type === 'application/json'
        ? cy
            .fixture(fileUrl)
            .then(JSON.stringify)
            .then(jsonStr => new Blob([jsonStr], { type: 'application/json' }))
        : cy.fixture(fileUrl, 'base64').then(Cypress.Blob.base64StringToBlob)
}

/**
 * Uploads a file to an input
 * @memberOf Cypress.Chainable#
 * @name uploadFile
 * @function
 * @param {String} selector - element to target
 * @param {String} fileUrl - The file url to upload
 * @param {String} type - content type of the uploaded file
 */
Cypress.Commands.add('uploadFile', (selector, fileUrl, type = '') => {
    return cy.get(selector).then(subject => {
        return getFixtureBlob(fileUrl, type).then(blob => {
            return cy.window().then(win => {
                const el = subject[0]
                const nameSegments = fileUrl.split('/')
                const name = nameSegments[nameSegments.length - 1]
                const testFile = new win.File([blob], name, { type })
                const dataTransfer = new win.DataTransfer()
                dataTransfer.items.add(testFile)
                el.files = dataTransfer.files
                return subject
            })
        })
    })
});

/**
 * Execute a db seeder
 *
 * @name dbSeed
 * @function
 * @param {String} seeder - seeder class name
 */
Cypress.Commands.add('dbSeed', (seeder) => {
    return cy.exec(`php artisan db:seed --class=${seeder}`);
});

/**
 * Escribe y ejecuta una busqueda en la tabla que ve el usaurio
 *
 * @param {String} busqueda - seeder class name
 */
Cypress.Commands.add('buscarEnTabla', (busqueda) => {
    cy.get('[data-cy="tabla.input.search"]:visible').clear().type(busqueda);
    cy.get('[data-cy="tabla.search"]:visible').click();
    cy.wait("@api_get");
    cy.wait(1000);
});

// BOTONES
Cypress.Commands.add('guardar', (tipo = '@api_put') => {
    cy.get('button.btn').contains('Guardar').click();
    cy.wait(tipo);
    cy.wait('@api_get');
});
Cypress.Commands.add('no', () => {
    cy.get('button.btn').contains('no').click();
});
Cypress.Commands.add('si', () => {
    cy.get('button.btn').contains('sí').click();
});
Cypress.Commands.add('guardarEnLinea', (selector, tipo = '@api_put') => {
    cy.get(selector).click();
    cy.wait(tipo);
});
Cypress.Commands.add('subirArchivo', { prevSubject: true }, (subject, fileUrl, type) => {
    cy.get(subject).find('input[type=file]').then(function (el) {
        cy.uploadFile(el, fileUrl, type).then(() => {
            el[0].dispatchEvent(new Event('change', { bubbles: true }));
        });
    });
});
/**
 * fechaHora en formato ISO
 */
Cypress.Commands.add('fechaHora', { prevSubject: true }, (subject, fechaHora) => {
    subject.each((index, node) => {
        node.__vue__.$emit('change', fechaHora);
    })
});
