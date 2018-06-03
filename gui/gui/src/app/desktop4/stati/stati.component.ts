import { Pregunta } from './../../desktop5/pregunta';
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
  public preguntas = [];
  public listado;
  public max: number;
  public lugar = false;
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
      this.crudProducto.estadisticasEncuesta(JSON.stringify({ id: this.encuesta}))
        .map(response => response.json())
        .subscribe(data => {
          console.log(data);
          for (const i of data) {
            if (i.Pregunta !== '') {
              this.preguntas.push(i.Pregunta);
            }
            if (i[0].Pregunta2 !== '') {
              this.preguntas.push(i[0].Pregunta);
            }
            if (i[1].Pregunta3 !== '') {
              this.preguntas.push(i[1].Pregunta);
            }
            if (i[2].Pregunta4 !== '') {
              this.preguntas.push(i[2].Pregunta);
            }
            if (i.Pregunta4 !== '') {
              this.preguntas.push(i.Pregunta);
            }
          const myChart = new Chart($('#myChart')[0].getContext('2d'), {
            type: 'bar',
            data: {
              labels: this.preguntas,
              datasets: [{
                label: i.Nombre,
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
    this.crudProducto.verConteoEncuesta()
    .map(response => response.json())
    .subscribe(data => {
      this.listado = data;
      for (const i of this.listado) {
        this.idEncuesta.push(i.idEncuesta);
        this.max++;
        const percent = (i.Respondido * 100) / (i.Faltantes);
        this.porcentajes.push(percent);
      }
    });
   
  }
}
