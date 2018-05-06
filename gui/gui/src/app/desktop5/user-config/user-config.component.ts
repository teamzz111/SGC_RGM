import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '../../user-service.service'; // Importamos nuestro servicio
import 'rxjs/add/operator/map'; // Libreria para mapear los resultados a JSON

@Component({
  selector: 'app-user-config',
  templateUrl: './user-config.component.html',
  styleUrls: ['./user-config.component.css']
})
export class UserConfigComponent {
  semidesk: number;

  constructor(private crudProducto: UserServiceService) {
    this.semidesk = 2;
  }
}
