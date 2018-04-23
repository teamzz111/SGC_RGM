import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '../.././user-service.service'; // Importamos nuestro servicio
import 'rxjs/add/operator/map';
import { Hero } from '../hero';
declare var jquery: any;
declare var $: any;
@Component({
  selector: 'app-insertuser',
  templateUrl: './insertuser.component.html',
  styleUrls: ['./insertuser.component.css']
})
export class InsertuserComponent {
  listado;
  listado2;
  hero;
  constructor(private crudProducto: UserServiceService) {
    this.crudProducto
    .registrar(1) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
    .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
    .subscribe(data => {
    this.listado = data; // Asignamos nuestros datos mapeados a una variable
    });
    this.crudProducto
    .registrar(2) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
    .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
    .subscribe(data => {
    this.listado2 = data; // Asignamos nuestros datos mapeados a una variable
    });
   }
   send() {
      this.hero = new Hero($('#cedula').val(), $('#nombre').val(), $('#apellido').val(), $('#telefono').val()
      , $('#correo').val(), $('#direccion').val(), $('#numero').val(), $('input:radio[name=gender]:checked').val(),
      $('#listado :selected').text(), $('#listado2 :selected').text());
      this.crudProducto.insertar(this.hero)
      .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
      .subscribe(data => {
      if (data === 'true' || data === 'true2') {
        $('.notifi').css({background: 'rgb(14,194,14)'});
        $('.notifi').text('Se añadió el usuario');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
      } else if (data === 'false' || data === '0' || data === 'false2') {
        $('.notifi').css({background: 'red'});
        $('.notifi').text('Se encontró un error');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
      } else if (data === 'nel') {
        $('.notifi').css({background: 'red'});
        $('.notifi').text('Usuario existente');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
      }
    });
   }

}
