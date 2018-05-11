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
  constructor() {
    this.next = 0;
  }
  prueab() {
  this.tipo = $('#tipo').prop('selectedIndex');  }
}
