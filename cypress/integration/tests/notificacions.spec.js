
context('Notificactions', () => {
    beforeEach(() => {
        cy.viewport(1366, 768);
        cy.login('admin@coredump.com', 'admin');
    })

    it('Enable', () => {
        // Enable
        cy.get('[data-cy="navbar.notifications"]').click();
        // Disable
        cy.get('[data-cy="navbar.notifications"]').click();
    })

})
