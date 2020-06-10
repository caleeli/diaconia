
context('Notificactions', () => {
    beforeEach(() => {
        cy.login('admin@coredump.com', 'admin');
    })

    it('Enable', () => {
        // Enable
        cy.get('[data-cy="navbar.notifications"]').click();
        // Disable
        cy.get('[data-cy="navbar.notifications"]').click();
    })

})
