import { Component, OnInit, Input } from '@angular/core';
import { Injectable } from '@angular/core';
import { UserServiceService } from './user-service.service'; // Importamos nuestro servicio
import 'rxjs/add/operator/map'; // Libreria para mapear los resultados a JSON
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent {
  @Input() title: string;
  version: string;
  nombre: string;
  cargo: string;
  desk: number;
  cmenu: number;
  cargos: string[];
  loggedin: number;
  url: string;
  listado;
  list;

  constructor(private crudProducto: UserServiceService) {
    this.title = 'SGC';
    this.version = '0.1(a)';
    this.desk = 3;
    this.cmenu = 0;
    this.loggedin = 0;
    this.url = 'http://localhost/SGC_RGM/login.html';
    this.cargos = ['Desarollador', 'Administrador', 'Coordinador', 'Líder de proceso', 'Usuario demo'];
    this.verifySession();
    this.crudProducto
    .listar() // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
    .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
    .subscribe(data => {
    this.listado = data; // Asignamos nuestros datos mapeados a una variable
    });
  }

  showDesk(number) {
    this.desk = number;
    if (this.cmenu === 1) {
      this.menu();
    }
  }

  menu() {
    if (this.cmenu === 0) {
      $('main .lat').animate({ minWidth: '12em', maxWidth: '12.1em' });
      $('main .lat a button i').fadeIn(1000);
      $('main .lat a button').animate({
        marginTop: '0.5%',
        marginBottom: '0.5%'
      });
      $('main .lat a button i').css('fontStyle', 'normal');
      $('main .lat a button span').addClass('left');
      $('main .der').animate({ marginLeft: '12em' });
      $('main .info').fadeIn(1000);
      this.cmenu = 1;
    } else {
      $('main .lat').animate({ minWidth: '3.1em', maxWidth: '3.2em' });
      $('main .lat a button i').css('display', 'none');
      $('main .lat a button').animate(
        { marginTop: '20%', marginBottom: '20%' },
        10
      );
      $('main .lat a button span').removeClass('left');
      $('main .der').animate({ marginLeft: '3.2em' });
      $('main .info').fadeOut(10);
      this.cmenu = 0;
    }
  }

  closeSession() {
    this.crudProducto.closeSession().map(response => response.json()).subscribe(data => {
      if (data === 'true') {
        location.href = 'index.html';
      }
    });
  }

  verifySession() {
    this.crudProducto.verify().map(response => response.json()).subscribe(data => {
      if (data === 'false' || data === 'Nothing') {
        location.href = this.url;
      }
    });

  }
}
