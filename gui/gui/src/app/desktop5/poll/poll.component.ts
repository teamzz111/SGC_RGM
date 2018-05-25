import { Pregunta } from './../pregunta';
import { UserServiceService } from '../.././user-service.service';
import { Component, OnInit } from '@angular/core';
declare var jquery: any;
import { FormsModule } from '@angular/forms';
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
  encuesta = false;
  id = [];
  objeto;
  constructor(private crudProducto: UserServiceService) {
    this.crudProducto.encuestas().map(response => response.json())
    .subscribe(data => {
          this.listado = data;
          this.datostabla = true;
          for (const item of data) {
            this.id.push(item.idEncuesta);
          }
        });
  }
  show(a) {
    this.objeto = new Pregunta(this.id[a]);
    this.crudProducto.traerEncuesta(JSON.stringify(this.objeto)).map(response => response.json())
      .subscribe(data => {
        this.listado = data;
        this.datostabla = false;
        this.encuesta = true;
        $('.main h1').text('Encuesta');
      });
  }
}
