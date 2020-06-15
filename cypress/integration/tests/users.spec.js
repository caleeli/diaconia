
context('Perfil de Usuario', () => {
    beforeEach(() => {
        cy.login('admin@coredump.com', 'admin');
    })

    it('Lista de usuarios', () => {
        cy.get('[data-cy="menu.users"]').click();
        cy.wait("@api_get");
        cy.get('[data-cy="tabla.input.search"]').clear().type('admin');
        cy.get('[data-cy="tabla.search"]').click();
        cy.wait("@api_get");
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 1);
    })

    it('Crear Editar usuario', () => {
        // Crear usuario test
        cy.get('[data-cy="menu.users"]').click();
        cy.wait("@api_get");
        // Espera a que se cargue el listado de todosRoles
        cy.wait("@api_post");
        // Click en boton new "Nuevo"
        cy.get('[data-cy="tabla.new"]').click();
        cy.get('[data-cy="field.attributes.name"]').type('test');
        cy.get('[data-cy="field.attributes.email"]').type('test@coredump.com');
        cy.get('[data-cy="field.attributes.password"]').type('test');
        cy.get('[data-cy="field.attributes.role"]').select('Administrador');
        cy.get('button.btn').contains('Guardar').click();
        // espera a que se guarde el registro
        cy.wait("@api_post");
        cy.wait("@api_get");
        // Verificar que fue creado
        cy.buscarEnTabla('test');
        // espera a que se obtenga el listado de la API
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 1);
        // Editar usuario test
        cy.get('[data-cy="tabla.row.edit"]').click();
        cy.get('[data-cy="field.attributes.name"]').clear().type('prueba');
        cy.get('[data-cy="field.attributes.email"]').clear().type('prueba@coredump.com');
        cy.get('[data-cy="field.attributes.role"]').select('Auditores');
        cy.get('button.btn').contains('Guardar').click();
        // espera a que se guarde el registro
        cy.wait("@api_put");
        cy.get('[data-cy="tabla.input.search"]').clear().type('prueba');
        cy.get('[data-cy="tabla.search"]').click();
        // espera a que se obtenga el listado de la API
        cy.wait("@api_get");
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 1);
        // Cambiar password
        cy.get('[data-cy="tabla.row.change.password"]').click();
        cy.get('[data-cy="field.attributes.password"]').clear().type('12345678');
        cy.get('[data-cy="field.confirm_password"]').clear().type('123456');
        cy.get('button.btn').contains('Guardar').click();
        cy.get('[data-cy="form.status"]').should('contain', 'no coinciden');
        cy.get('[data-cy="field.confirm_password"]').clear().type('12345678');
        cy.get('button.btn').contains('Guardar').click();
        // espera a que se guarde el registro
        cy.wait("@api_put");
        // Eliminar registro
        cy.get('[data-cy="tabla.row.remove"]').click();
        cy.get('button.btn-danger').contains('sí').click();
        // espera a que se elimine el registro
        cy.wait("@api_delete");
        cy.get('[data-cy="tabla.search"]').click();
        // espera a que se obtenga el listado de la API
        cy.wait("@api_get");
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 0);
    })

    it('Crear un usuario con datos invalidos', () => {
        // Crear usuario test
        cy.get('[data-cy="menu.users"]').click();
        cy.get('[data-cy="tabla.new"]').click();
        cy.get('[data-cy="field.attributes.name"]').clear();
        cy.get('[data-cy="field.attributes.email"]').type('invalidemail');
        cy.get('[data-cy="field.attributes.password"]').clear();
        cy.get('button.btn').contains('Guardar').click();
        // espera a que se guarde el registro
        cy.wait("@api_post");
        // Verificar alertas
        cy.get('[data-cy="fieldset.attributes.name"]').should('contain', 'es obligatorio');
        cy.get('[data-cy="fieldset.attributes.email"]').should('contain', 'El campo email');
        cy.get('[data-cy="fieldset.attributes.password"]').should('contain', 'es obligatorio');
        cy.get('[data-cy="fieldset.attributes.role"]').should('contain', 'es obligatorio');
        // Datos repetidos
        cy.get('[data-cy="field.attributes.name"]').clear().type('admin');
        cy.get('[data-cy="field.attributes.email"]').clear().type('admin@coredump.com');
        cy.get('button.btn').contains('Guardar').click();
        // espera a que se guarde el registro
        cy.wait("@api_post");
        // Verificar alertas
        cy.get('[data-cy="fieldset.attributes.name"]').should('contain', 'repetido');
        cy.get('[data-cy="fieldset.attributes.email"]').should('contain', 'repetido');
    })

})
