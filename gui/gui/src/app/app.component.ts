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
  }

  showDesk(number) {
    this.desk = number;
  }

  menu() {
    if (this.cmenu === 0) {
      $('main .lat').css({'minWidth': '12em',
      'maxWidth': '12.1em'
      });
      $('main .lat a button i').fadeIn(1000);
      $('main .lat a button').css({'marginTop': '0.5%', 'marginBottom': '0.5%'});
      $('main .lat a button i').css('fontStyle', 'normal');
      $('main .lat a button span').addClass('left');
      $('main .der').css('marginLeft', '12em');
      this.cmenu = 1;
  } else {
    $('main .lat').css({'minWidth': '3.1em',
    'maxWidth': '3.2em'
    });
    $('main .lat a button i').fadeOut(700);
    $('main .lat a button').css({'marginTop': '20%', 'marginBottom': '20%'});
    $('main .lat a button span').removeClass('left');
    $('main .der').css('marginLeft', '3.2em');
      this.cmenu = 0;
    }
  }
}
