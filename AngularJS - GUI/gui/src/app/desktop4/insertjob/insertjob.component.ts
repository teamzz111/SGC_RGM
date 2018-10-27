import { Component, OnInit } from '@angular/core';
import { Cargo } from '../cargo';
declare var jquery: any;
declare var $: any;
import { UserServiceService } from '../.././user-service.service';
import 'rxjs/add/operator/map'; // Libreria para mapear los resultados a JSON
@Component({
  selector: 'app-insertjob',
  templateUrl: './insertjob.component.html',
  styleUrls: ['./insertjob.component.css']
})
export class InsertjobComponent implements OnInit {
  job;
  constructor(private crudProducto: UserServiceService) { }

  ngOnInit() {
  }
   send() {
      this.job = new Cargo($('#nombre').val(), $('input:radio[name=level]:checked').val());
      this.crudProducto.insertarjob(this.job)
      .map(response => response.json()) // Mapeamos los datos devueltos por nuestro archivo php
      .subscribe(data => {
      if (data === 'true' || data === 'true2') {
        $('.notifi').css({background: 'rgb(14,194,14)'});
        $('.notifi').text('Se añadió el cargo');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
      } else if (data === 'false' || data === '0' || data === 'false2') {
        $('.notifi').css({background: 'red'});
        $('.notifi').text('Se encontró un error');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
      } else if (data === 'nel') {
        $('.notifi').css({background: 'red'});
        $('.notifi').text('Cargo existente');
        $('.notifi').animate({marginTop: '2em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
      }
    });
   }
}
