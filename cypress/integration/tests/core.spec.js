
context('Core tests', () => {
    
    before(() => {
        cy.exec('php artisan db:seed --class=PlantillasSeeder');
    });

    beforeEach(() => {
        cy.login('admin@coredump.com', 'admin');
    })

    it('Traducciones', () => {
        cy.visit('/home#/core');
        cy.get('[data-cy="check.form"]').click();
        cy.get('button.btn').contains('Cancel').click();
    })

    it('Tabla', () => {
        cy.visit('/home#/core');
        // Paginado: Go next page
        cy.get('[data-cy="table.toolbar.next"]').click();
        cy.wait('@api_get');
        cy.wait(500);
        cy.get('[data-cy="table.toolbar.page"]').should('have.value', '2');
        // Paginado: Go previous page
        cy.get('[data-cy="table.toolbar.previous"]').click();
        cy.wait('@api_get');
        cy.wait(500);
        cy.get('[data-cy="table.toolbar.page"]').should('have.value', '1');
        // Paginado: Go last page
        cy.get('[data-cy="table.toolbar.last"]').click();
        cy.wait('@api_get');
        cy.wait(500);
        cy.get('[data-cy="table.toolbar.last_page"]').then(e => {
            cy.get('[data-cy="table.toolbar.page"]').should('have.value', e[0].textContent.trim().substr(1));
        });
        // Paginado: Go first page
        cy.get('[data-cy="table.toolbar.first"]').click();
        cy.wait('@api_get');
        cy.wait(500);
        cy.get('[data-cy="table.toolbar.page"]').should('have.value', '1');
        // Busqueda
        cy.buscarEnTabla('En el caso de que el crédito cuente con garantía');
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length.gte', 1);

    })

    it('D-Select', () => {
        cy.visit('/home#/core');
        cy.get('[data-cy="core-d-select"] input').clear().type('admin');
        cy.get('[data-cy="core-d-select"] a:contains("admin")').click();
    })

})
