import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '../.././user-service.service'; // Importamos nuestro servicio
import 'rxjs/add/operator/map';
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
    this.crudProducto.insertar($('form cedula').val());
   }

}
