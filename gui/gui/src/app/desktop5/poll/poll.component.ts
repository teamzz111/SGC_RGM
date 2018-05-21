import { UserServiceService } from './../../../../../../app/rand/src/gui/src/app/user-service.service';
import { Component, OnInit } from '@angular/core';
declare var jquery: any;
declare var $: any;
import 'rxjs/add/operator/map'; // Libreria para mapear los resultados a JSON

@Component({
  selector: 'app-poll',
  templateUrl: './poll.component.html',
  styleUrls: ['./poll.component.css']
})
export class PollComponent implements OnInit {

  constructor(private crudProducto: UserServiceService) { }

  ngOnInit() {
  }

}
