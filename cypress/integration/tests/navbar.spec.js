context('Alertas en la barra de navegacion', () => {

    beforeEach(() => {
        cy.route('POST', '/api/user/1/alertas/1', {response: true});
        cy.login('admin@coredump.com', 'admin');
        cy.wait(1000);
        cy.wait("@api_get.all");
    })

    it('Abrir las alertas y probar su funcionalidad', () => {
        cy.get('[data-cy="navbar.notifications"]').contains("8");
        cy.get('[data-cy="navbar.notifications"] button').eq(1).click();
        cy.get('a:contains("Some text")').eq(0).click();
        cy.get('[data-cy="navbar.notifications"]').should('contain', "7");
    })
})