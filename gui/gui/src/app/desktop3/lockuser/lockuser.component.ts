import { UserServiceService } from './../../user-service.service';
import { Component, OnInit } from '@angular/core';
import { User } from '../user';
declare var jquery: any;
declare var $: any;

@Component({
  selector: 'app-lockuser',
  templateUrl: './lockuser.component.html',
  styleUrls: ['./lockuser.component.css']
})
export class LockuserComponent {
  active: boolean;
  user;
  listado;
  constructor(private crudProducto: UserServiceService) {
    this.active = false;
   }

   lock(n) {
    if (n === 1) {
      this.crudProducto.bloquear(n, $('#cc').val())
      .map(response => response.json())
      .subscribe(data => {
        if (data === 'no' || data === 'nel') {
        $('.notifi').css({background: 'red'});
        $('.notifi').text('Usuario existente');
        $('.notifi').animate({marginTop: '3em'}, 1000, function() {
          setTimeout(function() { $('.notifi').animate({marginTop: '-10em'}, 1000); } , 5000);
        });
        } else {
          this.user = data;
        }
      });

    } else {
      this.user = new User($('#cc').val(), 2);
      this.crudProducto.bloquear(n, User);
    }
   }
}
