import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { VehicleInsurance } from '../../entity/vehicle';
import * as moment from 'moment';

@Component({
  selector: 'app-insurance-card',
  templateUrl: './insurance-card.component.html',
  styleUrls: ['./insurance-card.component.scss']
})
export class InsuranceCardComponent implements OnInit {
  constructor() { }

  @Input()
  insurance: VehicleInsurance;

  @Output()
  goBack = new EventEmitter<void>();

  expiresIn: string;
  issuedIn: string;

  get isExpired(): boolean {
    return moment().isAfter(this.insurance.expireTime);
  }

  ngOnInit() {
    this.expiresIn = moment(this.insurance.expireTime).fromNow();
    this.issuedIn = moment(this.insurance.createTime).fromNow();
  }
}
