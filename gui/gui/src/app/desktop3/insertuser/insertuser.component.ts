import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '../.././user-service.service'; // Importamos nuestro servicio
import 'rxjs/add/operator/map';
@Component({
  selector: 'app-insertuser',
  templateUrl: './insertuser.component.html',
  styleUrls: ['./insertuser.component.css']
})
export class InsertuserComponent {
  listado;
  constructor(private crudProducto: UserServiceService) {
    this.crudProducto
    .registrar(1) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
    .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
    .subscribe(data => {
    this.listado = data; // Asignamos nuestros datos mapeados a una variable
    });
   }


}
