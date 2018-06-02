import { Component, OnInit } from '@angular/core';
declare var jquery: any;
declare var $: any;
@Component({
  selector: 'app-stati',
  templateUrl: './stati.component.html',
  styleUrls: ['./stati.component.css']
})
export class StatiComponent implements OnInit {

  constructor() { }

  ngOnInit() {
    $('.test-circle').circliful({
      animationStep: 5,
      foregroundBorderWidth: 14,
      backgroundBorderWidth: 14,
      percent: 75,
      foregroundColor: 'white',
      fontColor: 'white'
    });
  }

}
