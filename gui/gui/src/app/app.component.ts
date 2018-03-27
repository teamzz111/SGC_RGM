import { Component } from '@angular/core';
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title: string;
  version: string;
  nombre: string;
  cargo: string;
  desk: number;

  constructor() {
    this.title = 'SGC';
    this.version = '0.1(a)';
    this.nombre = 'Andrés Felipe Largo Rodríguez';
    this.cargo = 'GERENTE GENERAL';
    this.desk = 0;
  }

  showDesk(number) {
    this.desk = number;
  }
}
