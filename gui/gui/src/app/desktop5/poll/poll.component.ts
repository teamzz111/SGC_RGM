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
  clean() {
    this.r1 = 'nulll';
    this.r2  = 'nulll';
    this.r3 = 'nulll';
    this.r4 = 'nulll';
    this.r5 = 'nulll';
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
    this.clean();
    for (let i = 0; i < this.respuesta.length; i++) {
      if (this.numero[i] === 'tp3') {
         if ($('input:radio[name=' + this.respuesta[i] + ']:checked').val() === 'undefined') {
            this.error('Complete los campos');
            break;
         } else {
           this.r1 = $('input:radio[name=' + this.respuesta[i] + ']:checked').val();
           this.r2 = 'nulll';
           this.r3 = 'nulll';
           this.r4 = 'nulll';
           this.r5 = 'nulll';
         }
      } else if (this.numero[i] === 'tp1') {
        if ($('#' + this.respuesta[i]).val() === '') {
          this.error('Complete campos');
          break;
        } else {
          this.r1 = $('#' + this.respuesta[i]).val();
          this.r2 = 'nulll';
          this.r3 = 'nulll';
          this.r4 = 'nulll';
          this.r5 = 'nulll';
        }
      } else {
         if ($('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=1]').prop('checked') === 'undefined' || 
        $('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=1]').prop('checked') === 'false'  ) {
          this.r1 = 'nulll';
         } else {
           this.r1 = $('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=2]').prop('checked');
         }
        if ($('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=2]').prop('checked') === 'undefined' ||
          $('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=2]').prop('checked') === 'false') {
          this.r2 = 'nulll';
        } else {
          this.r2 = $('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=2]').prop('checked');
        }
        if ($('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=3]').prop('checked') === 'undefined' ||
          $('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=3]').prop('checked') === 'false') {
          this.r3 = 'nulll';
        } else {
          this.r3 = $('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=3]').prop('checked');
        }
        if ($('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=4]').prop('checked') === 'undefined' ||
          $('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=4]').prop('checked') === 'false') {
          this.r4 = 'nulll';
        } else {
          this.r4 = $('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=4]').prop('checked');
        }
        if ($('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=5]').prop('checked') === 'undefined' ||
          $('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=5]').prop('checked') === 'false') {
          this.r5 = 'nulll';
        } else {
          this.r5 = $('.tp2 .' + this.respuesta[i] + ' input:checkbox[name=5]').prop('checked');
        }
      }
      const asd = new Respuesta(this.respuesta[i], this.r1, this.r2, this.r3, this.r4, this.r5 );
      alert(JSON.stringify(asd));
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
