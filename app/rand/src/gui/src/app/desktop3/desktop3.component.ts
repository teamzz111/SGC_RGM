import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '.././user-service.service'; // Importamos nuestro servicio
import 'rxjs/add/operator/map'; // Libreria para mapear los resultados a JSON

@Component({
  selector: 'app-desktop3',
  templateUrl: './desktop3.component.html',
  styleUrls: ['./desktop3.component.css']
})
export class Desktop3Component  {
  nombre: string;
  semidesk: number;
  cargo: number;
  constructor(private crudProducto: UserServiceService) {
         this.nombre = 'Andrés Largo';
         this.semidesk = 5;
            this.crudProducto.obtenerPermisos()// Llamamos a la funcion <strong>listar</strong> de nuestro servicio
      .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
      .subscribe(data => {
        this.cargo = data; // Asignamos nuestros datos mapeados a una variable
      });
  }


}
