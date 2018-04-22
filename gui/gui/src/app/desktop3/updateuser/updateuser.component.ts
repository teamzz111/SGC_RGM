import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '../.././user-service.service';
declare var jquery: any;
declare var $: any;
@Component({
  selector: 'app-updateuser',
  templateUrl: './updateuser.component.html',
  styleUrls: ['./updateuser.component.css']
})
export class UpdateuserComponent {
  visible: boolean;
  listado;
  listado2;
  constructor(private crudProducto: UserServiceService) {
    this.visible = false;
   }

   busca() {
    this.crudProducto.busca($('#cc').val()).map(response => response.json())
    .subscribe(data => {
      if (data === 'false') {
        $('.notifi').css({background: 'red'});
        $('.notifi').text('El usuario no existe');
        $('.notifi').animate({marginTop: 0}, 1000, function() {
          $(this).css('marginTop' , '100%');
        });
      } else {
        for (const item of data) {
          $('#cedula').val(item.cedula);
          $('#nombre').val(item.nombre);
          $('#apellido').val(item.apellido);
          $('#correo').val(item.correo);
          $('#telefono').val(item.telefono);
          $('#direccion').val(item.direccion);
          $('#numero').val(item.numero);
          if (item.genero === 'm') {
            $('input:radio[name="gender"]')
              .filter('[value = "male"]')
              .prop('checked', true);
          } else if (item.genero === 'f') {
            $('input:radio[name="gender"]')
              .filter('[value = "female"]')
              .prop('checked', true);
          } else {
            $('input:radio[name="gender"]')
              .filter('[value = "other"]')
              .prop('checked', true);
          }
        }
        this.visible = true;
      }
    });
   }


}
