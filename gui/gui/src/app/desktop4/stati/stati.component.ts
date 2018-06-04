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
  max2;
  lista;
  idspreguntas = [];
  constructor(private crudProducto: UserServiceService) {
    this.max = 0;
    this.max2 = 0;
  }
  go(index) {
    this.lugar = true;
    this.encuesta = this.idEncuesta[index];
    this.crudProducto.estadisticasEncuesta(JSON.stringify({ id: this.encuesta }))
      .map(response => response.json())
      .subscribe(data => {
        if (data === 'sinrespuestas') {
          this.lugar = false;
          $('.notifi').css({ background: 'red' });
          $('.notifi').text('Sin preguntas...');
          $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
            setTimeout(function () {
              $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 3000);

          });
        } else {
        this.lista = data;
        for (const i of data) {
          if (i.Pregunta !== '') {
            this.preguntas.push(i.Pregunta);
            this.idspreguntas.push(i.idPregunta);
            this.max2++;
          }
        }
      }
      });
  }

  loadGraphics() {
    if (!this.gra) {
      this.gra = true;
      $('#inservible').remove();
      for (const i of this.lista) {
        const respu = [];
        const cont = [];
        if (i.Respuesta1 !== '') {
          respu.push(i.Respuesta1);
          cont.push(i.Contador1);
        }
        if (i.Respuesta2 !== '') {
          respu.push(i.Respuesta2);
          cont.push(i.Contador2);
        }
        if (i.Respuesta3 !== '') {
          respu.push(i.Respuesta3);
          cont.push(i.Contador3);
        }
        if (i.Respuesta4 !== '') {
          respu.push(i.Respuesta4);
          cont.push(i.Contador4);
        }
        if (i.Respuesta5 !== '') {
          respu.push(i.Respuesta5);
          cont.push(i.Contador5);
        }
        const myChart = new Chart($('#' + i.idPregunta)[0].getContext('2d'), {
                type: 'bar',
                data: {
                  labels: respu,
                  datasets: [{
                    label: i.Pregunta,
                    data: cont,
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
                    borderWidth: 1,
                  }]
                },
                options: {
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero: true,
                      }
                    }]
                  }
                },
              });
            }
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
