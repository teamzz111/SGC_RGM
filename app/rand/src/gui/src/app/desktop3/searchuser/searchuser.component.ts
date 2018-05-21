import { Component, OnInit, Input } from '@angular/core';
import { UserServiceService } from '../.././user-service.service'; // Importamos nuestro servicio
import 'rxjs/add/operator/map';
import { Http } from '@angular/http';
import { HttpModule } from '@angular/http';
declare var jquery: any;
declare var $: any;
@Component({
  selector: 'app-searchuser',
  templateUrl: './searchuser.component.html',
  styleUrls: ['./searchuser.component.css']
})
export class SearchuserComponent  {
  listado;
  data;
  cadena: string;
  cadena2: string;
  datostabla;
  constructor(private crudProducto: UserServiceService) {
          this.datostabla = 0;
  }
  test(event: any) {
    this.datostabla = 0;
    this.cadena = '';
    if ( $('input:checkbox[name=usersn]:checked').val() === 'on') {
        this.cadena += '1';
      } else {
        this.cadena += '0';
      }
    if ( $('input:checkbox[name=empleados]:checked').val() === 'on') {
        this.cadena += '1';
      } else {
        this.cadena += '0';
      }
    if ( $('input:checkbox[name=administradr]:checked').val() === 'on') {
        this.cadena += '1';
      } else {
        this.cadena += '0';
      }
    if ( $('input:checkbox[name=lider]:checked').val() === 'on') {
        this.cadena += '1';
      } else {
        this.cadena += '0';
      }
      if ( $('#nombreU').val() === '') {
        if (this.cadena === '0000') {
        this.crudProducto
          .listar(2) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
          .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
          .subscribe(data => {
            this.listado = data; // Asignamos nuestros datos mapeados a una variable
          });
          this.datostabla = 1;
        } else {
        this.crudProducto
          .buscar(0, this.cadena) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
          .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
          .subscribe(data => {
            if (data === 'error') {
        $('.notifi').css({background: 'red'});
        $('.notifi').text('Usuario no existente');
        $('.notifi').animate({marginTop: '3em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
            } else {
              this.listado = data;
              this.datostabla = 1;
            }
          });
        }
      } else {
        this.crudProducto
          .buscar(1, $('#nombreU').val()) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
          .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
          .subscribe(data => {
            if (data === 'error') {
       $('.notifi').css({background: 'red'});
        $('.notifi').text('Usuario no existente');
        $('.notifi').animate({marginTop: '3em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
            } else {
              this.listado = data;
              this.datostabla = 1;
            }
          });
      }
  }

}
