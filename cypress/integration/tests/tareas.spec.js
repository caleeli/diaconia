
context('Tareas', () => {

    beforeEach(() => {
        cy.login('admin@coredump.com', 'admin');
        cy.get('[data-cy="menu.tareas"]').click();
        cy.get('[data-cy="menu.todas"]').click();
        cy.wait(1000);
        cy.wait("@api_get.all");
    })

    it('Busqueda en tabla', () => {
        // Buscar plantilla especifica
        cy.buscarEnTabla('Tarea 8');
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 1);
    })

    it('Crear nuevo registro', () => {
        // Click en boton new "Nuevo"
        cy.get('[data-cy="tabla.new"]').click();
        cy.get('[data-cy="field.attributes.nombre"]').type('prueba');
        cy.get('[data-cy="field.attributes.entregable"]').subirArchivo('avatar.jpeg', 'image/jpeg');
        cy.wait("@uploaded");
        cy.get('[data-cy="field.attributes.vencimiento"]').fechaHora('2020-07-03 12:00');
        cy.get('[data-cy="field.attributes.estado"]').clear().type('pendiente');
        cy.get('[data-cy="field.attributes.creador_id"]').select('1');

        cy.get('button.btn').contains('Guardar').click();
        // espera a que se guarde el registro
        cy.wait("@api_post");
        cy.wait("@api_get");
        // Verificar que fue creado
        cy.buscarEnTabla('prueba');
        cy.get('[data-cy="tabla.table"]:visible').find('tbody tr').should('have.length', 1);
    })

    it('Editar registro', () => {
        // Buscar registro
        cy.buscarEnTabla('prueba');
        cy.get('[data-cy="tabla.row.edit"]').click();
        cy.get('[data-cy="field.attributes.nombre"]').clear().type('modificado');
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
