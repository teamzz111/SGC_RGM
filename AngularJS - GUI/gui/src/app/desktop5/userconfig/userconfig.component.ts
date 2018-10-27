import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '../../user-service.service'; // Importamos nuestro servicio
import 'rxjs/add/operator/map'; // Libreria para mapear los resultados a JSON
import { Hero } from '../../desktop3/hero';
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-userconfig',
  templateUrl: './userconfig.component.html',
  styleUrls: ['./userconfig.component.css']
})
export class UserconfigComponent {
  semidesk: number;
  cadena: string;
  listado;
  data;
  visible: boolean;
  listado2;
  listado3;
  hero;
  cargo: string;
  seccional: string;
  check: boolean;
  check2: boolean;
  cedula;
  constructor(private crudProducto: UserServiceService) {
    this.busca();
    this.visible = true;
  }

   busca() {
    this.crudProducto.busca2().map(response => response.json())
    .subscribe(data => {
      if (data === 'nel') {
       $('.notifi').css({background: 'red'});
        $('.notifi').text('El usuario no existe');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
      } else if (data === 'errorquery') {
       $('.notifi').css({background: 'red'});
        $('.notifi').text('Contacte al desarollador');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
      } else {
          this.visible = true;
          for (const item of data) {
         // $('#cedula').text(item.cedula);
         this.cedula = item.cedula;
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
   updatea() {
    this.hero = new Hero(this.cedula, $('#nombre').val(), $('#apellido').val(), $('#telefono').val()
    , $('#correo').val(), $('#direccion').val(), $('#numero').val(), $('input:radio[name=gender]:checked').val(),
    $('#listado :selected').text(), $('#listado2 :selected').text());
    this.crudProducto.actualiza(this.hero).map(response => response.json())
    .subscribe(data => {
      if (data === 'false') {
        $('.notifi').css({background: 'red'});
        $('.notifi').text('Ocurrió una tragedia');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000);
        } , 5000);
        });
      } else if (data === 'true') {
        $('.notifi').css({background: 'rgb(14, 194, 14)'});
        $('.notifi').text('Actualización exitosa');
        this.visible = false;
        $('.notifi').animate({marginTop: '3em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000);
         } , 5000);
        });
      }
    });
   }

}
