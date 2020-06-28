<?php

use App\ComboRevision;
use App\ComboCalidad;
use App\Clasificaciones;
use App\ComboLugarVisita;
use App\Riesgo;
use App\Sucursales;
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
        Clasificaciones::insert([
            ['valor' => '% familiares'],
            ['valor' => '% varones'],
            ['valor' => 'Actividad económica'],
            ['valor' => 'Anexo 2 '],
            ['valor' => 'Asistencia menor al 70% de integrantes '],
            ['valor' => 'Bienes Incautados'],
            ['valor' => 'Boleta de caja'],
            ['valor' => 'Capacidad de pago'],
            ['valor' => 'Cedula de identidad'],
            ['valor' => 'Certificado de Gravamen'],
            ['valor' => 'Cierre de ciclo'],
            ['valor' => 'Clientes con edad fuera de políticas '],
            ['valor' => 'Clientes en otras Agencias'],
            ['valor' => 'Conciliación de cuentas'],
            ['valor' => 'conciliación del jefe de agencia '],
            ['valor' => 'Contrato de préstamo'],
            ['valor' => 'Créditos en dos Agencias Diferentes'],
            ['valor' => 'Croquis negocio y/o domicilio'],
            ['valor' => 'Declaración patrimonial'],
            ['valor' => 'Destino del crédito'],
            ['valor' => 'Distribución de utilidades y ahorros'],
            ['valor' => 'Documentación ilegible'],
            ['valor' => 'Duplicidad de actividad'],
            ['valor' => 'Envió de Información Kiva '],
            ['valor' => 'Estabilidad Domiciliaria '],
            ['valor' => 'Evaluación económica (hoja Excel)'],
            ['valor' => 'Evaluación económica (pre impreso)'],
            ['valor' => 'Factura de agua y/o luz'],
            ['valor' => 'familiares'],
            ['valor' => 'Ficha de datos'],
            ['valor' => 'Fondos en custodia'],
            ['valor' => 'Formulario  Kiva , exención y fotografía '],
            ['valor' => 'Formulario de declaración patrimonial'],
            ['valor' => 'Formulario de documentación en custodia'],
            ['valor' => 'Formulario de prestamos internos '],
            ['valor' => 'Formulario de supervisión'],
            ['valor' => 'Formulario de verificación contrato'],
            ['valor' => 'Formulario de verificación de documentación '],
            ['valor' => 'Formulario FRS'],
            ['valor' => 'Formulario Kiva'],
            ['valor' => 'Formulario por Grupo Solidario'],
            ['valor' => 'Formulario Próvida'],
            ['valor' => 'Historial crediticio'],
            ['valor' => 'Hoja de presentación de carpetas de crédito'],
            ['valor' => 'Importe cuantificado'],
            ['valor' => 'Incumplimiento conyugues'],
            ['valor' => 'Incumplimiento en plazo y montos'],
            ['valor' => 'Incumplimiento en tasas y cargos'],
            ['valor' => 'Incumplimiento Garantías'],
            ['valor' => 'Infocred o consulta masiva'],
            ['valor' => 'Informe de ciclo del B.E.'],
            ['valor' => 'Informe para montos >$us2500.-'],
            ['valor' => 'Investigación social'],
            ['valor' => 'Libro de actas'],
            ['valor' => 'Nivel de endeudamiento'],
            ['valor' => 'Niveles de aprobación'],
            ['valor' => 'Nuevo'],
            ['valor' => 'Orden de desembolso'],
            ['valor' => 'Plan de pagos'],
            ['valor' => 'Planilla de ahorro inicio'],
            ['valor' => 'Planilla de asistencia'],
            ['valor' => 'Planilla de capacitación'],
            ['valor' => 'Planilla de recuperación'],
            ['valor' => 'Préstamo Interno '],
            ['valor' => 'Recibo de cobranza'],
            ['valor' => 'Reconocimiento de firmas'],
            ['valor' => 'Refinanciamiento de crédito'],
            ['valor' => 'Resolución de Comité de crédito'],
            ['valor' => 'Solicitud de préstamo'],
            ['valor' => 'Solicitud de préstamo por B.E.'],
            ['valor' => 'Solicitud de préstamo por G.S.'],
            ['valor' => 'varones'],
            ['valor' => 'Visita domiciliaria'],
        ]);
        ComboLugarVisita::insert([
            ['valor' => 'AGENCIA', 'descripcion' => 'AGENCIA'],
            ['valor' => 'DOMICILIO', 'descripcion' => 'DOMICILIO'],
            ['valor' => 'DOMICILIO Y NEGOCIO', 'descripcion' => 'DOMICILIO Y NEGOCIO'],
            ['valor' => 'NEGOCIO', 'descripcion' => 'NEGOCIO'],
            ['valor' => 'OTRO', 'descripcion' => 'OTRO'],
        ]);
        Riesgo::insert([
            ['nombre' => 'RA', 'color' => '#ebf78f', 'ponderacion' => 0.3],
            ['nombre' => 'CI', 'color' => '#d73a4a', 'ponderacion' => 0.5],
        ]);
        Sucursales::insert([
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
