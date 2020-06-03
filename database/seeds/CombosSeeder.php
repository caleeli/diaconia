<?php

use App\ComboRevision;
use App\ComboCalidad;
use App\ComboClasificacion;
use App\ComboLugarVisita;
use App\ComboRiesgo;
use App\ComboSucursal;
use App\ComboTipoInforme;
use App\ComboVisita;
use Illuminate\Database\Seeder;

class CombosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ComboRevision::insert([
            ['valor' => 'N', 'descripcion' => 'N'],
            ['valor' => 'NA', 'descripcion' => 'NA'],
            ['valor' => 'PC', 'descripcion' => 'PC'],
            ['valor' => 'S', 'descripcion' => 'S'],
        ]);
        // INICIO
        ComboCalidad::insert([
            ['valor' => 'FINAL', 'descripcion' => 'FINAL'],
            ['valor' => 'PRELIMINAR', 'descripcion' => 'PRELIMINAR'],
        ]);
        ComboClasificacion::insert([
            ['valor' => '% familiares', 'descripcion' => '% familiares'],
            ['valor' => '% varones', 'descripcion' => '% varones'],
            ['valor' => 'Actividad económica', 'descripcion' => 'Actividad economica'],
            ['valor' => 'Anexo 2 ', 'descripcion' => 'Anexo 2 '],
            ['valor' => 'Asistencia menor al 70% de integrantes ', 'descripcion' => 'Asistencia menor al 70% de integrantes '],
            ['valor' => 'Bienes Incautados', 'descripcion' => 'Bienes Incautados'],
            ['valor' => 'Boleta de caja', 'descripcion' => 'Boleta de caja'],
            ['valor' => 'Capacidad de pago', 'descripcion' => 'Capacidad de pago'],
            ['valor' => 'Cedula de identidad', 'descripcion' => 'Cedula de identidad'],
            ['valor' => 'Certificado de Gravamen', 'descripcion' => 'Certificado de Gravamen'],
            ['valor' => 'Cierre de ciclo', 'descripcion' => 'Cierre de ciclo'],
            ['valor' => 'Clientes con edad fuera de políticas ', 'descripcion' => 'Clientes con edad fuera de políticas '],
            ['valor' => 'Clientes en otras Agencias', 'descripcion' => 'Clientes en otras Agencias'],
            ['valor' => 'Conciliación de cuentas', 'descripcion' => 'Conciliación de cuentas'],
            ['valor' => 'conciliación del jefe de agencia ', 'descripcion' => 'conciliación del jefe de agencia '],
            ['valor' => 'Contrato de préstamo', 'descripcion' => 'Contrato de préstamo'],
            ['valor' => 'Créditos en dos Agencias Diferentes', 'descripcion' => 'Créditos en dos Agencias Diferentes'],
            ['valor' => 'Croquis negocio y/o domicilio', 'descripcion' => 'Croquis negocio y/o domicilio'],
            ['valor' => 'Declaración patrimonial', 'descripcion' => 'Declaración patrimonial'],
            ['valor' => 'Destino del crédito', 'descripcion' => 'Destino del crédito'],
            ['valor' => 'Distribución de utilidades y ahorros', 'descripcion' => 'Distribución de utilidades y ahorros'],
            ['valor' => 'Documentación ilegible', 'descripcion' => 'Documentación ilegible'],
            ['valor' => 'Duplicidad de actividad', 'descripcion' => 'Duplicidad de actividad'],
            ['valor' => 'Envió de Información Kiva ', 'descripcion' => 'Envió de Información Kiva '],
            ['valor' => 'Estabilidad Domiciliaria ', 'descripcion' => 'Estabilidad Domiciliaria '],
            ['valor' => 'Evaluación económica (hoja Excel)', 'descripcion' => 'Evaluación económica (hoja Excel)'],
            ['valor' => 'Evaluación económica (pre impreso)', 'descripcion' => 'Evaluación económica (pre impreso)'],
            ['valor' => 'Factura de agua y/o luz', 'descripcion' => 'Factura de agua y/o luz'],
            ['valor' => 'familiares', 'descripcion' => 'familiares'],
            ['valor' => 'Ficha de datos', 'descripcion' => 'Ficha de datos'],
            ['valor' => 'Fondos en custodia', 'descripcion' => 'Fondos en custodia'],
            ['valor' => 'Formulario  Kiva , exención y fotografía ', 'descripcion' => 'Formulario  Kiva , exención y fotografía '],
            ['valor' => 'Formulario de declaración patrimonial', 'descripcion' => 'Formulario de declaración patrimonial'],
            ['valor' => 'Formulario de documentación en custodia', 'descripcion' => 'Formulario de documentación en custodia'],
            ['valor' => 'Formulario de prestamos internos ', 'descripcion' => 'Formulario de prestamos internos '],
            ['valor' => 'Formulario de supervisión', 'descripcion' => 'Formulario de supervisión'],
            ['valor' => 'Formulario de verificación contrato', 'descripcion' => 'Formulario de verificación contrato'],
            ['valor' => 'Formulario de verificación de documentación ', 'descripcion' => 'Formulario de verificación de documentación '],
            ['valor' => 'Formulario FRS', 'descripcion' => 'Formulario FRS'],
            ['valor' => 'Formulario Kiva', 'descripcion' => 'Formulario Kiva'],
            ['valor' => 'Formulario por Grupo Solidario', 'descripcion' => 'Formulario por Grupo Solidario'],
            ['valor' => 'Formulario Próvida', 'descripcion' => 'Formulario Próvida'],
            ['valor' => 'Historial crediticio', 'descripcion' => 'Historial crediticio'],
            ['valor' => 'Hoja de presentación de carpetas de crédito', 'descripcion' => 'Hoja de presentación de carpetas de crédito'],
            ['valor' => 'Importe cuantificado', 'descripcion' => 'Importe cuantificado'],
            ['valor' => 'Incumplimiento conyugues', 'descripcion' => 'Incumplimiento conyugues'],
            ['valor' => 'Incumplimiento en plazo y montos', 'descripcion' => 'Incumplimiento en plazo y montos'],
            ['valor' => 'Incumplimiento en tasas y cargos', 'descripcion' => 'Incumplimiento en tasas y cargos'],
            ['valor' => 'Incumplimiento Garantías', 'descripcion' => 'Incumplimiento Garantías'],
            ['valor' => 'Infocred o consulta masiva', 'descripcion' => 'Infocred o consulta masiva'],
            ['valor' => 'Informe de ciclo del B.E.', 'descripcion' => 'Informe de ciclo del B.E.'],
            ['valor' => 'Informe para montos >$us2500.-', 'descripcion' => 'Informe para montos >$us2500.-'],
            ['valor' => 'Investigación social', 'descripcion' => 'Investigación social'],
            ['valor' => 'Libro de actas', 'descripcion' => 'Libro de actas'],
            ['valor' => 'Nivel de endeudamiento', 'descripcion' => 'Nivel de endeudamiento'],
            ['valor' => 'Niveles de aprobación', 'descripcion' => 'Niveles de aprobación'],
            ['valor' => 'Nuevo', 'descripcion' => 'Nuevo'],
            ['valor' => 'Orden de desembolso', 'descripcion' => 'Orden de desembolso'],
            ['valor' => 'Plan de pagos', 'descripcion' => 'Plan de pagos'],
            ['valor' => 'Planilla de ahorro inicio', 'descripcion' => 'Planilla de ahorro inicio'],
            ['valor' => 'Planilla de asistencia', 'descripcion' => 'Planilla de asistencia'],
            ['valor' => 'Planilla de capacitación', 'descripcion' => 'Planilla de capacitación'],
            ['valor' => 'Planilla de recuperación', 'descripcion' => 'Planilla de recuperación'],
            ['valor' => 'Préstamo Interno ', 'descripcion' => 'Préstamo Interno '],
            ['valor' => 'Recibo de cobranza', 'descripcion' => 'Recibo de cobranza'],
            ['valor' => 'Reconocimiento de firmas', 'descripcion' => 'Reconocimiento de firmas'],
            ['valor' => 'Refinanciamiento de crédito', 'descripcion' => 'Refinanciamiento de crédito'],
            ['valor' => 'Resolución de Comité de crédito', 'descripcion' => 'Resolución de Comité de crédito'],
            ['valor' => 'Solicitud de préstamo', 'descripcion' => 'Solicitud de préstamo'],
            ['valor' => 'Solicitud de préstamo por B.E.', 'descripcion' => 'Solicitud de préstamo por B.E.'],
            ['valor' => 'Solicitud de préstamo por G.S.', 'descripcion' => 'Solicitud de préstamo por G.S.'],
            ['valor' => 'varones', 'descripcion' => 'varones'],
            ['valor' => 'Visita domiciliaria', 'descripcion' => 'Visita domiciliaria'],
        ]);
        ComboLugarVisita::insert([
            ['valor' => 'AGENCIA', 'descripcion' => 'AGENCIA'],
            ['valor' => 'DOMICILIO', 'descripcion' => 'DOMICILIO'],
            ['valor' => 'DOMICILIO Y NEGOCIO', 'descripcion' => 'DOMICILIO Y NEGOCIO'],
            ['valor' => 'NEGOCIO', 'descripcion' => 'NEGOCIO'],
            ['valor' => 'OTRO', 'descripcion' => 'OTRO'],
        ]);
        ComboRiesgo::insert([
            ['valor' => 'RA', 'descripcion' => 'RA'],
            ['valor' => 'CI', 'descripcion' => 'CI'],
        ]);
        ComboSucursal::insert([
            ['valor' => 'CBBA', 'descripcion' => 'CBBA'],
            ['valor' => 'LA PAZ', 'descripcion' => 'LA PAZ'],
            ['valor' => 'OF NACIONAL', 'descripcion' => 'OF NACIONAL'],
            ['valor' => 'SANTA CRUZ', 'descripcion' => 'SANTA CRUZ'],
        ]);
        ComboTipoInforme::insert([
            ['valor' => 'CA', 'descripcion' => 'CA'],
            ['valor' => 'CI', 'descripcion' => 'CI'],
        ]);
        ComboVisita::insert([
            ['valor' => 'CODEUDOR', 'descripcion' => 'CODEUDOR'],
            ['valor' => 'GARANTE', 'descripcion' => 'GARANTE'],
            ['valor' => 'NO', 'descripcion' => 'NO'],
            ['valor' => 'OTRO', 'descripcion' => 'OTRO'],
            ['valor' => 'TITULAR', 'descripcion' => 'TITULAR'],
        ]);
        // FIN
    }
}
