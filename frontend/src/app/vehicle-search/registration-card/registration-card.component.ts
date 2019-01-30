import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { VehicleRegistration } from '../../entity/vehicle';

import * as moment from 'moment';

@Component({
  selector: 'app-registration-card',
  templateUrl: './registration-card.component.html',
  styleUrls: ['./registration-card.component.scss']
})
export class RegistrationCardComponent implements OnInit {
  constructor() { }

  @Input()
  registration: VehicleRegistration;

  @Output()
  goBack = new EventEmitter<void>();

  expiresIn: string;
  issuedIn: string;

  get isExpired(): boolean {
    return moment().isAfter(this.registration.expireTime);
  }

  ngOnInit() {
    this.expiresIn = moment(this.registration.expireTime).fromNow();
    this.issuedIn = moment(this.registration.createTime).fromNow();
  }
}
