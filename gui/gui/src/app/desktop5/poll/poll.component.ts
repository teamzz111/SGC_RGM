import { UserServiceService } from '../.././user-service.service';
import { Component, OnInit } from '@angular/core';
declare var jquery: any;
declare var $: any;
import 'rxjs/add/operator/map'; // Libreria para mapear los resultados a JSON

@Component({
  selector: 'app-poll',
  templateUrl: './poll.component.html',
  styleUrls: ['./poll.component.css']
})
export class PollComponent {
  listado;
  datostabla;
  constructor(private crudProducto: UserServiceService) {
    this.crudProducto.encuestas().map(response => response.json())
    .subscribe(data => {
          this.listado = data;
          this.datostabla = true;
        });
      }
}
