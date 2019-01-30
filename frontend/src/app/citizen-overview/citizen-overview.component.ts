import { Component, Input, OnInit } from '@angular/core';
import { Citizen } from '../entity/citizen';

@Component({
  selector: 'app-citizen-overview',
  templateUrl: './citizen-overview.component.html',
  styleUrls: ['./citizen-overview.component.scss']
})
export class CitizenOverviewComponent implements OnInit {
  constructor() { }

  @Input()
  citizen: Citizen;

  ngOnInit() {
  }
}
