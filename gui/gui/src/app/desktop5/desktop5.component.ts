import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '../user-service.service'; // Importamos nuestro servicio


@Component({
  selector: 'app-desktop5',
  templateUrl: './desktop5.component.html',
  styleUrls: ['./desktop5.component.css']
})
export class Desktop5Component {
  listado;
  semidesk;

  constructor(private crudProducto: UserServiceService) {
    /*this.crudProducto
    .listar(1) // Llamamos a la funcion <strong>listar</strong> de nuestro servicio
    .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
    .subscribe(data => {
    this.listado = data; // Asignamos nuestros datos mapeados a una variable
    });*/
    this.semidesk = 2;
  }

  closeSession() {
    this.crudProducto.closeSession().map(response => response.json()).subscribe(data => {
      if (data === 'true') {
        location.href = '../../../index.html';
      }
    });
  }
}
