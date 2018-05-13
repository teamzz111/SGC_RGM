import { Encuesta } from './encuesta';
import { Component, OnInit } from '@angular/core';
declare var jquery: any;
declare var $: any;
import { UserServiceService } from '../.././user-service.service'; // Importamos nuestro servicio
import { Pregunta } from './pregunta';
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
  pregunuta;
  constructor(private crudProducto: UserServiceService) {
    this.next = 0;
    this.respuesta = 1;
    this.listo = false;
    this.numero = 1;
    this.pregunuta = new Pregunta();
  }

  guardarEncuesta() {
    this.name = new Encuesta($('#nombre').val(), $('#encuesta').val());
    // tslint:disable-next-line:max-line-length
    this.crudProducto.guardarEncuesta(JSON.stringify(this.name)).map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
      .subscribe(data => {
        alert(data);
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
      }
    }
  }
  obtenerTipo() {
    this.tipo = $('#tipo').prop('selectedIndex');
  }
  pregunta() {
    if (this.tipo === 0) {
      this.next = 1;
    } else {
      this.next = 3;
    }
    this.numero++;
  }
}
