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
  constructor() {
    this.next = 0;
    this.respuesta = 1;
    this.listo = false;
  }
  prueab() {
    this.tipo = $('#tipo').prop('selectedIndex');
    if (this.tipo === 1) {
      this.next = 2;
    }
  }
}
