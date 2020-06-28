
context('ABM de Riesgos', () => {

    beforeEach(() => {
        cy.login('admin@coredump.com', 'admin');
        cy.get('[data-cy="menu.configuracion"]').click();
        cy.get('[data-cy="menu.riesgos"]').click();
        cy.wait(1000);
        cy.wait("@api_get.all");
    })

    it('Busqueda en tabla', () => {
        // Buscar plantilla especifica
        cy.buscarEnTabla('RA');
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 1);
    })

    it('Crear nuevo registro', () => {
        // Click en boton new "Nuevo"
        cy.get('[data-cy="tabla.new"]').click();
        cy.get('[data-cy="field.attributes.nombre"]').type('prueba');
        cy.get('[data-cy="field.attributes.color"]').type('#049ecd');
        cy.get('[data-cy="field.attributes.ponderacion"]').type('0.2');
        cy.guardar('@api_post');
        // Verificar que fue creado
        cy.buscarEnTabla('prueba');
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 1);
    })

    it('Editar registro', () => {
        // Buscar registro
        cy.buscarEnTabla('prueba');
        cy.get('[data-cy="tabla.row.edit"]').click();
        cy.get('[data-cy="field.attributes.nombre"]').clear().type('modificado');
        cy.get('[data-cy="field.attributes.color"]').clear().type('#cd9e04');
        cy.get('[data-cy="field.attributes.ponderacion"]').clear().type('0.4');
        cy.guardar('@api_put');
        // Verificar que fue modificado
        cy.buscarEnTabla('modificado');
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 1);
    })

    it('Eliminar registro', () => {
        // Buscar registro
        cy.buscarEnTabla('modificado');
        cy.get('[data-cy="tabla.row.remove"]').click();
        cy.si();
        cy.wait('@api_delete');
        // Verificar que fue eliminado
        cy.buscarEnTabla('modificado');
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 0);
    })
})
