import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '../.././user-service.service';
import { Hero } from '../hero';
declare var jquery: any;
declare var $: any;
@Component({
  selector: 'app-updateuser',
  templateUrl: './updateuser.component.html',
  styleUrls: ['./updateuser.component.css']
})
export class UpdateuserComponent {
  visible: boolean;
  listado;
  listado2;
  listado3;
  hero;
  constructor(private crudProducto: UserServiceService) {
    this.visible = false;
   }
   busca2() {
    this.crudProducto.busca($('#cc').val()).map(response => response.json())
    .subscribe(data => {
      if (data === 'false') {
        $('.notifi').css({background: 'red'});
        $('.notifi').text('El usuario no existe');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
      } else {
        this.listado = data;
          this.crudProducto
            .registrar(1) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
            .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
            .subscribe(data2 => {
              this.listado2 = data2; // Asignamos nuestros datos mapeados a una variable
            });
          this.crudProducto
            .registrar(2) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
            .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
            .subscribe(data3 => {
              this.listado3 = data3; // Asignamos nuestros datos mapeados a una variable
            });
            this.visible = true;
          for (const item of data) {
          $('#cedula').val(item.cedula);
          $('#nombre').val(item.nombre);
          $('#apellido').val(item.apellido);
          $('#correo').val(item.email);
          $('#telefono').val(item.telefono);
          $('#direccion').val(item.direccion);
          $('#numero').val(item.numero);
          if (item.genero === 'm') {
            $('input:radio[name="gender"]')
              .filter('[value = "male"]')
              .prop('checked', true);
          } else if (item.genero === 'f') {
            $('input:radio[name="gender"]')
              .filter('[value = "female"]')
              .prop('checked', true);
          } else {
            $('input:radio[name="gender"]')
              .filter('[value = "other"]')
              .prop('checked', true);
          }
        }


      }
    });
   }
   busca() {
    this.crudProducto.busca($('#cc').val()).map(response => response.json())
    .subscribe(data => {
      if (data === 'false') {
        $('.notifi').css({background: 'red'});
        $('.notifi').text('No existe el usuario');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
      } else {
        this.listado = data;
          this.crudProducto
            .registrar(1) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
            .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
            .subscribe(data2 => {
              this.listado2 = data2; // Asignamos nuestros datos mapeados a una variable
            });
          this.crudProducto
            .registrar(2) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
            .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
            .subscribe(data3 => {
              this.listado3 = data3; // Asignamos nuestros datos mapeados a una variable
            });
            this.visible = true;
          for (const item of data) {
          $('#cedula').val(item.cedula);
          $('#nombre').val(item.nombre);
          $('#apellido').val(item.apellido);
          $('#correo').val(item.email);
          $('#telefono').val(item.telefono);
          $('#direccion').val(item.direccion);
          $('#numero').val(item.numero);
          if (item.genero === 'm') {
            $('input:radio[name="gender"]')
              .filter('[value = "male"]')
              .prop('checked', true);
          } else if (item.genero === 'f') {
            $('input:radio[name="gender"]')
              .filter('[value = "female"]')
              .prop('checked', true);
          } else {
            $('input:radio[name="gender"]')
              .filter('[value = "other"]')
              .prop('checked', true);
          }
        }
        this.busca2();

      }
    });
   }

   updatea() {
    this.hero = new Hero($('#cedula').val(), $('#nombre').val(), $('#apellido').val(), $('#telefono').val()
    , $('#correo').val(), $('#direccion').val(), $('#numero').val(), $('input:radio[name=gender]:checked').val(),
    $('#listado :selected').text(), $('#listado2 :selected').text());
    this.crudProducto.busca(this.hero).map(response => response.json())
    .subscribe(data => {
    });
   }


}
