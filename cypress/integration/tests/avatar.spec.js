
context('Perfil de Usuario', () => {
    beforeEach(() => {
        cy.viewport(1366, 768);
        cy.login('admin@coredump.com', 'admin');
    })

    it('Actualizar avatar del usuario', () => {
        cy.get('[data-cy="navbar.profile"]').click();
        cy.get('input[type=file]').then(function (el) {
            cy.uploadFile('input[type=file]', 'avatar.jpeg', 'image/jpeg').then(() => {
                el[0].dispatchEvent(new Event('change', { bubbles: true }));
            });
        });
        cy.wait("@uploaded");
        cy.get('[data-cy="submit"]').click();
        cy.get('[data-cy="form.status"]').should('contain', 'Los cambios se guardaron correctamente');
        cy.get('[data-cy="navbar.profile"] .jdd-avatar-circle-image').should((avatar) => {
            expect(avatar).to.have.attr('src').match(/avatar\.jpeg$/);
        });
    })

})
