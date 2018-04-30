import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-desktop4',
  templateUrl: './desktop4.component.html',
  styleUrls: ['./desktop4.component.css']
})
export class Desktop4Component implements OnInit {
  semidesk;
  constructor() {
    this.semidesk = 1;
   }

  ngOnInit() {
  }

}
