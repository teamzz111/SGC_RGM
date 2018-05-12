import { Encuesta } from './encuesta';
import { Component, OnInit } from '@angular/core';
declare var jquery: any;
declare var $: any;
import { UserServiceService } from '../.././user-service.service'; // Importamos nuestro servicio

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
  constructor(private crudProducto: UserServiceService) {
    this.next = 0;
    this.respuesta = 1;
    this.listo = false;
    this.numero = 1;
  }

  guardarEncuesta() {
    this.name = new Encuesta($('#nombre').val(), $('#encuesta').val());
    // tslint:disable-next-line:max-line-length
    this.crudProducto.guardarEncuesta(JSON.stringify(this.name)).map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
      .subscribe(data => {
        alert(data);
      });
  }


  obtenerTipo() {
    this.tipo = $('#tipo').prop('selectedIndex');
  }
  pregunta() {
    if (this.tipo === 0) {
      this.next = 1;
      this.numero++;
    } else {
      this.next = 3;
    }
  }
}
