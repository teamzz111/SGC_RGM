import { UserServiceService } from './../../user-service.service';
import { Component, OnInit  } from '@angular/core';
declare var jquery: any;
declare var $: any;
import 'rxjs/add/operator/map';
@Component({
  selector: 'app-stati',
  templateUrl: './stati.component.html',
  styleUrls: ['./stati.component.css']
})
export class StatiComponent implements OnInit{
  public idEncuesta = [];
  public porcentajes = [];
  public listado;
  public max: number;
  constructor(private crudProducto: UserServiceService) {
    this.max = 0;
  }
  ready() {
      $('.test-circle').circliful({
        animationStep: 5,
        foregroundBorderWidth: 14,
        backgroundBorderWidth: 14,
        foregroundColor: 'white',
        fontColor: 'white',
        fontFamily: 'Roboto',
      });
      this.max = 0;
    }
  ngOnInit() {
    this.crudProducto.verConteoEncuesta()
    .map(response => response.json())
    .subscribe(data => {
      this.listado = data;
      for (const i of this.listado) {
        this.idEncuesta.push(i.idEncuesta);
        this.max++;
        let percent = (i.Respondido * 100) / (i.Faltantes);
        this.porcentajes.push(percent);
      }
    });

  }

  

}
