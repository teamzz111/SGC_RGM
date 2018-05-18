import { Encuesta } from './encuesta';
import { Component, OnInit } from '@angular/core';
declare var jquery: any;
declare var $: any;
import { UserServiceService } from '../.././user-service.service'; // Importamos nuestro servicio
import { Pregunta } from './pregunta';
import 'rxjs/add/operator/map';
@Component({
  selector: 'app-insertpoll',
  templateUrl: './insertpoll.component.html',
  styleUrls: ['./insertpoll.component.css']
})
export class InsertpollComponent {
  next: number;
  tipo: number;
  respuesta: number;
  listo: boolean;
  numero: number;
  name;
  preparado: boolean;
  pregunuta;
  constructor(private crudProducto: UserServiceService) {
    this.next = 0;
    this.respuesta = 1;
    this.listo = false;
    this.numero = 1;
    this.pregunuta = new Pregunta();
    this.pregunuta.clean();
    this.preparado = false;
  }

  guardarEncuesta() {
    this.name = new Encuesta($('#nombre').val(), $('#encuesta').val());
    // tslint:disable-next-line:max-line-length
    this.crudProducto.guardarEncuesta(JSON.stringify(this.name)).map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
      .subscribe(data => {
          if (data === 'true' || data === 'true2') {
            $('.notifi').css({ background: 'rgb(14,194,14)' });
            $('.notifi').text('Se añadió la encuesta');
            $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
              setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
            });
          } else if (data === 'false' || data === '0' || data === 'false2') {
            $('.notifi').css({ background: 'red' });
            $('.notifi').text('Se encontró un error');
            $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
              setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
            });
          } else {
            $('.notifi').css({ background: 'red' });
            $('.notifi').text('Error inesperado');
            $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
              setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
            });
          }
      });
  }

  guardarTPregunta() {
    this.pregunuta.setTPregunta($('#tipo').val());
  }
  guardarPregunta() {
    this.pregunuta.setPregunta($('#Pregunta').val());
  }
  guardarRespuesta(data) {
    switch (data) {
      case 1: {
        this.pregunuta.setR1($('#respuesta').val());
        break;
      }
      case 2: {
        this.pregunuta.setR2($('#respuesta').val());
        break;
      }
      case 3: {
        this.pregunuta.setR3($('#respuesta').val());
        break;
      }
      case 4: {
        this.pregunuta.setR4($('#respuesta').val());
        break;
      }
      case 5: {
        this.pregunuta.setR5($('#respuesta').val());
        break;
      }
      case 6: {
        if ($('#respuesta').val() === '') {
          this.respuesta--;
        }
        this.pregunuta.setnrespuesta(this.respuesta);
        this.crudProducto.guardarPregunta(JSON.stringify(this.pregunuta)).
        map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
        .subscribe(data2 => {
          if (data2 === 'true' || data2 === 'true2') {
            $('.notifi').css({ background: 'rgb(14,194,14)' });
            $('.notifi').text('Se añadió la pregunta');
            $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
              setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
            });
          } else if (data2 === 'false' || data2 === '0' || data2 === 'false2') {
            $('.notifi').css({ background: 'red' });
            $('.notifi').text('Se encontró un error');
            $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
              setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
            });
          } else {
            $('.notifi').css({ background: 'red' });
            $('.notifi').text('Error inesperado');
            $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
              setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
            });
          }
         });
        this.preparado = true;
        this.pregunuta.clean();
        this.next = 1;
        this.listo = false;
        this.respuesta = 1;
        this.numero = 1;
        break;
      }
    }
  }
  obtenerTipo() {
    this.tipo = $('#tipo').prop('selectedIndex');
  }
  pregunta() {
    if (this.tipo === 0) {
      this.pregunuta.setnrespuesta(0);
      this.crudProducto.guardarPregunta(JSON.stringify(this.pregunuta)).
        map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
        .subscribe(data2 => {
          if (data2 === 'true' || data2 === 'true2') {
            $('.notifi').css({ background: 'rgb(14,194,14)' });
            $('.notifi').text('Se añadió la pregunta de la encuesta');
            $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
              setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
            });
          } else if (data2 === 'false' || data2 === '0' || data2 === 'false2') {
            $('.notifi').css({ background: 'red' });
            $('.notifi').text('Se encontró un error');
            $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
              setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
            });
          } else {
            $('.notifi').css({ background: 'red' });
            $('.notifi').text('Pregunta existente');
            $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
              setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
            });
          }
      });
      this.pregunuta.clean();
      this.next = 1;
    } else {
      this.next = 3;
    }
    this.numero++;
  }
}
