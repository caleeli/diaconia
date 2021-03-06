
context('Roles de usuarios', () => {

    beforeEach(() => {
        cy.login('admin@coredump.com', 'admin');
        cy.get('[data-cy="menu.roles"]').click();
        cy.wait(1000);
        cy.wait("@api_get.all");
    })

    it('Lista de roles', () => {
        cy.get('[data-cy="tabla.input.search"]:visible').clear().type('roles');
        cy.get('[data-cy="tabla.search"]:visible').click();
        cy.wait("@api_get");
        cy.wait(100);
        cy.get('[data-cy="tabla.table"]:visible').find('tbody tr').should('have.length', 1);
    })

    it('Crear rol', () => {
        // Ir al listado de roles
        cy.get('[data-cy="menu.roles"]').click();
        // Espera a que se cargue el listado de menues padres
        cy.wait("@api_get");
        // Click en boton new "Nuevo"
        cy.get('[data-cy="tabla.new"]:visible').click();
        cy.get('[data-cy="field.attributes.parent"]').select('3');
        cy.get('[data-cy="field.attributes.code"]').type('test');
        cy.get('[data-cy="field.attributes.name"]').type('test');
        cy.get('[data-cy="field.attributes.icon"]').click();
        cy.get('.fa-address-book.vfa-icon-preview').click();
        cy.get('[data-cy="field.attributes.path"]').type('/home');
        cy.get('button.btn').contains('Guardar').click();
        // espera a que se guarde el registro
        cy.wait("@api_post");
        cy.wait("@api_get");
        // Verificar que fue creado
        cy.buscarEnTabla('test');
        cy.get('[data-cy="tabla.table"]:visible').find('tbody tr').should('have.length', 1);
    })


    it('Editar menues del rol', () => {
        // Ir al listado de roles
        cy.get('[data-cy="menu.roles"]').click();
        cy.wait("@api_get");
        // Buscar un menu del rol
        cy.buscarEnTabla('roles');
        // Click en boton editar
        cy.get('[data-cy="tabla.row.edit"]:visible').click();
        // Editar datos
        cy.get('[data-cy="field.attributes.code"]').clear();
        cy.get('[data-cy="field.attributes.name"]').clear();
        cy.get('[data-cy="field.attributes.path"]').clear();
        cy.get('button.btn').contains('Guardar').click();
        cy.wait("@api_put");
        // Debe dar error
        cy.get('[data-cy="form.status"] label').should('have.class', 'text-danger');
        // Editar datos
        cy.get('[data-cy="field.attributes.code"]').clear().type('prueba');
        cy.get('[data-cy="field.attributes.name"]').clear().type('prueba');
        cy.get('[data-cy="field.attributes.path"]').clear().type('/prueba');
        cy.get('button.btn').contains('Guardar').click();
        cy.wait("@api_put");
        // Verificar que fue actualizado
        cy.buscarEnTabla('prueba');
        cy.get('[data-cy="tabla.table"]:visible').find('tbody tr').should('have.length', 1);
    })

})
