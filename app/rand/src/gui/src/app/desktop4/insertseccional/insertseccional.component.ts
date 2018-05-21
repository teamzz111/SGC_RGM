import { Component, OnInit } from '@angular/core';
import { Seccional } from '../seccional';
import { UserServiceService } from '../../user-service.service';
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-insertseccional',
  templateUrl: './insertseccional.component.html',
  styleUrls: ['./insertseccional.component.css']
})
export class InsertseccionalComponent implements OnInit {
  job;
  constructor(private crudProducto: UserServiceService) { }
  send() {
    this.job = new Seccional($('#nombre').val());
    this.crudProducto.insertarjob(this.job)
      .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
      .subscribe(data => {
        if (data === 'true' || data === 'true2') {
          $('.notifi').css({ background: 'rgb(14,194,14)' });
          $('.notifi').text('Se añadió el cargo');
          $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
            setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
          });
        } else if (data === 'false' || data === '0' || data === 'false2') {
          $('.notifi').css({ background: 'red' });
          $('.notifi').text('Se encontró un error');
          $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
            setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
          });
        } else if (data === 'nel') {
          $('.notifi').css({ background: 'red' });
          $('.notifi').text('Cargo existente');
          $('.notifi').animate({ marginTop: '2em' }, 1000, function () {
            setTimeout(function () { $('.notifi').animate({ marginTop: '-10em' }, 1000); }, 5000);
          });
        }
      });
  }
  ngOnInit() {
  }

}
