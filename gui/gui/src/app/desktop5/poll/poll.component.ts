import { Pregunta } from './../pregunta';
import { UserServiceService } from '../.././user-service.service';
import { Component, OnInit } from '@angular/core';
declare var jquery: any;
declare var $: any;
import { FormsModule } from '@angular/forms';
import 'rxjs/add/operator/map'; // Libreria para mapear los resultados a JSON

@Component({
  selector: 'app-poll',
  templateUrl: './poll.component.html',
  styleUrls: ['./poll.component.css']
})
export class PollComponent {
  listado;
  datostabla;
  encuesta = false;
  id = [];
  respuesta = [];
  numero = [];

  objeto;
  index: number;
  constructor(private crudProducto: UserServiceService) {
    this.crudProducto.encuestas().map(response => response.json())
    .subscribe(data => {
          this.listado = data;
          this.datostabla = true;
          for (const item of data) {
            this.id.push(item.idEncuesta);
          }
        });
        this.index = 0;

  }
  show(a) {
    this.objeto = new Pregunta(this.id[a]);
    this.crudProducto.traerEncuesta(JSON.stringify(this.objeto)).map(response => response.json())
      .subscribe(data => {
        this.listado = data;
        this.datostabla = false;
        this.encuesta = true;

        $('.main h1').text('Encuesta');
        for (const p of data) {
              this.index++;
              this.respuesta.push(p.idPregunta);
              this.numero.push(p.TipoPregunta);
        }
       /* for (let i = 0; i < this.respuesta.length; i++) {
          alert(this.respuesta[i] + '   ' + this.numero[i]);
        }*/
      });
  }
  enviarRespuesta() {
    for (let i = 0; i < this.respuesta.length; i++) {
      if (this.numero[i] === 'tp3') {
         alert('RADIO: ' + $('input:radio[name=' + this.respuesta[i] + ']:checked').val());
      } else if (this.numero[i] === 'tp1') {
        alert('ABIERTA: ' + $('#' + this.respuesta[i]).val());
      } else {
        for (let a = 1; a < 6; a++) {
         alert(a + 'CHECKBOX: ' + $('.tp2 .' + this.respuesta[0] + ' input:checkbox[name=' + a + ']').prop('checked'));
        }
      }
    }
  }
}
