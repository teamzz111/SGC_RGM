import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-updateuser',
  templateUrl: './updateuser.component.html',
  styleUrls: ['./updateuser.component.css']
})
export class UpdateuserComponent implements OnInit {
  visible: boolean;
  listado;
  listado2;
  constructor() {
    this.visible = false;
   }

  ngOnInit() {
  }

}
