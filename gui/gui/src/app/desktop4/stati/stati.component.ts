import { UserServiceService } from './../../user-service.service';
import { Component, OnInit  } from '@angular/core';
import {Chart} from 'chart.js';
declare var jquery: any;
declare var $: any;
import 'rxjs/add/operator/map';
@Component({
  selector: 'app-stati',
  templateUrl: './stati.component.html',
  styleUrls: ['./stati.component.css']
})
export class StatiComponent implements OnInit {
  public idEncuesta = [];
  public porcentajes = [];
  public listado;
  public max: number;
  public lugar = true;
  public gra = false;
  public encuesta;
  constructor(private crudProducto: UserServiceService) {
    this.max = 0;
  }
  go(index) {
    this.lugar = true;
    this.encuesta = this.idEncuesta[index];
  }

  loadGraphics() {
    if (!this.gra) {
      this.gra = true;
      $('#inservible').remove();
      const myChart = new Chart($('#myChart')[0].getContext('2d'), {
        type: 'bar',
        data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    }
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
    /*this.crudProducto.verConteoEncuesta()
    .map(response => response.json())
    .subscribe(data => {
      this.listado = data;
      for (const i of this.listado) {
        this.idEncuesta.push(i.idEncuesta);
        this.max++;
        const percent = (i.Respondido * 100) / (i.Faltantes);
        this.porcentajes.push(percent);
      }
    });*/

   
  }
}
