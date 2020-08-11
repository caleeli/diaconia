
context('Plantillas de auditoria', () => {
    
    before(() => {
        cy.exec('php artisan db:seed --class=PlantillasSeeder');
    });

    beforeEach(() => {
        cy.login('admin@coredump.com', 'admin');
        cy.get('[data-cy="menu.configuracion"]').click();
        cy.get('[data-cy="menu.tipos_auditoria"]').click();
        cy.wait(1000);
        cy.wait("@api_get.all");
    })

    it('Lista de plantillas y actualizar cambios', () => {
        cy.get('[data-cy="tabla.row.edit"]:first').click();
        cy.get('[data-cy="field.attributes.name"]').clear().type('Nuevo crédito individual');
        // click en guardar
        cy.guardar();
        // esperar a recarga de tabla
        cy.wait('@api_get');
        cy.get('[data-cy="tabla.table"]').should('contain.html', 'Nuevo crédito individual');

        // Buscar plantilla especifica
        cy.buscarEnTabla('Nuevo crédito individual');
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 1);
    })

    it('Editar preguntas', () => {
        cy.get('[data-cy="tabla.row.preguntas"]:first').click();
        cy.wait('@api_get');
        cy.get('[data-cy="tabla.row.edit"]:first').click();
        cy.wait('@api_get');
        // Intentar guardar vacio
        cy.get('[data-cy="field.attributes.descripcion"]').clear();
        cy.guardarEnLinea('[data-cy="tabla.row.save"]:first');
        // Cambiar valor
        cy.get('[data-cy="field.attributes.descripcion"]').clear().type('Nueva descripción');
        cy.guardarEnLinea('[data-cy="tabla.row.save"]:first');
        cy.wait('@api_get');
        cy.wait('@api_get');
        cy.get('[data-cy="tabla.table"]').should('contain.html', 'Nueva descripción');
    })

    it('Agregar pregunta', () => {
        cy.get('[data-cy="tabla.row.preguntas"]:first').click();
        cy.wait('@api_get');
        cy.wait('@api_get');
        cy.get('[data-cy="tabla.new"]').click();
        // Guardar invalido
        cy.get('[data-cy="field.attributes.descripcion"]').clear().type('Nueva pregunta');
        cy.guardarEnLinea('[data-cy="tabla.row.save"]:first', '@api_post');
        // Completar cambios
        cy.get('[data-cy="field.attributes.grupo"]').clear().type('5');
        // Guardar
        cy.guardarEnLinea('[data-cy="tabla.row.save"]:first', '@api_post');
        cy.wait('@api_get');
        cy.get('[data-cy="tabla.table"]').should('contain.html', 'Nueva pregunta');
    })

    it('Eliminar pregunta', () => {
        cy.get('[data-cy="tabla.row.preguntas"]:first').click();
        cy.wait('@api_get');
        cy.get('[data-cy="tabla.row.remove"]:first').click();
        cy.wait('@api_get');
        cy.si();
        cy.wait('@api_delete');
        cy.wait('@api_get');
        cy.get('[data-cy="tabla.table"]').should('not.contain.html', 'Nueva descripción');
    })

    it('Eliminar plantilla', () => {
        cy.get('[data-cy="tabla.row.remove"]:first').click();
        cy.si();
        cy.wait('@api_delete');
        // Buscar plantilla especifica
        cy.buscarEnTabla('Nuevo crédito individual');
        cy.get('[data-cy="tabla.table"]').find('tbody tr').should('have.length', 0);
    })

    it('Vista previa de plantilla', () => {
        cy.get('[data-cy="tabla.row.preguntas"]:first').click();
        cy.wait('@api_get');
        cy.get('[data-cy="tabla.vista-previa"]').click();
        cy.wait(1000);
        cy.wait("@api_get.all");
        cy.get('[data-cy="pregunta.respuesta"]:first').select('PC');
        cy.get('[data-cy="pregunta.clasificacion"]:first .dropdown-toggle').click();
        cy.get('[data-cy="pregunta.clasificacion"]:first li:contains("Boleta de caja")').click();
        cy.get('[data-cy="pregunta.observacion"]:first').clear().type('Falta la boleta de caja');
        cy.get('[data-cy="pregunta.tipo_observacion"]:first').select('CA');
        cy.get('[data-cy="pregunta.riesgo_adicional_id"]:first').select('RA');
        // Volver a las preguntas
        cy.get('[data-cy="plantilla-volver"]').click();
    })
})
