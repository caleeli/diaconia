// ***********************************************************
// This example support/index.js is processed and
// loaded automatically before your test files.
//
// This is a great place to put global configuration and
// behavior that modifies Cypress.
//
// You can change the location of this file or turn off
// automatically serving support files with the
// 'supportFile' configuration option.
//
// You can read more here:
// https://on.cypress.io/configuration
// ***********************************************************

// Import commands.js using ES2015 syntax:
import './commands';
import '@cypress/code-coverage/support';
import '@foreachbe/cypress-tinymce';

// Alternatively you can use CommonJS syntax:
// require('./commands')

before(() => {
    cy.exec('php artisan migrate:fresh --seed');
})

beforeEach(() => {
    // Routes
    cy.server();
    cy.route('post', '/api/uploadfile').as('uploaded');
    cy.route('get', '/api/data/**').as('api_get');
    cy.route('post', '/api/data/**').as('api_post');
    cy.route('put', '/api/data/**').as('api_put');
    cy.route('delete', '/api/data/**').as('api_delete');
    // Viewport
    cy.viewport(1366, 768);
});
