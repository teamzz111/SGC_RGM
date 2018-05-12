import { Component, OnInit } from '@angular/core';
declare var jquery: any;
declare var $: any;
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
  constructor() {
    this.next = 0;
    this.respuesta = 1;
    this.listo = false;
    this.numero = 1;
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
