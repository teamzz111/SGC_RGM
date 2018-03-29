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
  cmenu: number;

  constructor() {
    this.title = 'SGC';
    this.version = '0.1(a)';
    this.nombre = 'Andrés Felipe Largo Rodríguez';
    this.cargo = 'GERENTE GENERAL';
    this.desk = 0;
    this.cmenu = 0;
    $('main .lat').animate({'minWidth': '3.1em', 'maWidth': '3.2em'});
  }

  showDesk(number) {
    this.desk = number;
    if (this.cmenu === 1) {
      this.menu();
    }
  }

  menu() {
    if (this.cmenu === 0) {
      $('main .lat').animate({'minWidth': '12em', 'maxWidth': '12.1em'});
      $('main .lat a button i').fadeIn(1000);
      $('main .lat a button').animate({'marginTop': '0.5%', 'marginBottom': '0.5%'});
      $('main .lat a button i').css('fontStyle', 'normal');
      $('main .lat a button span').addClass('left');
      $('main .der').animate({'marginLeft': '12em'});
      $('main .info').fadeIn(1000);
      this.cmenu = 1;
  } else {
      $('main .lat').animate({'minWidth': '3.1em', 'maxWidth': '3.2em'});
      $('main .lat a button i').css('display', 'none');
      $('main .lat a button').animate({'marginTop': '20%', 'marginBottom': '20%'}, 10);
      $('main .lat a button span').removeClass('left');
      $('main .der').animate({'marginLeft': '3.2em'});
      $('main .info').fadeOut(10);
        this.cmenu = 0;
    }
  }
}
