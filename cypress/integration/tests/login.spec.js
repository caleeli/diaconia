/// <reference types="Cypress" />

context('Login del Sistema', () => {

    it('Login de usuario', () => {
        cy.login('admin@coredump.com', 'admin');
        cy.get('.panel-title').should('contain.html', 'Inicio');
    })
})
