/// <reference types="Cypress" />

context('Login del Sistema', () => {

    it('Login de usuario', () => {
        cy.login('admin@coredump.com', 'admin');
        cy.get('.panel-title').should((panel) => {
            expect(panel.first()).to.contain('Inicio');
        });
    })
})
