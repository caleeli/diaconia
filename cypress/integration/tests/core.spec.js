
context('Core tests', () => {
    beforeEach(() => {
        cy.login('admin@coredump.com', 'admin');
    })

    it('Traducciones', () => {
        cy.visit('/home#/core');
        cy.get('[data-cy="check.form"]').click();
        cy.get('button.btn').contains('Cancel').click();
    })

})
