<template>
  <panel :name="__('Progreso')" class="panel-secondary">
    <template slot="header">
      <title-bar />
      <i class="fas fa-spinner"></i>
      {{ __('Progreso') }}
    </template>
    <template slot="actions">
      <nav-bar />
    </template>
    <gantt-elastic :tasks="tasks" :options="options" :dynamic-style="dynamicStyle"></gantt-elastic>
  </panel>
</template>

<script>
import GanttElastic from "gantt-elastic";
import Header from "gantt-elastic-header";
function getDate(hours) {
  const currentDate = new Date();
  const currentYear = currentDate.getFullYear();
  const currentMonth = currentDate.getMonth();
  const currentDay = currentDate.getDate();
  const timeStamp = new Date(
    currentYear,
    currentMonth,
    currentDay,
    0,
    0,
    0
  ).getTime();
  return new Date(timeStamp + hours * 60 * 60 * 1000).getTime();
}
export default {
  name: "Gantt",
  path: "/tareas/progreso",
  components: { "gantt-elastic": GanttElastic },
  mixins: [window.ResourceMixin],
  data() {
    return {
      ganttData: [],
      api: this.$api.tareas,
      dynamicStyle: {
        "task-list-header-label": {
          "font-weight": "bold"
        }
      },
      destroy: false,
      options: {
        maxRows: 100,
        maxHeight: "100%",
        title: {
          label: "Your project title as html (link or whatever...)",
          html: false
        },
        row: {
          height: 24
        },
        calendar: {
          hour: {
            display: false
          }
        },
        chart: {
          progress: {
            bar: false
          },
          expander: {
            display: true
          }
        },
        taskList: {
          expander: {
            straight: false
          },
          columns: [
            {
              id: 1,
              label: "ID",
              value: "id",
              width: 40
            },
            {
              id: 3,
              label: "Asignado a",
              value: "user",
              width: 100,
              expander: true,
              html: true
            },
            {
              id: 2,
              label: "Tarea",
              value: "tarea",
              width: 100,
              html: true,
              events: {
                click({ data, column }) {
                  alert("description clicked!\n" + data.label);
                }
              }
            },
            {
              id: 3,
              label: "Fecha",
              value: task => moment(task.start).format("YYYY-MM-DD"),
              width: 78
            },
            {
              id: 4,
              label: "Vencimiento",
              value: "vencimiento",
              width: 130
            },
            {
              id: 4,
              label: "Tipo",
              value: "type",
              width: 68
            }
          ]
        },
        locale: {
          code: "es",
          name: "es", // name String
          weekdays: "Domingo Lunes Martes Miercoles Jueves Viernes Sabado".split(
            " "
          ), // weekdays Array
          weekdaysShort: "Dom Lun Mar Mie Jue Vie Sab".split(" "), // OPTIONAL, short weekdays Array, use first three letters if not provided
          weekdaysMin: "Do Lu Ma Mi Ju Vi Sa".split(" "), // OPTIONAL, min weekdays Array, use first two letters if not provided
          months: "Enero Febrero Marzo Abril Mayo Junio Julio Agosto Septiembre Octubre Noviembre Diciembre".split(
            " "
          ), // months Array
          monthsShort: "Ene Feb Mar Abr May Jun Jul Ago Sep Oct Nov Dic".split(
            " "
          ), // OPTIONAL, short months Array, use first three letters if not provided
          ordinal: n => `${n}`, // ordinal Function (number) => return number + output
          relativeTime: {
            // relative time format strings, keep %s %d as the same
            future: "za %s", // e.g. in 2 hours, %s been replaced with 2hours
            past: "%s temu",
            s: "kilka sekund",
            m: "minutę",
            mm: "%d minut",
            h: "godzinę",
            hh: "%d godzin", // e.g. 2 hours, %d been replaced with 2
            d: "dzień",
            dd: "%d dni",
            M: "miesiąc",
            MM: "%d miesięcy",
            y: "rok",
            yy: "%d lat"
          }
        }
      }
    };
  },
  mounted() {
    this.$api.tarea.call(null, "datosGantt", {}).then(response => {
      this.ganttData = response;
    });
  },
  computed: {
    tasks() {
      const array = [];
      var collapsed = false;
      var type = "milestone";
      var parent = null;
      var usuario = "";
      var i = 0;
      this.ganttData.forEach((item, indice) => {
        if (usuario == item.usuario) {
          collapsed = true;
          type = "project";
          parent = i;
        } else {
          collapsed = false;
          type = "milestone";
          parent = null;
          i = indice + 1;
        }
        array.push({
          id: indice + 1,
          user: item.usuario,
          tarea: item.nombre,
          parentId: parent,
          start: item.fecha,
          duration:
            ((new Date(item.vencimiento).getTime() -
              new Date(item.fecha).getTime()) /
              (1000 * 60 * 60 * 24)) *
            24 *
            60 *
            60 *
            1000,
          progress: 0,
          vencimiento:
            new Date(item.vencimiento).getFullYear() +
            "-" +
            new Date(item.vencimiento).getMonth() +
            "-" +
            new Date(item.vencimiento).getDate(),
          type: type,
          collapsed: collapsed,
          style: {
            base: {
              fill: "#1EBC61",
              stroke: "#0EAC51"
            },
            "tree-row-bar": {
              fill: "#1EBC61",
              stroke: "#0EAC51"
            },
            "tree-row-bar-polygon": {
              stroke: "#0EAC51"
            }
          }
        });
        usuario = item.usuario;
      });
      return array;
    }
  }
};
</script>
<style scoped>
</style>