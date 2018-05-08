import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '../../user-service.service'; // Importamos nuestro servicio
import 'rxjs/add/operator/map'; // Libreria para mapear los resultados a JSON

@Component({
  selector: 'app-userconfig',
  templateUrl: './userconfig.component.html',
  styleUrls: ['./userconfig.component.css']
})
export class UserconfigComponent {
  semidesk: number;

  constructor(private crudProducto: UserServiceService) {
    this.semidesk = 2;
  }

}
