context('Gantt', () => {
    beforeEach(() => {
        cy.login('admin@coredump.com', 'admin');
        cy.get('[data-cy="menu.tareas"]').click();
        cy.wait(500);
        cy.get('[data-cy="menu.progreso"]').click();
    })
    it('Prueba 1', () => {
        //e2e
        cy.get('[data-cy="gantt"]').should('contain.text', '2020-08-22');
        cy.get('[data-cy="gantt"]').should('contain.text', 'admin Tarea 1');
        cy.get('[data-cy="gantt"]').should('contain.text', 'admin Tarea 2');
        cy.get('[data-cy="gantt"]').should('contain.text', 'admin Tarea 3');
        cy.get('[data-cy="gantt"]').should('contain.text', 'audit Tarea 4');
        cy.get('[data-cy="gantt"]').should('contain.text', 'audit Tarea 5');
        cy.get('[data-cy="gantt"]').should('contain.text', 'audit Tarea 6');
        cy.get('[data-cy="gantt"]').should('not.contain.text', 'admin Tarea 4');
    })
})