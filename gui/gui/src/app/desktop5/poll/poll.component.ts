import { Respuesta } from './respuesta';
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
  r1;
  r2;
  r3;
  r4;
  r5;
  objeto;
  temporal;
  last;
  index: number;
  process: boolean;
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
        this.process = false;

  }
  clean() {
    this.r1 = 'false';
    this.r2  = 'false';
    this.r3 = 'false';
    this.r4 = 'false';
    this.r5 = 'false';
    this.last = 'false';
   }
  show(a) {
    this.objeto = new Pregunta(this.id[a]);
    this.temporal = this.id[a];
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
    if (!this.process) {
      this.process = true;
      for (let i = 0; i < this.respuesta.length; i++) {
        this.clean();
        if (this.numero[i] === 'tp3') {
          if ($('input:radio[name=' + this.respuesta[i] + ']:checked').val() === undefined) {
              this.error('Complete los campos');
              break;
          } else {
            this.r1 = $('input:radio[name=' + this.respuesta[i] + ']:checked').val();
          }
        } else if (this.numero[i] === 'tp1') {
          if ($('#' + this.respuesta[i]).val() === '') {
            this.error('Complete campos');
            break;
          } else {
            this.r1 = $('#' + this.respuesta[i]).val();
          }
        } else {
          if ($('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=1]').prop('checked') ) {
            this.r1 = 'true';
          } else {
            this.r1 = 'false';
          }
          if ($('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=2]').prop('checked')) {
            this.r2 = 'true';
          } else {
            this.r2 = 'false';
          }
          if ($('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=3]').prop('checked')) {
            this.r3 = 'true';
          } else {
            this.r3 = 'false';
          }
          if ($('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=4]').prop('checked')) {
            this.r4 = 'true';
          } else {
            this.r4 = 'false';
          }

          if ($('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=5]').prop('checked')) {
            this.r5 = 'true';
          } else {
            this.r5 = 'false';
          }
        }
        if (this.respuesta.length - 1 === i ) {
          this.last = 'true';
        }
        const asd = new Respuesta(this.temporal, this.r1, this.r2, this.r3, this.r4, this.r5, this.last);
        console.log(JSON.stringify(asd));
        this.crudProducto.guardarPreguntas(JSON.stringify(asd)).map(response => response.json())
          .subscribe(data => {
            if (data === 'false') {
              $('.notifi').css({ background: 'red' });
              $('.notifi').text('Ocurrió una tragedia');
              $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
                setTimeout(function () {
                  $('.notifi').animate({ marginTop: '-10em' }, 1000);
                }, 5000);
              });
            } else if (data === 'true' && this.last) {
              $('.notifi').css({ background: 'rgb(14, 194, 14)' });
              $('.notifi').text('¡Gracias por tus respuestas!');
              this.encuesta = false;
              this.crudProducto.encuestas().map(response => response.json())
                .subscribe(data2 => {
                  this.listado = data2;
                  this.process = false;
                  this.datostabla = true;
                  for (const item of data2) {
                    this.id.push(item.idEncuesta);
                  }
                });
              $('.notifi').animate({ marginTop: '3em' }, 1000, function () {
                setTimeout(function () {
                  $('.notifi').animate({ marginTop: '-10em' }, 1000);
                }, 5000);
              });
            }
          });
      }
    }
  }
  error(data) {
    $('.notifi').css({ background: 'red' });
    $('.notifi').text(data);
    $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
      setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
    });
  }
}
